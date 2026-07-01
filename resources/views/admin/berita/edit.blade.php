@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Edit Berita</h2>
                </div>
                <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                    Edit <span class="text-[#ffc107]">Artikel</span>
                </h1>
                <p class="text-blue-50 text-base font-bold opacity-90">{{ Str::limit($berita->judul, 60) }}</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.berita.index') }}" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-arrow-left mr-3"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

                
                <!-- CONTENT CARD -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="p-8 md:p-10 space-y-8">
                        <div class="flex items-center justify-between border-b border-slate-50 pb-6">
                            <h3 class="text-sm font-black text-[#004a99] uppercase tracking-widest flex items-center">
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
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Kategori</label>
                                <select name="kategori" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700">
                                    <option value="Berita Utama" {{ $berita->kategori == 'Berita Utama' ? 'selected' : '' }}>Berita Utama</option>
                                    <option value="Pengumuman" {{ $berita->kategori == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    <option value="Kegiatan" {{ $berita->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                    <option value="Informasi Publik" {{ $berita->kategori == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik</option>
                                    <option value="Dokumentasi" {{ $berita->kategori == 'Dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tag Berita (Hashtag)</label>
                                <input type="text" name="tags" value="{{ old('tags', $berita->tags) }}"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white transition-all font-semibold text-slate-700"
                                    placeholder="Contoh: #pengumuman #pendaftaran #sipencatar">
                                <p class="text-[10px] text-slate-400 font-medium italic">Gunakan tanda pagar (#) untuk memisahkan setiap tagar.</p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 block">Isi Dokumen Berita</label>
                                <div class="rounded-2xl overflow-hidden border border-slate-200">
                                    <textarea name="konten" id="editor" class="tinymce-editor">{!! old('konten', $berita->konten) !!}</textarea>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-8 space-y-6">
                    <h4 class="text-xs font-black text-[#004a99] uppercase tracking-widest border-b border-slate-50 pb-4 flex items-center">
                        <span class="w-2 h-5 bg-[#ffc107] rounded-full mr-3"></span>Status & Media
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-medium">Terakhir Update:</span>
                            <span class="font-bold text-gray-700">{{ $berita->updated_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase mb-2">Tanggal Publikasi</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]"
                                value="{{ old('tanggal', $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : date('Y-m-d')) }}">
                        </div>


                    {{-- MEDIA --}}
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                        <h3 class="text-sm font-bold text-[#004a99] mb-4 uppercase flex items-center">
                            <i class="fas fa-image mr-2 text-[#ffc107]"></i> Gambar Sampul
                        </h3>
                        <div class="space-y-4">
                            @if($berita->gambar)
                                <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-32 object-cover transition-transform group-hover:scale-105">
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
                                <img src="" class="w-full h-32 object-cover rounded-lg border-2 border-[#ffc107]">
                            </div>
                        </div>
                    </div>

            {{-- ACTION BUTTONS --}}
            <div class="pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3">
                <button type="button" onclick="history.back()" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </button>
                <button type="submit" class="px-8 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:scale-[1.02] transition-all flex items-center justify-center">
                    <i class="fas fa-save mr-2 text-[#ffc107]"></i> Update Berita
                </button>
            </div>

        </form>
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
@endsection
