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
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold font-bold">
                    <i class="fas fa-arrow-left mr-2"></i> Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-key mr-2 text-[#ffc107]"></i> Laporan Akses Informasi
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Pusat Kendali Laporan Aksesibilitas Publik PKTJ</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/laporan/akses') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2 text-gray-800"></i> Lihat Publik
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-indigo-100 border-l-4 border-indigo-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down mb-6">
                <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-indigo-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-indigo-800 font-bold text-xs">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('admin.halaman-custom.store', 'laporan_akses') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- MAIN CONTENT (Left) -->
                <div class="lg:col-span-3 space-y-8">
                    
                    <!-- HERO CONFIG -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
                        <div class="p-8 space-y-6">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                                <i class="fas fa-rocket mr-3 text-[#ffc107]"></i> Visual Landing Page
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 font-bold">Judul Hero Laporan</label>
                                    <input type="text" name="judul_hero" value="{{ $settings['laporan_akses_judul_hero'] ?? '' }}" required
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase placeholder-gray-200">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 text-gray-800">Tagline Deskripsi Laporan</label>
                                    <input type="text" name="tagline_hero" value="{{ $settings['laporan_akses_tagline_hero'] ?? '' }}" required
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase placeholder-gray-200 text-gray-800">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- REPORT CONTENT -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-8 border-[#004a99]">
                        <div class="p-8 space-y-8">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 text-gray-800">Tahun Laporan</label>
                                    <div class="relative">
                                        <select name="tahun_laporan" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-black text-[#004a99] focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 outline-none appearance-none cursor-pointer">
                                            @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                                <option value="{{ $year }}" {{ ($settings['laporan_akses_tahun_laporan'] ?? '') == $year ? 'selected' : '' }}>TAHUN {{ $year }}</option>
                                            @endfor
                                        </select>
                                        <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 text-gray-800">Tipe Publikasi</label>
                                    <div class="relative">
                                        <select name="jenis_laporan" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-black text-[#004a99] focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 outline-none appearance-none cursor-pointer">
                                            @php $jenis = $settings['laporan_akses_jenis_laporan'] ?? ''; @endphp
                                            <option value="tahunan" {{ $jenis == 'tahunan' ? 'selected' : '' }}>LAPORAN TAHUNAN</option>
                                            <option value="semesteran" {{ $jenis == 'semesteran' ? 'selected' : '' }}>LAPORAN SEMESTERAN</option>
                                        </select>
                                        <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- EDITORS -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest ml-1 flex items-center">
                                    <i class="fas fa-paragraph mr-2 text-[#ffc107]"></i> Ringkasan Eksekutif Akses
                                </label>
                                <div class="rounded-3xl overflow-hidden border border-gray-100">
                                    <textarea id="editor_ringkasan" name="ringkasan_eksekutif" class="tinymce-editor">{!! $settings['laporan_akses_ringkasan_eksekutif'] ?? '' !!}</textarea>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-[#004a99] uppercase tracking-widest ml-1 flex items-center text-gray-800">
                                    <i class="fas fa-align-left mr-2 text-[#ffc107]"></i> Analisis Akses Informasi Lengkap
                                </label>
                                <div class="rounded-3xl overflow-hidden border border-gray-100">
                                    <textarea id="editor_laporan" name="isi_laporan" class="tinymce-editor text-gray-800">{!! $settings['laporan_akses_isi_laporan'] ?? '' !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR / ASSETS (Right) -->
                <div class="space-y-6">
                    
                    <!-- UPLOAD CARD -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 p-8 space-y-6">
                        <h3 class="text-xs font-black text-[#004a99] uppercase tracking-widest border-b pb-4 flex items-center text-gray-800">
                            <i class="fas fa-paperclip mr-2 text-indigo-500"></i> Lampiran Laporan
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="relative group cursor-pointer border-2 border-dashed border-gray-100 rounded-2xl p-6 hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" onclick="document.getElementById('file_laporan').click()">
                                <i class="fas fa-file-export text-3xl text-gray-200 mb-2 group-hover:text-[#004a99] transition-colors"></i>
                                <p class="text-[9px] font-black text-gray-300 group-hover:text-[#004a99] uppercase tracking-widest">UPLOAD DOKUMEN BARU</p>
                                <input type="file" name="file_laporan" id="file_laporan" class="hidden">
                            </div>
                            
                            @if(isset($settings['laporan_akses_file_laporan']))
                            <div class="p-4 bg-indigo-600 rounded-2xl text-white flex items-center gap-4 shadow-lg shadow-indigo-500/20">
                                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[8px] font-black opacity-60 uppercase">DOKUMEN TERPUBLIKASI</p>
                                    <p class="text-[9px] font-bold truncate">INFO_AKSES_PORTAL.PDF</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- INSIGHTS -->
                    <div class="bg-gradient-to-br from-[#004a99] to-indigo-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-3xl text-gray-800"></div>
                        <h4 class="text-xs font-black uppercase tracking-widest mb-4 flex items-center font-bold">
                            <i class="fas fa-info-circle mr-2 text-[#ffc107]"></i> Info Strategis
                        </h4>
                        <p class="text-[10px] leading-relaxed opacity-80 font-medium text-gray-800">
                            Laporan akses mencerminkan tingkat keterbukaan informasi. Pastikan narasi yang dibuat mempermudah pemahaman grafik statistik akses.
                        </p>
                    </div>

                    <!-- STATUS -->
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-ping"></div>
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">MODE ADMINISTRASI AKTIF</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="bg-white/90 backdrop-blur-xl h-24 rounded-3xl shadow-2xl ring-1 ring-gray-200 px-8 flex items-center justify-between sticky bottom-6 z-50 animate-fade-in-up">
                <div class="hidden md:flex items-center gap-4">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Data Siap Disinkronkan</p>
                </div>
                <div class="flex gap-4 w-full md:w-auto">
                    <button type="button" onclick="history.back()" class="flex-1 md:flex-none px-8 py-3 bg-gray-100 text-gray-500 font-black text-[10px] rounded-xl hover:bg-gray-200 transition-all tracking-widest">BATAL</button>
                    <button type="submit" class="flex-[2] md:flex-none px-12 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> SIMPAN LAPORAN
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 350,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });
</script>

<style>
    .animate-fade-in-up { animation: fadeInUp 0.5s ease-out; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
