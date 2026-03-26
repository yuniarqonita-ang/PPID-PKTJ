@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                📰 Tambah Berita Baru
            </h1>
            <p class="text-slate-500 mt-1">Buat berita baru untuk website PPID PKTJ</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-50 to-red-100 border-2 border-red-200 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-800 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-700">
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
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-50 to-green-100 border-2 border-green-200 p-6 shadow-lg">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-200/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-800">✅ Berhasil!</h3>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-xl p-8 border border-slate-200">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Judul Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-heading text-sm"></i>
                            </span>
                            Judul Berita *
                        </label>
                        <input type="text" name="judul" id="judul" 
                               value="{{ old('judul') }}"
                               class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                               placeholder="Masukkan judul berita yang menarik" required>
                    </div>

                    <!-- Konten Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-align-justify text-sm"></i>
                            </span>
                            Konten Berita *
                        </label>
                        <div id="summernote-konten">
                            <textarea name="konten" 
                                      rows="12"
                                      class="summernote-editor"
                                      placeholder="Tulis konten berita lengkap di sini..."
                                      required>{{ old('konten') }}</textarea>
                        </div>
                        <p class="text-sm text-slate-500 mt-2">Gunakan formatting lengkap untuk berita yang menarik</p>
                    </div>

                    <!-- Gambar Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-image text-sm"></i>
                            </span>
                            Gambar Utama (Opsional)
                        </label>
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar" 
                                   accept="image/*"
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                Max 5MB
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 mt-2">
                            <i class="fas fa-image mr-1"></i>
                            Format: JPG, PNG, GIF, WEBP
                        </p>
                    </div>

                    <!-- Status Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                <i class="fas fa-eye text-sm"></i>
                            </span>
                            Status Publikasi
                        </label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="draft" class="mr-2" {{ old('status') == 'draft' ? 'checked' : '' }}>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Draft</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="published" class="mr-2" {{ old('status') == 'published' ? 'checked' : 'checked' }}>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Terbit</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-yellow-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-orange-800">Panduan Penulisan</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Judul:</strong>
                                        <p class="text-orange-700">Menarik, jelas, dan mengandung keyword</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Konten:</strong>
                                        <p class="text-orange-700">Informatif, terstruktur, dan mudah dibaca</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Gambar:</strong>
                                        <p class="text-orange-700">Berkualitas tinggi dan relevan dengan konten</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Status:</strong>
                                        <p class="text-orange-700">Draft untuk review, Terbit untuk publikasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-800">Tentang Berita</h3>
                            </div>
                            <p class="text-sm text-blue-700 leading-relaxed">
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
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-200">
                <a href="{{ route('admin.berita.index') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Summernote for konten
    $('#summernote-konten textarea').summernote({
        height: 400,
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                var file = files[0];
                var formData = new FormData();
                formData.append('image', file);
                
                $.ajax({
                    url: '{{ route("admin.upload.image") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#summernote-konten textarea').summernote('insertImage', response.url);
                    },
                    error: function() {
                        alert('Gagal mengupload gambar');
                    }
                });
            }
        }
    });
});
</script>
@endpush

@endsection
