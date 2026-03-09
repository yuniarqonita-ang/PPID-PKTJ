@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kelola Agenda</h1>
            <a href="{{ route('admin.agenda.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Agenda</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($agendas as $agenda)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $agenda->judul }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $agenda->tanggal }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $agenda->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
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
                        <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-500">Belum ada agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
