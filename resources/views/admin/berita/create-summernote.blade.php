@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-4xl mx-auto">
        
        <!-- HEADER -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black text-white drop-shadow-lg mb-2">
                📝 Buat Berita Baru
            </h1>
            <p class="text-cyan-300">Tulis dan publikasikan berita terbaru PPID PKTJ</p>
        </div>

        <!-- FORM CARD -->
        <div class="relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-25"></div>
            <div class="relative bg-slate-800 rounded-2xl p-8 shadow-2xl">
                
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- JUDUL BERITA -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-heading"></i> Judul Berita
                        </label>
                        <input type="text" name="judul" 
                               class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white placeholder-slate-400 focus:border-blue-400 focus:outline-none transition"
                               placeholder="Masukkan judul berita yang menarik..." 
                               value="{{ old('judul') }}" required>
                        <small class="text-slate-400 text-sm">Maksimal 100 karakter</small>
                        @error('judul')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- GAMBAR SAMPEL -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-image"></i> Gambar Sampul
                        </label>
                        <div class="bg-slate-700 rounded-xl p-4 border border-slate-600">
                            <div class="mb-3">
                                <small class="text-slate-400">Disarankan ukuran 700px x 350px</small>
                            </div>
                            <button type="button" onclick="document.getElementById('gambar').click()" 
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-500 hover:to-purple-500 transition transform hover:scale-105 shadow-lg">
                                <i class="fas fa-upload"></i> Pilih Gambar
                            </button>
                            <input type="file" id="gambar" name="gambar" class="d-none @error('gambar') border-red-400 @enderror" 
                                   accept="image/*" onchange="previewImage(this)">
                            <div id="preview" class="mt-4"></div>
                            @error('gambar')
                                <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-folder"></i> Kategori Berita
                        </label>
                        <select name="kategori" 
                                class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:border-blue-400 focus:outline-none transition"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Informasi Setiap Saat">Informasi Setiap Saat</option>
                            <option value="Informasi Berkala">Informasi Berkala</option>
                            <option value="Informasi Serta Merta">Informasi Serta Merta</option>
                        </select>
                        @error('kategori')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ISI BERITA (SUMMERNOTE) -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-edit"></i> Isi Berita
                        </label>
                        <div class="bg-slate-700 rounded-xl border border-slate-600 overflow-hidden">
                            <textarea id="summernote-editor" name="isi" class="summernote-editor">{{ old('isi') }}</textarea>
                        </div>
                        <small class="text-slate-400 text-sm">Powered by Summernote - 100% Gratis</small>
                        @error('isi')
                            <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TAG BERITA -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-tags"></i> Tag Berita
                        </label>
                        <input type="text" name="tags" 
                               class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white placeholder-slate-400 focus:border-blue-400 focus:outline-none transition"
                               placeholder="PPID, PKTJ, Transportasi, Jalan..." 
                               value="{{ old('tags') }}">
                        <small class="text-slate-400 text-sm">Pisahkan dengan koma (,)</small>
                    </div>

                    <!-- TANGGAL BERITA -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-calendar"></i> Tanggal Berita
                        </label>
                        <input type="date" name="tanggal" 
                               class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:border-blue-400 focus:outline-none transition"
                               value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- STATUS PUBLIKASI -->
                    <div class="mb-6">
                        <label class="block text-white font-bold mb-2">
                            <i class="fas fa-eye"></i> Terbitkan
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="1" checked class="mr-2">
                                <span class="text-white">Ya - Publikasikan sekarang</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status" value="0" class="mr-2">
                                <span class="text-white">Tidak - Simpan sebagai draft</span>
                            </label>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:from-green-500 hover:to-emerald-500 transition transform hover:scale-105 shadow-lg">
                            <i class="fas fa-save"></i> SIMPAN BERITA
                        </button>
                        <a href="{{ route('berita.index') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white font-bold rounded-xl hover:from-red-500 hover:to-pink-500 transition transform hover:scale-105 shadow-lg">
                            <i class="fas fa-times"></i> BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        height: 400,
        lang: 'id-ID',
        placeholder: 'Tulis konten berita di sini...',
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
            
            // Insert uploaded image (for demo, use FileReader)
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = $('<img>').attr('src', e.target.result).css('max-width', '100%');
                $('#summernote-editor').summernote('insertNode', img[0]);
            };
            reader.readAsDataURL(file);
        }, 1000);
    }

    // Preview image function
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" class="rounded-xl shadow-lg" style="max-width: 300px;">
                        <button type="button" onclick="this.parentElement.remove(); document.getElementById('gambar').value = '';" 
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-save functionality (optional)
    let autoSaveTimer;
    $('#summernote-editor').on('summernote.change', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            console.log('Auto-save triggered');
            // Add auto-save logic here if needed
        }, 30000); // 30 seconds
    });
});
</script>
@endsection
