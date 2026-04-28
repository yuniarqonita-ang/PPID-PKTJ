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
            'penanggung_jawab' => 'nullable|string|max:255',
            'waktu_pembuatan'  => 'nullable|string|max:100',
            'bentuk_informasi' => 'nullable|string|max:100',
            'jangka_waktu'     => 'nullable|string|max:100',
            'file_informasi'   => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);

        $data = $validated;

        if ($request->hasFile('file_informasi')) {
            $file = $request->file('file_informasi');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $data['file_informasi'] = 'storage/daftar-informasi/' . $filename;
        }

        $data['aktif'] = $request->has('aktif');

        DaftarInformasi::create($data);

        return redirect()->route('admin.layanan.daftar-informasi')
            ->with('success', 'Data informasi publik berhasil ditambahkan!');
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
            'penanggung_jawab' => 'nullable|string|max:255',
            'waktu_pembuatan'  => 'nullable|string|max:100',
            'bentuk_informasi' => 'nullable|string|max:100',
            'jangka_waktu'     => 'nullable|string|max:100',
            'file_informasi'   => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);

        $data = $validated;

        if ($request->hasFile('file_informasi')) {
            // Delete old file
            if ($item->file_informasi && Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
            }
            $file = $request->file('file_informasi');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/daftar-informasi', $filename);
            $data['file_informasi'] = 'storage/daftar-informasi/' . $filename;
        } else {
            unset($data['file_informasi']); // jangan timpa kalau tidak ada file baru
        }

        $data['aktif'] = $request->has('aktif');

        $item->update($data);

        return redirect()->route('admin.layanan.daftar-informasi')
            ->with('success', 'Data informasi publik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = DaftarInformasi::findOrFail($id);
        if ($item->file_informasi && Storage::exists(str_replace('storage/', 'public/', $item->file_informasi))) {
            Storage::delete(str_replace('storage/', 'public/', $item->file_informasi));
        }
        $item->delete();

        return redirect()->route('admin.layanan.daftar-informasi')
            ->with('success', 'Data informasi publik berhasil dihapus!');
    }
}
