@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-[#004a99] tracking-tight uppercase">Kelola Menu Halaman Publik</h1>
            <p class="text-slate-500 text-sm font-semibold mt-1">Tambahkan, ubah, atau hapus menu & sub-menu navigasi di halaman depan secara dinamis.</p>
        </div>
        <a href="{{ route('admin.menu.create') }}" class="px-6 py-4 bg-[#004a99] text-white font-black text-xs uppercase tracking-[2px] rounded-2xl hover:bg-opacity-90 transition-all flex items-center shadow-lg shadow-blue-900/10">
            <i class="fas fa-plus-circle mr-2 text-[#ffc107]"></i> Tambah Menu Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-800 p-6 rounded-[1.5rem] flex items-center gap-3">
        <i class="fas fa-check-circle text-xl text-emerald-500"></i>
        <span class="font-bold text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-rose-50 border-2 border-rose-100 text-rose-800 p-6 rounded-[1.5rem] flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-xl text-rose-500"></i>
        <span class="font-bold text-sm">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-lg font-black text-[#002b5c] tracking-tight">Daftar Menu & Sub-Menu Navigasi</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Hierarki navigasi teratas dan sub-menunya</p>
        </div>

        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[#004a99]">
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider">Nama Menu / Sub-Menu</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider">Slug / Link</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider text-center">Tipe / Fitur</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider text-center">Penempatan</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider text-center">Urutan</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider text-center">Status</th>
                            <th class="py-4 px-6 text-xs font-black uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($menus as $menu)
                            <!-- Parent Menu Row -->
                            <tr class="hover:bg-slate-50/60 transition-colors bg-blue-50/30">
                                <td class="py-5 px-6 font-black text-[#004a99] flex items-center gap-2">
                                    <i class="fas fa-folder text-amber-500"></i> {{ $menu->nama }}
                                </td>
                                <td class="py-5 px-6 text-xs font-semibold text-slate-600 font-mono">
                                    {{ $menu->url ?: '/halaman/' . $menu->slug }}
                                </td>
                                <td class="py-5 px-6 text-center space-x-1">
                                    @if($menu->is_editor)<span class="inline-block bg-slate-100 text-slate-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Editor</span>@endif
                                    @if($menu->is_table)<span class="inline-block bg-blue-100 text-blue-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Tabel</span>@endif
                                    @if($menu->is_chart)<span class="inline-block bg-amber-100 text-amber-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Bagan</span>@endif
                                    @if($menu->is_form)<span class="inline-block bg-emerald-100 text-emerald-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Form</span>@endif
                                </td>
                                <td class="py-5 px-6 text-center">
                                    <span class="inline-block bg-[#004a99]/15 text-[#004a99] text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $menu->penempatan === 'both' ? 'Header & Footer' : ($menu->penempatan === 'footer' ? 'Footer Only' : 'Header Only') }}
                                    </span>
                                </td>
                                <td class="py-5 px-6 text-center font-bold text-slate-700 text-sm">
                                    {{ $menu->urutan }}
                                </td>
                                <td class="py-5 px-6 text-center">
                                    @if($menu->aktif)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="p-2.5 bg-slate-100 text-slate-600 rounded-xl hover:bg-[#ffc107] hover:text-[#004a99] transition-all" title="Edit Menu">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini beserta seluruh sub-menunya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all" title="Hapus Menu">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Children (Sub Menus) Row -->
                            @if($menu->children->count() > 0)
                                @foreach($menu->children as $child)
                                    <tr class="hover:bg-slate-50/40 transition-colors">
                                        <td class="py-4 px-6 text-sm font-bold text-slate-700 pl-12 flex items-center gap-2">
                                            <i class="fas fa-chevron-right text-slate-400 text-xs"></i> <i class="fas fa-file-alt text-slate-400"></i> {{ $child->nama }}
                                        </td>
                                        <td class="py-4 px-6 text-xs font-semibold text-slate-500 font-mono">
                                            {{ $child->url ?: '/halaman/' . $child->slug }}
                                        </td>
                                        <td class="py-4 px-6 text-center space-x-1">
                                            @if($child->is_editor)<span class="inline-block bg-slate-100 text-slate-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Editor</span>@endif
                                            @if($child->is_table)<span class="inline-block bg-blue-100 text-blue-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Tabel</span>@endif
                                            @if($child->is_chart)<span class="inline-block bg-amber-100 text-amber-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Bagan</span>@endif
                                            @if($child->is_form)<span class="inline-block bg-emerald-100 text-emerald-700 text-[9px] font-bold px-2 py-0.5 rounded-full">Form</span>@endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="inline-block bg-slate-100 text-slate-600 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">
                                                {{ $child->penempatan === 'both' ? 'Header & Footer' : ($child->penempatan === 'footer' ? 'Footer Only' : 'Header Only') }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center font-bold text-slate-500 text-sm">
                                            {{ $child->urutan }}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if($child->aktif)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                    <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                                    <span class="w-1 h-1 rounded-full bg-rose-500"></span> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('admin.menu.edit', $child->id) }}" class="p-2 bg-slate-100 text-slate-500 rounded-lg hover:bg-[#ffc107] hover:text-[#004a99] transition-all" title="Edit Sub-Menu">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </a>
                                                <form action="{{ route('admin.menu.destroy', $child->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sub-menu ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-600 hover:text-white transition-all" title="Hapus Sub-Menu">
                                                        <i class="fas fa-trash-alt text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-bold">
                                    <i class="fas fa-compass text-4xl mb-3 block text-slate-300"></i> Belum ada menu custom yang dibuat.
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
