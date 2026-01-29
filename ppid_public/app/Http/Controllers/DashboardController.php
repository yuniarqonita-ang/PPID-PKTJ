<?php

namespace App\Http\Controllers;

// Import semua Model yang dibutuhkan agar tidak error "Class not found"
use App\Models\Berita;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan statistik lengkap.
     */
    public function index()
    {
        // 1. Inisialisasi semua variabel ke angka 0
        $totalBerita = 0;
        $totalUser = 0;
        $totalDokumen = 0;
        $totalFaq = 0;

        try {
            // 2. Cek dan Hitung Berita
            if (Schema::hasTable('beritas')) {
                $totalBerita = Berita::count();
            }

            // 3. Cek dan Hitung User (Pemohon Informasi)
            if (Schema::hasTable('users')) {
                $totalUser = User::count();
            }

            // 4. Cek dan Hitung Dokumen Publik
            if (Schema::hasTable('dokumens')) {
                $totalDokumen = Dokumen::count();
            }

            // 5. Cek dan Hitung FAQ
            if (Schema::hasTable('faqs')) {
                $totalFaq = Faq::count();
            }

        } catch (\Exception $e) {
            // Jika ada error database, kita abaikan agar dashboard tetap tampil (angka tetap 0)
        }

        // 6. Bungkus semua data untuk dikirim ke view
        $data = [
            'totalBerita'   => $totalBerita,
            'totalUser'     => $totalUser,
            'totalDokumen'  => $totalDokumen, 
            'totalFaq'      => $totalFaq,
            'last_update'   => date('d M Y H:i'), // Tambahan: Info waktu update terakhir
        ];

        // 7. Arahkan ke file resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', $data);
    }

    /**
     * FITUR TAMBAHAN: Logout Manual untuk fix error 419 Page Expired
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}