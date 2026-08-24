<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        return view('auth.register', compact('settings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username'         => ['required', 'string', 'max:100', 'unique:'.User::class],
            'password'         => ['nullable', 'string', 'min:6'],
            'jenis_identitas'  => ['required', 'string'],
            'nomor_identitas'  => ['required', 'string', 'max:50'],
            'file_identitas'   => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'alamat'           => ['required', 'string'],
            'no_telp'          => ['required', 'string', 'max:25'],
            'pekerjaan'        => ['required', 'string', 'max:100'],
            'instansi'         => ['nullable', 'string', 'max:255'],
            'persetujuan'      => ['accepted'],
        ], [
            'persetujuan.accepted' => 'Anda harus menyetujui pernyataan kebenaran data dan kebijakan PPID.',
            'file_identitas.max'   => 'Ukuran file identitas maksimal 2MB.',
            'email.unique'         => 'Email ini sudah terdaftar. Silakan login atau gunakan email lain.',
            'username.unique'      => 'Username ini sudah digunakan. Silakan pilih username lain.',
        ]);

        // Upload file identitas (KTP / SIM / Paspor)
        $fileIdentitasPath = null;
        if ($request->hasFile('file_identitas')) {
            $file = $request->file('file_identitas');
            $filename = time() . '_' . Str::slug($request->username) . '_ktp.' . $file->getClientOriginalExtension();
            $fileIdentitasPath = $file->storeAs('identitas', $filename, 'public');
        }

        // Set password: jika tidak diisi user, buat default password acak
        $password = $request->filled('password') ? $request->password : 'PpidPktj@' . rand(1000, 9999);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'username'          => $request->username,
            'password'          => Hash::make($password),
            'jenis_identitas'   => $request->jenis_identitas,
            'nomor_identitas'   => $request->nomor_identitas,
            'file_identitas'    => $fileIdentitasPath,
            'alamat'            => $request->alamat,
            'no_telp'           => $request->no_telp,
            'pekerjaan'         => $request->pekerjaan,
            'instansi'          => $request->instansi,
            'status_verifikasi' => 'pending',
            'role'              => 'pemohon',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran akun berhasil! Data Anda sedang menunggu verifikasi oleh admin PPID.');
    }
}