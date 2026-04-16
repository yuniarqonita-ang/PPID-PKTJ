@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] p-4 md:p-6 text-gray-800">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#004a99] uppercase tracking-tight text-gray-800">
                    <i class="fas fa-inbox mr-2 text-[#ffc107]"></i> Permohonan Informasi
                </h1>
                <p class="text-gray-500 font-medium mt-1 uppercase tracking-[0.2em] text-[10px]">Pusat Kendali Pengajuan Informasi Publik</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.permohonan.export') }}" class="px-6 py-3 bg-white border border-gray-200 text-[#004a99] font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-all flex items-center">
                    <i class="fas fa-file-excel mr-2 text-green-600"></i> Export Data
                </a>
                <a href="{{ route('admin.permohonan.form') }}" class="px-6 py-3 bg-[#004a99] text-white font-bold rounded-xl shadow-lg hover:bg-blue-800 transition-all flex items-center">
                    <i class="fas fa-cog mr-2 text-[#ffc107]"></i> Pengaturan Form
                </a>
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

        <!-- STATS SECTION -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stats = [
                    ['label' => 'Total Masuk', 'val' => $permohonan->total(), 'icon' => 'fa-clipboard-list', 'color' => 'blue'],
                    ['label' => 'Menunggu', 'val' => $permohonan->where('status', 'pending')->count(), 'icon' => 'fa-clock', 'color' => 'yellow'],
                    ['label' => 'Disetujui', 'val' => $permohonan->where('status', 'approved')->count(), 'icon' => 'fa-check-double', 'color' => 'green'],
                    ['label' => 'Ditolak', 'val' => $permohonan->where('status', 'rejected')->count(), 'icon' => 'fa-times-circle', 'color' => 'red'],
                ];
            @endphp
            @foreach($stats as $stat)
            <div class="bg-white p-6 rounded-3xl shadow-xl ring-1 ring-gray-200 flex items-center gap-4 group hover:shadow-2xl transition-all border-b-4 border-{{ $stat['color'] }}-500">
                <div class="w-14 h-14 bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-500 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110">
                    <i class="fas {{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $stat['label'] }}</p>
                    <h3 class="text-2xl font-black text-[#004a99]">{{ $stat['val'] }}</h3>
                </div>
            </div>
            @endforeach
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-200 overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#004a99] text-white">
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">ID</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest">Pemohon</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest hidden lg:table-cell">Permohonan</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 uppercase">
                        @forelse($permohonan as $item)
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-bold text-gray-400 text-xs">#{{ $item->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 font-black text-xs uppercase transition-colors group-hover:bg-[#004a99] group-hover:text-white">
                                        {{ substr($item->nama_pemohon, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wide">{{ $item->nama_pemohon }}</h4>
                                        <p class="text-[9px] text-gray-400 lowercase font-medium">{{ $item->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <h4 class="text-xs font-bold text-[#004a99] uppercase truncate max-w-xs">{{ $item->jenis_informasi }}</h4>
                                <p class="text-[10px] text-gray-400 mt-1 font-bold">
                                    <i class="fas fa-calendar-day mr-1"></i> {{ $item->created_at->format('d M Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusColors = [
                                        'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'MENUNGGU'],
                                        'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'DISETUJUI'],
                                        'completed' => ['bg' => 'bg-blue-600', 'text' => 'text-white', 'label' => 'SELESAI'],
                                        'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'DITOLAK'],
                                    ];
                                    $st = $statusColors[$item->status ?? 'pending'] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-400', 'label' => strtoupper($item->status ?? 'pending')];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 {{ $st['bg'] }} {{ $st['text'] }} rounded-full text-[9px] font-black uppercase">
                                    {{ $st['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.permohonan.show', $item->id) }}" class="p-2 bg-blue-50 text-[#004a99] rounded-lg hover:bg-[#004a99] hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.permohonan.update', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-[10px] font-black text-[#004a99] focus:ring-2 focus:ring-[#004a99] focus:outline-none cursor-pointer hover:bg-white transition-all" onchange="this.form.submit()">
                                            <option value="pending" {{ ($item->status ?? 'pending') == 'pending' ? 'selected' : '' }}>MENUNGGU</option>
                                            <option value="approved" {{ ($item->status ?? 'pending') == 'approved' ? 'selected' : '' }}>DISETUJUI</option>
                                            <option value="completed" {{ ($item->status ?? 'pending') == 'completed' ? 'selected' : '' }}>SELESAI</option>
                                            <option value="rejected" {{ ($item->status ?? 'pending') == 'rejected' ? 'selected' : '' }}>DITOLAK</option>
                                        </select>
                                    </form>

                                    <button onclick="confirmDelete('{{ $item->id }}')" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-200 text-4xl">
                                        <i class="fas fa-inbox text-gray-800"></i>
                                    </div>
                                    <h3 class="text-lg font-black text-gray-300 uppercase tracking-widest">Belum Ada Permohonan</h3>
                                    <p class="text-gray-400 text-sm mt-1 uppercase tracking-widest text-[10px]">Seluruh pengajuan informasi publik akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        @if($permohonan->hasPages())
            <div class="px-4 py-8">
                {{ $permohonan->links() }}
            </div>
        @endif

    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-[#004a99]/20 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300">
        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-black text-[#004a99] uppercase mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-sm mb-8 font-medium">Apakah Anda yakin ingin menghapus permohonan ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
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
        form.action = `/admin/permohonan/${id}`;
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
