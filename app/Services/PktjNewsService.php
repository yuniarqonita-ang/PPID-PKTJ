<?php

namespace App\Services;

use App\Models\Berita;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PktjNewsService
{
    protected string $feedUrl = 'https://pktj.ac.id/feed';
    protected string $beritaUrl = 'https://pktj.ac.id/berita';
    protected int $cacheTtlSeconds = 300; // 5 menit cache agar selalu realtime

    /**
     * Mengambil daftar berita realtime dari website pktj.ac.id
     */
    public function getLiveNews(int $limit = 30, bool $forceRefresh = false): array
    {
        $cacheKey = 'pktj_live_news_v2_' . $limit;

        if ($forceRefresh) {
            Cache::forget($cacheKey);
        }

        return Cache::remember($cacheKey, $this->cacheTtlSeconds, function () use ($limit) {
            $items = $this->fetchFromRss();

            if (empty($items)) {
                $items = $this->fetchFromScraping();
            }

            // Jika masih kosong (misal koneksi timeout), ambil dari database lokal
            if (empty($items)) {
                $items = $this->fetchFromLocalDatabase($limit);
            }

            return array_slice($items, 0, $limit);
        });
    }

    /**
     * Ambil berita berdasarkan kategori
     */
    public function getNewsByCategory(?string $category = null, int $limit = 30): array
    {
        $allNews = $this->getLiveNews($limit * 2);

        if (!$category || strtolower($category) === 'semua' || strtolower($category) === 'all') {
            return array_slice($allNews, 0, $limit);
        }

        $categorySlug = Str::slug($category);
        $filtered = array_filter($allNews, function ($item) use ($categorySlug, $category) {
            $itemCat = Str::slug($item['kategori'] ?? '');
            return str_contains($itemCat, $categorySlug) || 
                   str_contains(strtolower($item['kategori'] ?? ''), strtolower($category)) ||
                   str_contains(strtolower($item['judul'] ?? ''), strtolower($category));
        });

        return array_slice(array_values($filtered), 0, $limit);
    }

    /**
     * Fetch & parse RSS Feed XML dari pktj.ac.id/feed
     */
    protected function fetchFromRss(): array
    {
        try {
            $response = Http::timeout(6)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept'     => 'application/rss+xml, application/xml, text/xml, */*'
                ])
                ->get($this->feedUrl);

            if (!$response->successful()) {
                return [];
            }

            $xmlString = $response->body();
            // Suppress XML errors
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);

            if (!$xml || !isset($xml->channel->item)) {
                return [];
            }

            $newsList = [];

            foreach ($xml->channel->item as $item) {
                $title       = (string) $item->title;
                $link        = (string) $item->link;
                $guid        = (string) ($item->guid ?? $link);
                $detail      = (string) ($item->detail ?? '');
                $description = (string) $item->description;
                $pubDateRaw  = (string) $item->pubDate;
                $imgUrl      = (string) ($item->img_url ?? '');

                // Fallback ekstrasi gambar dari CDATA description jika img_url kosong
                if (empty($imgUrl) && !empty($description)) {
                    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $description, $m)) {
                        $imgUrl = $m[1];
                    }
                }

                // Default gambar jika tidak ada
                if (empty($imgUrl)) {
                    $imgUrl = 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png';
                }

                // Deteksi kategori dari link atau judul
                $kategori = 'Liputan/Berita';
                if (str_contains(strtolower($link), 'karir') || str_contains(strtolower($title), 'recruitment') || str_contains(strtolower($title), 'lowongan')) {
                    $kategori = 'Karir';
                } elseif (str_contains(strtolower($title), 'pengumuman') || str_contains(strtolower($title), 'sipencatar') || str_contains(strtolower($title), 'penerimaan')) {
                    $kategori = 'Pengumuman';
                } elseif (str_contains(strtolower($title), 'wisuda') || str_contains(strtolower($title), 'kuliah') || str_contains(strtolower($title), 'akademik')) {
                    $kategori = 'Pendidikan';
                } elseif (str_contains(strtolower($title), 'kunjungan') || str_contains(strtolower($title), 'kerjasama') || str_contains(strtolower($title), 'upacara')) {
                    $kategori = 'Seputar Kampus';
                }

                // Parse tanggal
                $tanggalObj = $this->parseIndonesianDate($pubDateRaw);

                $cleanSnippet = !empty($detail) ? strip_tags($detail) : strip_tags($description);
                $cleanSnippet = preg_replace('/\s+/', ' ', trim($cleanSnippet));

                $newsList[] = [
                    'judul'       => trim($title),
                    'slug'        => Str::slug($title),
                    'link'        => $link,
                    'guid'        => $guid,
                    'gambar'      => $imgUrl,
                    'konten'      => $cleanSnippet,
                    'ringkasan'   => Str::limit($cleanSnippet, 130),
                    'kategori'    => $kategori,
                    'tanggal_raw' => $pubDateRaw,
                    'tanggal'     => $tanggalObj ? $tanggalObj->format('Y-m-d') : date('Y-m-d'),
                    'tanggal_f'   => $tanggalObj ? $tanggalObj->translatedFormat('d F Y') : date('d M Y'),
                    'is_external' => true,
                    'sumber'      => 'pktj.ac.id',
                ];
            }

            return $newsList;
        } catch (\Throwable $e) {
            Log::warning('PktjNewsService RSS fetch error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Fallback web crawler dari https://pktj.ac.id/berita
     */
    protected function fetchFromScraping(): array
    {
        try {
            $response = Http::timeout(6)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                ])
                ->get($this->beritaUrl);

            if (!$response->successful()) {
                return [];
            }

            $html = $response->body();
            $newsList = [];

            // Pattern regex untuk article post di html pktj.ac.id
            $pattern = '/<article[^>]*class=["\'][^"\']*post[^"\']*["\'][^>]*>(.*?)<\/article>/is';
            if (preg_match_all($pattern, $html, $articles)) {
                foreach ($articles[1] as $artHtml) {
                    // Image
                    $img = 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png';
                    if (preg_match('/src=["\']([^"\']+)["\']/i', $artHtml, $mImg)) {
                        $img = $mImg[1];
                        if (str_contains($img, 'ajax-loader.gif') && preg_match('/data-lazy=["\']([^"\']+)["\']/i', $artHtml, $mLazy)) {
                            $img = $mLazy[1];
                        }
                    }

                    // Category
                    $cat = 'Liputan/Berita';
                    if (preg_match('/<span[^>]*class=["\']post-category["\'][^>]*>.*?<a[^>]*>(.*?)<\/a>/is', $artHtml, $mCat)) {
                        $cat = trim(strip_tags($mCat[1]));
                    }

                    // Title & Link
                    $title = '';
                    $link = 'https://pktj.ac.id/berita';
                    if (preg_match('/<div[^>]*class=["\']post-title["\'][^>]*>.*?<h3><a\s+href=["\']([^"\']+)["\'][^>]*>(.*?)<\/a><\/h3>/is', $artHtml, $mTitle)) {
                        $link = $mTitle[1];
                        $title = html_entity_decode(trim(strip_tags($mTitle[2])));
                    }

                    // Content snippet
                    $desc = '';
                    if (preg_match('/<div[^>]*class=["\']entry-content["\'][^>]*>(.*?)<\/div>/is', $artHtml, $mDesc)) {
                        $desc = preg_replace('/\s+/', ' ', trim(strip_tags($mDesc[1])));
                    }

                    if (!empty($title)) {
                        $newsList[] = [
                            'judul'       => $title,
                            'slug'        => Str::slug($title),
                            'link'        => $link,
                            'guid'        => $link,
                            'gambar'      => $img,
                            'konten'      => $desc,
                            'ringkasan'   => Str::limit($desc, 130),
                            'kategori'    => ucfirst($cat),
                            'tanggal_raw' => date('d F Y'),
                            'tanggal'     => date('Y-m-d'),
                            'tanggal_f'   => date('d F Y'),
                            'is_external' => true,
                            'sumber'      => 'pktj.ac.id',
                        ];
                    }
                }
            }

            return $newsList;
        } catch (\Throwable $e) {
            Log::warning('PktjNewsService Scrape error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Ambil dari database lokal jika offline / fallback
     */
    protected function fetchFromLocalDatabase(int $limit = 30): array
    {
        try {
            $beritas = Berita::where('aktif', true)
                ->orderBy('tanggal', 'desc')
                ->orderBy('created_at', 'desc')
                ->take($limit)
                ->get();

            $newsList = [];
            foreach ($beritas as $b) {
                $newsList[] = [
                    'id'          => $b->id,
                    'judul'       => $b->judul,
                    'slug'        => $b->slug,
                    'link'        => $b->url_berita,
                    'guid'        => $b->guid ?? $b->link_sumber ?? url('/berita/' . $b->slug),
                    'gambar'      => $b->gambar_url,
                    'konten'      => strip_tags($b->konten),
                    'ringkasan'   => Str::limit(strip_tags($b->konten), 130),
                    'kategori'    => $b->kategori ?? 'Liputan/Berita',
                    'tanggal'     => $b->tanggal ? Carbon::parse($b->tanggal)->format('Y-m-d') : $b->created_at->format('Y-m-d'),
                    'tanggal_f'   => $b->tanggal ? Carbon::parse($b->tanggal)->translatedFormat('d F Y') : $b->created_at->translatedFormat('d F Y'),
                    'is_external' => $b->is_external ?? false,
                    'sumber'      => $b->is_external ? 'pktj.ac.id' : 'PPID PKTJ',
                ];
            }
            return $newsList;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Sinkronisasi data berita ke tabel database 'beritas'
     */
    public function syncToDatabase(): array
    {
        $liveNews = $this->getLiveNews(40, true);
        $syncedCount = 0;
        $newCount = 0;

        foreach ($liveNews as $item) {
            try {
                $existing = Berita::where('guid', $item['guid'])
                    ->orWhere('link_sumber', $item['link'])
                    ->orWhere('judul', $item['judul'])
                    ->first();

                if ($existing) {
                    $existing->update([
                        'judul'       => $item['judul'],
                        'konten'      => $item['konten'],
                        'gambar'      => $item['gambar'],
                        'kategori'    => $item['kategori'],
                        'tanggal'     => $item['tanggal'],
                        'link_sumber' => $item['link'],
                        'guid'        => $item['guid'],
                        'is_external' => true,
                        'aktif'       => 1,
                        'is_published'=> 1,
                    ]);
                    $syncedCount++;
                } else {
                    Berita::create([
                        'judul'       => $item['judul'],
                        'slug'        => Str::slug($item['judul']) . '-' . time() . '-' . rand(10, 99),
                        'konten'      => $item['konten'],
                        'gambar'      => $item['gambar'],
                        'kategori'    => $item['kategori'],
                        'tanggal'     => $item['tanggal'],
                        'link_sumber' => $item['link'],
                        'guid'        => $item['guid'],
                        'is_external' => true,
                        'aktif'       => 1,
                        'is_published'=> 1,
                        'views'       => 0,
                    ]);
                    $newCount++;
                }
            } catch (\Throwable $e) {
                Log::warning('Sync single news error: ' . $e->getMessage());
            }
        }

        // Catat waktu sinkronisasi terakhir di dashboards
        try {
            Dashboard::updateOrCreate(
                ['key' => 'pktj_news_last_sync'],
                [
                    'value'       => now()->toDateTimeString(),
                    'type'        => 'text',
                    'description' => 'Waktu terakhir sinkronisasi berita PKTJ.ac.id',
                    'aktif'       => true,
                ]
            );
            Dashboard::updateOrCreate(
                ['key' => 'pktj_news_total_synced'],
                [
                    'value'       => (string) ($syncedCount + $newCount),
                    'type'        => 'text',
                    'description' => 'Total berita PKTJ tersinkron',
                    'aktif'       => true,
                ]
            );
        } catch (\Throwable $e) {}

        return [
            'total_fetched' => count($liveNews),
            'updated'       => $syncedCount,
            'new'           => $newCount,
            'timestamp'     => now()->translatedFormat('d F Y H:i:s'),
        ];
    }

    /**
     * Hapus berita dummy / patrick
     */
    public function cleanDummyNews(): int
    {
        try {
            // Hapus berita yang memiliki gambar patrick atau kata kunci dummy
            $deleted = Berita::where('gambar', 'like', '%patrick%')
                ->orWhere('judul', 'like', '%patrick%')
                ->orWhere('judul', 'like', '%dummy%')
                ->orWhere('konten', 'like', '%patrick%')
                ->delete();

            return $deleted;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * Helper parsing tanggal Indonesia
     */
    protected function parseIndonesianDate(string $dateStr): ?Carbon
    {
        if (empty($dateStr)) return null;

        $bulanIndo = [
            'Januari'   => 'January',
            'Februari'  => 'February',
            'Maret'     => 'March',
            'April'     => 'April',
            'Mei'       => 'May',
            'Juni'      => 'June',
            'Juli'      => 'July',
            'Agustus'   => 'August',
            'September' => 'September',
            'Oktober'   => 'October',
            'November'  => 'November',
            'Desember'  => 'December',
        ];

        $englishDateStr = strtr($dateStr, $bulanIndo);

        try {
            return Carbon::parse($englishDateStr);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
