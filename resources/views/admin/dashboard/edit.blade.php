@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 animate-fade-in">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Pusat Pengaturan: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Global <span class="text-[#ffc107]">Settings</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola informasi global, media sosial, dan kontak resmi PPID secara terpusat.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-arrow-left mr-3"></i> Dashboard
                </a>
                <a href="http://ppid.pktj.ac.id" target="_blank" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-eye mr-3"></i> Lihat Website
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4 text-gray-800">
        <i class="fas fa-check-circle text-xl text-gray-800"></i>
        <p class="font-bold text-gray-800">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-100 text-red-700 px-6 py-4 rounded-2xl flex items-center gap-4 text-gray-800">
        <i class="fas fa-exclamation-circle text-xl text-red-600"></i>
        <p class="font-bold text-red-700">{{ session('error') }}</p>
    </div>
    @endif

    <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-8">
            
            <!-- SECTION: HERO & VISUAL -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#004a99] rounded-xl flex items-center justify-center text-white text-sm">
                        <i class="fas fa-image"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Tampilan & Hero Utama</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-50">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Utama Beranda</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', \App\Models\Dashboard::getValue('hero_title', 'Selamat Datang')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Sub-Judul Beranda</label>
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', \App\Models\Dashboard::getValue('hero_subtitle', '')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                </div>

                <div class="p-8 border-b border-slate-50 bg-white">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest flex items-center">
                            <i class="fas fa-edit mr-2"></i> Konten Kustom Hero (Teks Editor / Video Embed)
                        </label>
                        <textarea name="hero_content" class="tinymce-editor">{{ old('hero_content', \App\Models\Dashboard::getValue('hero_content', '')) }}</textarea>
                        <p class="text-[10px] text-slate-400 italic">Gunakan teks editor ini untuk menambahkan teks tambahan, gambar, atau menyematkan (embed) iframe video YouTube di banner depan.</p>
                    </div>
                </div>

                <!-- REAL-TIME HERO VIDEO UPLOADER (>100MB SUPPORTED) -->
                <div class="p-8 border-b border-slate-100 bg-gradient-to-r from-blue-50/50 to-indigo-50/30">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-[#004a99] text-white flex items-center justify-center text-xs">
                                <i class="fas fa-video"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-wider">Video Background Hero (Real-Time Uploader)</h4>
                                <p class="text-[11px] text-slate-500 font-medium">Mendukung file MP4/WebM hingga 256MB dengan progress bar real-time tanpa reload halaman.</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-[10px] font-black rounded-full uppercase">Maks 256 MB</span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                        <!-- Uploader Box -->
                        <div class="space-y-3">
                            <div class="border-2 border-dashed border-blue-200 hover:border-[#004a99] transition-all rounded-2xl p-6 bg-white text-center cursor-pointer relative" id="dropAreaHeroVideo" onclick="document.getElementById('ajaxHeroVideoInput').click()">
                                <input type="file" id="ajaxHeroVideoInput" accept="video/mp4,video/webm,video/ogg" class="hidden" onchange="handleRealtimeVideoUpload(this.files[0])">
                                <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-2xl flex items-center justify-center mx-auto mb-3 text-lg shadow-sm">
                                    <i class="fas fa-cloud-arrow-up"></i>
                                </div>
                                <h5 class="text-xs font-black text-slate-700 uppercase mb-1">Klik atau Tarik File Video ke Sini</h5>
                                <p class="text-[11px] text-slate-400">Format MP4 disarankan untuk kompatibilitas seluruh browser</p>
                            </div>

                            <!-- Progress Bar (Hidden by Default) -->
                            <div id="videoUploadProgressWrapper" class="hidden bg-white p-4 rounded-xl border border-blue-100 shadow-sm space-y-2">
                                <div class="flex items-center justify-between text-xs font-black">
                                    <span class="text-[#004a99] flex items-center gap-1.5" id="uploadStatusText">
                                        <i class="fas fa-spinner fa-spin"></i> Mengunggah video...
                                    </span>
                                    <span class="text-slate-600" id="uploadPercentText">0%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                    <div id="videoProgressBar" class="bg-gradient-to-r from-[#004a99] to-[#ffc107] h-3 rounded-full transition-all duration-150" style="width: 0%;"></div>
                                </div>
                                <div class="flex items-center justify-between text-[10px] text-slate-400 font-semibold">
                                    <span id="uploadBytesText">0 MB / 0 MB</span>
                                    <span id="uploadSpeedText"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Active Video Preview -->
                        <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fas fa-circle text-emerald-500 text-[8px] animate-pulse"></i> Status Video Aktif
                                </span>
                                @if($activeHero = \App\Models\Dashboard::getValue('hero_video_file'))
                                    <button type="button" onclick="deleteActiveHeroVideo()" class="text-[10px] font-black text-red-600 hover:text-red-700 uppercase tracking-wider flex items-center gap-1 hover:underline cursor-pointer">
                                        <i class="fas fa-trash-alt"></i> Hapus Video
                                    </button>
                                @endif
                            </div>

                            <div id="activeVideoPreviewContainer">
                                @if($activeHero = \App\Models\Dashboard::getValue('hero_video_file'))
                                    <div class="relative rounded-xl overflow-hidden bg-slate-900 aspect-video shadow-inner">
                                        <video controls class="w-full h-full object-cover" id="activeHeroVideoEl">
                                            <source src="{{ asset('storage/' . $activeHero) }}" type="video/mp4">
                                        </video>
                                    </div>
                                    <p class="text-[10px] font-semibold text-slate-500 mt-2 truncate">
                                        <i class="fas fa-file-video mr-1 text-[#004a99]"></i> {{ basename($activeHero) }}
                                    </p>
                                @else
                                    <div class="rounded-xl border border-dashed border-slate-200 aspect-video flex flex-col items-center justify-center text-slate-300 p-4 text-center bg-slate-50">
                                        <i class="fas fa-film text-2xl mb-1"></i>
                                        <span class="text-[11px] font-bold text-slate-400">Belum ada video background</span>
                                        <span class="text-[10px] text-slate-400">Unggah file video di samping untuk mengaktifkan</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Opsional Link YouTube Hero -->
                    <div class="mt-4 pt-4 border-t border-blue-100/60 grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-[#004a99] uppercase tracking-wider flex items-center">
                                <i class="fab fa-youtube mr-1.5 text-red-600"></i> Fallback Link Video YouTube (Opsional)
                            </label>
                            <input type="url" name="hero_video_link" value="{{ old('hero_video_link', \App\Models\Dashboard::getValue('hero_video_link', '')) }}"
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] text-xs font-semibold text-slate-700">
                        </div>
                        <p class="text-[10px] text-slate-400 italic">Digunakan sebagai alternatif pemutaran otomatis jika tidak ada file video MP4 lokal yang diunggah.</p>
                    </div>
                </div>

            </div>

            <!-- SECTION: MEDIA SOSIAL -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white text-sm">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Media Sosial (Link Footer)</h3>
                </div>
                <div class="p-8 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="fab fa-facebook mr-1"></i> Facebook Link</label>
                        <input type="url" name="facebook_link" value="{{ old('facebook_link', \App\Models\Dashboard::getValue('facebook_link', '#')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="fab fa-instagram mr-1"></i> Instagram Link</label>
                        <input type="url" name="instagram_link" value="{{ old('instagram_link', \App\Models\Dashboard::getValue('instagram_link', '#')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-pink-600 focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="fab fa-twitter mr-1"></i> Twitter Link</label>
                        <input type="url" name="twitter_link" value="{{ old('twitter_link', \App\Models\Dashboard::getValue('twitter_link', '#')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="fab fa-youtube mr-1"></i> YouTube Link</label>
                        <input type="url" name="youtube_link" value="{{ old('youtube_link', \App\Models\Dashboard::getValue('youtube_link', '#')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-600 focus:bg-white transition-all font-semibold text-slate-700">
                    </div>
                </div>
            </div>


            <!-- SECTION: PENGATURAN INFORMASI DIKECUALIKAN -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#ffc107] rounded-xl flex items-center justify-center text-[#004a99] text-sm">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Opsi Informasi Dikecualikan</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Daftar Penanggung Jawab (Dropdown)</label>
                        <textarea name="list_penanggung_jawab" rows="8"
                                  placeholder="Masukkan satu nama per baris..."
                                  class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700 leading-relaxed">{{ old('list_penanggung_jawab', \App\Models\Dashboard::getValue('list_penanggung_jawab', "PPID UTAMA\nInspektorat Jenderal Kementerian Perhubungan\nDirektorat Jenderal Perhubungan Darat\nDirektorat Jenderal Perhubungan Laut\nDirektorat Jenderal Perhubungan Udara\nDirektorat Jenderal Perkeretaapian\nBadan Kebijakan Transportasi\nBadan Pengembangan Sumber Daya Manusia Perhubungan\nBadan Pengelola Transportasi Jabodetabek")) }}</textarea>
                        <p class="text-[10px] text-slate-400 italic"><i class="fas fa-info-circle mr-1"></i> Pisahkan setiap nama penanggung jawab dengan baris baru (Enter). List ini akan muncul di dropdown halaman admin dan filter publik.</p>
                    </div>
                </div>
            </div>

            <!-- SECTION: KONTAK -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center text-white text-sm">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Informasi Kontak Resmi</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Alamat Kantor</label>
                        <input type="text" name="kontak_alamat" value="{{ old('kontak_alamat', \App\Models\Dashboard::getValue('kontak_alamat', '')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nomor Telepon</label>
                            <input type="text" name="kontak_telepon" value="{{ old('kontak_telepon', \App\Models\Dashboard::getValue('kontak_telepon', '')) }}"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Email PPID</label>
                            <input type="email" name="kontak_email" value="{{ old('kontak_email', \App\Models\Dashboard::getValue('kontak_email', '')) }}"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: PETA & KONTAK KAMPUS DINAMIS (KAMPUS PERINTIS & KAMPUS MARGADANA) -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white text-sm">
                            <i class="fas fa-map-location-dot"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Lokasi & Peta Kampus Dinamis</h3>
                            <p class="text-[11px] text-slate-500 font-medium">Ubah nama kampus, alamat, dan link Google Maps Iframe tanpa hardcode.</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-full uppercase border border-emerald-100">Dinamis Database</span>
                </div>
                <div class="p-8 space-y-8">
                    <!-- KAMPUS 1 -->
                    <div class="p-6 bg-slate-50/70 rounded-2xl border border-slate-200/60 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-black text-[#004a99] uppercase tracking-wider">
                            <span class="w-6 h-6 rounded-full bg-[#004a99] text-white flex items-center justify-center text-[10px]">1</span>
                            Kampus 1 (Utama)
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Kampus 1</label>
                                <input type="text" name="kontak_kampus_1_nama" value="{{ old('kontak_kampus_1_nama', \App\Models\Dashboard::getValue('kontak_kampus_1_nama', 'Kampus Perintis')) }}"
                                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">Alamat Lengkap</label>
                                <input type="text" name="kontak_kampus_1_alamat" value="{{ old('kontak_kampus_1_alamat', \App\Models\Dashboard::getValue('kontak_kampus_1_alamat', 'Jl. Perintis Kemerdekaan No. 17, Kota Tegal')) }}"
                                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">URL Google Maps Embed (Iframe)</label>
                            <input type="text" name="kontak_kampus_1_maps" value="{{ old('kontak_kampus_1_maps', \App\Models\Dashboard::getValue('kontak_kampus_1_maps', 'https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20I%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed')) }}"
                                   placeholder="https://maps.google.com/maps?..."
                                   class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700 text-xs">
                        </div>
                    </div>

                    <!-- KAMPUS 2 -->
                    <div class="p-6 bg-slate-50/70 rounded-2xl border border-slate-200/60 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-black text-[#004a99] uppercase tracking-wider">
                            <span class="w-6 h-6 rounded-full bg-[#ffc107] text-[#002b5c] flex items-center justify-center text-[10px]">2</span>
                            Kampus 2
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Kampus 2</label>
                                <input type="text" name="kontak_kampus_2_nama" value="{{ old('kontak_kampus_2_nama', \App\Models\Dashboard::getValue('kontak_kampus_2_nama', 'Kampus Margadana')) }}"
                                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">Alamat Lengkap</label>
                                <input type="text" name="kontak_kampus_2_alamat" value="{{ old('kontak_kampus_2_alamat', \App\Models\Dashboard::getValue('kontak_kampus_2_alamat', 'Jl. Abdul Syukur No. 17, Margadana, Kota Tegal')) }}"
                                       class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">URL Google Maps Embed (Iframe)</label>
                            <input type="text" name="kontak_kampus_2_maps" value="{{ old('kontak_kampus_2_maps', \App\Models\Dashboard::getValue('kontak_kampus_2_maps', 'https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20II%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed')) }}"
                                   placeholder="https://maps.google.com/maps?..."
                                   class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700 text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: SP4N-LAPOR! PENGATURAN -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center text-white text-sm">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Banner & Layanan SP4N-LAPOR!</h3>
                            <p class="text-[11px] text-slate-500 font-medium">Pengaturan integrasi portal pengaduan nasional di halaman depan publik.</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-red-50 text-red-700 text-[10px] font-black rounded-full uppercase border border-red-100">Kemenhub / PANRB</span>
                </div>
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Utama Banner</label>
                        <input type="text" name="span_lapor_judul" value="{{ old('span_lapor_judul', \App\Models\Dashboard::getValue('span_lapor_judul', 'UNTUK PELAYANAN PUBLIK YANG LEBIH BAIK, BERANI LAPOR MELALUI SP4N-LAPOR!')) }}"
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Deskripsi Penjelasan</label>
                        <textarea name="span_lapor_deskripsi" rows="2" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">{{ old('span_lapor_deskripsi', \App\Models\Dashboard::getValue('span_lapor_deskripsi', 'Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional - Layanan Aspirasi dan Pengaduan Online Rakyat. Sampaikan aspirasi, saran, dan laporan pelayanan secara transparan, aman, dan terpercaya.')) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Link URL SP4N-LAPOR! PKTJ</label>
                            <input type="url" name="span_lapor_link" value="{{ old('span_lapor_link', \App\Models\Dashboard::getValue('span_lapor_link', 'https://www.lapor.go.id/instansi/politeknik-keselamatan-transportasi-jalan-tegal')) }}"
                                   placeholder="https://www.lapor.go.id/instansi/..."
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Gambar Banner SP4N-LAPOR (Opsional)</label>
                            <input type="file" name="span_lapor_banner" accept="image/*" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-500">
                            @if($bannerLapor = \App\Models\Dashboard::getValue('span_lapor_banner'))
                                <span class="text-[10px] text-emerald-600 font-bold block mt-1">Banner terpasang: {{ basename($bannerLapor) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: PEJABAT STRUKTUR ORGANISASI PPID (SESUAI 2 BAGAN) -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-600 rounded-xl flex items-center justify-center text-white text-sm">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Pejabat Struktur Organisasi PPID</h3>
                            <p class="text-[11px] text-slate-500 font-medium">Ubah nama pejabat atau jabatan di Bagan 1 (Kemenhub) dan Bagan 2 (PKTJ Tegal) secara dinamis.</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-black rounded-full uppercase border border-amber-100">Bagan 1 & 2</span>
                </div>
                <div class="p-8 space-y-6">
                    <h5 class="text-xs font-black text-[#004a99] uppercase tracking-wider border-b pb-2">Bagan 1: Hubungan Layanan PPID Kemenhub</h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Atasan PPID</label>
                            <input type="text" name="struktur_atasan_nama" value="{{ old('struktur_atasan_nama', \App\Models\Dashboard::getValue('struktur_atasan_nama', 'MENTERI PERHUBUNGAN')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">PPID Utama</label>
                            <input type="text" name="struktur_utama_nama" value="{{ old('struktur_utama_nama', \App\Models\Dashboard::getValue('struktur_utama_nama', 'SEKRETARIS JENDERAL')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">PPID Pelaksana UPT</label>
                            <input type="text" name="struktur_upt_direktur" value="{{ old('struktur_upt_direktur', \App\Models\Dashboard::getValue('struktur_upt_direktur', 'DIREKTUR PKTJ TEGAL')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">PPID Pelaksana (Itjen)</label>
                            <input type="text" name="struktur_pelaksana_itjen" value="{{ old('struktur_pelaksana_itjen', \App\Models\Dashboard::getValue('struktur_pelaksana_itjen', 'INSPEKTUR JENDERAL')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">PPID Pelaksana (Ditjen)</label>
                            <input type="text" name="struktur_pelaksana_ditjen" value="{{ old('struktur_pelaksana_ditjen', \App\Models\Dashboard::getValue('struktur_pelaksana_ditjen', 'DIREKTUR JENDERAL')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">PPID Pelaksana (Badan)</label>
                            <input type="text" name="struktur_pelaksana_kaban" value="{{ old('struktur_pelaksana_kaban', \App\Models\Dashboard::getValue('struktur_pelaksana_kaban', 'KEPALA BADAN')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                    </div>

                    <h5 class="text-xs font-black text-[#004a99] uppercase tracking-wider border-b pb-2 pt-4">Bagan 2: Struktur Organisasi PPID PKTJ Tegal</h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Manajer Informasi & Dokumentasi</label>
                            <input type="text" name="struktur_manajer_nama" value="{{ old('struktur_manajer_nama', \App\Models\Dashboard::getValue('struktur_manajer_nama', 'PEJABAT STRUKTURAL')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Pengelola Dokumentasi</label>
                            <input type="text" name="struktur_pengelola_nama" value="{{ old('struktur_pengelola_nama', \App\Models\Dashboard::getValue('struktur_pengelola_nama', 'PEJABAT STRUKTURAL/STAFF')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-500 uppercase">Petugas Informasi</label>
                            <input type="text" name="struktur_petugas_nama" value="{{ old('struktur_petugas_nama', \App\Models\Dashboard::getValue('struktur_petugas_nama', 'STAFF')) }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: THEME EDITOR -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center text-white text-sm">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Pengatur Desain & Tema (Kustomisasi Warna & Font)</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Warna Utama (Primary Color)</label>
                            <div class="flex gap-2">
                                <input type="color" name="primary_color" value="{{ old('primary_color', \App\Models\Dashboard::getValue('primary_color', '#004a99')) }}"
                                       class="h-11 w-14 p-1 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer">
                                <input type="text" id="primary_color_text" value="{{ \App\Models\Dashboard::getValue('primary_color', '#004a99') }}"
                                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-sm" readonly>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Warna Sekunder (Secondary Color)</label>
                            <div class="flex gap-2">
                                <input type="color" name="secondary_color" value="{{ old('secondary_color', \App\Models\Dashboard::getValue('secondary_color', '#ffc107')) }}"
                                       class="h-11 w-14 p-1 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer">
                                <input type="text" id="secondary_color_text" value="{{ \App\Models\Dashboard::getValue('secondary_color', '#ffc107') }}"
                                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-sm" readonly>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Warna Latar Halaman (Background Color)</label>
                            <div class="flex gap-2">
                                <input type="color" name="bg_color" value="{{ old('bg_color', \App\Models\Dashboard::getValue('bg_color', '#f0f4f8')) }}"
                                       class="h-11 w-14 p-1 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer">
                                <input type="text" id="bg_color_text" value="{{ \App\Models\Dashboard::getValue('bg_color', '#f0f4f8') }}"
                                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 text-sm" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Font Family (Gaya Tulisan)</label>
                            <select name="font_family" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                                @php
                                    $currentFont = \App\Models\Dashboard::getValue('font_family', "'Inter', sans-serif");
                                    $fonts = [
                                        "'Inter', sans-serif" => "Inter (Modern/Sleek)",
                                        "'Outfit', sans-serif" => "Outfit (Elegant/Premium)",
                                        "'Poppins', sans-serif" => "Poppins (Clean/Minimal)",
                                        "'Roboto', sans-serif" => "Roboto (Formal/Neutral)",
                                        "'Montserrat', sans-serif" => "Montserrat (Geometric/Bold)",
                                        "'Lora', serif" => "Lora (Serif/Classic)",
                                    ];
                                @endphp
                                @foreach($fonts as $val => $lbl)
                                    <option value="{{ $val }}" {{ $currentFont == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Ukuran Font Dasar (Base Font Size)</label>
                            <input type="text" name="font_size" value="{{ old('font_size', \App\Models\Dashboard::getValue('font_size', '16px')) }}"
                                   placeholder="Contoh: 16px, 14px, 15px"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Ukuran Judul (Heading Size)</label>
                            <input type="text" name="heading_size" value="{{ old('heading_size', \App\Models\Dashboard::getValue('heading_size', '2.5rem')) }}"
                                   placeholder="Contoh: 2.5rem, 2rem, 30px"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: AUTHENTICATION & LOGIN BRANDING -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#004a99] rounded-xl flex items-center justify-center text-white text-sm">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h3 class="font-black text-[#002b5c] uppercase tracking-wider text-sm">Pengaturan Halaman Login &amp; Registrasi (BPSDM / PKTJ Layout)</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Instansi Banner Login</label>
                            <input type="text" name="auth_login_agency" value="{{ old('auth_login_agency', \App\Models\Dashboard::getValue('auth_login_agency', 'Politeknik Keselamatan Transportasi Jalan')) }}"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Sub-Instansi / Kementerian</label>
                            <input type="text" name="auth_login_subagency" value="{{ old('auth_login_subagency', \App\Models\Dashboard::getValue('auth_login_subagency', 'Kementerian Perhubungan Republik Indonesia')) }}"
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">URL Login SSO Kemenhub (Opsional)</label>
                            <input type="url" name="auth_sso_kemenhub_url" value="{{ old('auth_sso_kemenhub_url', \App\Models\Dashboard::getValue('auth_sso_kemenhub_url', '')) }}"
                                   placeholder="https://sso.dephub.go.id/..."
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">URL Login Google OAuth (Opsional)</label>
                            <input type="url" name="auth_google_login_url" value="{{ old('auth_google_login_url', \App\Models\Dashboard::getValue('auth_google_login_url', '')) }}"
                                   placeholder="https://accounts.google.com/..."
                                   class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] font-semibold text-slate-700">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SAVE BAR -->
            <div class="flex items-center justify-end gap-4 pb-10">
                <button type="submit" class="px-10 py-4 bg-[#ffc107] text-[#002b5c] rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('input[type="color"]').forEach(picker => {
        picker.addEventListener('input', function() {
            const textInput = document.getElementById(this.name + '_text');
            if (textInput) textInput.value = this.value;
        });
    });

    // Real-Time Video Upload Handler (>100MB supported with live progress bar)
    function handleRealtimeVideoUpload(file) {
        if (!file) return;

        // Verify format
        const validTypes = ['video/mp4', 'video/webm', 'video/ogg'];
        if (!validTypes.includes(file.type) && !file.name.match(/\.(mp4|webm|ogg|mov)$/i)) {
            alert('Harap pilih file video berformat .mp4, .webm, atau .ogg.');
            return;
        }

        // Limit check 256MB
        if (file.size > 268435456) {
            alert('Ukuran file terlalu besar! Maksimal 256 MB.');
            return;
        }

        const progressWrapper = document.getElementById('videoUploadProgressWrapper');
        const progressBar = document.getElementById('videoProgressBar');
        const percentText = document.getElementById('uploadPercentText');
        const statusText = document.getElementById('uploadStatusText');
        const bytesText = document.getElementById('uploadBytesText');
        const speedText = document.getElementById('uploadSpeedText');

        progressWrapper.classList.remove('hidden');
        progressBar.style.width = '0%';
        progressBar.className = 'bg-gradient-to-r from-[#004a99] to-[#ffc107] h-3 rounded-full transition-all duration-150';
        percentText.textContent = '0%';
        statusText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengunggah video...';

        const totalMB = (file.size / (1024 * 1024)).toFixed(1);
        let startTime = Date.now();

        const formData = new FormData();
        formData.append('video_file', file);
        formData.append('_token', '{{ csrf_token() }}');

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("admin.dashboard.upload-hero-video") }}', true);

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                percentText.textContent = percent + '%';
                
                const loadedMB = (e.loaded / (1024 * 1024)).toFixed(1);
                bytesText.textContent = `${loadedMB} MB / ${totalMB} MB`;

                // Calculate speed
                const elapsedSec = (Date.now() - startTime) / 1000;
                if (elapsedSec > 0.5) {
                    const speedKBps = (e.loaded / 1024 / elapsedSec).toFixed(0);
                    speedText.textContent = `${speedKBps} KB/s`;
                }
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const resp = JSON.parse(xhr.responseText);
                    if (resp.success) {
                        progressBar.style.width = '100%';
                        percentText.textContent = '100%';
                        statusText.innerHTML = '<i class="fas fa-check-circle text-emerald-600"></i> Video Berhasil Diunggah!';
                        progressBar.className = 'bg-emerald-500 h-3 rounded-full';

                        // Update active preview
                        const previewContainer = document.getElementById('activeVideoPreviewContainer');
                        previewContainer.innerHTML = `
                            <div class="relative rounded-xl overflow-hidden bg-slate-900 aspect-video shadow-inner">
                                <video controls class="w-full h-full object-cover" autoplay muted>
                                    <source src="${resp.url}" type="video/mp4">
                                </video>
                            </div>
                            <p class="text-[10px] font-semibold text-slate-500 mt-2 truncate">
                                <i class="fas fa-file-video mr-1 text-[#004a99]"></i> ${resp.filename} (${resp.size_mb} MB)
                            </p>
                        `;

                        setTimeout(() => {
                            progressWrapper.classList.add('hidden');
                        }, 4000);
                    } else {
                        statusText.innerHTML = '<i class="fas fa-triangle-exclamation text-red-600"></i> Gagal: ' + (resp.message || 'Error');
                    }
                } catch(err) {
                    statusText.innerHTML = '<i class="fas fa-triangle-exclamation text-red-600"></i> Gagal memproses respons server.';
                }
            } else {
                statusText.innerHTML = `<i class="fas fa-triangle-exclamation text-red-600"></i> Upload gagal (Status ${xhr.status}). Periksa batas upload server.`;
            }
        };

        xhr.onerror = function() {
            statusText.innerHTML = '<i class="fas fa-triangle-exclamation text-red-600"></i> Terjadi kesalahan jaringan saat mengunggah.';
        };

        xhr.send(formData);
    }

    function deleteActiveHeroVideo() {
        if (!confirm('Apakah Anda yakin ingin menghapus file video background hero?')) return;

        fetch('{{ route("admin.dashboard.delete-hero-video") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                const previewContainer = document.getElementById('activeVideoPreviewContainer');
                previewContainer.innerHTML = `
                    <div class="rounded-xl border border-dashed border-slate-200 aspect-video flex flex-col items-center justify-center text-slate-300 p-4 text-center bg-slate-50">
                        <i class="fas fa-film text-2xl mb-1"></i>
                        <span class="text-[11px] font-bold text-slate-400">Belum ada video background</span>
                        <span class="text-[10px] text-slate-400">Unggah file video di samping untuk mengaktifkan</span>
                    </div>
                `;
            }
        })
        .catch(e => {
            alert('Gagal menghapus video.');
        });
    }
</script>
@endsection
