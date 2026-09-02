<?php

if (!function_exists('has_valid_document')) {
    function has_valid_document($file_path) {
        if (!$file_path || !is_string($file_path)) {
            return false;
        }

        $clean = trim($file_path);
        if ($clean === '' || $clean === '#' || $clean === '-' || in_array(strtolower($clean), ['null', 'tidak ada', 'tanpa preview', 'n/a', 'none', 'undefined', 'javascript:void(0)', '#!'])) {
            return false;
        }

        // Web URLs (Google Drive, Cloud links, etc.)
        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return true;
        }

        // Must have a valid document / media file extension
        $parsedUrl = parse_url($clean);
        $cleanPath = $parsedUrl['path'] ?? $clean;
        $extension = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
        
        $validExtensions = [
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 
            'jpg', 'jpeg', 'png', 'webp', 'gif', 'zip', 'rar', 'csv'
        ];

        return in_array($extension, $validExtensions);
    }
}

if (!function_exists('is_previewable')) {
    function is_previewable($file_path) {
        if (!has_valid_document($file_path)) {
            return false;
        }
        
        // Check if Google Drive/Docs link
        if (str_contains($file_path, 'drive.google.com') || str_contains($file_path, 'docs.google.com')) {
            return true;
        }

        // Parse path to ignore query parameters
        $parsedUrl = parse_url($file_path);
        $path = $parsedUrl['path'] ?? $file_path;
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        $previewableExtensions = [
            'pdf', 'jpg', 'jpeg', 'png', 'webp', 'gif',
            'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'
        ];
        
        return in_array($extension, $previewableExtensions);
    }
}

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProsedurController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InformasiPublikController;
use App\Http\Controllers\InformasiBerkalaController;
use App\Http\Controllers\AgendaController;
use App\Models\Visitor;
use App\Http\Controllers\ProfilPublikController;
use App\Http\Controllers\ProfilPpidController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InformasiSertaMertaController;
use App\Http\Controllers\InformasiSetiapSaatController;
use App\Http\Controllers\InformasiDikecualikanController;
use App\Http\Controllers\HalamanCustomController;

// ==========================================
// 0. REDIRECT URL LAMA (.html) & EXTERNAL
// ==========================================
Route::redirect('/jdih', 'https://bpsdm.kemenhub.go.id/jdih/');
Route::redirect('/layanan-informasi/jdih', 'https://bpsdm.kemenhub.go.id/jdih/');
Route::redirect('/daftar-informasi-publik.html', '/layanan-informasi/daftar');
Route::redirect('/informasi-berkala.html', '/informasi-publik/berkala');
Route::redirect('/informasi-dikecualikan.html', '/informasi-publik/dikecualikan');
Route::redirect('/informasi-serta-merta.html', '/informasi-publik/serta-merta');
Route::redirect('/informasi-setiap-saat.html', '/informasi-publik/setiap-saat');
Route::redirect('/laporan-akses-informasi-publik.html', '/layanan-informasi/laporan-akses');
Route::redirect('/laporan-layanan-informasi.html', '/layanan-informasi/laporan');
Route::redirect('/laporan-survey-kepuasan.html', '/layanan-informasi/laporan-survey');
Route::redirect('/maklumat-pelayanan.html', '/layanan-informasi/maklumat');
Route::redirect('/sop-penanganan-keberatan.html', '/prosedur/sop-keberatan');
Route::redirect('/sop-pendokumentasian.html', '/prosedur/sop-pendokumentasian');
Route::redirect('/sop-pengajuan-sengketa.html', '/prosedur/sop-sengketa');
Route::redirect('/sop-pengujian-konsekuensi.html', '/prosedur/sop-pengujian');
Route::redirect('/sop-permintaan-informasi.html', '/prosedur/sop-permintaan');
Route::redirect('/faq.html', '/faq');
Route::redirect('/permohonan-informasi.html', '/permohonan-informasi');

// ==========================================
// 1. FRONT OFFICE
// ==========================================
Route::get('/', function () { 
    try {
        $dokumen = collect([]);
        if (\Illuminate\Support\Facades\Schema::hasTable('dokumens')) {
            $dokumen = \App\Models\Dokumen::where('aktif', true)->latest()->take(6)->get();
        }
        
        $artikel = collect([]);
        try {
            $newsService = app(\App\Services\PktjNewsService::class);
            $liveNews = $newsService->getLiveNews(6);
            $artikel = collect($liveNews);
        } catch (\Throwable $ex) {
            if (\Illuminate\Support\Facades\Schema::hasTable('beritas')) {
                $query = \App\Models\Berita::where('aktif', true);
                if (\Illuminate\Support\Facades\Schema::hasColumn('beritas', 'tanggal')) {
                    $query->orderBy('tanggal', 'desc');
                }
                $artikel = $query->orderBy('created_at', 'desc')->take(6)->get();
            }
        }
        
        return view('welcome', compact('dokumen', 'artikel')); 
    } catch (\Exception $e) {
        $dokumen = collect([]);
        $artikel = collect([]);
        return view('welcome', compact('dokumen', 'artikel'));
    }
})->name('home');

// Track visitor (fail-safe)
try {
    if (\Illuminate\Support\Facades\Schema::hasTable('visitors')) {
        \App\Models\Visitor::firstOrCreate([
            'ip' => request()->ip(),
            'tanggal' => date('Y-m-d')
        ], [
            'user_agent' => request()->userAgent()
        ]);
    }
} catch (\Throwable $e) {
    // Fail silently to prevent site crash if DB issue
}

// Profil Publik
Route::get('/profil', [ProfilPpidController::class, 'showPublic'])->name('profil.public');

// Permohonan Informasi Routes (Dialihkan langsung ke portal permohonan BPSDMP PKTJ Tegal atau link yang diatur di Admin)
Route::get('/permohonan-informasi', function() {
    $url = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
    return redirect()->away($url);
})->name('permohonan.gateway');

Route::get('/permohonan', function() {
    $url = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
    return redirect()->away($url);
})->name('permohonan.form');

Route::get('/permohonan-informasi.html', function() {
    $url = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
    return redirect()->away($url);
});

Route::get('/permohonan/isi', function() {
    $url = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
    return redirect()->away($url);
})->name('permohonan.create');
Route::post('/permohonan/kirim', [\App\Http\Controllers\PermohonanController::class, 'store'])->name('permohonan.store');

// Pencarian Global (Search)
Route::get('/pencarian', [\App\Http\Controllers\GlobalSearchController::class, 'searchPage'])->name('pencarian.public');
Route::get('/api/global-search', [\App\Http\Controllers\GlobalSearchController::class, 'searchApi'])->name('api.global.search');

// Dokumentasi (Public)
Route::get('/dokumen', [DokumenController::class, 'publicList'])->name('dokumen.public');
Route::get('/dokumen/{id}/view', [DokumenController::class, 'view'])->name('dokumen.view');
Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])->name('dokumen.download');

// Profil PPID (Public - Dynamic from Database matching the original HTML links)
Route::get('/profil-ppid.html', [\App\Http\Controllers\ProfilPublikController::class, 'showProfil'])->name('profil.ppid.html');
Route::get('/profil-pejabat.html', [\App\Http\Controllers\InformasiPublikController::class, 'profilPejabat'])->name('profil.pejabat.html');
Route::get('/profil/pejabat', [\App\Http\Controllers\InformasiPublikController::class, 'profilPejabat'])->name('profil.pejabat');
// Tugas & Fungsi PPID Routes (URL Baru Bersih & Redirect Otomatis)
Route::get('/profil-tugas-dan-fungsi-ppid.html', [\App\Http\Controllers\ProfilPublikController::class, 'showTugas'])->name('profil.tugas-fungsi.html');
Route::get('/profil/tugas-dan-fungsi-ppid', [\App\Http\Controllers\ProfilPublikController::class, 'showTugas'])->name('profil.tugas-dan-fungsi-ppid');
Route::get('/tugas-dan-fungsi-ppid', [\App\Http\Controllers\ProfilPublikController::class, 'showTugas'])->name('tugas-dan-fungsi-ppid');
Route::get('/profil-tugas-tanggung-jawab.html', function() { return redirect('/profil/tugas-dan-fungsi-ppid', 301); })->name('profil.tugas.html');
Route::get('/profil-tugas-fungsi.html', function() { return redirect('/profil/tugas-dan-fungsi-ppid', 301); });
Route::get('/profil-visi-misi.html', [\App\Http\Controllers\ProfilPublikController::class, 'showVisi'])->name('profil.visi.html');
Route::get('/profil-struktur-organisasi.html', [\App\Http\Controllers\ProfilPublikController::class, 'showStruktur'])->name('profil.struktur.html');
Route::get('/profil-regulasi.html', [\App\Http\Controllers\RegulasiController::class, 'publicIndex'])->name('profil.regulasi.html');
Route::get('/regulasi', [\App\Http\Controllers\RegulasiController::class, 'publicIndex'])->name('regulasi');
Route::get('/profil-kontak.html', [\App\Http\Controllers\ProfilPublikController::class, 'showKontak'])->name('profil.kontak.html');

