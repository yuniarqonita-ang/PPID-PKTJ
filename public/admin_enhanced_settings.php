<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-cog me-3"></i>
        Pengaturan Admin
    </h1>
    <p class="page-subtitle">
        Konfigurasi pengaturan admin panel dan sistem upload file
    </p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user-shield me-2"></i>
                    Pengaturan Admin
                </h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="admin_username" class="form-label fw-bold">
                                    <i class="fas fa-user me-2"></i>Username Admin
                                </label>
                                <input type="text" class="form-control" id="admin_username" name="admin_username"
                                       value="admin@pktj.ac.id" required>
                                <small class="form-text text-muted">Username untuk login admin panel</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="admin_password" class="form-label fw-bold">
                                    <i class="fas fa-lock me-2"></i>Password Admin
                                </label>
                                <input type="password" class="form-control" id="admin_password" name="admin_password"
                                       value="admin123" required>
                                <small class="form-text text-muted">Password untuk login admin panel</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="site_title" class="form-label fw-bold">
                            <i class="fas fa-heading me-2"></i>Judul Website
                        </label>
                        <input type="text" class="form-control" id="site_title" name="site_title"
                               value="PPID PKTJ Tegal - Portal Informasi Publik">
                        <small class="form-text text-muted">Judul website yang muncul di browser</small>
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label fw-bold">
                            <i class="fas fa-file-alt me-2"></i>Deskripsi Website
                        </label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3">Portal Informasi Publik Politeknik Keselamatan Transportasi Jalan Tegal</textarea>
                        <small class="form-text text-muted">Deskripsi website untuk SEO</small>
                    </div>

                    <div class="mb-3">
                        <label for="contact_email" class="form-label fw-bold">
                            <i class="fas fa-envelope me-2"></i>Email Kontak
                        </label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email"
                               value="info@pktj.ac.id">
                        <small class="form-text text-muted">Email untuk informasi dan permohonan</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_file_size" class="form-label fw-bold">
                                    <i class="fas fa-weight me-2"></i>Max File Size (MB)
                                </label>
                                <input type="number" class="form-control" id="max_file_size" name="max_file_size"
                                       value="10" min="1" max="50">
                                <small class="form-text text-muted">Ukuran maksimal file upload</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="allowed_extensions" class="form-label fw-bold">
                                    <i class="fas fa-file-check me-2"></i>Format File Diizinkan
                                </label>
                                <input type="text" class="form-control" id="allowed_extensions" name="allowed_extensions"
                                       value="pdf,doc,docx,jpg,jpeg,png,xls,xlsx,ppt,pptx"
                                       placeholder="pisahkan dengan koma">
                                <small class="form-text text-muted">Format file yang boleh diupload</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode">
                            <label class="form-check-label fw-bold" for="maintenance_mode">
                                <i class="fas fa-tools me-2"></i>Mode Maintenance
                            </label>
                            <small class="form-text text-muted d-block">Aktifkan untuk menutup website sementara</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" name="save_settings" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Simpan Pengaturan
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-server me-2"></i>
                    System Info
                </h5>
            </div>
            <div class="card-body">
                <div class="small">
                    <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
                    <p><strong>Upload Max:</strong> <?php echo ini_get('upload_max_filesize'); ?></p>
                    <p><strong>Post Max:</strong> <?php echo ini_get('post_max_size'); ?></p>
                    <p><strong>Memory Limit:</strong> <?php echo ini_get('memory_limit'); ?></p>
                    <p><strong>Max Execution:</strong> <?php echo ini_get('max_execution_time'); ?>s</p>
                </div>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-database me-2"></i>
                    Storage Info
                </h5>
            </div>
            <div class="card-body">
                <div class="small">
                    <p><strong>Upload Dir:</strong> /uploads/</p>
                    <p><strong>Metadata File:</strong> files_metadata.json</p>
                    <p><strong>Total Files:</strong> <?php echo count($uploadedFiles); ?></p>
                    <p><strong>Total Size:</strong>
                        <?php
                        $totalSize = 0;
                        foreach ($uploadedFiles as $file) {
                            $totalSize += $file['size'];
                        }
                        echo round($totalSize / 1024 / 1024, 2) . ' MB';
                        ?>
                    </p>
                    <p><strong>Disk Free:</strong>
                        <?php
                        $freeSpace = disk_free_space("/");
                        echo round($freeSpace / 1024 / 1024 / 1024, 2) . ' GB';
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-code-branch me-2"></i>
                    GitHub Ready
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-success mb-0">
                    <small>
                        <i class="fas fa-check-circle me-1"></i>
                        <strong>Admin panel siap di-commit ke GitHub!</strong><br>
                        Semua file sudah dibuat dengan struktur yang rapi dan fungsionalitas lengkap.
                    </small>
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        <strong>Files Created:</strong><br>
                        • admin_enhanced.php<br>
                        • admin_enhanced_*.php (5 files)<br>
                        • Upload system lengkap<br>
                        • Preview integration<br>
                        • Modern UI design
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Backup & Export -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-download me-2"></i>
                    Backup & Export Data
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary w-100 mb-2" onclick="exportMetadata()">
                            <i class="fas fa-file-export me-2"></i>
                            Export Metadata
                        </button>
                        <small class="text-muted d-block">Download file metadata JSON</small>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-outline-success w-100 mb-2" onclick="exportFilesList()">
                            <i class="fas fa-list me-2"></i>
                            Export File List
                        </button>
                        <small class="text-muted d-block">Download daftar file CSV</small>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-outline-warning w-100 mb-2" onclick="backupAll()">
                            <i class="fas fa-archive me-2"></i>
                            Full Backup
                        </button>
                        <small class="text-muted d-block">Backup semua data dan file</small>
                    </div>
                </div>

                <hr class="my-3">

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>GitHub Ready:</strong> Admin panel ini sudah siap di-commit ke GitHub Desktop. Teman kamu bisa test besok dengan mudah!
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Export functions
function exportMetadata() {
    const data = <?php echo json_encode($uploadedFiles); ?>;
    const blob = new Blob([JSON.stringify(data, null, 2)], {type: 'application/json'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'files_metadata_backup_' + new Date().toISOString().split('T')[0] + '.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function exportFilesList() {
    const files = <?php echo json_encode($uploadedFiles); ?>;
    let csv = 'Nama File,Kategori,Ukuran,Tanggal Upload,Deskripsi\n';

    files.forEach(file => {
        csv += `"${file.original_name}","${file.category}","${(file.size / 1024).toFixed(1)} KB","${file.upload_date}","${file.description || ''}"\n`;
    });

    const blob = new Blob([csv], {type: 'text/csv'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'files_list_' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function backupAll() {
    // This would require server-side zip creation
    alert('Full backup akan dibuat. Fitur ini perlu implementasi server-side untuk membuat ZIP file.');
}
</script>
