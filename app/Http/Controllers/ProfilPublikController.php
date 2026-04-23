<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use App\Models\Peraturan;
use App\Models\Dashboard;

class ProfilPublikController extends Controller
{
    public function showProfil()
    {
        $profil = ProfilPpid::where('type', 'profil')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-ppid', compact('profil', 'settings'));
    }

    public function showTugas()
    {
        $profil = ProfilPpid::where('type', 'tugas')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-tugas-tanggung-jawab', compact('profil', 'settings'));
    }

    public function showVisi()
    {
        $profil = ProfilPpid::where('type', 'visi')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-visi-misi', compact('profil', 'settings'));
    }

    public function showStruktur()
    {
        $profil = ProfilPpid::where('type', 'struktur')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-struktur-organisasi', compact('profil', 'settings'));
    }

    public function showRegulasi()
    {
        $profil = ProfilPpid::where('type', 'regulasi')->first();
        $peraturan = Peraturan::where('is_active', true)->get()->groupBy('kategori');
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-regulasi', compact('profil', 'peraturan', 'settings'));
    }

    public function showKontak()
    {
        $profil = ProfilPpid::where('type', 'kontak')->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('profil-kontak', compact('profil', 'settings'));
    }

    /**
     * Generic method for dynamic pages (SOP, Maklumat, Laporan)
     */
    public function showPage($type, $view = null)
    {
        $profil = ProfilPpid::where('type', $type)->first();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        
        // If view is not provided, try to find a matching view or use a default
        $viewName = $view ?? $type;
        
        // Special case: Daftar Informasi Publik needs all info types
        $extraData = [];
        if ($type === 'layanan-daftar') {
            $extraData['berkala'] = \App\Models\InformasiBerkala::where('aktif', true)->orderBy('created_at', 'desc')->get();
            $extraData['sertamerta'] = \App\Models\InformasiSertaMerta::where('aktif', true)->orderBy('created_at', 'desc')->get();
            $extraData['setiapsaat'] = \App\Models\InformasiSetiapSaat::where('aktif', true)->orderBy('created_at', 'desc')->get();
        }

        // Fetch reports dynamically based on type
        if ($type === 'laporan-layanan') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Layanan')->latest()->get();
        } elseif ($type === 'laporan-akses') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Akses')->latest()->get();
        } elseif ($type === 'laporan-survey') {
            $extraData['laporan'] = \App\Models\Dokumen::where('kategori', 'Laporan Survey')->latest()->get();
        }

        // Check if view exists, otherwise use a generic skeleton
        if (!view()->exists($viewName)) {
            $viewName = str_replace('-', '_', $viewName);
            if (!view()->exists($viewName)) {
                return view('profil-ppid', array_merge(compact('profil', 'settings'), $extraData));
            }
        }

        return view($viewName, array_merge(compact('profil', 'settings'), $extraData));
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
