<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        return view('auth.login', compact('settings'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = $request->input('login');
        $password   = $request->input('password');
        $remember   = $request->filled('remember');

        // Tentukan apakah input berupa email atau username
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $loginInput,
            'password' => $password,
        ];

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect berdasarkan peran (Role)
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // Jika user adalah pemohon informasi
            return redirect()->intended(route('user.dashboard'));
        }

        // Fallback coba ke field alternatif jika user salah mengira format
        if ($fieldType === 'username') {
            if (Auth::attempt(['email' => $loginInput, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                }
                return redirect()->intended(route('user.dashboard'));
            }
        }

        return back()->withErrors([
            'login' => 'Username/Email atau password salah. Silakan periksa kembali data Anda.',
        ])->withInput($request->only('login', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Placeholder Login SSO Kemenhub
     */
    public function ssoKemenhub()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $ssoUrl = $settings['auth_sso_kemenhub_url'] ?? null;

        if ($ssoUrl && filter_var($ssoUrl, FILTER_VALIDATE_URL)) {
            return redirect()->away($ssoUrl);
        }

        return back()->with('info', 'Integrasi SSO Kemenhub sedang dalam tahap penyiapan integrasi server.');
    }

    /**
     * Google Login entry point
     */
    public function googleLogin()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $googleUrl = $settings['auth_google_login_url'] ?? null;

        if ($googleUrl && filter_var($googleUrl, FILTER_VALIDATE_URL)) {
            return redirect()->away($googleUrl);
        }

        return redirect()->route('permohonan.gateway', ['action' => 'google-login']);
    }

    /**
     * Proses Masuk Cepat Akun Google Pemohon
     */
    public function handleGoogleLogin(Request $request)
    {
        $request->validate([
            'google_email' => 'required|email|max:255',
            'google_name'  => 'required|string|max:255',
        ], [
            'google_email.required' => 'Email akun Google wajib diisi.',
            'google_email.email'    => 'Format email Google tidak valid.',
            'google_name.required'  => 'Nama pemilik akun Google wajib diisi.',
        ]);

        $email = strtolower(trim($request->google_email));
        $name  = trim($request->google_name);

        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            $baseUsername = explode('@', $email)[0];
            $username = preg_replace('/[^a-zA-Z0-9_]/', '', $baseUsername);
            if (empty($username) || \App\Models\User::where('username', $username)->exists()) {
                $username = $username . rand(100, 999);
            }

            $user = \App\Models\User::create([
                'name'              => $name,
                'email'             => $email,
                'username'          => $username,
                'password'          => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(24)),
                'role'              => 'pemohon',
                'status'            => 'active',
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->route('permohonan.create')->with('success', 'Berhasil masuk dengan akun Google: ' . $user->email);
    }
}