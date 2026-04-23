{{-- 
    TEMPLATE FORM GENERIK UNTUK ADMIN PANEL (VERSI PKTJ BRIGHT CORPORATE)
    Guna: Copy-paste template ini untuk membuat form baru
    Editor: TinyMCE (Modern, clean, and reliable)
--}}

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-edit mr-2"></i> Nama Menu Admin
                </h1>
                <p class="text-gray-500 font-medium">Deskripsi menu dan fungsinya di sini...</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 bg-blue-100 text-[#004a99] rounded-full text-xs font-bold uppercase tracking-wider">Draft Mode</span>
            </div>
        </div>

        <!-- FORM SECTION -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('dashboard') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10">
                @csrf
                {{-- @method('PUT') --}}

                <div class="space-y-8">
                    <!-- MAIN CONTENT (FULL WIDTH) -->
                    <div class="space-y-6">
                        
                        <!-- FIELD 1: JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-heading mr-2 text-[#ffc107]"></i> Judul Konten
                            </label>
                            <input type="text" name="judul" id="judul" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                placeholder="Ketik judul di sini..." value="{{ old('judul') }}" required>
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- FIELD 2: DESKRIPSI SINGKAT -->
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-align-left mr-2 text-[#ffc107]"></i> Deskripsi Singkat
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                placeholder="Tulis ringkasan singkat...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- FIELD 3: KONTEN LENGKAP -->
                        <div class="space-y-2">
                            <label for="editor" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-pen-fancy mr-2 text-[#ffc107]"></i> Isi Konten Lengkap
                            </label>
                            <div class="rounded-xl overflow-hidden border border-gray-300">
                                <textarea name="konten" id="editor" class="tinymce-editor">{{ old('konten') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <!-- BOTTOM SECTION: SETTINGS & SIDEBAR -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- PUBLICATION SETTINGS -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-cog mr-2"></i> Pengaturan
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                                
                                <div>
                                    <label for="kategori" class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori</label>
                                    <select name="kategori_id" id="kategori" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- FILE ATTACHMENT -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Lampiran
                            </h3>
                            <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 bg-white hover:bg-gray-50 transition-colors cursor-pointer group" onclick="document.getElementById('file-input').click()">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 group-hover:text-[#004a99] mb-2 transition-colors"></i>
                                <span class="text-xs text-gray-500 font-medium">Klik untuk upload file</span>
                                <input type="file" id="file-input" name="file" class="hidden">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 text-center">PDF, DOCX, atau Gambar (Max 10MB)</p>
                        </div>

                        <!-- HELP CARD -->
                        <div class="bg-[#004a99] rounded-2xl p-6 text-white shadow-lg">
                            <h4 class="font-bold mb-2 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-[#ffc107]"></i> Tips
                            </h4>
                            <ul class="text-xs space-y-2 opacity-90 leading-relaxed">
                                <li>• Gunakan <strong>Heading</strong> untuk membagi konten.</li>
                                <li>• Tambahkan link internal untuk navigasi user.</li>
                                <li>• Pastikan gambar memiliki resolusi yang baik.</li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="mt-10 pt-6 border-t border-gray-200 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#004a99] to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- INCLUDE TINYMCE --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignjustify align | link image media table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 600,
        skin: 'oxide',
        content_css: 'default',
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #475569; text-align: justify; }',
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });
</script>

<style>
    /* Styling for TinyMCE inside the rounded container */
    .tox-tinymce {
        border: none !important;
    }
    .tox .tox-toolbar-overlord {
        background-color: #f8f9fa !important;
    }
</style>
@endsection
