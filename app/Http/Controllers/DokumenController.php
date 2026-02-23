<?php

namespace App\Http\Controllers;

use App\Models\Dokumen; // INI YANG WAJIB ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::latest()->get();
        return view('admin.dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'kategori' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumen', 'public');

            Dokumen::create([
                'judul' => $validated['judul'],
                'file_path' => $path,
                'kategori' => $validated['kategori'] ?? 'Umum',
                'user_id' => Auth::id()
            ]);

            return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen diupload!');
        }
        return back()->with('error', 'Gagal upload');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if ($dokumen->file_path) { Storage::disk('public')->delete($dokumen->file_path); }
        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen dihapus!');
    }

    /**
     * PUBLIC: List dokumen untuk halaman publik
     */
    public function publicList()
    {
        $dokumen = Dokumen::latest()->paginate(12);
        $kategori = Dokumen::distinct('kategori')->pluck('kategori');
        return view('dokumen', compact('dokumen', 'kategori'));
    }

    /**
     * PUBLIC: Download dokumen
     */
    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return Storage::disk('public')->download($dokumen->file_path, $dokumen->judul . '.' . pathinfo($dokumen->file_path, PATHINFO_EXTENSION));
    }

    /**
     * PUBLIC: View dokumen (PDF di browser)
     */
    public function view($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('dokumen-view', compact('dokumen'));
    }
}