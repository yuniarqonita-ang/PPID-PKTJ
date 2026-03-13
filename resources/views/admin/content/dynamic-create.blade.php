@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-8">
    <div class="max-w-7xl mx-auto">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    ✏️ Kelola Konten Dinamis
                </h1>
                <p class="text-slate-600 mt-2">Buat konten dengan beberapa bagian yang dapat ditambahkan secara dinamis</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" target="_blank"
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

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-6 mb-6 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-green-800">Berhasil!</h3>
                    <div class="mt-2 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="p-8">

                <!-- ==================== MAIN INFO ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Informasi Utama</h2>
                            <p class="text-slate-600">Informasi dasar konten</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl p-6 border border-slate-200">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Judul Utama -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-heading text-sm"></i>
                                    </span>
                                    Judul Utama *
                                </label>
                                <input type="text" name="judul_utama" value="{{ old('judul_utama') }}"
                                       class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm"
                                       placeholder="Masukkan judul utama" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="lg:col-span-2">
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-align-left text-sm"></i>
                                    </span>
                                    Deskripsi Singkat *
                                </label>
                                <textarea name="deskripsi" rows="3"
                                          class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 bg-white shadow-sm"
                                          placeholder="Masukkan deskripsi singkat konten" required>{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ==================== DYNAMIC SECTIONS ==================== -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-layer-group text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-slate-800">Bagian Konten</h2>
                                <p class="text-slate-600">Tambahkan beberapa bagian konten</p>
                            </div>
                        </div>
                        <button type="button" onclick="addSection()"
                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center">
                            <i class="fas fa-plus mr-2"></i>Tambah Bagian
                        </button>
                    </div>

                    <div id="sections-container" class="space-y-6">
                        <!-- Initial section if no data -->
                        <div class="section-item bg-gradient-to-r from-slate-50 to-purple-50 rounded-xl p-6 border border-slate-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm">
                                        1
                                    </span>
                                    Bagian 1
                                </h3>
                                <button type="button" onclick="removeSection(this)"
                                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-lg hover:shadow-md transition-all duration-300 transform hover:scale-105 flex items-center text-sm">
                                    <i class="fas fa-trash mr-2"></i>Hapus
                                </button>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Judul Bagian -->
                                <div class="lg:col-span-2">
                                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                        <span class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-heading text-sm"></i>
                                        </span>
                                        Judul Bagian *
                                    </label>
                                    <input type="text" name="sections[0][judul]" value="{{ old('sections.0.judul') }}"
                                           class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white shadow-sm"
                                           placeholder="Masukkan judul bagian" required>
                                </div>

                                <!-- Konten Bagian -->
                                <div class="lg:col-span-2">
                                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                        <span class="w-8 h-8 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-align-justify text-sm"></i>
                                        </span>
                                        Konten Bagian *
                                    </label>
                                    <div id="summernote-section-0">
                                        <textarea name="sections[0][konten]" rows="6" class="summernote-editor"
                                                  placeholder="Tulis konten bagian ini..." required>{{ old('sections.0.konten') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ==================== PUBLISH SETTINGS ==================== -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-cog text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Pengaturan Publikasi</h2>
                            <p class="text-slate-600">Atur status dan pengaturan publikasi</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-slate-50 to-green-50 rounded-xl p-6 border border-slate-200">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Status -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg flex items-center justify-center mr-3">
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

                            <!-- Kategori -->
                            <div>
                                <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-tag text-sm"></i>
                                    </span>
                                    Kategori
                                </label>
                                <select name="kategori" class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm">
                                    <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="berita" {{ old('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="informasi" {{ old('kategori') == 'informasi' ? 'selected' : '' }}>Informasi</option>
                                    <option value="layanan" {{ old('kategori') == 'layanan' ? 'selected' : '' }}>Layanan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ==================== ACTION BUTTONS ==================== -->
            <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-8 py-6 border-t border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-600">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Konten akan tersimpan sebagai beberapa bagian yang dapat ditampilkan di halaman publik
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-6 py-3 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 rounded-xl flex items-center">
                            <i class="fas fa-save mr-2"></i>Simpan Konten
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Summernote JS & CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')
<script>
let sectionCount = 1;

function addSection() {
    const container = document.getElementById('sections-container');
    const sectionIndex = sectionCount;

    const sectionHTML = `
        <div class="section-item bg-gradient-to-r from-slate-50 to-purple-50 rounded-xl p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                    <span class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm">
                        ${sectionCount + 1}
                    </span>
                    Bagian ${sectionCount + 1}
                </h3>
                <button type="button" onclick="removeSection(this)"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-lg hover:shadow-md transition-all duration-300 transform hover:scale-105 flex items-center text-sm">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Judul Bagian -->
                <div class="lg:col-span-2">
                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-heading text-sm"></i>
                        </span>
                        Judul Bagian *
                    </label>
                    <input type="text" name="sections[${sectionIndex}][judul]" value=""
                           class="w-full px-6 py-4 text-lg border-2 border-slate-300 rounded-xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white shadow-sm"
                           placeholder="Masukkan judul bagian" required>
                </div>

                <!-- Konten Bagian -->
                <div class="lg:col-span-2">
                    <label class="block text-lg font-bold text-slate-700 mb-3 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-align-justify text-sm"></i>
                        </span>
                        Konten Bagian *
                    </label>
                    <div id="summernote-section-${sectionIndex}">
                        <textarea name="sections[${sectionIndex}][konten]" rows="6" class="summernote-editor"
                                  placeholder="Tulis konten bagian ini..." required></textarea>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', sectionHTML);
    sectionCount++;

    // Initialize Summernote for the new section
    setTimeout(() => {
        initializeSummernote(sectionIndex);
        updateSectionNumbers();
    }, 100);
}

function removeSection(button) {
    const sectionItem = button.closest('.section-item');
    sectionItem.remove();
    sectionCount--;
    updateSectionNumbers();
}

function updateSectionNumbers() {
    const sections = document.querySelectorAll('.section-item');
    sections.forEach((section, index) => {
        const numberSpan = section.querySelector('span');
        const title = section.querySelector('h3');
        if (numberSpan && title) {
            numberSpan.textContent = index + 1;
            title.innerHTML = title.innerHTML.replace(/Bagian \d+/, `Bagian ${index + 1}`);
        }
    });
}

function initializeSummernote(index) {
    $(`#summernote-section-${index} textarea`).summernote({
        height: 300,
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
                        $(`#summernote-section-${index} textarea`).summernote('insertImage', response.url);
                    },
                    error: function() {
                        alert('Gagal mengupload gambar');
                    }
                });
            }
        }
    });
}

// Initialize first Summernote editor
$(document).ready(function() {
    initializeSummernote(0);
});
</script>
@endpush

@endsection
