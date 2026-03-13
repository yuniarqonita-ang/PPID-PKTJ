<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfilPpidController extends Controller
{
    protected $types = ['profil', 'tugas', 'visi', 'struktur', 'regulasi', 'kontak'];

    /**
     * Show admin dashboard with all profile sections
     */
    public function index(): View
    {
        $profilesData = [];
        
        foreach ($this->types as $type) {
            $profilesData[$type] = ProfilPpid::where('type', $type)->first() ?? new ProfilPpid(['type' => $type]);
        }
        
        return view('admin.profil.index', compact('profilesData'));
    }

    /**
     * Show edit form for a specific profile section
     */
    public function edit(string $type): View
    {
        if (!in_array($type, $this->types)) {
            abort(404);
        }

        $profil = ProfilPpid::where('type', $type)->first() ?? new ProfilPpid(['type' => $type]);
        return view('admin.profil.edit', compact('profil', 'type'));
    }

    /**
     * Update a specific profile section
     */
    public function update(Request $request, string $type): RedirectResponse
    {
        if (!in_array($type, $this->types)) {
            abort(404);
        }

        // Validation
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten_pembuka' => 'required|string',
            'judul_sub' => 'nullable|string|max:255',
            'konten_detail' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'link_dokumen' => 'nullable|string|max:500',
        ]);

        // Get or create profile section
        $profil = ProfilPpid::where('type', $type)->first() ?? new ProfilPpid(['type' => $type]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $type . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $filename);
            $profil->gambar = $filename;
        }

        // Update profile data
        $profil->type = $type;
        $profil->judul = $validated['judul'];
        $profil->konten_pembuka = $validated['konten_pembuka'];
        $profil->judul_sub = $validated['judul_sub'] ?? null;
        $profil->konten_detail = $validated['konten_detail'] ?? null;
        $profil->link_dokumen = $validated['link_dokumen'] ?? null;

        $profil->save();

        return redirect()->route('admin.profil.edit', $type)
            ->with('success', ($type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas PPID' : ($type === 'visi' ? 'Visi dan Misi' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak'))))) . ' berhasil diperbarui!');
    }

    /**
     * Delete a profile section
     */
    public function destroy(string $type): RedirectResponse
    {
        if (!in_array($type, $this->types)) {
            abort(404);
        }

        $profil = ProfilPpid::where('type', $type)->first();

        if ($profil) {
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }
            $profil->delete();
        }

        return redirect()->route('admin.profil.index')
            ->with('success', 'Konten berhasil dihapus!');
    }
}