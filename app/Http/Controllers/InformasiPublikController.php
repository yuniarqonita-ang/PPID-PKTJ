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
            $hasPoltrada = \Illuminate\Support\Facades\DB::table('daftar_informasis')
                ->where('judul_informasi', 'Tata cara permohonan informasi publik')
                ->where('aktif', 1)
                ->exists();

            if (!$hasPoltrada) {
                $seederFile = database_path('seeders/PoltradaBaliDipSeeder.php');
                if (file_exists($seederFile)) {
                    require_once $seederFile;
                    $seeder = new \Database\Seeders\PoltradaBaliDipSeeder();
                    $seeder->run();
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Auto seed error: ' . $e->getMessage());
        }
    }

    private function getHiddenTitles(): array
    {
        try {
            $hiddenDaftar = DaftarInformasi::where('aktif', false)
                ->pluck('judul_informasi')
                ->map(fn($t) => strtolower(trim($t)))
                ->all();

            $hiddenBerkala = class_exists(InformasiBerkala::class) 
                ? InformasiBerkala::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            $hiddenSetiapSaat = class_exists(InformasiSetiapSaat::class) 
                ? InformasiSetiapSaat::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            $hiddenSertaMerta = class_exists(InformasiSertaMerta::class) 
                ? InformasiSertaMerta::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            return array_unique(array_filter(array_merge($hiddenDaftar, $hiddenBerkala, $hiddenSetiapSaat, $hiddenSertaMerta)));
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function mapDaftarInformasi($item)
    {
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $this->processContent($item->isi_informasi, $item->is_blurred ?? false);
        
        $rawFile = $item->file_informasi;
        $item->file_path = $rawFile;
        $item->bisa_download = (bool) ($item->bisa_download ?? true);
        $item->file_size = $item->file_size ?? '-';

        $item->pejabat_penguasa = $item->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal';
        $item->penerbit_informasi = $item->penerbit_informasi ?? 'Bagian Keuangan dan Umum';
        $item->penanggung_jawab = $item->penanggung_jawab ?? $item->penerbit_informasi;
        $item->tempat_pembuatan = $item->tempat_pembuatan ?? 'Tegal';
        $item->waktu_pembuatan = $item->waktu_pembuatan ?? ($item->created_at ? date('Y', strtotime($item->created_at)) : '2025');
        $item->bentuk_informasi = $item->bentuk_informasi ?? 'hardcopy dan softcopy';
        $item->jangka_waktu = $item->jangka_waktu ?? '1 Tahun';
        $item->tipe_informasi = $item->tipe_informasi ?? null;

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
        $item->file_path = $rawFile;
        $item->bisa_download = (bool) ($s->bisa_download ?? true);
        $item->file_size = $s->file_size ?? '-';

        $item->pejabat_penguasa = $s->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal';
        $item->penerbit_informasi = $s->penerbit_informasi ?? 'Bagian Keuangan dan Umum';
        $item->penanggung_jawab = $s->penanggung_jawab ?? $item->penerbit_informasi;
        $item->tempat_pembuatan = $s->tempat_pembuatan ?? 'Tegal';
        $item->waktu_pembuatan = $s->waktu_pembuatan ?? ($s->tanggal ? date('Y', strtotime($s->tanggal)) : '2025');
        $item->bentuk_informasi = $s->bentuk_informasi ?? 'Softcopy & Hardcopy';
        $item->jangka_waktu = $s->jangka_waktu ?? '1 Tahun';
        $item->tipe_informasi = $s->tipe_informasi ?? null;

        $item->tanggal = $s->tanggal ?? $s->created_at;
        $item->created_at = $s->created_at ?? now();
        $item->is_blurred = (bool) ($s->is_blurred ?? false);
        return $item;
    }

    private function itemHasValidContent($item): bool
    {
        // Hanya tayangkan jika memiliki file riil ATAU link web/Google Drive/prosedur aktif
        if (!empty($item->file_path)) {
            $path = trim($item->file_path);
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
                return true;
            }
            if (function_exists('has_valid_document') && has_valid_document($path)) {
                return true;
            }
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
            $hiddenTitles = $this->getHiddenTitles();

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

            foreach ($grouped as $titleKey => $group) {
                // JIKA JUDUL INI SUDAH DI-HIDE DI MANA PUN DI ADMIN PANEL, JANGAN TAMPILKAN!
                if (in_array($titleKey, $hiddenTitles)) {
                    continue;
                }

                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // Tampilkan semua item yang aktif (aktif=true di admin panel sudah cukup)
            $items = $merged->sortBy('id')->values();

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

    // Data & Statistik Kepegawaian PKTJ (Dedicated Page)
    public function statistikPegawai()
    {
        $settings = $this->getSettings();
        $data = \App\Http\Controllers\StatistikPegawaiController::getMergedSettings();
        return view('statistik-pegawai', compact('settings', 'data'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $this->ensureDataSeeded();
        try {
            $hiddenTitles = $this->getHiddenTitles();

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

            foreach ($grouped as $titleKey => $group) {
                if (in_array($titleKey, $hiddenTitles)) {
                    continue;
                }

                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // Tampilkan semua item yang aktif (aktif=true di admin panel sudah cukup)
            $items = $merged->sortBy('id')->values();

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
            $hiddenTitles = $this->getHiddenTitles();

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

            foreach ($grouped as $titleKey => $group) {
                if (in_array($titleKey, $hiddenTitles)) {
                    continue;
                }

                if ($group->count() === 1) {
                    $merged->push($group->first());
                } else {
                    $best = $group->sortByDesc(function($it) {
                        return strlen(strip_tags($it->deskripsi ?? ''));
                    })->first();
                    $merged->push($best);
                }
            }

            // Tampilkan semua item yang aktif (aktif=true di admin panel sudah cukup)
            $items = $merged->sortBy('id')->values();
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
