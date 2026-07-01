<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesans = PesanKontak::latest()->paginate(15);
        return view('admin.pesan-kontak.index', compact('pesans'));
    }

    public function show($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        if (!$pesan->is_read) {
            $pesan->update(['is_read' => true]);
        }
        return view('admin.pesan-kontak.show', compact('pesan'));
    }

    public function destroy($id)
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->delete();
        return redirect()->route('admin.pesan-kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
