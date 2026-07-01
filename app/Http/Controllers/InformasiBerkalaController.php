<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
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
        $items = DaftarInformasi::where('kategori', 'informasi-berkala')
            ->orderBy('created_at', 'desc')
            ->get();
            
        foreach ($items as $item) {
            $item->judul = $item->judul_informasi;
            $item->deskripsi = $item->isi_informasi;
            $item->file_path = $item->file_informasi;
            $item->file_size = '-';
        }
        
        return view('admin.informasi.berkala.index', compact('items'));
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
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, atau xlsx.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $data = [
            'judul_informasi' => $validated['judul'],
            'isi_informasi'   => $validated['deskripsi'] ?? null,
            'kategori'        => 'informasi-berkala',
            'tipe_informasi'  => 'berkala',
            'aktif'           => $request->has('aktif'),
            'is_blurred'      => $request->has('is_blurred'),
            'bisa_download'   => $request->has('bisa_download'),
        ];

        // Prioritas: Upload File Lokal > Google Drive Link
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);

            $data['file_informasi'] = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            $data['file_informasi'] = $request->input('gdrive_link');
        }

        $item = DaftarInformasi::create($data);
        if ($request->filled('tanggal')) {
            $item->created_at = $request->tanggal;
            $item->waktu_pembuatan = date('Y', strtotime($request->tanggal));
            $item->save();
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $item = DaftarInformasi::findOrFail($id);
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $item->isi_informasi;
        $item->file_path = $item->file_informasi;
        $item->tanggal = $item->created_at;
        return view('admin.informasi.berkala.edit', compact('item'));
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
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, atau xlsx.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $item = DaftarInformasi::findOrFail($id);

        $data = [
            'judul_informasi' => $validated['judul'],
            'isi_informasi'   => $validated['deskripsi'] ?? null,
            'aktif'           => $request->has('aktif'),
            'is_blurred'      => $request->has('is_blurred'),
            'bisa_download'   => $request->has('bisa_download'),
        ];

        // Prioritas: Upload File Lokal > Google Drive Link
        if ($request->hasFile('file')) {
            // Delete old file (hanya jika bukan GDrive link)
            if ($item->file_informasi && !str_starts_with($item->file_informasi, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
            }

            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);

            $data['file_informasi'] = 'storage/daftar-informasi/' . $filename;
        } elseif ($request->filled('gdrive_link')) {
            // Delete old file (hanya jika bukan GDrive link)
            if ($item->file_informasi && !str_starts_with($item->file_informasi, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
            }

            $data['file_informasi'] = $request->input('gdrive_link');
        }

        $item->update($data);
        if ($request->filled('tanggal')) {
            $item->created_at = $request->tanggal;
            $item->waktu_pembuatan = date('Y', strtotime($request->tanggal));
            $item->save();
        }

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = DaftarInformasi::findOrFail($id);

        // Delete file
        if ($item->file_informasi && !str_starts_with($item->file_informasi, 'http') &&
            Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
        }

        $item->delete();

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil dihapus!');
    }
}
