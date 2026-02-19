<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ProfilPpid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfilPublikController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ==================== ADMIN PROFIL PPID ====================

    /**
     * Show profil PPID edit form
     */
    public function editProfil(): View
    {
        return view('admin.profil.edit');
    }

    /**
     * Update profil PPID
     */
    public function updateProfil(Request $request): RedirectResponse
    {
        return Redirect::route('admin.profil.edit')->with('status', 'profil-updated');
    }

    /**
     * Show tugas PPID edit form
     */
    public function editTugas(): View
    {
        return view('admin.profil.tugas');
    }

    /**
     * Update tugas PPID
     */
    public function updateTugas(Request $request): RedirectResponse
    {
        return Redirect::route('admin.tugas.edit')->with('status', 'tugas-updated');
    }

    /**
     * Show visi PPID edit form
     */
    public function editVisi(): View
    {
        return view('admin.profil.visi');
    }

    /**
     * Update visi PPID
     */
    public function updateVisi(Request $request): RedirectResponse
    {
        return Redirect::route('admin.visi.edit')->with('status', 'visi-updated');
    }

    /**
     * Show struktur PPID edit form
     */
    public function editStruktur(): View
    {
        return view('admin.profil.struktur');
    }

    /**
     * Update struktur PPID
     */
    public function updateStruktur(Request $request): RedirectResponse
    {
        return Redirect::route('admin.struktur.edit')->with('status', 'struktur-updated');
    }

    /**
     * Show regulasi PPID edit form
     */
    public function editRegulasi(): View
    {
        return view('admin.profil.regulasi');
    }

    /**
     * Update regulasi PPID
     */
    public function updateRegulasi(Request $request): RedirectResponse
    {
        return Redirect::route('admin.regulasi.edit')->with('status', 'regulasi-updated');
    }

    /**
     * Show kontak PPID edit form
     */
    public function editKontak(): View
    {
        return view('admin.profil.kontak');
    }

    /**
     * Update kontak PPID
     */
    public function updateKontak(Request $request): RedirectResponse
    {
        return Redirect::route('admin.kontak.edit')->with('status', 'kontak-updated');
    }

    // ==================== FRONTEND (USER) ====================

    /**
     * Show profil PPID to users
     */
    public function showProfil(): View
    {
        $profil = ProfilPpid::where('type', 'profil')->first();
        return view('profil-ppid', compact('profil'));
    }

    /**
     * Show tugas PPID to users
     */
    public function showTugas(): View
    {
        $profil = ProfilPpid::where('type', 'tugas')->first();
        return view('profil-tugas-tanggung-jawab', compact('profil'));
    }

    /**
     * Show visi PPID to users
     */
    public function showVisi(): View
    {
        $profil = ProfilPpid::where('type', 'visi')->first();
        return view('profil-visi-misi', compact('profil'));
    }

    /**
     * Show struktur PPID to users
     */
    public function showStruktur(): View
    {
        $profil = ProfilPpid::where('type', 'struktur')->first();
        return view('profil-struktur-organisasi', compact('profil'));
    }

    /**
     * Show regulasi PPID to users
     */
    public function showRegulasi(): View
    {
        $profil = ProfilPpid::where('type', 'regulasi')->first();
        return view('profil-regulasi', compact('profil'));
    }

    /**
     * Show kontak PPID to users
     */
    public function showKontak(): View
    {
        $profil = ProfilPpid::where('type', 'kontak')->first();
        return view('profil-kontak', compact('profil'));
    }
}
