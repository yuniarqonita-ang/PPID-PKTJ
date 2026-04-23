@extends('layouts.app')

    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] drop-shadow-lg">
                📅 Informasi Berkala
            </h1>
            <p class="text-gray-500 mt-1">Kelola informasi yang disampaikan secara berkala kepada masyarakat</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-[#004a99] font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-900/20 to-red-900/30 border border-red-600/30 p-6 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-[#004a99] flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-300 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-400">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-900/20 to-green-900/30 border border-green-600/30 p-6 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-[#004a99] flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-300">✅ Berhasil!</h3>
                        <p class="text-green-400">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="space-y-8">
        <!-- HERO CONFIGURATION -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-l-8 border-[#ffc107]">
            <div class="p-8">
                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                    <i class="fas fa-window-maximize mr-3 text-[#ffc107]"></i> Konfigurasi Hero Banner
                </h3>
                <form action="{{ route('admin.halaman-custom.store', 'informasi_berkala') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Hero</label>
                        <input type="text" name="judul_hero" value="{{ $settings['informasi_berkala_judul_hero'] ?? 'Informasi Berkala' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tagline Hero</label>
                        <input type="text" name="tagline_hero" value="{{ $settings['informasi_berkala_tagline_hero'] ?? 'Informasi yang wajib disediakan dan diumumkan secara berkala' }}"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-gray-800 font-bold focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all uppercase">
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-[#004a99] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-500/20 transform hover:scale-105 transition-all tracking-widest">
                            SIMPAN KONFIGURASI HERO
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- LIST DATA (Existing logic or placeholder for management) -->
        <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative p-8">
            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center mb-6">
                <i class="fas fa-plus-circle mr-3 text-[#ffc107]"></i> Tambah Data Informasi Berkala
            </h3>
            <form action="{{ route('admin.informasi.berkala.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Judul Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-[#004a99] flex items-center justify-center mr-3">
                                <i class="fas fa-heading text-sm"></i>
                            </span>
                            Judul Informasi
                        </label>
                        <input type="text" name="judul" id="judul" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl bg-slate-900/60 text-[#004a99] placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               placeholder="Contoh: Laporan Kinerja Tahunan 2024" required>
                    </div>

                    <!-- Konten Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-[#004a99] flex items-center justify-center mr-3">
                                <i class="fas fa-align-justify text-sm"></i>
                            </span>
                            Konten Lengkap *
                        </label>
                        <textarea id="editor_berkala_index" name="konten" class="summernote-editor" required>{{ old('konten', '') }}</textarea>
                    </div>

                    <!-- Tanggal Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-[#004a99] flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-sm"></i>
                            </span>
                            Tanggal Publikasi
                        </label>
                        <input type="date" name="tanggal" id="tanggal" 
                               class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl bg-slate-900/60 text-[#004a99]"
                               required>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group p-6 rounded-2xl bg-white/50 border border-slate-600/30">
                        <h3 class="text-lg font-bold text-orange-300 mb-4 flex items-center">
                            <i class="fas fa-lightbulb mr-2"></i> Panduan
                        </h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Pastikan informasi yang diunggah valid dan bermanfaat bagi publik.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t border-gray-200">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gray-50 border border-gray-100 text-[#004a99] font-bold opacity-70 hover:opacity-100">
                    Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-[#004a99] font-bold">
                    Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

