<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    public function index()
    {
        try {
            $pesans = PesanKontak::latest()->paginate(15);
            return view('admin.pesan-kontak.index', compact('pesans'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Database Query Error',
                'message' => $e->getMessage(),
                'hint' => 'Pastikan tabel "pesan_kontaks" sudah ada di database cPanel Anda.'
            ], 500);
        }
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
