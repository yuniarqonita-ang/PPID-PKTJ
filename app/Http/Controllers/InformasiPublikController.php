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

    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }

    // Informasi Berkala
    public function informasiBerkala()
    {
        $items = InformasiBerkala::where('aktif', true)->orderBy('created_at', 'desc')->get();
        foreach ($items as $item) {
            $item->deskripsi = $this->processContent($item->deskripsi, $item->is_blurred ?? false);
        }
        $settings = $this->getSettings();
        return view('informasi-berkala', compact('items', 'settings'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $items = InformasiSertaMerta::where('aktif', true)->orderBy('created_at', 'desc')->get();
        foreach ($items as $item) {
            $item->deskripsi = $this->processContent($item->deskripsi, $item->is_blurred ?? false);
        }
        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('items', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $items = InformasiSetiapSaat::where('aktif', true)->orderBy('created_at', 'desc')->get();
        foreach ($items as $item) {
            $item->deskripsi = $this->processContent($item->deskripsi, $item->is_blurred ?? false);
        }
        $settings = $this->getSettings();
        return view('informasi-setiap-saat', compact('items', 'settings'));
    }

    // Informasi Dikecualikan
    public function informasiDikecualikan()
    {
        $items = InformasiDikecualikan::where('aktif', true)->orderBy('created_at', 'desc')->get();
        foreach ($items as $item) {
            $item->deskripsi = $this->processContent($item->deskripsi, $item->is_blurred ?? false);
        }
        $settings = $this->getSettings();
        return view('informasi-dikecualikan', compact('items', 'settings'));
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
