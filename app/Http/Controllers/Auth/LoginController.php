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
     * Placeholder Login Google
     */
    public function googleLogin()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $googleUrl = $settings['auth_google_login_url'] ?? null;

        if ($googleUrl && filter_var($googleUrl, FILTER_VALIDATE_URL)) {
            return redirect()->away($googleUrl);
        }

        return back()->with('info', 'Layanan Login Google sedang dalam tahap konfigurasi OAuth.');
    }
}