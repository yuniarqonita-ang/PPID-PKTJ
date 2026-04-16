@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.informasi.dikecualikan') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Panel
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-user-shield mr-2 text-[#ffc107]"></i> Klasifikasi Informasi Dikecualikan
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Lakukan uji konsekuensi dan unggah berkas klasifikasi terbaru</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-red-500">
            <form action="{{ route('admin.informasi.dikecualikan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-10 space-y-10">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                    <!-- MAIN DATA (Left) -->
                    <div class="lg:col-span-3 space-y-8">
                        
                        <!-- INFORMASI & DASAR HUKUM -->
                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="informasi" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                    Nama / Judul Informasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="informasi" id="informasi" value="{{ old('informasi') }}" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 focus:outline-none transition-all shadow-sm"
                                    placeholder="Contoh: Dokumen Pengadaan Barang Strategis">
                            </div>

                            <div class="space-y-2">
                                <label for="dasar_hukum" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
                                    Dasar Hukum Pengecualian <span class="text-red-500">*</span>
                                </label>
                                <textarea name="dasar_hukum" id="dasar_hukum" rows="2" required
                                    class="w-full px-5 py-3 bg-gray-50 border border-gray-300 rounded-2xl text-gray-800 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 focus:outline-none transition-all shadow-sm resize-none"
                                    placeholder="UU No. 14 Tahun 2008 Pasal 17 Huruf b...">{{ old('dasar_hukum') }}</textarea>
                            </div>
                        </div>

                        <!-- KONSEKUENSI SECTION -->
                        <div class="space-y-6">
                            <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em] flex items-center bg-blue-50/50 p-3 rounded-xl border border-blue-100">
                                <i class="fas fa-balance-scale mr-3 text-[#ffc107]"></i> Uji Konsekuensi (Detail Pertimbangan)
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-green-600 uppercase tracking-widest pl-1">
                                        <i class="fas fa-check-circle mr-1"></i> Jika Informasi Dibuka
                                    </label>
                                    <div class="rounded-2xl overflow-hidden border border-gray-300 bg-white">
                                        <textarea name="konsekuensi_dibuka" id="editor_dibuka" class="tinymce-editor text-gray-800">{{ old('konsekuensi_dibuka') }}</textarea>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-[11px] font-black text-red-600 uppercase tracking-widest pl-1">
                                        <i class="fas fa-times-circle mr-1 text-gray-800"></i> Jika Informasi Ditutup
                                    </label>
                                    <div class="rounded-2xl overflow-hidden border border-gray-300 bg-white">
                                        <textarea name="konsekuensi_ditutup" id="editor_ditutup" class="tinymce-editor">{{ old('konsekuensi_ditutup') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SIDEBAR (Right) -->
                    <div class="space-y-8">
                        
                        <!-- JANGKA WAKTU -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-6 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-hourglass-half mr-2 text-[#ffc107]"></i> Jangka Waktu
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Mulai</label>
                                    <input type="date" name="tanggal_mulai" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:ring-2 focus:ring-[#004a99]">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 text-gray-800">Selesai</label>
                                    <input type="date" name="tanggal_selesai" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:ring-2 focus:ring-[#004a99]">
                                </div>
                            </div>
                        </div>

                        <!-- PIC -->
                        <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200">
                            <h3 class="text-xs font-black text-[#004a99] mb-4 uppercase tracking-[0.2em] flex items-center">
                                <i class="fas fa-user-edit mr-2 text-[#ffc107]"></i> Penanggung Jawab
                            </h3>
                            <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" required
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:ring-2 focus:ring-[#004a99] focus:outline-none"
                                placeholder="Nama & Jabatan PIC">
                        </div>

                        <!-- UPLOAD PANEL -->
                        <div class="bg-white rounded-3xl p-6 border-2 border-dashed border-gray-200 hover:border-red-400 transition-all text-center group cursor-pointer" onclick="document.getElementById('fileInput').click()">
                            <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-red-50 group-hover:text-red-500 transition-all">
                                <i class="fas fa-file-shield text-xl"></i>
                            </div>
                            <p class="text-[10px] font-black uppercase text-gray-400 group-hover:text-red-500">Unggah Berkas Uji</p>
                            <input type="file" name="file" id="fileInput" accept=".pdf,.doc,.docx" class="hidden" onchange="handleFile(this)">
                            <div id="fileInfo" class="hidden mt-3 p-2 bg-red-50 rounded-xl text-[9px] font-bold text-red-500 border border-red-100 animate-fade-in-down truncate"></div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 text-gray-800">
                    <button type="button" onclick="history.back()" class="px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-10 py-4 bg-red-500 text-white font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-red-500/20 hover:bg-red-600 transition-all transform hover:scale-[1.02] flex items-center justify-center">
                        <i class="fas fa-lock mr-2 text-white"></i> Simpan Data Rahasia
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
        height: 250,
        branding: false,
        elementpath: false,
        menubar: false,
        promotion: false
    });

    function handleFile(input) {
        if (input.files && input.files[0]) {
            const info = document.getElementById('fileInfo');
            info.innerText = 'TERPILIH: ' + input.files[0].name;
            info.classList.remove('hidden');
        }
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
