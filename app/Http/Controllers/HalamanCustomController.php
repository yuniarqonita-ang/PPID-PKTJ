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
        $data = $request->except(['_token', '_method']);
        
        foreach ($data as $key => $value) {
            $settingKey = $type . '_' . $key;
            
            // Handle file uploads
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                
                if (!is_array($file)) {
                    $filename = time() . '_' . $settingKey . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/halaman', $filename);
                    
                    // Delete old file if exists
                    $old = Dashboard::where('key', $settingKey)->first();
                    if ($old && $old->value && Storage::exists('public/halaman/' . $old->value)) {
                        Storage::delete('public/halaman/' . $old->value);
                    }
                    
                    Dashboard::updateOrCreate(
                        ['key' => $settingKey],
                        ['value' => $filename, 'type' => 'file', 'description' => "File untuk $type $key"]
                    );
                }
            } else {
                // Regular inputs (text, date, tinymce html)
                if(!is_array($value)) {
                    Dashboard::updateOrCreate(
                        ['key' => $settingKey],
                        ['value' => $value, 'type' => 'text', 'description' => "Teks dinamis untuk $type $key"]
                    );
                }
            }
        }

        return back()->with('success', 'Informasi pada halaman ' . str_replace('-', ' ', title_case($type)) . ' berhasil diperbarui!');
    }
}
