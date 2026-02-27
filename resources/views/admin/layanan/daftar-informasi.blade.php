@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600">
                📋 Daftar Informasi Publik
            </h1>
            <p class="text-slate-500 mt-1">Kelola daftar lengkap informasi yang tersedia untuk publik</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/daftar-informasi-publik', '_blank')" class="px-6 py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
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
            <div class="text-purple-500 text-6xl mb-4">
                <i class="fas fa-list-alt"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Daftar Informasi Publik</h2>
            <p class="text-gray-600 mb-6">Belum ada daftar informasi publik yang tersedia saat ini.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="inline-flex items-center px-6 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">
                    <i class="fas fa-plus mr-2"></i>Upload Informasi Pertama
                </a>
                <button type="button" onclick="window.open('/daftar-informasi-publik', '_blank')" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    <i class="fas fa-eye mr-2"></i>Lihat Halaman Publik
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
