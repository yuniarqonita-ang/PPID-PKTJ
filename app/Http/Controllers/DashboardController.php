<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek tabel ada atau tidak, biar gak error
        $data = [
            'totalBerita'   => Schema::hasTable('beritas') ? Berita::count() : 0,
            'totalUser'     => Schema::hasTable('users') ? User::count() : 0,
            'totalDokumen'  => Schema::hasTable('dokumens') ? Dokumen::count() : 0,
            'totalFaq'      => Schema::hasTable('faqs') ? Faq::count() : 0,
            'last_update'   => date('d M Y H:i'),
        ];

        return view('admin.dashboard', $data);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Balik ke login biar aman
        return redirect('/login');
    }
}