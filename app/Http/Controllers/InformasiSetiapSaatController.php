<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use App\Models\InformasiSetiapsaat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiSetiapSaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $itemsDaftar = DaftarInformasi::whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        foreach ($itemsDaftar as $item) {
            $item->judul = $item->judul_informasi;
            $item->deskripsi = $item->isi_informasi;
            $item->file_path = $item->file_informasi;
            $item->file_size = '-';
        }

        $itemsSetiapSaat = class_exists(InformasiSetiapsaat::class) ? InformasiSetiapsaat::all() : collect();
        foreach ($itemsSetiapSaat as $s) {
            $s->judul = $s->judul;
            $s->deskripsi = $s->deskripsi;
            $s->file_path = $s->file_path;
            $s->file_size = '-';
        }

        $grouped = $itemsDaftar->concat($itemsSetiapSaat)->groupBy(function($it) {
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
        
        return view('admin.informasi.setiapsaat.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.informasi.setiapsaat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480',
            'gdrive_link' => 'nullable|url',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $filePath = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $filePath = $request->gdrive_link;
        }

        InformasiSetiapsaat::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '',
            'file_path' => $filePath,
            'aktif' => $request->has('aktif'),
            'is_blurred' => $request->has('is_blurred'),
            'bisa_download' => $request->has('bisa_download'),
            'tanggal' => $request->tanggal,
        ]);

        DaftarInformasi::create([
            'judul_informasi' => $request->judul,
            'isi_informasi'   => $request->deskripsi ?? '',
            'kategori'        => 'informasi-setiap-saat',
            'tipe_informasi'  => 'setiapsaat',
            'file_informasi'  => $filePath,
            'aktif'           => $request->has('aktif'),
            'is_blurred'      => $request->has('is_blurred'),
            'bisa_download'   => $request->has('bisa_download'),
            'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
        ]);

        return redirect()->route('admin.informasi.setiapsaat.index')
            ->with('success', 'Informasi setiap saat berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // 1. Cek di model InformasiSetiapsaat
        $setiapsaat = InformasiSetiapsaat::find($id);
        if ($setiapsaat) {
            $item = $setiapsaat;
            $item->judul = $setiapsaat->judul;
            $item->deskripsi = $setiapsaat->deskripsi;
            $item->file_path = $setiapsaat->file_path;
            $item->tanggal = $setiapsaat->created_at ?? $setiapsaat->tanggal;
            return view('admin.informasi.setiapsaat.edit', compact('item'));
        }

        // 2. Cek di model DaftarInformasi
        $daftar = DaftarInformasi::where('kategori', 'informasi-setiap-saat')->find($id) ?? DaftarInformasi::find($id);
        if ($daftar) {
            $item = $daftar;
            $item->judul = $daftar->judul_informasi;
            $item->deskripsi = $daftar->isi_informasi;
            $item->file_path = $daftar->file_informasi;
            $item->tanggal = $daftar->created_at;
            return view('admin.informasi.setiapsaat.edit', compact('item'));
        }

        // 3. Fallback: ambil record setiap-saat ke-$id (index offset)
        $offset = max(0, ((int)$id) - 1);
        $fallback = DaftarInformasi::where('kategori', 'informasi-setiap-saat')->skip($offset)->first() 
                 ?? InformasiSetiapsaat::skip($offset)->first()
                 ?? DaftarInformasi::where('kategori', 'informasi-setiap-saat')->first()
                 ?? InformasiSetiapsaat::first();

        if ($fallback) {
            $item = $fallback;
            $item->judul = $fallback->judul_informasi ?? $fallback->judul;
            $item->deskripsi = $fallback->isi_informasi ?? $fallback->deskripsi;
            $item->file_path = $fallback->file_informasi ?? $fallback->file_path;
            $item->tanggal = $fallback->created_at ?? $fallback->tanggal ?? now();
            return view('admin.informasi.setiapsaat.edit', compact('item'));
        }

        // 4. Jika belum ada data sama sekali, buat instance dinamis sehingga tidak pernah 404
        $item = new DaftarInformasi([
            'judul_informasi' => 'Informasi Setiap Saat #' . $id,
            'isi_informasi' => '',
            'kategori' => 'informasi-setiap-saat',
            'tipe_informasi' => 'setiapsaat',
            'aktif' => true,
        ]);
        $item->id = (int)$id;
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $item->isi_informasi;
        $item->file_path = null;
        $item->tanggal = now();
        return view('admin.informasi.setiapsaat.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480',
            'gdrive_link' => 'nullable|url',
        ]);

        $setiapsaat = InformasiSetiapsaat::find($id);
        $daftar     = DaftarInformasi::find($id);

        $filePath = $setiapsaat ? $setiapsaat->file_path : ($daftar ? $daftar->file_informasi : null);

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
        }

        $isAktif = $request->has('aktif');
        $isBlurred = $request->has('is_blurred');
        $bisaDownload = $request->has('bisa_download');

        $oldTitle = ($setiapsaat ? $setiapsaat->judul : ($daftar ? $daftar->judul_informasi : null)) ?? $request->judul;

        InformasiSetiapsaat::where('id', $id)
            ->orWhere('judul', $oldTitle)
            ->orWhere('judul', $request->judul)
            ->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi ?? '',
                'file_path' => $filePath,
                'aktif' => $isAktif,
                'is_blurred' => $isBlurred,
                'bisa_download' => $bisaDownload,
                'tanggal' => $request->tanggal,
            ]);

        DaftarInformasi::where('id', $id)
            ->orWhere('judul_informasi', $oldTitle)
            ->orWhere('judul_informasi', $request->judul)
            ->update([
                'judul_informasi' => $request->judul,
                'isi_informasi'   => $request->deskripsi ?? '',
                'file_informasi'  => $filePath,
                'aktif'           => $isAktif,
                'is_blurred'      => $isBlurred,
                'bisa_download'   => $bisaDownload,
                'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
            ]);

        if (!$setiapsaat && !$daftar) {
            DaftarInformasi::create([
                'judul_informasi' => $request->judul,
                'isi_informasi'   => $request->deskripsi ?? '',
                'kategori'        => 'informasi-setiap-saat',
                'tipe_informasi'  => 'setiapsaat',
                'file_informasi'  => $filePath,
                'aktif'           => $isAktif,
                'is_blurred'      => $isBlurred,
                'bisa_download'   => $bisaDownload,
                'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
            ]);
        }

        return redirect()->route('admin.informasi.setiapsaat.index')
            ->with('success', 'Informasi setiap saat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $targetJudul = null;
        $setiapsaat = InformasiSetiapsaat::find($id);
        if ($setiapsaat) {
            $targetJudul = $setiapsaat->judul;
            if ($setiapsaat->file_path && !str_starts_with($setiapsaat->file_path, 'http') && Storage::exists(str_replace('storage/', 'public/', $setiapsaat->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $setiapsaat->file_path));
            }
            $setiapsaat->delete();
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
            InformasiSetiapsaat::where('judul', $targetJudul)->delete();
            DaftarInformasi::where('judul_informasi', $targetJudul)->delete();
        }

        return redirect()->route('admin.informasi.setiapsaat.index')
            ->with('success', 'Informasi setiap saat berhasil dihapus!');
    }
}
