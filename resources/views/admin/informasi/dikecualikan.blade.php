@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-shield-alt mr-2 text-[#ffc107]"></i> Informasi Dikecualikan
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola daftar informasi yang bersifat rahasia dan dibatasi sesuai regulasi</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/informasi-dikecualikan') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2"></i> Lihat Publik
                </a>
                <a href="{{ route('admin.informasi.dikecualikan.create') }}" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                    <i class="fas fa-plus mr-2 text-[#ffc107]"></i> Unggah Data
                </a>
            </div>
        </div>

        <!-- HERO CONFIGURATION -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
            <div class="p-8">
                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                    <i class="fas fa-window-maximize mr-3 text-[#ffc107]"></i> Konfigurasi Hero Banner
                </h3>
                <form action="{{ route('admin.halaman-custom.store', 'informasi_dikecualikan') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Hero</label>
                        <input type="text" name="judul_hero" value="{{ $settings['informasi_dikecualikan_judul_hero'] ?? 'Informasi Dikecualikan' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline Hero</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['informasi_dikecualikan_tagline_hero'] ?? 'Informasi yang tidak dapat dibuka untuk umum berdasarkan pengujian konsekuensi' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>

                    <!-- Judul Daftar Section -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Section Daftar</label>
                        <input type="text" name="judul_daftar" value="{{ $settings['informasi_dikecualikan_judul_daftar'] ?? 'Daftar Informasi Dikecualikan' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Section Daftar</label>
                        <input type="text" name="deskripsi_daftar" value="{{ $settings['informasi_dikecualikan_deskripsi_daftar'] ?? 'Berikut adalah daftar informasi yang dikategorikan sebagai rahasia/dikecualikan sesuai peraturan perundang-undangan.' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest">
                            SIMPAN KONFIGURASI HALAMAN
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT (SECURE PANEL) -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden text-center border-t-4 border-red-500">
            <div class="p-10 md:p-20 space-y-8">
                <div class="relative inline-block">
                    <div class="w-32 h-32 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-5xl shadow-inner relative z-10">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="absolute inset-0 bg-red-500 rounded-full blur-2xl opacity-20 animate-pulse"></div>
                </div>
                
                <div class="max-w-md mx-auto space-y-4">
                    <h2 class="text-2xl font-black text-[#004a99] uppercase tracking-wide">Area Keamanan Terbatas</h2>
                    <p class="text-gray-500 font-medium leading-relaxed">
                        Dokumen yang diunggah di sini adalah informasi yang telah melalui uji konsekuensi dan dinyatakan <strong>Dikecualikan</strong> karena alasan keamanan negara atau privasi.
                    </p>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('admin.informasi.dikecualikan.create') }}" class="px-10 py-4 bg-red-500 text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-red-500/20 hover:bg-red-600 transition-all transform hover:scale-105">
                        Unggah Dokumen <i class="fas fa-upload ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- SECURITY NOTICE FOOTER -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex items-center justify-center gap-3 text-gray-400">
                <i class="fas fa-user-shield text-lg"></i>
                <p class="text-[10px] font-black uppercase tracking-[0.2em]">Hanya diakses oleh administrator berwenang</p>
            </div>
        </div>

    </div>
</div>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
