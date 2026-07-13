<?php

namespace App\Http\Controllers;

use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiDikecualikan;
use App\Models\Prosedur;
use App\Models\Dashboard;
use App\Models\DaftarInformasi;
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

    private function mapDaftarInformasi($item)
    {
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $this->processContent($item->isi_informasi, $item->is_blurred ?? false);
        $item->file_path = $item->file_informasi;
        $item->tanggal = $item->created_at;
        $item->file_size = '-';
        return $item;
    }

    // Informasi Berkala
    public function informasiBerkala()
    {
        $rawItems = DaftarInformasi::where('aktif', true)
            ->where('kategori', 'informasi-berkala')
            ->whereNotNull('file_informasi')
            ->where('file_informasi', '!=', '')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->get();
            
        $items = $rawItems->map(function($item) {
            return $this->mapDaftarInformasi($item);
        });

        $settings = $this->getSettings();
        return view('informasi-berkala', compact('items', 'settings'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $rawItems = DaftarInformasi::where('aktif', true)
            ->where('kategori', 'informasi-serta-merta')
            ->whereNotNull('file_informasi')
            ->where('file_informasi', '!=', '')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        $items = $rawItems->map(function($item) {
            return $this->mapDaftarInformasi($item);
        });

        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('items', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $rawItems = DaftarInformasi::where('aktif', true)
            ->where('kategori', 'informasi-setiap-saat')
            ->whereNotNull('file_informasi')
            ->where('file_informasi', '!=', '')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        $items = $rawItems->map(function($item) {
            return $this->mapDaftarInformasi($item);
        });

        $settings = $this->getSettings();
        return view('informasi-setiap-saat', compact('items', 'settings'));
    }

    // Informasi Dikecualikan
    public function informasiDikecualikan(\Illuminate\Http\Request $request)
    {
        $query = InformasiDikecualikan::where('aktif', true)
            ->whereNotNull('file_path')
            ->where('file_path', '!=', '');

        if ($request->filled('informasi')) {
            $query->where('judul', 'like', '%' . $request->informasi . '%');
        }
        if ($request->filled('dasar_hukum')) {
            $query->where('dasar_hukum', 'like', '%' . $request->dasar_hukum . '%');
        }
        if ($request->filled('penanggung_jawab')) {
            $query->where('penanggung_jawab', 'like', '%' . $request->penanggung_jawab . '%');
        }

        $items = $query->orderBy('tanggal', 'desc')->orderBy('id', 'asc')->paginate(20)->withQueryString();
        
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
                $data = DaftarInformasi::find($id);
                if ($data) {
                    $data->file_path = $data->file_informasi;
                } else {
                    $data = InformasiBerkala::findOrFail($id);
                }
                break;
            case 'sertamerta':
                $data = DaftarInformasi::find($id);
                if ($data) {
                    $data->file_path = $data->file_informasi;
                } else {
                    $data = InformasiSertaMerta::findOrFail($id);
                }
                break;
            case 'setiapsaat':
                $data = DaftarInformasi::find($id);
                if ($data) {
                    $data->file_path = $data->file_informasi;
                } else {
                    $data = InformasiSetiapSaat::findOrFail($id);
                }
                break;
            case 'dikecualikan':
                $data = InformasiDikecualikan::findOrFail($id);
                break;
            case 'dip':
                $data = DaftarInformasi::findOrFail($id);
                $data->file_path = $data->file_informasi;
                break;
            case 'prosedur':
                $data = Prosedur::findOrFail($id);
                break;
            default:
                abort(404);
        }

        if (str_starts_with($data->file_path, 'http://') || str_starts_with($data->file_path, 'https://')) {
            return redirect($data->file_path);
        }

        // Clean path to remove /storage/ prefix if present in DB
        $path = str_replace('storage/', '', $data->file_path);
        
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan di storage: ' . $path);
        }

        return Storage::disk('public')->download($path, $data->file_name ?? basename($path));
    }
}
