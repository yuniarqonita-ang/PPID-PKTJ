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

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-100 bg-slate-50/10">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fas fa-video mr-2"></i> File Video Background Hero (.mp4)
                        </label>
                        <input type="file" name="hero_video_file" accept="video/mp4"
                               class="w-full px-5 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ffc107] transition-all text-xs font-bold text-slate-500">
                        @if($heroVidFile = \App\Models\Dashboard::getValue('hero_video_file'))
                            <div class="mt-2 flex items-center gap-3 p-2 bg-blue-50 rounded-lg border border-blue-100">
                                <span class="text-[10px] font-bold text-blue-700 uppercase tracking-tighter">Video Aktif: {{ basename($heroVidFile) }}</span>
                            </div>
                        @else
                            <p class="text-[10px] text-slate-400 italic">Pilih file .mp4 untuk dijadikan background video di bagian atas halaman beranda.</p>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-[#004a99] uppercase tracking-widest flex items-center">
                            <i class="fab fa-youtube mr-2"></i> Link Video Background Hero (YouTube)
                        </label>
                        <input type="url" name="hero_video_link" value="{{ old('hero_video_link', \App\Models\Dashboard::getValue('hero_video_link', '')) }}"
                               placeholder="Contoh: https://www.youtube.com/watch?v=..."
                               class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#ffc107] transition-all font-semibold text-slate-700">
                        <p class="text-[10px] text-slate-400 italic">Jika diisi, YouTube ini akan diputar sebagai background video di hero atas beranda (prioritas di bawah file MP4).</p>
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
</script>
@endsection
