{{-- 
    TEMPLATE FORM GENERIK UNTUK ADMIN PANEL
    Guna: Copy-paste template ini untuk membuat form baru
    Editor: CKEditor 5 Community Edition (Gratis, No API Key)
    
    INSTRUKSI PENGGUNAAN:
    1. Copy file ini menjadi blade file baru
    2. Ubah judul, icon, dan deskripsi sesuai kebutuhan
    3. Sesuaikan field form dengan requirements
    4. Update route action="{{ route('...') }}"
    5. Integrasikan dengan controller & database
--}}

@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
            <h2 class="display-5 fw-bold text-primary">
                {{-- UBAH ICON --}}
                <i class="fas fa-file me-2"></i> 
                {{-- UBAH JUDUL --}}
                Nama Menu Admin
            </h2>
            {{-- UBAH DESKRIPSI --}}
            <p class="text-muted">Deskripsi menu dan fungsinya...</p>
        </div>
    </div>

    <!-- Alert Messages -->
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

    <!-- Main Form Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-body p-5">
            {{-- UBAH route action --}}
            <form action="{{ route('example.route') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Gunakan PUT untuk update, hapus untuk create --}}

                <div class="row">
                    <!-- Left Column: Main Content (75%) -->
                    <div class="col-lg-8">
                        
                        <!-- Field 1: Judul -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   placeholder="Ketik judul di sini..."
                                   value="{{ old('judul', '') }}"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field 2: Deskripsi Singkat -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2"></i> Deskripsi Singkat
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="3" 
                                      placeholder="Penjelasan singkat...">{{ old('deskripsi', '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field 3: Konten Utama (dengan CKEditor) -->
                        <div class="mb-4">
                            <label for="konten" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Lengkap
                            </label>
                            <small class="d-block text-muted mb-2">
                                Gunakan editor di bawah untuk formatting lengkap: bold, italic, list, tabel, link, gambar, dll
                            </small>
                            <textarea id="editor" 
                                      name="konten" 
                                      class="form-control form-editor @error('konten') is-invalid @enderror">{{ old('konten', '') }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field 4: Tanggal (Optional) -->
                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-bold">
                                <i class="fas fa-calendar me-2"></i> Tanggal Publikasi
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" 
                                   name="tanggal"
                                   value="{{ old('tanggal', date('Y-m-d')) }}">
                            @error('tanggal')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field 5: File Upload (Optional) -->
                        <div class="mb-4">
                            <label for="dokumen" class="form-label fw-bold">
                                <i class="fas fa-file-upload me-2"></i> Upload Dokumen (Opsional)
                            </label>
                            <div class="input-group">
                                <input type="file" 
                                       class="form-control @error('dokumen') is-invalid @enderror" 
                                       id="dokumen" 
                                       name="dokumen">
                                <span class="input-group-text">Max 10MB</span>
                            </div>
                            <small class="d-block text-muted mt-2">
                                Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, ZIP
                            </small>
                            @error('dokumen')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Right Column: Info & Sidebar (25%) -->
                    <div class="col-lg-4">
                        
                        <!-- Info Card -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title fw-bold mb-3">
                                    <i class="fas fa-lightbulb text-warning me-2"></i> Panduan Pengisian
                                </h6>
                                <div class="small text-muted">
                                    <p>
                                        <strong>Judul:</strong><br>
                                        Singkat, jelas, dan deskriptif. Hindari judul yang terlalu panjang.
                                    </p>
                                    <p>
                                        <strong>Deskripsi:</strong><br>
                                        Ringkasan maksimal 100-150 kata yang menjelaskan isi konten.
                                    </p>
                                    <p>
                                        <strong>Konten:</strong><br>
                                        Gunakan formatting (bold, italic, list, tabel) untuk memperjelas.
                                    </p>
                                    <p>
                                        <strong>Tanggal:</strong><br>
                                        Kapan konten ini dipublikasikan?
                                    </p>
                                    <p>
                                        <strong>Dokumen:</strong><br>
                                        File pendukung jika ada (opsional).
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Highlight Card -->
                        <div class="card bg-info bg-opacity-10 border-info mt-3">
                            <div class="card-body small">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                <strong>Catatan:</strong> Semua konten akan ditampilkan di halaman publik. 
                                Pastikan konten akurat dan sesuai dengan regulasi.
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
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- CKEditor 5 Community Edition -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // Toolbar Configuration
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                
                // Heading Options
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                
                // Font Size Options
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22, 24 ],
                    supportAllValues: true
                },
                
                // Font Family Options
                fontFamily: {
                    options: [
                        'default',
                        'Arial, sans-serif',
                        'Georgia, serif',
                        'Courier New, monospace',
                        'Segoe UI, sans-serif'
                    ]
                },
                
                // Table Configuration
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                },
                
                // Image Configuration
                image: {
                    toolbar: [ 'imageTextAlternative', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                    styles: [ 'full', 'side', 'alignLeft', 'alignCenter', 'alignRight' ]
                },
                
                // Link Configuration
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: { download: 'file' }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('CKEditor Error:', error);
            });
    });
</script>

<!-- Form Styles -->
<style>
    /* Editor Height */
    .form-control.form-editor {
        min-height: 300px;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.75rem 1.25rem;
    }
    
    /* Display 5 Heading Style */
    .display-5 {
        font-size: 2rem;
        font-weight: 600;
        letter-spacing: -0.015em;
    }
    
    /* CKEditor Custom Styling */
    .ck-editor__editable {
        min-height: 300px;
        font-size: 15px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    /* Form Control Styling */
    .form-control-lg {
        font-size: 1.0625rem;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .form-control-lg:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Responsive Grid */
    @media (max-width: 991px) {
        .col-lg-8, .col-lg-4 {
            margin-bottom: 2rem;
        }
    }
</style>

@endsection
