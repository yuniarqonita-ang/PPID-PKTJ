<?php

namespace App\Http\Controllers;

use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiDikecualikan;
use App\Models\Prosedur;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Storage;

class InformasiPublikController extends Controller
{
    private function getSettings()
    {
        return Dashboard::pluck('value', 'key')->toArray();
    }

    // Informasi Berkala
    public function informasiBerkala()
    {
        $informasi = InformasiBerkala::where('status', 1)->orderBy('tanggal', 'desc')->get();
        $settings = $this->getSettings();
        return view('informasi-berkala', compact('informasi', 'settings'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $informasi = InformasiSertaMerta::where('status', 1)->orderBy('tanggal', 'desc')->get();
        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('informasi', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $informasi = InformasiSetiapSaat::where('status', 1)->orderBy('tanggal', 'desc')->get();
        $settings = $this->getSettings();
        return view('informasi-setiap-saat', compact('informasi', 'settings'));
    }

    // Informasi Dikecualikan
    public function informasiDikecualikan()
    {
        $informasi = InformasiDikecualikan::where('status', 1)->orderBy('tanggal', 'desc')->get();
        $settings = $this->getSettings();
        return view('informasi-dikecualikan', compact('informasi', 'settings'));
    }

    // Prosedur
    public function prosedur($kategori = null)
    {
        // If coming from specific routes in web.php
        if (!$kategori) {
            $routeName = request()->route()->getName();
            $kategori = str_replace('prosedur.', '', $routeName);
        }

        $settings = $this->getSettings();
        // For Prosedur, we might want to use ProfilPpid with type 'prosedur' or just the Prosedur model
        // Based on web.php, it's mostly static views now. We can make them dynamic here if needed.
        return view('prosedur.' . $kategori, compact('settings'));
    }

    // Download file
    public function downloadFile($model, $id)
    {
        switch($model) {
            case 'berkala':
                $data = InformasiBerkala::findOrFail($id);
                break;
            case 'sertamerta':
                $data = InformasiSertaMerta::findOrFail($id);
                break;
            case 'setiapsaat':
                $data = InformasiSetiapSaat::findOrFail($id);
                break;
            case 'dikecualikan':
                $data = InformasiDikecualikan::findOrFail($id);
                break;
            case 'prosedur':
                $data = Prosedur::findOrFail($id);
                break;
            default:
                abort(404);
        }

        // Clean path to remove /storage/ prefix if present in DB
        $path = str_replace('storage/', '', $data->file_path);
        
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan di storage: ' . $path);
        }

        return Storage::disk('public')->download($path, $data->file_name ?? basename($path));
    }
}
