@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 p-6">
    <div class="max-w-5xl mx-auto">
        
        <!-- HEADER -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-red-500 to-orange-500 rounded-full mb-4 shadow-lg">
                <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-600 mb-3">
                Upload Informasi Serta Merta
            </h1>
            <p class="text-gray-600 text-lg">Tambahkan informasi penting yang harus segera disampaikan kepada publik</p>
        </div>

        <!-- FORM CARD -->
        <div class="relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-3xl blur opacity-30"></div>
            <div class="relative bg-white rounded-3xl p-10 shadow-2xl">
                
                <form action="{{ route('informasi.sertamerta.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- JUDUL INFORMASI -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-heading text-red-500 mr-3"></i>Judul Informasi
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}" 
                               class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-2 border-gray-200 text-gray-800 placeholder-gray-400 focus:border-red-400 focus:outline-none focus:ring-4 focus:ring-red-100 transition-all text-lg"
                               placeholder="Masukkan judul informasi serta merta yang jelas dan informatif..." required>
                        <small class="text-gray-500 text-sm mt-2 block">Maksimal 150 karakter, gunakan judul yang mudah dipahami</small>
                        @error('judul')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DESKRIPSI SINGKAT -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-align-left text-red-500 mr-3"></i>Deskripsi Singkat
                        </label>
                        <textarea name="deskripsi_singkat" rows="3" 
                                  class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-2 border-gray-200 text-gray-800 placeholder-gray-400 focus:border-red-400 focus:outline-none focus:ring-4 focus:ring-red-100 transition-all text-lg resize-none"
                                  placeholder="Tuliskan deskripsi singkat yang menjelaskan inti dari informasi...">{{ old('deskripsi_singkat') }}</textarea>
                        <small class="text-gray-500 text-sm mt-2 block">Maksimal 250 karakter, akan ditampilkan di halaman daftar informasi</small>
                        @error('deskripsi_singkat')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- KONTEN LENGKAP (SUMMERNOTE) -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-file-alt text-red-500 mr-3"></i>Konten Lengkap
                        </label>
                        <div class="bg-gray-50 rounded-2xl border-2 border-gray-200 overflow-hidden">
                            <textarea id="summernote-editor" name="konten" class="summernote-editor">{{ old('konten') }}</textarea>
                        </div>
                        <small class="text-gray-500 text-sm mt-2 block">Tulis informasi lengkap dengan format yang menarik dan mudah dibaca</small>
                        @error('konten')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TANGGAL PUBLIKASI -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-calendar-alt text-red-500 mr-3"></i>Tanggal Publikasi
                        </label>
                        <input type="datetime-local" name="tanggal_publikasi" 
                               class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-2 border-gray-200 text-gray-800 focus:border-red-400 focus:outline-none focus:ring-4 focus:ring-red-100 transition-all text-lg"
                               value="{{ old('tanggal_publikasi', now()->format('Y-m-d\TH:i')) }}" required>
                        <small class="text-gray-500 text-sm mt-2 block">Pilih tanggal dan waktu ketika informasi ini akan dipublikasikan</small>
                        @error('tanggal_publikasi')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DOKUMEN TERKAIT -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-paperclip text-red-500 mr-3"></i>Dokumen Terkait
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-red-400 transition-all bg-gray-50">
                            <div class="text-gray-400 mb-4">
                                <i class="fas fa-file-pdf text-6xl"></i>
                            </div>
                            <input type="file" name="dokumen" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden" id="dokumenInput">
                            <button type="button" onclick="document.getElementById('dokumenInput').click()" 
                                    class="px-6 py-3 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl hover:from-red-600 hover:to-orange-600 transition-all transform hover:scale-105 shadow-lg font-medium">
                                <i class="fas fa-upload mr-2"></i>Pilih Dokumen
                            </button>
                            <p class="text-sm text-gray-500 mt-3">Format: PDF, DOC, DOCX, JPG, PNG (Max: 15MB)</p>
                            <div id="dokumenName" class="mt-3 text-sm text-green-600 font-medium"></div>
                        </div>
                        @error('dokumen')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TINGKAT KESEGERAAN -->
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold text-lg mb-3">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>Tingkat Kesegeraan
                        </label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="tingkat" value="normal" {{ old('tingkat', 'normal') == 'normal' ? 'checked' : '' }} class="peer sr-only" required>
                                <div class="p-4 border-2 border-gray-200 rounded-2xl hover:border-red-400 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-clock text-2xl text-gray-400 peer-checked:text-red-500 mb-2"></i>
                                        <p class="font-medium text-gray-700 peer-checked:text-red-700">Normal</p>
                                        <p class="text-xs text-gray-500">1-24 jam</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="tingkat" value="segera" {{ old('tingkat') == 'segera' ? 'checked' : '' }} class="peer sr-only">
                                <div class="p-4 border-2 border-gray-200 rounded-2xl hover:border-orange-400 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-exclamation text-2xl text-gray-400 peer-checked:text-orange-500 mb-2"></i>
                                        <p class="font-medium text-gray-700 peer-checked:text-orange-700">Segera</p>
                                        <p class="text-xs text-gray-500">1-6 jam</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="tingkat" value="darurat" {{ old('tingkat') == 'darurat' ? 'checked' : '' }} class="peer sr-only">
                                <div class="p-4 border-2 border-gray-200 rounded-2xl hover:border-red-600 peer-checked:border-red-600 peer-checked:bg-red-100 transition-all">
                                    <div class="text-center">
                                        <i class="fas fa-bolt text-2xl text-gray-400 peer-checked:text-red-600 mb-2"></i>
                                        <p class="font-medium text-gray-700 peer-checked:text-red-700">Darurat</p>
                                        <p class="text-xs text-gray-500">Langsung</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('tingkat')
                            <div class="mt-2 text-red-500 text-sm font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.informasi.sertamerta') }}" class="px-8 py-4 bg-gray-200 text-gray-700 rounded-2xl hover:bg-gray-300 transition-all font-medium text-lg">
                            <i class="fas fa-times mr-3"></i>Batal
                        </a>
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl hover:from-red-600 hover:to-orange-600 transition-all transform hover:scale-105 shadow-lg font-medium text-lg">
                            <i class="fas fa-save mr-3"></i>Simpan Informasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SUMMERNOTE CDN - 100% FREE -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.js"></script>

