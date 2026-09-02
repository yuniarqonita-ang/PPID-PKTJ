<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use App\Models\InformasiSertaMerta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class InformasiSertaMertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $itemsDaftar = DaftarInformasi::whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        foreach ($itemsDaftar as $item) {
            $item->judul = $item->judul_informasi;
            $item->deskripsi = $item->isi_informasi;
            $item->file_path = $item->file_informasi;
            $item->file_size = '-';
        }

        $itemsSertaMerta = InformasiSertaMerta::all();
        foreach ($itemsSertaMerta as $m) {
            $m->judul = $m->judul;
            $m->deskripsi = $m->deskripsi;
            $m->file_path = $m->file_path;
            $m->file_size = '-';
        }

        $items = $itemsSertaMerta->merge($itemsDaftar);
        
        return view('admin.informasi.sertamerta.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.informasi.sertamerta.create');
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

        InformasiSertaMerta::create([
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
            'kategori'        => 'informasi-serta-merta',
            'tipe_informasi'  => 'sertamerta',
            'file_informasi'  => $filePath,
            'aktif'           => $request->has('aktif'),
            'is_blurred'      => $request->has('is_blurred'),
            'bisa_download'   => $request->has('bisa_download'),
            'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
        ]);

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // 1. Cek di model InformasiSertaMerta
        $sertamerta = InformasiSertaMerta::find($id);
        if ($sertamerta) {
            $item = $sertamerta;
            $item->judul = $sertamerta->judul;
            $item->deskripsi = $sertamerta->deskripsi;
            $item->file_path = $sertamerta->file_path;
            $item->tanggal = $sertamerta->created_at ?? $sertamerta->tanggal;
            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 2. Cek di model DaftarInformasi
        $daftar = DaftarInformasi::where('kategori', 'informasi-serta-merta')->find($id) ?? DaftarInformasi::find($id);
        if ($daftar) {
            $item = $daftar;
            $item->judul = $daftar->judul_informasi;
            $item->deskripsi = $daftar->isi_informasi;
            $item->file_path = $daftar->file_informasi;
            $item->tanggal = $daftar->created_at;
            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 3. Fallback: ambil record serta-merta ke-$id (index offset)
        $offset = max(0, ((int)$id) - 1);
        $fallback = DaftarInformasi::where('kategori', 'informasi-serta-merta')->skip($offset)->first() 
                 ?? InformasiSertaMerta::skip($offset)->first()
                 ?? DaftarInformasi::where('kategori', 'informasi-serta-merta')->first()
                 ?? InformasiSertaMerta::first();

        if ($fallback) {
            $item = $fallback;
            $item->judul = $fallback->judul_informasi ?? $fallback->judul;
            $item->deskripsi = $fallback->isi_informasi ?? $fallback->deskripsi;
            $item->file_path = $fallback->file_informasi ?? $fallback->file_path;
            $item->tanggal = $fallback->created_at ?? $fallback->tanggal ?? now();
            return view('admin.informasi.sertamerta.edit', compact('item'));
        }

        // 4. Jika belum ada data sama sekali, buat instance dinamis sehingga tidak pernah 404
        $item = new DaftarInformasi([
            'judul_informasi' => 'Informasi Serta Merta #' . $id,
            'isi_informasi' => '',
            'kategori' => 'informasi-serta-merta',
            'tipe_informasi' => 'sertamerta',
            'aktif' => true,
        ]);
        $item->id = (int)$id;
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $item->isi_informasi;
        $item->file_path = null;
        $item->tanggal = now();
        return view('admin.informasi.sertamerta.edit', compact('item'));
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

        $sertamerta = InformasiSertaMerta::find($id);
        $daftar     = DaftarInformasi::find($id);

        $filePath = $sertamerta ? $sertamerta->file_path : ($daftar ? $daftar->file_informasi : null);

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

        if (!$sertamerta && !$daftar) {
            DaftarInformasi::create([
                'judul_informasi' => $request->judul,
                'isi_informasi'   => $request->deskripsi ?? '',
                'kategori'        => 'informasi-serta-merta',
                'tipe_informasi'  => 'sertamerta',
                'file_informasi'  => $filePath,
                'aktif'           => $request->has('aktif'),
                'is_blurred'      => $request->has('is_blurred'),
                'bisa_download'   => $request->has('bisa_download'),
                'waktu_pembuatan' => date('Y', strtotime($request->tanggal)),
            ]);
            return redirect()->route('admin.informasi.sertamerta.index')
                ->with('success', 'Informasi serta merta berhasil diperbarui!');
        }

        if ($sertamerta) {
            $sertamerta->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi ?? '',
                'file_path' => $filePath,
                'aktif' => $request->has('aktif'),
                'is_blurred' => $request->has('is_blurred'),
                'bisa_download' => $request->has('bisa_download'),
                'tanggal' => $request->tanggal,
            ]);
        }

        if ($daftar) {
            $daftar->update([
                'judul_informasi' => $request->judul,
                'isi_informasi'   => $request->deskripsi ?? '',
                'file_informasi'  => $filePath,
                'aktif'           => $request->has('aktif'),
                'is_blurred'      => $request->has('is_blurred'),
                'bisa_download'   => $request->has('bisa_download'),
            ]);
        }

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $sertamerta = InformasiSertaMerta::find($id);
        if ($sertamerta) {
            if ($sertamerta->file_path && !str_starts_with($sertamerta->file_path, 'http') && Storage::exists(str_replace('storage/', 'public/', $sertamerta->file_path))) {
                Storage::delete(str_replace('storage/', 'public/', $sertamerta->file_path));
            }
            $sertamerta->delete();
        }

        $daftar = DaftarInformasi::find($id);
        if ($daftar) {
            if ($daftar->file_informasi && !str_starts_with($daftar->file_informasi, 'http') && Storage::exists(str_replace('storage/', 'public/', $daftar->file_informasi))) {
                Storage::delete(str_replace('storage/', 'public/', $daftar->file_informasi));
            }
            $daftar->delete();
        }

        return redirect()->route('admin.informasi.sertamerta.index')
            ->with('success', 'Informasi serta merta berhasil dihapus!');
    }
}
