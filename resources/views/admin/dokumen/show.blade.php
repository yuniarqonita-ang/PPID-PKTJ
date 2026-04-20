@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $dokumen->judul ?? 'Detail Dokumen' }}</h1>
            <p>File: {{ $dokumen->file ?? 'No file' }}</p>
            <a href="{{ route('admin.dokumen.edit', $dokumen->id ?? 1) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
