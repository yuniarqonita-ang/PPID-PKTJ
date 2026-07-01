<?php

if (!function_exists('is_previewable')) {
    function is_previewable($file_path) {
        if (!$file_path || $file_path === '#' || $file_path === '') {
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
// DB MIGRATION & CLEANUP: Permanently Drop Keberatans & Obsolete Views
// ==========================================
try {
    // 1. Run migrations programmatically if the latest recovery migration hasn't run yet
    $hasTable = \Illuminate\Support\Facades\Schema::hasTable('migrations');
    $hasRun = false;
    if ($hasTable) {
        $hasRun = \Illuminate\Support\Facades\DB::table('migrations')
            ->where('migration', '2026_06_11_030000_convert_sop_hardcoded_to_dokumens')
            ->exists();
    }
    
    if (!$hasRun) {
        // Run pending migrations
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        
        // Seed any missing dashboard/default configurations if needed
        if (\Illuminate\Support\Facades\Schema::hasTable('dashboards')) {
            \App\Models\Dashboard::updateOrCreate(
                ['key' => 'laporan_layanan_ringkasan_eksekutif'],
                ['value' => '<p>Laporan Pelayanan Informasi Publik menyajikan rincian statistik permohonan informasi yang diterima, diproses, dan diselesaikan oleh PPID PKTJ. Laporan ini merefleksikan transparansi, akuntabilitas, dan komitmen penuh kami dalam melayani seluruh kebutuhan informasi publik masyarakat.</p>', 'type' => 'text', 'aktif' => true]
            );
            \App\Models\Dashboard::updateOrCreate(
                ['key' => 'laporan_akses_ringkasan_eksekutif'],
                ['value' => '<p>Laporan Akses Informasi menyajikan statistik kunjungan dan frekuensi akses masyarakat terhadap layanan informasi publik PPID PKTJ. Data ini digunakan untuk terus mengevaluasi dan meningkatkan aksesibilitas portal informasi kami agar semakin mudah dijangkau.</p>', 'type' => 'text', 'aktif' => true]
            );
            \App\Models\Dashboard::updateOrCreate(
                ['key' => 'laporan_survey_ringkasan_eksekutif'],
                ['value' => '<p>Laporan Indeks Survey Kepuasan Masyarakat menyajikan hasil evaluasi masyarakat terhadap kualitas pelayanan informasi publik PPID PKTJ. Hasil survey ini menjadi acuan utama kami untuk terus berinovasi dan memperbaiki kualitas layanan demi kepuasan publik.</p>', 'type' => 'text', 'aktif' => true]
            );
        }

        // Clear view cache so new views take effect immediately
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }
    }

    // Translate/Update document category names to the exact long spelling
    if (\Illuminate\Support\Facades\Schema::hasTable('dokumens')) {
        \Illuminate\Support\Facades\DB::table('dokumens')
            ->where('kategori', 'SOP Pendokumentasian')
            ->update(['kategori' => 'SOP Pendokumentasian Informasi Publik']);
        \Illuminate\Support\Facades\DB::table('dokumens')
            ->where('kategori', 'SOP Permintaan Informasi')
            ->update(['kategori' => 'SOP Permintaan Informasi Publik']);
        \Illuminate\Support\Facades\DB::table('dokumens')
            ->where('kategori', 'SOP Pengajuan Sengketa')
            ->update(['kategori' => 'SOP Pengajuan Sengketa Informasi Publik']);
        \Illuminate\Support\Facades\DB::table('dokumens')
            ->where('kategori', 'SOP Penetapan Pemutakhiran')
            ->update(['kategori' => 'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik']);
    }

    if (\Illuminate\Support\Facades\Schema::hasTable('keberatans')) {
        \Illuminate\Support\Facades\Schema::dropIfExists('keberatans');
    }
    // Delete obsolete Keberatan view files
    $filesToDelete = [
        resource_path('views/admin/reports/templates/register_keberatan_word.blade.php'),
        resource_path('views/admin/reports/templates/form_keberatan.blade.php'),
        resource_path('views/admin/keberatan/edit.blade.php'),
        resource_path('views/admin/keberatan/form.blade.php'),
        resource_path('views/admin/keberatan/index.blade.php'),
        resource_path('views/admin/keberatan/show.blade.php'),
    ];
    foreach ($filesToDelete as $file) {
        if (file_exists($file)) {
            @unlink($file);
        }
    }
    if (is_dir(resource_path('views/admin/keberatan'))) {
        @rmdir(resource_path('views/admin/keberatan'));
    }
} catch (\Exception $e) {
    // Silent
}

// ==========================================
// 0. REDIRECT URL LAMA (.html)
// ==========================================
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
        if (\Illuminate\Support\Facades\Schema::hasTable('beritas')) {
            $query = \App\Models\Berita::where('aktif', true);
            if (\Illuminate\Support\Facades\Schema::hasColumn('beritas', 'tanggal')) {
                $query->orderBy('tanggal', 'desc');
            }
            $artikel = $query->orderBy('created_at', 'desc')->take(3)->get();
        }
        
        return view('welcome', compact('dokumen', 'artikel')); 
    } catch (\Exception $e) {
        $dokumen = collect([]);
        $artikel = collect([]);
        return view('welcome', compact('dokumen', 'artikel'));
    }
})->name('home');

