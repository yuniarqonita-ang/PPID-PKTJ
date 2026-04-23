@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- DASHBOARD-STYLE HEADER SECTION -->
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Konten: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Manajemen <span class="text-[#ffc107]">Berita</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Publikasikan informasi terkini dan pengumuman resmi PPID.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.berita.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Buat Berita Baru
                </a>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60">
        <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#004a99] focus:bg-white focus:outline-none text-sm font-semibold transition-all"
                    placeholder="Cari judul berita atau isi konten...">
            </div>
            <button type="submit" class="px-8 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-[#002b5c] transition-all">
                Cari & Filter
            </button>
        </form>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4">
        <i class="fas fa-check-circle text-xl"></i>
        <p class="font-bold">{{ session('success') }}</p>
    </div>
    @endif

    <!-- TABLE SECTION -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Detail Artikel</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Publikasi</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px] text-center">Views</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px] text-center">Status</th>
                        <th class="px-8 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($beritas as $berita)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200/60 shadow-sm relative">
                                        @if($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                                                <i class="fas fa-image text-2xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-black text-[#002b5c] group-hover:text-[#004a99] transition-colors leading-tight mb-2">
                                            {{ Str::limit($berita->judul, 75) }}
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center">
                                                <i class="fas fa-feather-alt mr-1.5 text-[#ffc107]"></i> Admin PPID
                                            </span>
                                            <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                                {{ $berita->kategori ?? 'Berita Utama' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-black text-slate-600 uppercase tracking-tight">
                                    {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                                    {{ $berita->updated_at ? $berita->updated_at->diffForHumans() : '-' }}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-xs font-black text-[#004a99] bg-blue-50 px-3 py-1 rounded-full">
                                    {{ number_format($berita->views ?? 0) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($berita->status == 'published' || ($berita->is_published ?? true))
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center gap-2 mx-auto w-fit">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-xl bg-amber-50 text-amber-600 border border-amber-100 inline-block">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.berita.edit', $berita) }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-[#004a99] hover:border-[#004a99] hover:bg-blue-50 transition-all flex items-center justify-center group/btn shadow-sm" title="Edit Berita">
                                        <i class="fas fa-edit text-sm group-hover/btn:scale-110"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all flex items-center justify-center group/btn shadow-sm" title="Hapus Berita">
                                            <i class="fas fa-trash-alt text-sm group-hover/btn:scale-110"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center bg-slate-50/30">
                                <div class="max-w-xs mx-auto space-y-3 opacity-30">
                                    <i class="fas fa-newspaper text-6xl"></i>
                                    <p class="text-sm font-bold uppercase tracking-widest">Belum ada konten berita</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($beritas->hasPages())
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $beritas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
