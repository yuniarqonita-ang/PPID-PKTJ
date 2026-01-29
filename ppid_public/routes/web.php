<?php

use Illuminate\Support\Facades\Route;

// --- IMPORT SEMUA BIAR GAK ERROR CLASS NOT FOUND ---
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
| 1. RUANG TAMU (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $artikel = Berita::latest()->take(3)->get();
    $dokumen = Dokumen::latest()->take(6)->get();
    return view('welcome', compact('artikel', 'dokumen'));
})->name('welcome');

/*
|--------------------------------------------------------------------------
| 2. SISTEM LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

// Fix Logout
Route::post('/admin/logout-action', [DashboardController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| 3. DAPUR ADMIN (PPID BACK OFFICE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Data
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('dokumen', DokumenController::class)->names('admin.dokumen');
    Route::resource('prosedur', ProsedurController::class)->names('admin.prosedur');
    Route::resource('faq', FaqController::class)->names('admin.faq');

    // Menu Profil
    Route::name('admin.profil.')->prefix('profil')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('/tugas', [ProfileController::class, 'edit'])->name('tugas');
        Route::get('/visi-misi', [ProfileController::class, 'edit'])->name('visi');
        Route::get('/struktur', [ProfileController::class, 'edit'])->name('struktur');
        Route::get('/regulasi', [ProfileController::class, 'edit'])->name('regulasi');
        Route::get('/kontak', [ProfileController::class, 'edit'])->name('kontak');
    });

    // Menu Informasi
    Route::name('admin.informasi.')->prefix('informasi')->group(function () {
        Route::get('/berkala', [DokumenController::class, 'index'])->name('berkala');
        Route::get('/serta-merta', [DokumenController::class, 'index'])->name('sertamerta');
        Route::get('/setiap-saat', [DokumenController::class, 'index'])->name('setiapsaat');
        Route::get('/dikecualikan', [DokumenController::class, 'index'])->name('dikecualikan');
    });

    /**
     * FIX ERROR BARIS 95: Menambahkan rute LPSE & JDIH
     */
    Route::get('/lpse', function() { return view('admin.lpse.index'); })->name('admin.lpse.index');
    Route::get('/jdih', function() { return view('admin.jdih.index'); })->name('admin.jdih.index');
});