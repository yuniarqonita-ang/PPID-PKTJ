<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfilPpidController extends Controller
{
    /**
     * Menampilkan halaman edit Profil PPID
     */
    public function index(): View
    {
        // Mengambil data pertama, jika tidak ada maka siapkan objek kosong
        $profil = ProfilPpid::first() ?? new ProfilPpid();
        return view('admin.profil.index', compact('profil'));
    }

    /**
     * Menyimpan atau mengupdate data Profil PPID sesuai Gambar 1-3
     */
    public function update(Request $request)
    {
        // Validasi sederhana agar data tidak kosong
        $request->validate([
            'judul' => 'required',
            'konten_pembuka' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_sub' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'judul_visi' => 'nullable',
            'konten_visi' => 'nullable',
            'gambar_visi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_struktur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'konten_regulasi' => 'nullable',
        ]);

        // Ambil data lama atau buat baru
        $profil = ProfilPpid::firstOrNew(['id' => 1]);

        // Handle Upload Gambar Utama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_profil.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $filename);
            $profil->gambar = $filename;
        }
        // Handle Hapus Gambar Utama (Tanpa Ganti Baru)
        elseif ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }
            $profil->gambar = null;
        }

        // Handle Upload Gambar Sub (Tugas & Tanggung Jawab)
        if ($request->hasFile('gambar_sub')) {
            // Hapus gambar lama jika ada
            if ($profil->gambar_sub && Storage::exists('public/profil/' . $profil->gambar_sub)) {
                Storage::delete('public/profil/' . $profil->gambar_sub);
            }
            
            $fileSub = $request->file('gambar_sub');
            $filenameSub = time() . '_tugas.' . $fileSub->getClientOriginalExtension();
            $fileSub->storeAs('public/profil', $filenameSub);
            $profil->gambar_sub = $filenameSub;
        }
        // Handle Hapus Gambar Sub
        elseif ($request->has('hapus_gambar_sub') && $request->hapus_gambar_sub == '1') {
            if ($profil->gambar_sub && Storage::exists('public/profil/' . $profil->gambar_sub)) {
                Storage::delete('public/profil/' . $profil->gambar_sub);
            }
            $profil->gambar_sub = null;
        }

        // Handle Upload Gambar Visi Misi
        if ($request->hasFile('gambar_visi')) {
            if ($profil->gambar_visi && Storage::exists('public/profil/' . $profil->gambar_visi)) {
                Storage::delete('public/profil/' . $profil->gambar_visi);
            }
            
            $fileVisi = $request->file('gambar_visi');
            $filenameVisi = time() . '_visi.' . $fileVisi->getClientOriginalExtension();
            $fileVisi->storeAs('public/profil', $filenameVisi);
            $profil->gambar_visi = $filenameVisi;
        }
        // Handle Hapus Gambar Visi
        elseif ($request->has('hapus_gambar_visi') && $request->hapus_gambar_visi == '1') {
            if ($profil->gambar_visi && Storage::exists('public/profil/' . $profil->gambar_visi)) {
                Storage::delete('public/profil/' . $profil->gambar_visi);
            }
            $profil->gambar_visi = null;
        }

        // Handle Upload Gambar Struktur Organisasi
        if ($request->hasFile('gambar_struktur')) {
            if ($profil->gambar_struktur && Storage::exists('public/profil/' . $profil->gambar_struktur)) {
                Storage::delete('public/profil/' . $profil->gambar_struktur);
            }
            
            $fileStruk = $request->file('gambar_struktur');
            $filenameStruk = time() . '_struktur.' . $fileStruk->getClientOriginalExtension();
            $fileStruk->storeAs('public/profil', $filenameStruk);
            $profil->gambar_struktur = $filenameStruk;
        }
        elseif ($request->has('hapus_gambar_struktur') && $request->hapus_gambar_struktur == '1') {
            if ($profil->gambar_struktur && Storage::exists('public/profil/' . $profil->gambar_struktur)) {
                Storage::delete('public/profil/' . $profil->gambar_struktur);
            }
            $profil->gambar_struktur = null;
        }

        // Proses simpan data ke tabel profil_ppids
        $profil->judul = $request->judul;
        $profil->konten_pembuka = $request->konten_pembuka;
        $profil->judul_sub = $request->judul_sub;
        $profil->konten_detail = $request->konten_detail;
        $profil->judul_visi = $request->judul_visi;
        $profil->konten_visi = $request->konten_visi;
        $profil->konten_struktur = $request->konten_struktur;
        $profil->konten_regulasi = $request->konten_regulasi;
        $profil->konten_kontak = $request->konten_kontak;
        
        $profil->save();

        return back()->with('success', 'Profil PPID Berhasil Diperbarui!');
    }
}