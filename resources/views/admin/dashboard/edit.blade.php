@extends('layouts.app')

@php
    use App\Models\Dashboard;
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-6xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">ðŸŽ¨ Edit Dashboard Publik</h1>
            <p class="text-slate-300 mt-1">Sesuaikan tampilan halaman publik PPID PKTJ</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-slate-300 hover:text-white font-medium">
                Kembali
            </a>
            <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 transition rounded-lg">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-300 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <form action="{{ route('dashboard.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-8">
                
                <!-- Hero Section -->
                <div class="border-b border-slate-600/30 pb-8">
                    <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-home text-sm"></i>
                        </span>
                        Hero Section
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul Utama</label>
                            <input type="text" 
                                   name="hero_title" 
                                   value="{{ old('hero_title', Dashboard::getValue('hero_title', 'Selamat Datang di Portal PPID PKTJ')) }}"
                                   class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="Masukkan judul utama">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Subjudul</label>
                            <input type="text" 
                                   name="hero_subtitle" 
                                   value="{{ old('hero_subtitle', Dashboard::getValue('hero_subtitle', 'Layanan Informasi Publik Terintegrasi dan Transparan')) }}"
                                   class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="Masukkan subjudul">
                        </div>
                    </div>
                </div>

                <!-- Warna Tema -->
                <div class="border-b border-slate-600/30 pb-8">
                    <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-palette text-sm"></i>
                        </span>
                        Warna Tema
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Warna Primer</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" 
                                       name="primary_color" 
                                       value="{{ old('primary_color', Dashboard::getValue('primary_color', '#1a3a52')) }}"
                                       class="h-10 w-20 border border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded cursor-pointer">
                                <input type="text" 
                                       name="primary_color_text" 
                                       value="{{ old('primary_color_text', Dashboard::getValue('primary_color', '#1a3a52')) }}"
                                       class="flex-1 px-3 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg text-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="#1a3a52">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Warna Sekunder</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" 
                                       name="secondary_color" 
                                       value="{{ old('secondary_color', Dashboard::getValue('secondary_color', '#d4af37')) }}"
                                       class="h-10 w-20 border border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded cursor-pointer">
                                <input type="text" 
                                       name="secondary_color_text" 
                                       value="{{ old('secondary_color_text', Dashboard::getValue('secondary_color', '#d4af37')) }}"
                                       class="flex-1 px-3 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg text-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="#d4af37">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Warna Background</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" 
                                       name="bg_color" 
                                       value="{{ old('bg_color', Dashboard::getValue('bg_color', '#f8f9fa')) }}"
                                       class="h-10 w-20 border border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded cursor-pointer">
                                <input type="text" 
                                       name="bg_color_text" 
                                       value="{{ old('bg_color_text', Dashboard::getValue('bg_color', '#f8f9fa')) }}"
                                       class="flex-1 px-3 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg text-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="#f8f9fa">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Section -->
                <div class="border-b border-slate-600/30 pb-8">
                    <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-video text-sm"></i>
                        </span>
                        Video Layanan
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">URL Video YouTube</label>
                            <input type="url" 
                                   name="video_url" 
                                   value="{{ old('video_url', Dashboard::getValue('video_url', 'https://www.youtube.com/embed/dQw4w9WgXcQ')) }}"
                                   class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="https://www.youtube.com/embed/VIDEO_ID">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul Video</label>
                            <input type="text" 
                                   name="video_title" 
                                   value="{{ old('video_title', Dashboard::getValue('video_title', 'Video Layanan Informasi')) }}"
                                   class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="Masukkan judul video">
                        </div>
                    </div>
                </div>

                <!-- Aplikasi Terkait -->
                <div class="pb-8">
                    <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-link text-sm"></i>
                        </span>
                        Aplikasi Terkait
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">E-PPID Kemenhub</label>
                                <input type="url" 
                                       name="app_eppid" 
                                       value="{{ old('app_eppid', Dashboard::getValue('app_eppid', 'https://ppid.dephub.go.id')) }}"
                                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="https://ppid.dephub.go.id">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">LPSE PKTJ</label>
                                <input type="url" 
                                       name="app_lpse" 
                                       value="{{ old('app_lpse', Dashboard::getValue('app_lpse', '#')) }}"
                                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="URL LPSE PKTJ">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">JDIH PKTJ</label>
                                <input type="url" 
                                       name="app_jdih" 
                                       value="{{ old('app_jdih', Dashboard::getValue('app_jdih', '#')) }}"
                                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="URL JDIH PKTJ">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Sistem Informasi PKTJ</label>
                                <input type="url" 
                                       name="app_sistem" 
                                       value="{{ old('app_sistem', Dashboard::getValue('app_sistem', '#')) }}"
                                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                       placeholder="URL Sistem Informasi PKTJ">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PPID Info -->
                <div>
                    <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-sm"></i>
                        </span>
                        Informasi PPID
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama PPID</label>
                            <input type="text" 
                                   name="ppid_nama" 
                                   value="{{ old('ppid_nama', Dashboard::getValue('ppid_nama', 'PPID Pelaksana')) }}"
                                   class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="PPID Pelaksana">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi PPID</label>
                            <textarea name="ppid_deskripsi" 
                                      rows="2"
                                      class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-cyan-500 focus:ring-cyan-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                      placeholder="Politeknik Keselamatan Transportasi Jalan Tegal">{{ old('ppid_deskripsi', Dashboard::getValue('ppid_deskripsi', 'Politeknik Keselamatan Transportasi Jalan Tegal')) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 text-slate-300 hover:text-white font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 transition rounded-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
