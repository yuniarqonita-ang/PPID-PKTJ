<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProsedurController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfilPpidController;
use App\Http\Controllers\ProfilPublikController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\Auth\LoginController;

// ==========================================
// 1. FRONT OFFICE
// ==========================================
Route::get('/', function () { 
    return view('welcome', ['dokumen' => [], 'artikel' => []]); 
})->name('home');

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
Route::get('/profil/ppid', [ProfilPublikController::class, 'showProfil'])->name('profil.ppid');
Route::get('/profil/tugas-tanggung-jawab', [ProfilPublikController::class, 'showTugas'])->name('profil.tugas-tanggung-jawab');
Route::get('/profil/visi-misi', [ProfilPublikController::class, 'showVisi'])->name('profil.visi-misi');
Route::get('/profil/struktur-organisasi', [ProfilPublikController::class, 'showStruktur'])->name('profil.struktur-organisasi');
Route::get('/profil/regulasi', [ProfilPublikController::class, 'showRegulasi'])->name('profil.regulasi');
Route::get('/profil/regulasi/{id}', [ProfilPublikController::class, 'viewPeraturan'])->name('profil.peraturan-view');
Route::get('/profil/kontak', [ProfilPublikController::class, 'showKontak'])->name('profil.kontak');

// Informasi Publik (Public)
Route::get('/informasi-publik/berkala', function () {
    return view('informasi-berkala');
})->name('informasi.berkala');

Route::get('/informasi-publik/serta-merta', [BeritaController::class, 'sertaMerta'])->name('informasi.serta-merta');

Route::get('/informasi-publik/setiap-saat', [BeritaController::class, 'setiapSaat'])->name('informasi.setiap-saat');

Route::get('/informasi-publik/dikecualikan', [DokumenController::class, 'dikecualikan'])->name('informasi.dikecualikan');

Route::get('/layanan-informasi/daftar', function () { return view('daftar-informasi-publik'); })->name('layanan.daftar-informasi');

Route::get('/layanan-informasi/maklumat', function () { return view('maklumat-pelayanan'); })->name('layanan.maklumat-pelayanan');

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
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Profil PPID
    Route::name('admin.profil.')->prefix('profil')->group(function () {
        // Dashboard menunjukkan semua profil sections
        Route::get('/', [ProfilPpidController::class, 'index'])->name('index');
        
        // CRUD untuk setiap tipe profil
        Route::get('/{type}', [ProfilPpidController::class, 'edit'])->name('edit');
        Route::put('/{type}', [ProfilPpidController::class, 'update'])->name('update');
        Route::delete('/{type}', [ProfilPpidController::class, 'destroy'])->name('destroy');
    });

    // Menu Layanan Informasi
    Route::name('admin.layanan.')->prefix('layanan')->group(function () {
        Route::get('/daftar-informasi', function() { return view('admin.layanan.daftar-informasi'); })->name('daftar-informasi');
        Route::get('/daftar-informasi/create', function() { return view('admin.layanan.daftar-informasi-create'); })->name('daftar-informasi.create');
        Route::get('/maklumat-pelayanan', function() { return view('admin.layanan.maklumat-pelayanan'); })->name('maklumat-pelayanan');
    });

    // Menu Informasi Publik
    Route::name('admin.informasi.')->prefix('informasi')->group(function () {
        Route::get('/berkala', function() { return view('admin.informasi.berkala'); })->name('berkala');
        Route::get('/serta-merta', function() { return view('admin.informasi.sertamerta'); })->name('sertamerta');
        Route::get('/setiap-saat', function() { return view('admin.informasi.setiapsaat'); })->name('setiapsaat');
        Route::get('/dikecualikan', function() { return view('admin.informasi.dikecualikan'); })->name('dikecualikan');
        
        // Create routes for upload forms
        Route::get('/berkala/create', function() { return view('admin.informasi.berkala-create'); })->name('berkala.create');
        Route::get('/serta-merta/create', function() { return view('admin.informasi.sertamerta-create'); })->name('sertamerta.create');
        Route::get('/setiap-saat/create', function() { return view('admin.informasi.setiapsaat-create'); })->name('setiapsaat.create');
        Route::get('/dikecualikan/create', function() { return view('admin.informasi.dikecualikan-create'); })->name('dikecualikan.create');
    });

    // Resource CRUD
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur', ProsedurController::class)->names('admin.prosedur');
    Route::resource('faq', FaqController::class)->names('admin.faq');

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

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/permohonan', function() { return view('permohonan'); })->name('permohonan.form');