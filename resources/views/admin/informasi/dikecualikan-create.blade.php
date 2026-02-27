@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-pink-600">
                Upload Informasi Dikecualikan
            </h1>
            <p class="text-slate-500 mt-1">Tambahkan informasi yang dikecualikan sesuai peraturan</p>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="window.open('/informasi-dikecualikan', '_blank')" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </button>
            <a href="{{ route('admin.informasi.dikecualikan') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('informasi.dikecualikan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- JUDUL INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading text-red-500 mr-2"></i>Judul Informasi *
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                       placeholder="Masukkan judul informasi dikecualikan" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DASAR HUKUM -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-gavel text-red-500 mr-2"></i>Dasar Hukum *
                </label>
                <input type="text" name="dasar_hukum" value="{{ old('dasar_hukum') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                       placeholder="Contoh: UU No. 14 Tahun 2008 Pasal 17" required>
                @error('dasar_hukum')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KATEGORI DIKECUALIKAN -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-folder text-red-500 mr-2"></i>Kategori Pengecualian *
                </label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" required>
                    <option value="">Pilih Kategori</option>
                    <option value="keamanan-negara">Keamanan Negara</option>
                    <option value="kepentingan-ekonomi">Kepentingan Ekonomi</option>
                    <option value="perlindungan-hak">Perlindungan Hak Pribadi</option>
                    <option value="rahasia-dagang">Rahasia Dagang</option>
                    <option value="proses-pengadilan">Proses Pengadilan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN HALAMAN PUBLIK -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt text-red-500 mr-2"></i>Konten Halaman Publik *
                </label>
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <textarea id="editor_content" name="konten" class="custom-editor" 
                              style="width: 100%; height: 400px; border: none;"
                              placeholder="Tuliskan penjelasan mengapa informasi ini dikecualikan..." required>{{ old('konten') }}</textarea>
                </div>
                @error('konten')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FILE PENDUKUNG (Opsional) -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-upload text-red-500 mr-2"></i>File Pendukung (Opsional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-400 transition">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-file-pdf text-6xl"></i>
                    </div>
                    <input type="file" name="file" accept=".pdf,.doc,.docx" class="hidden" id="fileInput">
                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih File
                    </button>
                    <p class="text-sm text-gray-500 mt-2">Format: PDF, DOC, DOCX (Max: 10MB)</p>
                    <div id="fileName" class="mt-2 text-sm text-green-600 font-medium"></div>
                </div>
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- MASA BERLAKU -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt text-red-500 mr-2"></i>Masa Berlaku Pengecualian
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Mulai Tanggal</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Sampai Tanggal</label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- PUBLISH OPTIONS -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-eye text-red-500 mr-2"></i>Status Publikasi
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} 
                               class="mr-2 text-red-500 focus:ring-red-500">
                        <span class="text-sm">Publikasikan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} 
                               class="mr-2 text-red-500 focus:ring-red-500">
                        <span class="text-sm">Draft</span>
                    </label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
                <a href="{{ route('admin.informasi.dikecualikan') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
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
