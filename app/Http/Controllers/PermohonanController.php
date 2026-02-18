<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function form()
    {
        return view('permohonan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:permohonan,username',
            'nama_pemohon' => 'required|string|max:255',
            'jenis_identitas' => 'required|in:ktp,paspor,sim,lainnya',
            'nomor_identitas' => 'required|string|max:50',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'perusahaan_instansi' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:permohonan,email',
            'password' => 'required|string|min:6|confirmed',
            'jenis_informasi' => 'required|string|max:255',
            'deskripsi_permohonan' => 'required|string',
            'format_informasi' => 'required|in:digital,cetak,keduanya',
        ]);

        // Hash password sebelum disimpan
        $validated['password'] = bcrypt($validated['password']);

        Permohonan::create($validated);

        return redirect()->back()->with('success', 'Registrasi dan permohonan informasi berhasil dikirimkan. Silakan tunggu konfirmasi kami melalui email.');
    }

    public function index()
    {
        $permohonan = Permohonan::latest()->paginate(10);
        return view('admin.permohonan.index', compact('permohonan'));
    }

    public function show(Permohonan $permohonan)
    {
        return view('admin.permohonan.show', compact('permohonan'));
    }

    public function edit(Permohonan $permohonan)
    {
        return view('admin.permohonan.edit', compact('permohonan'));
    }

    public function update(Request $request, Permohonan $permohonan)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        $permohonan->update($validated);

        return redirect()->route('admin.permohonan.show', $permohonan)->with('success', 'Status permohonan berhasil diperbarui.');
    }

    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('admin.permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }
}
