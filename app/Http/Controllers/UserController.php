<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,operator',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // User model might automatically cast, but we use Hash::make natively just to be safe or rely on the cast. Laravel supports both nicely.
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,operator',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    /**
     * Admin: Daftar Pemohon Informasi Terdaftar
     */
    public function pemohonIndex(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = User::where('role', 'pemohon');

        if ($status && in_array($status, ['pending', 'verified', 'rejected'])) {
            $query->where('status_verifikasi', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('nomor_identitas', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%");
            });
        }

        $pemohons = $query->latest()->paginate(15);
        $counts = [
            'all'      => User::where('role', 'pemohon')->count(),
            'pending'  => User::where('role', 'pemohon')->where(function($q){ $q->where('status_verifikasi', 'pending')->orWhereNull('status_verifikasi'); })->count(),
            'verified' => User::where('role', 'pemohon')->where('status_verifikasi', 'verified')->count(),
            'rejected' => User::where('role', 'pemohon')->where('status_verifikasi', 'rejected')->count(),
        ];

        return view('admin.users.pemohon', compact('pemohons', 'counts', 'status', 'search'));
    }

    /**
     * Admin: Verifikasi Pemohon
     */
    public function verifyPemohon(Request $request, User $user)
    {
        $user->update([
            'status_verifikasi'  => 'verified',
            'catatan_verifikasi' => $request->input('catatan', 'Identitas pemohon telah diverifikasi dan valid.'),
        ]);

        return back()->with('success', "Akun pemohon {$user->name} berhasil diverifikasi.");
    }

    /**
     * Admin: Tolak Verifikasi Pemohon
     */
    public function rejectPemohon(Request $request, User $user)
    {
        $user->update([
            'status_verifikasi'  => 'rejected',
            'catatan_verifikasi' => $request->input('catatan', 'Berkas identitas tidak memenuhi syarat atau tidak jelas.'),
        ]);

        return back()->with('warning', "Status verifikasi akun {$user->name} ditolak.");
    }
}
