@extends('layouts.app')

@section('title', 'Informasi Berkala - PPID PKTJ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary">📋 Informasi Berkala</h2>
                    <p class="text-muted">Informasi yang wajib disediakan dan diumumkan secara berkala</p>
                </div>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if($informasi->count() > 0)
                <div class="row">
                    @foreach($informasi as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm hover:shadow-lg transition-shadow">
                                <div class="card-body">
                                    <h5 class="card-title text-primary fw-bold">{{ $item->judul }}</h5>
                                    @if($item->deskripsi)
                                        <p class="card-text text-muted small">{{ Str::limit($item->deskripsi, 100) }}</p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                                        <small class="text-muted flex-grow-1">
                                            <i class="fas fa-file me-1"></i>{{ Str::limit($item->file_name, 15) }}
                                        </small>
                                        <div class="btn-group shadow-sm">
                                            @if(is_previewable($item->file_path))
                                                <button type="button" class="btn btn-outline-primary btn-sm" 
                                                    data-bs-toggle="modal" data-bs-target="#previewModal" 
                                                    data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('download.file', ['model' => 'berkala', 'id' => $item->id]) }}" 
                                               class="btn btn-primary btn-sm" 
                                               title="Download {{ $item->file_name }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum Ada Informasi Berkala</h4>
                    <p class="text-muted">Informasi berkala akan segera tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
