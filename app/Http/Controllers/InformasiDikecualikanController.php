<?php

namespace App\Http\Controllers;

use App\Models\InformasiDikecualikan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiDikecualikanController extends Controller
{
    public function index(): View
    {
        $items = InformasiDikecualikan::latest()->get();
        return view('admin.informasi.dikecualikan.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.informasi.dikecualikan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? '',
            'tanggal' => $validated['tanggal'],
            'aktif' => $request->has('aktif'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $path = $file->storeAs('public/informasi/dikecualikan', $filename);
            
            $data['file_path'] = 'storage/informasi/dikecualikan/' . $filename;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $this->formatFileSize($file->getSize());
            $data['file_type'] = $file->getClientOriginalExtension();
        }

        InformasiDikecualikan::create($data);

        return redirect()->route('admin.informasi.dikecualikan.index')
            ->with('success', 'Informasi dikecualikan berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $item = InformasiDikecualikan::findOrFail($id);
        return view('admin.informasi.dikecualikan.edit', compact('item'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $item = InformasiDikecualikan::findOrFail($id);
        
        $item->judul = $validated['judul'];
        $item->deskripsi = $validated['deskripsi'] ?? '';
        $item->tanggal = $validated['tanggal'];
        $item->aktif = $request->has('aktif');

        if ($request->hasFile('file')) {
            if ($item->file_path && Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }

            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $path = $file->storeAs('public/informasi/dikecualikan', $filename);
            
            $item->file_path = 'storage/informasi/dikecualikan/' . $filename;
            $item->file_name = $file->getClientOriginalName();
            $item->file_size = $this->formatFileSize($file->getSize());
            $item->file_type = $file->getClientOriginalExtension();
        }

        $item->save();

        return redirect()->route('admin.informasi.dikecualikan.index')
            ->with('success', 'Informasi dikecualikan berhasil diperbarui!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = InformasiDikecualikan::findOrFail($id);

        if ($item->file_path && Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_path));
        }

        $item->delete();

        return redirect()->route('admin.informasi.dikecualikan.index')
            ->with('success', 'Informasi dikecualikan berhasil dihapus!');
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
