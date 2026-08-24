<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Tampilkan Dashboard Pemohon (Sesuai Screenshot 5)
     */
    public function index()
    {
        $user = Auth::user();
        $settings = Dashboard::pluck('value', 'key')->toArray();

        // Ambil permohonan milik user yang login
        $myPermohonans = Permohonan::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->orWhere('nomor_telepon', $user->no_telp)
            ->latest()
            ->get();

        $stats = [
            'total'    => $myPermohonans->count(),
            'pending'  => $myPermohonans->where('status', 'pending')->count(),
            'diproses' => $myPermohonans->whereIn('status', ['diproses', 'approved'])->count(),
            'selesai'  => $myPermohonans->whereIn('status', ['selesai', 'completed'])->count(),
            'ditolak'  => $myPermohonans->whereIn('status', ['ditolak', 'rejected'])->count(),
        ];

        return view('user.dashboard', compact('user', 'myPermohonans', 'stats', 'settings'));
    }

    /**
     * Profil / Settings Pemohon
     */
    public function profile()
    {
        $user = Auth::user();
        $settings = Dashboard::pluck('value', 'key')->toArray();
        return view('user.profile', compact('user', 'settings'));
    }

    /**
     * Update Profil Pemohon
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'no_telp'   => 'required|string|max:25',
            'alamat'    => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'instansi'  => 'nullable|string|max:255',
            'file_identitas' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $updateData = [
            'name'      => $request->name,
            'no_telp'   => $request->no_telp,
            'alamat'    => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'instansi'  => $request->instansi,
        ];

        if ($request->hasFile('file_identitas')) {
            $file = $request->file('file_identitas');
            $filename = time() . '_' . ($user->username ?? 'user') . '_ktp.' . $file->getClientOriginalExtension();
            $updateData['file_identitas'] = $file->storeAs('identitas', $filename, 'public');
            $updateData['status_verifikasi'] = 'pending'; // Reset verifikasi jika ganti KTP
        }

        $user->update($updateData);

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
