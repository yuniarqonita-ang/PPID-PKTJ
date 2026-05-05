<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-concierge-bell me-3"></i>
        Kelola Layanan Informasi
    </h1>
    <p class="page-subtitle">
        Edit konten pada halaman layanan informasi publik PPID PKTJ
    </p>
</div>

<!-- Services Overview -->
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-concierge-bell me-2"></i>
                    Layanan Informasi Publik
                </h5>
                <span class="badge bg-light text-warning">5 Layanan</span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Daftar Informasi Publik -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-list fa-3x text-primary"></i>
                                </div>
                                <h6 class="card-title fw-bold">Daftar Informasi Publik</h6>
                                <p class="card-text text-muted small">
                                    Daftar lengkap informasi yang tersedia
                                </p>
                                <a href="admin.php?page=layanan&section=daftar" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Daftar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Maklumat Pelayanan -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-file-contract fa-3x text-success"></i>
                                </div>
                                <h6 class="card-title fw-bold">Maklumat Pelayanan</h6>
                                <p class="card-text text-muted small">
                                    Standar biaya dan prosedur pelayanan
                                </p>
                                <a href="admin.php?page=layanan&section=maklumat" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Maklumat
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Laporan Layanan -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-chart-bar fa-3x text-info"></i>
                                </div>
                                <h6 class="card-title fw-bold">Laporan Layanan</h6>
                                <p class="card-text text-muted small">
                                    Laporan statistik layanan informasi
                                </p>
                                <a href="admin.php?page=layanan&section=laporan" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit me-1"></i>Update Laporan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Laporan Akses -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-globe fa-3x text-warning"></i>
                                </div>
                                <h6 class="card-title fw-bold">Laporan Akses</h6>
                                <p class="card-text text-muted small">
                                    Statistik akses website dan informasi
                                </p>
                                <a href="admin.php?page=layanan&section=laporan-akses" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Statistik
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Laporan Survey -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-poll fa-3x text-danger"></i>
                                </div>
                                <h6 class="card-title fw-bold">Laporan Survey</h6>
                                <p class="card-text text-muted small">
                                    Hasil survey kepuasan layanan
                                </p>
                                <a href="admin.php?page=layanan&section=laporan-survey" class="btn btn-danger btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Survey
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Editor Section -->
<?php if (isset($_GET['section'])): ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Konten -
                    <?php
                    $sections = [
                        'daftar' => 'Daftar Informasi Publik',
                        'maklumat' => 'Maklumat Pelayanan',
                        'laporan' => 'Laporan Layanan',
                        'laporan-akses' => 'Laporan Akses',
                        'laporan-survey' => 'Laporan Survey'
                    ];
                    echo $sections[$_GET['section']] ?? 'Unknown';
                    ?>
                </h5>
            </div>
            <div class="card-body">
                <!-- Service Content Tabs -->
                <ul class="nav nav-tabs mb-4" id="serviceTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content" type="button" role="tab">
                            <i class="fas fa-file-alt me-1"></i>Konten
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab">
                            <i class="fas fa-database me-1"></i>Data & Statistik
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">
                            <i class="fas fa-images me-1"></i>Media & File
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="serviceTabsContent">
                    <!-- Content Tab -->
                    <div class="tab-pane fade show active" id="content" role="tabpanel">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="service_title" class="form-label fw-bold">Judul Layanan</label>
                                        <input type="text" class="form-control" id="service_title" name="service_title"
                                               value="Judul Layanan" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_description" class="form-label fw-bold">Deskripsi Layanan</label>
                                        <textarea class="form-control" id="service_description" name="service_description"
                                                  rows="4" required>Deskripsi lengkap tentang layanan ini...</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_content" class="form-label fw-bold">Konten Lengkap</label>
                                        <textarea class="form-control" id="service_content" name="service_content"
                                                  rows="15" required>Konten lengkap layanan akan dimuat di sini...</textarea>
                                    </div>

                                    <!-- Service-specific fields based on section -->
                                    <?php if ($_GET['section'] === 'maklumat'): ?>
                                    <div class="mb-3">
                                        <label for="service_fees" class="form-label fw-bold">Standar Biaya</label>
                                        <textarea class="form-control" id="service_fees" name="service_fees"
                                                  rows="6" placeholder="Masukkan informasi standar biaya pelayanan...">Standar biaya pelayanan informasi publik...</textarea>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Informasi Layanan</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="active">Aktif</option>
                                                    <option value="maintenance">Maintenance</option>
                                                    <option value="inactive">Tidak Aktif</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select class="form-control" name="category">
                                                    <option value="informasi">Layanan Informasi</option>
                                                    <option value="permohonan">Layanan Permohonan</option>
                                                    <option value="komplain">Layanan Komplain</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Terakhir Update</label>
                                                <input type="text" class="form-control"
                                                       value="<?php echo date('d M Y H:i'); ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kontak PIC</label>
                                                <input type="text" class="form-control" name="pic_contact"
                                                       value="admin@ppid.pktj.ac.id" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="admin.php?page=layanan" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div>
                                    <button type="button" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-eye me-1"></i>Preview
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Data & Statistics Tab -->
                    <div class="tab-pane fade" id="data" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Statistik Layanan</h6>

                                <div class="mb-3">
                                    <label class="form-label">Total Permintaan (Bulan Ini)</label>
                                    <input type="number" class="form-control" name="requests_this_month" value="45">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Permintaan (Tahun Ini)</label>
                                    <input type="number" class="form-control" name="requests_this_year" value="520">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rata-rata Waktu Response</label>
                                    <input type="text" class="form-control" name="avg_response_time" value="2 hari">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tingkat Kepuasan</label>
                                    <input type="text" class="form-control" name="satisfaction_rate" value="85%">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="mb-3">Data Tambahan</h6>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah File Tersedia</label>
                                    <input type="number" class="form-control" name="available_files" value="25">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Download</label>
                                    <input type="number" class="form-control" name="total_downloads" value="1250">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Kunjungan Halaman</label>
                                    <input type="number" class="form-control" name="page_views" value="3400">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Update Terakhir</label>
                                    <input type="text" class="form-control" value="<?php echo date('d M Y'); ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Simpan Statistik
                            </button>
                        </div>
                    </div>

                    <!-- Media & Files Tab -->
                    <div class="tab-pane fade" id="media" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="mb-0">File dan Media terkait Layanan</h6>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-upload me-1"></i>Upload File Baru
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-custom">
                                        <thead>
                                            <tr>
                                                <th><i class="fas fa-file me-1"></i>Nama File</th>
                                                <th><i class="fas fa-file-alt me-1"></i>Tipe</th>
                                                <th><i class="fas fa-weight me-1"></i>Ukuran</th>
                                                <th><i class="fas fa-calendar me-1"></i>Upload</th>
                                                <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <i class="fas fa-folder-open fa-2x mb-2"></i>
                                                    <br>Belum ada file untuk layanan ini
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Upload File Baru</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Pilih File</label>
                                                <input type="file" class="form-control" name="file_upload">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi File</label>
                                                <textarea class="form-control" name="file_description" rows="3" placeholder="Jelaskan isi file ini..."></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kategori File</label>
                                                <select class="form-control" name="file_category">
                                                    <option value="document">Dokumen</option>
                                                    <option value="image">Gambar</option>
                                                    <option value="spreadsheet">Spreadsheet</option>
                                                    <option value="presentation">Presentasi</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-upload me-1"></i>Upload File
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<!-- Statistics -->
<div class="row">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning text-white">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="stats-number">5</div>
            <div class="stats-title">Layanan Aktif</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-success text-white">
                <i class="fas fa-users"></i>
            </div>
            <div class="stats-number">520</div>
            <div class="stats-title">Total Permintaan</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-info text-white">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number">2</div>
            <div class="stats-title">Rata-rata Response</div>
            <div class="stats-subtitle">hari</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-danger text-white">
                <i class="fas fa-smile"></i>
            </div>
            <div class="stats-number">85</div>
            <div class="stats-title">Tingkat Kepuasan</div>
            <div class="stats-subtitle">%</div>
        </div>
    </div>
</div>

<?php endif; ?>

<style>
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        background-color: var(--primary-color);
        color: white;
        border-radius: 8px 8px 0 0;
    }

    .table-custom th {
        background: var(--primary-color);
        color: white;
        border: none;
    }

    .stats-subtitle {
        font-size: 12px;
        color: #6c757d;
        margin-top: -5px;
    }
</style>
