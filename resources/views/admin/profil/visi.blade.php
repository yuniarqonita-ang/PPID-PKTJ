<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <h1 class="text-3xl font-bold text-white">✨ Edit Visi & Misi PPID</h1>
                </div>

                <!-- Content -->
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.visi.update', 1) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Visi PPID</label>
                            <textarea name="visi" rows="4" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" required></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Misi PPID</label>
                            <textarea id="editor" name="misi" rows="8" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none"></textarea>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition">
                                💾 Simpan Perubahan
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition">
                                ← Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Tulis misi PPID di sini...',
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'alignleft', 'aligncenter', 'alignright', 'alignjustify']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
        });
    </script>
</x-app-layout>
