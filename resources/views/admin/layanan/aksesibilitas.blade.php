@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#002b5c] via-[#004a99] to-[#0066cc] rounded-[2.5rem] p-10 md:p-12 shadow-2xl text-white relative overflow-hidden mb-10 border border-blue-400/20">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-amber-400/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-cyan-400/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#002b5c] font-black text-xs uppercase tracking-widest shadow-lg shadow-amber-500/20">
                    <i class="fas fa-universal-access animate-pulse"></i>
                    <span>AKIP Standar Inklusivitas & Disabilitas</span>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Kelola Layanan <span class="text-[#ffc107]">Inklusif & Braille</span>
                    </h1>
                    <p class="text-blue-100 text-base md:text-lg font-medium max-w-2xl opacity-90">
                        Manajemen formulir khusus huruf Braille, dokumen inovasi, video bahasa isyarat (Bisindo), dan pengaturan widget disabilitas ramah pengguna.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center shadow-lg">
                    <i class="fas fa-eye mr-3"></i> Lihat Portal
                </a>
                <button type="submit" form="aksesibilitas-form" class="px-8 py-4 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-[2px] rounded-2xl shadow-xl shadow-amber-500/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-save mr-3"></i> Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- FORM SETTINGS -->
    <form id="aksesibilitas-form" action="{{ route('admin.halaman-custom.store', 'aksesibilitas_disabilitas') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        @if(session('success'))
            <div class="p-6 bg-emerald-500/10 border-2 border-emerald-500/30 rounded-2xl text-emerald-700 font-bold flex items-center gap-4">
                <i class="fas fa-check-circle text-2xl text-emerald-600"></i>
                <div>
                    <p class="text-sm m-0">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- 1. DOKUMEN BRAILLE & INOVASI DISABILITAS -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10 space-y-8">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-6">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-wider flex items-center">
                        <span class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mr-4 text-base shadow-sm">
                            <i class="fas fa-braille"></i>
                        </span>
                        1. Dokumen Layanan Braille & Inovasi (Indikator I AKIP 2025)
                    </h3>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Format Softcopy / GDrive Link</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- FORMULIR PERMOHONAN BRAILLE -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm">A</div>
                            <div>
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-wide">Formulir Permohonan Huruf Braille</label>
                                <p class="text-xs text-slate-500 m-0">File asli di folder: <code>AKIP PKTJ 2025/Indikator I/FORMULIR PERMOHONAN BRAILE.pdf</code></p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Judul Dokumen di Portal</label>
                            <input type="text" name="judul_form_permohonan_braille" 
                                   value="{{ $settings['aksesibilitas_disabilitas_judul_form_permohonan_braille'] ?? 'Formulir Permohonan Informasi Publik Huruf Braille (Disabilitas Netra)' }}"
                                   class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-bold text-[#002b5c] focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Link Google Drive / URL Dokumen</label>
                            <input type="text" name="link_form_permohonan_braille" 
                                   value="{{ $settings['aksesibilitas_disabilitas_link_form_permohonan_braille'] ?? '' }}"
                                   placeholder="https://drive.google.com/file/d/.../view?usp=sharing"
                                   class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm text-slate-700 focus:ring-2 focus:ring-blue-500 font-mono">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Atau Upload File PDF Langsung</label>
                            <input type="file" name="file_form_permohonan_braille" accept=".pdf"
                                   class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <!-- FORMULIR PERNYATAAN KEBERATAN BRAILLE -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm">B</div>
                            <div>
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-wide">Formulir Pernyataan Keberatan Braille</label>
                                <p class="text-xs text-slate-500 m-0">File asli di folder: <code>AKIP PKTJ 2025/Indikator I/PERNYATAAN KEBERATAN BRAILE.pdf</code></p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Judul Dokumen di Portal</label>
                            <input type="text" name="judul_form_keberatan_braille" 
                                   value="{{ $settings['aksesibilitas_disabilitas_judul_form_keberatan_braille'] ?? 'Formulir Pernyataan Keberatan Layanan Informasi Publik Huruf Braille' }}"
                                   class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-bold text-[#002b5c] focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Link Google Drive / URL Dokumen</label>
                            <input type="text" name="link_form_keberatan_braille" 
                                   value="{{ $settings['aksesibilitas_disabilitas_link_form_keberatan_braille'] ?? '' }}"
                                   placeholder="https://drive.google.com/file/d/.../view?usp=sharing"
                                   class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm text-slate-700 focus:ring-2 focus:ring-blue-500 font-mono">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Atau Upload File PDF Langsung</label>
                            <input type="file" name="file_form_keberatan_braille" accept=".pdf"
                                   class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        </div>
                    </div>

                    <!-- DOKUMEN INOVASI DISABILITAS -->
                    <div class="col-span-1 md:col-span-2 p-6 rounded-2xl bg-indigo-50/60 border border-indigo-200 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm">C</div>
                            <div>
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-wide">Dokumen Laporan Inovasi Layanan Ramah Disabilitas PPID PKTJ</label>
                                <p class="text-xs text-slate-500 m-0">File asli di folder: <code>AKIP PKTJ 2025/Indikator I/Inovasi PPID.docx</code></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600">Judul Inovasi di Portal</label>
                                <input type="text" name="judul_inovasi_disabilitas" 
                                       value="{{ $settings['aksesibilitas_disabilitas_judul_inovasi_disabilitas'] ?? 'Laporan Inovasi Pelayanan Informasi Ramah Disabilitas PPID PKTJ Tegal' }}"
                                       class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-bold text-[#002b5c] focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600">Link Google Drive / URL Dokumen</label>
                                <input type="text" name="link_inovasi_disabilitas" 
                                       value="{{ $settings['aksesibilitas_disabilitas_link_inovasi_disabilitas'] ?? '' }}"
                                       placeholder="https://drive.google.com/file/d/.../view?usp=sharing"
                                       class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm text-slate-700 focus:ring-2 focus:ring-blue-500 font-mono">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600">Deskripsi / Uraian Inovasi Pelayanan</label>
                            <textarea name="deskripsi_inovasi_disabilitas" rows="3" 
                                      class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm text-slate-700 focus:ring-2 focus:ring-blue-500">{{ $settings['aksesibilitas_disabilitas_deskripsi_inovasi_disabilitas'] ?? 'Inovasi pemenuhan sarana dan prasarana aksesibilitas terpadu: Meja Layanan Fisik Khusus Difabel, Formulir Braille, Audio Text-to-Speech otomatis, serta Video Panduan Permohonan Informasi Berbahasa Isyarat (Bisindo).' }}</textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- 2. VIDEO BAHASA ISYARAT (BISINDO) & HOTLINE PENDAMPING -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10 space-y-8">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-6">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-wider flex items-center">
                        <span class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mr-4 text-base shadow-sm">
                            <i class="fas fa-hands-asl-interpreting"></i>
                        </span>
                        2. Video Bahasa Isyarat & Hotline Pendamping Khusus
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- VIDEO BISINDO -->
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-wide">
                            Link Video Panduan Bahasa Isyarat (YouTube Embed)
                        </label>
                        <input type="text" name="video_bisindo_url" 
                               value="{{ $settings['aksesibilitas_disabilitas_video_bisindo_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ' }}"
                               placeholder="https://www.youtube.com/embed/... atau https://youtu.be/..."
                               class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-mono text-slate-700 focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-slate-500">Video panduan tata cara permohonan informasi bagi penyandang tunarungu/wicara.</p>
                    </div>

                    <!-- HOTLINE PENDAMPING -->
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-wide">
                            Nomor WhatsApp Petugas Pendamping Difabel
                        </label>
                        <input type="text" name="hotline_pendamping_wa" 
                               value="{{ $settings['aksesibilitas_disabilitas_hotline_pendamping_wa'] ?? '081234567890' }}"
                               placeholder="Contoh: 081234567890"
                               class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-slate-500">Nomor kontak langsung petugas meja layanan PKTJ untuk pendampingan pemohon difabel.</p>
                    </div>

                </div>

            </div>
        </div>

        <!-- 3. SAKLAR FITUR AKSESIBILITAS DI WEBSITE -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10 space-y-6">
                
                <div class="flex items-center justify-between border-b border-slate-100 pb-6">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-wider flex items-center">
                        <span class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mr-4 text-base shadow-sm">
                            <i class="fas fa-sliders"></i>
                        </span>
                        3. Saklar Pengaktif Fitur Widget Aksesibilitas
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <h6 class="font-bold text-sm text-[#002b5c] mb-1">Widget Neon Floating</h6>
                            <p class="text-xs text-slate-500 m-0">Tampilkan tombol mengambang</p>
                        </div>
                        <input type="checkbox" name="widget_aktif" value="1" {{ ($settings['aksesibilitas_disabilitas_widget_aktif'] ?? '1') == '1' ? 'checked' : '' }} class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <h6 class="font-bold text-sm text-[#002b5c] mb-1">Text-to-Speech (Audio)</h6>
                            <p class="text-xs text-slate-500 m-0">Pembaca suara otomatis</p>
                        </div>
                        <input type="checkbox" name="audio_tts_aktif" value="1" {{ ($settings['aksesibilitas_disabilitas_audio_tts_aktif'] ?? '1') == '1' ? 'checked' : '' }} class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <h6 class="font-bold text-sm text-[#002b5c] mb-1">Kontras Tinggi & Monokrom</h6>
                            <p class="text-xs text-slate-500 m-0">Mode warna kontras tajam</p>
                        </div>
                        <input type="checkbox" name="kontras_aktif" value="1" {{ ($settings['aksesibilitas_disabilitas_kontras_aktif'] ?? '1') == '1' ? 'checked' : '' }} class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <div>
                            <h6 class="font-bold text-sm text-[#002b5c] mb-1">Font Ramah Disleksia</h6>
                            <p class="text-xs text-slate-500 m-0">Mode keterbacaan huruf</p>
                        </div>
                        <input type="checkbox" name="disleksia_aktif" value="1" {{ ($settings['aksesibilitas_disabilitas_disleksia_aktif'] ?? '1') == '1' ? 'checked' : '' }} class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    </div>

                </div>

            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="px-10 py-5 bg-[#ffc107] text-[#002b5c] font-black text-sm uppercase tracking-[2px] rounded-2xl shadow-xl shadow-amber-500/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                <i class="fas fa-save mr-3 text-lg"></i> Simpan Seluruh Pengaturan Aksesibilitas
            </button>
        </div>

    </form>

</div>
@endsection
