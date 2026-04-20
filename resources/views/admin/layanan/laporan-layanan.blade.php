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
                Laporan <span class="text-[#004a99]">Layanan Informasi</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Data Realisasi Pelayanan Informasi Publik PPID PKTJ</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest leading-loose">
                <i class="fas fa-arrow-left mr-3"></i> KELUAR
            </a>
            <a href="http://ppid.pktj.ac.id/layanan-informasi/laporan" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> LIHAT PUBLIK
            </a>
        </div>
    </div>

    <form action="{{ route('admin.halaman-custom.store', 'layanan_layanan') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- IDENTITY & HERO -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
            <div class="p-10 space-y-10">
                <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                    <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                        <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                            <i class="fas fa-bullhorn"></i>
                        </span>
                        Konfigurasi Landing Laporan
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Hero Utama</label>
                        <input type="text" name="judul_hero" value="{{ $settings['layanan_layanan_judul_hero'] ?? 'Laporan Pelayanan Informasi' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tagline Kutipan</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['layanan_layanan_tagline_hero'] ?? '' }}"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- LEFT: REPORT UPLOAD -->
            <div class="lg:col-span-2 space-y-10">
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8 mb-10">
                        <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                            <i class="fas fa-file-invoice mr-4 text-[#ffc107]"></i> Unggah File Laporan Berkala
                        </h4>
                    </div>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Periode Pelaporan</label>
                                <input type="text" name="tahun_laporan" value="{{ $settings['layanan_layanan_tahun_laporan'] ?? date('Y') }}"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl text-lg font-black text-[#002b5c]">
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Update Dokumen (PDF)</label>
                                <input type="file" name="file_laporan" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-2xl">
                            </div>
                        </div>

                        @if(isset($settings['layanan_layanan_file_laporan']))
                        <div class="p-8 bg-blue-50 border-2 border-blue-100 rounded-[2rem] flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 bg-white text-red-600 rounded-2xl flex items-center justify-center text-3xl shadow-md">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div>
                                    <p class="text-md font-black text-[#002b5c] uppercase tracking-widest">FILE TERUNGGAH</p>
                                    <p class="text-sm font-bold text-slate-700 mt-1">{{ $settings['layanan_layanan_file_laporan'] }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/halaman/'.$settings['layanan_layanan_file_laporan']) }}" target="_blank" class="px-6 py-3 bg-[#002b5c] text-white font-black text-sm rounded-xl hover:bg-black transition-all">LIHAT DATA</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10">
                    <h4 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center mb-10">
                        <i class="fas fa-edit mr-4 text-[#ffc107]"></i> Catatan Pelayanan Informasi
                    </h4>
                    <textarea name="ringkasan_eksekutif" class="tinymce-editor">{{ $settings['layanan_layanan_ringkasan_eksekutif'] ?? '' }}</textarea>
                </div>
            </div>

            <!-- RIGHT: PREVIEW/INFO -->
            <div class="space-y-10">
                <div class="bg-blue-900 rounded-[2.5rem] p-10 shadow-2xl text-white relative overflow-hidden">
                    <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                    <i class="fas fa-info-circle text-4xl text-[#ffc107] mb-8"></i>
                    <h4 class="text-xl font-black uppercase tracking-widest mb-4">Penting!</h4>
                    <p class="text-md font-medium text-blue-100 leading-relaxed">
                        Laporan ini mencakup seluruh data pelayanan permohonan informasi baik secara online maupun offline. Pastikan data statistik di ringkasan eksekutif akurat.
                    </p>
                </div>

                <button type="submit" class="w-full py-7 bg-[#002b5c] text-white font-black text-lg uppercase tracking-[3px] rounded-[2rem] shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                    <i class="fas fa-check-double mr-4 text-[#ffc107]"></i> SIMPAN DATA LAYANAN
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
