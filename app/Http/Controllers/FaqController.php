<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('aktif', true)->latest()->get();
        return view('faq', compact('faqs'));
    }
}
