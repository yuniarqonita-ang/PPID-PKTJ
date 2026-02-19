@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="display-5 fw-bold text-primary">
                <i class="fas fa-cog me-2"></i> Manajemen Profil PPID
            </h2>
            <p class="text-muted">Kelola semua konten profil PPID dan informasi publik</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Profil PPID -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #004a99;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-info bg-opacity-10 rounded-circle">
                            <i class="fas fa-user-tie text-info" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Profil PPID</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['profil']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'profil') }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Tugas dan Tanggung Jawab -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #ffc107;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-warning bg-opacity-10 rounded-circle">
                            <i class="fas fa-tasks text-warning" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Tugas & Tanggung Jawab</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['tugas']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'tugas') }}" class="btn btn-warning btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Visi dan Misi -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #28a745;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-success bg-opacity-10 rounded-circle">
                            <i class="fas fa-lightbulb text-success" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Visi & Misi</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['visi']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'visi') }}" class="btn btn-success btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #dc3545;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-danger bg-opacity-10 rounded-circle">
                            <i class="fas fa-sitemap text-danger" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Struktur Organisasi</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['struktur']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'struktur') }}" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Regulasi -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #6f42c1;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-purple bg-opacity-10 rounded-circle">
                            <i class="fas fa-file-contract text-purple" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Regulasi</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['regulasi']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'regulasi') }}" class="btn btn-purple btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm hover-shadow transition h-100" style="border-top: 4px solid #17a2b8;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-3 bg-info bg-opacity-10 rounded-circle">
                            <i class="fas fa-phone text-info" style="font-size: 24px;"></i>
                        </div>
                        <h5 class="card-title ms-3 mb-0">Kontak</h5>
                    </div>
                    <p class="text-muted small">{{ $profilesData['kontak']->judul ? 'Konten tersedia' : 'Belum ada konten' }}</p>
                    <a href="{{ route('admin.profil.edit', 'kontak') }}" class="btn btn-info btn-sm w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        transition: box-shadow 0.3s ease-in-out;
    }
    
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
    }
    
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    
    .text-purple {
        color: #6f42c1 !important;
    }
    
    .btn-purple {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
    }
    
    .btn-purple:hover {
        background-color: #5a32a3;
        border-color: #5a32a3;
        color: white;
    }
</style>
@endsection