<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-tachometer-alt me-3"></i>
        Dashboard Admin Enhanced
    </h1>
    <p class="page-subtitle">
        Kelola dan pantau semua konten website PPID Politeknik Keselamatan Transportasi Jalan Tegal
    </p>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="stats-number"><?php echo count($uploadedFiles); ?></div>
            <div class="stats-title">Total Files</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="fas fa-upload"></i>
            </div>
            <div class="stats-number">
                <?php
                $thisMonth = date('Y-m');
                $thisMonthCount = 0;
                foreach ($uploadedFiles as $file) {
                    if (strpos($file['upload_date'], $thisMonth) === 0) {
                        $thisMonthCount++;
                    }
                }
                echo $thisMonthCount;
                ?>
            </div>
            <div class="stats-title">Upload Bulan Ini</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stats-number">
                <?php
                $totalSize = 0;
                foreach ($uploadedFiles as $file) {
                    $totalSize += $file['size'];
                }
                echo round($totalSize / 1024 / 1024, 1); // MB
                ?>
            </div>
            <div class="stats-title">Total Size (MB)</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-danger">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">
                <?php
                $publicFiles = array_filter($uploadedFiles, function($file) {
                    return in_array(strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'pdf']);
                });
                echo count($publicFiles);
                ?>
            </div>
            <div class="stats-title">Files Publik</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-bolt me-2 text-warning"></i>
                    Aksi Cepat
                </h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="admin_enhanced.php?page=upload" class="btn btn-success w-100">
                            <i class="fas fa-upload me-2"></i>
                            Upload File
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin_enhanced.php?page=files" class="btn btn-primary w-100">
                            <i class="fas fa-folder-open me-2"></i>
                            Kelola Files
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin_enhanced.php?page=preview" class="btn btn-info w-100">
                            <i class="fas fa-eye me-2"></i>
                            Preview Public
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin_enhanced.php?page=settings" class="btn btn-warning w-100">
                            <i class="fas fa-cog me-2"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Uploads -->
<div class="row">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Upload Terbaru
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($uploadedFiles)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada file yang diupload</p>
                        <a href="admin_enhanced.php?page=upload" class="btn btn-primary">
                            <i class="fas fa-upload me-1"></i>Upload File Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Kategori</th>
                                    <th>Ukuran</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recentFiles = array_slice($uploadedFiles, 0, 5);
                                foreach ($recentFiles as $file):
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php
                                            $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                                            $icon = 'fa-file';
                                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $icon = 'fa-image';
                                            } elseif (in_array($ext, ['pdf'])) {
                                                $icon = 'fa-file-pdf';
                                            } elseif (in_array($ext, ['doc', 'docx'])) {
                                                $icon = 'fa-file-word';
                                            } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                $icon = 'fa-file-excel';
                                            }
                                            ?>
                                            <i class="fas <?php echo $icon; ?> me-2 text-primary"></i>
                                            <div>
                                                <div class="fw-bold"><?php echo htmlspecialchars($file['original_name']); ?></div>
                                                <small class="text-muted"><?php echo htmlspecialchars($file['description'] ?: 'Tidak ada deskripsi'); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($file['category']); ?></span>
                                    </td>
                                    <td><?php echo round($file['size'] / 1024, 1); ?> KB</td>
                                    <td><?php echo date('d/m/Y', strtotime($file['upload_date'])); ?></td>
                                    <td>
                                        <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-action">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button onclick="confirmDelete('<?php echo htmlspecialchars($file['original_name']); ?>', '<?php echo $file['id']; ?>')" class="btn btn-sm btn-outline-danger btn-action">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Statistik File
                </h5>
            </div>
            <div class="card-body">
                <?php
                $stats = [
                    'document' => 0,
                    'image' => 0,
                    'spreadsheet' => 0,
                    'presentation' => 0
                ];

                foreach ($uploadedFiles as $file) {
                    if (isset($stats[$file['category']])) {
                        $stats[$file['category']]++;
                    }
                }
                ?>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="fas fa-file-alt me-2 text-primary"></i>Dokumen</span>
                        <span class="badge bg-primary"><?php echo $stats['document']; ?></span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: <?php echo count($uploadedFiles) > 0 ? ($stats['document'] / count($uploadedFiles)) * 100 : 0; ?>%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="fas fa-image me-2 text-success"></i>Gambar</span>
                        <span class="badge bg-success"><?php echo $stats['image']; ?></span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: <?php echo count($uploadedFiles) > 0 ? ($stats['image'] / count($uploadedFiles)) * 100 : 0; ?>%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="fas fa-table me-2 text-warning"></i>Spreadsheet</span>
                        <span class="badge bg-warning"><?php echo $stats['spreadsheet']; ?></span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo count($uploadedFiles) > 0 ? ($stats['spreadsheet'] / count($uploadedFiles)) * 100 : 0; ?>%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="fas fa-presentation me-2 text-danger"></i>Presentasi</span>
                        <span class="badge bg-danger"><?php echo $stats['presentation']; ?></span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" style="width: <?php echo count($uploadedFiles) > 0 ? ($stats['presentation'] / count($uploadedFiles)) * 100 : 0; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Info Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="small">
                    <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Upload Max:</strong> <?php echo ini_get('upload_max_filesize'); ?></p>
                    <p><strong>Post Max:</strong> <?php echo ini_get('post_max_size'); ?></p>
                    <p><strong>Files Count:</strong> <?php echo count($uploadedFiles); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
