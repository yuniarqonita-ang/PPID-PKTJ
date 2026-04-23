<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Storage;

class HalamanCustomController extends Controller
{
    /**
     * Menyimpan data form dinamis ke tabel dashboards
     */
    public function store(Request $request, $type)
    {
        // 1. Handle regular inputs (text, date, tinymce html)
        $inputs = $request->except(['_token', '_method']);
        
        foreach ($inputs as $key => $value) {
            // Skip keys that are actually files
            if ($request->hasFile($key)) continue;

            $settingKey = $type . '_' . $key;
            
            if(!is_array($value)) {
                Dashboard::updateOrCreate(
                    ['key' => $settingKey],
                    ['value' => $value ?? '', 'type' => 'text', 'description' => "Teks dinamis untuk $type $key"]
                );
            }
        }

        // 2. Handle file uploads
        foreach ($request->allFiles() as $key => $file) {
            $settingKey = $type . '_' . $key;
            
            if (!is_array($file) && $file->isValid()) {
                $filename = time() . '_' . $settingKey . '.' . $file->getClientOriginalExtension();
                
                // Store in storage/app/public/halaman
                $file->storeAs('halaman', $filename, 'public');
                
                // Delete old file if exists
                $old = Dashboard::where('key', $settingKey)->first();
                if ($old && $old->value && Storage::disk('public')->exists('halaman/' . $old->value)) {
                    Storage::disk('public')->delete('halaman/' . $old->value);
                }
                
                Dashboard::updateOrCreate(
                    ['key' => $settingKey],
                    ['value' => $filename, 'type' => 'file', 'description' => "File untuk $type $key"]
                );
            }
        }

        return back()->with('success', 'Informasi pada halaman ' . ucwords(str_replace('-', ' ', $type)) . ' berhasil diperbarui!');
    }
}
