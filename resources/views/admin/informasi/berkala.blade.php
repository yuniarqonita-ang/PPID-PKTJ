@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
            <h2 class="display-5 fw-bold text-primary">
                <i class="fas fa-clock me-2"></i> Informasi Berkala
            </h2>
            <p class="text-muted">Kelola informasi yang disampaikan secara berkala kepada masyarakat</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-circle me-2"></i> Terjadi Kesalahan!</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-lg">
        <div class="card-body p-5">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul Informasi
                            </label>
                            <input type="text" class="form-control form-control-lg" 
                                   id="judul" name="judul" placeholder="Contoh: Laporan Kinerja Tahunan 2024"
                                   required>
                        </div>

                        <!-- Deskripsi Singkat -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2"></i> Deskripsi Singkat
                            </label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" 
                                      rows="3" placeholder="Penjelasan singkat tentang informasi ini"></textarea>
                        </div>

                        <!-- Konten Lengkap -->
                        <div class="mb-4">
                            <label for="konten" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Lengkap
                            </label>
                            <small class="d-block text-muted mb-2">Gunakan formatting lengkap (bold, italic, list, tabel, dll)</small>
                            <textarea id="editor" name="konten" class="form-control form-editor">
Tulis konten di sini...
                            </textarea>
                        </div>

                        <!-- Tanggal Publikasi -->
                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-bold">
                                <i class="fas fa-calendar me-2"></i> Tanggal Publikasi
                            </label>
                            <input type="date" class="form-control" 
                                   id="tanggal" name="tanggal" required>
                        </div>

                        <!-- Dokumen Terkait -->
                        <div class="mb-4">
                            <label for="dokumen" class="form-label fw-bold">
                                <i class="fas fa-file me-2"></i> Dokumen Terkait (Opsional)
                            </label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="dokumen" name="dokumen">
                                <span class="input-group-text">Max 10MB</span>
                            </div>
                            <small class="d-block text-muted mt-2">Format: PDF, DOC, DOCX, XLS, XLSX</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title fw-bold mb-3">
                                    <i class="fas fa-lightbulb text-warning me-2"></i> Panduan Pengisian
                                </h6>
                                <div class="small text-muted">
                                    <p><strong>Judul:</strong> Singkat, jelas, dan deskriptif</p>
                                    <p><strong>Deskripsi:</strong> Ringkasan maksimal 100 kata</p>
                                    <p><strong>Konten:</strong> Uraian lengkap dengan formatting</p>
                                    <p><strong>Tanggal:</strong> Waktu publikasi informasi</p>
                                    <p><strong>Dokumen:</strong> File pendukung jika ada</p>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-info bg-opacity-10 border-info mt-3">
                            <div class="card-body small">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                <strong>Informasi Berkala</strong> adalah informasi yang disampaikan secara rutin atau periodik oleh PPID kepada masyarakat.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-5">
                    <div class="col-12 d-flex gap-2 justify-content-end">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Simpan Informasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .catch(error => console.error(error));
    });
</script>

<style>
    .form-control.form-editor {
        min-height: 250px;
    }
    .display-5 {
        font-size: 2rem;
        font-weight: 600;
    }
    .ck-editor__editable { min-height: 250px; }
</style>
