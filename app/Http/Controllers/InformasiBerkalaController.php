<?php

namespace App\Http\Controllers;

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
        $items = InformasiBerkala::latest()->get();
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
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ]);

        $data = [
            'judul'      => $validated['judul'],
            'deskripsi'  => $validated['deskripsi'] ?? null,
            'aktif'      => $request->has('aktif'),
            'is_blurred' => $request->has('is_blurred'),
        ];

        // Prioritas: Google Drive Link > Upload File Lokal
        if ($request->filled('gdrive_link')) {
            $data['file_path'] = $request->input('gdrive_link');
            $data['file_name'] = 'Google Drive Document';
            $data['file_size'] = '-';
            $data['file_type'] = 'gdrive';
        } elseif ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/berkala', $filename);

            $data['file_path'] = 'storage/informasi/berkala/' . $filename;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $this->formatFileSize($file->getSize());
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        InformasiBerkala::create($data);

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $item = InformasiBerkala::findOrFail($id);
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
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'gdrive_link' => 'nullable|url',
            'aktif'       => 'boolean',
        ]);

        $item = InformasiBerkala::findOrFail($id);

        $item->judul      = $validated['judul'];
        $item->deskripsi  = $validated['deskripsi'] ?? null;
        $item->aktif      = $request->has('aktif');
        $item->is_blurred = $request->has('is_blurred');

        // Prioritas: Google Drive Link > Upload File Lokal (biarkan jika kosong keduanya)
        if ($request->filled('gdrive_link')) {
            $item->file_path = $request->input('gdrive_link');
            $item->file_name = 'Google Drive Document';
            $item->file_size = '-';
            $item->file_type = 'gdrive';
        } elseif ($request->hasFile('file')) {
            // Delete old file (hanya jika bukan GDrive link)
            if ($item->file_path && !str_starts_with($item->file_path, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }

            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/berkala', $filename);

            $item->file_path = 'storage/informasi/berkala/' . $filename;
            $item->file_name = $file->getClientOriginalName();
            $item->file_size = $this->formatFileSize($file->getSize());
            $item->file_type = $file->getClientOriginalExtension();
        }

        $item->save();

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = InformasiBerkala::findOrFail($id);

        // Delete file
        if ($item->file_path && Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_path));
        }

        $item->delete();

        return redirect()->route('admin.informasi.berkala.index')
            ->with('success', 'Informasi berkala berhasil dihapus!');
    }

    /**
     * Format file size
     */
    private function formatFileSize($bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
