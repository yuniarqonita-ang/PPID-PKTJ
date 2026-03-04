@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    ✏️ Edit {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}
                </h1>
                <p class="text-slate-600 mt-2">Edit konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} yang akan ditampilkan di halaman publik</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.profil.index') }}" 
                   class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <a href="{{ url('/profil/' . $type) }}" target="_blank" 
                   class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                    <i class="fas fa-eye mr-2"></i>Lihat Publik
                </a>
            </div>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-300 rounded-2xl p-6 mb-6 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-red-800">Ada kesalahan!</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="p-8">
                
                <!-- ==================== INFORMASI UTAMA ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Informasi Utama</h2>
                            <p class="text-slate-600">Data dasar {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl p-6 border border-slate-200">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-heading text-sm"></i>
                                    </span>
                                    Judul {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} *
                                </label>
                                <input type="text" 
                                       name="judul" 
                                       value="{{ old('judul', $profil->judul) }}"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                                       placeholder="Masukkan judul {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }}"
                                       required>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-toggle-on text-sm"></i>
                                    </span>
                                    Status Publikasi
                                </label>
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="status" value="1" {{ old('status', $profil->status) == '1' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-green-600 font-medium">Aktif</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="status" value="0" {{ old('status', $profil->status) == '0' ? 'checked' : '' }} class="mr-2">
                                        <span class="text-red-600 font-medium">Tidak Aktif</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-image text-sm"></i>
                                    </span>
                                    Gambar (Opsional)
                                </label>
                                <input type="file" 
                                       name="gambar" 
                                       accept="image/*"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                @if($profil->gambar)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $profil->gambar) }}" alt="Current image" class="h-20 rounded-lg shadow-sm">
                                        <p class="text-xs text-slate-500 mt-1">Gambar saat ini</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($profil->konten)
                <!-- ==================== CURRENT CONTENT ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Konten Saat Ini</h2>
                            <p class="text-slate-600">Preview konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} yang sedang aktif</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-200">
                        <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner p-6">
                            <div class="prose prose-lg max-w-none">
                                {!! $profil->konten !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ==================== KONTEN SECTION ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Konten Lengkap</h2>
                            <p class="text-slate-600">Tulis konten {{ $type === 'profil' ? 'Profil PPID' : ($type === 'tugas' ? 'Tugas dan Tanggung Jawab PPID' : ($type === 'visi' ? 'Visi dan Misi PPID' : ($type === 'struktur' ? 'Struktur Organisasi' : ($type === 'regulasi' ? 'Regulasi' : 'Kontak')))) }} dengan format lengkap</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-200">
                        <div class="bg-white rounded-xl border-2 border-slate-200 shadow-inner">
                            <textarea id="editor" 
                                      name="konten" 
                                      class="w-full p-6 border-0 outline-none resize-none" 
                                      style="min-height: 400px;"
                                      placeholder="Tulis konten di sini...">{{ old('konten', $profil->konten) }}</textarea>
                        </div>
                        <p class="text-sm text-slate-600 mt-3">
                            <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
                            Gunakan formatting lengkap (bold, italic, list, tabel, alignment, dll)
                        </p>
                    </div>
                </div>

            </div>

            <!-- ==================== ACTION BUTTONS ==================== -->
            <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-8 py-6 border-t border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-600">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Perubahan akan langsung tersimpan dan ditampilkan di halaman publik
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.profil.index') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    </div>
</div>

<!-- Summernote Editor Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<style>
/* Custom CSS for Summernote */
.note-editor .note-editable ol {
    list-style-type: decimal;
    padding-left: 20px;
}
.note-editor .note-editable ol li {
    margin-bottom: 5px;
}
.note-editor .note-editable ul {
    list-style-type: disc;
    padding-left: 20px;
}
.note-editor .note-editable ul li {
    margin-bottom: 5px;
}
</style>
<script>
$(document).ready(function() {
    // Initialize Summernote with complete toolbar
    $('#editor').summernote({
        height: 400,
        placeholder: 'Tulis konten di sini...',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ],
        styleTags: [
            'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
        ],
        fontNames: [
            'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
            'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande',
            'Tahoma', 'Times New Roman', 'Verdana'
        ],
        callbacks: {
            onImageUpload: function(files) {
                for (var i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            }
        }
    });
});

function uploadImage(file) {
    var formData = new FormData();
    formData.append('image', file);
    
    $.ajax({
        url: '/upload-image',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#editor').summernote('insertImage', response.url);
        },
        error: function() {
            alert('Gagal mengupload gambar');
        }
    });
}
</script>
@endsection
