@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-xl font-black text-[#004a99] uppercase tracking-widest">Pesan & Kontak Masuk</h2>
            <p class="text-sm text-gray-400 mt-1 font-medium">Daftar pesan dari form Hubungi Kami</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Pengirim</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Judul Pesan</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pesans as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors {{ !$item->is_read ? 'bg-blue-50/10' : '' }}">
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-700">{{ optional($item->created_at)->format('d M Y') ?? '-' }}</span>
                            <div class="text-[10px] text-gray-400">{{ optional($item->created_at)->format('H:i') ?? '-' }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-[#004a99]">{{ $item->nama }}</div>
                            <div class="text-xs text-gray-500"><i class="fas fa-envelope mr-1"></i>{{ $item->email }}</div>
                            <div class="text-xs text-gray-500"><i class="fas fa-phone mr-1"></i>{{ $item->telepon }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-gray-800 {{ !$item->is_read ? 'font-black' : '' }}">{{ $item->judul }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->is_read)
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700">DIBACA</span>
                            @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700">BARU</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.pesan-kontak.show', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-all mr-2">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            <form action="{{ route('admin.pesan-kontak.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition-all">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-3"><i class="fas fa-inbox"></i></div>
                            <p class="text-sm font-medium">Belum ada pesan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $pesans->links() }}
        </div>
    </div>
</div>
@endsection
