<?php

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

// ==========================================
// 1. FRONT OFFICE
// ==========================================
Route::get('/', function () { 
    try {
        // Ambil data dari database
        $dokumen = \App\Models\Dokumen::where('aktif', true)->take(6)->get();
        $artikel = \App\Models\Berita::where('aktif', true)->take(3)->get();
        
        return view('welcome', compact('dokumen', 'artikel')); 
    } catch (\Exception $e) {
        // Jika error, tampilkan pesan error
        return response()->view('errors.500', [], 500);
    }
})->name('home');

// Track visitor
Visitor::create(['ip' => request()->ip(), 'tanggal' => now()]);

// Profil Publik
Route::get('/profil', [ProfilPpidController::class, 'showPublic'])->name('profil.public');

// Permohonan Informasi (Public)
Route::get('/permohonan-informasi', [PermohonanController::class, 'form'])->name('permohonan.form');
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');

// FAQ (Public)
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Dokumentasi (Public)
Route::get('/dokumen', [DokumenController::class, 'publicList'])->name('dokumen.public');
Route::get('/dokumen/{id}/view', [DokumenController::class, 'view'])->name('dokumen.view');
Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])->name('dokumen.download');

// Profil PPID (Public)
Route::get('/profil/ppid', function () { return view('profil-ppid'); })->name('profil.ppid');
Route::get('/profil/tugas-tanggung-jawab', function () { return view('profil-tugas-tanggung-jawab'); })->name('profil.tugas-tanggung-jawab');
Route::get('/profil/visi-misi', function () { return view('profil-visi-misi'); })->name('profil.visi-misi');
Route::get('/profil/struktur-organisasi', function () { return view('profil-struktur-organisasi'); })->name('profil.struktur-organisasi');
Route::get('/profil/regulasi', function () { return view('profil-regulasi'); })->name('profil.regulasi');
Route::get('/profil/kontak', function () { return view('profil-kontak'); })->name('profil.kontak');

// Informasi Publik (Public)
Route::get('/informasi-publik/berkala', function () {
    return view('informasi-berkala');
})->name('informasi.berkala');

Route::get('/informasi-publik/serta-merta', function () {
    return view('informasi-serta-merta');
})->name('informasi.serta-merta');

Route::get('/informasi-publik/setiap-saat', function () {
    return view('informasi-setiap-saat');
})->name('informasi.setiap-saat');

Route::get('/informasi-publik/dikecualikan', function () {
    return view('informasi-dikecualikan');
})->name('informasi.dikecualikan');

Route::get('/layanan-informasi/daftar', function () { return view('daftar-informasi-publik'); })->name('layanan.daftar-informasi');

Route::get('/layanan-informasi/maklumat', function () { return view('maklumat-pelayanan'); })->name('layanan.maklumat-pelayanan');

Route::get('/layanan-informasi/laporan', function () { return view('laporan-layanan-informasi'); })->name('layanan.laporan-layanan');

Route::get('/layanan-informasi/laporan-akses', function () { return view('laporan-akses-informasi-publik'); })->name('layanan.laporan-akses');

Route::get('/layanan-informasi/laporan-survey', function () { return view('laporan-survey-kepuasan'); })->name('layanan.laporan-survey');

// Prosedur (Public)
Route::get('/prosedur/sop-permintaan-informasi', function () {
    // Menggunakan view 'sop-permintaan' sesuai lokasi file Anda saat ini
    return view('sop-permintaan');
})->name('prosedur.sop-permintaan');

Route::get('/prosedur/sop-penanganan-keberatan', function () {
    return view('sop-penanganan-keberatan');
})->name('prosedur.sop-keberatan');

Route::get('/prosedur/sop-pengajuan-sengketa', function () {
    return view('sop-sengketa');
})->name('prosedur.sop-sengketa');

Route::get('/prosedur/sop-penetapan-pemutakhiran', function () {
    return view('sop-penetapan-pemutakhiran');
})->name('prosedur.sop-pemutakhiran');

Route::get('/prosedur/sop-pengujian-konsekuensi', function () {
    return view('sop-pengujian-konsekuensi');
})->name('prosedur.sop-pengujian');

