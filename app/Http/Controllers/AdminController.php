<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Upload image for TinyMCE 6
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store in storage/app/public/editor_uploads
            $path = $file->storeAs('public/editor_uploads', $filename);
            
            if ($path) {
                return response()->json([
                    'location' => asset('storage/editor_uploads/' . $filename)
                ]);
            }
        }
        
        return response()->json(['error' => 'Gagal mengupload gambar. Pastikan file valid.'], 400);
    }
}
