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
                    <i class="fas fa-clipboard-check mr-2 text-[#ffc107]"></i> SOP Permintaan Informasi
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Manajemen Prosedur Operasional Standar dan Alur Layanan</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/prosedur/sop-permohonan') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2 text-gray-800"></i> Lihat Publik
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-orange-100 border-l-4 border-orange-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down mb-6">
                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-orange-500/20">
                    <i class="fas fa-check text-white text-gray-800"></i>
                </div>
                <p class="text-orange-800 font-bold text-xs">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('admin.halaman-custom.store', 'sop_permintaan') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="judul_hero" value="{{ $settings['sop_permintaan_judul_hero'] ?? 'SOP Permintaan Informasi Publik' }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline Hero</label>
                            <input type="text" name="tagline_hero" value="{{ $settings['sop_permintaan_tagline_hero'] ?? 'Standar Operasional Prosedur Pengajuan Permintaan Informasi' }}"
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
                                <i class="fas fa-image mr-3 text-[#ffc107]"></i> Poster SOP Utama
                            </h3>
                            <button type="button" onclick="document.getElementById('gambar_sop').click()" class="px-4 py-2 bg-gray-50 text-[9px] font-black text-[#004a99] rounded-lg border border-gray-100 hover:bg-gray-100 transition-all">UPLOAD BARU</button>
                        </div>

                        <div class="relative aspect-[3/4] bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 group-hover:border-[#004a99]/20 transition-all shadow-inner">
                            @if(isset($settings['sop_permintaan_gambar_sop']))
                                <img id="preview_sop" src="{{ asset('storage/halaman/' . $settings['sop_permintaan_gambar_sop']) }}" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 transition-all">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <i class="fas fa-file-image text-5xl mb-3"></i>
                                    <p class="text-[10px] font-black uppercase tracking-widest">Belum Ada Gambar</p>
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
                            @if(isset($settings['sop_permintaan_gambar_proses']))
                                <img id="preview_proses" src="{{ asset('storage/halaman/' . $settings['sop_permintaan_gambar_proses']) }}" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 transition-all">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <i class="fas fa-images text-5xl mb-3"></i>
                                    <p class="text-[10px] font-black uppercase tracking-widest">Belum Ada Infografis</p>
                                </div>
                            @endif
                            <input type="file" name="gambar_proses" id="gambar_proses" class="hidden" onchange="previewImage(this, 'preview_proses')">
                        </div>
                    </div>
                </div>

                <!-- FULL WIDTH: VIDEO TUTORIAL -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#004a99]">
                    <div class="p-8 grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <div class="space-y-6">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center">
                                <i class="fab fa-youtube mr-3 text-red-500"></i> Video Tutorial Layanan
                            </h3>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 text-gray-800">Link URL YouTube</label>
                                    <input type="url" name="youtube_link" value="{{ $settings['sop_permintaan_youtube_link'] ?? '' }}" 
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase placeholder-gray-200 text-gray-800"
                                        placeholder="HTTPS://WWW.YOUTUBE.COM/WATCH?V=..."
                                        oninput="updateYoutubePreview(this)">
                                </div>
                                <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100 space-y-2">
                                    <h4 class="text-[10px] font-black text-[#004a99] uppercase tracking-widest flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i> Petunjuk Integrasi
                                    </h4>
                                    <p class="text-[10px] leading-relaxed text-blue-800 font-medium">
                                        MASUKKAN LINK LENGKAP ATAU SHORTLINK DARI YOUTUBE. SISTEM AKAN SECARA OTOMATIS MENGAMBIL ID VIDEO UNTUK RENDER PREVIEW DI SEBELAH KANAN.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative aspect-video bg-gray-900 rounded-2xl overflow-hidden shadow-2xl ring-4 ring-gray-50">
                            @php
                                $videoId = '';
                                if (!empty($settings['sop_permintaan_youtube_link'])) {
                                    $link = $settings['sop_permintaan_youtube_link'];
                                    if (strpos($link, 'v=') !== false) {
                                        $parts = explode('v=', $link);
                                        $videoId = explode('&', $parts[1])[0];
                                    } elseif (strpos($link, 'youtu.be/') !== false) {
                                        $parts = explode('youtu.be/', $link);
                                        $videoId = explode('?', $parts[1])[0];
                                    }
                                }
                            @endphp
                            <iframe id="youtube_iframe" 
                                    src="{{ $videoId ? 'https://www.youtube.com/embed/' . $videoId : '' }}" 
                                    class="w-full h-full" 
                                    frameborder="0" allowfullscreen></iframe>
                            <div id="youtube_loading" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-900 z-0 {{ $videoId ? 'hidden' : '' }}">
                                <i class="fab fa-youtube text-5xl text-gray-800 mb-2"></i>
                                <p class="text-[8px] font-black text-gray-700 tracking-[0.3em]">WAITING FOR LINK...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="bg-white h-24 rounded-3xl shadow-2xl ring-1 ring-gray-200 px-8 flex items-center justify-between sticky bottom-6 z-50 animate-fade-in-up mt-12">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-check-shield"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Integritas Dokumen Terjamin</p>
                </div>
                <div class="flex gap-4">
                    <button type="button" onclick="history.back()" class="px-8 py-3 bg-gray-100 text-gray-500 font-black text-[10px] rounded-xl hover:bg-gray-200 transition-all tracking-widest">BATAL</button>
                    <button type="submit" class="px-10 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> SIMPAN PERUBAHAN SOP
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
                document.getElementById(previewId).classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateYoutubePreview(input) {
        var url = input.value;
        var videoId = '';
        if (url.includes('v=')) {
            videoId = url.split('v=')[1];
            var ampersandPosition = videoId.indexOf('&');
            if(ampersandPosition != -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
        } else if (url.includes('youtu.be/')) {
            videoId = url.split('youtu.be/')[1];
        }

        if (videoId) {
            document.getElementById('youtube_iframe').src = 'https://www.youtube.com/embed/' + videoId;
            document.getElementById('youtube_loading').classList.add('hidden');
        } else {
            document.getElementById('youtube_loading').classList.remove('hidden');
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
