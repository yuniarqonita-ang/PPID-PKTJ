<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Peraturan;

class ProfilPublikController extends Controller
{
    public function showProfil()
    {
        $profil = Profil::getByType('profil');
        return view('profil-ppid', ['profil' => $profil]);
    }

    public function showTugas()
    {
        $profil = Profil::getByType('tugas');
        return view('profil-tugas-tanggung-jawab', ['profil' => $profil]);
    }

    public function showVisi()
    {
        $profil = Profil::getByType('visi');
        return view('profil-visi-misi', ['profil' => $profil]);
    }

    public function showStruktur()
    {
        $profil = Profil::getByType('struktur');
        return view('profil-struktur-organisasi', ['profil' => $profil]);
    }

    public function showRegulasi()
    {
        $profil = Profil::getByType('regulasi');
        $peraturan = Peraturan::where('is_active', true)->get()->groupBy('kategori');
        return view('profil-regulasi', ['profil' => $profil, 'peraturan' => $peraturan]);
    }

    public function showKontak()
    {
        $profil = Profil::getByType('kontak');
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
