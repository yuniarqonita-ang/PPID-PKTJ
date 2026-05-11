<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }

    // Public FAQ page
    public function publicIndex()
    {
        $faqs = Faq::where('aktif', true)->latest()->get();
        foreach ($faqs as $faq) {
            $faq->jawaban = $this->processContent($faq->jawaban, $faq->is_blurred ?? false);
        }
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        return view('faq', compact('faqs', 'settings'));
    }
    
    // Admin FAQ index page
    public function adminIndex()
    {
        $items = Faq::latest()->paginate(10);
        return view('admin.faq.index', compact('items'));
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
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);
        
        $validated['aktif'] = true;
        $validated['is_blurred'] = $request->has('is_blurred');
        
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
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);
        
        $validated['is_blurred'] = $request->has('is_blurred');
        
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
