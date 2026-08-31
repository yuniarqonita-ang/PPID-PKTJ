<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiDikecualikan;
use App\Models\Peraturan;
use App\Models\DaftarInformasi;
use App\Models\Berita;
use App\Models\Dashboard;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    /**
     * AJAX search endpoint for live search in top navigation spotlight modal
     */
    public function searchApi(Request $request)
    {
        $q = trim($request->input('q', ''));
        if (strlen($q) < 2) {
            return response()->json([
                'success' => true,
                'total' => 0,
                'results' => []
            ]);
        }

        $results = $this->performSearch($q);
        
        return response()->json([
            'success' => true,
            'query' => $q,
            'total' => count($results),
            'results' => array_slice($results, 0, 15) // Top 15 live results
        ]);
    }

    /**
     * Dedicated Search Results Page (/pencarian?q=...)
     */
    public function searchPage(Request $request)
    {
        $q = trim($request->input('q', ''));
        $kategori = $request->input('kategori', 'all');

        $allResults = $q ? $this->performSearch($q) : [];

        // Filter by category if specified
        if ($kategori !== 'all') {
            $filteredResults = array_filter($allResults, function($item) use ($kategori) {
                return $item['kategori_group'] === $kategori;
            });
        } else {
            $filteredResults = $allResults;
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();

        return view('pencarian', [
            'q' => $q,
            'kategori' => $kategori,
            'total' => count($allResults),
            'results' => $filteredResults,
            'settings' => $settings
        ]);
    }

    /**
     * Helper to search across all public models and static resources
     */
    private function performSearch(string $q): array
    {
        $results = [];

        // 1. INFORMASI BERKALA
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('informasi_berkalas')) {
                $items = InformasiBerkala::where('aktif', true)
                    ->where(function($w) use ($q) {
                        $w->where('judul', 'like', "%{$q}%")
                          ->orWhere('deskripsi', 'like', "%{$q}%")
                          ->orWhere('kategori', 'like', "%{$q}%")
                          ->orWhere('tahun', 'like', "%{$q}%");
                    })
                    ->take(10)->get();

                foreach ($items as $item) {
                    $results[] = [
                        'title' => $item->judul,
                        'desc' => Str::limit(strip_tags($item->deskripsi ?? ''), 130),
                        'category' => 'Informasi Berkala',
                        'kategori_group' => 'berkala',
                        'badge_color' => 'primary',
                        'icon' => 'fas fa-newspaper',
                        'year' => $item->tahun ?? date('Y'),
                        'url' => route('informasi.berkala'),
                        'download_url' => $item->file_path ? asset($item->file_path) : null,
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 2. INFORMASI SETIAP SAAT
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('informasi_setiapsaats')) {
                $items = InformasiSetiapSaat::where('aktif', true)
                    ->where(function($w) use ($q) {
                        $w->where('judul', 'like', "%{$q}%")
                          ->orWhere('deskripsi', 'like', "%{$q}%");
                    })
                    ->take(10)->get();

                foreach ($items as $item) {
                    $results[] = [
                        'title' => $item->judul,
                        'desc' => Str::limit(strip_tags($item->deskripsi ?? ''), 130),
                        'category' => 'Informasi Setiap Saat',
                        'kategori_group' => 'setiapsaat',
                        'badge_color' => 'success',
                        'icon' => 'fas fa-folder-open',
                        'year' => $item->tanggal ? date('Y', strtotime($item->tanggal)) : date('Y'),
                        'url' => route('informasi.setiapsaat'),
                        'download_url' => $item->file_path ? asset($item->file_path) : null,
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 3. INFORMASI SERTA MERTA
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('informasi_serta_mertas')) {
                $items = InformasiSertaMerta::where('aktif', true)
                    ->where(function($w) use ($q) {
                        $w->where('judul', 'like', "%{$q}%")
                          ->orWhere('deskripsi', 'like', "%{$q}%")
                          ->orWhere('kategori', 'like', "%{$q}%");
                    })
                    ->take(10)->get();

                foreach ($items as $item) {
                    $results[] = [
                        'title' => $item->judul,
                        'desc' => Str::limit(strip_tags($item->deskripsi ?? ''), 130),
                        'category' => 'Informasi Serta Merta',
                        'kategori_group' => 'sertamerta',
                        'badge_color' => 'danger',
                        'icon' => 'fas fa-bullhorn',
                        'year' => $item->tahun ?? date('Y'),
                        'url' => route('informasi.sertamerta'),
                        'download_url' => $item->file_path ? asset($item->file_path) : null,
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 4. REGULASI & DASAR HUKUM
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('peraturans')) {
                $items = Peraturan::where('is_active', true)
                    ->where(function($w) use ($q) {
                        $w->where('judul', 'like', "%{$q}%")
                          ->orWhere('nomor', 'like', "%{$q}%")
                          ->orWhere('deskripsi', 'like', "%{$q}%")
                          ->orWhere('kategori', 'like', "%{$q}%")
                          ->orWhere('tahun', 'like', "%{$q}%");
                    })
                    ->take(10)->get();

                foreach ($items as $item) {
                    $results[] = [
                        'title' => $item->judul,
                        'desc' => ($item->nomor ? "[{$item->nomor}] " : '') . Str::limit(strip_tags($item->deskripsi ?? ''), 120),
                        'category' => 'Regulasi (' . ($item->kategori ?? 'Umum') . ')',
                        'kategori_group' => 'regulasi',
                        'badge_color' => 'warning',
                        'icon' => 'fas fa-balance-scale',
                        'year' => $item->tahun ?? 2024,
                        'url' => route('regulasi.public'),
                        'download_url' => $item->file_path ? asset($item->file_path) : ($item->link_download ?? null),
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 5. LAYANAN BRAILLE & INKLUSIF (Indikator I)
        $brailleKeywords = ['brail', 'braile', 'braille', 'tuna netra', 'netra', 'disabilitas', 'difabel', 'bisindo', 'isyarat', 'inklusif', 'inovasi'];
        $isBrailleMatch = false;
        foreach ($brailleKeywords as $bk) {
            if (stripos($q, $bk) !== false) {
                $isBrailleMatch = true;
                break;
            }
        }

        if ($isBrailleMatch) {
            $results[] = [
                'title' => 'Formulir Permohonan Informasi Publik Huruf Braille (Disabilitas Netra)',
                'desc' => 'Format cetak khusus huruf Braille dan formulir permohonan informasi publik bagi pemohon disabilitas sensorik netra.',
                'category' => 'Layanan Inklusif (Braille)',
                'kategori_group' => 'disabilitas',
                'badge_color' => 'info',
                'icon' => 'fas fa-braille',
                'year' => '2025',
                'url' => route('home'),
                'download_url' => asset('storage/dokumen/FORMULIR_PERMOHONAN_BRAILE.pdf'),
            ];
            $results[] = [
                'title' => 'Formulir Pernyataan Keberatan Layanan Informasi Huruf Braille',
                'desc' => 'Formulir pengajuan keberatan layanan informasi publik format huruf Braille bagi penyandang disabilitas.',
                'category' => 'Layanan Inklusif (Braille)',
                'kategori_group' => 'disabilitas',
                'badge_color' => 'info',
                'icon' => 'fas fa-braille',
                'year' => '2025',
                'url' => route('home'),
                'download_url' => asset('storage/dokumen/PERNYATAAN_KEBERATAN_BRAILE.pdf'),
            ];
            $results[] = [
                'title' => 'Laporan Inovasi & Standar Pelayanan Inklusif Disabilitas PPID PKTJ',
                'desc' => 'Dokumentasi inovasi sarana prasarana ramah disabilitas (Meja Layanan Fisik, Audio TTS, Bisindo, Braille).',
                'category' => 'Inovasi Pelayanan',
                'kategori_group' => 'disabilitas',
                'badge_color' => 'info',
                'icon' => 'fas fa-universal-access',
                'year' => '2025',
                'url' => route('home'),
                'download_url' => asset('storage/dokumen/Inovasi_PPID.docx'),
            ];
        }

        // 6. BERITA & ARTIKEL
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('beritas')) {
                $items = Berita::where('aktif', true)
                    ->where(function($w) use ($q) {
                        $w->where('judul', 'like', "%{$q}%")
                          ->orWhere('konten', 'like', "%{$q}%");
                    })
                    ->take(5)->get();

                foreach ($items as $item) {
                    $results[] = [
                        'title' => $item->judul,
                        'desc' => Str::limit(strip_tags($item->konten ?? ''), 130),
                        'category' => 'Berita & Artikel',
                        'kategori_group' => 'berita',
                        'badge_color' => 'secondary',
                        'icon' => 'fas fa-newspaper',
                        'year' => $item->tanggal ? date('Y', strtotime($item->tanggal)) : date('Y'),
                        'url' => route('berita.detail', $item->slug ?? $item->id),
                        'download_url' => null,
                    ];
                }
            }
        } catch (\Throwable $e) {}

        return $results;
    }
}
