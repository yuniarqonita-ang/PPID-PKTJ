@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 drop-shadow-lg">
                ❓ Tambah FAQ Baru
            </h1>
            <p class="text-slate-400 mt-1 font-medium">Kelola pertanyaan dan jawaban yang sering diajukan</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.faq.index') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- ==================== ALERTS SECTION ==================== -->
    @if($errors->any())
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-red-900/20 to-red-900/30 border border-red-600/30 p-6 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-300 mb-2">🚨 Terjadi Kesalahan!</h3>
                        <ul class="space-y-1 text-red-400">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-900/20 to-green-900/30 border border-green-600/30 p-6 shadow-lg">
            <div class="relative z-10">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center animate-pulse">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-green-300">✅ Berhasil!</h3>
                        <p class="text-green-400">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== FORM SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 p-8 relative overflow-hidden">
        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2 columns) -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Pertanyaan Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-pink-500 to-pink-600 text-white flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-question text-sm"></i>
                            </span>
                            Pertanyaan *
                        </label>
                        <input type="text" name="pertanyaan" id="pertanyaan" 
                               value="{{ old('pertanyaan') }}" 
                               placeholder="Masukkan pertanyaan FAQ, contoh: Bagaimana cara mengajukan permohonan informasi?"
                               required
                               class="w-full px-6 py-4 text-lg rounded-xl transition-all duration-300 bg-slate-900/60 border border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                        <p class="text-sm text-slate-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tulis pertanyaan yang jelas dan sering ditanyakan oleh masyarakat
                        </p>
                    </div>

                    <!-- Jawaban Section -->
                    <div class="group">
                        <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-comment-dots text-sm"></i>
                            </span>
                            Jawaban *
                        </label>
                        <textarea name="jawaban" id="editor_faq_create" 
                                  placeholder="Masukkan jawaban lengkap..."
                                  required
                                  class="w-full px-6 py-4 text-lg rounded-xl bg-slate-900/60 border border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" 
                                  style="min-height: 300px;">{{ old('jawaban') }}</textarea>
                        <p class="text-sm text-slate-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Jawaban lengkap yang informatif dan mudah dipahami
                        </p>
                    </div>
                </div>

                <!-- Sidebar (1 column) -->
                <div class="space-y-6">
                    <!-- Panduan Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-900/20 to-purple-900/20 border border-pink-600/30 p-6 shadow-lg">
                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3 class="text-lg font-bold text-pink-300">Panduan Pengisian</h3>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-pink-400 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-pink-300">Pertanyaan:</strong>
                                        <p class="text-pink-400/80">Jelas, singkat, dan sering ditanyakan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <span class="w-1.5 h-1.5 bg-pink-400 rounded-full mt-1.5 flex-shrink-0"></span>
                                    <div>
                                        <strong class="text-pink-300">Jawaban:</strong>
                                        <p class="text-pink-400/80">Lengkap, informatif, dan mudah dipahami</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-900/20 to-indigo-900/20 border border-blue-600/30 p-6 shadow-lg">
                        <div class="relative z-10">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-500 text-white flex items-center justify-center mr-3 shadow-lg">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <h3 class="text-lg font-bold text-blue-300">Tentang FAQ</h3>
                            </div>
                            <p class="text-sm text-blue-400 leading-relaxed">
                                FAQ membantu pengguna menemukan informasi yang dibutuhkan dengan cepat tanpa harus menghubungi PPID secara langsung.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t border-slate-600/30">
                <a href="{{ route('admin.faq.index') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 shadow-lg shadow-pink-500/25">
                    <i class="fas fa-save mr-2"></i>Simpan FAQ
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#editor_faq_create',
            license_key: 'gpl',
            height: 400,
            menubar: false,
            skin: 'oxide-dark',
            content_css: 'dark',
            plugins: [
                'advlist','autolink','lists','link','image','charmap',
                'searchreplace','visualblocks','code','fullscreen',
                'insertdatetime','media','table','help','wordcount'
            ],
            toolbar:
                'undo redo | styles | bold italic underline | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | ' +
                'table link | removeformat code fullscreen',
            toolbar_mode: 'wrap',
            content_style:
                'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.75; color: #f8fafc; background: transparent; padding: 12px; } ' +
                'table { border-collapse: collapse; width: 100%; } ' +
                'table td, table th { border: 1px solid #ddd; padding: 8px 12px; }' +
                'table th { background: #f1f5f9; font-weight: 600; }'
        });

        document.querySelector('form').addEventListener('submit', function() {
            tinymce.triggerSave();
        });
    });
</script>
@endsection
