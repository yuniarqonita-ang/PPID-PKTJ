@extends('layouts.app')

@php
    $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    $hasTanggal = \Illuminate\Support\Facades\Schema::hasColumn('dokumens', 'tanggal');
    $items = \App\Models\Dokumen::where('kategori', 'Laporan Akses')
        ->when($hasTanggal, fn($q) => $q->orderByRaw('COALESCE(tanggal, created_at) DESC'), fn($q) => $q->latest())
        ->get();
@endphp

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- DASHBOARD-STYLE HEADER SECTION -->
        <div class="bg-gradient-to-br from-[#004a99] via-[#005bb5] to-[#006ccf] rounded-[2rem] p-10 md:p-12 shadow-xl text-white relative overflow-hidden mb-10">
            <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#ffc107] rounded-full text-[#004a99]">
                        <span class="w-2.5 h-2.5 bg-[#004a99] rounded-full animate-ping"></span>
                        <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Laporan Akses: Aktif</h2>
                    </div>
                    
                    <div>
                        <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                            Laporan <span class="text-[#ffc107]">Akses Informasi</span>
                        </h1>
                        <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola data rekapitulasi and arsip laporan akses informasi publik.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('layanan.laporan-akses') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                        <i class="fas fa-eye mr-3"></i> Lihat Publik
                    </a>
                    <a href="{{ route('admin.dokumen.create', ['kategori' => 'Laporan Akses']) }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
                        <i class="fas fa-plus mr-3"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3 shadow-lg shadow-green-500/20">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
        @endif


        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border-t-4 border-[#004a99]">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-xs font-black text-[#004a99] uppercase tracking-[0.2em]">
                    <i class="fas fa-list mr-2"></i> Daftar Laporan Historis
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#004a99] text-white">
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Nama Laporan / Dokumen</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $item->judul }}</h3>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">
                                            <i class="fas fa-hdd mr-1"></i> {{ $item->file_size ?? 'No File' }} | 
                                            <i class="fas fa-calendar-day ml-2 mr-1"></i> {{ ($hasTanggal && $item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : ($item->created_at ? $item->created_at->format('d M Y') : '-') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col items-center gap-1">
                                    @if($item->aktif)
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-green-100 text-green-600 rounded-full text-[9px] font-black uppercase">
                                            <span class="w-1 h-1 bg-green-500 rounded-full mr-1 animate-pulse"></span> AKTIF
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-gray-100 text-gray-400 rounded-full text-[9px] font-black uppercase">
                                            DRAFT
                                        </span>
                                    @endif
                                    <div class="flex gap-1 justify-center mt-1">
                                        @if($item->is_blurred)
                                            <span class="px-1.5 py-0.2 bg-amber-50 text-amber-600 border border-amber-200 rounded text-[8px] font-bold uppercase">BLUR</span>
                                        @endif
                                        @if($item->bisa_download)
                                            <span class="px-1.5 py-0.2 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded text-[8px] font-bold uppercase">DOWNLOAD</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="showDetail('{{ $item->judul }}', '{{ addslashes($item->deskripsi) }}')" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-600 hover:text-white transition-all shadow-sm" title="Lihat Deskripsi">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    @if($item->file_path)
                                    @php
                                        $isGD = str_starts_with($item->file_path, 'http://') || str_starts_with($item->file_path, 'https://');
                                    @endphp
                                    <button type="button" 
                                            class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all shadow-sm" 
                                            title="Pratinjau File"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#previewModal" 
                                            data-url="{{ route('preview.dokumen', ['file' => ($isGD ? $item->file_path : 'storage/' . $item->file_path), 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? 1 : 0]) }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                    @endif
                                    <a href="{{ route('admin.dokumen.edit', $item->id) }}" class="p-2 bg-blue-50 text-[#004a99] rounded-lg hover:bg-[#004a99] hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('{{ $item->id }}')" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-gray-200 text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest">Belum Ada Data</h3>
                                    <p class="text-gray-400 text-sm mt-1">Silahkan tambahkan laporan akses pertama Anda</p>
                                    <a href="{{ route('admin.dokumen.create', ['kategori' => 'Laporan Akses']) }}" class="mt-6 px-6 py-2 bg-[#004a99] text-white font-bold rounded-xl text-xs uppercase tracking-widest">Tambah Data</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- DETAIL MODAL -->
<div id="detailModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] shadow-2xl p-10 max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col transform scale-95 transition-transform duration-300">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 id="detailTitle" class="text-2xl font-black text-[#004a99] uppercase truncate pr-8">Detail Laporan</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-red-500 transition-colors text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="detailContent" class="flex-1 overflow-y-auto prose max-w-none text-gray-700 p-2">
            <!-- Content filled by JS -->
        </div>
        <div class="mt-8 pt-6 border-t flex justify-end">
            <button onclick="closeDetailModal()" class="px-8 py-3 bg-[#004a99] text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-black transition-all">Tutup</button>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg shadow-red-500/10">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-black text-[#004a99] uppercase mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-sm mb-8 font-medium">Apakah Anda yakin ingin menghapus dokumen ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 py-3 bg-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-200 transition-all">Batal</button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/20">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(title, content) {
        const modal = document.getElementById('detailModal');
        document.getElementById('detailTitle').innerText = title;
        document.getElementById('detailContent').innerHTML = content || '<p class="text-gray-400 italic">Tidak ada deskripsi untuk laporan ini.</p>';
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/dokumen/${id}`;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('opacity-100');
        modal.querySelector('div').classList.remove('scale-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }
</script>
@endsection
