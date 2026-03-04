@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    📋 Kelola Konten Profil PPID
                </h1>
                <p class="text-slate-600 mt-2">Kelola semua konten profil PPID dan informasi publik dalam satu tempat</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" 
                   class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-6 mb-6 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-green-800 font-bold text-lg">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== CONTENT CARDS ==================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Profil PPID -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-blue-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-user-tie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Profil PPID</h3>
                        <p class="text-blue-100 text-sm">Informasi utama PPID</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['profil']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['profil']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['profil']->updated_at ? $profilesData['profil']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/profil') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'profil') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Tugas & Tanggung Jawab -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-yellow-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-tasks text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Tugas PPID</h3>
                        <p class="text-yellow-100 text-sm">Fungsi PPID</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['tugas']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['tugas']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['tugas']->updated_at ? $profilesData['tugas']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/tugas') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'tugas') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-green-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-lightbulb text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Visi dan Misi</h3>
                        <p class="text-green-100 text-sm">Tujuan dan arah PPID</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['visi']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['visi']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['visi']->updated_at ? $profilesData['visi']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/visi') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'visi') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-red-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-red-500 to-pink-500 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-sitemap text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Struktur Organisasi</h3>
                        <p class="text-red-100 text-sm">Hierarki PPID PKTJ</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['struktur']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['struktur']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['struktur']->updated_at ? $profilesData['struktur']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/struktur') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'struktur') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Regulasi -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-purple-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-file-contract text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Regulasi</h3>
                        <p class="text-purple-100 text-sm">Aturan dan kebijakan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['regulasi']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['regulasi']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['regulasi']->updated_at ? $profilesData['regulasi']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/regulasi') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'regulasi') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-cyan-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Kontak</h3>
                        <p class="text-cyan-100 text-sm">Hubungi PPID</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-2">Status Konten</p>
                    @if($profilesData['kontak']->judul)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-300">
                            <i class="fas fa-check-circle mr-1"></i>Konten Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-300">
                            <i class="fas fa-times-circle mr-1"></i>Belum Ada Konten
                        </span>
                    @endif
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Judul</p>
                    <p class="text-slate-800 font-medium">
                        {{ $profilesData['kontak']->judul ?: 'Belum ada judul' }}
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-slate-600 text-sm mb-1">Terakhir Update</p>
                    <p class="text-slate-800 text-sm">
                        {{ $profilesData['kontak']->updated_at ? $profilesData['kontak']->updated_at->format('d M Y, H:i') : 'Belum pernah' }}
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/profil/kontak') }}" target="_blank" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    <a href="{{ route('admin.profil.edit', 'kontak') }}" 
                       class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ==================== SUMMARY SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-3">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <p class="text-2xl font-black text-slate-800">
                        {{ collect($profilesData)->filter(function($item) { return $item->judul; })->count() }}
                    </p>
                    <p class="text-sm text-slate-600 font-medium">Konten Aktif</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl flex items-center justify-center mb-3">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                    <p class="text-2xl font-black text-orange-600">
                        {{ collect($profilesData)->filter(function($item) { return !$item->judul; })->count() }}
                    </p>
                    <p class="text-sm text-slate-600 font-medium">Belum Diisi</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-3">
                        <i class="fas fa-folder text-white text-2xl"></i>
                    </div>
                    <p class="text-2xl font-black text-blue-600">6</p>
                    <p class="text-sm text-slate-600 font-medium">Total Kategori</p>
                </div>
            </div>
            <div class="text-slate-600">
                <i class="fas fa-info-circle mr-2"></i>
                Klik tombol Edit untuk mengubah konten
            </div>
        </div>
    </div>
</div>
@endsection