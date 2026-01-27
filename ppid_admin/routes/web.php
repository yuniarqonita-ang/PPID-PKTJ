<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('berita', BeritaController::class);
        Route::resource('dokumen', DokumenController::class);
        
        // Rute Profil PPID
        Route::get('/profil-ppid', function() { return view('admin.profil.index'); })->name('profil.edit');

        // Rute Menu Tambahan
        Route::get('/prosedur-sop', function() { return view('admin.prosedur.index'); })->name('prosedur.index');
        Route::get('/lpse-pengadaan', function() { return view('admin.lpse.index'); })->name('lpse.index');
        Route::get('/faq-admin', function() { return view('admin.faq.index'); })->name('faq.index');
    });
});

require __DIR__.'/auth.php';