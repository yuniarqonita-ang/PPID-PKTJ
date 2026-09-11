<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use App\Models\InformasiBerkala;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiBerkalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $itemsDaftar = DaftarInformasi::where('kategori', 'informasi-berkala')
            ->orderBy('created_at', 'desc')
            ->get();
            
        foreach ($itemsDaftar as $item) {
            $item->judul = $item->judul_informasi;
            $item->deskripsi = $item->isi_informasi;
            $item->file_path = $item->file_informasi;
            $item->file_size = '-';
        }

        $itemsBerkala = class_exists(InformasiBerkala::class) ? InformasiBerkala::all() : collect();
        foreach ($itemsBerkala as $b) {
            $b->judul = $b->judul;
            $b->deskripsi = $b->deskripsi;
            $b->file_path = $b->file_path;
            $b->file_size = '-';
        }

        $grouped = $itemsDaftar->concat($itemsBerkala)->groupBy(function($it) {
            return strtolower(trim($it->judul));
        });

        $items = collect();
        foreach ($grouped as $titleKey => $group) {
            $best = $group->sortByDesc(function($it) {
                return ($it->aktif ? 1000 : 0) + (!empty($it->file_path) ? 100 : 0) + strlen(strip_tags($it->deskripsi ?? ''));
            })->first();
            $items->push($best);
        }
        $items = $items->sortByDesc('aktif')->values();

        try {
            $pejabats = \App\Models\Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }
        
        return view('admin.informasi.berkala.index', compact('items', 'pejabats'));
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
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.informasi.berkala.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'              => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
            'tanggal'            => 'required|date',
            'file'               => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gdrive_link'        => 'nullable|url',
            'pejabat_penguasa'   => 'nullable|string|max:255',
            'penanggung_jawab'   => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'bentuk_informasi'   => 'nullable|string|max:100',
            'tempat_pembuatan'   => 'nullable|string|max:255',
            'waktu_pembuatan'    => 'nullable|string|max:100',
            'jangka_waktu'       => 'nullable|string|max:100',
            'aktif'              => 'boolean',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 20 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, atau xlsx.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $tautanLinks = $this->extractTautanLinks($request);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $filePath = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $filePath = $request->input('gdrive_link');
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

        // Simpan ke InformasiBerkala
        $berkala = InformasiBerkala::create([
            'judul'              => $validated['judul'],
            'deskripsi'          => $validated['deskripsi'] ?? null,
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

        // Sync ke DaftarInformasi
        DaftarInformasi::create([
            'judul_informasi'    => $validated['judul'],
            'isi_informasi'      => $validated['deskripsi'] ?? null,
            'kategori'           => 'informasi-berkala',
            'tipe_informasi'     => 'berkala',
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

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // 1. Cek di model InformasiBerkala
        $berkala = InformasiBerkala::find($id);
        $daftar = DaftarInformasi::where('kategori', 'informasi-berkala')->find($id) 
            ?? DaftarInformasi::find($id)
            ?? ($berkala ? DaftarInformasi::where('judul_informasi', $berkala->judul)->first() : null);

        if ($berkala) {
            $item = $berkala;
            $item->judul = $berkala->judul;
            $item->deskripsi = $berkala->deskripsi;
            $item->file_path = $berkala->file_path ?: ($daftar ? $daftar->file_informasi : null);
            $item->tanggal = $berkala->created_at ?? $berkala->tanggal;
            $item->pejabat_penguasa = $berkala->pejabat_penguasa ?: ($daftar->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal');
            $item->penanggung_jawab = $berkala->penanggung_jawab ?: ($daftar->penanggung_jawab ?? 'Bagian Keuangan dan Umum');
            $item->penerbit_informasi = $berkala->penerbit_informasi ?: ($daftar->penerbit_informasi ?? 'Bagian Keuangan dan Umum');
            $item->bentuk_informasi = $berkala->bentuk_informasi ?: ($daftar->bentuk_informasi ?? 'Hardcopy & Softcopy');
            $item->tempat_pembuatan = $berkala->tempat_pembuatan ?: ($daftar->tempat_pembuatan ?? 'Tegal');
            $item->waktu_pembuatan = $berkala->waktu_pembuatan ?: ($daftar->waktu_pembuatan ?? '2025');
            $item->jangka_waktu = $berkala->jangka_waktu ?: ($daftar->jangka_waktu ?? '1 Tahun');
            
            $links = $berkala->tautan_links ?: ($daftar ? $daftar->tautan_links : []);
            if (is_string($links)) $links = json_decode($links, true);
            $item->tautan_links = is_array($links) ? $links : [];

            return view('admin.informasi.berkala.edit', compact('item'));
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

            return view('admin.informasi.berkala.edit', compact('item'));
        }

        // 3. Fallback jika belum ada
        $item = new DaftarInformasi([
            'judul_informasi' => 'Informasi Berkala #' . $id,
            'isi_informasi' => '',
            'kategori' => 'informasi-berkala',
            'tipe_informasi' => 'berkala',
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
        return view('admin.informasi.berkala.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'judul'              => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
            'tanggal'            => 'required|date',
            'file'               => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
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

        $berkala = InformasiBerkala::find($id);
        $daftar  = DaftarInformasi::find($id) ?? ($berkala ? DaftarInformasi::where('judul_informasi', $berkala->judul)->first() : null);

        $tautanLinks = $this->extractTautanLinks($request);

        $filePath = $berkala ? $berkala->file_path : ($daftar ? $daftar->file_informasi : null);

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
            $filePath = $request->input('gdrive_link');
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

        // Pastikan kedua tabel terupdate secara serentak (by id maupun by judul)
        $oldTitle = ($berkala ? $berkala->judul : ($daftar ? $daftar->judul_informasi : null)) ?? $validated['judul'];

        $updateDataBerkala = [
            'judul'              => $validated['judul'],
            'deskripsi'          => $validated['deskripsi'] ?? null,
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

        InformasiBerkala::where('id', $id)
            ->orWhere('judul', $oldTitle)
            ->orWhere('judul', $validated['judul'])
            ->update($updateDataBerkala);

        $updateDataDaftar = [
            'judul_informasi'    => $validated['judul'],
            'isi_informasi'      => $validated['deskripsi'] ?? null,
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
            ->orWhere('judul_informasi', $validated['judul'])
            ->update($updateDataDaftar);

        if (!$berkala && !$daftar) {
            DaftarInformasi::create(array_merge($updateDataDaftar, [
                'kategori'        => 'informasi-berkala',
                'tipe_informasi'  => 'berkala',
            ]));
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $targetJudul = null;
        $berkala = InformasiBerkala::find($id);
        if ($berkala) {
            $targetJudul = $berkala->judul;
            if ($berkala->file_path && !str_starts_with($berkala->file_path, 'http') && Storage::exists(str_replace('storage/', 'public/', $berkala->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $berkala->file_path));
            }
            $berkala->delete();
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
            InformasiBerkala::where('judul', $targetJudul)->delete();
            DaftarInformasi::where('judul_informasi', $targetJudul)->delete();
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil dihapus!');
    }
}
