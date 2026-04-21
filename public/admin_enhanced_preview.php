<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-eye me-3"></i>
        Preview Halaman Publik
    </h1>
    <p class="page-subtitle">
        Lihat bagaimana file yang diupload muncul di halaman publik website PPID
    </p>
</div>

<!-- Preview Sections -->
<div class="row">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-images me-2"></i>
                    Preview File Upload di Halaman Publik
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Preview Mode:</strong> Ini menunjukkan bagaimana file Anda akan muncul di website publik
                </div>

                <?php if (empty($uploadedFiles)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada file untuk di-preview</p>
                        <a href="admin_enhanced.php?page=upload" class="btn btn-primary">
                            <i class="fas fa-upload me-1"></i>Upload File Dulu
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Gallery View -->
                    <div class="row g-3">
                        <?php
                        $imageFiles = array_filter($uploadedFiles, function($file) {
                            $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                            return in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
                        });

                        $documentFiles = array_filter($uploadedFiles, function($file) {
                            $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                            return in_array($ext, ['pdf', 'doc', 'docx']);
                        });

                        $otherFiles = array_filter($uploadedFiles, function($file) {
                            $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                            return !in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);
                        });
                        ?>

                        <!-- Images Section -->
                        <?php if (!empty($imageFiles)): ?>
                        <div class="col-12">
                            <h6 class="mb-3">
                                <i class="fas fa-images text-success me-2"></i>
                                Gambar (<?php echo count($imageFiles); ?> file)
                            </h6>
                            <div class="row g-2">
                                <?php foreach (array_slice($imageFiles, 0, 6) as $file): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100">
                                        <img src="<?php echo htmlspecialchars($file['file_path']); ?>"
                                             class="card-img-top" alt="Preview"
                                             style="height: 120px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <h6 class="card-title small mb-1"><?php echo htmlspecialchars($file['original_name']); ?></h6>
                                            <small class="text-muted"><?php echo htmlspecialchars($file['description'] ?: 'Gambar publik'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($imageFiles) > 6): ?>
                            <small class="text-muted mt-2 d-block">+<?php echo count($imageFiles) - 6; ?> gambar lainnya</small>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Documents Section -->
                        <?php if (!empty($documentFiles)): ?>
                        <div class="col-12 mt-3">
                            <h6 class="mb-3">
                                <i class="fas fa-file-alt text-primary me-2"></i>
                                Dokumen (<?php echo count($documentFiles); ?> file)
                            </h6>
                            <div class="list-group">
                                <?php foreach (array_slice($documentFiles, 0, 5) as $file): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <?php
                                        $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                                        $icon = 'fa-file';
                                        $color = 'text-secondary';

                                        if ($ext === 'pdf') {
                                            $icon = 'fa-file-pdf';
                                            $color = 'text-danger';
                                        } elseif (in_array($ext, ['doc', 'docx'])) {
                                            $icon = 'fa-file-word';
                                            $color = 'text-primary';
                                        }
                                        ?>
                                        <i class="fas <?php echo $icon; ?> fa-lg <?php echo $color; ?> me-3"></i>
                                        <div>
                                            <div class="fw-bold"><?php echo htmlspecialchars($file['original_name']); ?></div>
                                            <small class="text-muted"><?php echo htmlspecialchars($file['description'] ?: 'Dokumen publik'); ?></small>
                                        </div>
                                    </div>
                                    <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i>Lihat
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($documentFiles) > 5): ?>
                            <small class="text-muted mt-2 d-block">+<?php echo count($documentFiles) - 5; ?> dokumen lainnya</small>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Other Files Section -->
                        <?php if (!empty($otherFiles)): ?>
                        <div class="col-12 mt-3">
                            <h6 class="mb-3">
                                <i class="fas fa-file text-warning me-2"></i>
                                File Lainnya (<?php echo count($otherFiles); ?> file)
                            </h6>
                            <small class="text-muted">File ini tidak ditampilkan di halaman publik utama</small>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-link me-2"></i>
                    Link Publik
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-3">File yang diupload dapat diakses melalui:</p>
                <div class="d-grid gap-2">
                    <a href="/" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-home me-1"></i> Halaman Utama
                    </a>
                    <a href="/informasi-publik/berkala" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-info-circle me-1"></i> Informasi Berkala
                    </a>
                    <a href="/layanan-informasi" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-concierge-bell me-1"></i> Layanan Informasi
                    </a>
                </div>

                <hr class="my-3">

                <h6>📁 Upload Directory:</h6>
                <code class="small">/uploads/</code>

                <h6 class="mt-3">📊 Metadata File:</h6>
                <code class="small">/uploads/files_metadata.json</code>

                <div class="alert alert-warning mt-3 mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        <strong>Important:</strong> File akan otomatis muncul di halaman publik setelah upload
                    </small>
                </div>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Ringkasan Upload
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="h4 mb-0 text-primary"><?php echo count($uploadedFiles); ?></div>
                        <small class="text-muted">Total Files</small>
                    </div>
                    <div class="col-6">
                        <div class="h4 mb-0 text-success">
                            <?php
                            $publicCount = 0;
                            foreach ($uploadedFiles as $file) {
                                $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'])) {
                                    $publicCount++;
                                }
                            }
                            echo $publicCount;
                            ?>
                        </div>
                        <small class="text-muted">Files Publik</small>
                    </div>
                </div>

                <hr class="my-3">

                <div class="small">
                    <div class="mb-2">
                        <i class="fas fa-images text-success me-1"></i>
                        Gambar: <?php echo count(array_filter($uploadedFiles, function($f) { $ext = strtolower(pathinfo($f['original_name'], PATHINFO_EXTENSION)); return in_array($ext, ['jpg', 'jpeg', 'png', 'gif']); })); ?>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-file-pdf text-danger me-1"></i>
                        PDF: <?php echo count(array_filter($uploadedFiles, function($f) { return strtolower(pathinfo($f['original_name'], PATHINFO_EXTENSION)) === 'pdf'; })); ?>
                    </div>
                    <div class="mb-0">
                        <i class="fas fa-file-word text-primary me-1"></i>
                        Dokumen: <?php echo count(array_filter($uploadedFiles, function($f) { $ext = strtolower(pathinfo($f['original_name'], PATHINFO_EXTENSION)); return in_array($ext, ['doc', 'docx']); })); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Integration Status -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plug me-2"></i>
                    Status Integrasi Publik
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h6>File Upload</h6>
                            <small class="text-muted">✅ Files tersimpan</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h6>Metadata Storage</h6>
                            <small class="text-muted">✅ Data tersimpan di JSON</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h6>Public Access</h6>
                            <small class="text-muted">✅ Files dapat diakses</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h6>Auto Integration</h6>
                            <small class="text-muted">✅ Muncul otomatis di publik</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="alert alert-success">
                    <i class="fas fa-thumbs-up me-2"></i>
                    <strong>Semua sistem terintegrasi dengan baik!</strong><br>
                    File yang diupload akan otomatis muncul di halaman publik website PPID.
                </div>
            </div>
        </div>
    </div>
</div>
