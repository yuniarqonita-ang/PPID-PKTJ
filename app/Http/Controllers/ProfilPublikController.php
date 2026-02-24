<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use App\Models\Peraturan;

class ProfilPublikController extends Controller
{
    public function showProfil()
    {
        $profil = ProfilPpid::where('type', 'profil')->first();
        return view('profil-ppid', ['profil' => $profil]);
    }

    public function showTugas()
    {
        $profil = ProfilPpid::where('type', 'tugas')->first();
        return view('profil-tugas-tanggung-jawab', ['profil' => $profil]);
    }

    public function showVisi()
    {
        $profil = ProfilPpid::where('type', 'visi')->first();
        return view('profil-visi-misi', ['profil' => $profil]);
    }

    public function showStruktur()
    {
        $profil = ProfilPpid::where('type', 'struktur')->first();
        return view('profil-struktur-organisasi', ['profil' => $profil]);
    }

    public function showRegulasi()
    {
        $profil = ProfilPpid::where('type', 'regulasi')->first();
        $peraturan = Peraturan::where('is_active', true)->get()->groupBy('kategori');
        return view('profil-regulasi', ['profil' => $profil, 'peraturan' => $peraturan]);
    }

    public function showKontak()
    {
        $profil = ProfilPpid::where('type', 'kontak')->first();
        return view('profil-kontak', ['profil' => $profil]);
    }

    /**
     * View PDF peraturan (modal preview / new tab)
     */
    public function viewPeraturan($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        return view('peraturan-view', compact('peraturan'));
    }
}
