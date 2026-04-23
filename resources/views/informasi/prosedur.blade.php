@extends('layouts.app')

@section('title', 'Prosedur - PPID PKTJ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-success">⚠️™ï¸ Prosedur {{ ucfirst($kategori) }}</h2>
                    <p class="text-muted">Standar operasional prosedur {{ $kategori }}</p>
                </div>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if($prosedur->count() > 0)
                <div class="row">
                    @foreach($prosedur as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm hover:shadow-lg transition-shadow">
                                <div class="card-body">
                                    <h5 class="card-title text-success fw-bold">{{ $item->judul }}</h5>
                                    @if($item->deskripsi)
                                        <p class="card-text text-muted small">{{ Str::limit($item->deskripsi, 100) }}</p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-file me-1"></i>{{ $item->file_name }}
                                            <span class="ms-2">({{ $item->file_size }})</span>
                                        </small>
                                        <a href="{{ route('download.file', ['model' => 'prosedur', 'id' => $item->id]) }}" 
                                           class="btn btn-success btn-sm" 
                                           title="Download {{ $item->file_name }}">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum Ada Prosedur {{ ucfirst($kategori) }}</h4>
                    <p class="text-muted">Prosedur {{ $kategori }} akan segera tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
