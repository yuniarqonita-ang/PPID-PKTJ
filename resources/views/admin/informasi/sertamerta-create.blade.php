@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600">
                Upload Informasi Serta Merta
            </h1>
            <p class="text-slate-500 mt-1">Tambahkan informasi yang harus segera disampaikan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.informasi.sertamerta') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('informasi.sertamerta.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- JUDUL INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading text-green-500 mr-2"></i>Judul Informasi *
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       placeholder="Masukkan judul informasi serta merta" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KATEGORI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-folder text-green-500 mr-2"></i>Kategori *
                </label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    <option value="">Pilih Kategori</option>
                    <option value="bencana-alam">Informasi Bencana Alam</option>
                    <option value="keadaan-darurat">Keadaan Darurat</option>
                    <option value="pengumuman-penting">Pengumuman Penting</option>
                    <option value="peringatan">Peringatan Keamanan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left text-green-500 mr-2"></i>Isi Informasi *
                </label>
                <textarea name="konten" rows="6" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                          placeholder="Tuliskan informasi yang harus segera disampaikan..." required>{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FILE UPLOAD -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-upload text-green-500 mr-2"></i>File Pendukung *
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-file-pdf text-6xl"></i>
                    </div>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden" id="fileInput" required>
                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih File
                    </button>
                    <p class="text-sm text-gray-500 mt-2">Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</p>
                    <div id="fileName" class="mt-2 text-sm text-green-600 font-medium"></div>
                </div>
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- TINGKAT KESEGERAAN -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-exclamation-triangle text-green-500 mr-2"></i>Tingkat Kesegeraan *
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="tingkat" value="segera" {{ old('tingkat', 'segera') == 'segera' ? 'checked' : '' }} 
                               class="mr-2 text-green-500 focus:ring-green-500" required>
                        <span class="text-sm">Segera (1-24 jam)</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tingkat" value="sangat-segera" {{ old('tingkat') == 'sangat-segera' ? 'checked' : '' }} 
                               class="mr-2 text-green-500 focus:ring-green-500">
                        <span class="text-sm">Sangat Segera (1-6 jam)</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="tingkat" value="darurat" {{ old('tingkat') == 'darurat' ? 'checked' : '' }} 
                               class="mr-2 text-green-500 focus:ring-green-500">
                        <span class="text-sm">Darurat ( langsung)</span>
                    </label>
                </div>
            </div>

            <!-- PUBLISH OPTIONS -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-eye text-green-500 mr-2"></i>Status Publikasi
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} 
                               class="mr-2 text-green-500 focus:ring-green-500">
                        <span class="text-sm">Publikasikan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} 
                               class="mr-2 text-green-500 focus:ring-green-500">
                        <span class="text-sm">Draft</span>
                    </label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
                <a href="{{ route('admin.informasi.sertamerta') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
