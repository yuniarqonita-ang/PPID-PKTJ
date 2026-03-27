@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center bg-slate-800/50 p-6 rounded-2xl ring-1 ring-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📰 Tambah Berita Baru
            </h1>
            <p class="text-cyan-200/80 mt-1 font-semibold">Buat berita baru untuk website PPID PKTJ ✨</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 rounded-xl bg-slate-700/50 text-white font-bold hover:bg-slate-600 transition transform hover:scale-105 ring-1 ring-white/10 shadow-lg backdrop-blur-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-900/20 to-red-900/30 border border-red-600/30 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center">
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
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
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
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8 ring-1 ring-white/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="relative z-10">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Judul Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white flex items-center justify-center mr-3 shadow-lg shadow-cyan-500/20">
                                <i class="fas fa-heading text-sm"></i>
                            </span>
                            Judul Berita *
                        </label>
                        <input type="text" name="judul" id="judul" 
                               value="{{ old('judul') }}"
                               class="w-full px-6 py-4 text-lg border border-slate-600 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-white placeholder-slate-500 transition-all duration-300 shadow-inner bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                               placeholder="Masukkan judul berita yang menarik" required>
                    </div>

                    <!-- Konten Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-align-justify text-sm"></i>
                            </span>
                            Konten Berita *
                        </label>
                        <textarea name="konten" id="editor_berita_create"
                                  class="w-full px-6 py-4 text-lg rounded-xl bg-slate-900/60 border border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                  placeholder="Tulis konten berita lengkap di sini..."
                                  style="min-height: 300px;"
                                  required>{{ old('konten') }}</textarea>
                        <p class="text-sm text-slate-400 mt-2">Gunakan formatting lengkap untuk berita yang menarik</p>
                    </div>

                    <!-- Gambar Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-pink-600 text-white flex items-center justify-center mr-3 shadow-lg shadow-purple-500/20">
                                <i class="fas fa-image text-sm"></i>
                            </span>
                            Gambar Utama (Opsional)
                        </label>
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar" 
                                   accept="image/*"
                                   class="w-full px-6 py-4 text-lg bg-slate-900/50 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-slate-300 transition-all duration-300 shadow-inner file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-500/20 file:text-purple-300 hover:file:bg-purple-500/30">
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                Max 5MB
                            </div>
                        </div>
                        <p class="text-sm text-slate-400 mt-2">
                            <i class="fas fa-image mr-1"></i>
                            Format: JPG, PNG, GIF, WEBP
                        </p>
                    </div>

                    <!-- Status Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-emerald-500 to-teal-600 text-white flex items-center justify-center mr-3 shadow-lg shadow-emerald-500/20">
                                <i class="fas fa-eye text-sm"></i>
                            </span>
                            Status Publikasi
                        </label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="draft" class="mr-2 text-yellow-500 focus:ring-yellow-500 bg-slate-900 border-slate-600" {{ old('status') == 'draft' ? 'checked' : '' }}>
                                <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 rounded-full text-sm font-bold">Draft</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="published" class="mr-2 text-emerald-500 focus:ring-emerald-500 bg-slate-900 border-slate-600" {{ old('status') == 'published' ? 'checked' : 'checked' }}>
                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-sm font-bold">Terbit</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-900/20 to-orange-900/20 border border-yellow-600/30 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-yellow-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-orange-300">Panduan Penulisan</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Judul:</strong>
                                        <p class="text-orange-400">Menarik, jelas, dan mengandung keyword</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Konten:</strong>
                                        <p class="text-orange-400">Informatif, terstruktur, dan mudah dibaca</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Gambar:</strong>
                                        <p class="text-orange-400">Berkualitas tinggi dan relevan dengan konten</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Status:</strong>
                                        <p class="text-orange-400">Draft untuk review, Terbit untuk publikasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-900/20 to-indigo-900/20 border border-blue-600/30 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-300">Tentang Berita</h3>
                            </div>
                            <p class="text-sm text-blue-400 leading-relaxed">
                                Berita adalah informasi terkini yang disampaikan kepada publik untuk memberikan pemahaman tentang kegiatan, kebijakan, atau informasi penting lainnya dari PPID PKTJ.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">24</p>
                                <p class="text-xs text-white/80">Total Berita</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">5</p>
                                <p class="text-xs text-white/80">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t border-slate-700/50">
                <a href="{{ route('admin.berita.index') }}" class="px-8 py-4 rounded-xl bg-slate-700/50 text-slate-300 font-bold hover:bg-slate-600 hover:text-white transition-all duration-300 transform hover:scale-105 ring-1 ring-white/10 shadow-lg">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold hover:from-cyan-400 hover:to-blue-500 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30">
                    <i class="fas fa-save mr-2"></i>Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#editor_berita_create',
            license_key: 'gpl',
            height: 500,
            menubar: false,
            skin: 'oxide-dark',
            content_css: 'dark',
            plugins: [
                'advlist','autolink','lists','link','image','charmap',
                'searchreplace','visualblocks','code','fullscreen',
                'insertdatetime','media','table','help','wordcount'
            ],
            toolbar:
                'undo redo | styles | bold italic underline strikethrough | ' +
                'fontfamily fontsize forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | ' +
                'table link image charmap | removeformat code fullscreen',
            toolbar_mode: 'wrap',
            content_style:
                'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.75; color: #f8fafc; background: transparent; padding: 12px; } ' +
                'table { border-collapse: collapse; width: 100%; } ' +
                'table td, table th { border: 1px solid #ddd; padding: 8px 12px; }' +
                'table th { background: #f1f5f9; font-weight: 600; }'
        });

        document.querySelector('form').addEventListener('submit', function() {
            tinymce.triggerSave();
        });
    });
</script>
@endsection

