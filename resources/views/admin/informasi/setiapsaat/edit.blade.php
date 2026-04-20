@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 text-gray-800">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-edit mr-2 text-[#ffc107] text-gray-800"></i> Edit Informasi <span class="text-gray-800">Setiap Saat</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Perbarui detail dokumen informasi setiap saat</p>
            </div>
            <a href="{{ route('admin.informasi.setiapsaat') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.informasi.setiapsaat.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-8">
                    
                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Judul Informasi</label>
                        <input type="text" name="judul" required value="{{ old('judul', $item->judul) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]">
                    </div>

                    <!-- Date Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal', \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d')) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                    </div>

                    <!-- Content/Description Field -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Deskripsi / Detail Informasi</label>
                        <div class="rounded-3xl overflow-hidden border-2 border-slate-100 text-gray-800">
                            <textarea name="deskripsi" id="editor" class="tinymce-editor text-gray-800">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Lampiran Dokumen (Biarkan kosong jika tidak diubah)</label>
                        @if($item->file_path)
                            <div class="mb-4 p-4 bg-blue-50 border-2 border-blue-100 rounded-2xl flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-file-invoice text-2xl text-[#004a99]"></i>
                                    <div>
                                        <p class="text-xs font-black text-[#002b5c] uppercase">File Saat Ini:</p>
                                        <p class="text-[10px] font-bold text-slate-500 truncate max-w-xs">{{ $item->file_name ?? basename($item->file_path) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset($item->file_path) }}" target="_blank" class="text-xs font-black text-[#004a99] uppercase hover:underline">Lihat File</a>
                            </div>
                        @endif
                        <div class="relative group">
                            <input type="file" name="file" id="file" class="hidden" onchange="updateFileName(this)">
                            <div onclick="document.getElementById('file').click()" 
                                class="w-full p-10 border-4 border-dashed border-slate-100 rounded-[2rem] flex flex-col items-center justify-center cursor-pointer group-hover:border-[#004a99]/20 group-hover:bg-blue-50/30 transition-all">
                                <i class="fas fa-cloud-upload-alt text-5xl text-slate-200 group-hover:text-[#004a99] mb-4 transition-all"></i>
                                <p id="file-name-display" class="text-sm font-black text-slate-400 uppercase tracking-widest text-center">Ganti file dengan klik di sini</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Toggle -->
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between text-gray-800">
                        <div>
                            <h4 class="text-sm font-black text-[#002b5c] uppercase tracking-widest text-gray-800">Status Publikasi</h4>
                            <p class="text-xs text-gray-400 font-medium">Aktifkan agar langsung muncul di website publik</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="aktif" value="1" {{ $item->aktif ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#004a99]"></div>
                        </label>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 text-gray-800">
                <button type="submit" class="px-16 py-6 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-[2rem] shadow-2xl shadow-blue-900/20 hover:bg-black hover:-translate-y-1 transition-all border-none cursor-pointer">
                    <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> Simpan Perubahan
                </button>
            </div>

        </form>
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
        content_style: 'body { font-family:"Inter",sans-serif; font-size:16px; color: #1e293b; text-align: justify; }'
    });

    function updateFileName(input) {
        const display = document.getElementById('file-name-display');
        if (input.files && input.files[0]) {
            display.innerText = input.files[0].name;
            display.classList.remove('text-slate-400');
            display.classList.add('text-[#004a99]');
        }
    }
</script>
@endsection
