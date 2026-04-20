@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION - ULTRA CLARITY -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                SOP <span class="text-[#004a99]">Permintaan Informasi</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Manajemen Prosedur Operasional Standar Pelayanan Publik</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest">
                <i class="fas fa-arrow-left mr-3"></i> DASHBOARD
            </a>
            <a href="http://ppid.pktj.ac.id/prosedur/sop-permintaan-informasi" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> LIHAT PUBLIK
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-2 border-emerald-200 text-emerald-900 px-8 py-5 rounded-[2rem] flex items-center gap-5 shadow-sm">
        <i class="fas fa-check-circle text-3xl text-emerald-500"></i>
        <p class="font-black uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    <form action="{{ route('admin.halaman-custom.store', 'sop_permintaan') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        <!-- HERO CONFIGURATION -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-window-maximize"></i>
                        </span>
                        Konfigurasi Banner Banner
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Banner Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['sop_permintaan_judul_hero'] ?? 'SOP Permintaan Informasi Publik' }}"
                            class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['sop_permintaan_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            
            <!-- COLUMN 1: POSTER -->
            <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
                <div class="p-10 space-y-8">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                        <h4 class="text-lg font-black text-[#002b5c] uppercase tracking-widest">
                            <i class="fas fa-image mr-3 text-[#ffc107]"></i> POSTER SOP UTAMA
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_sop').click()" class="px-5 py-2 bg-[#002b5c] text-white font-black text-sm uppercase tracking-widest rounded-xl hover:bg-black transition-all border-none cursor-pointer">UPLOAD</button>
                    </div>

                    <div class="relative aspect-[3/4] bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex items-center justify-center">
                        @if(isset($settings['sop_permintaan_gambar_sop']))
                            <img id="preview_sop" src="{{ asset('storage/halaman/' . $settings['sop_permintaan_gambar_sop']) }}" class="w-full h-full object-contain">
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
            <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
                <div class="p-10 space-y-8">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                        <h4 class="text-lg font-black text-[#002b5c] uppercase tracking-widest">
                            <i class="fas fa-project-diagram mr-3 text-[#ffc107]"></i> INFOGRAFIS ALUR
                        </h4>
                        <button type="button" onclick="document.getElementById('gambar_proses').click()" class="px-5 py-2 bg-[#002b5c] text-white font-black text-sm uppercase tracking-widest rounded-xl hover:bg-black transition-all border-none cursor-pointer">UPLOAD</button>
                    </div>

                    <div class="relative aspect-[3/4] bg-slate-50 rounded-[2rem] overflow-hidden border-2 border-dashed border-slate-200 flex items-center justify-center">
                        @if(isset($settings['sop_permintaan_gambar_proses']))
                            <img id="preview_proses" src="{{ asset('storage/halaman/' . $settings['sop_permintaan_gambar_proses']) }}" class="w-full h-full object-contain">
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

            <!-- FULL WIDTH: YOUTUBE -->
            <div class="lg:col-span-2 bg-[#002b5c] rounded-[3rem] shadow-2xl p-10 text-white relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-8">
                        <h3 class="text-2xl font-black uppercase tracking-widest flex items-center">
                            <i class="fab fa-youtube mr-4 text-[#ffc107]"></i> Video Tutorial Layanan
                        </h3>
                        <div class="space-y-6">
                            <div class="space-y-3">
                                <label class="text-sm font-black text-blue-200 uppercase tracking-[2px]">ALAMAT URL YOUTUBE</label>
                                <input type="url" name="youtube_link" value="{{ $settings['sop_permintaan_youtube_link'] ?? '' }}" 
                                    class="w-full px-8 py-5 bg-white/10 border-2 border-white/20 rounded-2xl focus:bg-white focus:text-[#002b5c] transition-all font-bold text-lg text-white"
                                    placeholder="https://www.youtube.com/watch?v=..."
                                    oninput="updateYoutubePreview(this)">
                            </div>
                            <div class="p-8 bg-white/5 border border-white/10 rounded-3xl">
                                <p class="text-md leading-relaxed text-blue-100 font-bold">
                                    <i class="fas fa-info-circle mr-3 text-[#ffc107]"></i> Pastikan link berformat publik agar video dapat diputar oleh masyarakat di seluruh Indonesia.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative aspect-video bg-black rounded-[2.5rem] overflow-hidden shadow-inner border-4 border-white/10">
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
                        <div id="youtube_loading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900 z-0 {{ $videoId ? 'hidden' : '' }}">
                            <i class="fab fa-youtube text-6xl text-[#ffc107] mb-4"></i>
                            <p class="text-sm font-black text-white tracking-widest uppercase">MENUNGGU LINK VIDEO...</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- ACTION BAR - EXECUTIVE STYLE -->
        <div class="flex justify-end gap-6 pt-10">
            <button type="button" onclick="history.back()" class="px-10 py-5 bg-white border-2 border-slate-200 text-[#002b5c] font-black text-sm rounded-2xl hover:bg-slate-50 transition-all tracking-widest border-none cursor-pointer uppercase">BATALKAN</button>
            <button type="submit" class="px-16 py-5 bg-[#002b5c] text-white font-black text-sm rounded-2xl shadow-2xl hover:bg-black transition-all tracking-widest border-none cursor-pointer uppercase">
                <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> SIMPAN SELURUH PROSEDUR
            </button>
        </div>
    </form>
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
@endsection
