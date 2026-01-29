<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Set nilai awal 0 untuk keamanan
        $totalBerita = 0;
        $totalDokumen = 0;
        $totalProsedur = 0;
        $totalFaq = 0;

        try {
            // Kita cek apakah tabel beritas ada di database sebelum menghitung
            if (Schema::hasTable('beritas')) {
                $totalBerita = Berita::count();
            }
        } catch (\Exception $e) {
            // Jika ada error database, biarkan tetap 0 agar tidak Error 500
            $totalBerita = 0;
        }

        $data = [
            'totalBerita'   => $totalBerita,
            'totalDokumen'  => $totalDokumen, 
            'totalProsedur' => $totalProsedur, 
            'totalFaq'      => $totalFaq, 
        ];

        // Ini memanggil file dashboard.blade.php yang baru saja kamu buat
        return view('admin.dashboard', $data);
    }
}