<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use App\Models\Peraturan;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ProfilPublikController extends Controller
{
    /**
     * Helper to process content and apply blur to embedded documents
     */
    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;

        // Append is_blurred=1 to any /preview-dokumen URLs in the content
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }

    public function showProfil()
    {
        $profil = ProfilPpid::where('type', 'profil')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
            $profil->gambaran = $this->processContent($profil->gambaran, $profil->is_blurred ?? false);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $profil->is_blurred ?? false);
                }
                $profil->additional_sections = $sections;
            }
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-ppid', compact('profil', 'settings'));
    }

    public function showTugas()
    {
        $profil = ProfilPpid::where('type', 'tugas')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $profil->is_blurred ?? false);
                }
                $profil->additional_sections = $sections;
            }
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-tugas-tanggung-jawab', compact('profil', 'settings'));
    }

    public function showVisi()
    {
        $profil = ProfilPpid::where('type', 'visi')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-visi-misi', compact('profil', 'settings'));
    }

    public function showStruktur()
    {
        $profil = ProfilPpid::where('type', 'struktur')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-struktur-organisasi', compact('profil', 'settings'));
    }

    public function showRegulasi(\Illuminate\Http\Request $request)
    {
        return app(RegulasiController::class)->publicIndex($request);
    }

    public function showKontak()
    {
        $profil = ProfilPpid::where('type', 'kontak')->first();
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $profil->is_blurred ?? false);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $profil->is_blurred ?? false);
        }
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-kontak', compact('profil', 'settings'));
    }

    public function submitKontak(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'captcha' => 'required|integer',
            'captcha_answer' => 'required|integer',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'judul.required' => 'Judul pesan wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        if (intval($request->captcha) !== intval($request->captcha_answer)) {
            return back()->withErrors(['captcha' => 'Jawaban Captcha tidak tepat. Silakan coba lagi.'])->withInput();
        }

        $pesan = \App\Models\PesanKontak::create($request->only(['nama', 'email', 'telepon', 'judul', 'pesan']));

        // Try sending email notification to Humas / Admin users
        try {
            $adminEmails = \App\Models\User::pluck('email')->filter()->toArray();
            if (!empty($adminEmails)) {
                $emailBody = "Yth. Tim Humas / Admin PPID PKTJ,\n\nAda Pesan Kontak / Pengaduan Baru dari Halaman Publik:\n\n"
                    . "Nama: {$pesan->nama}\n"
                    . "Email: {$pesan->email}\n"
                    . "Telepon: {$pesan->telepon}\n"
                    . "Judul: {$pesan->judul}\n"
                    . "Pesan:\n{$pesan->pesan}\n\n"
                    . "Silakan segera buka Admin Panel PPID PKTJ untuk memproses pesan ini.";

                \Illuminate\Support\Facades\Mail::raw($emailBody, function ($mail) use ($adminEmails, $pesan) {
                    $mail->to($adminEmails)
                        ->subject("[PPID PKTJ] NOTIFIKASI PESAN KONTAK BARU: {$pesan->judul}");
                });
            }
        } catch (\Exception $ex) {
            // Fail silently if mail server is unconfigured
        }

        return back()->with('success_message', 'Terima kasih! Pesan, saran, atau pengaduan Anda berhasil terkirim. Tim kami akan segera menindaklanjutinya.');
    }

    /**
     * Generic method for dynamic pages (SOP, Maklumat, Laporan)
     */
    public function showPage($type, $view = null)
    {
        $profil = ProfilPpid::where('type', $type)->first();
        $isBlurred = $profil->is_blurred ?? false;
        
        if ($profil) {
            $profil->konten_pembuka = $this->processContent($profil->konten_pembuka, $isBlurred);
            $profil->konten_detail = $this->processContent($profil->konten_detail, $isBlurred);
            $profil->gambaran = $this->processContent($profil->gambaran, $isBlurred);
            
            if ($profil->additional_sections) {
                $sections = $profil->additional_sections;
                foreach ($sections as &$section) {
                    $section['content'] = $this->processContent($section['content'], $isBlurred);
                }
                $profil->additional_sections = $sections;
            }
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();
        
        // Process dashboard fields if they contain previews
        $dashboardFields = ['isi_maklumat', 'isi_standar', 'isi_konten', 'isi_laporan', 'ringkasan_eksekutif'];
        $pfx = str_replace('-', '_', $type);
        foreach ($dashboardFields as $field) {
            $key = $pfx . '_' . $field;
            if (isset($settings[$key])) {
                $settings[$key] = $this->processContent($settings[$key], $isBlurred);
            }
        }
        
        // If view is not provided, try to find a matching view or use a default
        $viewName = $view ?? $type;
        
        // Special case: Daftar Informasi Publik needs all info types
        $extraData = [];
        if ($type === 'layanan-daftar') {
            $query = \App\Models\DaftarInformasi::where('aktif', true);
            
            // Search filters
            if (request('informasi')) {
                $query->where('judul_informasi', 'like', '%' . request('informasi') . '%');
            }
            if (request('ringkasan')) {
                $query->where('isi_informasi', 'like', '%' . request('ringkasan') . '%');
            }
            if (request('tahun')) {
                $query->where('waktu_pembuatan', 'like', '%' . request('tahun') . '%');
            }
            if (request('penanggung_jawab')) {
                $query->where('penanggung_jawab', 'like', '%' . request('penanggung_jawab') . '%');
            }

            // Category filter
            if (request('kategori')) {
                $query->where('kategori', request('kategori'));
            }

            $items = $query
                ->orderByRaw("
                    CASE 
                        WHEN waktu_pembuatan IS NULL OR TRIM(waktu_pembuatan) = '' THEN 0 
                        WHEN TRIM(waktu_pembuatan) REGEXP '^[0-9]{4}-[0-9]{2}' THEN CAST(LEFT(TRIM(waktu_pembuatan), 4) AS UNSIGNED)
                        WHEN TRIM(waktu_pembuatan) REGEXP '[0-9]{4}$' THEN CAST(RIGHT(TRIM(waktu_pembuatan), 4) AS UNSIGNED)
                        WHEN CAST(TRIM(waktu_pembuatan) AS UNSIGNED) > 1900 THEN CAST(TRIM(waktu_pembuatan) AS UNSIGNED)
                        ELSE 1
                    END DESC
                ")
                ->orderBy('id', 'desc')
                ->paginate(20)
                ->withQueryString();
            
            // Apply Premium Blur to Ringkasan Informasi (isi_informasi)
            foreach ($items as $di_item) {
                if ($di_item->isi_informasi) {
                    $di_item->isi_informasi = $this->processContent($di_item->isi_informasi, $di_item->is_blurred ?? false);
                }
            }
            
            $extraData['items'] = $items;
            
            // Get available years for dropdown sorted by extracted year descending
            $extraData['years'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(waktu_pembuatan) as tahun')
                ->where('aktif', true)
                ->whereNotNull('waktu_pembuatan')
                ->whereRaw('TRIM(waktu_pembuatan) != ""')
                ->orderByRaw("
                    CASE 
                        WHEN TRIM(waktu_pembuatan) REGEXP '^[0-9]{4}-[0-9]{2}' THEN CAST(LEFT(TRIM(waktu_pembuatan), 4) AS UNSIGNED)
                        WHEN TRIM(waktu_pembuatan) REGEXP '[0-9]{4}$' THEN CAST(RIGHT(TRIM(waktu_pembuatan), 4) AS UNSIGNED)
                        WHEN CAST(TRIM(waktu_pembuatan) AS UNSIGNED) > 1900 THEN CAST(TRIM(waktu_pembuatan) AS UNSIGNED)
                        ELSE 0
                    END DESC
                ")
                ->pluck('tahun');

            // Get available units for dropdown
            $extraData['units'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(penanggung_jawab) as unit')
                ->where('aktif', true)
                ->whereNotNull('penanggung_jawab')
                ->orderBy('unit', 'asc')
                ->pluck('unit');
        }

        // Fetch reports dynamically based on type
        $useTanggal = false;
        try {
            $useTanggal = \Illuminate\Support\Facades\Schema::hasColumn('dokumens', 'tanggal');
        } catch (\Exception $e) {
            // Fallback safely if database is offline or schema cannot be queried
        }

        $sopCategoryMap = [
            'sop_permintaan' => 'SOP Permintaan Informasi Publik',
            'sop_keberatan' => 'SOP Penanganan Keberatan',
            'sop_sengketa' => 'SOP Pengajuan Sengketa Informasi Publik',
            'sop_penetapan' => 'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik',
            'sop_pengujian' => 'SOP Pengujian Konsekuensi',
            'sop_pendokumentasian' => 'SOP Pendokumentasian Informasi Publik',
        ];

        if (isset($sopCategoryMap[$type])) {
            $catName = $sopCategoryMap[$type];
            $query = \App\Models\Dokumen::where('kategori', $catName)->where('aktif', true);
            $extraData['laporan'] = $useTanggal 
                ? $query->orderByRaw('COALESCE(tanggal, created_at) DESC')->get()
                : $query->orderBy('created_at', 'desc')->get();
        }

        if ($type === 'laporan-layanan' || $type === 'laporan_layanan') {
            $query = \App\Models\Dokumen::where('kategori', 'Laporan Layanan')->where('aktif', true);
            $rawLaporan = $useTanggal 
                ? $query->orderByRaw('COALESCE(tanggal, created_at) DESC')->get()
                : $query->orderBy('created_at', 'desc')->get();
            $extraData['laporan'] = $rawLaporan->filter(function($doc) {
                return !empty($doc->file_path) && function_exists('has_valid_document') && has_valid_document($doc->file_path);
            })->values();
        } elseif ($type === 'laporan-akses' || $type === 'laporan_akses') {
            $query = \App\Models\Dokumen::where('kategori', 'Laporan Akses')->where('aktif', true);
            $rawAkses = $useTanggal 
                ? $query->orderByRaw('COALESCE(tanggal, created_at) DESC')->get()
                : $query->orderBy('created_at', 'desc')->get();
            $extraData['laporan'] = $rawAkses->filter(function($doc) {
                return !empty($doc->file_path) && function_exists('has_valid_document') && has_valid_document($doc->file_path);
            })->values();

            // Aggregations for Laporan Akses Visualizations
            $dbYears = collect();
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('permohonan')) {
                    $dbYears = \App\Models\Permohonan::selectRaw('YEAR(tanggal_permohonan) as year')
                        ->whereNotNull('tanggal_permohonan')
                        ->distinct()
                        ->pluck('year');
                }
            } catch (\Exception $e) {
                // Ignore
            }
            
            if ($dbYears->isEmpty()) {
                $dbYears = collect([2024, date('Y')]);
            }
            $available_years = $dbYears->unique()->sortDesc()->values();
            
            $selectedYear = request('filter_year', $available_years->first());
            
            $monthlyData = [];
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            $totalYearly = 0;
            $ditindaklanjuti = 0;
            $perorangan = 0;
            $kelompok = 0;
            $badanHukum = 0;
            $medsos = 0;
            $website = 0;
            
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('permohonan')) {
                    foreach (range(1, 12) as $m) {
                        $mQuery = \App\Models\Permohonan::whereYear('tanggal_permohonan', $selectedYear)->whereMonth('tanggal_permohonan', $m);
                        
                        $total = (clone $mQuery)->count();
                        $diterima = (clone $mQuery)->where('status', 'selesai')->count();
                        $ditolak = (clone $mQuery)->where('status', 'ditolak')->count();
                        
                        $monthlyData[] = [
                            'bulan' => $months[$m - 1],
                            'total' => $total,
                            'diterima' => $diterima,
                            'ditolak' => $ditolak
                        ];
                    }
                    
                    $totalYearly = \App\Models\Permohonan::whereYear('tanggal_permohonan', $selectedYear)->count();
                    $ditindaklanjuti = \App\Models\Permohonan::whereYear('tanggal_permohonan', $selectedYear)
                        ->whereIn('status', ['diproses', 'selesai', 'ditolak'])->count();
                    
                    $allYearly = \App\Models\Permohonan::whereYear('tanggal_permohonan', $selectedYear)->get();
                    foreach ($allYearly as $p) {
                        $cat = 'Perorangan';
                        if ($p->custom_fields_data) {
                            $cData = is_array($p->custom_fields_data) ? $p->custom_fields_data : json_decode($p->custom_fields_data, true);
                            $cat = $cData['jenis_pemohon'] ?? 'Perorangan';
                        }
                        
                        if (stripos($cat, 'Perorangan') !== false) {
                            $perorangan++;
                        } elseif (stripos($cat, 'Badan Hukum') !== false) {
                            $badanHukum++;
                        } else {
                            $kelompok++;
                        }
                        
                        $met = 'E-PPID/Website';
                        if ($p->custom_fields_data) {
                            $cData = is_array($p->custom_fields_data) ? $p->custom_fields_data : json_decode($p->custom_fields_data, true);
                            $met = $cData['metode'] ?? ($cData['cara_mendapatkan'] ?? 'E-PPID/Website');
                        }
                        
                        if (stripos($met, 'Medsos') !== false || stripos($met, 'Media Sosial') !== false) {
                            $medsos++;
                        } else {
                            $website++;
                        }
                    }
                }
            } catch (\Exception $e) {
                // Keep defaults if table doesn't exist
            }
            
            if (empty($monthlyData)) {
                foreach ($months as $mName) {
                    $monthlyData[] = ['bulan' => $mName, 'total' => 0, 'diterima' => 0, 'ditolak' => 0];
                }
            }
            
            $belum_ditindaklanjuti = max(0, $totalYearly - $ditindaklanjuti);
            
            // Dynamic realtime overrides from Admin Settings (tabel dashboards)
            $overrideTotal = $settings['laporan_akses_total_permohonan'] ?? null;
            $overrideDitindaklanjuti = $settings['laporan_akses_ditindaklanjuti'] ?? null;
            $overrideDalamProses = $settings['laporan_akses_dalam_proses'] ?? null;
            $overrideRataRataHari = $settings['laporan_akses_rata_rata_hari'] ?? '5 - 7';
            
            $overridePerorangan = $settings['laporan_akses_cat_perorangan'] ?? null;
            $overrideKelompok = $settings['laporan_akses_cat_kelompok'] ?? null;
            $overrideBadanHukum = $settings['laporan_akses_cat_badan_hukum'] ?? null;
            
            $overrideMedsos = $settings['laporan_akses_channel_medsos'] ?? null;
            $overrideWebsite = $settings['laporan_akses_channel_website'] ?? null;

            if ($overrideTotal !== null && trim($overrideTotal) !== '') {
                $totalYearly = (int)$overrideTotal;
            }
            if ($overrideDitindaklanjuti !== null && trim($overrideDitindaklanjuti) !== '') {
                $ditindaklanjuti = (int)$overrideDitindaklanjuti;
            }
            if ($overrideDalamProses !== null && trim($overrideDalamProses) !== '') {
                $belum_ditindaklanjuti = (int)$overrideDalamProses;
            }

            if ($overridePerorangan !== null && trim($overridePerorangan) !== '') $perorangan = (int)$overridePerorangan;
            if ($overrideKelompok !== null && trim($overrideKelompok) !== '') $kelompok = (int)$overrideKelompok;
            if ($overrideBadanHukum !== null && trim($overrideBadanHukum) !== '') $badanHukum = (int)$overrideBadanHukum;

            if ($overrideMedsos !== null && trim($overrideMedsos) !== '') $medsos = (int)$overrideMedsos;
            if ($overrideWebsite !== null && trim($overrideWebsite) !== '') $website = (int)$overrideWebsite;

            $extraData['available_years'] = $available_years;
            $extraData['selectedYear'] = $selectedYear;
            $extraData['monthlyData'] = $monthlyData;
            $extraData['totalYearly'] = $totalYearly;
            $extraData['ditindaklanjuti'] = $ditindaklanjuti;
            $extraData['belum_ditindaklanjuti'] = $belum_ditindaklanjuti;
            $extraData['rata_rata_hari'] = $overrideRataRataHari;
            $extraData['categories'] = [
                'perorangan' => $perorangan,
                'kelompok' => $kelompok,
                'badan_hukum' => $badanHukum
            ];
            $extraData['channels'] = [
                'medsos' => $medsos,
                'website' => $website
            ];
        } elseif ($type === 'laporan-survey') {
            $query = \App\Models\Dokumen::where('kategori', 'Laporan Survey')->where('aktif', true);
            $extraData['laporan'] = $useTanggal 
                ? $query->orderByRaw('COALESCE(tanggal, created_at) DESC')->get()
                : $query->orderBy('created_at', 'desc')->get();
        }

        // Check if view exists, otherwise use a generic skeleton
        if (!view()->exists($viewName)) {
            $viewName = str_replace('-', '_', $viewName);
            if (!view()->exists($viewName)) {
                return view('profil-ppid', array_merge(compact('profil', 'settings'), $extraData));
            }
        }

        return view($viewName, array_merge(compact('profil', 'settings'), $extraData));
    }

    /**
     * Preview Document in-page
     */
    public function previewDokumen(\Illuminate\Http\Request $request)
    {
        $file_path = $request->query('file');
        $title = $request->query('title');

        if (!$file_path) {
            abort(404, 'File path is required');
        }

        // Search for is_blurred flag
        $isBlurred = false;
        $blurredPages = $request->query('blurred_pages', '');
        
        // 1. Priority: Explicit flag from request (used by TinyMCE button)
        if ($request->has('is_blurred')) {
            $isBlurred = $request->query('is_blurred') == '1';
        } else {
            // 2. Secondary: Check database based on file path
            // Handle both with and without 'storage/' prefix for matching
            $pathWithStorage = str_starts_with($file_path, 'storage/') ? $file_path : 'storage/' . $file_path;
            $pathWithoutStorage = str_replace('storage/', '', $file_path);
            
            $di = \App\Models\DaftarInformasi::where('file_informasi', $pathWithStorage)
                ->orWhere('file_informasi', $pathWithoutStorage)
                ->orWhere('image', $pathWithStorage)
                ->orWhere('image', $pathWithoutStorage)
                ->first();

            if ($di) {
                $isBlurred = (bool)$di->is_blurred;
            } else {
                $dok = \App\Models\Dokumen::where('file_path', $pathWithoutStorage)
                    ->orWhere('file_path', $file_path)
                    ->first();
                if ($dok) {
                    $isBlurred = (bool)$dok->is_blurred;
                }
            }
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();

        return view('preview-dokumen', compact('file_path', 'title', 'settings', 'isBlurred', 'blurredPages'));
    }

    /**
     * Proxy to fetch GDrive file and serve it with proper CORS/PDF headers
     */
    public function proxyGdrive($id)
    {
        $isDownload = request()->has('download') || request()->query('dl') == '1';

        // Instant Download Redirect: Fast, zero-server-delay download!
        if ($isDownload) {
            return redirect("https://drive.google.com/uc?export=download&confirm=no_antivirus&id={$id}");
        }

        $disposition = 'inline; filename="Dokumen_PPID_PKTJ.pdf"';

        $urls = [
            "https://drive.google.com/uc?export=download&confirm=no_antivirus&id={$id}",
            "https://drive.google.com/uc?id={$id}&export=download",
            "https://docs.google.com/document/d/{$id}/export?format=pdf",
            "https://docs.google.com/spreadsheets/d/{$id}/export?format=pdf",
            "https://docs.google.com/presentation/d/{$id}/export?format=pdf"
        ];

        foreach ($urls as $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4); // Fast 4-second timeout per attempt
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
            
            $body = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);

            if ($body !== false && $info['http_code'] === 200) {
                $contentType = strtolower($info['content_type'] ?? '');
                $isPdfHeader = strpos($body, '%PDF-') === 0;

                if (strpos($contentType, 'application/pdf') !== false || 
                    (strpos($contentType, 'application/octet-stream') !== false && $isPdfHeader) ||
                    $isPdfHeader) {
                    
                    return response($body, 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => $disposition,
                        'Cache-Control' => 'public, max-age=86400'
                    ]);
                }
            }
        }

        // Fast fallback to Google Drive viewer
        return redirect("https://drive.google.com/file/d/{$id}/preview");
    }

    /**
     * View PDF peraturan (Premium Blur)
     */
    public function viewPeraturan($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        return view('preview-dokumen', [
            'file' => 'storage/' . $peraturan->file_path,
            'title' => $peraturan->judul,
            'is_blurred' => 0 // Peraturan biasanya tidak blur
        ]);
    }
}
