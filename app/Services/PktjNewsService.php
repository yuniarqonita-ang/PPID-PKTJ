<?php

namespace App\Services;

use App\Models\Berita;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PktjNewsService
{
    protected string $feedUrl = 'https://pktj.ac.id/feed';
    protected array $scrapeEndpoints = [
        'https://pktj.ac.id/berita'                  => 'Liputan/Berita',
        'https://pktj.ac.id/berita/rilis'            => 'Liputan/Berita',
        'https://pktj.ac.id/kategori/liputanberita'  => 'Liputan/Berita',
        'https://pktj.ac.id/kategori/seputarkampus'  => 'Seputar Kampus',
        'https://pktj.ac.id/kategori/seputar-kampus' => 'Seputar Kampus',
        'https://pktj.ac.id/kategori/pengumuman'     => 'Pengumuman',
        'https://pktj.ac.id/kategori/karir'          => 'Karir',
        'https://pktj.ac.id/kategori/pendidikan'     => 'Pendidikan',
        'https://pktj.ac.id/kategori/prestasi'       => 'Prestasi',
        'https://pktj.ac.id/kategori/alumni'         => 'Alumni',
    ];
    
    // Cache 5 menit agar selalu realtime dan tetap cepat
    protected int $cacheTtlSeconds = 300;

    /**
     * Mengambil seluruh daftar berita realtime dari website pktj.ac.id
     */
    public function getLiveNews(int $limit = 500, bool $forceRefresh = false): array
    {
        $cacheKey = 'pktj_live_all_news_v6';

        if ($forceRefresh) {
            Cache::forget($cacheKey);
            Cache::forget('pktj_live_all_news_v5');
            Cache::forget('pktj_live_all_news_v4');
        }

        return Cache::remember($cacheKey, $this->cacheTtlSeconds, function () use ($limit) {
            // 1. Ambil seluruh berita permanen dari database lokal
            $local = $this->fetchFromLocalDatabase($limit);

            // 2. Coba fetch cepat dari remote PKTJ (RSS Feed + Halaman 1) untuk deteksi artikel baru
            try {
                $remote = $this->fetchFastFromPktj();
                if (!empty($remote)) {
                    // Auto-sync artikel baru ke database secara permanen
                    $this->quickSyncToDatabase($remote);
                    // Ambil ulang data lokal yang sudah terupdate
                    $local = $this->fetchFromLocalDatabase($limit);
                }
            } catch (\Throwable $e) {
                Log::info('PKTJ fast fetch skipped: ' . $e->getMessage());
            }

            return array_slice($local, 0, $limit);
        });
    }

    /**
     * Fetch cepat dari RSS Feed + Halaman Berita Utama PKTJ
     */
    public function fetchFastFromPktj(): array
    {
        $articles = [];

        // A. Ambil dari RSS Feed (sangat cepat & selalu memuat berita teranyar)
        $rss = $this->fetchFromRss();
        foreach ($rss as $item) {
            $articles[$item['link']] = $item;
        }

        // B. Ambil juga dari halaman https://pktj.ac.id/berita
        try {
            $ch = curl_init('https://pktj.ac.id/berita');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                CURLOPT_TIMEOUT        => 5,
                CURLOPT_CONNECTTIMEOUT => 3,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $html = curl_exec($ch);
            curl_close($ch);

            if (!empty($html)) {
                preg_match_all('/<article[^>]*class=["\'][^"\']*post[^"\']*["\'][^>]*>(.*?)<\/article>/is', $html, $matches);
                foreach ($matches[1] as $block) {
                    if (!preg_match('/<a[^>]+href=["\'](https:\/\/pktj\.ac\.id\/berita\/[0-9]{8}-[0-9]+-[^"\']+)["\'][^>]*>(.*?)<\/a>/is', $block, $linkM)) {
                        continue;
                    }
                    $link = $linkM[1];
                    $title = trim(strip_tags($linkM[2]));
                    if (strtolower($title) === 'baca selengkapnya' || strlen($title) < 5) {
                        if (preg_match('/<h3[^>]*>(.*?)<\/h3>/is', $block, $h3M)) {
                            $title = trim(strip_tags($h3M[1]));
                        }
                    }
                    if (strlen($title) < 5) continue;

                    // Image
                    $img = 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png';
                    if (preg_match_all('/(src|data-src|data-lazy)=["\']([^"\']+\.(jpg|jpeg|png|webp|gif)[^"\']*)["\']/i', $block, $imgs, PREG_SET_ORDER)) {
                        foreach ($imgs as $im) {
                            if (!str_contains($im[2], 'ajax-loader') && !str_contains($im[2], 'icon')) {
                                $img = $im[2];
                                if (str_starts_with($img, '/')) $img = 'https://pktj.ac.id' . $img;
                                break;
                            }
                        }
                    }

                    // Date
                    $date = date('Y-m-d');
                    if (preg_match('/\/berita\/([0-9]{4})([0-9]{2})([0-9]{2})-/', $link, $dm)) {
                        $date = "{$dm[1]}-{$dm[2]}-{$dm[3]}";
                    }

                    $dateObj = null;
                    try {
                        $dateObj = Carbon::parse($date);
                    } catch (\Exception $e) {}

                    // Category
                    $cat = 'Liputan/Berita';
                    if (preg_match('/class=["\'][^"\']*post-category[^"\']*["\'][^>]*>(.*?)<\/span>/is', $block, $catM)) {
                        $cat = trim(strip_tags($catM[1]));
                    }
                    $cat = $this->normalizeCategory($cat, $title);

                    // Snippet
                    $snippet = $title;
                    if (preg_match('/<div[^>]*class=["\'][^"\']*entry-content[^"\']*["\'][^>]*>(.*?)<\/div>/is', $block, $snipM)) {
                        $snippet = trim(strip_tags($snipM[1]));
                    }
                    $snippet = preg_replace('/\s+/', ' ', $snippet);

                    if (!isset($articles[$link])) {
                        $articles[$link] = [
                            'judul'       => $title,
                            'slug'        => Str::slug($title),
                            'link'        => $link,
                            'guid'        => $link,
                            'gambar'      => $img,
                            'konten'      => $snippet,
                            'ringkasan'   => Str::limit($snippet, 140),
                            'kategori'    => $cat,
                            'tanggal_raw' => $date,
                            'tanggal'     => $date,
                            'tanggal_f'   => $dateObj ? $dateObj->translatedFormat('d F Y') : $date,
                            'is_external' => true,
                            'sumber'      => 'pktj.ac.id',
                        ];
                    }
                }
            }
        } catch (\Throwable $e) {
            // Lanjutkan jika scrape HTML error
        }

        usort($articles, function ($a, $b) {
            return strcmp($b['tanggal'], $a['tanggal']);
        });

        return array_values($articles);
    }

    /**
     * Ambil berita berdasarkan kategori
     */
    public function getNewsByCategory(?string $category = null, int $limit = 500): array
    {
        $allNews = $this->getLiveNews($limit);

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
     * Fetch & parse semua berita dari RSS + Seluruh Halaman Kategori PKTJ.ac.id
     */
    public function fetchAllFromPktj(): array
    {
        $allArticles = [];

        // 1. Fetch from RSS feed
        $rssArticles = $this->fetchFromRss();
        foreach ($rssArticles as $art) {
            $allArticles[$art['link']] = $art;
        }

        // 2. Fetch from all Category & News pages on PKTJ
        foreach ($this->scrapeEndpoints as $url => $defaultCategory) {
            try {
                $ch = curl_init($url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    CURLOPT_TIMEOUT        => 6,
                    CURLOPT_CONNECTTIMEOUT => 3,
                    CURLOPT_SSL_VERIFYPEER => false,
                ]);
                $html = curl_exec($ch);
                curl_close($ch);

                if (empty($html)) continue;

                preg_match_all('/<article[^>]*class=["\'][^"\']*post[^"\']*["\'][^>]*>(.*?)<\/article>/is', $html, $matches);
                
                foreach ($matches[1] as $block) {
                    if (!preg_match('/<a[^>]+href=["\'](https:\/\/pktj\.ac\.id\/berita\/[0-9]{8}-[0-9]+-[^"\']+)["\'][^>]*>(.*?)<\/a>/is', $block, $linkM)) {
                        continue;
                    }
                    $link = $linkM[1];
                    $title = trim(strip_tags($linkM[2]));

                    if (strtolower($title) === 'baca selengkapnya' || strlen($title) < 5) {
                        if (preg_match('/<h3[^>]*>(.*?)<\/h3>/is', $block, $h3M)) {
                            $title = trim(strip_tags($h3M[1]));
                        }
                    }

                    if (preg_match('/^[0-9]{1,2}\s+[a-zA-Z]+\s+[0-9]{4}\s*\|\s*(.*)$/i', $title, $titleCleanM)) {
                        $title = trim($titleCleanM[1]);
                    }

                    if (strlen($title) < 5) continue;

                    // Image
                    $img = 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png';
                    if (preg_match_all('/(src|data-src|data-original|data-lazy)=["\']([^"\']+\.(jpg|jpeg|png|webp|gif)[^"\']*)["\']/i', $block, $allImgs, PREG_SET_ORDER)) {
                        foreach ($allImgs as $imgM) {
                            $candidate = $imgM[2];
                            if (!str_contains($candidate, 'ajax-loader') && !str_contains($candidate, 'icon')) {
                                $img = $candidate;
                                if (str_starts_with($img, '/')) {
                                    $img = 'https://pktj.ac.id' . $img;
                                }
                                break;
                            }
                        }
                    }

                    // Category
                    $cat = $defaultCategory;
                    if (preg_match('/class=["\'][^"\']*post-category[^"\']*["\'][^>]*>(.*?)<\/span>/is', $block, $catM)) {
                        $extractedCat = trim(strip_tags($catM[1]));
                        if (!empty($extractedCat)) {
                            $cat = ucwords(strtolower($extractedCat));
                        }
                    }
                    $cat = $this->normalizeCategory($cat, $title);

                    // Snippet
                    $snippet = '';
                    if (preg_match('/<div[^>]*class=["\'][^"\']*entry-content[^"\']*["\'][^>]*>(.*?)<\/div>/is', $block, $snipM)) {
                        $snippet = trim(strip_tags($snipM[1]));
                    }
                    $snippet = preg_replace('/\s+/', ' ', $snippet);

                    // Date
                    $date = date('Y-m-d');
                    if (preg_match('/\/berita\/([0-9]{4})([0-9]{2})([0-9]{2})-/', $link, $dateM)) {
                        $date = "{$dateM[1]}-{$dateM[2]}-{$dateM[3]}";
                    }

                    $dateObj = null;
                    try {
                        $dateObj = Carbon::parse($date);
                    } catch (\Exception $e) {}

                    if (!isset($allArticles[$link])) {
                        $allArticles[$link] = [
                            'judul'       => $title,
                            'slug'        => Str::slug($title),
                            'link'        => $link,
                            'guid'        => $link,
                            'gambar'      => $img,
                            'konten'      => $snippet,
                            'ringkasan'   => Str::limit($snippet, 140),
                            'kategori'    => $cat,
                            'tanggal_raw' => $date,
                            'tanggal'     => $date,
                            'tanggal_f'   => $dateObj ? $dateObj->translatedFormat('d F Y') : $date,
                            'is_external' => true,
                            'sumber'      => 'pktj.ac.id',
                        ];
                    }
                }
            } catch (\Throwable $e) {
                // Lanjut ke endpoint berikutnya
            }
        }

        usort($allArticles, function ($a, $b) {
            return strcmp($b['tanggal'], $a['tanggal']);
        });

        return array_values($allArticles);
    }

    /**
     * Fetch & parse RSS Feed XML dari pktj.ac.id/feed
     */
    protected function fetchFromRss(): array
    {
        try {
            $ch = curl_init($this->feedUrl);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                CURLOPT_TIMEOUT        => 5,
                CURLOPT_CONNECTTIMEOUT => 3,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $xmlString = curl_exec($ch);
            curl_close($ch);

            if (empty($xmlString)) {
                return [];
            }

            // PENTING: Bersihkan karakter '&' yang tidak ter-escape pada XML resmi pktj.ac.id agar simplexml tidak error
            $cleanXml = preg_replace('/&(?!amp;|lt;|gt;|quot;|apos;|#\d+;|#x[0-9a-fA-F]+;)/', '&amp;', $xmlString);

            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($cleanXml, 'SimpleXMLElement', LIBXML_NOCDATA);

            if (!$xml || !isset($xml->channel->item)) {
                return [];
            }

            $newsList = [];

            foreach ($xml->channel->item as $item) {
                $title       = trim((string) $item->title);
                $link        = trim((string) $item->link);
                $guid        = trim((string) ($item->guid ?? $link));
                $detail      = (string) ($item->detail ?? '');
                $description = (string) $item->description;
                $pubDateRaw  = trim((string) $item->pubDate);
                $imgUrl      = trim((string) ($item->img_url ?? ''));

                if (empty($imgUrl) && !empty($description)) {
                    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $description, $m)) {
                        if (!str_contains($m[1], 'ajax-loader')) {
                            $imgUrl = $m[1];
                        }
                    }
                }

                if (empty($imgUrl) || str_contains($imgUrl, 'ajax-loader')) {
                    $imgUrl = 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png';
                }

                $kategori = $this->normalizeCategory('Liputan/Berita', $title);
                $tanggalObj = $this->parseIndonesianDate($pubDateRaw);

                $cleanSnippet = !empty($detail) ? strip_tags($detail) : strip_tags($description);
                $cleanSnippet = preg_replace('/\s+/', ' ', trim($cleanSnippet));

                $newsList[] = [
                    'judul'       => $title,
                    'slug'        => Str::slug($title),
                    'link'        => $link,
                    'guid'        => $guid,
                    'gambar'      => $imgUrl,
                    'konten'      => $cleanSnippet,
                    'ringkasan'   => Str::limit($cleanSnippet, 140),
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
            Log::warning('Fetch RSS PKTJ error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Auto-sync top artikel terbaru dari remote ke Database lokal (phpMyAdmin)
     */
    public function quickSyncToDatabase(array $articles): void
    {
        try {
            foreach ($articles as $art) {
                $link = $art['link'] ?? null;
                $judul = $art['judul'] ?? null;
                if (!$judul) continue;

                $existing = Berita::where('judul', $judul)
                    ->orWhere(function($q) use ($link) {
                        if ($link) $q->where('link_sumber', $link);
                    })->first();

                if (!$existing) {
                    Berita::create([
                        'judul'       => $art['judul'],
                        'slug'        => ($art['slug'] ?? Str::slug($art['judul'])) . '-' . Str::random(4),
                        'konten'      => $art['konten'] ?: $art['judul'],
                        'kategori'    => $art['kategori'] ?? 'Liputan/Berita',
                        'gambar'      => $art['gambar'] ?? 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png',
                        'link_sumber' => $art['link'] ?? null,
                        'guid'        => $art['guid'] ?? $art['link'] ?? null,
                        'is_external' => true,
                        'tanggal'     => $art['tanggal'] ?? date('Y-m-d'),
                        'views'       => rand(15, 60),
                        'aktif'       => 1,
                        'is_blurred'  => 0,
                    ]);
                } else {
                    // Update gambar atau tanggal jika belum ada
                    if (empty($existing->gambar) || str_contains($existing->gambar, 'ajax-loader')) {
                        $existing->gambar = $art['gambar'] ?? $existing->gambar;
                    }
                    if ($art['tanggal'] && $art['tanggal'] !== $existing->tanggal) {
                        $existing->tanggal = $art['tanggal'];
                    }
                    $existing->save();
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Quick news sync error: ' . $e->getMessage());
        }
    }

    /**
     * Normalisasi kategori artikel
     */
    protected function normalizeCategory(string $cat, string $title): string
    {
        $t = strtolower($title);
        $c = strtolower($cat);

        if (str_contains($c, 'karir') || str_contains($t, 'recruitment') || str_contains($t, 'lowongan') || str_contains($t, 'hiring') || str_contains($t, 'job') || str_contains($t, 'pemagangan')) {
            return 'Karir';
        }
        if (str_contains($c, 'pengumuman') || str_contains($t, 'pengumuman') || str_contains($t, 'sipencatar') || str_contains($t, 'daftar ulang') || str_contains($t, 'kelulusan')) {
            return 'Pengumuman';
        }
        if (str_contains($c, 'pendidikan') || str_contains($c, 'diklat') || str_contains($t, 'diklat') || str_contains($t, 'kuliah') || str_contains($t, 'akademik') || str_contains($t, 'kalibrasi')) {
            return 'Pendidikan';
        }
        if (str_contains($c, 'prestasi') || str_contains($t, 'juara') || str_contains($t, 'penghargaan') || str_contains($t, 'medali') || str_contains($t, 'meraih')) {
            return 'Prestasi';
        }
        if (str_contains($c, 'alumni') || str_contains($t, 'alumni') || str_contains($t, 'tracer study')) {
            return 'Alumni';
        }
        if (str_contains($c, 'seputar') || str_contains($t, 'upacara') || str_contains($t, 'kunjungan') || str_contains($t, 'donor darah') || str_contains($t, 'hut')) {
            return 'Seputar Kampus';
        }
        
        return 'Liputan/Berita';
    }

    /**
     * Sinkronisasi seluruh berita PKTJ.ac.id ke Database Lokal (phpMyAdmin)
     */
    public function syncToDatabase(): array
    {
        $articles = $this->fetchAllFromPktj();
        $newCount = 0;
        $updatedCount = 0;

        foreach ($articles as $art) {
            $guid = $art['guid'] ?? $art['link'];
            
            $existing = Berita::where('link_sumber', $art['link'])
                ->orWhere('guid', $guid)
                ->orWhere('judul', $art['judul'])
                ->first();

            if ($existing) {
                $existing->update([
                    'gambar'      => !empty($art['gambar']) ? $art['gambar'] : $existing->gambar,
                    'konten'      => !empty($art['konten']) ? $art['konten'] : $existing->konten,
                    'kategori'    => $art['kategori'],
                    'tanggal'     => $art['tanggal'],
                    'link_sumber' => $art['link'],
                    'guid'        => $guid,
                    'is_external' => true,
                    'aktif'       => 1,
                ]);
                $updatedCount++;
            } else {
                Berita::create([
                    'judul'       => $art['judul'],
                    'slug'        => $art['slug'] . '-' . Str::random(4),
                    'konten'      => $art['konten'] ?: $art['judul'],
                    'kategori'    => $art['kategori'],
                    'gambar'      => $art['gambar'],
                    'link_sumber' => $art['link'],
                    'guid'        => $guid,
                    'is_external' => true,
                    'tanggal'     => $art['tanggal'],
                    'views'       => rand(10, 50),
                    'aktif'       => 1,
                    'is_blurred'  => 0,
                ]);
                $newCount++;
            }
        }

        // Refresh semua cache
        Cache::forget('pktj_live_all_news_v5');
        Cache::forget('pktj_live_all_news_v4');
        Cache::forget('pktj_live_all_news_v3');

        return [
            'total_fetched' => count($articles),
            'new'           => $newCount,
            'updated'       => $updatedCount,
            'timestamp'     => now()->translatedFormat('d F Y H:i:s'),
        ];
    }

    /**
     * Bersihkan berita dummy
     */
    public function cleanDummyNews(): int
    {
        $dummyKeywords = ['patrick', 'dummy', 'lorem ipsum', 'test berita', 'testing', 'contoh berita'];
        
        $deleted = 0;
        foreach ($dummyKeywords as $keyword) {
            $deleted += Berita::where('is_external', false)
                ->where(function($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('konten', 'like', "%{$keyword}%")
                      ->orWhere('gambar', 'like', "%{$keyword}%");
                })
                ->delete();
        }

        return $deleted;
    }

    /**
     * Ambil dari database lokal
     */
    protected function fetchFromLocalDatabase(int $limit = 500): array
    {
        try {
            $beritas = Berita::where('aktif', true)
                ->orderBy('tanggal', 'desc')
                ->orderBy('created_at', 'desc')
                ->take($limit)
                ->get();

            return $beritas->map(function ($b) {
                $img = $b->gambar;
                if (!empty($img) && !str_starts_with($img, 'http')) {
                    $img = asset('storage/' . $img);
                }

                $tglObj = $b->tanggal ? Carbon::parse($b->tanggal) : Carbon::parse($b->created_at);

                return [
                    'judul'       => $b->judul,
                    'slug'        => $b->slug,
                    'link'        => $b->link_sumber ?: url('/berita/' . $b->slug),
                    'guid'        => $b->guid ?: $b->slug,
                    'gambar'      => $img ?: 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png',
                    'konten'      => strip_tags($b->konten ?? ''),
                    'ringkasan'   => Str::limit(strip_tags($b->konten ?? ''), 140),
                    'kategori'    => $b->kategori ?: 'Liputan/Berita',
                    'tanggal_raw' => $b->tanggal,
                    'tanggal'     => $tglObj->format('Y-m-d'),
                    'tanggal_f'   => $tglObj->translatedFormat('d F Y'),
                    'is_external' => (bool) $b->is_external,
                    'sumber'      => $b->is_external ? 'pktj.ac.id' : 'PPID PKTJ',
                ];
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Parse string tanggal ke Carbon
     */
    protected function parseIndonesianDate(?string $dateStr): ?Carbon
    {
        if (empty($dateStr)) return null;

        try {
            return Carbon::parse($dateStr);
        } catch (\Exception $e) {
            if (preg_match('/([0-9]{1,2})[\s\/-]([a-zA-Z]+|[0-9]{1,2})[\s\/-]([0-9]{4})/', $dateStr, $m)) {
                $day = (int)$m[1];
                $month = $m[2];
                $year = (int)$m[3];

                $months = [
                    'januari' => 1, 'jan' => 1, 'februari' => 2, 'feb' => 2,
                    'maret' => 3, 'mar' => 3, 'april' => 4, 'apr' => 4,
                    'mei' => 5, 'may' => 5, 'juni' => 6, 'jun' => 6,
                    'juli' => 7, 'jul' => 7, 'agustus' => 8, 'aug' => 8, 'agt' => 8,
                    'september' => 9, 'sep' => 9, 'oktober' => 10, 'oct' => 10, 'okt' => 10,
                    'november' => 11, 'nov' => 11, 'desember' => 12, 'dec' => 12, 'des' => 12
                ];

                $monthNum = is_numeric($month) ? (int)$month : ($months[strtolower($month)] ?? 1);
                return Carbon::createFromDate($year, $monthNum, $day);
            }
        }

        return null;
    }
}
