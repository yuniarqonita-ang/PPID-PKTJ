@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-[#004a99] hover:text-blue-700 transition-colors mb-2 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-list-check mr-2 text-[#ffc107]"></i> Daftar Informasi Publik
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-widest text-[10px]">Administrasi Inventaris Master Informasi (DIP) PKTJ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/daftar-informasi') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-eye mr-2"></i> Preview Publik
                </a>
                <a href="{{ route('admin.layanan.daftar-informasi.create') }}" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                    <i class="fas fa-plus mr-2 text-[#ffc107]"></i> Tambah Master DIP
                </a>
            </div>
        </div>

        <!-- SEARCH & FILTER -->
        <div class="bg-white p-6 rounded-3xl shadow-xl ring-1 ring-gray-200 flex flex-col md:flex-row items-center gap-4">
            <div class="relative flex-1 group">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#004a99] transition-colors"></i>
                <input type="text" class="w-full pl-14 pr-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-4 focus:ring-[#004a99]/5 focus:border-[#004a99] outline-none transition-all placeholder-gray-400 tracking-wide uppercase" placeholder="CARI BERDASARKAN JUDUL ATAU PEJABAT...">
            </div>
            <div class="flex gap-2">
                <button class="px-6 py-4 bg-white border border-gray-200 rounded-2xl text-[10px] font-black tracking-widest text-[#004a99] uppercase hover:bg-gray-50 transition-all">
                    <i class="fas fa-filter mr-2"></i> Filter Kategori
                </button>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#004a99] text-white">
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Informasi</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Pejabat Penguasa</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">Tipe</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">Bentuk</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 uppercase">
                        @for ($i = 1; $i <= 5; $i++)
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="px-6 py-5">
                                <h4 class="text-sm font-bold text-[#004a99] uppercase tracking-wide">Laporan Keuangan Tahunan {{ date('Y') - $i }}</h4>
                                <p class="text-[9px] text-gray-400 mt-1 font-bold whitespace-nowrap overflow-hidden text-ellipsis max-w-xs lowercase">Ringkasan laporan keuangan audit ppsdm perhubungan...</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-[10px] font-black text-gray-700">KEPALA PKTJ TEGAL</p>
                                <p class="text-[8px] text-gray-400 uppercase font-black">PKTJ TEGAL</p>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-blue-100 text-[#004a99] rounded-full text-[9px] font-black uppercase tracking-wider">BERKALA</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-[10px] font-black text-gray-400 flex items-center justify-center gap-2">
                                    <i class="fas fa-file-pdf text-red-500"></i> SOFTCOPY
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="#" class="p-3 bg-gray-50 text-gray-400 rounded-xl hover:bg-[#004a99] hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="p-3 bg-gray-50 text-gray-400 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- FOOTER TABLE / PAGINATION -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    MENAMPILKAN 1-5 DARI 670 DATA DIP
                </p>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-400 hover:text-[#004a99] transition-all">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#004a99] text-white font-black text-xs">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition-all text-xs">2</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition-all text-xs">3</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-400 hover:text-[#004a99] transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