Route::get('/prosedur/sop-pendokumentasian', function () {
    return view('sop-pendokumentasian');
})->name('prosedur.sop-pendokumentasian');

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
        // Dashboard menunjukkan semua profil sections
        Route::get('/', [ProfilPpidController::class, 'index'])->name('index');
        
        // CRUD untuk setiap tipe profil
        Route::get('/{type}', [ProfilPpidController::class, 'edit'])->name('edit');
        Route::put('/{type}', [ProfilPpidController::class, 'update'])->name('update');
        Route::delete('/{type}', [ProfilPpidController::class, 'destroy'])->name('destroy');
    });

    // Agenda CRUD
    Route::resource('agenda', AgendaController::class)->names('admin.agenda');

    // Informasi Berkala CRUD
    Route::name('admin.informasi.berkala.')->prefix('informasi-berkala')->group(function () {
        Route::get('/', [InformasiBerkalaController::class, 'index'])->name('index');
        Route::get('/create', [InformasiBerkalaController::class, 'create'])->name('create');
        Route::post('/', [InformasiBerkalaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [InformasiBerkalaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [InformasiBerkalaController::class, 'update'])->name('update');
        Route::delete('/{id}', [InformasiBerkalaController::class, 'destroy'])->name('destroy');
    });

    // Menu Layanan Informasi
    Route::name('admin.layanan.')->prefix('layanan')->group(function () {
        Route::get('/daftar-informasi', function() { return view('admin.layanan.daftar-informasi'); })->name('daftar-informasi');
        Route::get('/daftar-informasi/create', function() { return view('admin.layanan.daftar-informasi-create'); })->name('daftar-informasi.create');
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
        Route::get('/berkala', function() { return view('admin.informasi.berkala'); })->name('berkala');
        Route::get('/serta-merta', function() { return view('admin.informasi.sertamerta'); })->name('sertamerta');
        Route::get('/setiap-saat', function() { return view('admin.informasi.setiapsaat'); })->name('setiapsaat');
        Route::get('/dikecualikan', function() { return view('admin.informasi.dikecualikan'); })->name('dikecualikan');
        
        // Create routes for upload forms
        Route::get('/berkala/create', function() { return view('admin.informasi.berkala-create'); })->name('admin.informasi.berkala.create');
        Route::get('/serta-merta/create', function() { return view('admin.informasi.sertamerta-create'); })->name('admin.informasi.sertamerta.create');
        Route::get('/setiap-saat/create', function() { return view('admin.informasi.setiapsaat-create'); })->name('admin.informasi.setiapsaat.create');
        Route::get('/dikecualikan/create', function() { return view('admin.informasi.dikecualikan-create'); })->name('admin.informasi.dikecualikan.create');
    });

    // Resource CRUD
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur', ProsedurController::class)->names('admin.prosedur');
    
    // Custom FAQ routes for admin
    Route::get('/faq', [FaqController::class, 'adminIndex'])->name('admin.faq.index');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    
    // Permohonan Informasi routes
    Route::name('admin.permohonan.')->prefix('permohonan')->group(function () {
        Route::get('/', function() { return view('admin.permohonan.index'); })->name('index');
        Route::get('/form', function() { return view('admin.permohonan.form'); })->name('form');
        Route::post('/store', function() { 
            // Handle form submission logic here
            return redirect()->route('admin.permohonan.index')->with('success', 'Form permohonan berhasil disimpan!');
        })->name('store');
    });

    // Link Aplikasi Terkait
    Route::get('/lpse', function() { return "Halaman LPSE"; })->name('admin.lpse.index');
    Route::get('/jdih', function() { return "Halaman JDIH"; })->name('admin.jdih.index');

    Route::get('/user-management', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
});

// ==========================================
// 4. FRONTEND USER (PUBLIC PAGES)
// ==========================================
Route::name('profil.')->prefix('profil')->group(function () {
    Route::get('/', [ProfilPublikController::class, 'showProfil'])->name('index');
    Route::get('/tugas', [ProfilPublikController::class, 'showTugas'])->name('tugas');
    Route::get('/visi', [ProfilPublikController::class, 'showVisi'])->name('visi');
    Route::get('/struktur', [ProfilPublikController::class, 'showStruktur'])->name('struktur');
    Route::get('/regulasi', [ProfilPublikController::class, 'showRegulasi'])->name('regulasi');
    Route::get('/kontak', [ProfilPublikController::class, 'showKontak'])->name('kontak');
});

// Informasi Publik Routes
Route::name('informasi.')->prefix('informasi')->group(function () {
    Route::get('/berkala', [InformasiPublikController::class, 'informasiBerkala'])->name('berkala');
    Route::get('/serta-merta', [InformasiPublikController::class, 'informasiSertamerta'])->name('sertamerta');
    Route::get('/setiap-saat', [InformasiPublikController::class, 'informasiSetiapsaat'])->name('setiapsaat');
    Route::get('/dikecualikan', [InformasiPublikController::class, 'informasiDikecualikan'])->name('dikecualikan');
});

// Prosedur Routes
Route::name('prosedur.')->prefix('prosedur')->group(function () {
    Route::get('/sop-keberatan', [InformasiPublikController::class, 'prosedur'])->name('keberatan');
    Route::get('/sop-sengketa', [InformasiPublikController::class, 'prosedur'])->name('sengketa');
    Route::get('/sop-penetapan', [InformasiPublikController::class, 'prosedur'])->name('penetapan');
    Route::get('/sop-pengujian', [InformasiPublikController::class, 'prosedur'])->name('pengujian');
    Route::get('/sop-pendokumentasian', [InformasiPublikController::class, 'prosedur'])->name('pendokumentasian');
});

// Download Route
Route::get('/download/{model}/{id}', [InformasiPublikController::class, 'downloadFile'])->name('download.file');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.public');
Route::get('/permohonan', function() { return view('permohonan'); })->name('permohonan.form');