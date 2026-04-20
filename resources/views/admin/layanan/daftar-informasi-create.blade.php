@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                Tambah <span class="text-[#004a99]">Master DIP</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Registrasi Inventaris Master Daftar Informasi Publik - Baru</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.layanan.daftar-informasi.index') }}" class="inline-flex items-center text-[#002b5c] hover:text-black transition-colors text-sm font-black uppercase tracking-widest leading-loose">
                <i class="fas fa-arrow-left mr-3"></i> KEMBALI KE DAFTAR
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="p-6 bg-emerald-50 border-2 border-emerald-200 rounded-3xl flex items-center gap-5">
        <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg">
            <i class="fas fa-check"></i>
        </div>
        <div>
            <p class="text-sm font-black text-emerald-900 uppercase tracking-widest">Data Berhasil Disimpan</p>
            <p class="text-lg font-bold text-emerald-700 mt-1">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.layanan.daftar-informasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- LEFT COLUMN: MAIN FORM -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- CARD 1: INFORMASI DASAR -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
                    <div class="p-10 space-y-10">
                        <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                            <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                                <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                Klasifikasi & Judul Utama
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-10">
                            <div class="space-y-4">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">JUDUL INFORMASI PUBLIK *</label>
                                <input type="text" name="judul_informasi" required
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 focus:border-[#002b5c] outline-none transition-all font-bold text-[#002b5c] text-lg"
                                    placeholder="Masukkan judul informasi yang sangat jelas...">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">KATEGORI INFORMASI *</label>
                                    <select name="kategori" required class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 appearance-none cursor-pointer font-black text-[#002b5c] text-md">
                                        <option value="">PILIH KATEGORI</option>
                                        <option value="informasi-berkala">INFORMASI BERKALA</option>
                                        <option value="informasi-serta-merta">INFORMASI SERTA MERTA</option>
                                        <option value="informasi-setiap-saat">INFORMASI SETIAP SAAT</option>
                                        <option value="informasi-dikecualikan">INFORMASI DIKECUALIKAN</option>
                                    </select>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">TIPE ARSIP KHUSUS</label>
                                    <select name="tipe_informasi" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 appearance-none cursor-pointer font-black text-[#002b5c] text-md">
                                        <option value="berkala">BERKALA</option>
                                        <option value="setiapsaat">SETIAP SAAT</option>
                                        <option value="sertamerta">SERTA MERTA</option>
                                        <option value="dikecualikan">DIKECUALIKAN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: KONTEN DETAIL -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
                    <div class="p-10 space-y-8">
                        <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                            <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                                <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                Ringkasan Isi Informasi
                            </h3>
                        </div>

                        <div class="space-y-6">
                            <textarea id="editor_isi" name="isi_informasi" class="tinymce-editor"></textarea>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: ADMINISTRATIF -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
                    <div class="p-10 space-y-10">
                        <div class="flex items-center justify-between border-b-2 border-slate-50 pb-8">
                            <h3 class="text-lg font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                                <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-sm">
                                    <i class="fas fa-user-shield"></i>
                                </span>
                                Otoritas & Tanggung Jawab
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-4">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">PEJABAT PENGUASA INFORMASI *</label>
                                <input type="text" name="pejabat_penguasa" required
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]"
                                    placeholder="Nama Pejabat/Kepala...">
                            </div>
                            <div class="space-y-4">
                                <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest ml-1">PENANGGUNG JAWAB UNIT *</label>
                                <input type="text" name="penanggung_jawab" required
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-bold text-[#002b5c]"
                                    placeholder="Nama Unit Kerja/Seksi...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: SIDEBAR CONFIG -->
            <div class="lg:col-span-4 space-y-10">
                
                <!-- ATTRIBUTES CARD -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 p-10 space-y-10">
                    <h3 class="text-sm font-black text-[#002b5c] uppercase tracking-[3px] border-b-2 border-slate-50 pb-8 flex items-center">
                        <i class="fas fa-tags mr-3 text-[#ffc107]"></i> ATRIBUT TEKNIS
                    </h3>

                    <div class="space-y-8">
                        <div class="space-y-3">
                            <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Waktu Pembuatan</label>
                            <input type="text" name="waktu_pembuatan"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c]"
                                placeholder="CONTOH: TAHUN 2025">
                        </div>
                        <div class="space-y-3">
                            <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Bentuk Informasi</label>
                            <input type="text" name="bentuk_informasi"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c]"
                                placeholder="CONTOH: SOFTCOPY / PDF">
                        </div>
                        <div class="space-y-3">
                            <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Jangka Penyimpanan</label>
                            <input type="text" name="jangka_waktu"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 text-lg font-black text-[#002b5c]"
                                placeholder="SELAMA BERLAKU / 5 TAHUN">
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="relative group border-4 border-dashed border-slate-200 rounded-[2rem] p-10 hover:border-[#002b5c] transition-all bg-slate-50 text-center">
                            <input type="file" name="file_informasi" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <i class="fas fa-file-pdf text-5xl text-[#002b5c] mb-5"></i>
                            <p class="text-[13px] font-black text-[#002b5c] uppercase tracking-widest">UNGGAH DOKUMEN (PDF ONLY)</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-6 bg-[#002b5c] text-white font-black text-md uppercase tracking-[3px] rounded-2xl shadow-2xl hover:bg-black transition-all border-none cursor-pointer">
                        <i class="fas fa-save mr-3 text-[#ffc107]"></i> SIMPAN DATA DIP
                    </button>
                    <p class="text-[12px] text-center text-slate-500 font-bold uppercase tracking-widest mt-4">Data akan otomatis terindeks di sistem publik</p>
                </div>

                <!-- HELP BOX - CLEAR -->
                <div class="bg-[#ffc107] rounded-[2.5rem] p-10 text-[#002b5c] shadow-xl relative overflow-hidden">
                    <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="w-14 h-14 bg-[#002b5c] text-white rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="space-y-3">
                            <h4 class="text-md font-black uppercase tracking-widest">Tips Pengisian</h4>
                            <p class="text-[14px] leading-relaxed font-bold">
                                Pastikan Judul Informasi ditulis dengan HURUF BALOK di awal kata untuk menjaga kerapihan tampilan di portal publik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
