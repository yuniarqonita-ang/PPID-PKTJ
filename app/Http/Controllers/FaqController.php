<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Public FAQ page
    public function index()
    {
        $faqs = Faq::where('aktif', true)->latest()->get();
        return view('faq', compact('faqs'));
    }
    
    // Admin FAQ index page
    public function adminIndex()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }
    
    // Admin FAQ create page
    public function create()
    {
        return view('admin.faq.create');
    }
    
    // Admin FAQ store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:200',
            'konten' => 'required|string',
        ]);
        
        Faq::create($validated);
        
        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }
    
    // Admin FAQ edit page
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }
    
    // Admin FAQ update
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:200',
            'konten' => 'required|string',
        ]);
        
        $faq->update($validated);
        
        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }
    
    // Admin FAQ destroy
    public function destroy(Faq $faq)
    {
        $faq->delete();
        
        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }
}
