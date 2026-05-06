@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                    <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Keberatan: Aktif</h2>
                </div>
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Keberatan <span class="text-[#ffc107]">Informasi</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Manajemen pengajuan keberatan atas permohonan informasi publik.</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                <form action="{{ route('admin.keberatan.index') }}" method="GET" class="flex items-center gap-2 bg-white/10 p-2 rounded-2xl border border-white/20 w-full sm:w-auto">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-transparent text-white text-[10px] border-none focus:ring-0 p-1 w-24">
                    <span class="text-white/50 text-[10px]">s/d</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-transparent text-white text-[10px] border-none focus:ring-0 p-1 w-24">
                    <button type="submit" class="p-2 bg-[#ffc107] text-[#004a99] rounded-xl hover:scale-105 transition-all">
                        <i class="fas fa-search text-xs"></i>
                    </button>
                </form>
                <div class="flex flex-col gap-2 w-full md:w-48">
                    <a href="{{ route('admin.keberatan.export.excel', request()->all()) }}" class="w-full px-4 py-3 bg-green-600 border border-green-500 text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-green-700 transition-all flex items-center justify-center">
                        <i class="fas fa-file-excel mr-2"></i> Unduh Register
                    </a>
                    <a href="{{ route('admin.keberatan.form') }}" class="w-full px-4 py-3 bg-[#ffc107] text-[#004a99] font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg hover:scale-[1.02] transition-all flex items-center justify-center border-none cursor-pointer">
                        <i class="fas fa-cog mr-2"></i> Peraturan Form
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-xl mb-6 shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-blue-600"></i>
                <p class="text-blue-800 font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] shadow-xl ring-1 ring-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Registrasi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Identitas Pengaju</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ref. Permohonan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alasan Keberatan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($keberatans as $item)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-6 py-4">
                            <div class="font-black text-slate-800 text-sm tracking-tight">{{ $item->nomor_registrasi_keberatan }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">{{ $item->tanggal_keberatan->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-700 text-xs uppercase">{{ $item->nama_pemohon }}</div>
                            <div class="text-[10px] text-slate-400">{{ $item->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->permohonan)
                                <a href="{{ route('admin.permohonan.show', $item->permohonan_id) }}" class="text-blue-600 font-black text-[10px] uppercase hover:underline">
                                    ID: #{{ $item->permohonan_id }}
                                </a>
                            @else
                                <span class="text-slate-300 italic text-[10px]">Data dihapus</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @if(is_array($item->alasan_keberatan_list))
                                    @foreach($item->alasan_keberatan_list as $reason)
                                        <span class="px-2 py-0.5 bg-amber-50 text-amber-600 rounded-md text-[9px] font-black uppercase border border-amber-100">{{ $reason }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider
                                {{ $item->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 
                                   ($item->status == 'processed' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.keberatan.show', $item->id) }}" class="w-8 h-8 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.keberatan.edit', $item->id) }}" class="w-8 h-8 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <a href="{{ route('admin.keberatan.export.word', $item->id) }}" class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center hover:bg-blue-700 transition-all shadow-sm" title="Unduh Formulir (Word)">
                                    <i class="fas fa-file-word text-xs"></i>
                                </a>
                                <form action="{{ route('admin.keberatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 text-3xl">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div class="text-slate-400 font-bold uppercase text-xs tracking-widest italic">Belum ada data keberatan permohonan informasi</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($keberatans->hasPages())
        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
            {{ $keberatans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
