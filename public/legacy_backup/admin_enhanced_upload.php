<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-upload me-3"></i>
        Upload Files
    </h1>
    <p class="page-subtitle">
        Upload file baru yang akan otomatis muncul di halaman publik website PPID
    </p>
</div>

<div class="upload-section">
    <div class="upload-form">
        <h4 class="mb-4">
            <i class="fas fa-cloud-upload-alt me-2"></i>
            Upload File Baru
        </h4>

        <form method="POST" enctype="multipart/form-data" id="uploadForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="upload_file" class="form-label fw-bold">
                            <i class="fas fa-file me-2"></i>Pilih File
                        </label>
                        <input type="file" class="form-control" id="upload_file" name="upload_file"
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx,.ppt,.pptx" required>
                        <div class="form-text">
                            <small class="text-muted">
                                Format yang didukung: PDF, DOC, DOCX, JPG, JPEG, PNG, XLS, XLSX, PPT, PPTX<br>
                                Maksimal ukuran: 10MB
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="file_category" class="form-label fw-bold">
                            <i class="fas fa-tags me-2"></i>Kategori File
                        </label>
                        <select class="form-control" id="file_category" name="file_category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="document">📄 Dokumen</option>
                            <option value="image">🖼️ Gambar</option>
                            <option value="spreadsheet">📊 Spreadsheet</option>
                            <option value="presentation">📽️ Presentasi</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="file_description" class="form-label fw-bold">
                    <i class="fas fa-comment me-2"></i>Deskripsi File
                </label>
                <textarea class="form-control" id="file_description" name="file_description"
                          rows="3" placeholder="Jelaskan isi file ini agar mudah dipahami..." maxlength="500"></textarea>
                <div class="form-text">
                    <small class="text-muted">Opsional, maksimal 500 karakter</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="public_visibility" name="public_visibility" checked>
                    <label class="form-check-label" for="public_visibility">
                        <i class="fas fa-eye me-1"></i>
                        <strong>Tampilkan di halaman publik</strong>
                    </label>
                    <div class="form-text">
                        <small class="text-muted">File akan otomatis muncul di halaman publik website</small>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-upload flex-fill">
                    <i class="fas fa-upload me-2"></i>
                    Upload File
                </button>
                <a href="admin_enhanced.php?page=files" class="btn btn-outline-secondary">
                    <i class="fas fa-folder-open me-2"></i>
                    Lihat Files
                </a>
            </div>
        </form>

        <!-- Upload Progress (shown during upload) -->
        <div id="uploadProgress" class="mt-3" style="display: none;">
            <div class="progress mb-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                     role="progressbar" style="width: 0%" id="progressBar"></div>
            </div>
            <small class="text-muted" id="progressText">Mengupload file...</small>
        </div>
    </div>
</div>

<!-- Upload Tips -->
<div class="row">
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>
                    Tips Upload
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Nama file jelas</strong> - Gunakan nama yang deskriptif
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Format sesuai</strong> - Pastikan format file didukung
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Ukuran optimal</strong> - Jaga ukuran file tidak terlalu besar
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Deskripsi lengkap</strong> - Jelaskan isi file agar mudah dipahami
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2 text-info"></i>
                    Preview Publik
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-3">File yang diupload akan otomatis muncul di:</p>
                <div class="d-grid gap-2">
                    <a href="/" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-home me-1"></i> Halaman Utama
                    </a>
                    <a href="/informasi-publik" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-info-circle me-1"></i> Informasi Publik
                    </a>
                    <a href="/layanan-informasi" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-concierge-bell me-1"></i> Layanan Informasi
                    </a>
                </div>
                <div class="alert alert-info mt-3 mb-0">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        File akan langsung terlihat setelah upload berhasil
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// File upload preview
document.getElementById('upload_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        const fileType = file.type || 'Unknown';

        console.log('File selected:', { name: fileName, size: fileSize, type: fileType });

        // Auto-fill description if empty
        const descriptionField = document.getElementById('file_description');
        if (!descriptionField.value.trim()) {
            descriptionField.value = `File: ${fileName} (${fileSize})`;
        }
    }
});

// Form validation
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('upload_file');
    const categorySelect = document.getElementById('file_category');

    if (!fileInput.files[0]) {
        e.preventDefault();
        alert('Silakan pilih file untuk diupload!');
        return false;
    }

    if (!categorySelect.value) {
        e.preventDefault();
        alert('Silakan pilih kategori file!');
        return false;
    }

    // Show progress
    document.getElementById('uploadProgress').style.display = 'block';
    document.getElementById('progressBar').style.width = '50%';
    document.getElementById('progressText').textContent = 'Mengupload file...';

    // Disable submit button
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengupload...';
});

// File type validation
document.getElementById('upload_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'xls', 'xlsx', 'ppt', 'pptx'];
        const fileExt = file.name.split('.').pop().toLowerCase();

        if (!allowedTypes.includes(fileExt)) {
            alert('Format file tidak didukung! Format yang diperbolehkan: PDF, DOC, DOCX, JPG, JPEG, PNG, XLS, XLSX, PPT, PPTX');
            e.target.value = '';
            return;
        }

        if (file.size > 10 * 1024 * 1024) { // 10MB
            alert('Ukuran file terlalu besar! Maksimal 10MB.');
            e.target.value = '';
            return;
        }
    }
});
</script>
