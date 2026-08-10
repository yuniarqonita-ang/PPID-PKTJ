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
        $items = InformasiDikecualikan::orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->get();
        return view('admin.informasi.dikecualikan.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.informasi.dikecualikan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'nullable|string',
            'tanggal'             => 'required|date',
            'dasar_hukum'         => 'nullable|string',
            'konsekuensi_dibuka'  => 'nullable|string',
            'konsekuensi_ditutup' => 'nullable|string',
            'jangka_waktu'        => 'nullable|string|max:255',
            'penanggung_jawab'    => 'nullable|string|max:255',
            'file'                => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'gdrive_link'         => 'nullable|url',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, xlsx, atau gambar.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $data = [
            'judul'               => $request->judul,
            'deskripsi'           => $request->deskripsi ?? '',
            'tanggal'             => $request->tanggal,
            'dasar_hukum'         => $request->dasar_hukum,
            'konsekuensi_dibuka'  => $request->konsekuensi_dibuka,
            'konsekuensi_ditutup' => $request->konsekuensi_ditutup,
            'jangka_waktu'        => $request->jangka_waktu,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'aktif'               => $request->has('aktif'),
            'is_blurred'          => $request->has('is_blurred'),
            'bisa_download'       => $request->has('bisa_download'),
        ];

        // Prioritas: Upload Lokal > GDrive Link
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/dikecualikan', $filename);
            $data['file_path'] = 'storage/informasi/dikecualikan/' . $filename;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $this->formatFileSize($file->getSize());
            $data['file_type'] = $file->getClientOriginalExtension();
        } elseif ($request->filled('gdrive_link')) {
            $data['file_path'] = $request->gdrive_link;
            $data['file_name'] = 'Google Drive Document';
            $data['file_size'] = '-';
            $data['file_type'] = 'gdrive';
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
        $request->validate([
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'nullable|string',
            'tanggal'             => 'required|date',
            'dasar_hukum'         => 'nullable|string',
            'konsekuensi_dibuka'  => 'nullable|string',
            'konsekuensi_ditutup' => 'nullable|string',
            'jangka_waktu'        => 'nullable|string|max:255',
            'penanggung_jawab'    => 'nullable|string|max:255',
            'file'                => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'gdrive_link'         => 'nullable|url',
        ], [
            'file.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive di bawah.',
            'file.max' => 'Ukuran file tidak boleh melebihi 10 MB.',
            'file.mimes' => 'Format file harus berupa pdf, doc, docx, xls, xlsx, atau gambar.',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        $item = InformasiDikecualikan::findOrFail($id);

        $item->judul               = $request->judul;
        $item->deskripsi           = $request->deskripsi ?? '';
        $item->tanggal             = $request->tanggal;
        $item->dasar_hukum         = $request->dasar_hukum;
        $item->konsekuensi_dibuka  = $request->konsekuensi_dibuka;
        $item->konsekuensi_ditutup = $request->konsekuensi_ditutup;
        $item->jangka_waktu        = $request->jangka_waktu;
        $item->penanggung_jawab    = $request->penanggung_jawab;
        $item->aktif               = $request->has('aktif');
        $item->is_blurred          = $request->has('is_blurred');
        $item->bisa_download       = $request->has('bisa_download');

        if ($request->has('hapus_file')) {
            if ($item->file_path && !str_starts_with($item->file_path, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }
            $item->file_path = null;
            $item->file_name = null;
            $item->file_size = null;
            $item->file_type = null;
        } elseif ($request->hasFile('file')) {
            if ($item->file_path && !str_starts_with($item->file_path, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasi/dikecualikan', $filename);
            $item->file_path = 'storage/informasi/dikecualikan/' . $filename;
            $item->file_name = $file->getClientOriginalName();
            $item->file_size = $this->formatFileSize($file->getSize());
            $item->file_type = $file->getClientOriginalExtension();
        } elseif ($request->filled('gdrive_link')) {
            if ($item->file_path && !str_starts_with($item->file_path, 'http') &&
                Storage::exists(str_replace('storage/', 'public/', $item->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_path));
            }
            $item->file_path = $request->gdrive_link;
            $item->file_name = 'Google Drive Document';
            $item->file_size = '-';
            $item->file_type = 'gdrive';
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
