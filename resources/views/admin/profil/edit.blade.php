@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil-editor.css') }}">
<style>
    body { background: #f5f7fa; }
</style>
@endpush

@section('content')
<div class="editor-header">
    <div class="container">
        <div class="header-content">
            <h1 class="editor-title" id="pageTitle">
                @switch($type)
                    @case('profil')
                        Edit Profil PPID
                        @break
                    @case('tugas')
                        Edit Tugas dan Tanggung Jawab PPID
                        @break
                    @case('visi')
                        Edit Visi dan Misi PPID
                        @break
                    @case('struktur')
                        Edit Struktur Organisasi
                        @break
                    @case('regulasi')
                        Edit Regulasi
                        @break
                    @case('kontak')
                        Edit Kontak
                        @break
                @endswitch
            </h1>
            <p class="header-subtitle">Kelola konten dan tampilan halaman dengan editor yang powerful</p>
        </div>
    </div>
</div>

<div class="container profil-editor-container">

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-circle me-2"></i> Terjadi Kesalahan!
            </h5>
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
            <form action="{{ route('admin.profil.update', $type) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column: Text Content -->
                    <div class="col-lg-8">
                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul Halaman
                            </label>
                            <input type="text" class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul', $profil->judul) }}"
                                   placeholder="Masukkan judul halaman..." required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konten Pembuka -->
                        <div class="mb-4">
                            <label for="konten_pembuka" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Utama
                            </label>
                            <small class="d-block text-muted mb-2">Gunakan editor di bawah untuk memformat teks (bold, italic, list, link, dll)</small>
                            <textarea id="editor_pembuka" name="konten_pembuka" class="form-control form-editor @error('konten_pembuka') is-invalid @enderror">{{ old('konten_pembuka', $profil->konten_pembuka) }}</textarea>
                            @error('konten_pembuka')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Judul Sub -->
                        <div class="mb-4">
                            <label for="judul_sub" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul Bagian Tambahan (Opsional)
                            </label>
                            <input type="text" class="form-control @error('judul_sub') is-invalid @enderror" 
                                   id="judul_sub" name="judul_sub" value="{{ old('judul_sub', $profil->judul_sub) }}"
                                   placeholder="Contoh: Detail Lebih Lanjut...">
                            @error('judul_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konten Detail -->
                        <div class="mb-4">
                            <label for="konten_detail" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Bagian Tambahan
                            </label>
                            <small class="d-block text-muted mb-2">Konten tambahan dengan format lengkap (tabel, list, dll)</small>
                            <textarea id="editor_detail" name="konten_detail" class="form-control form-editor @error('konten_detail') is-invalid @enderror">{{ old('konten_detail', $profil->konten_detail) }}</textarea>
                            @error('konten_detail')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($type === 'regulasi')
                        <!-- Link Dokumen (For Regulasi) -->
                        <div class="mb-4">
                            <label for="link_dokumen" class="form-label fw-bold">
                                <i class="fas fa-link me-2"></i> Link Dokumen / Google Drive
                            </label>
                            <div class="input-group">
                                <input type="url" class="form-control @error('link_dokumen') is-invalid @enderror" 
                                       id="link_dokumen" name="link_dokumen" value="{{ old('link_dokumen', $profil->link_dokumen) }}"
                                       placeholder="https://drive.google.com/...">
                                @if($profil->link_dokumen)
                                    <button type="button" class="btn btn-outline-info" onclick="previewDocument('{{ $profil->link_dokumen }}')">
                                        <i class="fas fa-eye me-2"></i> Preview
                                    </button>
                                @endif
                            </div>
                            <small class="d-block text-info mt-2">✓ Dokumen akan ditampilkan dalam preview modal di halaman publik (bukan tab baru)</small>
                            @error('link_dokumen')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <!-- Right Column: Images -->
                    <div class="col-lg-4">
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-bold mb-3">
                                <i class="fas fa-image me-2"></i> Gambar / Ilustrasi
                            </label>
                            <div class="border-2 border-dashed border-primary rounded p-4 text-center bg-light position-relative" style="cursor: pointer;" onclick="document.getElementById('gambar').click()">
                                <input type="file" id="gambar" name="gambar" class="d-none" accept="image/*" onchange="previewImage(event)">
                                <div id="image-preview-wrapper">
                                    @if($profil->gambar)
                                        <img id="image-preview" src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="hapus_gambar" value="1" id="hapus_gambar">
                                            <label class="form-check-label text-danger" for="hapus_gambar">
                                                Hapus gambar
                                            </label>
                                        </div>
                                    @else
                                        <img id="image-preview" src="https://via.placeholder.com/400x300?text=Klik+untuk+upload" alt="Preview" class="img-fluid rounded mb-3">
                                    @endif
                                </div>
                                <p class="text-primary fw-bold mb-1">Klik di sini untuk upload</p>
                                <small class="text-muted">Format: JPG, PNG, GIF | Ukuran max: 5MB</small>
                            </div>
                            @error('gambar')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Info Card -->
                        <div class="card bg-info bg-opacity-10 border-info">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">
                                    <i class="fas fa-lightbulb text-warning me-2"></i> Tips Penulisan
                                </h6>
                                <ul class="small mb-0">
                                    <li>Gunakan judul yang jelas dan deskriptif</li>
                                    <li>Sisipkan gambar untuk menarik perhatian</li>
                                    <li>Gunakan list untuk poin-poin penting</li>
                                    <li>Format tabel untuk data terstruktur</li>
                                    <li>Tambahkan link ke dokumen terkait</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-5">
                    <div class="col-12 d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.profil.index') }}" class="btn btn-secondary btn-lg">
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

<!-- CKEditor 5 Community Edition - Free & No API Key Required -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    function initializeCKEditor(selector) {
        ClassicEditor
            .create(document.querySelector(selector), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontFamily', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'link', 'imageUpload', 'insertTable', '|',
                        'blockQuote', 'codeBlock', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                fontFamily: {
                    options: [
                        'default',
                        'Arial, sans-serif',
                        'Georgia, serif',
                        'Courier New, monospace'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
                    styles: [
                        'full',
                        'side',
                        'alignLeft',
                        'alignCenter',
                        'alignRight'
                    ]
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });
    }

    // Initialize editors when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeCKEditor('#editor_pembuka');
        initializeCKEditor('#editor_detail');
        
        // Image preview handler
        const gambarInput = document.getElementById('gambar');
        if (gambarInput) {
            gambarInput.addEventListener('change', previewImage);
        }
    });

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                
                // Remove the delete checkbox if it exists
                const deleteCheckbox = document.getElementById('hapus_gambar');
                if (deleteCheckbox) {
                    deleteCheckbox.checked = false;
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<style>
    .form-control.form-editor {
        min-height: 200px;
    }
    
    .hover-shadow {
        transition: box-shadow 0.3s ease-in-out;
    }
    
    .display-5 {
        font-size: 2rem;
        font-weight: 600;
    }

    /* Document Preview Modal Styles */
    .document-modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        animation: fadeIn 0.3s ease-in;
    }

    .document-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content-custom {
        background-color: white;
        border-radius: 12px;
        width: 95%;
        max-width: 1200px;
        height: 80vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
    }

    .modal-header-custom {
        padding: 20px;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #f9f9f9 100%);
    }

    .modal-header-custom h5 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    .modal-body-custom {
        flex: 1;
        overflow: auto;
        background-color: #f5f5f5;
    }

    .modal-body-custom iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<!-- Document Preview Modal -->
<div id="documentModal" class="document-modal">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5>Preview Dokumen</h5>
            <button type="button" class="btn-close" onclick="closeDocumentPreview()"></button>
        </div>
        <div class="modal-body-custom">
            <iframe id="documentFrame" src="" frameborder="0" allowfullscreen="true"></iframe>
        </div>
    </div>
</div>

<script>
    function previewDocument(url) {
        let embedUrl = url;
        
        // Convert Google Drive links to preview format
        if (url.includes('drive.google.com')) {
            let fileId = '';
            if (url.includes('/d/')) {
                fileId = url.split('/d/')[1].split('/')[0];
            } else if (url.includes('id=')) {
                fileId = url.split('id=')[1].split('&')[0];
            }
            
            if (fileId) {
                embedUrl = `https://drive.google.com/file/d/${fileId}/preview`;
            }
        }
        
        document.getElementById('documentFrame').src = embedUrl;
        document.getElementById('documentModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeDocumentPreview() {
        document.getElementById('documentModal').classList.remove('show');
        document.getElementById('documentFrame').src = '';
        document.body.style.overflow = 'auto';
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDocumentPreview();
        }
    });

    // Close modal when clicking outside
    document.getElementById('documentModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeDocumentPreview();
        }
    });
</script>

<!-- INCLUDE ALL MODALS -->
@include('admin.profil.modals.file-manager')
@include('admin.profil.modals.insert-media')
@include('admin.profil.modals.insert-image')
@include('admin.profil.modals.insert-link')
@include('admin.profil.modals.find-replace')
@include('admin.profil.modals.insert-character')
@include('admin.profil.modals.insert-anchor')
@include('admin.profil.modals.table-grid')
@include('admin.profil.modals.table-properties')
@include('admin.profil.modals.cell-properties')
@include('admin.profil.modals.row-properties')
@include('admin.profil.modals.source-code')
@include('admin.profil.modals.bullet-list')
@include('admin.profil.modals.numbered-list')

@push('scripts')
<script src="{{ asset('js/editor.js') }}"></script>
@endpush

@endsection