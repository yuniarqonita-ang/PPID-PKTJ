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

        $itemsBerkala = InformasiBerkala::all();
        foreach ($itemsBerkala as $b) {
            $b->judul = $b->judul;
            $b->deskripsi = $b->deskripsi;
            $b->file_path = $b->file_path;
            $b->file_size = '-';
        }

        $items = $itemsBerkala->merge($itemsDaftar);

        try {
            $pejabats = \App\Models\Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }
        
        return view('admin.informasi.berkala.index', compact('items', 'pejabats'));
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
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 20 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, atau xlsx.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $filePath = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $filePath = $request->input('gdrive_link');
        }

        // Simpan ke InformasiBerkala
        $berkala = InformasiBerkala::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $filePath,
            'aktif' => $request->has('aktif'),
            'is_blurred' => $request->has('is_blurred'),
            'bisa_download' => $request->has('bisa_download'),
            'tanggal' => $request->tanggal,
        ]);

        // Sync ke DaftarInformasi
        DaftarInformasi::create([
            'judul_informasi' => $validated['judul'],
            'isi_informasi'   => $validated['deskripsi'] ?? null,
            'kategori'        => 'informasi-berkala',
            'tipe_informasi'  => 'berkala',
            'file_informasi'  => $filePath,
            'aktif'           => $request->has('aktif'),
            'is_blurred'      => $request->has('is_blurred'),
            'bisa_download'   => $request->has('bisa_download'),
            'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
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
        if ($berkala) {
            $item = $berkala;
            $item->judul = $berkala->judul;
            $item->deskripsi = $berkala->deskripsi;
            $item->file_path = $berkala->file_path;
            $item->tanggal = $berkala->created_at ?? $berkala->tanggal;
            return view('admin.informasi.berkala.edit', compact('item'));
        }

        // 2. Cek di model DaftarInformasi
        $daftar = DaftarInformasi::find($id);
        if ($daftar) {
            $item = $daftar;
            $item->judul = $daftar->judul_informasi;
            $item->deskripsi = $daftar->isi_informasi;
            $item->file_path = $daftar->file_informasi;
            $item->tanggal = $daftar->created_at;
            return view('admin.informasi.berkala.edit', compact('item'));
        }

        abort(404, 'Informasi Berkala tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ]);

        $berkala = InformasiBerkala::find($id);
        $daftar  = DaftarInformasi::find($id);

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
        }

        if ($berkala) {
            $berkala->update([
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'file_path' => $filePath,
                'aktif' => $request->has('aktif'),
                'is_blurred' => $request->has('is_blurred'),
                'bisa_download' => $request->has('bisa_download'),
                'tanggal' => $request->tanggal,
            ]);
        }

        if ($daftar) {
            $daftar->update([
                'judul_informasi' => $validated['judul'],
                'isi_informasi'   => $validated['deskripsi'] ?? null,
                'file_informasi'  => $filePath,
                'aktif'           => $request->has('aktif'),
                'is_blurred'      => $request->has('is_blurred'),
                'bisa_download'   => $request->has('bisa_download'),
            ]);
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $berkala = InformasiBerkala::find($id);
        if ($berkala) {
            if ($berkala->file_path && !str_starts_with($berkala->file_path, 'http') && Storage::exists(str_replace('storage/', 'public/', $berkala->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $berkala->file_path));
            }
            $berkala->delete();
        }

        $daftar = DaftarInformasi::find($id);
        if ($daftar) {
            if ($daftar->file_informasi && !str_starts_with($daftar->file_informasi, 'http') && Storage::exists(str_replace('storage/', 'public/', $daftar->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $daftar->file_informasi));
            }
            $daftar->delete();
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil dihapus!');
    }
}
