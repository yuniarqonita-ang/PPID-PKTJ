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
            $query = \App\Models\DaftarInformasi::where('aktif', true);
            
            // Search filters
            if (request('informasi')) {
                $query->where('judul_informasi', 'like', '%' . request('informasi') . '%');
            }
            if (request('ringkasan')) {
                $query->where('isi_informasi', 'like', '%' . request('ringkasan') . '%');
            }
            if (request('tahun')) {
                $query->where('waktu_pembuatan', 'like', '%' . request('tahun') . '%');
            }
            if (request('penanggung_jawab')) {
                $query->where('penanggung_jawab', 'like', '%' . request('penanggung_jawab') . '%');
            }

            // Category filter
            if (request('kategori')) {
                $query->where('kategori', request('kategori'));
            }

            $extraData['items'] = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
            
            // Get available years for dropdown
            $extraData['years'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(waktu_pembuatan) as tahun')
                ->whereNotNull('waktu_pembuatan')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');

            // Get available units for dropdown
            $extraData['units'] = \App\Models\DaftarInformasi::selectRaw('DISTINCT(penanggung_jawab) as unit')
                ->whereNotNull('penanggung_jawab')
                ->orderBy('unit', 'asc')
                ->pluck('unit');
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
     * Preview Document in-page
     */
    public function previewDokumen(\Illuminate\Http\Request $request)
    {
        $file_path = $request->query('file');
        $title = $request->query('title');

        if (!$file_path) {
            abort(404, 'File path is required');
        }

        // Search for is_blurred flag
        $isBlurred = false;
        // The file_path usually starts with storage/
        $searchPath = $file_path;
        
        $di = \App\Models\DaftarInformasi::where('file_informasi', $searchPath)->first();
        if ($di) {
            $isBlurred = $di->is_blurred;
        } else {
            $doc = \App\Models\Dokumen::where('file_path', $searchPath)->first();
            if ($doc) {
                $isBlurred = $doc->is_blurred;
            }
        }

        $settings = Dashboard::pluck('value', 'key')->toArray();

        return view('preview-dokumen', compact('file_path', 'title', 'settings', 'isBlurred'));
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
