<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data dengan aman (cek tabel dulu)
        $data = [
            'totalBerita'  => Schema::hasTable('beritas') ? DB::table('beritas')->count() : 0,
            'totalDokumen' => Schema::hasTable('dokumens') ? DB::table('dokumens')->count() : 0,
            'totalUser'    => Schema::hasTable('users') ? DB::table('users')->count() : 0,
            'totalFaq'     => Schema::hasTable('faqs') ? DB::table('faqs')->count() : 0,
            'last_update'  => date('d M Y H:i')
        ];

        return view('admin.dashboard', $data);
    }

    public function users() { return "Halaman User Management"; }
    public function settings() { return "Halaman Settings"; }
}