// Informasi Publik (Public - Dynamic from Controller)
Route::name('informasi.')->prefix('informasi-publik')->group(function () {
    Route::get('/berkala', [InformasiPublikController::class, 'informasiBerkala'])->name('berkala');
    Route::get('/serta-merta', [InformasiPublikController::class, 'informasiSertamerta'])->name('serta-merta');
    Route::get('/setiap-saat', [InformasiPublikController::class, 'informasiSetiapsaat'])->name('setiap-saat');
    Route::get('/dikecualikan', [InformasiPublikController::class, 'informasiDikecualikan'])->name('dikecualikan');
});

Route::get('/layanan-informasi/daftar', [ProfilPublikController::class, 'showPage'])->defaults('type', 'layanan-daftar')->defaults('view', 'daftar-informasi-publik')->name('layanan.daftar-informasi');
Route::get('/layanan-informasi/maklumat', [ProfilPublikController::class, 'showPage'])->defaults('type', 'maklumat-pelayanan')->defaults('view', 'maklumat-pelayanan')->name('layanan.maklumat-pelayanan');
Route::get('/layanan-informasi/laporan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'laporan-layanan')->defaults('view', 'laporan-layanan-informasi')->name('layanan.laporan-layanan');
Route::get('/layanan-informasi/laporan-akses', [ProfilPublikController::class, 'showPage'])->defaults('type', 'laporan-akses')->defaults('view', 'laporan-akses-informasi-publik')->name('layanan.laporan-akses');
Route::get('/layanan-informasi/laporan-survey', [\App\Http\Controllers\SurveyController::class, 'index'])->name('layanan.laporan-survey');
Route::get('/survey-kepuasan', [\App\Http\Controllers\SurveyController::class, 'index'])->name('survey.index');
Route::post('/survey/store', [\App\Http\Controllers\SurveyController::class, 'store'])->name('survey.store');
Route::get('/survey/check-registrasi', [\App\Http\Controllers\SurveyController::class, 'checkRegistrasi'])->name('survey.check-registrasi');

// Dynamic public pages from custom menus
Route::get('/halaman/{slug}', [\App\Http\Controllers\HalamanCustomController::class, 'showDynamicPage'])->name('halaman.dynamic');


// ==========================================
// 2. AUTH SYSTEM (LOGIN, REGISTER, SSO & LOGOUT)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

Route::get('/auth/google', [LoginController::class, 'googleLogin'])->name('auth.google');
Route::post('/auth/google', [LoginController::class, 'handleGoogleLogin'])->name('auth.google.post');
Route::post('/auth/google/callback', [LoginController::class, 'handleGoogleLogin']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleLogin']);
Route::get('/auth/sso-kemenhub', [LoginController::class, 'ssoKemenhub'])->name('auth.sso-kemenhub');

// Logout dibuat fleksibel agar tidak error di app.blade maupun dashboard.blade
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// ==========================================
// USER DASHBOARD (PEMOHON INFORMASI)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profile', [\App\Http\Controllers\UserDashboardController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile', [\App\Http\Controllers\UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
});

// ==========================================
// 3. ADMIN DASHBOARD (BACK OFFICE)
// ==========================================
Route::redirect('/dashboard', '/admin');

