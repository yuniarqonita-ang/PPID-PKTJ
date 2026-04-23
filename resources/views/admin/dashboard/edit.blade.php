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
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/20">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fab fa-youtube mr-2"></i> Link Video YouTube Profil
                        </label>
                        <input type="url" name="video_url" value="{{ old('video_url', \App\Models\Dashboard::getValue('video_url', '')) }}"
                               placeholder="Contoh: https://www.youtube.com/watch?v=..."
                               class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ffc107] transition-all font-semibold text-slate-700">
                        <p class="text-[10px] text-slate-400 italic">Anda bisa memasukkan link YouTube biasa, sistem akan otomatis menyesuaikannya.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fas fa-image mr-2"></i> Foto Thumbnail Video Halaman Depan
                        </label>
                        <input type="file" name="video_thumbnail" accept="image/*"
                               class="w-full px-5 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ffc107] transition-all text-xs font-bold text-slate-500">
                        @if($thumb = \App\Models\Dashboard::getValue('video_thumbnail'))
                            <div class="mt-2 flex items-center gap-3 p-2 bg-blue-50 rounded-lg border border-blue-100">
                                <img src="{{ asset('storage/' . $thumb) }}" class="w-16 h-10 object-cover rounded shadow-sm">
                                <span class="text-[10px] font-bold text-blue-700 uppercase tracking-tighter">Foto Aktif Digunakan</span>
                            </div>
                        @else
                            <p class="text-[10px] text-slate-400 italic">Unggah foto (Rekomendasi: 1280x720px) untuk dijadikan sampul video di beranda.</p>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Di Atas Video</label>
                        <input type="text" name="video_title" value="{{ old('video_title', \App\Models\Dashboard::getValue('video_title', 'Video Profil PKTJ Tegal')) }}"
                               class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#004a99] transition-all font-semibold text-slate-700">
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

            <!-- SAVE BAR -->
            <div class="flex items-center justify-end gap-4 pb-10">
                <button type="submit" class="px-10 py-4 bg-[#ffc107] text-[#002b5c] rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
