<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        $data = $request->only(['pertanyaan', 'jawaban']);
        $data['is_blurred'] = $request->has('is_blurred');
        Faq::create($data);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban' => 'required|string',
        ]);

        $data = $request->only(['pertanyaan', 'jawaban']);
        $data['is_blurred'] = $request->has('is_blurred');
        $faq->update($data);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus');
    }
}