// Track visitor (enabled with database self-healing)
try {
    if (!\Illuminate\Support\Facades\Schema::hasTable('visitors')) {
        \Illuminate\Support\Facades\Schema::create('visitors', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->text('user_agent')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    \App\Models\Visitor::firstOrCreate([
        'ip' => request()->ip(),
        'tanggal' => date('Y-m-d')
    ], [
        'user_agent' => request()->userAgent()
    ]);
} catch (\Exception $e) {
    // Fail silently to prevent site crash if DB issue
}

// Profil Publik
Route::get('/profil', [ProfilPpidController::class, 'showPublic'])->name('profil.public');

// Permohonan Informasi Routes (Public)
Route::get('/permohonan-informasi', [PermohonanController::class, 'form'])->name('permohonan.form');
Route::get('/permohonan', [PermohonanController::class, 'form']); // Alias for shorter URL
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');
Route::post('/permohonan', [PermohonanController::class, 'store']); // Alias for shorter URL form submission



// Dokumentasi (Public)
Route::get('/dokumen', [DokumenController::class, 'publicList'])->name('dokumen.public');
Route::get('/dokumen/{id}/view', [DokumenController::class, 'view'])->name('dokumen.view');
Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])->name('dokumen.download');

// Profil PPID (Public - Dynamic from Database matching the original HTML links)
Route::get('/profil-ppid.html', [\App\Http\Controllers\ProfilPublikController::class, 'showProfil'])->name('profil.ppid.html');
Route::get('/profil-tugas-tanggung-jawab.html', [\App\Http\Controllers\ProfilPublikController::class, 'showTugas'])->name('profil.tugas.html');
Route::get('/profil-visi-misi.html', [\App\Http\Controllers\ProfilPublikController::class, 'showVisi'])->name('profil.visi.html');
Route::get('/profil-struktur-organisasi.html', [\App\Http\Controllers\ProfilPublikController::class, 'showStruktur'])->name('profil.struktur.html');
Route::get('/profil-regulasi.html', [\App\Http\Controllers\ProfilPublikController::class, 'showRegulasi'])->name('profil.regulasi.html');
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
Route::get('/layanan-informasi/laporan-survey', [ProfilPublikController::class, 'showPage'])->defaults('type', 'laporan-survey')->defaults('view', 'laporan-survey-kepuasan')->name('layanan.laporan-survey');


