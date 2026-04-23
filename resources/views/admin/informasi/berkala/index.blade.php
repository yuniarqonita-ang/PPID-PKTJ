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
                    <h2 class="text-[11px] font-black uppercase tracking-[3px]">Sistem Informasi Berkala: Aktif</h2>
                </div>
                
                <div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-2">
                        Informasi <span class="text-[#ffc107]">Berkala</span>
                    </h1>
                    <p class="text-blue-50 text-lg font-bold max-w-2xl opacity-90">Kelola daftar dokumen yang disediakan secara rutin kepada publik.</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ url('/informasi/berkala') }}" target="_blank" class="px-6 py-4 bg-white/10 border border-white/20 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-white/20 transition-all flex items-center">
                    <i class="fas fa-eye mr-3"></i> Lihat Publik
                </a>
                <a href="{{ route('admin.informasi.berkala.create') }}" class="px-8 py-4 bg-[#ffc107] text-[#004a99] font-black text-xs uppercase tracking-[3px] rounded-2xl shadow-xl shadow-amber-500/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center border-none cursor-pointer">
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
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#004a99] text-white">
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Informasi / Dokumen</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest hidden lg:table-cell">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $items = App\Models\InformasiBerkala::latest()->get();
                        @endphp
                        @forelse($items as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 text-[#004a99] rounded-xl flex items-center justify-center text-xl group-hover:bg-[#004a99] group-hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $item->judul }}</h3>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">
                                            <i class="fas fa-hdd mr-1"></i> {{ $item->file_size }} | 
                                            <i class="fas fa-calendar-day ml-2 mr-1"></i> {{ $item->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 max-w-xs italic font-medium">
                                    {{ $item->deskripsi ?: 'Tidak ada deskripsi singkat.' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->aktif)
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2 animate-pulse"></span> AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black uppercase">
                                        DRAFT
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.informasi.berkala.edit', $item->id) }}" class="p-2 bg-blue-50 text-[#004a99] rounded-lg hover:bg-[#004a99] hover:text-white transition-all shadow-sm">
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
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-gray-200 text-4xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest">Belum Ada Data</h3>
                                    <p class="text-gray-400 text-sm mt-1">Silahkan tambahkan informasi berkala pertama Anda</p>
                                    <a href="{{ route('admin.informasi.berkala.create') }}" class="mt-6 px-6 py-2 bg-[#004a99] text-white font-bold rounded-xl text-xs uppercase tracking-widest">Tambah Data</a>
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

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg shadow-red-500/10">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-black text-[#004a99] uppercase mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-sm mb-8 font-medium">Apakah Anda yakin ingin menghapus informasi ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
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
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/informasi-berkala/${id}`;
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
