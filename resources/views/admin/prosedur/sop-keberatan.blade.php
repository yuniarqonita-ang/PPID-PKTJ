@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 uppercase">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-gavel mr-2 text-[#ffc107]"></i> SOP Keberatan Informasi
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Manajemen Prosedur Penyelesaian Keberatan Publik</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/prosedur/sop-keberatan') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2 text-gray-800"></i> Lihat Publik
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-amber-100 border-l-4 border-amber-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down mb-6">
                <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-amber-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-amber-800 font-bold text-xs">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('admin.halaman-custom.store', 'sop_keberatan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- HERO CONFIGURATION -->
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107] mb-8">
                <div class="p-8">
                    <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                        <i class="fas fa-window-maximize mr-3 text-[#ffc107]"></i> Konfigurasi Hero Banner
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Hero</label>
                            <input type="text" name="judul_hero" value="{{ $settings['sop_keberatan_judul_hero'] ?? 'SOP Penanganan Keberatan Informasi' }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline Hero</label>
                            <input type="text" name="tagline_hero" value="{{ $settings['sop_keberatan_tagline_hero'] ?? 'Standar Operasional Prosedur Pengajuan Keberatan atas Layanan Informasi' }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- COLUMN 1: IMAGE SOP -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-8 border-[#004a99] group">
                    <div class="p-8 space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-image mr-3 text-[#ffc107]"></i> Dokumen SOP Utama
                            </h3>
                            <button type="button" onclick="document.getElementById('gambar_sop').click()" class="px-4 py-2 bg-gray-50 text-[9px] font-black text-[#004a99] rounded-lg border border-gray-100 hover:bg-gray-100 transition-all">UPLOAD BARU</button>
                        </div>

                        <div class="relative aspect-[3/4] bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group-hover:border-[#004a99]/20 transition-all shadow-inner">
                            @if(isset($settings['sop_keberatan_gambar_sop']))
                                <img id="preview_sop" src="{{ asset('storage/halaman/' . $settings['sop_keberatan_gambar_sop']) }}" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 transition-all">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <i class="fas fa-file-image text-5xl mb-3 text-gray-800"></i>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-800">Gambar Belum Tersedia</p>
                                </div>
                            @endif
                            <input type="file" name="gambar_sop" id="gambar_sop" class="hidden" onchange="previewImage(this, 'preview_sop')">
                        </div>
                    </div>
                </div>

                <!-- COLUMN 2: IMAGE PROSES -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-8 border-[#ffc107] group">
                    <div class="p-8 space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-project-diagram mr-3 text-[#ffc107]"></i> Infografis Alur Proses
                            </h3>
                            <button type="button" onclick="document.getElementById('gambar_proses').click()" class="px-4 py-2 bg-gray-50 text-[9px] font-black text-[#004a99] rounded-lg border border-gray-100 hover:bg-gray-100 transition-all">UPLOAD BARU</button>
                        </div>

                        <div class="relative aspect-[3/4] bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group-hover:border-[#ffc107]/20 transition-all shadow-inner">
                            @if(isset($settings['sop_keberatan_gambar_proses']))
                                <img id="preview_proses" src="{{ asset('storage/halaman/' . $settings['sop_keberatan_gambar_proses']) }}" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 transition-all">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <i class="fas fa-images text-5xl mb-3 text-gray-800"></i>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-800">Alur Belum Tersedia</p>
                                </div>
                            @endif
                            <input type="file" name="gambar_proses" id="gambar_proses" class="hidden" onchange="previewImage(this, 'preview_proses')">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="bg-white h-24 rounded-3xl shadow-2xl ring-1 ring-gray-200 px-8 flex items-center justify-between sticky bottom-6 z-50 animate-fade-in-up mt-12">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Kepatuhan Prosedur Aktif</p>
                </div>
                <div class="flex gap-4">
                    <button type="button" onclick="history.back()" class="px-8 py-3 bg-gray-100 text-gray-500 font-black text-[10px] rounded-xl hover:bg-gray-200 transition-all tracking-widest uppercase font-bold text-gray-800">BATAL</button>
                    <button type="submit" class="px-10 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest text-gray-800">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> SIMPAN SOP KEBERATAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

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

<style>
    .animate-fade-in-up { animation: fadeInUp 0.5s ease-out; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
