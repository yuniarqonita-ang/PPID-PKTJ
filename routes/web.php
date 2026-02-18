<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProfilPpidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\ProfilPublicController;

// ==========================================
// 1. FRONT OFFICE
// ==========================================
Route::get('/', function () { 
    return view('welcome', ['dokumen' => [], 'artikel' => []]); 
})->name('home');

// Permohonan Informasi (Public)
Route::get('/permohonan-informasi', [PermohonanController::class, 'form'])->name('permohonan.form');
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');

// FAQ (Public)
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Profil PPID (Public)
Route::get('/profil/tugas-tanggung-jawab', [ProfilPublicController::class, 'tugasTanggungJawab'])->name('profil.tugas-tanggung-jawab');
Route::get('/profil/visi-misi', [ProfilPublicController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/struktur-organisasi', [ProfilPublicController::class, 'strukturOrganisasi'])->name('profil.struktur-organisasi');
Route::get('/profil/kontak', [ProfilPublicController::class, 'kontak'])->name('profil.kontak');

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
        Route::get('/edit', [ProfilPpidController::class, 'index'])->name('edit');
    });

    // Menu Informasi Publik
    Route::name('admin.informasi.')->prefix('informasi')->group(function () {
        Route::get('/berkala', function() { return view('admin.informasi.berkala'); })->name('berkala');
        Route::get('/serta-merta', function() { return view('admin.informasi.sertamerta'); })->name('sertamerta');
        Route::get('/setiap-saat', function() { return view('admin.informasi.setiapsaat'); })->name('setiapsaat');
        Route::get('/dikecualikan', function() { return view('admin.informasi.dikecualikan'); })->name('dikecualikan');
    });

    // Resource CRUD
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('permohonan', PermohonanController::class)->names('admin.permohonan');
    Route::resource('faq', AdminFaqController::class)->names('admin.faq');

    // Link Aplikasi Terkait
    Route::get('/lpse', function() { return "Halaman LPSE"; })->name('admin.lpse.index');
    Route::get('/jdih', function() { return "Halaman JDIH"; })->name('admin.jdih.index');

    Route::get('/user-management', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
});