<?php

use Illuminate\Support\Facades\Route;

// --- IMPORT SEMUA CONTROLLER & MODEL (WAJIB) ---
use App\Models\Berita;
use App\Models\Dokumen;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProsedurController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Halaman Depan / Link Polosan)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Ngambil data terbaru biar Welcome Page gak kosong
    $artikel = Berita::latest()->take(3)->get();
    $dokumen = Dokumen::latest()->take(6)->get();
    return view('welcome', compact('artikel', 'dokumen'));
})->name('welcome');

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

// Route Logout khusus Admin
Route::post('/admin/logout-action', [DashboardController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES (BACK OFFICE LENGKAP)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KELOLA DATA UTAMA (CRUD)
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur', ProsedurController::class)->names('admin.prosedur');
    Route::resource('faq', FaqController::class)->names('admin.faq');

    // MENU PROFIL PPID (Fix Route Not Defined)
    Route::name('admin.profil.')->prefix('profil')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('/tugas', [ProfileController::class, 'edit'])->name('tugas');
        Route::get('/visi-misi', [ProfileController::class, 'edit'])->name('visi');
        Route::get('/struktur', [ProfileController::class, 'edit'])->name('struktur');
        Route::get('/regulasi', [ProfileController::class, 'edit'])->name('regulasi');
        Route::get('/kontak', [ProfileController::class, 'edit'])->name('kontak');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
    });

    // MENU INFORMASI PUBLIK
    Route::name('admin.informasi.')->prefix('informasi')->group(function () {
        Route::get('/berkala', [DokumenController::class, 'index'])->name('berkala');
        Route::get('/serta-merta', [DokumenController::class, 'index'])->name('sertamerta');
        Route::get('/setiap-saat', [DokumenController::class, 'index'])->name('setiapsaat');
        Route::get('/dikecualikan', [DokumenController::class, 'index'])->name('dikecualikan');
    });

    // FIX DASHBOARD ERROR: LPSE & JDIH (Baris 95-96)
    Route::get('/lpse', function() { return view('admin.lpse.index'); })->name('admin.lpse.index');
    Route::get('/jdih', function() { return view('admin.jdih.index'); })->name('admin.jdih.index');
});