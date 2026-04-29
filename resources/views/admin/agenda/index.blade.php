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
                        @forelse($items as $index => $agenda)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-sm font-bold text-gray-400 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-[#004a99] group-hover:text-blue-700 transition-colors leading-relaxed">
                                        {{ $agenda->judul }}
                                    </div>
                                    @if($agenda->konten)
                                        <div class="text-[10px] text-gray-400 italic truncate max-w-xs mt-1">
                                            {{ Str::limit(strip_tags($agenda->konten), 50) }}
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
                                        <button onclick="showDetail('{{ $agenda->judul }}', '{{ addslashes($agenda->konten) }}')" class="p-2 w-10 h-10 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.agenda.edit', $agenda) }}" class="p-2 w-10 h-10 rounded-lg bg-blue-50 text-[#004a99] hover:bg-[#004a99] hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit Agenda">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete('{{ $agenda->id }}')" class="p-2 w-10 h-10 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Hapus Agenda">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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

<!-- DETAIL MODAL -->
<div id="detailModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] shadow-2xl p-10 max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col transform scale-95 transition-transform duration-300">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 id="detailTitle" class="text-2xl font-black text-[#004a99] uppercase truncate pr-8">Detail Agenda</h3>
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
            <p class="text-gray-500 text-sm mb-8 font-medium">Apakah Anda yakin ingin menghapus agenda ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
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
        document.getElementById('detailContent').innerHTML = content;
        
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
        form.action = `/admin/agenda/${id}`;
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
