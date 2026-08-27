<?php

namespace App\Http\Controllers;

use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiDikecualikan;
use App\Models\Prosedur;
use App\Models\Dashboard;
use App\Models\DaftarInformasi;
use App\Models\Pejabat;
use Illuminate\Support\Facades\Storage;

class InformasiPublikController extends Controller
{
    private function getSettings()
    {
        try {
            return Dashboard::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
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
        try {
            $rawItems = DaftarInformasi::where('aktif', true)
                ->where('kategori', 'informasi-berkala')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'asc')
                ->get();
                
            $items = $rawItems->map(function($item) {
                return $this->mapDaftarInformasi($item);
            });
        } catch (\Throwable $e) {
            $items = collect([]);
        }

        try {
            $pejabats = Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-berkala', compact('items', 'settings', 'pejabats'));
    }

    // Profil Pejabat Publik & LHKPN (Dedicated Page)
    public function profilPejabat()
    {
        try {
            $pejabats = Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }

        $settings = $this->getSettings();
        return view('profil-pejabat', compact('pejabats', 'settings'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        try {
            $rawItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'asc')
                ->get();

            $items = $rawItems->map(function($item) {
                return $this->mapDaftarInformasi($item);
            });
        } catch (\Throwable $e) {
            $items = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('items', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        try {
            $rawItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'asc')
                ->get();

            $items = $rawItems->map(function($item) {
                return $this->mapDaftarInformasi($item);
            });
        } catch (\Throwable $e) {
            $items = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-setiap-saat', compact('items', 'settings'));
    }

    // Informasi Dikecualikan
    public function informasiDikecualikan(\Illuminate\Http\Request $request)
    {
        try {
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
        } catch (\Throwable $e) {
            $items = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
        }
        
        $settings = $this->getSettings();
        return view('informasi-dikecualikan', compact('items', 'settings'));
    }

    // Prosedur
    public function prosedur($kategori = null)
    {
        if (!$kategori) {
            $routeName = request()->route()->getName();
            $kategori = str_replace('prosedur.', '', $routeName);
        }

        $settings = $this->getSettings();
        return view('prosedur.' . $kategori, compact('settings'));
    }

    // Download file
    public function downloadFile($model, $id)
    {
        try {
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
                default:
                    abort(404);
            }

            if (!$data->file_path) {
                abort(404, 'File tidak ditemukan.');
            }

            if (strpos($data->file_path, 'http') === 0) {
                return redirect()->away($data->file_path);
            }

            if (Storage::disk('public')->exists($data->file_path)) {
                return Storage::disk('public')->download($data->file_path);
            }

            if (file_exists(public_path($data->file_path))) {
                return response()->download(public_path($data->file_path));
            }

            return redirect()->away($data->file_path);
        } catch (\Throwable $e) {
            abort(404, 'File tidak dapat diakses.');
        }
    }
}