<!-- CUSTOM SUMMERNOTE INITIALIZATION -->
<script>
$(document).ready(function() {
    // Initialize Summernote with Indonesian language
    $('#summernote-editor').summernote({
        height: 500,
        lang: 'id-ID',
        placeholder: 'Tulis konten lengkap informasi serta merta di sini... Gunakan format yang menarik dan mudah dibaca...',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                // Handle image upload
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onInit: function() {
                console.log('Summernote initialized successfully!');
            }
        }
    });

    // Image upload function
    function uploadImage(file) {
        const data = new FormData();
        data.append('image', file);
        
        // Show loading
        const loadingImg = $('<img>').attr('src', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjUiIGN5PSIyNSIgcj0iMjAiIHN0cm9rZT0iIzY2N2VlYSIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtZGFzaGFycmF5PSI0IDQiPgo8L2NpcmNsZT4KPC9zdmc+').css('width', '50px');
        $('#summernote-editor').summernote('insertNode', loadingImg[0]);
        
        // Simulate upload (replace with actual upload endpoint)
        setTimeout(() => {
            // Remove loading
            $('#summernote-editor').summernote('removeNode', loadingImg[0]);
            
            // Insert uploaded image (replace with actual image URL)
            const imgUrl = URL.createObjectURL(file);
            $('#summernote-editor').summernote('insertImage', imgUrl, file.name);
        }, 1000);
    }
});

// Document upload handler
document.addEventListener('DOMContentLoaded', function() {
    const dokumenInput = document.getElementById('dokumenInput');
    const dokumenName = document.getElementById('dokumenName');
    
    dokumenInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            dokumenName.innerHTML = `<i class="fas fa-check-circle text-green-500 mr-2"></i>File selected: ${file.name} (${fileSize} MB)`;
            
            // Validate file size
            if (file.size > 15 * 1024 * 1024) {
                dokumenName.innerHTML = `<i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>File too large: ${file.name} (${fileSize} MB - Max: 15MB)`;
                dokumenInput.value = '';
            }
        } else {
            dokumenName.textContent = '';
        }
    });
});
</script>
@endsection
