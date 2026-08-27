@extends('layouts.admin')

@section('title', 'Kelola Regulasi & Dasar Hukum PPID')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[#004a99]">Dasar Hukum PPID</span>
                <span class="text-xs text-slate-400">•</span>
                <span class="text-xs font-medium text-slate-500">Database-driven</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola Regulasi & Peraturan</h1>
            <p class="text-sm text-slate-500 font-medium mt-0.5">Daftar Undang-Undang, Peraturan Komisi Informasi, Peraturan Kemenhub, dan SK PPID PKTJ.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profil.regulasi.html') }}" target="_blank" class="px-4 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-200 transition-all flex items-center shadow-sm">
                <i class="fas fa-external-link-alt mr-2 text-slate-500"></i> Lihat Publik
            </a>
            <a href="{{ route('admin.regulasi.create') }}" class="px-5 py-2.5 bg-[#004a99] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-blue-500/20 hover:bg-[#003875] transition-all flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Regulasi
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 text-sm font-semibold shadow-sm">
        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.regulasi.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor peraturan, judul, atau kata kunci..." class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium transition-all">
            </div>
            <div class="w-full md:w-64">
                <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-[#004a99] font-medium transition-all">
                    <option value="all">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            @if(request('q') || request('kategori'))
                <a href="{{ route('admin.regulasi.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200 text-sm font-bold flex items-center justify-center transition-all">
                    <i class="fas fa-times mr-1.5"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs font-black text-slate-500 uppercase tracking-wider">
                        <th class="py-4 px-4 text-center w-12">No</th>
                        <th class="py-4 px-5">Regulasi / Judul</th>
                        <th class="py-4 px-5">Kategori</th>
                        <th class="py-4 px-4 text-center">Tahun</th>
                        <th class="py-4 px-5">Dokumen / Tautan</th>
                        <th class="py-4 px-4 text-center">Status</th>
                        <th class="py-4 px-5 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($peraturans as $item)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-4 text-center text-slate-400 font-bold text-xs">
                            {{ $loop->iteration + ($peraturans->currentPage() - 1) * $peraturans->perPage() }}
                        </td>
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 mb-0.5">{{ $item->judul }}</div>
                            @if($item->deskripsi)
                                <div class="text-xs text-slate-500 line-clamp-2">{{ $item->deskripsi }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-5">
                            <span class="inline-block px-2.5 py-1 text-xs font-bold rounded-lg border 
                                {{ $item->kategori == 'Undang-Undang' ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}
                                {{ $item->kategori == 'Komisi Informasi Pusat' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                {{ $item->kategori == 'Kementerian Perhubungan' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                {{ $item->kategori == 'PKTJ Tegal' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-50 text-slate-700 border-slate-200' }}
                            ">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center font-bold text-slate-600 text-xs">
                            {{ $item->tahun ?? '-' }}
                        </td>
                        <td class="py-4 px-5">
                            @if($item->file_path)
                                <a href="{{ asset($item->file_path) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg text-xs font-bold border border-emerald-200 transition-all">
                                    <i class="fas fa-file-pdf"></i> File PDF
                                </a>
                            @elseif($item->link_download)
                                <a href="{{ $item->link_download }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-[#004a99] hover:bg-blue-100 rounded-lg text-xs font-bold border border-blue-200 transition-all">
                                    <i class="fas fa-external-link-alt"></i> Tautan JDIH
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum ada file</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            @if($item->is_active)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600">Draft</span>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.regulasi.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center text-xs transition-all shadow-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('admin.regulasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus regulasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center text-xs transition-all shadow-sm border-none cursor-pointer" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400 font-medium text-sm">
                            <i class="fas fa-folder-open text-3xl mb-2 block opacity-40"></i>
                            Belum ada regulasi ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($peraturans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $peraturans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
