@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="space-y-8 max-w-full">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 drop-shadow-lg">
                ✏️ Edit FAQ
            </h1>
            <p class="text-slate-400 mt-1 font-medium">Edit pertanyaan dan jawaban FAQ</p>
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
        <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                <!-- Pertanyaan Section -->
                <div class="group">
                    <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-pink-500 to-pink-600 text-white flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-question text-sm"></i>
                        </span>
                        Pertanyaan *
                    </label>
                    <input type="text" name="pertanyaan" id="pertanyaan" 
                           value="{{ old('pertanyaan', $faq->pertanyaan) }}" 
                           placeholder="Masukkan pertanyaan FAQ"
                           required
                           class="w-full px-6 py-4 text-lg rounded-xl transition-all duration-300 bg-slate-900/60 border border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                    @error('pertanyaan')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jawaban Section -->
                <div class="group">
                    <label class="block text-lg font-bold text-slate-200 mb-3 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 text-white flex items-center justify-center mr-3 shadow-md">
                            <i class="fas fa-comment-dots text-sm"></i>
                        </span>
                        Jawaban *
                    </label>
                    <textarea name="jawaban" id="editor_faq_edit" 
                              placeholder="Masukkan jawaban lengkap..."
                              required
                              class="w-full px-6 py-4 text-lg rounded-xl bg-slate-900/60 border border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" 
                              style="min-height: 300px;">{{ old('jawaban', $faq->jawaban) }}</textarea>
                    @error('jawaban')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-8 border-t border-slate-600/30">
                <a href="{{ route('admin.faq.index') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-slate-700 to-slate-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105 shadow-lg shadow-emerald-500/25">
                    <i class="fas fa-save mr-2"></i>Perbarui FAQ
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
            selector: '#editor_faq_edit',
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
