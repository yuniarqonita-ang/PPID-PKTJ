@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 animate-fade-in">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-edit mr-2 text-[#ffc107]"></i> Edit <span class="text-gray-800">{{ $type==='profil' ? 'Profil PPID' : ($type==='tugas' ? 'Tugas & Tanggung Jawab' : ($type==='visi' ? 'Visi & Misi' : ($type==='struktur' ? 'Struktur Organisasi' : ($type==='regulasi' ? 'Regulasi' : 'Kontak')))) }}</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Sesuaikan konten halaman {{ $type }} untuk ditampilkan di portal publik</p>
            </div>
            <a href="{{ route('halaman.index') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali Ke Pusat Kelola
            </a>
        </div>

        <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data" id="profil-form" class="space-y-8">
            @csrf
            @method('PUT')

            @if($type === 'kontak')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- MAIN CONTENT AREA (Left 2/3) -->
                <div class="lg:col-span-2 space-y-8 animate-fade-in">
                    <!-- Title & Subtitle Card -->
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                Pengaturan Utama Halaman Kontak
                            </h3>

                            <div class="grid grid-cols-1 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Halaman (H1)</label>
                                    <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" required
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Tagline Hero Banner</label>
                                    <input type="text" name="tagline_hero" value="{{ old('tagline_hero', $profil->tagline_hero) }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]"
                                        placeholder="Muncul di bawah judul besar di halaman publik...">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Deskripsi Pembuka Form (Editor)</label>
                                    <div class="rounded-3xl overflow-hidden border-2 border-slate-100">
                                        <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links Card -->
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-share-alt"></i>
                                </span>
                                Tautan Media Sosial & Hubungi Kami
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Facebook Link</label>
                                    <input type="url" name="facebook_link" value="{{ old('facebook_link', $settings['facebook_link'] ?? '') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="https://facebook.com/...">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Instagram Link</label>
                                    <input type="url" name="instagram_link" value="{{ old('instagram_link', $settings['instagram_link'] ?? '') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="https://instagram.com/...">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Twitter/X Link</label>
                                    <input type="url" name="twitter_link" value="{{ old('twitter_link', $settings['twitter_link'] ?? '') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="https://twitter.com/...">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">ID Video YouTube (11 Karakter)</label>
                                    <input type="text" name="youtube_link" id="youtube_link_kontak" value="{{ old('youtube_link', $settings['youtube_link'] ?? '') }}"
                                         class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="Contoh: dQw4w9WgXcQ">
                                    <p class="text-[10px] text-slate-400">Masukkan kode ID video YouTube saja (11 karakter). Jika Anda menempelkan link penuh, sistem akan otomatis mengubahnya menjadi ID saja untuk menghindari pemblokiran server.</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Linktree Link</label>
                                    <input type="url" name="linktree_link" value="{{ old('linktree_link', $settings['linktree_link'] ?? '') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="https://linktr.ee/...">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">WhatsApp Link</label>
                                    <input type="url" name="whatsapp_link" value="{{ old('whatsapp_link', $settings['whatsapp_link'] ?? '') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700" placeholder="https://wa.me/...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kampus I Card -->
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                Detail Kampus I (Perintis)
                            </h3>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Nama Kampus I</label>
                                    <input type="text" name="kampus_1_nama" value="{{ old('kampus_1_nama', $settings['kampus_1_nama'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Alamat Kampus I</label>
                                    <input type="text" name="kampus_1_alamat" value="{{ old('kampus_1_alamat', $settings['kampus_1_alamat'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Email Kampus I</label>
                                        <input type="email" name="kampus_1_email" value="{{ old('kampus_1_email', $settings['kampus_1_email'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Telepon Kampus I</label>
                                        <input type="text" name="kampus_1_telepon" value="{{ old('kampus_1_telepon', $settings['kampus_1_telepon'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Google Maps Embed HTML (Iframe) Kampus I</label>
                                    <textarea name="kampus_1_map" rows="4" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-medium text-xs text-slate-600 font-mono" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>'>{{ old('kampus_1_map', $settings['kampus_1_map'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kampus II Card -->
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                Detail Kampus II (Abdul Syukur)
                            </h3>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Nama Kampus II</label>
                                    <input type="text" name="kampus_2_nama" value="{{ old('kampus_2_nama', $settings['kampus_2_nama'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Alamat Kampus II</label>
                                    <input type="text" name="kampus_2_alamat" value="{{ old('kampus_2_alamat', $settings['kampus_2_alamat'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Email Kampus II</label>
                                        <input type="email" name="kampus_2_email" value="{{ old('kampus_2_email', $settings['kampus_2_email'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Telepon Kampus II</label>
                                        <input type="text" name="kampus_2_telepon" value="{{ old('kampus_2_telepon', $settings['kampus_2_telepon'] ?? '') }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-semibold text-slate-700">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Google Maps Embed HTML (Iframe) Kampus II</label>
                                    <textarea name="kampus_2_map" rows="4" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-medium text-xs text-slate-600 font-mono" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>'>{{ old('kampus_2_map', $settings['kampus_2_map'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR PANEL -->
                <div class="space-y-8">
                    <!-- Save Card -->
                    <div class="bg-[#002b5c] rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden ring-1 ring-white/10">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <div class="relative z-10 space-y-6">
                            <div class="flex items-center gap-3 border-b border-white/10 pb-6">
                                <div class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-save"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest">Aksi Editor</h4>
                                    <p class="text-[10px] text-blue-200/60 font-bold uppercase mt-1">Klik untuk simpan</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-5 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[3px] rounded-2xl hover:bg-white hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-amber-500/20">
                                SIMPAN PERUBAHAN
                            </button>
                            <div class="pt-4 space-y-3">
                                <div class="flex items-center justify-between text-[10px]">
                                    <span class="font-bold text-blue-200/50 uppercase">Update:</span>
                                    <span class="font-black text-[#ffc107] uppercase">{{ $profil->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- MAIN CONTENT AREA (Left 2/3) -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                        <div class="p-8 md:p-10 space-y-8">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                Konten Utama Halaman
                            </h3>

                            <div class="grid grid-cols-1 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Halaman (H1)</label>
                                    <input type="text" name="judul" value="{{ old('judul', $profil->judul) }}" required
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Tagline Hero Banner</label>
                                    <input type="text" name="tagline_hero" value="{{ old('tagline_hero', $profil->tagline_hero) }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]"
                                        placeholder="Muncul di bawah judul besar di halaman publik...">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Isi Konten Utama (Editor)</label>
                                    <div class="rounded-3xl overflow-hidden border-2 border-slate-100">
                                        <textarea name="konten_pembuka" id="editor_pembuka" class="tinymce-editor">{!! old('konten_pembuka',$profil->konten_pembuka) !!}</textarea>
                                    </div>
                                </div>

                                @if($type === 'struktur')
                                <div class="space-y-2 animate-fade-in">
                                    <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Tugas & Wewenang Detail (Editor)</label>
                                    <div class="rounded-3xl overflow-hidden border-2 border-slate-100">
                                        <textarea name="konten_detail" id="editor_detail" class="tinymce-editor">{!! old('konten_detail',$profil->konten_detail) !!}</textarea>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-1">Masukkan rincian tugas dan wewenang (dalam bentuk list, tabel, atau accordion) yang akan tampil di bawah bagan organisasi.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Additional Sections Area -->
                    <div id="additional-sections" class="space-y-6">
                        <div class="flex items-center justify-between px-4">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest">Seksi Tambahan / Detail</h3>
                            <button type="button" onclick="addSection()" class="px-5 py-2 bg-white border border-slate-200 text-[#004a99] font-bold text-xs rounded-xl hover:bg-[#004a99] hover:text-white transition-all flex items-center shadow-sm">
                                <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Seksi Konten
                            </button>
                        </div>
                        
                        @if($profil->additional_sections)
                            @foreach($profil->additional_sections as $index => $section)
                                <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden" id="section-{{ $index }}">
                                    <div class="bg-slate-50 px-8 py-4 flex justify-between items-center border-b border-slate-100">
                                        <h4 class="text-[10px] font-black text-[#002b5c] uppercase tracking-widest">Seksi #{{ $index + 1 }}</h4>
                                        <button type="button" onclick="removeSection({{ $index }})" class="text-slate-300 hover:text-red-500 transition-colors border-none p-0 bg-transparent cursor-pointer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <div class="p-8 space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase">Judul Seksi</label>
                                                <input type="text" name="additional_title[]" value="{{ $section['title'] ?? '' }}" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-[10px] font-black text-slate-400 uppercase">Variasi Layout</label>
                                                <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                                    <option value="default" {{ ($section['layout'] ?? '') === 'default' ? 'selected' : '' }}>Standar (Teks)</option>
                                                    <option value="diagram" {{ ($section['layout'] ?? '') === 'diagram' ? 'selected' : '' }}>Diagram (Image Center)</option>
                                                    <option value="cards" {{ ($section['layout'] ?? '') === 'cards' ? 'selected' : '' }}>Grid Cards (Icons)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <textarea name="additional_content[]" class="tinymce-editor">{!! $section['content'] ?? '' !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- SIDEBAR AREA (Right 1/3) -->
                <div class="space-y-8">
                    <!-- Save Card -->
                    <div class="bg-[#002b5c] rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden ring-1 ring-white/10">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <div class="relative z-10 space-y-6">
                            <div class="flex items-center gap-3 border-b border-white/10 pb-6">
                                <div class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-save"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest">Aksi Editor</h4>
                                    <p class="text-[10px] text-blue-200/60 font-bold uppercase mt-1">Klik untuk simpan</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-5 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[3px] rounded-2xl hover:bg-white hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-amber-500/20">
                                SIMPAN PERUBAHAN
                            </button>
                            <div class="pt-4 space-y-3">
                                <div class="flex items-center justify-between text-[10px]">
                                    <span class="font-bold text-blue-200/50 uppercase">Update:</span>
                                    <span class="font-black text-[#ffc107] uppercase">{{ $profil->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assets Card -->
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 p-8 space-y-6">
                        <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest flex items-center border-b border-slate-50 pb-6">
                            <i class="fas fa-images mr-2 text-[#ffc107]"></i> ASET DINAMIS
                        </h4>
                        
                        <div class="space-y-4">
                            @if(str_starts_with($type, 'sop-'))
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase">Input Gambar SOP</label>
                                <input type="file" name="gambar_sop" class="text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700">
                            </div>
                            @endif

                            @if($type === 'maklumat-pelayanan')
                            <div class="space-y-4 border-b border-slate-100 pb-6 mb-6">
                                <h5 class="text-[11px] font-black text-[#004a99] uppercase tracking-widest mb-4">Pengaturan Maklumat</h5>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Judul Maklumat</label>
                                    <input type="text" name="judul_maklumat" value="{{ $settings['judul_maklumat'] ?? '' }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Isi Maklumat (Text)</label>
                                    <textarea name="isi_maklumat" class="tinymce-editor w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold h-32">{{ $settings['isi_maklumat'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Gambar Maklumat</label>
                                    <input type="file" name="gambar_maklumat" class="text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h5 class="text-[11px] font-black text-[#004a99] uppercase tracking-widest mb-4">Pengaturan Standar Biaya</h5>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Judul Standar Biaya</label>
                                    <input type="text" name="judul_standar" value="{{ $settings['judul_standar'] ?? '' }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Isi Standar Biaya (Text/Editor)</label>
                                    <textarea name="isi_standar" class="tinymce-editor w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold h-32">{{ $settings['isi_standar'] ?? '' }}</textarea>
                                </div>
                            </div>
                            @endif

                            @if($type === 'struktur')
                            <div class="space-y-4 border border-slate-100 rounded-2xl p-5 bg-slate-50/50">
                                <h5 class="text-[11px] font-black text-[#004a99] uppercase tracking-widest">Bagan Struktur Organisasi</h5>
                                
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Level 1 — Pimpinan (Jabatan)</label>
                                    <input type="text" name="role_1" value="{{ $settings['role_1'] ?? 'DIREKTUR PKTJ' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: DIREKTUR PKTJ">
                                    <input type="text" name="sub_1" value="{{ $settings['sub_1'] ?? 'Pembina PPID' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-500" placeholder="Sub keterangan, contoh: Pembina PPID">
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Level 2 — Koordinator</label>
                                    <input type="text" name="role_2" value="{{ $settings['role_2'] ?? 'KOORDINATOR PPID' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: KOORDINATOR PPID">
                                    <input type="text" name="sub_2" value="{{ $settings['sub_2'] ?? 'Kepala Bagian/Program' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-500" placeholder="Sub keterangan">
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Level 3 — Tim PPID (1)</label>
                                    <input type="text" name="role_3" value="{{ $settings['role_3'] ?? 'TIM PPID' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: TIM PPID">
                                    <input type="text" name="sub_3" value="{{ $settings['sub_3'] ?? 'Staff Teknis' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-500" placeholder="Sub keterangan">
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Level 3 — Tim PPID (2)</label>
                                    <input type="text" name="role_4" value="{{ $settings['role_4'] ?? 'TIM PPID' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: TIM PPID">
                                    <input type="text" name="sub_4" value="{{ $settings['sub_4'] ?? 'Staff Teknis' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-500" placeholder="Sub keterangan">
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase">Level 3 — Tim PPID (3)</label>
                                    <input type="text" name="role_5" value="{{ $settings['role_5'] ?? 'TIM PPID' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: TIM PPID">
                                    <input type="text" name="sub_5" value="{{ $settings['sub_5'] ?? 'Staff Teknis' }}" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-500" placeholder="Sub keterangan">
                                </div>
                            </div>
                            @endif


                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-[#004a99] uppercase">ID Video YouTube (11 Karakter)</label>
                                <input type="text" name="youtube_link" id="youtube_link_umum" value="{{ $settings['youtube_link'] ?? '' }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold" placeholder="Contoh: dQw4w9WgXcQ">
                                <p class="text-[9px] text-slate-400">Masukkan kode ID video saja (11 karakter). Link penuh otomatis diubah menjadi ID saat ditempelkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif    </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let sectionCount = {{ $profil->additional_sections ? count($profil->additional_sections) : 0 }};

    function addSection() {
        const id = sectionCount++;
        const container = document.getElementById('additional-sections');
        const html = `
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden animate-fade-in" id="section-${id}">
                <div class="bg-slate-50 px-8 py-4 flex justify-between items-center border-b border-slate-100">
                    <h4 class="text-[10px] font-black text-[#002b5c] uppercase tracking-widest">Seksi Tambahan Baru</h4>
                    <button type="button" onclick="removeSection(${id})" class="text-slate-300 hover:text-red-500 transition-colors border-none p-0 bg-transparent cursor-pointer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Judul Seksi</label>
                            <input type="text" name="additional_title[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase">Variasi Layout</label>
                            <select name="additional_layout[]" class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold">
                                <option value="default">Standar (Teks)</option>
                                <option value="diagram">Diagram (Image Center)</option>
                                <option value="cards">Grid Cards (Icons)</option>
                            </select>
                        </div>
                    </div>
                    <textarea id="mce-${id}" name="additional_content[]" class="tinymce-editor"></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        
        // Re-init TinyMCE for new element using the global config defined in app.blade.php
        if (typeof tinymce !== 'undefined') {
            tinymce.execCommand('mceAddEditor', false, `mce-${id}`);
        }
    }

    function removeSection(id) {
        if(confirm('Hapus seksi ini?')) {
            document.getElementById(`section-${id}`).remove();
        }
    }

    function setupYoutubeExtractor(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        
        const extractId = () => {
            let val = input.value.trim();
            if (!val) return;
            
            // Regex to match YouTube video ID from various formats
            const pattern = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^\"&?\/ ]{11})/i;
            const match = val.match(pattern);
            if (match && match[1]) {
                input.value = match[1];
            } else if (val.length > 11 && (val.includes('http') || val.includes('youtube') || val.includes('youtu.be'))) {
                try {
                    const url = new URL(val);
                    let id = url.searchParams.get('v');
                    if (id && id.length === 11) {
                        input.value = id;
                    }
                } catch(e) {}
            }
        };
        
        input.addEventListener('input', extractId);
        input.addEventListener('paste', () => setTimeout(extractId, 10));
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        setupYoutubeExtractor('youtube_link_kontak');
        setupYoutubeExtractor('youtube_link_umum');
        
        // Clean YouTube fields on form submit to bypass ModSecurity blocks
        const form = document.getElementById('profil-form');
        if (form) {
            form.addEventListener('submit', () => {
                ['youtube_link_kontak', 'youtube_link_umum'].forEach(id => {
                    const input = document.getElementById(id);
                    if (input) {
                        let val = input.value.trim();
                        if (val) {
                            const pattern = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^\"&?\/ ]{11})/i;
                            const match = val.match(pattern);
                            if (match && match[1]) {
                                input.value = match[1];
                            } else if (val.length > 11 && (val.includes('http') || val.includes('youtube') || val.includes('youtu.be'))) {
                                try {
                                    const url = new URL(val);
                                    let idVal = url.searchParams.get('v');
                                    if (idVal && idVal.length === 11) {
                                        input.value = idVal;
                                    }
                                } catch(e) {}
                            }
                        }
                    }
                });
            });
        }
    });
</script>
@endpush
