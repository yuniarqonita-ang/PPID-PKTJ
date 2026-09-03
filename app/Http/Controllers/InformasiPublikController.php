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

    private function ensureDataSeeded(): void
    {
        try {
            $smCount = \App\Models\DaftarInformasi::where('kategori', 'informasi-serta-merta')->where('aktif', 1)->count();
            $bkCount = \App\Models\DaftarInformasi::where('kategori', 'informasi-berkala')->where('aktif', 1)->count();
            if ($smCount < 15 || $bkCount < 15) {
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Dip2026SyncSeeder', '--force' => true]);
            }
        } catch (\Throwable $e) {}
    }

    private function mapDaftarInformasi($item)
    {
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $this->processContent($item->isi_informasi, $item->is_blurred ?? false);
        
        $rawFile = $item->file_informasi;
        if (function_exists('has_valid_document') && has_valid_document($rawFile)) {
            $item->file_path = $rawFile;
            $item->bisa_download = (bool) ($item->bisa_download ?? true);
            $item->file_size = $item->file_size ?? '-';
        } else {
            $item->file_path = null;
            $item->bisa_download = false;
            $item->file_size = null;
        }

        $item->tanggal = $item->created_at;
        return $item;
    }

    private function mapModelItem($s)
    {
        $item = new \stdClass();
        $item->id = $s->id;
        $item->judul = $s->judul;
        $item->deskripsi = $this->processContent($s->deskripsi, $s->is_blurred ?? false);
        
        $rawFile = $s->file_path;
        if (function_exists('has_valid_document') && has_valid_document($rawFile)) {
            $item->file_path = $rawFile;
            $item->bisa_download = (bool) ($s->bisa_download ?? true);
            $item->file_size = $s->file_size ?? '-';
        } else {
            $item->file_path = null;
            $item->bisa_download = false;
            $item->file_size = null;
        }

        $item->tanggal = $s->tanggal ?? $s->created_at;
        $item->created_at = $s->created_at ?? now();
        $item->is_blurred = (bool) ($s->is_blurred ?? false);
        return $item;
    }

    private function itemHasValidContent($item): bool
    {
        // Hanya tayangkan jika dokumen fisik benar-benar ada ATAU memiliki tautan web/Google Drive aktif
        if (!empty($item->file_path) && function_exists('has_valid_document') && has_valid_document($item->file_path)) {
            return true;
        }
        if (!empty($item->deskripsi) && preg_match('/https?:\/\/[^\s"\'<>]+/i', $item->deskripsi)) {
            return true;
        }
        return false;
    }

    // Informasi Berkala
    public function informasiBerkala()
    {
        $this->ensureDataSeeded();
        try {
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->where('kategori', 'informasi-berkala')
                ->get()
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $modelItems = collect();
            if (class_exists(InformasiBerkala::class)) {
                $modelItems = InformasiBerkala::where('aktif', true)
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $merged = collect();
            $grouped = $daftarItems->concat($modelItems)->groupBy(function($it) {
                return strtolower(trim($it->judul));
            });

            foreach ($grouped as $group) {
                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    // Prioritaskan versi yang memiliki tabel / konten deskripsi lebih panjang & lengkap
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // FILTER KETAT: Jangan tayangkan jika tidak ada file dan tidak ada link
            $items = $merged->filter(fn($it) => $this->itemHasValidContent($it))->sortByDesc('created_at')->values();
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
        $this->ensureDataSeeded();
        try {
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])
                ->get()
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $modelItems = collect();
            if (class_exists(InformasiSertaMerta::class)) {
                $modelItems = InformasiSertaMerta::where('aktif', true)
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $merged = collect();
            $grouped = $daftarItems->concat($modelItems)->groupBy(function($it) {
                return strtolower(trim($it->judul));
            });

            foreach ($grouped as $group) {
                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // FILTER KETAT: Jangan tayangkan jika tidak ada file dan tidak ada link
            $items = $merged->filter(fn($it) => $this->itemHasValidContent($it))->sortByDesc('created_at')->values();
        } catch (\Throwable $e) {
            $items = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('items', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $this->ensureDataSeeded();
        try {
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])
                ->get()
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $modelItems = collect();
            if (class_exists(InformasiSetiapSaat::class)) {
                $modelItems = InformasiSetiapSaat::where('aktif', true)
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $merged = collect();
            $grouped = $daftarItems->concat($modelItems)->groupBy(function($it) {
                return strtolower(trim($it->judul));
            });

            foreach ($grouped as $group) {
                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // FILTER KETAT: Jangan tayangkan jika tidak ada file dan tidak ada link
            $items = $merged->filter(fn($it) => $this->itemHasValidContent($it))->sortByDesc('created_at')->values();
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

            if (!$data->file_path || !has_valid_document($data->file_path)) {
                abort(404, 'File dokumen tidak tersedia untuk diunduh.');
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