Route::get('/refresh-deploy', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Cache::forget('pktj_live_all_news_v3');

        // Manually purge all compiled blade view files in storage
        $viewsPath = storage_path('framework/views');
        if (is_dir($viewsPath)) {
            $files = glob($viewsPath . '/*.php');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }

        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        try {
            \App\Models\Pejabat::where('nama', 'LIKE', '%Prima%')
                ->update(['foto' => 'images/pejabat/Prima Anna Maria.png']);

            \App\Models\Pejabat::where('nama', 'LIKE', '%Bambang%')
                ->update([
                    'nama' => 'Dr. Ir. Bambang Istiyanto, S.SiT., M.T., IPU',
                    'biografi' => 'Menjabat sebagai Direktur Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Meraih gelar Doktor Teknik Sipil di Universitas Islam Sultan Agung (UNISSULA) Semarang dengan disertasi Model Evaluasi Keberhasilan Program Keselamatan Jalan Perkotaan Berbasis Safety Performance Function (SPF) dan Crash Modification Factor (CMF) dengan Pendekatan System Dynamics. Memimpin penyelenggaraan pendidikan vokasi keselamatan transportasi darat, tata kelola BLU, dan penguatan keterbukaan informasi publik di lingkungan BPSDMP Kementerian Perhubungan.',
                    'pendidikan' => [
                        'S3 - Doktor (Dr.) Teknik Sipil, Universitas Islam Sultan Agung (UNISSULA) Semarang',
                        'Profesi Insinyur - Insinyur Profesional Utama (IPU), Persatuan Insinyur Indonesia (PII)',
                        'S2 - Magister Teknik (M.T.) Sipil / Transportasi, Institut Teknologi Bandung (ITB)',
                        'D4 / S1 Terapan - Sarjana Sains Terapan Transportasi (S.SiT), Sekolah Tinggi Transportasi Darat (STTD)',
                        'Pendidikan dan Pelatihan Penjenjangan Kepemimpinan Administrator (PIM Tingkat III)'
                    ]
                ]);
            
            \App\Models\Dashboard::updateOrCreate(
                ['key' => 'link_permohonan_bpsdm'],
                [
                    'value' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                    'type' => 'text',
                    'description' => 'Link Portal Permohonan Informasi Terintegrasi BPSDMP',
                    'aktif' => true
                ]
            );

            // Auto-update CustomMenu & Profil to 'Tugas & Fungsi PPID'
            \App\Models\CustomMenu::where('nama', 'like', '%Tanggung%')
                ->orWhere('nama', 'like', '%Tugas%')
                ->orWhere('url', 'like', '%tugas%')
                ->orWhere('slug', 'like', '%tugas%')
                ->update([
                    'nama' => 'Tugas & Fungsi PPID',
                    'url' => '/profil/tugas-dan-fungsi-ppid',
                    'slug' => 'tugas-dan-fungsi-ppid'
                ]);

            \App\Models\Profil::where('tipe', 'tugas')->update([
                'judul' => 'Tugas & Fungsi PPID',
                'tagline_hero' => 'Tugas, Wewenang, dan Fungsi PPID PKTJ'
            ]);

            // Auto-sync Campus Names & SP4N-LAPOR defaults
            $autoSettings = [
                'kontak_kampus_1_nama' => 'Kampus Perintis',
                'kontak_kampus_2_nama' => 'Kampus Margadana',
                'kontak_kampus_1_alamat' => 'Jl. Perintis Kemerdekaan No. 17, Kota Tegal',
                'kontak_kampus_2_alamat' => 'Jl. Abdul Syukur No. 17, Margadana, Kota Tegal',
                'kontak_kampus_1_maps' => 'https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20I%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed',
                'kontak_kampus_2_maps' => 'https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20II%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed',
                'span_lapor_judul' => 'UNTUK PELAYANAN PUBLIK YANG LEBIH BAIK, BERANI LAPOR MELALUI SP4N-LAPOR!',
                'span_lapor_deskripsi' => 'Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional - Layanan Aspirasi dan Pengaduan Online Rakyat. Sampaikan aspirasi, saran, dan laporan pelayanan secara transparan, aman, dan terpercaya.',
                'span_lapor_link' => 'https://www.lapor.go.id/instansi/politeknik-keselamatan-transportasi-jalan-tegal',
                'struktur_atasan_nama' => 'MENTERI PERHUBUNGAN',
                'struktur_utama_nama' => 'SEKRETARIS JENDERAL',
                'struktur_pelaksana_itjen' => 'INSPEKTUR JENDERAL',
                'struktur_pelaksana_ditjen' => 'DIREKTUR JENDERAL',
                'struktur_pelaksana_kaban' => 'KEPALA BADAN',
                'struktur_upt_direktur' => 'DIREKTUR PKTJ TEGAL',
                'struktur_manajer_nama' => 'PEJABAT STRUKTURAL',
                'struktur_pengelola_nama' => 'PEJABAT STRUKTURAL/STAFF',
                'struktur_petugas_nama' => 'STAFF',
            ];
            foreach ($autoSettings as $sK => $sV) {
                if (!\App\Models\Dashboard::where('key', $sK)->exists()) {
                    \App\Models\Dashboard::create([
                        'key' => $sK,
                        'value' => $sV,
                        'type' => 'text',
                        'aktif' => true
                    ]);
                }
            }

            // Clean up dummy documentation items from website
            $dummyTitles = [
                'Dokumentasi Foto dan Notulensi Rapat Koordinasi Internal Layanan PPID PKTJ',
                'Dokumentasi Keikutsertaan Bimbingan Teknis & Evaluasi Monev KIP Kementerian Perhubungan',
                'Petunjuk Operasional Kegiatan (POK) Alokasi Anggaran Khusus PPID PKTJ Tahun 2025/2026',
                'Surat Rekapitulasi dan Berita Acara Konsolidasi Usulan DIP & DIK PKTJ Tahun 2026',
                'Bukti Kehadiran dan Komitmen Pimpinan PKTJ pada Penganugerahan & Monev KIP',
            ];
            \App\Models\DaftarInformasi::whereIn('judul_informasi', $dummyTitles)->delete();
            \App\Models\InformasiBerkala::whereIn('judul', $dummyTitles)->delete();

            // Seed/Upsert Official DIP Public Items
            $officialDips = [
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Profil Kelembagaan Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal',
                    'deskripsi' => 'Informasi kedudukan, domisili kampus, kontak resmi, sejarah, visi misi lembaga, struktur organisasi, dan profil komprehensif PKTJ Tegal.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/F1.pdf'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Rencana Strategis (Renstra) Politeknik Keselamatan Transportasi Jalan 2020-2024 / 2025-2029',
                    'deskripsi' => 'Dokumen perencanaan jangka menengah arah kebijakan, sasaran program strategis, dan target kinerja institusi PKTJ.',
                    'waktu' => '2025', 'file' => 'storage/dokumen/F4.pdf'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Rencana Kerja Tahunan (RKT) PKTJ Tegal Tahun 2025/2026',
                    'deskripsi' => 'Rencana operasional kerja tahunan, indikator kinerja program, dan target capaian seluruh unit kerja di lingkungan PKTJ Tegal.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/RKT_PKTJ.pdf'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP) PKTJ Tegal',
                    'deskripsi' => 'Laporan pertanggungjawaban tahunan capaian indikator kinerja utama (IKU) dan realisasi target strategis institusi PKTJ.',
                    'waktu' => '2024/2025', 'file' => 'storage/dokumen/F6.pdf'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Laporan Keuangan Audited dan Laporan Auditor Independen (LAI) PKTJ Tegal',
                    'deskripsi' => 'Laporan keuangan terverifikasi (Neraca, Laporan Operasional, LPE, LRA, dan CaLK) beserta opini hasil audit auditor independen/BPK RI.',
                    'waktu' => '2024/2025', 'file' => 'storage/dokumen/F7.pdf'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'DIPA Petikan dan Laporan Realisasi Anggaran (LRA) PKTJ Tegal',
                    'deskripsi' => 'Dokumen otorisasi pelaksanaan anggaran (DIPA) dan laporan realisasi penyerapan anggaran belanja pegawai, barang, dan modal PKTJ Tegal.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/F8.xlsx'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Rencana Umum Pengadaan (SiRUP) Barang dan Jasa PKTJ Tegal',
                    'deskripsi' => 'Daftar paket pengadaan barang dan jasa penyedia dan swakelola tahun berjalan yang diumumkan pada portal SiRUP LKPP.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/F9.xlsx'
                ],
                [
                    'kategori' => 'informasi-berkala', 'tipe' => 'berkala',
                    'judul' => 'Pengumuman Lelang LPSE dan Ringkasan Dokumen Kontrak Pengadaan PKTJ',
                    'deskripsi' => 'Informasi pengadaan barang dan jasa yang sedang berjalan, pengumuman pemenang lelang pada portal LPSE Kemenhub, dan ringkasan kontrak penyedia.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/F12.pdf'
                ],
                [
                    'kategori' => 'informasi-setiap-saat', 'tipe' => 'setiapsaat',
                    'judul' => 'Keputusan Penetapan Daftar Informasi Publik (DIP) dan Daftar Informasi Dikecualikan (DIK) PKTJ Tegal Tahun 2026',
                    'deskripsi' => 'Surat Keputusan Direktur PKTJ mengenai penetapan klasifikasi seluruh dokumen publik berkala, setiap saat, serta merta, dan informasi yang dikecualikan.',
                    'waktu' => '2026', 'file' => 'storage/dokumen/G1.pdf'
                ],
                [
                    'kategori' => 'informasi-setiap-saat', 'tipe' => 'setiapsaat',
                    'judul' => 'Laporan Posisi dan Inventaris Barang Milik Negara (BMN) PKTJ Tegal',
                    'deskripsi' => 'Rekapitulasi inventarisasi aset tanah, bangunan kampus, laboratorium, armada kendaraan pengujian, dan peralatan teknologi pembelajaran PKTJ Tegal.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/G2.pdf'
                ],
                [
                    'kategori' => 'informasi-setiap-saat', 'tipe' => 'setiapsaat',
                    'judul' => 'Buku Register Surat Masuk dan Surat Keluar Kedinasan PKTJ Tegal (Tahun 2023 - 2026)',
                    'deskripsi' => 'Buku pencatatan register korespondensi surat masuk dan surat keluar kedinasan melalui aplikasi persuratan Srikandi Kementerian Perhubungan.',
                    'waktu' => '2023-2026', 'file' => 'storage/dokumen/G3.pdf'
                ],
                [
                    'kategori' => 'informasi-serta-merta', 'tipe' => 'sertamerta',
                    'judul' => 'Pemberitahuan Peringatan Dini Cuaca Ekstrem dan Jalur Evakuasi Kampus PKTJ Tegal',
                    'deskripsi' => 'Informasi kesiapsiagaan darurat bencana alam, rilis cuaca ekstrem BMKG, panduan tanggap darurat, dan peta jalur evakuasi kampus PKTJ Tegal.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/H1.pdf'
                ],
                [
                    'kategori' => 'informasi-serta-merta', 'tipe' => 'sertamerta',
                    'judul' => 'Protokol Kesiapsiagaan Kesehatan dan Laporan Kegiatan P4GN PKTJ Tegal',
                    'deskripsi' => 'Informasi pencegahan dan penanggulangan narkoba (P4GN), SOP layanan klinik kesehatan, dan protokol kesiapsiagaan darurat kesehatan taruna/pegawai.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/H2.pdf'
                ],
                [
                    'kategori' => 'informasi-serta-merta', 'tipe' => 'sertamerta',
                    'judul' => 'Pengumuman Darurat Penyesuaian Jadwal & Gangguan Server Sipencatar Kemenhub',
                    'deskripsi' => 'Pemberitahuan resmi mendesak penyesuaian jadwal atau kendala teknis sistem seleksi penerimaan calon taruna transportasi darat Kemenhub.',
                    'waktu' => '2025/2026', 'file' => 'storage/dokumen/H3.pdf'
                ],
            ];

            foreach ($officialDips as $d) {
                \App\Models\DaftarInformasi::updateOrCreate(
                    ['judul_informasi' => $d['judul']],
                    [
                        'kategori'           => $d['kategori'],
                        'tipe_informasi'     => $d['tipe'],
                        'isi_informasi'      => '<p>' . $d['deskripsi'] . '</p>',
                        'pejabat_penguasa'   => 'Direktur & Manajemen PKTJ',
                        'penerbit_informasi' => 'Politeknik Keselamatan Transportasi Jalan',
                        'tempat_pembuatan'   => 'Tegal',
                        'penanggung_jawab'   => 'PPID PKTJ',
                        'waktu_pembuatan'    => $d['waktu'],
                        'bentuk_informasi'   => 'Softcopy / PDF',
                        'jangka_waktu'       => '5 Tahun / Selama Berlaku',
                        'file_informasi'     => $d['file'],
                        'aktif'              => true,
                        'is_blurred'         => false,
                        'bisa_download'      => true,
                    ]
                );

                if ($d['kategori'] === 'informasi-berkala') {
                    \App\Models\InformasiBerkala::updateOrCreate(
                        ['judul' => $d['judul']],
                        [
                            'deskripsi'     => '<p>' . $d['deskripsi'] . '</p>',
                            'kategori'      => 'Laporan & Rencana',
                            'tahun'         => $d['waktu'],
                            'file_path'     => $d['file'],
                            'file_size'     => '1.5 MB',
                            'bisa_download' => true,
                            'aktif'         => true,
                        ]
                    );
                } elseif ($d['kategori'] === 'informasi-setiap-saat') {
                    \App\Models\InformasiSetiapSaat::updateOrCreate(
                        ['judul' => $d['judul']],
                        [
                            'deskripsi'     => '<p>' . $d['deskripsi'] . '</p>',
                            'kategori'      => 'Dokumen Publik',
                            'tahun'         => $d['waktu'],
                            'file_path'     => $d['file'],
                            'file_size'     => '1.5 MB',
                            'bisa_download' => true,
                            'aktif'         => true,
                        ]
                    );
                } elseif ($d['kategori'] === 'informasi-serta-merta') {
                    \App\Models\InformasiSertaMerta::updateOrCreate(
                        ['judul' => $d['judul']],
                        [
                            'deskripsi'     => '<p>' . $d['deskripsi'] . '</p>',
                            'kategori'      => 'Informasi Darurat',
                            'tahun'         => $d['waktu'],
                            'file_path'     => $d['file'],
                            'file_size'     => '1.5 MB',
                            'bisa_download' => true,
                            'aktif'         => true,
                        ]
                    );
                }
            }

            // Saring dan bersihkan record yang tidak memiliki dokumen fisik valid (matikan tombol download & kosongkan file)
            foreach (\App\Models\DaftarInformasi::all() as $item) {
                if (!has_valid_document($item->file_informasi)) {
                    $item->update([
                        'bisa_download' => false,
                        'file_informasi' => null
                    ]);
                }
            }

            foreach (\App\Models\InformasiBerkala::all() as $item) {
                if (!has_valid_document($item->file_path)) {
                    $item->update([
                        'bisa_download' => false,
                        'file_path' => null
                    ]);
                }
            }

            foreach (\App\Models\InformasiSetiapSaat::all() as $item) {
                if (!has_valid_document($item->file_path)) {
                    $item->update([
                        'bisa_download' => false,
                        'file_path' => null
                    ]);
                }
            }

            foreach (\App\Models\InformasiSertaMerta::all() as $item) {
                if (!has_valid_document($item->file_path)) {
                    $item->update([
                        'bisa_download' => false,
                        'file_path' => null
                    ]);
                }
            }

            foreach (\App\Models\Dokumen::all() as $item) {
                if (!has_valid_document($item->file_path)) {
                    $item->update([
                        'bisa_download' => false
                    ]);
                }
            }

            // Bersihkan lhkpn_link generik KPK dari pejabat agar tidak tampil tautan default
            foreach (\App\Models\Pejabat::all() as $pj) {
                if ($pj->lhkpn_link && (str_contains($pj->lhkpn_link, 'elhkpn.kpk.go.id') || $pj->lhkpn_link === '#')) {
                    $pj->update(['lhkpn_link' => null]);
                }
            }
        } catch (\Throwable $ex) {}

        return '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Deploy Cache Refreshed</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light d-flex align-items-center justify-content-center min-vh-100"><div class="card shadow-lg p-5 rounded-4 text-center" style="max-width: 600px;"><div class="display-4 text-success mb-3">✅</div><h3 class="fw-bold text-dark mb-2">Cache Deployment Berhasil Dibersihkan!</h3><p class="text-muted small">Seluruh cache template blade, routes, config, session view, dan foto pejabat telah diperbarui 100% ke versi kode terbaru.</p><hr class="my-4"><div class="d-grid gap-2"><a href="/informasi-publik/berkala" class="btn btn-primary fw-bold py-2.5 rounded-pill">👔 Lihat Pejabat & Informasi Berkala</a><a href="/profil/pejabat" class="btn btn-outline-primary fw-bold py-2.5 rounded-pill">📸 Lihat Halaman Profil Pejabat</a><a href="/" class="btn btn-link text-muted small">Kembali ke Beranda</a></div></div></body></html>';
    } catch (\Throwable $e) {
        return 'Error clearing deploy cache: ' . $e->getMessage();
    }
});

