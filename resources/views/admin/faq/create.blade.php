@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar FAQ
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-question-circle mr-2"></i> Tambah FAQ Baru
                </h1>
                <p class="text-gray-500 font-medium">Buat tanya-jawab baru untuk membantu pengunjung portal PPID</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.faq.store') }}" method="POST" class="p-6 md:p-10">
                @csrf
                
                <div class="space-y-8">
                    <!-- MAIN CONTENT -->
                    <div class="space-y-6">
                        
                        <!-- PERTANYAAN -->
                        <div class="space-y-2">
                            <label for="pertanyaan" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-question text-[#ffc107] mr-1"></i> Pertanyaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan') }}" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                placeholder="Contoh: Bagaimana cara mengakses informasi publik?">
                            @error('pertanyaan') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- JAWABAN (TinyMCE) -->
                        <div class="space-y-2">
                            <label for="editor_faq" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-comment-dots text-[#ffc107] mr-1"></i> Jawaban Pendek/Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="rounded-xl overflow-hidden border border-gray-300">
                                <textarea name="jawaban" id="editor_faq" class="tinymce-editor text-gray-800">{{ old('jawaban') }}</textarea>
                            </div>
                            @error('jawaban') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    </div>

                    <!-- SIDEBAR INFO (BELOW) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-info-circle mr-2 text-[#ffc107]"></i> Panduan FAQ
                            </h3>
                            <div class="text-xs text-gray-600 space-y-3 leading-relaxed">
                                <p><strong>1. Fokus:</strong> Buat pertanyaan yang spesifik dan sering ditanyakan oleh pemohon informasi.</p>
                                <p><strong>2. Jawaban:</strong> Berikan jawaban yang padat, akurat, dan merujuk pada peraturan yang berlaku (SOP/Undang-undang).</p>
                                <p><strong>3. Formatting:</strong> Gunakan Bold atau List di editor jika jawaban cukup panjang agar mudah dibaca.</p>
                            </div>
                        </div>

                        <div class="bg-[#004a99] rounded-2xl p-6 text-white shadow-lg">
                            <p class="text-xs opacity-90 leading-relaxed font-medium">
                                <i class="fas fa-check-circle mr-1 text-[#ffc107]"></i> Perubahan akan langsung tampil di halaman FAQ publik secara real-time.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="window.location='{{ route('admin.faq.index') }}'" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#004a99] to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan FAQ Baru
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'lists link anchor autolink charmap emoticons wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignjustify align | link | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 600,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false,
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #475569; text-align: justify; }'
    });
</script>
@endsection
