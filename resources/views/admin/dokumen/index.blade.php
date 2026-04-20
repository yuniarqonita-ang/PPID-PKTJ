@extends('layouts.app')

@section('content')
<div class="space-y-8 animate-fade-in lg:px-8">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-[#002b5c] tracking-tight">
                Pusat <span class="text-[#004a99]">Dokumen</span>
            </h1>
            <p class="text-slate-500 text-sm font-medium mt-1">Kelola arsip file, laporan, dan dokumen legalitas PPID</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dokumen.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#002b5c] font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all flex items-center border-none">
                <i class="fas fa-file-upload mr-2"></i> Upload Dokumen Baru
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-4">
        <i class="fas fa-check-circle text-xl text-gray-800"></i>
        <p class="font-bold text-gray-800">{{ session('success') }}</p>
    </div>
    @endif

    <!-- TABLE SECTION -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px] w-20">No</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Nama Dokumen</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px] text-center border-gray-800">Tipe File</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[2px] text-center border-gray-800">Pratinjau</th>
                        <th class="px-8 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-[2px]">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($dokumen as $key => $dok)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-slate-300">#{{ $key + 1 }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#004a99] flex items-center justify-center text-lg">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="text-sm font-black text-[#002b5c] group-hover:text-[#004a99] transition-colors leading-tight">
                                        {{ $dok->judul }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @php
                                    $ext = pathinfo($dok->file_path, PATHINFO_EXTENSION);
                                @endphp
                                <span class="px-3 py-1 bg-slate-100 text-[10px] font-black text-slate-500 rounded-lg uppercase tracking-widest border-gray-800">
                                    {{ $ext ?: 'FILE' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <a href="{{ Storage::url($dok->file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-[10px] font-black uppercase text-[#004a99] hover:text-[#ffc107] transition-colors">
                                    <i class="fas fa-external-link-alt"></i> Lihat Dokumen
                                </a>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center items-center gap-2">
                                    <form action="{{ route('dokumen.destroy', $dok->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all flex items-center justify-center group/btn shadow-sm border-none cursor-pointer">
                                            <i class="fas fa-trash-alt text-sm group-hover/btn:scale-110"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center bg-slate-50/30">
                                <div class="max-w-xs mx-auto space-y-3 opacity-30 text-gray-800">
                                    <i class="fas fa-folder-open text-6xl"></i>
                                    <p class="text-sm font-bold uppercase tracking-widest">Belum ada dokumen diunggah</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
