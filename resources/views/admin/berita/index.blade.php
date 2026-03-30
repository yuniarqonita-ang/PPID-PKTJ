@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
    <div class="max-w-7xl mx-auto space-y-6">

    <!-- ==================== HEADER SECTION ==================== -->
    <div class="flex justify-between items-center mb-8 bg-slate-800/50 p-6 rounded-2xl ring-1 ring-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-3xl font-black text-white drop-shadow-lg">📰 DAFTAR BERITA</h1>
            <p class="text-cyan-300 mt-1 font-semibold">Kelola semua konten berita yang ditampilkan di halaman publik ✨</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}" target="_blank" class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold hover:from-emerald-400 hover:to-teal-500 transition transform hover:scale-105 rounded-xl shadow-lg ring-1 ring-emerald-400/30">
                <i class="fas fa-eye mr-2"></i>Lihat Publik
            </a>
            <a href="{{ route('admin.berita.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold hover:from-blue-400 hover:to-indigo-500 transition transform hover:scale-105 rounded-xl shadow-lg ring-1 ring-blue-400/30">
                <i class="fas fa-plus mr-2"></i>TAMBAH
            </a>
        </div>
    </div>

    <!-- ==================== SEARCH SECTION ==================== -->
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 p-6 mb-6 relative overflow-hidden">
        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600/20 to-purple-600/20 rounded-2xl blur opacity-50 pointer-events-none"></div>
        <div class="flex items-center space-x-4 relative z-10">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari berita..." 
                           class="w-full pl-12 pr-4 py-3 border border-slate-600 text-white placeholder-slate-400 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                    <i class="fas fa-search absolute left-4 top-3.5 text-cyan-400"></i>
                </div>
            </div>
            <select class="px-5 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                <option value="">Semua Kategori</option>
                <option value="pengumuman">Pengumuman</option>
                <option value="artikel">Artikel</option>
                <option value="press-release">Press Release</option>
            </select>
            <select class="px-5 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                <option value="">10 per halaman</option>
                <option value="25">25 per halaman</option>
                <option value="50">50 per halaman</option>
                <option value="100">100 per halaman</option>
            </select>
        </div>
    </div>

    <!-- ==================== TABLE SECTION ==================== -->
    <div class="bg-slate-800 rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden relative">
        <table class="w-full relative z-10 text-left">
            <thead class="bg-slate-900/80 border-b border-slate-700">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Judul Berita</th>
                    <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Tanggal Berita</th>
                    <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Waktu Tambah</th>
                    <th class="px-6 py-4 text-xs font-bold text-cyan-400 uppercase tracking-wider">Waktu Ubah</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-cyan-400 uppercase tracking-wider">Terbitkan</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-cyan-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                @forelse($beritas as $index => $berita)
                <tr class="hover:bg-slate-700/50 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-white group-hover:text-cyan-300 transition-colors">
                            {{ $berita->judul }}
                        </div>
                        <div class="text-xs text-slate-400 mt-1 max-w-xs truncate content-area">
                            {{ Str::limit(strip_tags($berita->konten), 60) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                        {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $berita->created_at ? \Carbon\Carbon::parse($berita->created_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $berita->updated_at ? \Carbon\Carbon::parse($berita->updated_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($berita->is_published ?? true)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                Y
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30">
                                N
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="p-2 rounded-lg bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500 hover:text-white transition shadow-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="text-slate-400">
                            <i class="fas fa-newspaper text-6xl mb-4 text-slate-300 animate-pulse"></i>
                            <p class="text-xl font-bold text-white">Belum ada data berita</p>
                            <p class="text-sm mt-2">Mulai dengan menambahkan berita baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ==================== PAGINATION SECTION ==================== -->
    @if(isset($beritas) && $beritas->hasPages())
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-200">
            Menampilkan {{ $beritas->firstItem() }} hingga {{ $beritas->lastItem() }} dari {{ $beritas->total() }} hasil
        </div>
        <div class="flex items-center space-x-2">
            {{ $beritas->links() }}
        </div>
    </div>
    @endif

    </div>
</div>
@endsection