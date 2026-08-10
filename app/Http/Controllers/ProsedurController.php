<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Storage;

class ProsedurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.prosedur.index');
    }

    /**
     * Update SOP page settings (judul, tagline, konten, youtube, gambar SOP & alur + hapus gambar)
     */
    public function updateSettings(Request $request)
    {
        $prefix = $request->input('prefix');
        if (!$prefix) {
            return back()->with('error', 'Prefix SOP tidak valid.');
        }

        // 1. Handle standard text fields
        $fields = ['judul_hero', 'tagline_hero', 'konten', 'youtube_link'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field) ?? '';
                if ($field === 'konten') {
                    $val = $this->processBase64ImagesInHtml($val);
                }

                Dashboard::updateOrCreate(
                    ['key' => $prefix . '_' . $field],
                    [
                        'value'       => $val,
                        'type'        => 'text',
                        'description' => "Pengaturan $prefix $field",
                        'aktif'       => true
                    ]
                );
            }
        }

        // 1b. Handle diagram SOP keys (sop_perm_*, sop_keb_*, sop_seng_*)
        $sopPrefixMap = [
            'sop_permintaan' => 'sop_perm',
            'sop_keberatan'  => 'sop_keb',
            'sop_sengketa'   => 'sop_seng',
        ];

        if (array_key_exists($prefix, $sopPrefixMap)) {
            $pKey = $sopPrefixMap[$prefix];
            $diagKeys = ["{$pKey}_diagram_judul", "{$pKey}_diagram_subtitle"];
            for ($i = 1; $i <= 7; $i++) {
                foreach (['nomor','judul','deskripsi','waktu','aktor','icon','warna'] as $attr) {
                    $diagKeys[] = "{$pKey}_step_{$i}_{$attr}";
                }
            }
            for ($j = 1; $j <= 3; $j++) {
                $diagKeys[] = "{$pKey}_legend_{$j}_nama";
            }
            foreach ($diagKeys as $dKey) {
                if ($request->exists($dKey) || $request->has($dKey)) {
                    Dashboard::updateOrCreate(
                        ['key' => $dKey],
                        [
                            'value'       => $request->input($dKey, '') ?? '',
                            'type'        => 'text',
                            'description' => "Diagram SOP: $dKey",
                            'aktif'       => true
                        ]
                    );
                }
            }
        }

        // 2. Hapus Gambar SOP jika dicentang
        if ($request->has('hapus_gambar_sop') || $request->input('hapus_gambar_sop') == '1') {
            $settingKey = $prefix . '_gambar_sop';
            $old = Dashboard::where('key', $settingKey)->first();
            if ($old) {
                if ($old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                    Storage::disk('public')->delete('halaman/' . $old->value);
                }
                $old->delete();
            }
        }

        // 3. Hapus Gambar Proses jika dicentang
        if ($request->has('hapus_gambar_proses') || $request->input('hapus_gambar_proses') == '1') {
            $settingKey = $prefix . '_gambar_proses';
            $old = Dashboard::where('key', $settingKey)->first();
            if ($old) {
                if ($old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                    Storage::disk('public')->delete('halaman/' . $old->value);
                }
                $old->delete();
            }
        }

        // 4. Handle Upload File Baru (gambar_sop, gambar_proses)
        $files = ['gambar_sop', 'gambar_proses'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                if ($file->isValid()) {
                    $settingKey = $prefix . '_' . $fileKey;
                    $filename = time() . '_' . $settingKey . '.' . $file->getClientOriginalExtension();

                    if (!Storage::disk('public')->exists('halaman')) {
                        Storage::disk('public')->makeDirectory('halaman');
                    }

                    $file->storeAs('halaman', $filename, 'public');

                    // Delete old file if exists
                    $old = Dashboard::where('key', $settingKey)->first();
                    if ($old && $old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                        Storage::disk('public')->delete('halaman/' . $old->value);
                    }

                    Dashboard::updateOrCreate(
                        ['key' => $settingKey],
                        [
                            'value'       => $filename,
                            'type'        => 'file',
                            'description' => "Gambar untuk $prefix $fileKey",
                            'aktif'       => true
                        ]
                    );
                }
            }
        }

        return back()->with('success', 'Pengaturan Halaman SOP berhasil diperbarui!');
    }

    /**
     * Process base64 images inside HTML string to real files
     */
    private function processBase64ImagesInHtml($html)
    {
        if (empty($html)) return $html;

        $pattern = '/src=["\']data:image\/(png|jpeg|jpg|gif|webp);base64,([^"\']+)["\']/i';

        return preg_replace_callback($pattern, function ($matches) {
            $ext = strtolower($matches[1]);
            $base64Data = $matches[2];
            $decodedData = base64_decode($base64Data);

            if ($decodedData === false) {
                return $matches[0];
            }

            $filename = time() . '_' . uniqid() . '.' . $ext;

            if (!Storage::disk('public')->exists('editor_uploads')) {
                Storage::disk('public')->makeDirectory('editor_uploads');
            }

            Storage::disk('public')->put('editor_uploads/' . $filename, $decodedData);
            $fileUrl = asset('storage/editor_uploads/' . $filename);

            return 'src="' . $fileUrl . '"';
        }, $html);
    }
}
