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
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem SOP: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        SOP <span class="text-[#ffc107]">Sengketa Informasi</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Manajemen Prosedur Operasional Standar Pelayanan Publik.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="http://ppid.pktj.ac.id/prosedur/sop-penyelesaian-sengketa-informasi" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <button type="submit" form="sop-form" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-save mr-3"></i> Simpan Prosedur
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-2 border-emerald-200 text-emerald-900 px-8 py-5 rounded-[2rem] flex items-center gap-5 shadow-sm">
        <i class="fas fa-check-circle text-3xl text-emerald-500"></i>
        <p class="font-black uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    <form id="sop-form" action="{{ route('admin.halaman-custom.store', 'sop_sengketa') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        <!-- HERO CONFIGURATION -->
        <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#004a99] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-window-maximize"></i>
                        </span>
                        Konfigurasi Banner
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Judul Banner Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['sop_sengketa_judul_hero'] ?? 'SOP Penyelesaian Sengketa Informasi' }}"
                            class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['sop_sengketa_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 text-lg font-bold text-[#004a99]">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- COLUMN 1: POSTER -->
            <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
                <div class="p-10 space-y-8">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                        <h4 class="text-lg font-black text-[#004a99] uppercase tracking-widest">
                            <i class="fas fa-image mr-3 text-[#ffc107]"></i> POSTER SOP UTAMA
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_sop').click()" class="px-5 py-2 bg-[#004a99] text-white font-black text-sm uppercase tracking-widest rounded-xl hover:bg-black transition-all border-none cursor-pointer">UPLOAD</button>
                    </div>

                    <div class="relative aspect-[3/4] bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex items-center justify-center">
                        @if(isset($settings['sop_sengketa_gambar_sop']))
                            <img id="preview_sop" src="{{ asset('storage/halaman/' . $settings['sop_sengketa_gambar_sop']) }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-center">
                                <i class="fas fa-file-image text-6xl text-slate-200 mb-4"></i>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum Ada Poster</p>
                            </div>
                        @endif
                        <input type="file" name="gambar_sop" id="gambar_sop" class="hidden" onchange="previewImage(this, 'preview_sop')">
                    </div>
                </div>
            </div>

            <!-- COLUMN 2: INFOGRAFIS -->
            <div class="bg-white rounded-2xl shadow-xl border-2 border-slate-100 overflow-hidden">
                <div class="p-10 space-y-8">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                        <h4 class="text-lg font-black text-[#004a99] uppercase tracking-widest">
                            <i class="fas fa-project-diagram mr-3 text-[#ffc107]"></i> INFOGRAFIS ALUR
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_proses').click()" class="px-5 py-2 bg-[#004a99] text-white font-black text-sm uppercase tracking-widest rounded-xl hover:bg-black transition-all border-none cursor-pointer">UPLOAD</button>
                    </div>

                    <div class="relative aspect-[3/4] bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex items-center justify-center">
                        @if(isset($settings['sop_sengketa_gambar_proses']))
                            <img id="preview_proses" src="{{ asset('storage/halaman/' . $settings['sop_sengketa_gambar_proses']) }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-center">
                                <i class="fas fa-images text-6xl text-slate-200 mb-4"></i>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum Ada Infografis</p>
                            </div>
                        @endif
                        <input type="file" name="gambar_proses" id="gambar_proses" class="hidden" onchange="previewImage(this, 'preview_proses')">
                    </div>
                </div>
            </div>

            <!-- FULL WIDTH: RICH TEXT CONTENT -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl border-2 border-slate-100 p-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                    <h4 class="text-xl font-black text-[#004a99] uppercase tracking-widest flex items-center">
                        <i class="fas fa-edit mr-4 text-[#ffc107]"></i> Narasi Prosedur Lengkap
                    </h4>
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-black text-[#004a99] uppercase tracking-widest">Detail Penjelasan Prosedur</label>
                    <textarea name="konten" class="tinymce-editor">{{ $settings['sop_sengketa_konten'] ?? '' }}</textarea>
                    <p class="text-sm font-bold text-slate-500 mt-2 uppercase tracking-widest">Gunakan editor ini untuk merinci langkah-langkah prosedur secara tekstual.</p>
                </div>
            </div>
        </div>

        <!-- ACTION BAR - EXECUTIVE STYLE -->
        <div class="flex justify-end gap-6 pt-10">
            <button type="button" onclick="history.back()" class="px-10 py-5 bg-white border-2 border-slate-200 text-[#004a99] font-black text-sm rounded-2xl hover:bg-slate-50 transition-all tracking-widest border-none cursor-pointer uppercase">BATALKAN</button>
            <button type="submit" class="px-16 py-5 bg-[#004a99] text-white font-black text-sm rounded-2xl shadow-2xl hover:bg-black transition-all tracking-widest border-none cursor-pointer uppercase">
                <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> SIMPAN SELURUH PROSEDUR
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
