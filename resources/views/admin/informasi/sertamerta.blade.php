@extends('layouts.app')

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
                    <i class="fas fa-exclamation-triangle mr-2 text-[#ffc107]"></i> Informasi Serta Merta
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola pengumuman mendesak yang harus segera diketahui publik</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.informasi.sertamerta.create') }}" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                    <i class="fas fa-plus mr-2 text-[#ffc107]"></i> Posting Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-green-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- INFO CARD / PLACEHOLDER (Since this is a management page) -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden p-10 text-center">
            <div class="max-w-md mx-auto space-y-6">
                <div class="w-24 h-24 bg-blue-50 text-[#004a99] rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner">
                    <i class="fas fa-bullhorn animate-bounce"></i>
                </div>
                <h2 class="text-2xl font-black text-[#004a99] uppercase">Kelola Pengumuman Darurat</h2>
                <p class="text-gray-500 font-medium leading-relaxed">
                    Halaman ini digunakan untuk mengelola berita atau pengumuman yang bersifat <strong>Serta Merta</strong> (darurat/penting segera). Pastikan informasi yang diunggah akurat dan mudah dipahami.
                </p>
                <div class="pt-4">
                    <a href="{{ route('admin.informasi.sertamerta.create') }}" class="inline-flex items-center px-10 py-4 bg-[#ffc107] text-[#004a99] font-black uppercase tracking-widest rounded-2xl shadow-lg hover:bg-yellow-400 transition-all transform hover:scale-105">
                        Mulai Posting <i class="fas fa-arrow-right ml-2 text-blue-700"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- RECENT POSTS SECTION (Optional/Future) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-50 grayscale hover:grayscale-0 transition-all">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-xl flex items-center justify-center">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                    <h4 class="text-xs font-black text-gray-400 uppercase">Riwayat Posting</h4>
                    <p class="text-xs font-bold text-gray-300">Belum ada riwayat posting terbaru</p>
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
