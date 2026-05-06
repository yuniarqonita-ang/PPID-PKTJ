@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-4xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-file-upload mr-2 text-[#ffc107]"></i> Upload <span class="text-gray-800">Dokumen</span>
                </h1>
                <p class="text-gray-500 font-medium mt-1">Tambahkan arsip file atau laporan baru ke sistem</p>
            </div>
            <a href="{{ route('admin.dokumen.index') }}" class="text-xs font-black text-gray-400 hover:text-[#004a99] uppercase tracking-widest transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-[2.5rem] shadow-xl ring-1 ring-gray-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-8">
                    
                    <!-- Title Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Judul Dokumen / Laporan</label>
                        <input type="text" name="judul" required value="{{ old('judul') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-lg text-[#002b5c]"
                            placeholder="Masukkan judul dokumen yang jelas...">
                    </div>

                    <!-- Category Field -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Kategori Dokumen</label>
                        <select name="kategori" required
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#004a99]/10 focus:bg-white transition-all font-bold text-[#002b5c] appearance-none cursor-pointer">
                            <option value="Umum">Umum / Lainnya</option>
                            <option value="Laporan Layanan">Laporan Layanan Informasi</option>
                            <option value="Laporan Akses">Laporan Akses Informasi</option>
                            <option value="Laporan Survey">Laporan Survey Kepuasan</option>
                            <option value="Regulasi">Regulasi / Aturan</option>
                            <option value="SOP">Standar Operasional Prosedur (SOP)</option>
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-3">
                        <label class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">File Dokumen (PDF/DOC/DOCX)</label>
                        <div class="relative group">
                            <input type="file" name="file" id="file" class="hidden" onchange="updateFileName(this)" accept=".pdf,.doc,.docx">
                            <div onclick="document.getElementById('file').click()" 
                                class="w-full p-10 border-4 border-dashed border-slate-100 rounded-[2rem] flex flex-col items-center justify-center cursor-pointer group-hover:border-[#004a99]/20 group-hover:bg-blue-50/30 transition-all">
                                <i class="fas fa-cloud-upload-alt text-5xl text-slate-200 group-hover:text-[#004a99] mb-4 transition-all"></i>
                                <p id="file-name-display" class="text-sm font-black text-slate-400 uppercase tracking-widest text-center">Tarik file ke sini atau klik untuk memilih</p>
                                <p class="text-[10px] text-slate-300 font-bold mt-2 uppercase text-center">Maksimal 5MB (PDF, DOC, DOCX)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Premium View Toggle -->
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-black text-[#004a99] uppercase tracking-[2px] block">Premium View (Blurring)</span>
                            <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase">Aktifkan efek blur untuk halaman kedua dan seterusnya.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_blurred" value="1" class="sr-only peer">
                            <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#ffc107]"></div>
                        </label>
                    </div>

                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="submit" class="px-16 py-6 bg-[#004a99] text-white font-black text-xs uppercase tracking-[3px] rounded-[2rem] shadow-2xl shadow-blue-900/20 hover:bg-black hover:-translate-y-1 transition-all border-none cursor-pointer">
                    <i class="fas fa-cloud-upload-alt mr-3 text-[#ffc107]"></i> Mulai Upload
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
