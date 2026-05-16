<?php

namespace App\Http\Controllers;

use App\Models\InformasiSertaMerta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiSertaMertaController extends Controller
{
    public function index(): View
    {
        $items = InformasiSertaMerta::latest()->get();
        return view('admin.informasi.sertamerta.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.informasi.sertamerta.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'gdrive_link' => 'nullable|url',
        ]);

        $data = [
            'judul'      => $request->judul,
            'deskripsi'  => $request->deskripsi ?? '',
            'tanggal'    => $request->tanggal,
            'aktif'      => $request->has('aktif'),
            'is_blurred' => $request->has('is_blurred'),
        ];

        // Prioritas: GDrive Link > Upload Lokal
        if ($request->filled('gdrive_link')) {
            $data['file_path'] = $request->gdrive_link;
            $data['file_name'] = 'Google Drive Document';
            $data['file_size'] = '-';
            $data['file_type'] = 'gdrive';
        } elseif ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/sertamerta', $filename);
            $data['file_path'] = 'storage/informasi/sertamerta/' . $filename;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $this->formatFileSize($file->getSize());
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        InformasiSertaMerta::create($data);

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $item = InformasiSertaMerta::findOrFail($id);
        return view('admin.informasi.sertamerta.edit', compact('item'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'required|date',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'gdrive_link' => 'nullable|url',
        ]);

        $item = InformasiSertaMerta::findOrFail($id);

        $item->judul      = $request->judul;
        $item->deskripsi  = $request->deskripsi ?? '';
        $item->tanggal    = $request->tanggal;
        $item->aktif      = $request->has('aktif');
        $item->is_blurred = $request->has('is_blurred');

        // Prioritas: GDrive Link > Upload Lokal
        if ($request->filled('gdrive_link')) {
            $item->file_path = $request->gdrive_link;
            $item->file_name = 'Google Drive Document';
            $item->file_size = '-';
            $item->file_type = 'gdrive';
        } elseif ($request->hasFile('file')) {
            if ($item->file_path && !str_starts_with($item->file_path, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/sertamerta', $filename);
            $item->file_path = 'storage/informasi/sertamerta/' . $filename;
            $item->file_name = $file->getClientOriginalName();
            $item->file_size = $this->formatFileSize($file->getSize());
            $item->file_type = $file->getClientOriginalExtension();
        }

        $item->save();

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil diperbarui!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = InformasiSertaMerta::findOrFail($id);

        if ($item->file_path && Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_path));
        }

        $item->delete();

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil dihapus!');
    }

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
