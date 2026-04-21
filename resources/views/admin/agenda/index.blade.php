@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-calendar-alt mr-2"></i> Kelola Agenda
                </h1>
                <p class="text-gray-500 font-medium mt-1">Jadwal kegiatan dan agenda penting PPID PKTJ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.agenda.create') }}" class="px-6 py-3 bg-[#ffc107] text-[#004a99] font-bold rounded-xl shadow-lg hover:bg-yellow-400 transform hover:scale-[1.02] transition-all flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Agenda Baru
                </a>
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
