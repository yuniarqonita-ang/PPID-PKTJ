

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?php echo e(route('admin.profil.index')); ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <h2 class="display-5 fw-bold text-primary">
                <i class="fas fa-edit me-2"></i> Edit <?php echo e(ucfirst(str_replace('-', ' ', $type))); ?>

            </h2>
            <p class="text-muted">Kelola konten dan media untuk halaman ini</p>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">
                <i class="fas fa-exclamation-circle me-2"></i> Terjadi Kesalahan!
            </h5>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-lg">
        <div class="card-body p-5">
            <form action="<?php echo e(route('admin.profil.update', $type)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">
                    <!-- Left Column: Text Content -->
                    <div class="col-lg-8">
                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul Halaman
                            </label>
                            <input type="text" class="form-control form-control-lg <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="judul" name="judul" value="<?php echo e(old('judul', $profil->judul)); ?>"
                                   placeholder="Masukkan judul halaman..." required>
                            <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Konten Pembuka -->
                        <div class="mb-4">
                            <label for="konten_pembuka" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Utama
                            </label>
                            <small class="d-block text-muted mb-2">Gunakan editor di bawah untuk memformat teks (bold, italic, list, link, dll)</small>
                            <textarea id="editor_pembuka" name="konten_pembuka" class="form-control form-editor <?php $__errorArgs = ['konten_pembuka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('konten_pembuka', $profil->konten_pembuka)); ?></textarea>
                            <?php $__errorArgs = ['konten_pembuka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Judul Sub -->
                        <div class="mb-4">
                            <label for="judul_sub" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i> Judul Bagian Tambahan (Opsional)
                            </label>
                            <input type="text" class="form-control <?php $__errorArgs = ['judul_sub'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="judul_sub" name="judul_sub" value="<?php echo e(old('judul_sub', $profil->judul_sub)); ?>"
                                   placeholder="Contoh: Detail Lebih Lanjut...">
                            <?php $__errorArgs = ['judul_sub'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Konten Detail -->
                        <div class="mb-4">
                            <label for="konten_detail" class="form-label fw-bold">
                                <i class="fas fa-pen-fancy me-2"></i> Konten Bagian Tambahan
                            </label>
                            <small class="d-block text-muted mb-2">Konten tambahan dengan format lengkap (tabel, list, dll)</small>
                            <textarea id="editor_detail" name="konten_detail" class="form-control form-editor <?php $__errorArgs = ['konten_detail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('konten_detail', $profil->konten_detail)); ?></textarea>
                            <?php $__errorArgs = ['konten_detail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <?php if($type === 'regulasi'): ?>
                        <!-- Link Dokumen (For Regulasi) -->
                        <div class="mb-4">
                            <label for="link_dokumen" class="form-label fw-bold">
                                <i class="fas fa-link me-2"></i> Link Dokumen / Google Drive
                            </label>
                            <div class="input-group">
                                <input type="url" class="form-control <?php $__errorArgs = ['link_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="link_dokumen" name="link_dokumen" value="<?php echo e(old('link_dokumen', $profil->link_dokumen)); ?>"
                                       placeholder="https://drive.google.com/...">
                                <?php if($profil->link_dokumen): ?>
                                    <button type="button" class="btn btn-outline-info" onclick="previewDocument('<?php echo e($profil->link_dokumen); ?>')">
                                        <i class="fas fa-eye me-2"></i> Preview
                                    </button>
                                <?php endif; ?>
                            </div>
                            <small class="d-block text-info mt-2">✓ Dokumen akan ditampilkan dalam preview modal di halaman publik (bukan tab baru)</small>
                            <?php $__errorArgs = ['link_dokumen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <?php endif; ?>
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
                                    <?php if($profil->gambar): ?>
                                        <img id="image-preview" src="<?php echo e(asset('storage/profil/' . $profil->gambar)); ?>" alt="<?php echo e($profil->judul); ?>" class="img-fluid rounded mb-3" style="max-height: 300px;">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="hapus_gambar" value="1" id="hapus_gambar">
                                            <label class="form-check-label text-danger" for="hapus_gambar">
                                                Hapus gambar
                                            </label>
                                        </div>
                                    <?php else: ?>
                                        <img id="image-preview" src="https://via.placeholder.com/400x300?text=Klik+untuk+upload" alt="Preview" class="img-fluid rounded mb-3">
                                    <?php endif; ?>
                                </div>
                                <p class="text-primary fw-bold mb-1">Klik di sini untuk upload</p>
                                <small class="text-muted">Format: JPG, PNG, GIF | Ukuran max: 5MB</small>
                            </div>
                            <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                        <a href="<?php echo e(route('admin.profil.index')); ?>" class="btn btn-secondary btn-lg">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/profil/edit.blade.php ENDPATH**/ ?>