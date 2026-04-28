@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Laporan Survey: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Laporan <span class="text-[#ffc107]">Survey Kepuasan</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Hasil Indeks Kepuasan Masyarakat (IKM) PPID PKTJ.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="http://ppid.pktj.ac.id/layanan-informasi/laporan-survey" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <button type="submit" form="laporan-form" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-save mr-3"></i> Simpan Laporan
                </button>
            </div>
        </div>
    </div>

    <form id="laporan-form" action="{{ route('admin.halaman-custom.store', 'laporan_survey') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- IDENTITY & HERO -->
        <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#004a99] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-poll"></i>
                        </span>
                        Visualisasi Banner IKM
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Judul Besar Hero</label>
                        <input type="text" name="judul_hero" value="{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Sub-judul / Tagline</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['laporan_survey_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <!-- MAIN CONTENT AREA (FULL WIDTH) -->
            <div class="space-y-10">
                <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fas fa-file-export mr-4 text-[#ffc107]"></i> Publikasi Rekap Survey (PDF)
                        </h4>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Tahun Penilaian</label>
                                <input type="text" name="tahun_laporan" value="{{ $settings['laporan_survey_tahun_laporan'] ?? date('Y') }}"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl text-lg font-black text-[#004a99]">
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Ganti Dokumen PDF</label>
                                <input type="file" name="file_laporan" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl">
                            </div>
                        </div>

                        @if(isset($settings['laporan_survey_file_laporan']) && $settings['laporan_survey_file_laporan'])
                        <div class="p-8 bg-blue-50 border-2 border-blue-100 rounded-[2rem] flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-white text-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-md">
                                    <i class="fas fa-poll-h"></i>
                                </div>
                                <div>
                                    <p class="text-md font-black text-[#004a99] uppercase tracking-widest">DOKUMEN IKM AKTIF</p>
                                    <p class="text-sm font-bold text-slate-700 mt-1">{{ $settings['laporan_survey_file_laporan'] }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/halaman/'.$settings['laporan_survey_file_laporan']) }}" target="_blank" class="px-6 py-4 bg-[#004a99] text-white font-black text-sm rounded-xl shadow-lg border-none hover:bg-black transition-all cursor-pointer">UNDUH FILE</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-10">
                    <h4 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center mb-10">
                        <i class="fas fa-comment-dots mr-4 text-[#ffc107]"></i> Narasi Penjelasan IKM
                    </h4>
                    <textarea name="ringkasan_eksekutif" class="tinymce-editor">{{ $settings['laporan_survey_ringkasan_eksekutif'] ?? '' }}</textarea>
                </div>
            </div>

            <!-- SIDEBAR CONFIG (NOW MOVED BELOW) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-10">
                <div class="bg-amber-50 rounded-2xl p-10 border-2 border-amber-200">
                    <div class="w-16 h-16 bg-[#ffc107] text-[#004a99] rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4 class="text-xl font-black text-amber-900 uppercase tracking-widest mb-4">Standar Mutu</h4>
                    <p class="text-md font-bold text-amber-900 leading-relaxed">
                        Hasil survey kepuasan harus dipublikasikan secara jujur dan transparan untuk meningkatkan kepercayaan publik terhadap layanan PPID PKTJ.
                    </p>
                </div>

                <div class="lg:col-span-2">
                    <button type="submit" class="w-full py-8 bg-[#004a99] text-white font-black text-xl uppercase tracking-[3px] rounded-[2rem] shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                        <i class="fas fa-save mr-4 text-[#ffc107]"></i> SIMPAN HASIL SURVEY
                    </button>
                    <p class="text-sm text-center text-slate-500 font-black uppercase tracking-widest mt-4">Perubahan akan langsung tampil di menu Layanan</p>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
