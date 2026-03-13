<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Upload image for Summernote
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/summernote', $filename);
            
            return response()->json([
                'url' => asset('storage/summernote/' . $filename)
            ]);
        }
        
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
