@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
@endphp

@section('content')
<div class="max-w-7xl mx-auto space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION - CLEAR & BOLD -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#002b5c] tracking-tight">
                Master <span class="text-[#004a99]">DIP Master</span>
            </h1>
            <p class="text-slate-700 text-lg font-bold mt-2">Inventaris Daftar Informasi Publik - Kendali Penuh Terpusat</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="http://ppid.pktj.ac.id/layanan-informasi/daftar" target="_blank" class="px-6 py-4 bg-white border-2 border-slate-200 text-[#002b5c] font-black rounded-xl shadow-md hover:bg-slate-50 transition-all flex items-center text-sm">
                <i class="fas fa-eye mr-3"></i> LIHAT PORTAL
            </a>
            <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="px-6 py-4 bg-[#002b5c] text-white font-black rounded-xl shadow-xl hover:bg-black transition-all flex items-center text-sm border-none cursor-pointer">
                <i class="fas fa-plus-circle mr-3 text-[#ffc107]"></i> TAMBAH DATA DIP
            </a>
        </div>
    </div>

    <!-- HERO CONFIG - MAXIMUM CLARITY -->
    <div class="bg-white rounded-[2.5rem] shadow-lg border-2 border-slate-100 overflow-hidden">
        <div class="p-10 space-y-8">
            <div class="flex items-center justify-between border-b-2 border-slate-50 pb-6">
                <h3 class="text-xl font-black text-[#002b5c] uppercase tracking-widest flex items-center">
                    <span class="w-10 h-10 bg-[#ffc107] text-[#002b5c] rounded-xl flex items-center justify-center mr-4 text-lg">
                        <i class="fas fa-desktop"></i>
                    </span>
                    Informasi Header Halaman
                </h3>
            </div>
            
            <form action="{{ route('admin.halaman-custom.store', 'layanan_daftar') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                <div class="space-y-3">
                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Judul Halaman Depan</label>
                    <input type="text" name="judul_hero" value="{{ $settings['layanan_daftar_judul_hero'] ?? 'Daftar Informasi Publik' }}"
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 focus:border-[#002b5c] outline-none transition-all font-bold text-[#002b5c] text-lg">
                </div>
                <div class="space-y-3">
                    <label class="text-sm font-black text-[#002b5c] uppercase tracking-widest">Tagline Deskripsi</label>
                    <input type="text" name="tagline_hero" value="{{ $settings['layanan_daftar_tagline_hero'] ?? '' }}"
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-200 rounded-2xl focus:ring-4 focus:ring-[#002b5c]/10 focus:border-[#002b5c] outline-none transition-all font-bold text-[#002b5c] text-lg">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-[#002b5c] text-white font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-black transition-all border-none cursor-pointer">
                        Simpan Perubahan Identitas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DATA TABLE AREA - ULTRA READABLE -->
    <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
        <!-- SEARCH BOX -->
        <div class="p-10 border-b-2 border-slate-50">
            <div class="relative w-full">
                <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-[#002b5c] text-xl"></i>
                <input type="text" class="w-full pl-16 pr-6 py-5 bg-slate-50 border-2 border-slate-200 rounded-2xl text-lg font-bold text-[#002b5c] focus:bg-white outline-none transition-all placeholder-[#002b5c]/30" placeholder="CARI DATA DIP (JUDUL, KATEGORI, PEJABAT)...">
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#002b5c] text-[#ffc107]">
                        <th class="px-10 py-6 text-sm font-black uppercase tracking-widest">DETAIL INFORMASI</th>
                        <th class="px-10 py-6 text-sm font-black uppercase tracking-widest">OTORITAS DATA</th>
                        <th class="px-10 py-6 text-sm font-black uppercase tracking-widest text-center">KLASIFIKASI</th>
                        <th class="px-10 py-6 text-sm font-black uppercase tracking-widest text-right">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-slate-50">
                    @for ($i = 1; $i <= 5; $i++)
                    <tr class="hover:bg-blue-50/30 transition-all">
                        <td class="px-10 py-8">
                            <h4 class="text-lg font-black text-[#002b5c] mb-2">Laporan Realisasi Anggaran PKTJ {{ 2025 - $i }}</h4>
                            <div class="flex items-center gap-3">
                                <span class="bg-[#002b5c] text-white px-3 py-1 rounded-md text-[13px] font-black">PDF DOKUMEN</span>
                                <span class="text-slate-800 font-bold text-[13px] tracking-wider">ID: DIP-2025-{{$i}}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-md font-black text-[#004a99] uppercase">Kepala PKTJ Tegal</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">UNIT: SUB BAGIAN KEUANGAN</p>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="inline-flex px-4 py-1.5 bg-[#ffc107] text-[#002b5c] rounded-full text-[13px] font-black uppercase tracking-widest shadow-sm">BERKALA</span>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center justify-end gap-3">
                                <a href="#" class="w-12 h-12 bg-white text-[#002b5c] rounded-xl flex items-center justify-center border-2 border-slate-200 hover:bg-[#002b5c] hover:text-white transition-all shadow-md">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <a href="#" class="w-12 h-12 bg-white text-red-600 rounded-xl flex items-center justify-center border-2 border-slate-200 hover:bg-red-600 hover:text-white transition-all shadow-md">
                                    <i class="fas fa-trash text-lg"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- PAGINATION - CLEAR -->
        <div class="p-10 bg-slate-50 border-t-2 border-slate-100 flex flex-col md:flex-row justify-between items-center gap-10">
            <p class="text-sm font-black text-[#002b5c] uppercase tracking-widest">
                Halaman 1 <span class="mx-3 text-[#ffc107]">|</span> Total 42 Data Master DIP
            </p>
            <div class="flex items-center gap-3">
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-slate-200 text-[#002b5c] hover:bg-[#ffc107] transition-all">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="flex items-center gap-2">
                    <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-[#002b5c] text-white font-black shadow-lg">1</button>
                    <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-slate-200 text-[#002b5c] font-black hover:bg-slate-100 transition-all">2</button>
                    <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-slate-200 text-[#002b5c] font-black hover:bg-slate-100 transition-all">3</button>
                </div>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-slate-200 text-[#002b5c] hover:bg-[#ffc107] transition-all">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
