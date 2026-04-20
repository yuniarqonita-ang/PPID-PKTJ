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
                    <i class="fas fa-edit mr-2"></i> Edit Berita
                </h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Perbarui detail artikel dan sesuaikan informasi publikasinya</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-900/20 hover:bg-[#002b5c] hover:scale-105 active:scale-95 transition-all flex items-center border-none">
                    <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <!-- CONTENT CARD -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-8 md:p-10 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-50 pb-6">
                            <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                                <span class="w-8 h-8 bg-[#004a99] text-white rounded-lg flex items-center justify-center mr-3 text-xs">
                                    <i class="fas fa-pen-nib"></i>
                                </span>
                                Redaksi Konten
                            </h3>
                            <span class="text-[10px] font-bold text-[#ffc107] uppercase tracking-widest">Live Editor</span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-8">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Judul Berita</label>
                                <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700 text-lg">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 block">Isi Dokumen Berita</label>
                                <div class="rounded-2xl overflow-hidden border border-slate-200">
                                    <textarea name="konten" id="editor" class="tinymce-editor">{!! old('konten', $berita->konten) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR SETTINGS -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- METADATA CARD -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 p-8 space-y-8">
                    <h4 class="text-xs font-black text-[#002b5c] uppercase tracking-widest border-b border-slate-50 pb-6 flex items-center">
                        <span class="w-2 h-5 bg-[#ffc107] rounded-full mr-3"></span>
                        Status & Media
                    </h4>

                    <div class="space-y-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-400 italic">Update:</span>
                                    <span>{{ $b->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase mb-1 text-xs">Tanggal Pub</label>
                                <input type="date" name="tanggal" id="tanggal" 
                                    class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]"
                                    value="{{ old('tanggal', $b->tanggal ? \Carbon\Carbon::parse($b->tanggal)->format('Y-m-d') : date('Y-m-d')) }}">
                            </div>
                        </div>

                        <!-- MEDIA PANEL -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-image mr-2 text-[#ffc107]"></i> Gambar Sampul
                            </h3>
                            <div class="space-y-4">
                                @if($b->gambar)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                        <img src="{{ asset('storage/' . $b->gambar) }}" class="w-full h-32 object-cover transition-transform group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <p class="text-white text-[10px] font-bold">GAMBAR SAAT INI</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-white hover:border-[#004a99] transition-colors cursor-pointer text-center group" onclick="document.getElementById('gambar').click()">
                                    <i class="fas fa-sync text-2xl text-gray-300 group-hover:text-[#004a99] mb-1"></i>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase">Ganti Gambar?</p>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img src="" class="w-full h-32 object-cover rounded-lg border border-gray-200 border-2 border-[#ffc107]">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                    <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#004a99] to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Update Berita
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
@endsection
