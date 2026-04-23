@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8 text-gray-800">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between text-gray-800">
            <div class="text-gray-800">
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-plus-circle mr-2 text-[#ffc107] text-gray-800"></i> Buat Informasi <span class="text-gray-800">Serta Merta</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Publikasikan dokumen krusial baru ke masyarakat</p>
            </div>
            <a href="{{ route('admin.informasi.sertamerta') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-times mr-2"></i> Batalkan
            </a>
        </div>

        <form action="{{ route('admin.informasi.sertamerta.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-8">
                    
                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Informasi</label>
                        <input type="text" name="judul" required value="{{ old('judul') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]"
                            placeholder="Contoh: Pengumuman Darurat Banjir Bandang">
                    </div>

                    <!-- Date Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Tanggal Publikasi</label>
                        <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c]">
                    </div>

                    <!-- Content/Description Field -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Deskripsi / Detail Informasi</label>
                        <div class="rounded-3xl overflow-hidden border-2 border-slate-100 text-gray-800">
                            <textarea name="konten" id="editor" class="tinymce-editor text-gray-800">{{ old('konten') }}</textarea>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-3 text-gray-800">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block text-gray-800">Lampiran Dokumen (PDF/DOC/JPG)</label>
                        <div class="relative group">
                            <input type="file" name="file" id="file" class="hidden" onchange="updateFileName(this)">
                            <div onclick="document.getElementById('file').click()" 
                                class="w-full p-10 border-4 border-dashed border-slate-100 rounded-[2rem] flex flex-col items-center justify-center cursor-pointer group-hover:border-[#004a99]/20 group-hover:bg-blue-50/30 transition-all">
                                <i class="fas fa-cloud-upload-alt text-5xl text-slate-200 group-hover:text-[#004a99] mb-4 transition-all"></i>
                                <p id="file-name-display" class="text-sm font-black text-slate-400 uppercase tracking-widest text-center">Tarik file ke sini atau klik untuk memilih</p>
                                <p class="text-[10px] text-slate-300 font-bold mt-2 uppercase">Maksimal 10MB</p>
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
                            <input type="checkbox" name="aktif" value="1" checked class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#004a99]"></div>
                        </label>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 text-gray-800">
                <button type="submit" class="px-16 py-6 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-[2rem] shadow-2xl shadow-blue-900/20 hover:bg-black hover:-translate-y-1 transition-all border-none cursor-pointer">
                    <i class="fas fa-check-circle mr-3 text-[#ffc107]"></i> Publikasikan Sekarang
                </button>
            </div>

        </form>
    </div>
</div>

<script>
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
