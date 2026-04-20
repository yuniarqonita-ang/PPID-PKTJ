@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                Laporan <span class="text-[#004a99]">Akses Informasi</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Transparansi Statistik Permohonan & Akses Informasi Publik</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest leading-loose">
                <i class="fas fa-arrow-left mr-3"></i> KEMBALI KE DASHBOARD
            </a>
            <a href="http://ppid.pktj.ac.id/layanan-informasi/laporan-akses" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> LIHAT PORTAL
            </a>
        </div>
    </div>

    <form action="{{ route('admin.halaman-custom.store', 'layanan_akses') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- IDENTITY & HERO -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-heading"></i>
                        </span>
                        Identitas Halaman Laporan
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Hero Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['layanan_akses_judul_hero'] ?? 'Laporan Akses Informasi' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['layanan_akses_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            
            <!-- MAIN CONTENT AREA (FULL WIDTH) -->
            <div class="space-y-10">
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                            <i class="fas fa-file-pdf mr-4 text-[#ffc107]"></i> Unggah Dokumen Laporan
                        </h4>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tahun Laporan</label>
                                <input type="text" name="tahun_laporan" value="{{ $settings['layanan_akses_tahun_laporan'] ?? date('Y') }}"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl text-lg font-black text-[#002b5c]">
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Pilih File PDF Baru</label>
                                <input type="file" name="file_laporan" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl">
                            </div>
                        </div>

                        @if(isset($settings['layanan_akses_file_laporan']))
                        <div class="p-8 bg-blue-50 border-2 border-blue-100 rounded-[2rem] flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 bg-white text-red-600 rounded-2xl flex items-center justify-center text-3xl shadow-md">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div>
                                    <p class="text-md font-black text-[#002b5c] uppercase tracking-widest">Dokumen Aktif</p>
                                    <p class="text-sm font-bold text-slate-700 mt-1">{{ $settings['layanan_akses_file_laporan'] }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/halaman/'.$settings['layanan_akses_file_laporan']) }}" target="_blank" class="px-6 py-3 bg-[#002b5c] text-white font-black text-sm rounded-xl hover:bg-black transition-all">BUKA FILE</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center mb-10">
                        <i class="fas fa-align-left mr-4 text-[#ffc107]"></i> Ringkasan Eksekutif
                    </h4>
                    <textarea name="ringkasan_eksekutif" class="tinymce-editor">{{ $settings['layanan_akses_ringkasan_eksekutif'] ?? '' }}</textarea>
                </div>
                </div>

                <!-- SIDEBAR CONFIG (NOW MOVED BELOW) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-10">
                <div class="bg-emerald-50 rounded-[2.5rem] p-10 border-2 border-emerald-100">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-lg">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="text-xl font-black text-emerald-900 uppercase tracking-widest mb-4">Akses Terjamin</h4>
                    <p class="text-md font-bold text-emerald-800 leading-relaxed">
                        Laporan ini merupakan bagian dari akuntabilitas PPID PKTJ dalam memenuhi hak masyarakat atas informasi publik. Pastikan file dalam format PDF yang optimal (Size < 5MB).
                    </p>
                </div>

                    <button type="submit" class="w-full py-7 bg-[#002b5c] text-white font-black text-lg uppercase tracking-[3px] rounded-[2rem] shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                        <i class="fas fa-save mr-4 text-[#ffc107]"></i> SIMPAN LAPORAN
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'lists link anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignjustify align | link table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 600,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false,
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #002b5c; text-align: justify; }'
    });
</script>
@endsection
