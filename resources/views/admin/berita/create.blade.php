@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Berita Baru
                </h1>
                <p class="text-gray-500 font-medium font-medium mt-1">Publikasikan informasi atau kegiatan terbaru PPID PKTJ</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- MAIN CONTENT -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-heading text-[#ffc107] mr-1"></i> Judul Berita <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                placeholder="Masukkan judul berita utama">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- ISI BERITA (TinyMCE) -->
                        <div class="space-y-2">
                            <label for="editor_berita_create" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-pen-nib text-[#ffc107] mr-1"></i> Isi Konten Berita <span class="text-red-500">*</span>
                            </label>
                            <div class="rounded-xl overflow-hidden border border-gray-300">
                                <textarea name="konten" id="editor_berita_create" class="tinymce-editor">{{ old('konten') }}</textarea>
                            </div>
                            @error('konten') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR INFO & SETTINGS -->
                    <div class="space-y-6">
                        
                        <!-- PUBLICATION PANEL -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-paper-plane mr-2 text-[#ffc107]"></i> Publikasi
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal Berita</label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]"
                                        value="{{ old('tanggal', date('Y-m-d')) }}">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Status Terbit</label>
                                    <div class="flex items-center gap-4">
                                        <label class="flex items-center cursor-pointer group">
                                            <input type="radio" name="status" value="published" class="sr-only" checked>
                                            <span class="w-4 h-4 border-2 border-gray-300 rounded-full flex-shrink-0 group-hover:border-[#004a99] transition-all relative">
                                                <span class="absolute inset-1 bg-[#004a99] rounded-full scale-0 transition-transform radio-checked:scale-100"></span>
                                            </span>
                                            <span class="ml-2 text-sm font-bold text-gray-700">Terbit</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer group">
                                            <input type="radio" name="status" value="draft" class="sr-only">
                                            <span class="w-4 h-4 border-2 border-gray-300 rounded-full flex-shrink-0 group-hover:border-[#004a99] transition-all relative">
                                                <span class="absolute inset-1 bg-[#004a99] rounded-full scale-0 transition-transform radio-checked:scale-100"></span>
                                            </span>
                                            <span class="ml-2 text-sm font-bold text-gray-700">Draft</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MEDIA PANEL -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-image mr-2 text-[#ffc107]"></i> Gambar Sampul
                            </h3>
                            <div class="space-y-4 text-center">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 bg-white hover:border-[#004a99] transition-colors cursor-pointer group" onclick="document.getElementById('gambar').click()">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 group-hover:text-[#004a99] mb-2 transition-colors"></i>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Klik untuk pilih gambar</p>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img src="" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                </div>
                                @error('gambar') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="window.location='{{ route('admin.berita.index') }}'" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#004a99] to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Berita
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
        plugins: 'lists link image anchor autolink charmap emoticons wordcount table',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | link image table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = preview.querySelector('img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    input[type="radio"]:checked + span span {
        transform: scale(1);
    }
</style>
@endsection
