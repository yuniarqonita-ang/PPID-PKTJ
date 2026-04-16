@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] drop-shadow-lg">
                Upload Informasi Berkala
            </h1>
            <p class="text-gray-500 mt-1">Tambahkan informasi berkala yang wajib dipublikasikan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.informasi.berkala') }}" class="px-4 py-2 bg-slate-700 text-[#004a99] rounded-lg hover:bg-slate-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 relative overflow-hidden shadow-lg p-8 border border-slate-600/30">
        <form action="{{ route('admin.informasi.berkala.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- JUDUL INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-heading text-yellow-500 mr-2"></i>Judul Informasi *
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-2 bg-slate-900 border border-slate-600 text-[#004a99] rounded-lg focus:ring-2 focus:ring-yellow-500"
                       placeholder="Masukkan judul informasi berkala" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KATEGORI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-folder text-yellow-500 mr-2"></i>Kategori
                </label>
                <select name="kategori" class="w-full px-4 py-2 bg-slate-900 border border-slate-600 text-[#004a99] rounded-lg focus:ring-2 focus:ring-yellow-500">
                    <option value="">Pilih Kategori</option>
                    <option value="laporan-tahunan">Laporan Tahunan</option>
                    <option value="program-kerja">Program Kerja</option>
                    <option value="anggaran">Anggaran</option>
                    <option value="kinerja">Laporan Kinerja</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- FILE UPLOAD -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-file-upload text-yellow-500 mr-2"></i>File Dokumen *
                </label>
                <div class="border-2 border-dashed border-slate-600 bg-slate-900/50 rounded-lg p-6 text-center hover:border-yellow-400 transition">
                    <div class="text-gray-500 mb-4">
                        <i class="fas fa-file-pdf text-6xl"></i>
                    </div>
                    <input type="file" name="file" accept=".pdf,.doc,.docx" class="hidden" id="fileInput" required>
                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                            class="px-4 py-2 bg-yellow-500 text-[#004a99] rounded-lg hover:bg-yellow-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih File
                    </button>
                    <p class="text-sm text-gray-500 mt-2">Format: PDF, DOC, DOCX (Max: 10MB)</p>
                    <div id="fileName" class="mt-2 text-sm text-green-400 font-medium"></div>
                </div>
            </div>

            <!-- TAHUN -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-calendar text-yellow-500 mr-2"></i>Tahun *
                </label>
                <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" 
                       class="w-full px-4 py-2 bg-slate-900 border border-slate-600 text-[#004a99] rounded-lg focus:ring-2 focus:ring-yellow-500"
                       placeholder="Contoh: 2024" min="2020" max="2030" required>
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-align-left text-yellow-500 mr-2"></i>Deskripsi
                </label>
                <textarea name="deskripsi" id="editor_berkala" rows="4" 
                          class="tinymce-editor w-full px-4 py-2 bg-slate-900 border border-slate-600 text-[#004a99] rounded-lg"
                          placeholder="Deskripsi singkat tentang informasi ini">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- PUBLISH OPTIONS -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-eye text-yellow-500 mr-2"></i>Status Publikasi
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} 
                               class="mr-2 text-yellow-500 focus:ring-yellow-500">
                        <span class="text-sm text-gray-600">Publikasikan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} 
                               class="mr-2 text-yellow-500 focus:ring-yellow-500">
                        <span class="text-sm text-gray-600">Draft</span>
                    </label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.informasi.berkala') }}" class="px-6 py-2 bg-slate-700 text-[#004a99] rounded-lg">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-[#004a99] rounded-lg font-bold shadow-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
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
            fileName.textContent = 'File terpilih: ' + e.target.files[0].name;
        } else {
            fileName.textContent = '';
        }
    });
});
</script>
@endsection

