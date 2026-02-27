@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-pink-600">
                🛡️ Informasi Dikecualikan
            </h1>
            <p class="text-slate-500 mt-1">Kelola informasi yang dikecualikan sesuai peraturan</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/informasi-dikecualikan', '_blank')" class="px-6 py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="{{ route('admin.informasi.dikecualikan.create') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Upload Informasi
            </a>
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== CONTENT SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center py-12">
            <div class="text-red-500 text-6xl mb-4">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Informasi Dikecualikan</h2>
            <p class="text-gray-600 mb-6">Belum ada informasi yang dikecualikan saat ini.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.informasi.dikecualikan.create') }}" class="inline-flex items-center px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    <i class="fas fa-plus mr-2"></i>Upload Informasi Pertama
                </a>
                <button type="button" onclick="window.open('/informasi-dikecualikan', '_blank')" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    <i class="fas fa-eye mr-2"></i>Lihat Halaman Publik
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
