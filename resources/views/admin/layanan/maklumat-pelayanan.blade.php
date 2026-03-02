@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                📋 Maklumat Pelayanan dan Standar Biaya
            </h1>
            <p class="text-slate-500 mt-1">Kelola maklumat pelayanan dan standar biaya informasi publik</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition transform hover:scale-105">
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
        <form action="#" method="POST" enctype="multipart/form-data">
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
                            <h2 class="text-2xl font-bold text-slate-800">Maklumat Pelayanan</h2>
                        </div>

                        <!-- Judul Maklumat -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-heading text-sm"></i>
                                </span>
                                Judul Maklumat *
                            </label>
                            <input type="text" name="judul_maklumat" id="judul_maklumat" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                                   placeholder="Masukkan judul maklumat pelayanan..." required>
                        </div>

                        <!-- Isi Maklumat dengan CKEditor -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Isi Maklumat *
                            </label>
                            <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                                <textarea id="editor_maklumat" name="isi_maklumat" class="w-full p-6 border-0 outline-none resize-none" style="min-height: 300px;" required>
Tuliskan maklumat pelayanan informasi publik secara lengkap dan jelas...
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan maklumat pelayanan secara detail dan mudah dipahami
                            </p>
                        </div>

                        <!-- Gambar Maklumat -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-sm"></i>
                                </span>
                                Gambar Maklumat
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_maklumat" id="gambar_maklumat" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                       accept="image/*">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Format: JPG, PNG, GIF (Opsional)
                            </p>
                        </div>
                    </div>

                    <!-- ==================== STANDAR BIAYA SECTION ==================== -->
                    <div class="space-y-6 pt-8 border-t-2 border-slate-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Standar Biaya</h2>
                        </div>

                        <!-- Judul Standar Biaya -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-heading text-sm"></i>
                                </span>
                                Judul Standar Biaya *
                            </label>
                            <input type="text" name="judul_standar" id="judul_standar" 
                                   class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 bg-white shadow-sm"
                                   placeholder="Masukkan judul standar biaya..." required>
                        </div>

                        <!-- Isi Standar Biaya dengan CKEditor -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </span>
                                Isi Standar Biaya *
                            </label>
                            <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                                <textarea id="editor_standar" name="isi_standar" class="w-full p-6 border-0 outline-none resize-none" style="min-height: 300px;" required>
Tuliskan standar biaya pelayanan informasi publik secara lengkap...
                                </textarea>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan standar biaya secara detail dan transparan
                            </p>
                        </div>

                        <!-- Gambar Standar Biaya -->
                        <div class="group">
                            <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-sm"></i>
                                </span>
                                Gambar Standar Biaya
                            </label>
                            <div class="relative">
                                <input type="file" name="gambar_standar" id="gambar_standar" 
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                       accept="image/*">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">
                                    Max 5MB
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Format: JPG, PNG, GIF (Opsional)
                            </p>
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
                                <h3 class="text-lg font-bold text-orange-800">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Maklumat:</strong>
                                        <p class="text-orange-700">Judul dan isi maklumat pelayanan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Standar Biaya:</strong>
                                        <p class="text-orange-700">Judul dan isi standar biaya</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-orange-800">Gambar:</strong>
                                        <p class="text-orange-700">Dokumentasi pendukung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 p-6 shadow-lg">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-blue-200/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-800">Tentang Maklumat Pelayanan</h3>
                            </div>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                Maklumat Pelayanan dan Standar Biaya adalah informasi wajib yang disediakan untuk memberikan transparansi tentang layanan dan biaya yang berlaku sesuai peraturan perundang-undangan.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-400 to-green-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">2</p>
                                <p class="text-xs text-white/80">Maklumat</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/20 rounded-full blur-xl"></div>
                            <div class="relative z-10">
                                <p class="text-2xl font-black">3</p>
                                <p class="text-xs text-white/80">Standar Biaya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t-2 border-slate-200">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor for Maklumat
        ClassicEditor
            .create(document.querySelector('#editor_maklumat'), {
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

        // Initialize CKEditor for Standar Biaya
        ClassicEditor
            .create(document.querySelector('#editor_standar'), {
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
