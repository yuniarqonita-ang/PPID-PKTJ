@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.permohonan.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-tools mr-2 text-[#ffc107]"></i> Form Builder PPID
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Modifikasi formulir registrasi untuk pemohon informasi</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="btn-save-form" class="px-8 py-3 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg hover:bg-blue-800 transition-all flex items-center justify-center">
                    <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- TOOLBOX (Left) -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 p-6 border-t-4 border-[#ffc107]">
                    <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] mb-4 flex items-center text-gray-800">
                        <i class="fas fa-cube mr-2 text-gray-400"></i> Field Dasar
                    </h3>
                    <div class="space-y-2 opacity-60">
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-font"></i> Teks Singkat (Locked)
                        </div>
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-paragraph"></i> Paragraf (Locked)
                        </div>
                        <div class="p-3 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-bold text-gray-500 flex items-center gap-3 cursor-not-allowed">
                            <i class="fas fa-file-upload"></i> Unggah File (Locked)
                        </div>
                    </div>
                </div>

                <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl font-bold"></div>
                    <h3 class="text-[11px] font-black uppercase tracking-[0.2em] mb-3 relative z-10 text-gray-800">
                        <i class="fas fa-info-circle mr-2 text-[#ffc107]"></i> Info Builder
                    </h3>
                    <p class="text-[10px] opacity-90 leading-relaxed font-medium relative z-10 text-gray-800">
                        Field inti seperti Nama, Email, dan Identitas tidak dapat dihapus untuk menjaga integritas sistem pengajuan.
                    </p>
                </div>

                <a href="{{ url('/permohonan-informasi') }}" target="_blank" class="w-full flex items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl text-[#004a99] font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 transition-all shadow-md">
                    <i class="fas fa-external-link-alt mr-2 text-gray-800"></i> Lihat Preview Publik
                </a>
            </div>

            <!-- CANVAS (Right) -->
            <div class="lg:col-span-3 space-y-8">
                
                <!-- SECTION: CORE FIELDS MANAGEMENT -->
                <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-cyan-500">
                    <div class="p-8 space-y-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center text-cyan-600">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-cyan-600 uppercase tracking-widest leading-none">Pengaturan Field Utama</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Sesuaikan label dan visibilitas kolom identitas</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-cyan-50 text-cyan-600 rounded-lg text-[9px] font-black tracking-widest">IDENTITY SECTION</span>
                        </div>
                        
                        <div class="space-y-8">
                            <!-- Kelompok 1: Akun -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div class="col-span-2">
                                    <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">1. Bagian Kredensial Akun</label>
                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <input type="text" id="label-title-akun" value="{{ $settings['permohonan_label_title_akun'] ?? 'Kredensial Akun' }}" 
                                                class="w-full px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-black text-gray-700 outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Judul Bagian Akun">
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Username</label>
                                    <input type="text" id="label-username" value="{{ $settings['permohonan_label_username'] ?? 'Username Akses' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Email</label>
                                    <input type="text" id="label-email" value="{{ $settings['permohonan_label_email'] ?? 'Alamat Kontak Email' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Password</label>
                                    <input type="text" id="label-password" value="{{ $settings['permohonan_label_password'] ?? 'Kata Sandi Baru' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Konfirmasi</label>
                                    <input type="text" id="label-password-confirm" value="{{ $settings['permohonan_label_password_confirmation'] ?? 'Ulangi Kata Sandi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                            </div>

                            <!-- Kelompok 2: Identitas -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-4">
                                <div class="col-span-2">
                                    <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">2. Bagian Identitas Pemohon</label>
                                    <input type="text" id="label-title-identitas" value="{{ $settings['permohonan_label_title_identitas'] ?? 'Data Identitas Pemohon' }}" 
                                        class="w-full px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-black text-gray-700 outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Judul Bagian Identitas">
                                </div>
                                <div class="space-y-1 col-span-2">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Nama Lengkap</label>
                                    <input type="text" id="label-nama" value="{{ $settings['permohonan_label_nama'] ?? 'Nama Lengkap (Sesuai Identitas)' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Jenis ID</label>
                                    <input type="text" id="label-jenis-identitas" value="{{ $settings['permohonan_label_jenis_identitas'] ?? 'Jenis Kartu Identitas' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Nomor ID</label>
                                    <input type="text" id="label-nomor-identitas" value="{{ $settings['permohonan_label_nomor_identitas'] ?? 'Nomor ID Card / NIK' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1 col-span-2">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Alamat</label>
                                    <input type="text" id="label-alamat" value="{{ $settings['permohonan_label_alamat'] ?? 'Alamat Domisili Sekarang' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label No. HP/WA</label>
                                    <input type="text" id="label-telepon" value="{{ $settings['permohonan_label_telepon'] ?? 'Nomor WhatsApp Aktif' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Upload KTP</label>
                                    <input type="text" id="label-ktp" value="{{ $settings['permohonan_label_ktp'] ?? 'Unggah Scan/Foto Identitas Resmi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>

                                <!-- Field Opsional dengan Toggle -->
                                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                                    <div>
                                        <label class="text-[9px] font-black text-gray-400 uppercase block">Label Pekerjaan</label>
                                        <input type="text" id="label-pekerjaan" value="{{ $settings['permohonan_label_pekerjaan'] ?? 'Pekerjaan Utama' }}" class="bg-transparent border-0 p-0 text-xs font-bold text-gray-700 focus:ring-0">
                                    </div>
                                    <div class="form-check form-switch p-0">
                                        <input class="form-check-input h-5 w-10 cursor-pointer" type="checkbox" id="show-pekerjaan" {{ ($settings['permohonan_show_pekerjaan'] ?? 'yes') == 'yes' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                                    <div>
                                        <label class="text-[9px] font-black text-gray-400 uppercase block">Label Lembaga</label>
                                        <input type="text" id="label-lembaga" value="{{ $settings['permohonan_label_lembaga'] ?? 'Nama Lembaga (Opsional)' }}" class="bg-transparent border-0 p-0 text-xs font-bold text-gray-700 focus:ring-0">
                                    </div>
                                    <div class="form-check form-switch p-0">
                                        <input class="form-check-input h-5 w-10 cursor-pointer" type="checkbox" id="show-lembaga" {{ ($settings['permohonan_show_lembaga'] ?? 'yes') == 'yes' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <!-- Kelompok 3: Detail Permohonan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-4">
                                <div class="col-span-2">
                                    <label class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-3 block border-b border-gray-100 pb-1">3. Bagian Detail Permohonan</label>
                                    <input type="text" id="label-title-permohonan" value="{{ $settings['permohonan_label_title_permohonan'] ?? 'Rincian Informasi Yang Dimohon' }}" 
                                        class="w-full px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-black text-gray-700 outline-none focus:ring-2 focus:ring-cyan-100" placeholder="Judul Bagian Detail">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Judul Informasi</label>
                                    <input type="text" id="label-judul-informasi" value="{{ $settings['permohonan_label_judul_informasi'] ?? 'Nama / Judul Informasi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Tujuan Penggunaan</label>
                                    <input type="text" id="label-tujuan" value="{{ $settings['permohonan_label_tujuan'] ?? 'Tujuan Penggunaan Informasi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Metode</label>
                                    <input type="text" id="label-metode" value="{{ $settings['permohonan_label_metode'] ?? 'Metode Perolehan Informasi' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase">Label Dokumen Pendukung</label>
                                    <input type="text" id="label-pendukung" value="{{ $settings['permohonan_label_pendukung'] ?? 'Dokumen Pendukung Tambahan' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:bg-white outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DYNAMIC SECTION BUILDER -->
                <div class="space-y-6">
                    <!-- NEW: HAK-HAK PEMOHON EDITOR -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-emerald-500">
                        <div class="p-8 space-y-6">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                                        <i class="fas fa-gavel"></i>
                                    </div>
                                    <h4 class="text-xs font-black text-emerald-600 uppercase tracking-widest">Hak-hak Pemohon Informasi</h4>
                                </div>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black tracking-widest uppercase">Legal Section</span>
                            </div>
                            
                            <div class="space-y-4">
                                <p class="text-[10px] text-gray-500 font-bold uppercase">Konten Undang-undang & Hak Pemohon (Akan tampil sebagai tombol klik di form publik)</p>
                                <textarea id="permohonan-hak-hak-editor" class="tinymce-editor">
                                    {!! $settings['permohonan_hak_hak'] ?? '' !!}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <!-- NEW: PAGE CONTENT EDITOR -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#004a99]">
                        <div class="p-8 space-y-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-[#004a99]/10 rounded-xl flex items-center justify-center text-[#004a99]">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="text-xs font-black text-[#004a99] uppercase tracking-widest">Konten Banner & Narasi Halaman</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Judul Utama Halaman</label>
                                    <input type="text" id="permohonan-title-input" value="{{ $settings['permohonan_title'] ?? 'Permohonan Informasi Publik' }}" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase"
                                        placeholder="Cth: LAYANAN PERMOHONAN INFORMASI">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Sub-judul Halaman</label>
                                    <textarea id="permohonan-subtitle-input" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-medium text-gray-600 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all"
                                        rows="2" placeholder="Cth: Silakan lengkapi formulir di bawah ini...">{{ $settings['permohonan_subtitle'] ?? 'Silakan lengkapi formulir di bawah ini dengan data yang benar untuk mengajukan permohonan informasi ke PPID PKTJ Tegal.' }}</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Judul Banner Peringatan</label>
                                        <input type="text" id="permohonan-warning-title-input" value="{{ $settings['permohonan_warning_title'] ?? 'Pernyataan & Pertanggungjawaban' }}" 
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-red-600 focus:bg-white focus:ring-2 focus:ring-red-100 focus:border-red-400 outline-none transition-all"
                                            placeholder="Cth: PERHATIAN PENTING">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Teks Banner Peringatan</label>
                                        <textarea id="permohonan-warning-text-input" 
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-[11px] font-medium text-red-500 focus:bg-white focus:ring-2 focus:ring-red-100 focus:border-red-400 outline-none transition-all"
                                            rows="1" placeholder="Cth: Saya menyatakan bahwa...">{{ $settings['permohonan_warning_text'] ?? 'Saya menyatakan bahwa data yang diungkapkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION TITLE EDITOR -->
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
                        <div class="p-6 md:p-8 flex items-center gap-6">
                            <div class="w-16 h-16 bg-[#004a99] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shrink-0">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div class="flex-1">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Judul Bagian Kuesioner (Field Tambahan Custom)</label>
                                <input type="text" id="section-title-input" value="{{ $sectionTitle ?? 'INFORMASI TAMBAHAN' }}" 
                                    class="w-full bg-transparent border-none p-0 text-xl md:text-2xl font-black text-[#004a99] focus:ring-0 uppercase placeholder-gray-200"
                                    placeholder="CONTOH: DATA PENUNJANG">
                            </div>
                        </div>
                    </div>

                    <!-- FIELDS LIST -->
                    <div id="custom-fields-container" class="space-y-4">
                        @if(isset($customFields) && count($customFields) > 0)
                            @foreach($customFields as $index => $field)
                            <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all animate-fade-in-down" data-id="{{ $index }}">
                                <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                                    <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                                        <i class="fas fa-grip-vertical text-xl"></i>
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Label Field Kuesioner</label>
                                        <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" value="{{ $field['label'] ?? '' }}">
                                    </div>
                                    <div class="w-full md:w-1/4 space-y-1">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Tipe Data</label>
                                        <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                                            <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>TEKS PENDEK</option>
                                            <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>PARAGRAF</option>
                                            <option value="file" {{ ($field['type'] ?? '') == 'file' ? 'selected' : '' }}>UNGGAH BERKAS</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn-delete-field p-4 text-red-200 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- ADD BUTTON -->
                    <button type="button" id="btn-add-field" class="w-full py-8 bg-white border-2 border-dashed border-gray-200 rounded-3xl text-gray-400 hover:border-[#004a99] hover:text-[#004a99] hover:bg-blue-50/50 transition-all flex flex-col items-center justify-center gap-3 group">
                        <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">Tambah Field Kuesioner Baru</span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Add New Field
        $('#btn-add-field').click(function() {
            let id = new Date().getTime();
            let html = `
                <div class="custom-field bg-white rounded-3xl shadow-lg ring-1 ring-gray-200 overflow-hidden group hover:ring-[#004a99] transition-all animate-fade-in-down" data-id="${id}" style="display:none;">
                    <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                        <div class="drag-handle p-4 text-gray-200 cursor-move hover:text-[#ffc107] transition-colors">
                            <i class="fas fa-grip-vertical text-xl"></i>
                        </div>
                        <div class="flex-1 space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Label Kuesioner</label>
                            <input type="text" class="field-label w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 focus:border-[#004a99] outline-none transition-all uppercase" placeholder="Masukkan Label Field...">
                        </div>
                        <div class="w-full md:w-1/4 space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-gray-800">Tipe Input</label>
                            <select class="field-type w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-[#004a99] focus:bg-white focus:ring-2 focus:ring-[#004a99]/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="text">TEKS PENDEK</option>
                                <option value="textarea">PARAGRAF</option>
                                <option value="file">UNGGAH BERKAS</option>
                            </select>
                        </div>
                        <button type="button" class="btn-delete-field p-4 text-red-200 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </div>
            `;
            let $el = $(html);
            $('#custom-fields-container').append($el);
            $el.slideDown(300);
        });

        // Delete field
        $(document).on('click', '.btn-delete-field', function() {
            let $el = $(this).closest('.custom-field');
            $el.slideUp(300, function() { $(this).remove(); });
        });

        // Save Form
        $('#btn-save-form').click(function() {
            let sectionTitle = $('#section-title-input').val().trim().toUpperCase() || 'INFORMASI TAMBAHAN';
            let permohonanTitle = $('#permohonan-title-input').val().trim();
            let permohonanSubtitle = $('#permohonan-subtitle-input').val().trim();
            let permohonanWarningTitle = $('#permohonan-warning-title-input').val().trim();
            let permohonanWarningText = $('#permohonan-warning-text-input').val().trim();

            // Core Field Settings
            let coreSettings = {
                permohonan_label_title_akun: $('#label-title-akun').val().trim(),
                permohonan_label_username: $('#label-username').val().trim(),
                permohonan_label_email: $('#label-email').val().trim(),
                permohonan_label_password: $('#label-password').val().trim(),
                permohonan_label_password_confirmation: $('#label-password-confirm').val().trim(),
                permohonan_label_title_identitas: $('#label-title-identitas').val().trim(),
                permohonan_label_nama: $('#label-nama').val().trim(),
                permohonan_label_jenis_identitas: $('#label-jenis-identitas').val().trim(),
                permohonan_label_nomor_identitas: $('#label-nomor-identitas').val().trim(),
                permohonan_label_alamat: $('#label-alamat').val().trim(),
                permohonan_label_telepon: $('#label-telepon').val().trim(),
                permohonan_label_pekerjaan: $('#label-pekerjaan').val().trim(),
                permohonan_label_lembaga: $('#label-lembaga').val().trim(),
                permohonan_label_ktp: $('#label-ktp').val().trim(),
                permohonan_label_title_permohonan: $('#label-title-permohonan').val().trim(),
                permohonan_label_judul_informasi: $('#label-judul-informasi').val().trim(),
                permohonan_label_tujuan: $('#label-tujuan').val().trim(),
                permohonan_label_metode: $('#label-metode').val().trim(),
                permohonan_label_pendukung: $('#label-pendukung').val().trim(),
                permohonan_show_pekerjaan: $('#show-pekerjaan').is(':checked') ? 'yes' : 'no',
                permohonan_show_lembaga: $('#show-lembaga').is(':checked') ? 'yes' : 'no'
            };

            let fields = [];
            $('.custom-field').each(function() {
                let label = $(this).find('.field-label').val().trim();
                let type = $(this).find('.field-type').val();
                if(label !== '') {
                    fields.push({
                        label: label,
                        type: type,
                        name: 'custom_' + label.toLowerCase().replace(/[^a-z0-9]/g, '_') + '_' + Math.floor(Math.random()*100)
                    });
                }
            });

            let $btn = $(this);
            let originalContent = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> MENYIMPAN...').prop('disabled', true);

            // Get TinyMCE content for Hak-hak Pemohon
            let permohonanHakHak = '';
            if (typeof tinymce !== 'undefined' && tinymce.get('permohonan-hak-hak-editor')) {
                permohonanHakHak = tinymce.get('permohonan-hak-hak-editor').getContent();
            }

            $.ajax({
                url: "{{ route('admin.permohonan.save_form') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    section_title: sectionTitle,
                    permohonan_title: permohonanTitle,
                    permohonan_subtitle: permohonanSubtitle,
                    permohonan_warning_title: permohonanWarningTitle,
                    permohonan_warning_text: permohonanWarningText,
                    permohonan_hak_hak: permohonanHakHak,
                    core_settings: coreSettings,
                    fields: fields
                },
                success: function(response) {
                    $btn.html(originalContent).prop('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL DISIMPAN!',
                        text: 'Skema formulir publik telah diperbarui.',
                        background: '#fff',
                        confirmButtonColor: '#004a99',
                        customClass: { title: 'text-[#004a99] font-black uppercase' }
                    });
                },
                error: function() {
                    $btn.html(originalContent).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL MENYIMPAN',
                        text: 'Terjadi kesalahan sistem, silakan coba lagi.',
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        });
    });
</script>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
