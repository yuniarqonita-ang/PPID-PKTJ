<x-app-layout>
    <div class="max-w-3xl">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Edit FAQ</h1>

        <form action="{{ route('admin.faq.update', $faq) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="pertanyaan" class="block text-sm font-bold text-slate-700 mb-2">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan) }}" placeholder="Masukkan pertanyaan FAQ" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('pertanyaan') border-red-500 @enderror">
                @error('pertanyaan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jawaban" class="block text-sm font-bold text-slate-700 mb-2">
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea name="jawaban" id="summernote-editor" placeholder="Masukkan jawaban FAQ" required
                    class="summernote-editor">{{ old('jawaban', $faq->jawaban) }}</textarea>
                @error('jawaban')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    ✅ Perbarui FAQ
                </button>
                <a href="{{ route('admin.faq.index') }}" class="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-6 rounded-lg transition">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

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
        height: 300,
        lang: 'id-ID',
        placeholder: 'Tulis jawaban FAQ di sini...',
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
