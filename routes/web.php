<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProsedurController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Auth\LoginController;

// ==========================================
// 1. FRONT OFFICE
// ==========================================
Route::get('/', function () { 
    return view('welcome', ['dokumen' => [], 'artikel' => []]); 
})->name('home');

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
        Route::get('/edit', [ProfilController::class, 'edit'])->name('edit');
        Route::get('/tugas', [ProfilController::class, 'tugas'])->name('tugas');
        Route::get('/visi', [ProfilController::class, 'visi'])->name('visi');
        Route::get('/struktur', [ProfilController::class, 'struktur'])->name('struktur');
        Route::get('/regulasi', [ProfilController::class, 'regulasi'])->name('regulasi');
        Route::get('/kontak', [ProfilController::class, 'kontak'])->name('kontak');
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
    Route::resource('prosedur', ProsedurController::class)->names('admin.prosedur');
    Route::resource('faq', FaqController::class)->names('admin.faq');

    // Link Aplikasi Terkait
    Route::get('/lpse', function() { return "Halaman LPSE"; })->name('admin.lpse.index');
    Route::get('/jdih', function() { return "Halaman JDIH"; })->name('admin.jdih.index');

    Route::get('/user-management', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
});