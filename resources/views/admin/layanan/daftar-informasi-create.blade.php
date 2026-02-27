@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600">
                Upload Daftar Informasi Publik
            </h1>
            <p class="text-slate-500 mt-1">Kelola daftar informasi publik yang tersedia</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/daftar-informasi-publik', '_blank')" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('layanan.daftar-informasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- JUDUL INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading text-purple-500 mr-2"></i>Judul Informasi *
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                       placeholder="Masukkan judul informasi publik" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KATEGORI INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-folder text-purple-500 mr-2"></i>Kategori Informasi *
                </label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Pilih Kategori</option>
                    <option value="informasi-berkala">Informasi Berkala</option>
                    <option value="informasi-serta-merta">Informasi Serta Merta</option>
                    <option value="informasi-setiap-saat">Informasi Setiap Saat</option>
                    <option value="informasi-dikecualikan">Informasi Dikecualikan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN HALAMAN PUBLIK -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt text-purple-500 mr-2"></i>Konten Halaman Publik *
                </label>
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <textarea id="editor_content" name="konten" class="custom-editor" 
                              style="width: 100%; height: 400px; border: none;"
                              placeholder="Tuliskan deskripsi lengkap tentang informasi ini..." required>{{ old('konten') }}</textarea>
                </div>
                @error('konten')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FILE INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-upload text-purple-500 mr-2"></i>File Informasi *
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-file-pdf text-6xl"></i>
                    </div>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden" id="fileInput" required>
                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                            class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih File
                    </button>
                    <p class="text-sm text-gray-500 mt-2">Format: PDF, DOC, DOCX, XLS, XLSX (Max: 10MB)</p>
                    <div id="fileName" class="mt-2 text-sm text-green-600 font-medium"></div>
                </div>
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FREKUENSI PEMBARUAN -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-sync text-purple-500 mr-2"></i>Frekuensi Pembaruan
                </label>
                <select name="frekuensi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Pilih Frekuensi</option>
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="triwulan">Triwulan</option>
                    <option value="semester">Semester</option>
                    <option value="tahunan">Tahunan</option>
                    <option value="sesuai-kebutuhan">Sesuai Kebutuhan</option>
                </select>
            </div>

            <!-- KONTAK PERSON -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user text-purple-500 mr-2"></i>Kontak Person
                </label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                       placeholder="Nama dan kontak person">
            </div>

            <!-- FORMAT INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt text-purple-500 mr-2"></i>Format Informasi
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="format[]" value="digital" class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Digital</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="format[]" value="cetak" class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Cetak</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="format[]" value="hardcopy" class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Hard Copy</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="format[]" value="online" class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Online</span>
                    </label>
                </div>
            </div>

            <!-- BIAYA PEROLEHAN -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-money-bill text-purple-500 mr-2"></i>Biaya Perolehan
                </label>
                <input type="text" name="biaya" value="{{ old('biaya') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                       placeholder="Contoh: Gratis, Rp. 5.000, sesuai ketentuan">
            </div>

            <!-- PUBLISH OPTIONS -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-eye text-purple-500 mr-2"></i>Status Publikasi
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} 
                               class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Publikasikan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} 
                               class="mr-2 text-purple-500 focus:ring-purple-500">
                        <span class="text-sm">Draft</span>
                    </label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
                <a href="{{ route('admin.informasi.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/custom-editor-integrated.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="{{ asset('js/custom-editor.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize custom editor
    const textarea = document.getElementById('editor_content');
    if (textarea && typeof CustomEditor !== 'undefined') {
        const editorInstance = new CustomEditor('editor_content');
        window.editor = editorInstance;
    }
    
    // File input handler
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');
    
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            fileName.textContent = 'File selected: ' + e.target.files[0].name;
        } else {
            fileName.textContent = '';
        }
    });
});
</script>
@endsection
