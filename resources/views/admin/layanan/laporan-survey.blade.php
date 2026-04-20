@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                Laporan <span class="text-[#004a99]">Survey Kepuasan</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Hasil Indeks Kepuasan Masyarakat (IKM) PPID PKTJ</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest">
                <i class="fas fa-home mr-3"></i> DASHBOARD
            </a>
            <a href="http://ppid.pktj.ac.id/layanan-informasi/laporan-survey" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> PORTAL PUBLIK
            </a>
        </div>
    </div>

    <form action="{{ route('admin.halaman-custom.store', 'layanan_survey') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- IDENTITY & HERO -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-poll"></i>
                        </span>
                        Visualisasi Banner IKM
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Besar Hero</label>
                        <input type="text" name="judul_hero" value="{{ $settings['layanan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Sub-judul / Tagline</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['layanan_survey_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- LEFT: REPORT UPLOAD -->
            <div class="lg:col-span-2 space-y-10">
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                            <i class="fas fa-file-export mr-4 text-[#ffc107]"></i> Publikasi Rekap Survey (PDF)
                        </h4>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tahun Penilaian</label>
                                <input type="text" name="tahun_laporan" value="{{ $settings['layanan_survey_tahun_laporan'] ?? date('Y') }}"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl text-lg font-black text-[#002b5c]">
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Ganti Dokumen PDF</label>
                                <input type="file" name="file_laporan" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl">
                            </div>
                        </div>

                        @if(isset($settings['layanan_survey_file_laporan']))
                        <div class="p-8 bg-blue-50 border-2 border-blue-100 rounded-[2rem] flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-white text-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-md">
                                    <i class="fas fa-poll-h"></i>
                                </div>
                                <div>
                                    <p class="text-md font-black text-[#002b5c] uppercase tracking-widest">DOKUMEN IKM AKTIF</p>
                                    <p class="text-sm font-bold text-slate-700 mt-1">{{ $settings['layanan_survey_file_laporan'] }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/halaman/'.$settings['layanan_survey_file_laporan']) }}" target="_blank" class="px-6 py-4 bg-[#002b5c] text-white font-black text-sm rounded-xl shadow-lg border-none hover:bg-black transition-all cursor-pointer">UNDUH FILE</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center mb-10">
                        <i class="fas fa-comment-dots mr-4 text-[#ffc107]"></i> Narasi Penjelasan IKM
                    </h4>
                    <textarea name="ringkasan_eksekutif" class="tinymce-editor">{{ $settings['layanan_survey_ringkasan_eksekutif'] ?? '' }}</textarea>
                </div>
            </div>

            <!-- RIGHT: PREVIEW/INFO -->
            <div class="space-y-10">
                <div class="bg-amber-50 rounded-[2.5rem] p-10 border-2 border-amber-200">
                    <div class="w-16 h-16 bg-[#ffc107] text-[#002b5c] rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4 class="text-xl font-black text-amber-900 uppercase tracking-widest mb-4">Standar Mutu</h4>
                    <p class="text-md font-bold text-amber-900 leading-relaxed">
                        Hasil survey kepuasan harus dipublikasikan secara jujur dan transparan untuk meningkatkan kepercayaan publik terhadap layanan PPID PKTJ.
                    </p>
                </div>

                <button type="submit" class="w-full py-8 bg-[#002b5c] text-white font-black text-xl uppercase tracking-[3px] rounded-[2.5rem] shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                    <i class="fas fa-save mr-4 text-[#ffc107]"></i> SIMPAN HASIL SURVEY
                </button>
                <p class="text-sm text-center text-slate-500 font-black uppercase tracking-widest">Perubahan akan langsung tampil di menu Layanan</p>
            </div>
        </div>
    </form>
</div>
@endsection
