<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarInformasiController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $items = DaftarInformasi::latest()->paginate(15);
        return view('admin.layanan.daftar-informasi', compact('items', 'settings'));
    }

    public function create()
    {
        return view('admin.layanan.daftar-informasi-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_informasi'    => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'tipe_informasi'     => 'nullable|string|max:100',
            'isi_informasi'      => 'nullable|string',
            'pejabat_penguasa'   => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'tempat_pembuatan'   => 'nullable|string|max:255',
            'penanggung_jawab'   => 'nullable|string|max:255',
            'waktu_pembuatan'    => 'nullable|string|max:100',
            'bentuk_informasi'   => 'nullable|string|max:100',
            'jangka_waktu'       => 'nullable|string|max:100',
            'file_informasi'     => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'gdrive_link'        => 'nullable|url',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'file_informasi.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive.',
            'file_informasi.max' => 'Ukuran file tidak boleh melebihi 20 MB.',
            'file_informasi.mimes' => 'Format file harus berupa pdf, doc, atau docx.',
            'image.uploaded' => 'Gagal mengunggah gambar. Ukuran file gambar terlalu besar (maksimal 5MB).',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        try {
            $data = $request->except(['_token', 'file_informasi', 'image', 'gdrive_link']);
            $data['aktif']         = $request->has('aktif');
            $data['is_blurred']    = $request->has('is_blurred');
            $data['bisa_download'] = $request->has('bisa_download');

            // Prioritas: Upload File Lokal > GDrive Link
            if ($request->hasFile('file_informasi')) {
                $file = $request->file('file_informasi');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['file_informasi'] = 'storage/' . $path;
            } elseif ($request->filled('gdrive_link')) {
                $data['file_informasi'] = $request->gdrive_link;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_img_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['image'] = 'storage/' . $path;
            }

            DaftarInformasi::create($data);

            return redirect()->route('admin.layanan.daftar-informasi')
                ->with('success', 'Data informasi publik berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $item = DaftarInformasi::find($id);

        if (!$item) {
            $offset = max(0, ((int)$id) - 1);
            $item = DaftarInformasi::skip($offset)->first() ?? DaftarInformasi::first();
        }

        if (!$item) {
            $item = new DaftarInformasi([
                'judul_informasi' => 'Informasi Publik #' . $id,
                'isi_informasi' => '',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'aktif' => true,
            ]);
            $item->id = (int)$id;
        }

        return view('admin.layanan.daftar-informasi-edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = DaftarInformasi::find($id) ?? new DaftarInformasi();

        $request->validate([
            'judul_informasi'    => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'tipe_informasi'     => 'nullable|string|max:100',
            'isi_informasi'      => 'nullable|string',
            'pejabat_penguasa'   => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'tempat_pembuatan'   => 'nullable|string|max:255',
            'penanggung_jawab'   => 'nullable|string|max:255',
            'waktu_pembuatan'    => 'nullable|string|max:100',
            'bentuk_informasi'   => 'nullable|string|max:100',
            'jangka_waktu'       => 'nullable|string|max:100',
            'file_informasi'     => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'gdrive_link'        => 'nullable|url',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'file_informasi.uploaded' => 'Gagal mengunggah file. Ukuran file mungkin melebihi batas maksimal server. Silakan coba kompres PDF Anda atau gunakan opsi Link Google Drive.',
            'file_informasi.max' => 'Ukuran file tidak boleh melebihi 20 MB.',
            'file_informasi.mimes' => 'Format file harus berupa pdf, doc, atau docx.',
            'image.uploaded' => 'Gagal mengunggah gambar. Ukuran file gambar terlalu besar (maksimal 5MB).',
            'gdrive_link.url' => 'Format link Google Drive tidak valid.',
        ]);

        try {
            $data = $request->except(['_token', '_method', 'file_informasi', 'image', 'gdrive_link']);
            $data['aktif']         = $request->has('aktif');
            $data['is_blurred']    = $request->has('is_blurred');
            $data['bisa_download'] = $request->has('bisa_download');

            if ($request->has('hapus_file')) {
                if ($item->file_informasi && strpos($item->file_informasi, 'http') === false) {
                    $oldPath = str_replace('storage/', '', $item->file_informasi);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $data['file_informasi'] = null;
            } elseif ($request->hasFile('file_informasi')) {
                // Delete old local file if one existed
                if ($item->file_informasi && strpos($item->file_informasi, 'http') === false) {
                    $oldPath = str_replace('storage/', '', $item->file_informasi);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $file = $request->file('file_informasi');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['file_informasi'] = 'storage/' . $path;
            } elseif ($request->filled('gdrive_link')) {
                // Delete old local file if one existed
                if ($item->file_informasi && strpos($item->file_informasi, 'http') === false) {
                    $oldPath = str_replace('storage/', '', $item->file_informasi);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $data['file_informasi'] = $request->gdrive_link;
            } else {
                // If gdrive_link was cleared AND no new file is uploaded, but previously it was a GDrive link,
                // set file_informasi to null. Otherwise keep the old file.
                if ($item->file_informasi && (strpos($item->file_informasi, 'drive.google.com') !== false || strpos($item->file_informasi, 'docs.google.com') !== false) && !$request->filled('gdrive_link')) {
                    $data['file_informasi'] = null;
                }
            }

            if ($request->hasFile('image')) {
                // Delete old image
                if ($item->image) {
                    $oldPath = str_replace('storage/', '', $item->image);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $file = $request->file('image');
                $filename = time() . '_img_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['image'] = 'storage/' . $path;
            }

            $item->update($data);

            return redirect()->route('admin.layanan.daftar-informasi')
                ->with('success', 'Data informasi publik berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        $item = DaftarInformasi::findOrFail($id);
        if ($item->file_informasi && Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
        }
        if ($item->image && Storage::exists(str_replace('storage/', 'public/', $item->image))) {
            Storage::delete(str_replace('storage/', 'public/', $item->image));
        }
        $item->delete();

        return redirect()->route('admin.layanan.daftar-informasi')
            ->with('success', 'Data informasi publik berhasil dihapus!');
    }
}
