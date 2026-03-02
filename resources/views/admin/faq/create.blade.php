@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-200 via-pink-100 to-purple-200 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-pink-800 drop-shadow-lg">
                ❓ Tambah FAQ Baru
            </h1>
            <p class="text-slate-800 mt-1 font-medium">Kelola pertanyaan dan jawaban yang sering diajukan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.faq.index') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-100 to-red-200 border-2 border-red-400 p-6 shadow-xl">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-red-300/40 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-900 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-800">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
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
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-100 to-green-200 border-2 border-green-400 p-6 shadow-xl">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-300/40 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center animate-pulse shadow-lg">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-900">✅ Berhasil!</h3>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-2xl p-8 border-2 border-pink-300">
        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ==================== JUDUL ==================== -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-600 to-pink-700 text-white flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">Judul FAQ</h2>
                        </div>

                        <!-- Input Judul -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-800 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-pink-600 to-pink-700 text-white flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-heading text-sm"></i>
                                </span>
                                Judul Pertanyaan *
                            </label>
                            <input type="text" name="judul" id="judul" 
                                   value="{{ old('judul') }}" 
                                   placeholder="Masukkan judul pertanyaan FAQ"
                                   required
                                   class="w-full px-6 py-4 text-lg border-2 border-pink-400 rounded-xl focus:ring-4 focus:ring-pink-500/30 focus:border-pink-600 transition-all duration-300 bg-white shadow-md">
                            <p class="text-sm text-slate-700 mt-2 font-medium">
                                <i class="fas fa-info-circle mr-1 text-pink-600"></i>
                                Judul yang jelas dan mudah dipahami
                            </p>
                        </div>
                    </div>

                    <!-- ==================== DESKRIPSI SINGKAT ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-pink-300">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-purple-700 text-white flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">Deskripsi Singkat</h2>
                        </div>

                        <!-- Input Deskripsi Singkat -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-800 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-600 to-purple-700 text-white flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-align-left text-sm"></i>
                                </span>
                                Ringkasan Jawaban *
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                      placeholder="Masukkan ringkasan jawaban (maksimal 200 karakter)"
                                      maxlength="200"
                                      required
                                      class="w-full px-6 py-4 text-lg border-2 border-purple-400 rounded-xl focus:ring-4 focus:ring-purple-500/30 focus:border-purple-600 transition-all duration-300 bg-white shadow-md">{{ old('deskripsi') }}</textarea>
                            <p class="text-sm text-slate-700 mt-2 font-medium">
                                <i class="fas fa-info-circle mr-1 text-purple-600"></i>
                                Ringkasan singkat yang informatif (maksimal 200 karakter)
                            </p>
                        </div>
                    </div>

                    <!-- ==================== KONTEN UTAMA ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-pink-300">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white flex items-center justify-center shadow-lg">
                                <span class="text-lg font-bold">3</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">Konten Utama</h2>
                        </div>

                        <!-- CKEditor untuk Konten Utama -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-800 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 text-white flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Isi Jawaban Lengkap *
                            </label>
                            <textarea name="konten" id="editor" placeholder="Masukkan jawaban lengkap dengan dukungan tabel dan format teks">{{ old('konten') }}</textarea>
                            <p class="text-sm text-slate-700 mt-2 font-medium">
                                <i class="fas fa-info-circle mr-1 text-indigo-600"></i>
                                Jawaban lengkap dengan dukungan tabel, bold, italic, dan format lainnya
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-100 to-purple-100 border-2 border-pink-400 p-6 shadow-xl">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-pink-300/30 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-pink-900">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-pink-600 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-pink-900">Judul:</strong>
                                        <p class="text-pink-800">Jelas, singkat, dan mudah dipahami</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-pink-600 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-pink-900">Deskripsi:</strong>
                                        <p class="text-pink-800">Ringkasan maksimal 200 karakter</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-pink-600 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-pink-900">Konten:</strong>
                                        <p class="text-pink-800">Lengkap dengan tabel dan format</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 border-2 border-blue-400 p-6 shadow-xl">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-300/30 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-900">Tentang FAQ</h3>
                            </div>
                            <p class="text-sm text-blue-800 leading-relaxed">
                                FAQ (Frequently Asked Questions) adalah daftar pertanyaan yang sering diajukan beserta jawabannya untuk membantu pengguna menemukan informasi yang dibutuhkan dengan cepat.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-500 to-green-700 p-4 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">12</p>
                                <p class="text-xs text-white/90 font-medium">Total FAQ</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 p-4 text-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">3</p>
                                <p class="text-xs text-white/90 font-medium">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-200">
                <a href="{{ route('admin.faq.index') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan FAQ
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .catch(error => console.error(error));
    });
</script>

<style>
    .ck-editor__editable { 
        min-height: 300px; 
    }
</style>
</div>
</div>
@endsection
