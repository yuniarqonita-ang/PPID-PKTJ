@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-black text-white drop-shadow-lg">Kelola Agenda</h1>
            <a href="{{ route('admin.agenda.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Agenda</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-400 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-slate-900/80">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-400 uppercase">Judul</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-400 uppercase">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-400 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-slate-700/50">
                    @forelse($agendas as $agenda)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-white">{{ $agenda->judul }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-white">{{ $agenda->tanggal }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-white">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $agenda->aktif ? 'bg-green-100 text-green-300' : 'bg-red-100 text-red-300' }}">
                                {{ $agenda->aktif ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.agenda.show', $agenda) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                            <a href="{{ route('admin.agenda.edit', $agenda) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                            <form method="POST" action="{{ route('admin.agenda.destroy', $agenda) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-sm text-slate-400">Belum ada agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
