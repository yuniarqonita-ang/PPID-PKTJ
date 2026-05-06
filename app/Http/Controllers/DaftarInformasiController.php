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
        $validated = $request->validate([
            'judul_informasi'  => 'required|string|max:255',
            'kategori'         => 'nullable|string|max:100',
            'tipe_informasi'   => 'nullable|string|max:100',
            'isi_informasi'    => 'nullable|string',
            'pejabat_penguasa' => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'tempat_pembuatan' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'waktu_pembuatan'  => 'nullable|string|max:100',
            'bentuk_informasi' => 'nullable|string|max:100',
            'jangka_waktu'     => 'nullable|string|max:100',
            'file_informasi'   => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        try {
            $data = $validated;

            if ($request->hasFile('file_informasi')) {
                $file = $request->file('file_informasi');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['file_informasi'] = 'storage/' . $path;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_img_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['image'] = 'storage/' . $path;
            }

            $data['aktif'] = $request->has('aktif');
            $data['is_blurred'] = $request->has('is_blurred');

            DaftarInformasi::create($data);

            return redirect()->route('admin.layanan.daftar-informasi')
                ->with('success', 'Data informasi publik berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $item = DaftarInformasi::findOrFail($id);
        return view('admin.layanan.daftar-informasi-edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = DaftarInformasi::findOrFail($id);

        $validated = $request->validate([
            'judul_informasi'  => 'required|string|max:255',
            'kategori'         => 'nullable|string|max:100',
            'tipe_informasi'   => 'nullable|string|max:100',
            'isi_informasi'    => 'nullable|string',
            'pejabat_penguasa' => 'nullable|string|max:255',
            'penerbit_informasi' => 'nullable|string|max:255',
            'tempat_pembuatan' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'waktu_pembuatan'  => 'nullable|string|max:100',
            'bentuk_informasi' => 'nullable|string|max:100',
            'jangka_waktu'     => 'nullable|string|max:100',
            'file_informasi'   => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        try {
            $data = $validated;

            if ($request->hasFile('file_informasi')) {
                // Delete old file
                if ($item->file_informasi) {
                    $oldPath = str_replace('storage/', '', $item->file_informasi);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $file = $request->file('file_informasi');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-._]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('daftar-informasi', $filename, 'public');
                $data['file_informasi'] = 'storage/' . $path;
            } else {
                unset($data['file_informasi']);
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
            } else {
                unset($data['image']);
            }

            $data['aktif'] = $request->has('aktif');
            $data['is_blurred'] = $request->has('is_blurred');

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
