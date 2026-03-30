<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-purple-600 rounded-[22px] blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="bg-slate-800/90 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden transition-all duration-300">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">✏️ Edit Tugas & Fungsi PPID</h1>
                </div>

                <!-- Content -->
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.tugas.update', 1) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-slate-300 font-bold mb-2">Judul Tugas & Fungsi</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-3 border-2 border-slate-600/50 text-white placeholder-slate-500 rounded-xl focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/50 focus:outline-none transition-all duration-300 shadow-inner bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" required>
                        </div>

                        <div>
                            <label class="block text-slate-300 font-bold mb-2">Deskripsi Tugas & Fungsi</label>
                            <textarea id="editor" name="konten" rows="8" class="w-full px-4 py-3 border-2 border-slate-600/50 text-white placeholder-slate-500 rounded-xl focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/50 focus:outline-none transition-all duration-300 shadow-inner bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">{{ old('konten') }}</textarea>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold hover:from-emerald-400 hover:to-teal-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] border border-emerald-400/30">
                                💾 Simpan Perubahan
                            </button>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-slate-600 to-slate-700 text-white font-bold hover:from-slate-500 hover:to-slate-600 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(71,85,105,0.4)] border border-slate-500/30">
                                ← Kembali
                            </a>
                        </div>
                    </form>
                </div></div></div></div></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Tulis deskripsi tugas & fungsi di sini...',
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
