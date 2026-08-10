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
        
        // Fetch dashboard settings for this type (prefixed)
        $pfx = str_replace('-', '_', $type);
        $settings = \App\Models\Dashboard::where('key', 'like', $pfx . '_%')
            ->pluck('value', 'key')
            ->mapWithKeys(function($value, $key) use ($pfx) {
                // Remove prefix to simplify retrieval in view
                return [str_replace($pfx . '_', '', $key) => $value];
            })->toArray();
            
        return view('admin.profil.edit', compact('profil', 'type', 'settings'));
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
            'additional_layout'   => 'nullable|array',
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
                        'content' => $request->additional_content[$index] ?? '',
                        'layout'  => $request->additional_layout[$index] ?? 'default'
                    ];
                }
            }
        }

        // If type is 'struktur', always ensure the Diagram section is preserved
        if ($type === 'struktur') {
            $hasDiagram = false;
            foreach ($sections as $sec) {
                if (($sec['layout'] ?? '') === 'diagram') {
                    $hasDiagram = true;
                    break;
                }
            }
            if (!$hasDiagram) {
                $existingSections = $profil->additional_sections ?? [];
                $foundDiagram = false;
                foreach ($existingSections as $sec) {
                    if (($sec['layout'] ?? '') === 'diagram') {
                        array_unshift($sections, $sec);
                        $foundDiagram = true;
                        break;
                    }
                }
                if (!$foundDiagram) {
                    array_unshift($sections, [
                        'title' => 'Diagram Struktur Organisasi',
                        'layout' => 'diagram',
                        'content' => '<!-- Bagian ini akan dirender dengan template diagram -->'
                    ]);
                }
            }
        }

        // Update profile data
        $profil->type                = $type;
        $profil->judul               = $validated['judul'];
        $profil->tagline_hero        = $validated['tagline_hero'] ?? null;
        if ($request->has('hapus_konten_pembuka')) {
            $profil->konten_pembuka = null;
        } else {
            $profil->konten_pembuka = $cleanHtml($validated['konten_pembuka'] ?? null);
        }
        $profil->judul_sub           = $validated['judul_sub'] ?? null;
        $profil->konten_detail       = $cleanHtml($validated['konten_detail'] ?? null);
        $profil->link_dokumen        = $validated['link_dokumen'] ?? null;
        $profil->additional_sections = $sections;
        if ($request->has('hapus_gambaran')) {
            $profil->gambaran = null;
        } else {
            $profil->gambaran = $cleanHtml($validated['gambaran'] ?? null);
        }
        $profil->is_blurred          = $request->has('is_blurred');
        $profil->save();

        // ===== HANDLE DASHBOARD-BASED FIELDS (Prefix-based) =====
        $pfx = str_replace('-', '_', $type);
        $dashboardFields = [
            'youtube_link', 'judul_maklumat', 'isi_maklumat', 'judul_standar', 'isi_standar',
            'judul_konten', 'isi_konten', 'ringkasan_eksekutif', 'isi_laporan', 'tahun_laporan', 'jenis_laporan',
            'facebook_link', 'instagram_link', 'twitter_link', 'linktree_link', 'whatsapp_link',
            'kampus_1_nama', 'kampus_1_alamat', 'kampus_1_email', 'kampus_1_telepon', 'kampus_1_map',
            'kampus_2_nama', 'kampus_2_alamat', 'kampus_2_email', 'kampus_2_telepon', 'kampus_2_map',
            'l1_role', 'l1_name',
            'l2_c1_role', 'l2_c1_name', 'l2_c2_role', 'l2_c2_name', 'l2_c3_role', 'l2_c3_name', 'l2_c4_role', 'l2_c4_name',
            'l3_c1_role', 'l3_c1_name', 'l3_c2_role', 'l3_c2_name',
            'l4_c1_role', 'l4_c1_name', 'l4_c2_role', 'l4_c2_name', 'l4_c3_role', 'l4_c3_name', 'l4_c4_role', 'l4_c4_name', 'l4_c5_role', 'l4_c5_name', 'l4_c6_role', 'l4_c6_name', 'l4_c7_role', 'l4_c7_name'
        ];

        foreach ($dashboardFields as $field) {
            if ($request->has($field)) {
                $key = $pfx . '_' . $field;
                $value = $request->input($field) ?? '';

                // Restore https:// if it was stripped by client JS to bypass ModSecurity
                if (in_array($field, ['facebook_link', 'instagram_link', 'twitter_link', 'linktree_link', 'whatsapp_link']) && !empty($value)) {
                    if (!preg_match('/^https?:\/\//i', $value) && $value !== '#') {
                        $value = 'https://' . $value;
                    }
                }

                \App\Models\Dashboard::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'type' => 'text', 'aktif' => true]
                );
            }
        }

        // Special handling for dynamic organization diagram roles/sub-headings
        if ($type === 'struktur') {
            for ($i = 1; $i <= 5; $i++) {
                if ($request->has("role_$i")) {
                    \App\Models\Dashboard::updateOrCreate(
                        ['key' => "struktur_role_$i"],
                        ['value' => $request->input("role_$i") ?? '', 'type' => 'text', 'aktif' => true]
                    );
                }
                if ($request->has("sub_$i")) {
                    \App\Models\Dashboard::updateOrCreate(
                        ['key' => "struktur_sub_$i"],
                        ['value' => $request->input("sub_$i") ?? '', 'type' => 'text', 'aktif' => true]
                    );
                }
            }
        }

        // Handle Dashboard Files
        $fileFields = ['gambar_sop', 'gambar_proses', 'gambar_maklumat', 'file_laporan'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $key = $pfx . '_' . $field;
                $oldFile = \App\Models\Dashboard::where('key', $key)->first()?->value;
                if ($oldFile && Storage::exists('public/halaman/' . $oldFile)) {
                    Storage::delete('public/halaman/' . $oldFile);
                }
                
                $file = $request->file($field);
                $filename = $field . '_' . time() . '_' . $type . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/halaman', $filename);
                
                \App\Models\Dashboard::updateOrCreate(
                    ['key' => $key],
                    ['value' => $filename, 'type' => 'file', 'aktif' => true]
                );
            }
        }

        return redirect()->route('admin.profil.edit', $type)
            ->with('success', 'Konten ' . strtoupper($type) . ' berhasil diperbarui!');
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