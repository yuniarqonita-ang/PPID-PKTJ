@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <h1 class="text-2xl font-bold text-white mb-6">{{ $agenda->judul }}</h1>

        <div class="mb-4">
            <strong>Tanggal:</strong> {{ $agenda->tanggal }}
        </div>

        <div class="mb-4">
            <strong>Status:</strong> 
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $agenda->aktif ? 'bg-green-100 text-green-300' : 'bg-red-100 text-red-300' }}">
                {{ $agenda->aktif ? 'Aktif' : 'Tidak Aktif' }}
            </span>
        </div>

        <div class="mb-4">
            <strong>Konten:</strong>
            <div class="mt-2 prose max-w-none">{!! $agenda->konten !!}</div>
        </div>

        @if($agenda->gambar)
            <div class="mb-4">
                <strong>Gambar:</strong>
                <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="mt-2 max-w-full h-auto rounded-lg shadow-sm">
            </div>
        @endif

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.agenda.index') }}" class="bg-gray-300 text-slate-300 px-4 py-2 rounded-lg hover:bg-gray-400 mr-2">Kembali</a>
            <a href="{{ route('admin.agenda.edit', $agenda) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Edit</a>
        </div>
    </div>
</div>
@endsection