// ==========================================
// 2. AUTH SYSTEM (LOGIN & LOGOUT)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout dibuat fleksibel agar tidak error di app.blade maupun dashboard.blade
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// ==========================================
// 3. ADMIN DASHBOARD (BACK OFFICE)
// ==========================================
Route::redirect('/dashboard', '/admin');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    
    // Content management routes
    Route::get('/content', function() { return view('admin.content.index'); })->name('content.index');
    
    // Halaman management routes
    Route::get('/halaman', function() { return view('admin.halaman.index'); })->name('halaman.index');

    // Menu Profil PPID
    Route::name('admin.profil.')->prefix('profil')->group(function () {
        // Dashboard menunjukkan semua profil sections (Redirect to Halaman hub)
        Route::get('/', function() { return redirect()->route('halaman.index'); })->name('index');
        
        // CRUD untuk setiap tipe profil
        Route::get('/profil/{type}', [ProfilPpidController::class, 'edit'])->name('edit');
        Route::put('/profil/{type}', [ProfilPpidController::class, 'update'])->name('update');

        Route::delete('/{type}', [ProfilPpidController::class, 'destroy'])->name('destroy');
    });

    // Pesan Kontak
    Route::get('/pesan-kontak', [\App\Http\Controllers\PesanKontakController::class, 'index'])->name('admin.pesan-kontak.index');
    Route::get('/pesan-kontak/{id}', [\App\Http\Controllers\PesanKontakController::class, 'show'])->name('admin.pesan-kontak.show');
    Route::delete('/pesan-kontak/{id}', [\App\Http\Controllers\PesanKontakController::class, 'destroy'])->name('admin.pesan-kontak.destroy');

    // Temporary route to run migrations and fix db on cPanel
    Route::get('/setup-db-2025', function() {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            return 'Database migrated successfully!';
        } catch (\Exception $e) {
            return 'Migration error: ' . $e->getMessage();
        }
    });



    // Agenda CRUD
    Route::resource('agenda', AgendaController::class)->names('admin.agenda');

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
        Route::get('/laporan-survey', function() { return view('admin.layanan.laporan-survey'); })->name('laporan-survey');
    });

    // Menu Prosedur
    Route::name('admin.prosedur.')->prefix('prosedur')->group(function () {
        Route::get('/sop-permintaan', function() { return view('admin.prosedur.sop-permintaan'); })->name('sop-permintaan');
        Route::get('/sop-keberatan', function() { return view('admin.prosedur.sop-keberatan'); })->name('sop-keberatan');
        Route::get('/sop-sengketa', function() { return view('admin.prosedur.sop-sengketa'); })->name('sop-sengketa');
        Route::get('/sop-penetapan', function() { return view('admin.prosedur.sop-penetapan'); })->name('sop-penetapan');
        Route::get('/sop-pengujian', function() { return view('admin.prosedur.sop-pengujian'); })->name('sop-pengujian');
        Route::get('/sop-pendokumentasian', function() { return view('admin.prosedur.sop-pendokumentasian'); })->name('sop-pendokumentasian');
        
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

    // Resource CRUD
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur-crud', ProsedurController::class)->names('admin.prosedur-crud');
    
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

    Route::resource('/user-management', UserController::class)->names('admin.users')->parameters(['user-management' => 'user']);
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');

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
    Route::get('/tugas', [ProfilPublikController::class, 'showTugas'])->name('tugas');
    Route::get('/tugas-tanggung-jawab', [ProfilPublikController::class, 'showTugas'])->name('tugas-tanggung-jawab');
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
    Route::get('/sop-permintaan-informasi', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_permintaan')->defaults('view', 'sop-permintaan')->name('sop-permintaan');
    Route::get('/sop-penanganan-keberatan', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_keberatan')->defaults('view', 'sop-penanganan-keberatan')->name('sop-keberatan');
    Route::get('/sop-pengajuan-sengketa', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_sengketa')->defaults('view', 'sop-sengketa')->name('sop-sengketa');
    Route::get('/sop-penetapan-pemutakhiran', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_penetapan')->defaults('view', 'sop-pemutakhiran-daftar')->name('sop-penetapan');
    Route::get('/sop-pengujian-konsekuensi', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_pengujian')->defaults('view', 'sop-pengujian-konsekuensi')->name('sop-pengujian');
    Route::get('/sop-pendokumentasian', [ProfilPublikController::class, 'showPage'])->defaults('type', 'sop_pendokumentasian')->defaults('view', 'sop-pendokumentasian')->name('sop-pendokumentasian');
    
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

Route::get('/agenda', [AgendaController::class, 'publicIndex'])->name('agenda.public');
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