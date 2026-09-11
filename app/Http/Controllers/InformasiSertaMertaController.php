<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use App\Models\InformasiSertaMerta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiSertaMertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $itemsDaftar = DaftarInformasi::whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])
            ->orderBy('id', 'asc')
            ->get();
            
        foreach ($itemsDaftar as $item) {
            $item->judul = $item->judul_informasi;
            $item->deskripsi = $item->isi_informasi;
            $item->file_path = $item->file_informasi;
            $item->file_size = '-';
            $links = $item->tautan_links;
            if (is_string($links)) $links = json_decode($links, true);
            $item->tautan_links = is_array($links) ? $links : [];
        }

        $itemsSertaMerta = class_exists(InformasiSertamerta::class) ? InformasiSertamerta::orderBy('id', 'asc')->get() : collect();
        foreach ($itemsSertaMerta as $m) {
            $m->file_size = '-';
            $links = $m->tautan_links;
            if (is_string($links)) $links = json_decode($links, true);
            $m->tautan_links = is_array($links) ? $links : [];
        }

        $grouped = $itemsDaftar->concat($itemsSertaMerta)->groupBy(function($it) {
            return strtolower(trim($it->judul));
        });

        $items = collect();
        foreach ($grouped as $titleKey => $group) {
            $best = $group->sortByDesc(function($it) {
                return ($it->aktif ? 1000 : 0) + (!empty($it->tautan_links) ? 200 : 0) + (!empty($it->file_path) ? 100 : 0) + strlen(strip_tags($it->deskripsi ?? ''));
            })->first();
            $items->push($best);
        }
        $items = $items->sortBy('id')->values();
        
        return view('admin.informasi.sertamerta.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.informasi.sertamerta.create');
    }

    /**
     * Helper to extract repeatable dynamic tautan links from request
     */
    private function extractTautanLinks(Request $request): ?array
    {
        $links = [];
        if ($request->has('tautan_nama') && is_array($request->tautan_nama)) {
            foreach ($request->tautan_nama as $i => $nama) {
                $nama = trim($nama ?? '');
                $url = trim($request->tautan_url[$i] ?? '');
                if ($nama !== '' || $url !== '') {
                    $links[] = [
                        'nama' => $nama !== '' ? $nama : 'Lihat Dokumen',
                        'url'  => $url
                    ];
                }
            }
        }
        return !empty($links) ? $links : null;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'              => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
            'tanggal'            => 'required|date',
            'file'               => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480',
            'gdrive_link'        => 'nullable|url',
            'pejabat_penguasa'   => 'nullable|string|max:255',
            'penanggung_jawab'   => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'bentuk_informasi'   => 'nullable|string|max:100',
            'tempat_pembuatan'   => 'nullable|string|max:255',
            'waktu_pembuatan'    => 'nullable|string|max:100',
            'jangka_waktu'       => 'nullable|string|max:100',
            'aktif'              => 'boolean',
        ]);

        $tautanLinks = $this->extractTautanLinks($request);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $filePath = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $filePath = $request->gdrive_link;
        } elseif (!empty($tautanLinks)) {
            $filePath = $tautanLinks[0]['url'] ?? null;
        }

        $pejabatPenguasa = $request->input('pejabat_penguasa') ?: 'PPID Pelaksana UPT PKTJ Tegal';
        $penanggungJawab = $request->input('penanggung_jawab') ?: 'Bagian Keuangan dan Umum';
        $penerbitInformasi = $request->input('penerbit_informasi') ?: $penanggungJawab;
        $bentukInformasi = $request->input('bentuk_informasi') ?: 'Hardcopy & Softcopy';
        $tempatPembuatan = $request->input('tempat_pembuatan') ?: 'Tegal';
        $waktuPembuatan = $request->input('waktu_pembuatan') ?: date('Y', strtotime($request->tanggal));
        $jangkaWaktu = $request->input('jangka_waktu') ?: '1 Tahun';

        InformasiSertaMerta::create([
            'judul'              => $request->judul,
            'deskripsi'          => $request->deskripsi ?? '',
            'file_path'          => $filePath,
            'tautan_links'       => $tautanLinks,
            'pejabat_penguasa'   => $pejabatPenguasa,
            'penanggung_jawab'   => $penanggungJawab,
            'penerbit_informasi' => $penerbitInformasi,
            'bentuk_informasi'   => $bentukInformasi,
            'tempat_pembuatan'   => $tempatPembuatan,
            'waktu_pembuatan'    => $waktuPembuatan,
            'jangka_waktu'       => $jangkaWaktu,
            'aktif'              => $request->has('aktif'),
            'is_blurred'         => $request->has('is_blurred'),
            'bisa_download'      => $request->has('bisa_download'),
            'tanggal'            => $request->tanggal,
        ]);

        DaftarInformasi::create([
            'judul_informasi'    => $request->judul,
            'isi_informasi'      => $request->deskripsi ?? '',
            'kategori'           => 'informasi-serta-merta',
            'tipe_informasi'     => 'sertamerta',
            'file_informasi'     => $filePath,
            'tautan_links'       => $tautanLinks,
            'pejabat_penguasa'   => $pejabatPenguasa,
            'penanggung_jawab'   => $penanggungJawab,
            'penerbit_informasi' => $penerbitInformasi,
            'bentuk_informasi'   => $bentukInformasi,
            'tempat_pembuatan'   => $tempatPembuatan,
            'waktu_pembuatan'    => $waktuPembuatan,
            'jangka_waktu'       => $jangkaWaktu,
            'aktif'              => $request->has('aktif'),
            'is_blurred'         => $request->has('is_blurred'),
            'bisa_download'      => $request->has('bisa_download'),
        ]);

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // 1. Cek di model InformasiSertaMerta
        $sertamerta = InformasiSertaMerta::find($id);
        $daftar = DaftarInformasi::where('kategori', 'informasi-serta-merta')->find($id) 
            ?? DaftarInformasi::find($id)
            ?? ($sertamerta ? DaftarInformasi::where('judul_informasi', $sertamerta->judul)->first() : null);

        if ($sertamerta) {
            $item = $sertamerta;
            $item->judul = $sertamerta->judul;
            $item->deskripsi = $sertamerta->deskripsi;
            $item->file_path = $sertamerta->file_path ?: ($daftar ? $daftar->file_informasi : null);
            $item->tanggal = $sertamerta->created_at ?? $sertamerta->tanggal;
            $item->pejabat_penguasa = $sertamerta->pejabat_penguasa ?: ($daftar->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal');
            $item->penanggung_jawab = $sertamerta->penanggung_jawab ?: ($daftar->penanggung_jawab ?? 'Bagian Keuangan dan Umum');
            $item->penerbit_informasi = $sertamerta->penerbit_informasi ?: ($daftar->penerbit_informasi ?? 'Bagian Keuangan dan Umum');
            $item->bentuk_informasi = $sertamerta->bentuk_informasi ?: ($daftar->bentuk_informasi ?? 'Hardcopy & Softcopy');
            $item->tempat_pembuatan = $sertamerta->tempat_pembuatan ?: ($daftar->tempat_pembuatan ?? 'Tegal');
            $item->waktu_pembuatan = $sertamerta->waktu_pembuatan ?: ($daftar->waktu_pembuatan ?? '2025');
            $item->jangka_waktu = $sertamerta->jangka_waktu ?: ($daftar->jangka_waktu ?? '1 Tahun');

            $links = $sertamerta->tautan_links ?: ($daftar ? $daftar->tautan_links : []);
            if (is_string($links)) $links = json_decode($links, true);
            $item->tautan_links = is_array($links) ? $links : [];

            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 2. Cek di model DaftarInformasi
        if ($daftar) {
            $item = $daftar;
            $item->judul = $daftar->judul_informasi;
            $item->deskripsi = $daftar->isi_informasi;
            $item->file_path = $daftar->file_informasi;
            $item->tanggal = $daftar->created_at;
            $item->pejabat_penguasa = $daftar->pejabat_penguasa ?: 'PPID Pelaksana UPT PKTJ Tegal';
            $item->penanggung_jawab = $daftar->penanggung_jawab ?: 'Bagian Keuangan dan Umum';
            $item->penerbit_informasi = $daftar->penerbit_informasi ?: 'Bagian Keuangan dan Umum';
            $item->bentuk_informasi = $daftar->bentuk_informasi ?: 'Hardcopy & Softcopy';
            $item->tempat_pembuatan = $daftar->tempat_pembuatan ?: 'Tegal';
            $item->waktu_pembuatan = $daftar->waktu_pembuatan ?: '2025';
            $item->jangka_waktu = $daftar->jangka_waktu ?: '1 Tahun';

            $links = $daftar->tautan_links;
            if (is_string($links)) $links = json_decode($links, true);
            $item->tautan_links = is_array($links) ? $links : [];

            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 3. Fallback: ambil record serta-merta ke-$id (index offset)
        $offset = max(0, ((int)$id) - 1);
        $fallback = DaftarInformasi::where('kategori', 'informasi-serta-merta')->skip($offset)->first() 
                 ?? InformasiSertaMerta::skip($offset)->first()
                 ?? DaftarInformasi::where('kategori', 'informasi-serta-merta')->first()
                 ?? InformasiSertaMerta::first();

        if ($fallback) {
            $item = $fallback;
            $item->judul = $fallback->judul_informasi ?? $fallback->judul;
            $item->deskripsi = $fallback->isi_informasi ?? $fallback->deskripsi;
            $item->file_path = $fallback->file_informasi ?? $fallback->file_path;
            $item->tanggal = $fallback->created_at ?? $fallback->tanggal ?? now();
            $item->pejabat_penguasa = $fallback->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal';
            $item->penanggung_jawab = $fallback->penanggung_jawab ?? 'Bagian Keuangan dan Umum';
            $item->penerbit_informasi = $fallback->penerbit_informasi ?? 'Bagian Keuangan dan Umum';
            $item->bentuk_informasi = $fallback->bentuk_informasi ?? 'Hardcopy & Softcopy';
            $item->tempat_pembuatan = $fallback->tempat_pembuatan ?? 'Tegal';
            $item->waktu_pembuatan = $fallback->waktu_pembuatan ?? '2025';
            $item->jangka_waktu = $fallback->jangka_waktu ?? '1 Tahun';
            $links = $fallback->tautan_links ?? [];
            if (is_string($links)) $links = json_decode($links, true);
            $item->tautan_links = is_array($links) ? $links : [];
            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 4. Jika belum ada data sama sekali, buat instance dinamis sehingga tidak pernah 404
        $item = new DaftarInformasi([
            'judul_informasi' => 'Informasi Serta Merta #' . $id,
            'isi_informasi' => '',
            'kategori' => 'informasi-serta-merta',
            'tipe_informasi' => 'sertamerta',
            'aktif' => true,
        ]);
        $item->id = (int)$id;
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $item->isi_informasi;
        $item->file_path = null;
        $item->tautan_links = [];
        $item->pejabat_penguasa = 'PPID Pelaksana UPT PKTJ Tegal';
        $item->penanggung_jawab = 'Bagian Keuangan dan Umum';
        $item->penerbit_informasi = 'Bagian Keuangan dan Umum';
        $item->bentuk_informasi = 'Hardcopy & Softcopy';
        $item->tempat_pembuatan = 'Tegal';
        $item->waktu_pembuatan = date('Y');
        $item->jangka_waktu = '1 Tahun';
        $item->tanggal = now();
        return view('admin.informasi.sertamerta.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'judul'              => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
            'tanggal'            => 'required|date',
            'file'               => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480',
            'gdrive_link'        => 'nullable|url',
            'pejabat_penguasa'   => 'nullable|string|max:255',
            'penanggung_jawab'   => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'bentuk_informasi'   => 'nullable|string|max:100',
            'tempat_pembuatan'   => 'nullable|string|max:255',
            'waktu_pembuatan'    => 'nullable|string|max:100',
            'jangka_waktu'       => 'nullable|string|max:100',
            'aktif'              => 'boolean',
        ]);

        $sertamerta = InformasiSertaMerta::find($id);
        $daftar     = DaftarInformasi::find($id) ?? ($sertamerta ? DaftarInformasi::where('judul_informasi', $sertamerta->judul)->first() : null);

        $tautanLinks = $this->extractTautanLinks($request);

        $filePath = $sertamerta ? $sertamerta->file_path : ($daftar ? $daftar->file_informasi : null);

        if ($request->has('hapus_file')) {
            if ($filePath && !str_starts_with($filePath, 'http') && Storage::exists(str_replace('storage/', 'public/', $filePath))) {
                Storage::delete(str_replace('storage/', 'public/', $filePath));
            }
            $filePath = null;
        } elseif ($request->hasFile('file')) {
            if ($filePath && !str_starts_with($filePath, 'http') && Storage::exists(str_replace('storage/', 'public/', $filePath))) {
                Storage::delete(str_replace('storage/', 'public/', $filePath));
            }
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $filePath = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $filePath = $request->gdrive_link;
        } elseif (!empty($tautanLinks) && empty($filePath)) {
            $filePath = $tautanLinks[0]['url'] ?? null;
        }

        $isAktif = $request->has('aktif');
        $isBlurred = $request->has('is_blurred');
        $bisaDownload = $request->has('bisa_download');

        $pejabatPenguasa = $request->input('pejabat_penguasa') ?: 'PPID Pelaksana UPT PKTJ Tegal';
        $penanggungJawab = $request->input('penanggung_jawab') ?: 'Bagian Keuangan dan Umum';
        $penerbitInformasi = $request->input('penerbit_informasi') ?: $penanggungJawab;
        $bentukInformasi = $request->input('bentuk_informasi') ?: 'Hardcopy & Softcopy';
        $tempatPembuatan = $request->input('tempat_pembuatan') ?: 'Tegal';
        $waktuPembuatan = $request->input('waktu_pembuatan') ?: date('Y', strtotime($request->tanggal));
        $jangkaWaktu = $request->input('jangka_waktu') ?: '1 Tahun';

        $oldTitle = ($sertamerta ? $sertamerta->judul : ($daftar ? $daftar->judul_informasi : null)) ?? $request->judul;

        $updateData = [
            'judul'              => $request->judul,
            'deskripsi'          => $request->deskripsi ?? '',
            'file_path'          => $filePath,
            'tautan_links'       => $tautanLinks,
            'pejabat_penguasa'   => $pejabatPenguasa,
            'penanggung_jawab'   => $penanggungJawab,
            'penerbit_informasi' => $penerbitInformasi,
            'bentuk_informasi'   => $bentukInformasi,
            'tempat_pembuatan'   => $tempatPembuatan,
            'waktu_pembuatan'    => $waktuPembuatan,
            'jangka_waktu'       => $jangkaWaktu,
            'aktif'              => $isAktif,
            'is_blurred'         => $isBlurred,
            'bisa_download'      => $bisaDownload,
            'tanggal'            => $request->tanggal,
        ];

        InformasiSertaMerta::where('id', $id)
            ->orWhere('judul', $oldTitle)
            ->orWhere('judul', $request->judul)
            ->update($updateData);

        $updateDataDaftar = [
            'judul_informasi'    => $request->judul,
            'isi_informasi'      => $request->deskripsi ?? '',
            'file_informasi'     => $filePath,
            'tautan_links'       => $tautanLinks,
            'pejabat_penguasa'   => $pejabatPenguasa,
            'penanggung_jawab'   => $penanggungJawab,
            'penerbit_informasi' => $penerbitInformasi,
            'bentuk_informasi'   => $bentukInformasi,
            'tempat_pembuatan'   => $tempatPembuatan,
            'waktu_pembuatan'    => $waktuPembuatan,
            'jangka_waktu'       => $jangkaWaktu,
            'aktif'              => $isAktif,
            'is_blurred'         => $isBlurred,
            'bisa_download'      => $bisaDownload,
        ];

        DaftarInformasi::where('id', $id)
            ->orWhere('judul_informasi', $oldTitle)
            ->orWhere('judul_informasi', $request->judul)
            ->update($updateDataDaftar);

        if (!$sertamerta && !$daftar) {
            DaftarInformasi::create(array_merge($updateDataDaftar, [
                'kategori'        => 'informasi-serta-merta',
                'tipe_informasi'  => 'sertamerta',
            ]));
        }

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $targetJudul = null;
        $sertamerta = InformasiSertaMerta::find($id);
        if ($sertamerta) {
            $targetJudul = $sertamerta->judul;
            if ($sertamerta->file_path && !str_starts_with($sertamerta->file_path, 'http') && Storage::exists(str_replace('storage/', 'public/', $sertamerta->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $sertamerta->file_path));
            }
            $sertamerta->delete();
        }

        $daftar = DaftarInformasi::find($id);
        if ($daftar) {
            if (!$targetJudul) $targetJudul = $daftar->judul_informasi;
            if ($daftar->file_informasi && !str_starts_with($daftar->file_informasi, 'http') && Storage::exists(str_replace('storage/', 'public/', $daftar->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $daftar->file_informasi));
            }
            $daftar->delete();
        }

        if ($targetJudul) {
            InformasiSertaMerta::where('judul', $targetJudul)->delete();
            DaftarInformasi::where('judul_informasi', $targetJudul)->delete();
        }

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil dihapus!');
    }
}
