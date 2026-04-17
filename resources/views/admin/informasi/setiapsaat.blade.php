@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-clipboard-check mr-2 text-[#ffc107]"></i> Informasi Setiap Saat
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola data dan dokumen yang harus selalu tersedia bagi publik</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.informasi.setiapsaat.create') }}" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                    <i class="fas fa-plus mr-2 text-[#ffc107]"></i> Posting Baru
                </a>
            </div>
        </div>

        <!-- HERO CONFIGURATION -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
            <div class="p-8">
                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                    <i class="fas fa-window-maximize mr-3 text-[#ffc107]"></i> Konfigurasi Hero Banner
                </h3>
                <form action="{{ route('admin.halaman-custom.store', 'informasi_setiapsaat') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Hero</label>
                        <input type="text" name="judul_hero" value="{{ $settings['informasi_setiapsaat_judul_hero'] ?? 'Informasi Setiap Saat' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline Hero</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['informasi_setiapsaat_tagline_hero'] ?? 'Informasi yang wajib disediakan dan dapat diakses setiap saat' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>

                    <!-- Judul Daftar Section -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Section Daftar</label>
                        <input type="text" name="judul_daftar" value="{{ $settings['informasi_setiapsaat_judul_daftar'] ?? 'Daftar Informasi Setiap Saat' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Section Daftar</label>
                        <input type="text" name="deskripsi_daftar" value="{{ $settings['informasi_setiapsaat_deskripsi_daftar'] ?? 'Daftar informasi publik yang dapat diakses sewaktu-waktu oleh masyarakat.' }}"
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

        <!-- INFO CARD / PLACEHOLDER -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden p-10 text-center border-t-4 border-[#004a99]">
            <div class="max-w-md mx-auto space-y-6">
                <div class="w-24 h-24 bg-blue-50 text-[#004a99] rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner group hover:scale-110 transition-transform">
                    <i class="fas fa-archive"></i>
                </div>
                <h2 class="text-2xl font-black text-[#004a99] uppercase">Bank Data Informasi</h2>
                <p class="text-gray-500 font-medium leading-relaxed">
                    Halaman ini digunakan untuk mengelola <strong>Informasi Setiap Saat</strong> (Arsip, Profil, SK, dll). Pastikan seluruh dokumen yang diunggah adalah versi terbaru dan telah disahkan.
                </p>
                <div class="pt-4">
                    <a href="{{ route('admin.informasi.setiapsaat.create') }}" class="inline-flex items-center px-10 py-4 bg-[#ffc107] text-[#004a99] font-black uppercase tracking-widest rounded-2xl shadow-lg hover:bg-yellow-400 transition-all transform hover:scale-105">
                        Mulai Posting <i class="fas fa-plus-circle ml-2 text-blue-700"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- GUIDANCE PANEL -->
        <div class="bg-[#004a99] rounded-3xl p-8 text-white shadow-xl flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="flex-1 space-y-3 relative z-10">
                <h3 class="text-lg font-black uppercase flex items-center">
                    <i class="fas fa-lightbulb mr-3 text-[#ffc107]"></i> Standar Penyajian
                </h3>
                <p class="text-xs font-medium text-blue-100 leading-relaxed">
                    Informasi Setiap Saat wajib disediakan dan diumumkan oleh PPID melalui website serta media informasi lainnya tanpa harus ada pemohon informasi. Contoh meliputi: Profil Pimpinan, Laporan Kinerja, dan Regulasi Internal.
                </p>
            </div>
            <div class="shrink-0 relative z-10">
                <div class="px-6 py-4 bg-white/10 border border-white/20 rounded-2xl backdrop-blur-sm">
                    <p class="text-[10px] font-black uppercase tracking-widest text-[#ffc107] mb-1">Status Sistem</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                        <span class="text-sm font-bold">Terhubung Database</span>
                    </div>
                </div>
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
