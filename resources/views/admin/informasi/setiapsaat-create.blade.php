@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
                Upload Informasi Setiap Saat
            </h1>
            <p class="text-slate-400 mt-1">Tambahkan informasi yang tersedia setiap saat</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.informasi.setiapsaat') }}" class="px-4 py-2 bg-gray-200 text-slate-300 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden shadow-lg p-8">
        <form action="{{ route('informasi.setiapsaat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- JUDUL INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-heading text-blue-500 mr-2"></i>Judul Informasi *
                </label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                       placeholder="Masukkan judul informasi" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KATEGORI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-folder text-blue-500 mr-2"></i>Kategori *
                </label>
                <select name="kategori" class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" required>
                    <option value="">Pilih Kategori</option>
                    <option value="daftar-informasi">Daftar Informasi Publik</option>
                    <option value="prosedur-layanan">Prosedur Pelayanan</option>
                    <option value="jadwal-pelayanan">Jadwal Pelayanan</option>
                    <option value="biaya-tarif">Biaya dan Tarif</option>
                    <option value="hasil-pelayanan">Hasil Pelayanan</option>
                    <option value="pengaduan">Pengaduan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN INFORMASI -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-align-left text-blue-500 mr-2"></i>Isi Informasi *
                </label>
                <textarea name="konten" id="editor_setiapsaat" rows="6" 
                          class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                          placeholder="Tuliskan informasi yang tersedia setiap saat..." required>{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FILE UPLOAD -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-file-upload text-blue-500 mr-2"></i>File Dokumen *
                </label>
                <div class="border-2 border-dashed border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-lg p-6 text-center hover:border-blue-400 transition">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-file-pdf text-6xl"></i>
                    </div>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden" id="fileInput" required>
                    <button type="button" onclick="document.getElementById('fileInput').click()" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-upload mr-2"></i>Pilih File
                    </button>
                    <p class="text-sm text-slate-400 mt-2">Format: PDF, DOC, DOCX, XLS, XLSX (Max: 10MB)</p>
                    <div id="fileName" class="mt-2 text-sm text-green-600 font-medium"></div>
                </div>
                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- FREKUENSI UPDATE -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-sync text-blue-500 mr-2"></i>Frekuensi Update
                </label>
                <select name="frekuensi" class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
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
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-user text-blue-500 mr-2"></i>Kontak Person
                </label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" 
                       class="w-full px-4 py-2 border border-slate-600 text-white placeholder-slate-500 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400"
                       placeholder="Nama dan kontak person">
            </div>

            <!-- PUBLISH OPTIONS -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-eye text-blue-500 mr-2"></i>Status Publikasi
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} 
                               class="mr-2 text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Publikasikan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} 
                               class="mr-2 text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Draft</span>
                    </label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Informasi
                </button>
                <a href="{{ route('admin.informasi.setiapsaat') }}" class="px-6 py-2 bg-gray-300 text-slate-300 rounded-lg hover:bg-gray-400 transition">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
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

    tinymce.init({
        selector: '#editor_setiapsaat',
        license_key: 'gpl',
        height: 300,
        menubar: false,
        skin: 'oxide-dark',
        content_css: 'dark',
        plugins: [
            'advlist','autolink','lists','link','image','charmap',
            'searchreplace','visualblocks','code','fullscreen',
            'insertdatetime','media','table','help','wordcount'
        ],
        toolbar:
            'undo redo | styles | bold italic underline strikethrough | ' +
            'fontfamily fontsize forecolor backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'table link image charmap | removeformat code fullscreen',
        toolbar_mode: 'wrap',
        fontsize_formats: '8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 24pt 28pt 32pt 36pt 48pt 72pt',
        font_family_formats:
            'Arial=arial,helvetica,sans-serif;' +
            'Arial Black=arial black,avant garde;' +
            'Comic Sans MS=comic sans ms,sans-serif;' +
            'Courier New=courier new,courier;' +
            'Georgia=georgia,palatino;' +
            'Helvetica=helvetica;' +
            'Impact=impact,chicago;' +
            'Inter=inter,sans-serif;' +
            'Tahoma=tahoma,arial,helvetica,sans-serif;' +
            'Times New Roman=times new roman,times;' +
            'Trebuchet MS=trebuchet ms,geneva;' +
            'Verdana=verdana,geneva',
        style_formats: [
            { title: 'Heading 1', block: 'h1' },
            { title: 'Heading 2', block: 'h2' },
            { title: 'Heading 3', block: 'h3' },
            { title: 'Heading 4', block: 'h4' },
            { title: 'Paragraph', block: 'p' },
            { title: 'Blockquote', block: 'blockquote' }
        ],
        table_toolbar:
            'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | ' +
            'tableinsertcolbefore tableinsertcolafter tabledeletecol',
        content_style:
            'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.75; color: #f8fafc; background: transparent; padding: 12px; padding: 12px; } ' +
            'table { border-collapse: collapse; width: 100%; } ' +
            'table td, table th { border: 1px solid #ddd; padding: 8px 12px; }' +
            'table th { background: #f1f5f9; font-weight: 600; }'
    });
});

// Auto-sync TinyMCE on form submit
document.querySelector('form').addEventListener('submit', function() {
    tinymce.triggerSave();
});
</script>
@endsection