Route::get('/setup-db-2025', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DipSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'UpdateProfilSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'PejabatSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'SyncDaftarInformasiSeeder', '--force' => true]);

        try {
            \App\Models\Pejabat::where('nama', 'LIKE', '%Prima%')
                ->update(['foto' => 'images/pejabat/Prima Anna Maria.png']);
        } catch (\Throwable $ex) {}
        try {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
        } catch (\Exception $ex) {}

        $newsResult = ['total_fetched' => 0];
        try {
            $newsResult = app(\App\Services\PktjNewsService::class)->syncToDatabase();
        } catch (\Exception $ex) {}

        return 'Database migrated and cache cleared successfully!<br><strong>Berita PKTJ Terhubung:</strong> ' . ($newsResult['total_fetched'] ?? 0) . ' artikel resmi berhasil disinkronkan langsung dari PKTJ.ac.id.<br><br><strong>Penting:</strong> Karena database lokal Kakak menggunakan password bawaan seeder, maka password login admin panel cPanel Kakak saat ini kembali ke password default: <strong>admin123</strong>. Kakak bisa menggunakannya untuk login dan menggantinya kembali setelah masuk.';
    } catch (\Exception $e) {
        return 'Migration error: ' . $e->getMessage();
    }
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Real-time submission check for live notification banner & chime sound
    Route::get('/api/check-new-submissions', function() {
        try {
            $latestPesan = \Illuminate\Support\Facades\Schema::hasTable('pesan_kontaks')
                ? \App\Models\PesanKontak::latest()->first()
                : null;
            $latestPermohonan = \Illuminate\Support\Facades\Schema::hasTable('permohonans')
                ? \App\Models\Permohonan::latest()->first()
                : null;
            
            return response()->json([
                'status' => 'success',
                'pesan_latest_id' => $latestPesan ? $latestPesan->id : null,
                'pesan_latest_time' => $latestPesan && $latestPesan->created_at ? $latestPesan->created_at->timestamp : 0,
                'pesan_latest_nama' => $latestPesan ? $latestPesan->nama : '',
                'pesan_latest_judul' => $latestPesan ? $latestPesan->judul : '',
                'permohonan_latest_id' => $latestPermohonan ? $latestPermohonan->id : null,
                'permohonan_latest_time' => $latestPermohonan && $latestPermohonan->created_at ? $latestPermohonan->created_at->timestamp : 0,
                'permohonan_latest_nama' => $latestPermohonan ? $latestPermohonan->nama_pemohon : '',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    })->name('admin.api.check-submissions');

    // Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::post('/dashboard/upload-hero-video', [DashboardController::class, 'uploadHeroVideoAjax'])->name('admin.dashboard.upload-hero-video');
    Route::delete('/dashboard/delete-hero-video', [DashboardController::class, 'deleteHeroVideoAjax'])->name('admin.dashboard.delete-hero-video');
    
    // Custom Menu CRUD routes
    Route::resource('/menu', \App\Http\Controllers\CustomMenuController::class)->names('admin.menu');
    
    // Content management routes
    Route::get('/content', function() { return view('admin.content.index'); })->name('content.index');
    
    // Halaman management routes
    Route::get('/halaman', function() { return view('admin.halaman.index'); })->name('halaman.index');

    // Menu Profil PPID
    Route::name('admin.profil.')->prefix('profil')->group(function () {
        // Dashboard menunjukkan semua profil sections (Redirect to Halaman hub)
        Route::get('/', function() { return redirect()->route('halaman.index'); })->name('index');
        
        // CRUD untuk setiap tipe profil (lengkap dengan alias edit)
        Route::get('/profil/{type}', [ProfilPpidController::class, 'edit'])->name('edit');
        Route::get('/edit/{type}', [ProfilPpidController::class, 'edit']);
        Route::get('/{type}', [ProfilPpidController::class, 'edit']);
        Route::put('/profil/{type}', [ProfilPpidController::class, 'update'])->name('update');
        Route::put('/edit/{type}', [ProfilPpidController::class, 'update']);
        Route::put('/{type}', [ProfilPpidController::class, 'update']);

        Route::delete('/{type}', [ProfilPpidController::class, 'destroy'])->name('destroy');
    });

    // Pesan Kontak
    Route::get('/pesan-kontak', [\App\Http\Controllers\PesanKontakController::class, 'index'])->name('admin.pesan-kontak.index');
    Route::get('/pesan-kontak/{id}', [\App\Http\Controllers\PesanKontakController::class, 'show'])->name('admin.pesan-kontak.show');
    Route::delete('/pesan-kontak/{id}', [\App\Http\Controllers\PesanKontakController::class, 'destroy'])->name('admin.pesan-kontak.destroy');





    // Kelola Halaman Tambahan (CMS Dinamis untuk konten halaman)
    Route::post('/halaman-custom/{type}', [App\Http\Controllers\HalamanCustomController::class, 'store'])->name('admin.halaman-custom.store');

    // Menu Layanan Informasi
    Route::name('admin.layanan.')->prefix('layanan')->group(function () {
        Route::get('/daftar-informasi', [App\Http\Controllers\DaftarInformasiController::class, 'index'])->name('daftar-informasi');
        Route::get('/daftar-informasi/create', [App\Http\Controllers\DaftarInformasiController::class, 'create'])->name('daftar-informasi.create');
        Route::post('/daftar-informasi', [App\Http\Controllers\DaftarInformasiController::class, 'store'])->name('daftar-informasi.store');
        Route::get('/daftar-informasi/{id}', function($id) { return redirect()->route('admin.layanan.daftar-informasi.edit', $id); });
        Route::get('/daftar-informasi/{id}/edit', [App\Http\Controllers\DaftarInformasiController::class, 'edit'])->name('daftar-informasi.edit');
        Route::put('/daftar-informasi/{id}', [App\Http\Controllers\DaftarInformasiController::class, 'update'])->name('daftar-informasi.update');
        Route::delete('/daftar-informasi/{id}', [App\Http\Controllers\DaftarInformasiController::class, 'destroy'])->name('daftar-informasi.destroy');

        Route::get('/maklumat-pelayanan', function() { return view('admin.layanan.maklumat-pelayanan'); })->name('maklumat-pelayanan');
        Route::get('/laporan-layanan', function() { return view('admin.layanan.laporan-layanan'); })->name('laporan-layanan');
        Route::get('/laporan-akses', function() { return view('admin.layanan.laporan-akses'); })->name('laporan-akses');
        Route::get('/laporan-survey', [\App\Http\Controllers\SurveyController::class, 'adminIndex'])->name('laporan-survey');
        Route::get('/aksesibilitas', function() { return view('admin.layanan.aksesibilitas'); })->name('aksesibilitas');
        Route::delete('/survey/{id}', [\App\Http\Controllers\SurveyController::class, 'adminDestroy'])->name('survey.destroy');
    });

    // Direct Shortcut Aksesibilitas
    Route::get('/aksesibilitas', function() { return redirect()->route('admin.layanan.aksesibilitas'); })->name('admin.aksesibilitas');
    Route::get('/layanan/aksesibilitas-disabilitas', function() { return redirect()->route('admin.layanan.aksesibilitas'); });

    // Menu Prosedur
    Route::name('admin.prosedur.')->prefix('prosedur')->group(function () {
        Route::get('/sop-permintaan', function() { return view('admin.prosedur.sop-permintaan'); })->name('sop-permintaan');
        Route::get('/sop-keberatan', function() { return view('admin.prosedur.sop-keberatan'); })->name('sop-keberatan');
        Route::get('/sop-sengketa', function() { return view('admin.prosedur.sop-sengketa'); })->name('sop-sengketa');
        Route::get('/{slug}', function($slug) {
            if (view()->exists('admin.prosedur.' . $slug)) {
                return view('admin.prosedur.' . $slug);
            }
            return app(\App\Http\Controllers\ProfilPpidController::class)->edit($slug);
        });
        Route::post('/save-sop-settings', [ProsedurController::class, 'updateSettings'])->name('save-sop-settings');
    });

    // Menu Informasi Publik
    Route::name('admin.informasi.')->prefix('informasi')->group(function () {
        // Berkala
        Route::get('/berkala', [InformasiBerkalaController::class, 'index'])->name('berkala.index');
        Route::get('/berkala/create', [InformasiBerkalaController::class, 'create'])->name('berkala.create');
        Route::post('/berkala', [InformasiBerkalaController::class, 'store'])->name('berkala.store');
        Route::get('/berkala/{id}/edit', [InformasiBerkalaController::class, 'edit'])->name('berkala.edit');
        Route::put('/berkala/{id}', [InformasiBerkalaController::class, 'update'])->name('berkala.update');
        Route::delete('/berkala/{id}', [InformasiBerkalaController::class, 'destroy'])->name('berkala.destroy');

        // Serta Merta
        Route::get('/serta-merta', [InformasiSertaMertaController::class, 'index'])->name('sertamerta.index');
        Route::get('/serta-merta/create', [InformasiSertaMertaController::class, 'create'])->name('sertamerta.create');
        Route::post('/serta-merta', [InformasiSertaMertaController::class, 'store'])->name('sertamerta.store');
        Route::get('/serta-merta/{id}/edit', [InformasiSertaMertaController::class, 'edit'])->name('sertamerta.edit');
        Route::put('/serta-merta/{id}', [InformasiSertaMertaController::class, 'update'])->name('sertamerta.update');
        Route::delete('/serta-merta/{id}', [InformasiSertaMertaController::class, 'destroy'])->name('sertamerta.destroy');
        
        // Setiap Saat
        Route::get('/setiap-saat', [InformasiSetiapSaatController::class, 'index'])->name('setiapsaat.index');
        Route::get('/setiap-saat/create', [InformasiSetiapSaatController::class, 'create'])->name('setiapsaat.create');
        Route::post('/setiap-saat', [InformasiSetiapSaatController::class, 'store'])->name('setiapsaat.store');
        Route::get('/setiap-saat/{id}/edit', [InformasiSetiapSaatController::class, 'edit'])->name('setiapsaat.edit');
        Route::put('/setiap-saat/{id}', [InformasiSetiapSaatController::class, 'update'])->name('setiapsaat.update');
        Route::delete('/setiap-saat/{id}', [InformasiSetiapSaatController::class, 'destroy'])->name('setiapsaat.destroy');
        
        // Dikecualikan
        Route::get('/dikecualikan', [InformasiDikecualikanController::class, 'index'])->name('dikecualikan.index');
        Route::get('/dikecualikan/create', [InformasiDikecualikanController::class, 'create'])->name('dikecualikan.create');
        Route::post('/dikecualikan', [InformasiDikecualikanController::class, 'store'])->name('dikecualikan.store');
        Route::get('/dikecualikan/{id}/edit', [InformasiDikecualikanController::class, 'edit'])->name('dikecualikan.edit');
        Route::put('/dikecualikan/{id}', [InformasiDikecualikanController::class, 'update'])->name('dikecualikan.update');
        Route::delete('/dikecualikan/{id}', [InformasiDikecualikanController::class, 'destroy'])->name('dikecualikan.destroy');
    });

    // PKTJ News Sync & Clean
    Route::post('berita/sync-pktj', [BeritaController::class, 'syncPktjNews'])->name('admin.berita.sync-pktj');
    Route::post('berita/clean-dummy', [BeritaController::class, 'cleanDummy'])->name('admin.berita.clean-dummy');

    // Resource CRUD
    Route::resource('regulasi', \App\Http\Controllers\RegulasiController::class)->names('admin.regulasi');
    Route::post('pejabat/update-size', [\App\Http\Controllers\PejabatController::class, 'updateSizeSettings'])->name('admin.pejabat.update-size');
    Route::resource('pejabat', \App\Http\Controllers\PejabatController::class)->names('admin.pejabat');
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur-crud', DokumenController::class)->names('admin.prosedur-crud');
    
    // Custom FAQ routes for admin
    Route::get('/faq', [FaqController::class, 'adminIndex'])->name('admin.faq.index');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    
    // Permohonan Informasi routes
    Route::name('admin.permohonan.')->prefix('permohonan')->group(function () {
        Route::get('/', [PermohonanController::class, 'index'])->name('index');
        Route::get('/submissions', [PermohonanController::class, 'index'])->name('submissions');
        Route::get('/report', [PermohonanController::class, 'report'])->name('report');
        Route::get('/report/export', [PermohonanController::class, 'exportReport'])->name('report.export');
        Route::get('/report/export-word', [PermohonanController::class, 'exportReportWord'])->name('report.export_word');
        Route::get('/report/export-pdf', [PermohonanController::class, 'exportReportPdf'])->name('report.export_pdf');
        Route::get('/form', [PermohonanController::class, 'adminForm'])->name('form');
        Route::post('/form/save', [PermohonanController::class, 'saveForm'])->name('save_form');
        Route::get('/export/register', [PermohonanController::class, 'exportExcelRegister'])->name('export.register');
        Route::get('/export/register-word', [PermohonanController::class, 'exportWordRegister'])->name('export.word_register');
        Route::get('/export/{id}/reject', [PermohonanController::class, 'exportWordReject'])->name('export.reject');

        Route::get('/download/{id}', [PermohonanController::class, 'downloadDocument'])->name('download');
        Route::get('/{permohonan}', [PermohonanController::class, 'show'])->name('show');
        Route::put('/{permohonan}', [PermohonanController::class, 'update'])->name('update');
        Route::delete('/{permohonan}', [PermohonanController::class, 'destroy'])->name('destroy');
    });

    // Image upload and File Browser for TinyMCE
    Route::post('/upload/image', [AdminController::class, 'uploadImage'])->name('admin.upload.image');
    Route::post('/upload/file-browser', [AdminController::class, 'uploadFileBrowser'])->name('admin.upload.file-browser');
    Route::get('/file-browser', [AdminController::class, 'fileBrowser'])->name('admin.file-browser');

    // Link Aplikasi Terkait
    Route::get('/lpse', function() { return "Halaman LPSE"; })->name('admin.lpse.index');
    Route::get('/jdih', function() { return "Halaman JDIH"; })->name('admin.jdih.index');

    // Verifikasi Pemohon Informasi
    Route::get('/pemohon', [UserController::class, 'pemohonIndex'])->name('admin.pemohon.index');
    Route::post('/pemohon/{user}/verify', [UserController::class, 'verifyPemohon'])->name('admin.pemohon.verify');
    Route::post('/pemohon/{user}/reject', [UserController::class, 'rejectPemohon'])->name('admin.pemohon.reject');

    Route::resource('/user-management', UserController::class)->names('admin.users')->parameters(['user-management' => 'user']);
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');

    // Aliases for admin links in documentation
    Route::redirect('/permohonan-informasi', '/admin/permohonan');
    Route::redirect('/keberatan', '/admin/permohonan');
    Route::redirect('/kontak', '/admin/pesan-kontak');

});

// Temporary seed route for Informasi Dikecualikan
Route::get('/seed-dikecualikan-safe-run', function() {
    try {
        $records = [
            [
                'judul'               => 'Dokumen Hasil Penilaian Proses Penetapan Seleksi Penerimaan Calon Mahasiswa/i',
                'deskripsi'           => 'Dokumen rincian hasil penilaian proses penetapan seleksi Penerimaan Calon Mahasiswa/i',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 4: informasi publik yang apabila dibuka dan diberikan kepada pemohon informasi publik dapat mengungkap rahasia pribadi yaitu hasil-hasil evaluasi sehubungan dengan kapabilitas, intelektualitas, dan rekomendasi kemampuan seseorang',
                'konsekuensi_dibuka'  => 'Dapat mengungkap rahasia pribadi seseorang mengenai hasil evaluasi kapabilitas, intelektualitas, dan rekomendasi kemampuannya.',
                'konsekuensi_ditutup' => 'Melindungi kerahasiaan dan privasi data pribadi peserta seleksi dari akses pihak ketiga yang tidak berkepentingan.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Realisasi Belanja',
                'deskripsi'           => 'Pengeluaran Belanja BLU PKTJ',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 3: kondisi keuangan, aset, pendapatan, dan rekening bank seseorang',
                'konsekuensi_dibuka'  => 'Dapat mengungkap kondisi keuangan, aset, pendapatan, dan rekening bank pribadi seseorang yang bersifat rahasia.',
                'konsekuensi_ditutup' => 'Menjaga kerahasiaan data finansial pribadi pegawai/pihak terkait sesuai ketentuan perlindungan privasi.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Nilai Tes Siswa Diklat',
                'deskripsi'           => 'Berisi Daftar Nilai Tes Siswa Diklat',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 4: informasi publik yang apabila dibuka dan diberikan kepada pemohon informasi publik dapat mengungkap rahasia pribadi yaitu hasil-hasil evaluasi sehubungan dengan kapabilitas, intelektualitas, dan rekomendasi kemampuan seseorang',
                'konsekuensi_dibuka'  => 'Dapat mempublikasikan hasil evaluasi kemampuan pribadi siswa diklat tanpa hak.',
                'konsekuensi_ditutup' => 'Melindungi privasi hasil evaluasi intelektual dan kemampuan akademik siswa.',
                'jangka_waktu'        => '1 Tahun / Diberikan jika ada persetujuan tertulis dari pihak/CPNS yang bersangkutan',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Nilai Tes Mahasiswa/i',
                'deskripsi'           => 'Berisi Daftar Nilai Tes Mahasiswa',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 4: informasi publik yang apabila dibuka dan diberikan kepada pemohon informasi publik dapat mengungkap rahasia pribadi yaitu hasil-hasil evaluasi sehubungan dengan kapabilitas, intelektualitas, dan rekomendasi kemampuan seseorang',
                'konsekuensi_dibuka'  => 'Dapat menyebarluaskan riwayat akademik dan nilai evaluasi personal mahasiswa.',
                'konsekuensi_ditutup' => 'Menjamin perlindungan data pribadi mahasiswa terkait hasil evaluasi akademik.',
                'jangka_waktu'        => '1 Tahun / Diberikan jika ada persetujuan tertulis dari pihak/CPNS yang bersangkutan',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Hasil Proses Penjatuhan Hukuman',
                'deskripsi'           => 'Hasil dari Proses Penjatuhan Hukuman Disiplin bagi pegawai',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Undang-Undang No.8 Tahun 1981 tentang Hukum Acara Pidana, Undang-Undang No. 43 Tahun 2009 tentang Kearsipan',
                'konsekuensi_dibuka'  => 'Dapat mengganggu proses penegakan disiplin dan mencemarkan nama baik pegawai sebelum adanya keputusan yang berkekuatan hukum tetap.',
                'konsekuensi_ditutup' => 'Menjaga objektivitas proses hukum disiplin dan melindungi hak-hak kepegawaian selama proses berjalan.',
                'jangka_waktu'        => 'Dibuka setelah ada keputusan tetap dari pimpinan Politeknik Keselamatan Transportasi Jalan',
                'penanggung_jawab'    => 'PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Rekam Medis Calon Mahasiswa/i, dan Pegawai di Lingkungan PKTJ',
                'deskripsi'           => 'Data rekam medis Calon Mahasiswa/i',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 2: informasi publik yang apabila dibuka dan diberikan kepada pemohon informasi publik dapat mengungkap rahasia pribadi yaitu riwayat, kondisi dan perawatan, pengobatan kesehatan fisik, dan psikis seseorang',
                'konsekuensi_dibuka'  => 'Mengungkap kondisi kesehatan fisik dan psikis yang sangat bersifat pribadi dan sensitif.',
                'konsekuensi_ditutup' => 'Menjaga kerahasiaan medis pasien sesuai etika kedokteran dan hukum perlindungan konsumen/pasien.',
                'jangka_waktu'        => '1 Tahun / Diberikan jika ada persetujuan tertulis dari pihak yang bersangkutan',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Analisis dan Hasil Audit Internal',
                'deskripsi'           => 'Kegiatan analisis dan hasil audit SPI, SPM dan Inspektorat',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 3: kondisi keuangan, aset, pendapatan, dan rekening bank seseorang; Undang-Undang No.15 Tahun 2004 tentang Pemeriksaan Pengelolaan dan Tanggung Jawab Keuangan Negara',
                'konsekuensi_dibuka'  => 'Dapat menimbulkan kesalahpahaman publik terhadap proses evaluasi internal yang belum bersifat final.',
                'konsekuensi_ditutup' => 'Memberikan ruang bagi tim auditor internal untuk bekerja secara independen dan menyusun rekomendasi perbaikan sebelum dipublikasikan secara resmi.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Hasil Proses Penjatuhan Hukuman Pegawai',
                'deskripsi'           => 'Hasil dari Proses Penjatuhan Hukuman Disiplin bagi pegawai',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Undang-Undang No.8 Tahun 1981 tentang Hukum Acara Pidana, Undang-Undang No. 43 Tahun 2009 tentang Kearsipan',
                'konsekuensi_dibuka'  => 'Dapat mengganggu penegakan tata tertib disiplin di lingkungan institusi sebelum ada keputusan yang inkrah.',
                'konsekuensi_ditutup' => 'Melindungi nama baik pegawai dan menjaga kerahasiaan berkas kepegawaian internal.',
                'jangka_waktu'        => '1 Tahun / Dibuka setelah ada keputusan tetap dari pimpinan PKTJ',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Analisis dan Hasil Audit External',
                'deskripsi'           => 'Kegiatan analisis dan hasil audit KAP dan BPK',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 3: kondisi keuangan, aset, pendapatan, dan rekening bank seseorang; Undang-Undang No.15 Tahun 2004 tentang Pemeriksaan Pengelolaan dan Tanggung Jawab Keuangan Negara',
                'konsekuensi_dibuka'  => 'Dapat memicu interpretasi keliru terhadap laporan keuangan sebelum selesainya audit formal.',
                'konsekuensi_ditutup' => 'Menjaga objektivitas pemeriksaan laporan keuangan eksternal oleh BPK/KAP.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'POK PKTJ',
                'deskripsi'           => 'Berisi tentang Dokumen yang memuat uraian kerja dan biaya yang diperlukan PKTJ',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 3: kondisi keuangan, aset, pendapatan, dan rekening bank seseorang',
                'konsekuensi_dibuka'  => 'Membuka rincian alokasi anggaran internal secara mendalam kepada pihak luar yang berpotensi disalahgunakan.',
                'konsekuensi_ditutup' => 'Melindungi rincian rencana keuangan internal dan efisiensi pengeluaran institusi.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Realisasi Penerimaan',
                'deskripsi'           => 'Pendapatan BLU PKTJ',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 3: kondisi keuangan, aset, pendapatan, dan rekening bank seseorang',
                'konsekuensi_dibuka'  => 'Mengungkap data aliran dana masuk secara mendetail yang dapat disalahgunakan.',
                'konsekuensi_ditutup' => 'Menjaga integritas data finansial penerimaan negara bukan pajak (PNBP) / BLU.',
                'jangka_waktu'        => '1 Tahun',
                'penanggung_jawab'    => 'PPID Pelaksana UPT PKTJ',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
            [
                'judul'               => 'Rekam Medis Calon Taruna, Taruna, dan Pegawai di Lingkungan Politeknik Keselamatan Transportasi Jalan',
                'deskripsi'           => 'Data rekam medis Calon Tarun',
                'tanggal'             => '2025-09-19',
                'dasar_hukum'         => 'Pasal 17 huruf h angka 2 : informasi publik yang apabila dibuka dan diberikan kepada pemohon informasi publik dapat mengungkap rahasia pribadi yaitu riwayat, kondisi dan perawatan, pengobatan kesehatan fisik, dan psikis seseorang',
                'konsekuensi_dibuka'  => 'Dapat menyebarkan riwayat medis personal yang sangat rahasia tanpa persetujuan.',
                'konsekuensi_ditutup' => 'Menjaga hak kerahasiaan pasien and integritas riwayat medis pegawai/taruna.',
                'jangka_waktu'        => 'Diberikan jika ada persetujuan tertulis dari pihak yang bersangkutan',
                'penanggung_jawab'    => 'PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan',
                'file_path'           => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'file_name'           => 'Daftar Informasi Dikecualikan (PDF)',
                'file_size'           => '-',
                'file_type'           => 'gdrive',
                'aktif'               => true,
                'is_blurred'          => false,
            ],
        ];

        foreach ($records as $record) {
            \App\Models\InformasiDikecualikan::updateOrCreate(
                ['judul' => $record['judul']],
                $record
            );
        }
        return "SUCCESS: All 12 records of Informasi Dikecualikan have been seeded successfully! You can now visit your admin panel to manage them.";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});

// Temporary seed route for Daftar Informasi Publik
Route::get('/seed-daftar-informasi-safe-run', function() {
    try {
        $migration = require database_path('migrations/2026_06_05_160000_seed_daftar_informasi_data.php');
        $migration->up();
        return "SUCCESS: All 80 records of Daftar Informasi Publik have been seeded successfully! You can now visit your admin panel or public page to view them.";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});

// Temporary seed route for Laporan Pelayanan Informasi 2024
Route::get('/seed-laporan-2024-safe-run', function() {
    try {
        $data = [
            'laporan_layanan_judul_hero' => 'Laporan Pelayanan Informasi Publik',
            'laporan_layanan_tagline_hero' => 'Wujud Komitmen Keterbukaan dan Akuntabilitas PPID Pelaksana UPT PKTJ',
            'laporan_layanan_tahun_laporan' => '2024',
            'laporan_layanan_ringkasan_eksekutif' => '<p>Laporan Pelayanan Informasi Publik menyajikan rincian statistik permohonan informasi yang diterima, diproses, dan diselesaikan oleh PPID PKTJ. Laporan ini merefleksikan transparansi, akuntabilitas, dan komitmen penuh kami dalam melayani seluruh kebutuhan informasi publik masyarakat.</p>'
        ];

        foreach ($data as $key => $val) {
            \App\Models\Dashboard::updateOrCreate(
                ['key' => $key],
                ['value' => $val, 'type' => 'text', 'aktif' => true]
            );
        }

        return "SUCCESS: Laporan Pelayanan Informasi 2024 title and summary have been seeded successfully! Go check your public page.";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});


// Diagnostic route for Hero Video
Route::get('/debug-hero-video', function() {
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    $heroVidFile = $settings['hero_video_file'] ?? null;
    $heroVidLink = $settings['hero_video_link'] ?? null;

    $res = "<h1>🔍 Hero Video Diagnostics</h1>";
    $res .= "<p><b>hero_video_file (DB value):</b> " . ($heroVidFile ?: "<i>(empty)</i>") . "</p>";
    $res .= "<p><b>hero_video_link (DB value):</b> " . ($heroVidLink ?: "<i>(empty)</i>") . "</p>";

    // Attempt to automatically fix/recreate the symlink!
    $target = storage_path('app/public');
    $links = [
        public_path('storage'),
        '/home/ppid2026/public_html/storage'
    ];

    $fixResults = [];
    foreach ($links as $link) {
        if (file_exists($link) || is_link($link)) {
            // Unlink symlink
            if (is_link($link)) {
                @unlink($link);
            } else {
                @unlink($link);
            }
        }
        if (@symlink($target, $link)) {
            $fixResults[$link] = "<span style='color:green;'>SUCCESSFULLY CREATED</span>";
        } else {
            $fixResults[$link] = "<span style='color:red;'>FAILED (Permission Denied or Symlink Disabled)</span>";
        }
    }

    $res .= "<h3>🔧 Symlink Autocure Results:</h3><ul>";
    foreach ($fixResults as $path => $status) {
        $res .= "<li><code>$path</code> -> $status</li>";
    }
    $res .= "</ul>";
    
    $res .= "<h3>📂 File Path Verification:</h3><ul>";
    if ($heroVidFile) {
        $storagePath = storage_path('app/public/' . $heroVidFile);
        $publicPath = public_path('storage/' . $heroVidFile);
        $publicHtmlPath = '/home/ppid2026/public_html/storage/' . $heroVidFile;
        
        $res .= "<li><b>Storage Path (Core):</b> <code>$storagePath</code> -> " . (file_exists($storagePath) ? "<span style='color:green;'>EXISTS (" . number_format(filesize($storagePath) / 1024 / 1024, 2) . " MB)</span>" : "<span style='color:red;'>NOT FOUND</span>") . "</li>";
        $res .= "<li><b>Public Path (Symlink 1):</b> <code>$publicPath</code> -> " . (file_exists($publicPath) ? "<span style='color:green;'>EXISTS</span>" : "<span style='color:red;'>NOT FOUND</span>") . "</li>";
        $res .= "<li><b>Public HTML Path (Symlink 2):</b> <code>$publicHtmlPath</code> -> " . (file_exists($publicHtmlPath) ? "<span style='color:green;'>EXISTS</span>" : "<span style='color:red;'>NOT FOUND</span>") . "</li>";
    } else {
        $res .= "<li>No file is currently set in the database.</li>";
    }
    $res .= "</ul>";

    $res .= "<h3>⚙️ Server Upload Limits:</h3><ul>";
    $res .= "<li><b>upload_max_filesize:</b> " . ini_get('upload_max_filesize') . "</li>";
    $res .= "<li><b>post_max_size:</b> " . ini_get('post_max_size') . "</li>";
    $res .= "<li><b>memory_limit:</b> " . ini_get('memory_limit') . "</li>";
    $res .= "</ul>";

    return $res;
});


// Diagnostic route for Dokumens Table
Route::get('/debug-dokumens', function() {
    try {
        $tableExists = Schema::hasTable('dokumens');
        $columns = [];
        if ($tableExists) {
            $colQuery = DB::select("SHOW COLUMNS FROM " . DB::connection()->getTablePrefix() . "dokumens");
            foreach ($colQuery as $col) {
                $columns[] = $col->Field . " (" . $col->Type . ")";
            }
        }
        $records = $tableExists ? DB::table('dokumens')->get() : [];
        return response()->json([
            'database' => DB::connection()->getDatabaseName(),
            'table_prefix' => DB::connection()->getTablePrefix(),
            'table_exists' => $tableExists,
            'columns' => $columns,
            'records' => $records
        ], 200, [], JSON_PRETTY_PRINT);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});


// Diagnostic route to check the view file contents
Route::get('/debug-view', function() {
    try {
        $path = resource_path('views/laporan-layanan-informasi.blade.php');
        if (file_exists($path)) {
            return response(file_get_contents($path), 200, ['Content-Type' => 'text/plain']);
        }
        return "File not found";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});

Route::get('/debug-visitors', function() {
    try {
        $tableExists = Schema::hasTable('visitors');
        $columns = [];
        if ($tableExists) {
            $colQuery = DB::select("SHOW COLUMNS FROM " . DB::connection()->getTablePrefix() . "visitors");
            foreach ($colQuery as $col) {
                $columns[] = $col->Field . " (" . $col->Type . ")";
            }
        }
        $count = $tableExists ? DB::table('visitors')->count() : 0;
        $records = $tableExists ? DB::table('visitors')->orderBy('tanggal', 'desc')->take(10)->get() : [];
        
        // Let's also get all table names
        $tables = [];
        $tablesQuery = DB::select('SHOW TABLES');
        $dbName = DB::connection()->getDatabaseName();
        $prop = "Tables_in_" . $dbName;
        foreach ($tablesQuery as $t) {
            $tables[] = $t->$prop;
        }

        return response()->json([
            'database' => $dbName,
            'table_prefix' => DB::connection()->getTablePrefix(),
            'visitors_table_exists' => $tableExists,
            'visitors_columns' => $columns,
            'visitors_count' => $count,
            'visitors_records' => $records,
            'all_tables' => $tables
        ], 200, [], JSON_PRETTY_PRINT);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});


// ==========================================
// 4. FRONTEND USER (PUBLIC PAGES)
// ==========================================
Route::name('profil.')->prefix('profil')->group(function () {
    Route::get('/', [ProfilPublikController::class, 'showProfil'])->name('index');
    Route::get('/ppid', [ProfilPublikController::class, 'showProfil'])->name('ppid');
    Route::get('/pejabat', [\App\Http\Controllers\InformasiPublikController::class, 'profilPejabat'])->name('pejabat');
    Route::get('/tugas-dan-fungsi-ppid', [ProfilPublikController::class, 'showTugas'])->name('tugas-dan-fungsi-ppid');
    Route::get('/tugas-fungsi-ppid', function() { return redirect('/profil/tugas-dan-fungsi-ppid', 301); });
    Route::get('/tugas', function() { return redirect('/profil/tugas-dan-fungsi-ppid', 301); })->name('tugas');
    Route::get('/tugas-tanggung-jawab', function() { return redirect('/profil/tugas-dan-fungsi-ppid', 301); })->name('tugas-tanggung-jawab');
    Route::get('/visi', [ProfilPublikController::class, 'showVisi'])->name('visi');
    Route::get('/visi-misi', [ProfilPublikController::class, 'showVisi'])->name('visi-misi');
    Route::get('/struktur', [ProfilPublikController::class, 'showStruktur'])->name('struktur');
    Route::get('/struktur-organisasi', [ProfilPublikController::class, 'showStruktur'])->name('struktur-organisasi');
    Route::get('/regulasi', [ProfilPublikController::class, 'showRegulasi'])->name('regulasi');
    Route::get('/kontak', [ProfilPublikController::class, 'showKontak'])->name('kontak');
    Route::post('/kontak', [ProfilPublikController::class, 'submitKontak'])->name('kontak.submit');
});

// Prosedur Routes (Public - Dynamic from Controller)
Route::name('prosedur.')->prefix('prosedur')->group(function () {
    Route::get('/sop-permintaan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_permintaan')->defaults('view', 'sop-permintaan')->name('sop-permintaan');
    Route::get('/sop-permintaan-informasi', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_permintaan')->defaults('view', 'sop-permintaan');
    
    Route::get('/sop-keberatan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_keberatan')->defaults('view', 'sop-penanganan-keberatan')->name('sop-keberatan');
    Route::get('/sop-penanganan-keberatan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_keberatan')->defaults('view', 'sop-penanganan-keberatan');
    
    Route::get('/sop-sengketa', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_sengketa')->defaults('view', 'sop-sengketa')->name('sop-sengketa');
    Route::get('/sop-pengajuan-sengketa', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_sengketa')->defaults('view', 'sop-sengketa');
    
    Route::get('/sop-penetapan', function() { return redirect()->route('prosedur.sop-permintaan'); });
    Route::get('/sop-penetapan-pemutakhiran', function() { return redirect()->route('prosedur.sop-permintaan'); });
    
    Route::get('/sop-pengujian', function() { return redirect()->route('prosedur.sop-permintaan'); });
    Route::get('/sop-pengujian-konsekuensi', function() { return redirect()->route('prosedur.sop-permintaan'); });
    
    Route::get('/sop-pendokumentasian', function() { return redirect()->route('prosedur.sop-permintaan'); });
    
    // Additional Public Procedures
    Route::get('/sop-maklumat-pelayanan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_maklumat')->defaults('view', 'sop-generic')->name('sop-maklumat');
    Route::get('/sop-standar-biaya', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_biaya')->defaults('view', 'sop-generic')->name('sop-biaya');
    Route::get('/sop-standar-waktu', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_waktu')->defaults('view', 'sop-generic')->name('sop-waktu');
    Route::get('/sop-alur-permohonan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_alur_permohonan')->defaults('view', 'sop-generic')->name('sop-alur-permohonan');
    Route::get('/sop-alur-keberatan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_alur_keberatan')->defaults('view', 'sop-generic')->name('sop-alur-keberatan');
});

// Printable Forms
Route::get('/dokumen/formulir-permohonan-cetak', function() {
    return view('dokumen.formulir-permohonan-cetak');
})->name('dokumen.formulir-permohonan-cetak');

Route::get('/dokumen/formulir-keberatan-cetak', function() {
    return view('dokumen.formulir-keberatan-cetak');
})->name('dokumen.formulir-keberatan-cetak');

Route::get('/dokumen/formulir-braille-cetak', function() {
    return view('dokumen.formulir-braille-cetak');
})->name('dokumen.formulir-braille-cetak');

Route::get('/dokumen/formulir-braille-word', function() {
    $html = view('dokumen.formulir-braille-cetak')->render();
    
    // Clean up buttons and non-printable structures for Microsoft Word conversion
    $html = preg_replace('/<div[^>]*class="[^"]*no-print[^"]*"[^>]*>.*?<\/div>/is', '', $html);
    $html = preg_replace('/<button[^>]*class="[^"]*no-print-btn[^"]*"[^>]*>.*?<\/button>/is', '', $html);
    
    return response($html)
        ->header('Content-Type', 'application/vnd.ms-word')
        ->header('Content-Disposition', 'attachment; filename="Formulir-Permohonan-Informasi-Braille.doc"');
})->name('dokumen.formulir-braille-word');

Route::get('/dokumen/laporan-braille', function() {
    return view('dokumen.laporan-braille');
})->name('dokumen.laporan-braille');

// Download Route
Route::get('/download/{model}/{id}', [InformasiPublikController::class, 'downloadFile'])->name('download.file');
Route::get('/preview-dokumen', [ProfilPublikController::class, 'previewDokumen'])->name('preview.dokumen');
Route::get('/proxy-gdrive/{id}', [ProfilPublikController::class, 'proxyGdrive'])->name('proxy.gdrive');

Route::get('/faq', [FaqController::class, 'publicIndex'])->name('faq.public');

// Temporary diagnostic route to check categories in the live database
Route::get('/debug-live-categories', function() {
    try {
        $counts = \Illuminate\Support\Facades\DB::table('daftar_informasis')
            ->select('kategori', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();
        
        $migrations = \Illuminate\Support\Facades\DB::table('migrations')->get();
        
        return response()->json([
            'database' => \Illuminate\Support\Facades\DB::connection()->getDatabaseName(),
            'category_counts' => $counts,
            'migrations' => $migrations
        ], 200, [], JSON_PRETTY_PRINT);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

// Fallback storage server route (serves storage files directly via Laravel when public/storage symlink is broken)
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
})->where('path', '.*');
// Public Berita Routes
Route::get('/berita', [\App\Http\Controllers\BeritaController::class, 'publicIndex'])->name('berita.public');
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'publicShow'])->name('berita.public.show');
