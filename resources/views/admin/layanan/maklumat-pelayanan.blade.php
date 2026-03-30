@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                📋 Maklumat Pelayanan dan Standar Biaya
            </h1>
            <p class="text-slate-400 mt-1">Kelola maklumat pelayanan dan standar biaya informasi publik</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
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
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm border border-slate-600/30 p-8">
        <form action="{{ route('admin.halaman-custom.store', 'maklumat') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ==================== MAKLUMAT PELAYANAN SECTION ==================== -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-200">Maklumat Pelayanan</h2>
                        </div>

                        <!-- Judul Maklumat -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-heading text-sm"></i>
                                </span>
                                Judul Maklumat *
                            </label>
                            <input type="text" name="judul_maklumat" id="judul_maklumat" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:border-cyan-500 focus:ring-cyan-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="Masukkan judul maklumat pelayanan..." value="{{ $settings['maklumat_judul_maklumat'] ?? '' }}" required>
                        </div>

                        <!-- Isi Maklumat dengan CKEditor -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Isi Maklumat *
                            </label>
                            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
                                <textarea id="editor_maklumat" name="isi_maklumat" class="w-full p-6 border-0 outline-none resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" style="min-height: 300px;" required>
{!! $settings['maklumat_isi_maklumat'] ?? 'Tuliskan maklumat pelayanan informasi publik secara lengkap dan jelas...' !!}
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan maklumat pelayanan secara detail dan mudah dipahami
                            </p>
                        </div>

                        <!-- Gambar Maklumat -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-sm"></i>
                                </span>
                                Gambar Maklumat
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_maklumat" id="gambar_maklumat" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-400 hover:file:bg-green-100"
                                       accept="image/*">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Format: JPG, PNG, GIF (Opsional)
                            </p>
                        </div>
                    </div>

                    <!-- ==================== STANDAR BIAYA SECTION ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-600/30">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-200">Standar Biaya</h2>
                        </div>

                        <!-- Judul Standar Biaya -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-heading text-sm"></i>
                                </span>
                                Judul Standar Biaya *
                            </label>
                            <input type="text" name="judul_standar" id="judul_standar" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                                   placeholder="Masukkan judul standar biaya..." value="{{ $settings['maklumat_judul_standar'] ?? '' }}" required>
                        </div>

                        <!-- Isi Standar Biaya dengan CKEditor -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Isi Standar Biaya *
                            </label>
                            <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
                                <textarea id="editor_standar" name="isi_standar" class="w-full p-6 border-0 outline-none resize-none bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" style="min-height: 300px;" required>
{!! $settings['maklumat_isi_standar'] ?? 'Tuliskan standar biaya pelayanan informasi publik secara lengkap...' !!}
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan standar biaya secara detail dan transparan
                            </p>
                        </div>

                        <!-- Gambar Standar Biaya -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-sm"></i>
                                </span>
                                Gambar Standar Biaya
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_standar" id="gambar_standar" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-500/50 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                       accept="image/*">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-400 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Format: JPG, PNG, GIF (Opsional)
                            </p>
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
                                <h3 class="text-lg font-bold text-orange-300">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Maklumat:</strong>
                                        <p class="text-orange-400">Judul dan isi maklumat pelayanan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Standar Biaya:</strong>
                                        <p class="text-orange-400">Judul dan isi standar biaya</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-300">Gambar:</strong>
                                        <p class="text-orange-400">Dokumentasi pendukung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-900/20 to-indigo-900/20 border border-blue-600/30 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-300">Tentang Maklumat Pelayanan</h3>
                            </div>
                            <p class="text-sm text-blue-400 leading-relaxed">
                                Maklumat Pelayanan dan Standar Biaya adalah informasi wajib yang disediakan untuk memberikan transparansi tentang layanan dan biaya yang berlaku sesuai peraturan perundang-undangan.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">2</p>
                                <p class="text-xs text-white/80">Maklumat</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">3</p>
                                <p class="text-xs text-white/80">Standar Biaya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-600/30">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote for Maklumat
            $('#editor_maklumat').summernote({
                height: 300,
                placeholder: 'Tuliskan maklumat pelayanan informasi publik secara lengkap dan jelas...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
            
            // Initialize Summernote for Standar Biaya
            $('#editor_standar').summernote({
                height: 300,
                placeholder: 'Tuliskan standar biaya pelayanan informasi publik secara lengkap dan jelas...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
        });
    </script>

<style>
    .form-control.form-editor {
        min-height: 250px;
    }
    .display-5 {
        font-size: 2rem;
        font-weight: 600;
    }
    .ck-editor__editable { min-height: 250px; }
</style>
</div>
</div>
@endsection
