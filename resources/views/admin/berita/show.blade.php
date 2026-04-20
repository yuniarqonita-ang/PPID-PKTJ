@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $berita->judul ?? 'Detail Berita' }}</h1>
            <p>{{ $berita->isi ?? 'Konten berita' }}</p>
            <a href="{{ route('admin.berita.edit', $berita->id ?? 1) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
