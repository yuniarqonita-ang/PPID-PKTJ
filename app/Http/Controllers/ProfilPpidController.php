<?php

namespace App\Http\Controllers;

use App\Models\ProfilPpid;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfilPpidController extends Controller
{
    protected $types = [
        'profil', 'tugas', 'visi', 'struktur', 'regulasi', 'kontak',
        'layanan-daftar', 'maklumat-pelayanan', 'laporan-layanan', 'laporan-akses', 'laporan-survey',
        'sop-permintaan', 'sop-keberatan', 'sop-sengketa', 'sop-penetapan', 'sop-pengujian', 'sop-pendokumentasian'
    ];

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

        // Validation - konten_pembuka nullable karena TinyMCE bisa kirim <p><br></p>
        $validated = $request->validate([
            'judul'               => 'required|string|max:255',
            'tagline_hero'        => 'nullable|string|max:255',
            'konten_pembuka'      => 'nullable|string',
            'judul_sub'           => 'nullable|string|max:255',
            'konten_detail'       => 'nullable|string',
            'gambar'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'image_hero'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'link_dokumen'        => 'nullable|url|max:500',
            'additional_title'    => 'nullable|array',
            'additional_content'  => 'nullable|array',
            'gambaran'            => 'nullable|string',
        ]);

        // Helper: jika HTML dari TinyMCE kosong (hanya tag tanpa teks), simpan null
        $cleanHtml = function(?string $html): ?string {
            if (!$html) return null;
            $plain = trim(strip_tags($html));
            return ($plain === '') ? null : $html;
        };

        // Get or create profile section
        $profil = ProfilPpid::where('type', $type)->first() ?? new ProfilPpid(['type' => $type]);

        // Handle image upload (main)
        if ($request->hasFile('gambar')) {
            if ($profil->gambar && Storage::exists('public/profil/' . $profil->gambar)) {
                Storage::delete('public/profil/' . $profil->gambar);
            }
            $file     = $request->file('gambar');
            $filename = time() . '_' . $type . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $filename);
            $profil->gambar = $filename;
        }

        // Handle Hero Image upload
        if ($request->hasFile('image_hero')) {
            if ($profil->image_hero && Storage::exists('public/profil/' . $profil->image_hero)) {
                Storage::delete('public/profil/' . $profil->image_hero);
            }
            $file     = $request->file('image_hero');
            $filename = 'hero_' . time() . '_' . $type . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $filename);
            $profil->image_hero = $filename;
        }

        // Handle Additional Sections
        $sections = [];
        if ($request->has('additional_title')) {
            foreach ($request->additional_title as $index => $title) {
                if ($title || isset($request->additional_content[$index])) {
                    $sections[] = [
                        'title'   => $title,
                        'content' => $request->additional_content[$index] ?? ''
                    ];
                }
            }
        }

        // Update profile data
        $profil->type                = $type;
        $profil->judul               = $validated['judul'];
        $profil->tagline_hero        = $validated['tagline_hero'] ?? null;
        $profil->konten_pembuka      = $cleanHtml($validated['konten_pembuka'] ?? null);
        $profil->judul_sub           = $validated['judul_sub'] ?? null;
        $profil->konten_detail       = $cleanHtml($validated['konten_detail'] ?? null);
        $profil->link_dokumen        = $validated['link_dokumen'] ?? null;
        $profil->additional_sections = $sections;
        $profil->gambaran            = $cleanHtml($validated['gambaran'] ?? null);

        $profil->save();

        return redirect()->route('admin.profil.edit', $type)
            ->with('success', 'Konten berhasil diperbarui!');
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
            if ($profil->image_hero && Storage::exists('public/profil/' . $profil->image_hero)) {
                Storage::delete('public/profil/' . $profil->image_hero);
            }
            $profil->delete();
        }

        return redirect()->route('admin.profil.index')
            ->with('success', 'Konten berhasil dihapus!');
    }
}