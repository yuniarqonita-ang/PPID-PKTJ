@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 w-full">
    <div class="w-full space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Berita Baru
                </h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Tulis dan terbitkan artikel informasi resmi ke portal publik</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-900/20 hover:bg-[#004a99] hover:scale-105 active:scale-95 transition-all flex items-center border-none">
                    <i class="fas fa-paper-plane mr-2 text-[#ffc107]"></i> Terbitkan Sekarang
                </button>
            </div>
        </div>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 mt-8">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- MAIN CONTENT AREA -->
                <div class="lg:col-span-2 space-y-8">
                
                <!-- CONTENT CARD -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-8 md:p-10 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-50 pb-6">
                            <h3 class="text-sm font-black text-[#004a99] uppercase tracking-widest flex items-center">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-edit"></i>
                                </span>
                                Isi Konten Berita
                            </h3>
                            <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Wajib Diisi</span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-8">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Berita</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" required
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700 text-lg"
                                    placeholder="Masukkan judul berita yang menarik...">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 block">Isi Berita Lengkap</label>
                                <div class="rounded-2xl overflow-hidden border border-slate-200">
                                    <textarea name="konten" id="editor" class="tinymce-editor">{!! old('konten') !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!-- SIDEBAR PANEL -->
                <div class="space-y-6">
                    <!-- STATUS CARD -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                            <i class="fas fa-toggle-on mr-2 text-[#ffc107]"></i> Status Publikasi
                        </h3>
                        <div class="space-y-4">
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

            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
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
@endpush

<style>
    input[type="radio"]:checked + span span {
        transform: scale(1);
    }
</style>
@endsection
