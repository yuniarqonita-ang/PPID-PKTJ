@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight">
                    <i class="fas fa-newspaper mr-2"></i> Daftar Berita
                </h1>
                <p class="text-gray-500 font-medium mt-1">Kelola publikasi berita dan pengumuman untuk portal PPID PKTJ</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.berita.create') }}" class="px-6 py-3 bg-[#ffc107] text-[#004a99] font-bold rounded-xl shadow-lg hover:bg-yellow-400 transform hover:scale-[1.02] transition-all flex items-center">
                    <i class="fas fa-plus mr-2"></i> Buat Berita Baru
                </a>
            </div>
        </div>

        <!-- SEARCH & FILTER -->
        <div class="bg-white p-4 rounded-2xl shadow-sm ring-1 ring-gray-200 border-l-4 border-blue-400">
            <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#004a99] focus:outline-none text-sm transition-all"
                        placeholder="Cari judul berita atau konten...">
                </div>
                <button type="submit" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl hover:bg-blue-800 transition-all">
                    Filter Berita
                </button>
            </form>
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
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Informasi Berita</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal Pub</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Update</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($beritas as $berita)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden flex items-center justify-center text-[#004a99] border border-gray-200 shadow-sm">
                                            @if($berita->gambar)
                                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-image text-xl opacity-20"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-[#004a99] group-hover:text-blue-700 transition-colors leading-snug mb-1">
                                                {{ Str::limit($berita->judul, 70) }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-medium">
                                                <i class="fas fa-user-edit mr-1"></i> Admin PPID
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-bold text-gray-600">
                                        {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-[10px] text-gray-400">
                                        {{ $berita->updated_at ? $berita->updated_at->diffForHumans() : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($berita->status == 'published' || ($berita->is_published ?? true))
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-green-100 text-green-600 border border-green-200">
                                            TERBIT
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-yellow-100 text-yellow-600 border border-yellow-200">
                                            DRAFT
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.berita.edit', $berita) }}" class="p-2 w-10 h-10 rounded-lg bg-blue-50 text-[#004a99] hover:bg-[#004a99] hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit Berita">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 w-10 h-10 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Hapus Berita">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-500 font-medium italic bg-gray-50">
                                    <div class="max-w-xs mx-auto">
                                        <i class="fas fa-newspaper text-5xl mb-4 text-[#004a99] opacity-10"></i>
                                        <p>Belum ada artikel berita yang dipublikasikan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($beritas->hasPages())
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $beritas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection