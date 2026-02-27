<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-yellow-500">
                <h1 class="text-2xl font-bold mb-6 text-gray-800 uppercase border-b pb-4">Edit Data Berita</h1>

                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="block font-bold mb-2 text-gray-700">JUDUL BERITA</label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold mb-2 text-gray-700">KATEGORI BERITA</label>
                        <select name="kategori" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="Informasi Berkala" {{ old('kategori', $berita->kategori) == 'Informasi Berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                            <option value="Informasi Serta Merta" {{ old('kategori', $berita->kategori) == 'Informasi Serta Merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                            <option value="Informasi Setiap Saat" {{ old('kategori', $berita->kategori) == 'Informasi Setiap Saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold mb-2 text-gray-700">ISI BERITA</label>
                        <textarea id="summernote-editor" name="isi" class="summernote-editor">{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-6 border-t">
                        <button type="submit" class="bg-yellow-500 text-white px-8 py-2 rounded-lg font-bold shadow-md hover:bg-yellow-600 uppercase">Update</button>
                        <a href="{{ route('admin.berita.index') }}" class="bg-gray-200 text-gray-700 px-8 py-2 rounded-lg font-bold uppercase text-center">Tutup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SUMMERNOTE SCRIPTS - 100% FREE -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.js"></script>
    <link rel="stylesheet" href="{{ asset('css/summernote-custom.css') }}">

    <script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#summernote-editor').summernote({
            height: 400,
            lang: 'id-ID',
            placeholder: 'Edit konten berita di sini...',
            toolbar: [
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
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                },
                onInit: function() {
                    console.log('Summernote initialized!');
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
            
            // Simulate upload
            setTimeout(() => {
                $('#summernote-editor').summernote('removeNode', loadingImg[0]);
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = $('<img>').attr('src', e.target.result).css('max-width', '100%');
                    $('#summernote-editor').summernote('insertNode', img[0]);
                };
                reader.readAsDataURL(file);
            }, 1000);
        }
    });
    </script>