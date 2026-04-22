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
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Agenda: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Kelola <span class="text-[#ffc107]">Agenda</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Jadwal kegiatan dan agenda penting PPID PKTJ.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.agenda.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Tambah Agenda Baru
                </a>
            </div>
        </div>
    </div>

        <!-- ALERTS -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#004a99]">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#004a99] text-white">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center w-16">#</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Kegiatan / Agenda</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Tanggal Pelaksanaan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($agendas as $index => $agenda)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-gray-400 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-[#004a99] group-hover:text-blue-700 transition-colors leading-relaxed">
                                        {{ $agenda->judul }}
                                    </div>
                                    @if($agenda->keterangan)
                                        <div class="text-[10px] text-gray-400 italic truncate max-w-xs mt-1">
                                            {{ Str::limit(strip_tags($agenda->keterangan), 50) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center px-3 py-1 bg-blue-50 text-[#004a99] rounded-lg border border-blue-100 font-bold text-xs">
                                        <i class="far fa-calendar-check mr-2"></i>
                                        {{ $agenda->tanggal ? \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($agenda->aktif)
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-green-100 text-green-600 border border-green-200">
                                            AKTIF
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-gray-100 text-gray-400 border border-gray-200">
                                            ARSIP
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.agenda.edit', $agenda) }}" class="p-2 w-10 h-10 rounded-lg bg-blue-50 text-[#004a99] hover:bg-[#004a99] hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit Agenda">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 w-10 h-10 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Hapus Agenda">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-500 font-medium italic bg-gray-50">
                                    <i class="fas fa-calendar-times text-4xl mb-3 block opacity-20 text-[#004a99]"></i>
                                    Belum ada agenda kegiatan yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
