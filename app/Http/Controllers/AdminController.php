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
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Validate file
                if (!$file->isValid()) {
                    return response()->json(['error' => 'File tidak valid atau rusak.'], 400);
                }

                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed)) {
                    return response()->json(['error' => 'Format file tidak diizinkan.'], 400);
                }

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Store in storage/app/public/editor_uploads
                $path = $file->storeAs('public/editor_uploads', $filename);
                
                if ($path) {
                    return response()->json([
                        'location' => asset('storage/editor_uploads/' . $filename)
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('TinyMCE Upload Error: ' . $e->getMessage());
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
        
        return response()->json(['error' => 'Gagal mengupload gambar. Pastikan file valid.'], 400);
    }
}
