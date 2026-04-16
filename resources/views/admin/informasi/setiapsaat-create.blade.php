@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.informasi.setiapsaat') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Informasi Setiap Saat
                </h1>
                <p class="text-gray-500 font-medium mt-1">Lengkapi basis data informasi publik PKTJ dengan dokumen terbaru</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#ffc107]">
            <form action="{{ route('admin.informasi.setiapsaat.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- MAIN FIELDS -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- JUDUL -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Judul Informasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm"
                                placeholder="Contoh: Daftar Laporan Kinerja Instansi">
                            @error('judul') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- KATEGORI -->
                        <div class="space-y-2">
                            <label for="kategori" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Kategori Dokumen <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="kategori" id="kategori" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-[#004a99]/10 focus:border-[#004a99] focus:outline-none transition-all shadow-sm appearance-none">
                                    <option value="">-- Pilih Kategori Informasi --</option>
                                    <option value="daftar-informasi">Daftar Informasi Publik</option>
                                    <option value="prosedur-layanan">Prosedur Pelayanan</option>
                                    <option value="jadwal-pelayanan">Jadwal Pelayanan</option>
                                    <option value="biaya-tarif">Biaya dan Tarif</option>
                                    <option value="hasil-pelayanan">Hasil Pelayanan</option>
                                    <option value="pengaduan">Pengaduan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#004a99]">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            @error('kategori') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- ISI KONTEN -->
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                Keterangan / Isi Informasi <span class="text-red-500">*</span>
                            </label>
                            <div class="rounded-2xl overflow-hidden border border-gray-300">
                                <textarea name="konten" id="editor_setiapsaat" class="tinymce-editor">{{ old('konten') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <!-- SIDEBAR / UPLOAD -->
                    <div class="space-y-6 text-gray-800">
                        
                        <!-- UPLOAD PANEL -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 shadow-inner">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-paperclip mr-2 text-[#ffc107]"></i> Dokumen Lampiran
                            </h3>
                            
                            <div class="space-y-4">
                                <div class="relative group cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-white hover:border-[#004a99] hover:bg-blue-50/50 transition-all text-center" 
                                     onclick="document.getElementById('fileInput').click()">
                                    <div class="space-y-2">
                                        <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center mx-auto transition-transform group-hover:scale-110">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-700 uppercase">Pilih Berkas</p>
                                            <p class="text-[9px] text-gray-400 mt-1 font-medium">PDF, DOC, XLS (MAX 10MB)</p>
                                        </div>
                                    </div>
                                    <input type="file" name="file" id="fileInput" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden" onchange="handleFileSelect(this)">
                                </div>

                                <div id="fileNameDisplay" class="hidden animate-fade-in-down">
                                    <div class="flex items-center p-3 bg-white rounded-xl border border-green-200 shadow-sm overflow-hidden">
                                        <div class="w-8 h-8 bg-green-50 text-green-500 rounded-lg flex items-center justify-center mr-3 text-xs shrink-0">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p id="selectedFileName" class="text-[10px] font-bold text-gray-700 truncate"></p>
                                            <p class="text-[9px] text-green-500 font-bold uppercase">Siap Diunggah</p>
                                        </div>
                                        <button type="button" onclick="resetFile()" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('file') <p class="text-red-500 text-[10px] font-bold mt-1 text-center">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- TIPS PANEL -->
                        <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl font-bold"></div>
                            <h4 class="text-[11px] font-black uppercase tracking-widest mb-3 flex items-center text-gray-800">
                                <i class="fas fa-lightbulb mr-2 text-[#ffc107]"></i> Tips Admin
                            </h4>
                            <p class="text-[10px] leading-relaxed opacity-90 font-medium">
                                Pastikan penamaan file dokumen jelas dan informatif agar mudah dicari oleh masyarakat di halaman publik.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 text-gray-800">
                    <button type="button" onclick="history.back()" class="px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all flex items-center justify-center">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-4 bg-[#004a99] text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform hover:scale-[1.02] transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2 text-[#ffc107]"></i> Simpan & Publikasi
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
        height: 350,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const info = document.getElementById('fileNameDisplay');
            const nameEl = document.getElementById('selectedFileName');
            
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 10MB.');
                input.value = '';
                return;
            }

            nameEl.innerText = file.name;
            info.classList.remove('hidden');
        }
    }

    function resetFile() {
        const input = document.getElementById('fileInput');
        const info = document.getElementById('fileNameDisplay');
        input.value = '';
        info.classList.add('hidden');
    }
</script>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
