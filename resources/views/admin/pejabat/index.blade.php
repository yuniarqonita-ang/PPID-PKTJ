@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Standar PPID Kemenhub: Slide 25</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Profil <span class="text-[#ffc107]">Pejabat Publik & LHKPN</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola foto, biografi, riwayat jabatan, dan laporan LHKPN jajaran Pimpinan PKTJ.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('informasi.berkala') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Halaman Berkala
                </a>
                <a href="{{ route('admin.pejabat.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Tambah Pejabat
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="p-6 bg-emerald-50 border-2 border-emerald-200 rounded-3xl flex items-center gap-5">
        <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg">
            <i class="fas fa-check"></i>
        </div>
        <p class="text-lg font-bold text-emerald-800">{{ session('success') }}</p>
    </div>
    @endif

    <!-- TABEL DAFTAR PEJABAT -->
    <div class="bg-white rounded-[2.5rem] shadow-xl border-2 border-slate-100 overflow-hidden">
        <div class="p-8 md:p-10 border-b-2 border-slate-50 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl font-black text-[#004a99] tracking-tight">Daftar Pimpinan & Pejabat</h3>
                <p class="text-slate-500 font-medium text-sm mt-1">Total {{ $pejabats->count() }} pejabat terdaftar di sistem.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b-2 border-slate-100 text-[#004a99] font-black text-xs uppercase tracking-widest">
                        <th class="py-5 px-6 text-center w-20">Urutan</th>
                        <th class="py-5 px-6 w-28 text-center">Foto</th>
                        <th class="py-5 px-6">Nama & NIP</th>
                        <th class="py-5 px-6">Jabatan</th>
                        <th class="py-5 px-6">LHKPN</th>
                        <th class="py-5 px-6 text-center">Status</th>
                        <th class="py-5 px-6 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-slate-50">
                    @forelse($pejabats as $p)
                    <tr class="hover:bg-slate-50/80 transition-all">
                        <td class="py-6 px-6 text-center font-black text-slate-400">
                            <span class="inline-flex items-center justify-center w-9 h-9 bg-slate-100 rounded-xl text-slate-700 font-black">
                                {{ $p->urutan }}
                            </span>
                        </td>
                        <td class="py-6 px-6 text-center">
                            @if($p->foto)
                                <img src="{{ asset($p->foto) }}" alt="{{ $p->nama }}" class="w-20 h-26 object-cover rounded-xl shadow-md border-2 border-white mx-auto" style="width: 75px; height: 98px; object-position: top center;">
                            @else
                                <div class="bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mx-auto text-xl border border-slate-200" style="width: 75px; height: 98px;">
                                    <i class="fas fa-user-tie fa-2x opacity-40"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-6 px-6">
                            <h4 class="font-black text-slate-900 text-base leading-tight">{{ $p->nama }}</h4>
                            <p class="text-xs font-bold text-slate-500 mt-1">NIP: {{ $p->nip ?? '-' }}</p>
                        </td>
                        <td class="py-6 px-6">
                            <span class="inline-block px-3 py-1 bg-blue-50 text-[#004a99] font-bold text-xs rounded-lg border border-blue-100">
                                {{ $p->jabatan }}
                            </span>
                        </td>
                        <td class="py-6 px-6">
                            @if($p->lhkpn_link || $p->lhkpn_file)
                                <a href="{{ $p->lhkpn_link ?? asset($p->lhkpn_file) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-700 font-bold text-xs rounded-lg hover:bg-emerald-100 transition-all">
                                    <i class="fas fa-file-invoice-dollar"></i> LHKPN ({{ $p->lhkpn_tahun ?? '2025/2026' }})
                                </a>
                            @else
                                <span class="text-xs text-slate-400 font-medium italic">Belum disematkan</span>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-center">
                            @if($p->aktif)
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 font-black text-xs rounded-full">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 font-black text-xs rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.pejabat.edit', $p->id) }}" class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 transition-all flex items-center justify-center text-sm shadow-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pejabat ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 transition-all flex items-center justify-center text-sm shadow-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400 font-bold">
                            Belum ada data pejabat. Klik tombol "Tambah Pejabat" untuk menambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
