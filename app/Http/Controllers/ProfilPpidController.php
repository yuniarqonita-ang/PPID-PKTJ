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
        $profils = ProfilPpid::all();
        $profilesData = [];
        
        foreach ($this->types as $type) {
            $profilesData[$type] = $profils->where('type', $type)->first() ?? new ProfilPpid(['type' => $type]);
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
            'konten_pembuka' => 'nullable|string',
            'konten_detail' => 'nullable|string',
            'judul_sub' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'link_dokumen' => 'nullable|url',
        ]);

        // Get or create the profile section
        $profil = ProfilPpid::where('type', $type)->firstOrNew(['type' => $type]);

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

        // Handle image deletion
        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }
            $profil->gambar = null;
        }

        // Update profile data
        $profil->judul = $validated['judul'];
        $profil->konten_pembuka = $validated['konten_pembuka'];
        $profil->konten_detail = $validated['konten_detail'];
        $profil->judul_sub = $validated['judul_sub'];
        
        if (isset($validated['link_dokumen'])) {
            $profil->link_dokumen = $validated['link_dokumen'];
        }

        $profil->save();

        return redirect()->route('admin.profil.edit', $type)
            ->with('success', ucfirst(str_replace('-', ' ', $type)) . ' PPID berhasil diperbarui!');
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