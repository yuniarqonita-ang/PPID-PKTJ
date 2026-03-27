@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden">
        <h1 class="text-2xl font-bold text-white mb-6">Edit Agenda</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-400 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.agenda.update', $agenda) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-slate-300">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $agenda->judul) }}" class="mt-1 block w-full border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-sm font-medium text-slate-300">Konten</label>
                <textarea name="konten" id="konten" class="mt-1 block w-full border-slate-600 text-white placeholder-slate-500 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">{{ old('konten', $agenda->konten) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-slate-300">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $agenda->tanggal) }}" class="mt-1 block w-full border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-slate-300">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" accept="image/*">
                @if($agenda->gambar)
                    <p class="mt-2 text-sm text-slate-300">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="mt-2 max-w-xs h-auto">
                @endif
            </div>

            <div class="mb-4">
                <label for="aktif" class="inline-flex items-center">
                    <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $agenda->aktif) ? 'checked' : '' }} class="rounded border-slate-600 bg-slate-900/50 text-white placeholder-slate-500 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.agenda.index') }}" class="bg-gray-300 text-slate-300 px-4 py-2 rounded-lg hover:bg-gray-400 mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#konten').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ]
    });
});
</script>
@endsection
