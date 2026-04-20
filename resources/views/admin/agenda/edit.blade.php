@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Agenda
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-calendar-check mr-2"></i> Edit Agenda
                </h1>
                <p class="text-gray-500 font-medium font-medium mt-1">Lakukan penyesuaian pada jadwal kegiatan <strong>{{ $agenda->judul }}</strong></p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10">
                @csrf
                @method('PUT')
                
                <div class="space-y-8">
                    <!-- MAIN CONTENT -->
                    <div class="space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-calendar-day text-[#ffc107] mr-1"></i> Nama Agenda / Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $agenda->judul) }}" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#004a99] focus:border-transparent transition-all shadow-sm"
                                placeholder="Masukkan nama agenda">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- KONTEN (TinyMCE) -->
                        <div class="space-y-2">
                            <label for="editor_agenda" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                <i class="fas fa-info-circle text-[#ffc107] mr-1"></i> Detail Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <div class="rounded-xl overflow-hidden border border-gray-300">
                                <textarea name="konten" id="editor_agenda" class="tinymce-editor">{{ old('konten', $agenda->konten) }}</textarea>
                            </div>
                            @error('konten') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- SIDEBAR INFO & SETTINGS (BELOW) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                        
                        <!-- TIME & STATUS PANEL -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-clock mr-2 text-[#ffc107]"></i> Waktu & Status
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal" id="tanggal" 
                                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#004a99]"
                                        value="{{ old('tanggal', $agenda->tanggal ? \Carbon\Carbon::parse($agenda->tanggal)->format('Y-m-d') : date('Y-m-d')) }}">
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-200">
                                    <span class="text-xs font-bold text-gray-700 uppercase">Tampilkan Publik?</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="aktif" value="1" class="sr-only peer" {{ $agenda->aktif ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#004a99]"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- MEDIA PANEL -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-md font-bold text-[#004a99] mb-4 uppercase flex items-center">
                                <i class="fas fa-image mr-2 text-[#ffc107]"></i> Poster / Gambar
                            </h3>
                            <div class="space-y-4">
                                @if($agenda->gambar)
                                    <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                        <img src="{{ asset('storage/' . $agenda->gambar) }}" class="w-full h-32 object-cover transition-transform group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <p class="text-white text-[10px] font-bold uppercase">Poster Sekarang</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-white hover:border-[#004a99] transition-colors cursor-pointer text-center group" onclick="document.getElementById('gambar').click()">
                                    <i class="fas fa-sync text-2xl text-gray-300 group-hover:text-[#004a99] mb-1"></i>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase">Ganti Poster?</p>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img src="" class="w-full h-32 object-cover rounded-lg border border-gray-200 border-2 border-[#ffc107]">
                                </div>
                                @error('gambar') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
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
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Update Agenda
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
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignjustify align | link image table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 600,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false,
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #475569; text-align: justify; }'
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
