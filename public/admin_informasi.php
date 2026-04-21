<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-info-circle me-3"></i>
        Kelola Informasi Publik
    </h1>
    <p class="page-subtitle">
        Edit konten pada halaman informasi publik PPID PKTJ
    </p>
</div>

<!-- Information Categories Overview -->
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-folder-open me-2"></i>
                    Kategori Informasi Publik
                </h5>
                <span class="badge bg-light text-success">4 Kategori</span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Informasi Berkala -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-calendar-alt fa-3x text-success"></i>
                                </div>
                                <h6 class="card-title fw-bold">Informasi Berkala</h6>
                                <p class="card-text text-muted small">
                                    Informasi yang wajib disediakan secara berkala
                                </p>
                                <a href="admin.php?page=informasi&section=berkala" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Serta Merta -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-bolt fa-3x text-warning"></i>
                                </div>
                                <h6 class="card-title fw-bold">Informasi Serta Merta</h6>
                                <p class="card-text text-muted small">
                                    Informasi yang harus segera disampaikan
                                </p>
                                <a href="admin.php?page=informasi&section=serta-merta" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Setiap Saat -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-clock fa-3x text-info"></i>
                                </div>
                                <h6 class="card-title fw-bold">Informasi Setiap Saat</h6>
                                <p class="card-text text-muted small">
                                    Informasi yang wajib tersedia setiap saat
                                </p>
                                <a href="admin.php?page=informasi&section=setiap-saat" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Dikecualikan -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-shield-alt fa-3x text-danger"></i>
                                </div>
                                <h6 class="card-title fw-bold">Informasi Dikecualikan</h6>
                                <p class="card-text text-muted small">
                                    Informasi yang dikecualikan dari diumumkan
                                </p>
                                <a href="admin.php?page=informasi&section=dikecualikan" class="btn btn-danger btn-sm">
                                    <i class="fas fa-edit me-1"></i>Kelola Konten
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
                        'berkala' => 'Informasi Berkala',
                        'serta-merta' => 'Informasi Serta Merta',
                        'setiap-saat' => 'Informasi Setiap Saat',
                        'dikecualikan' => 'Informasi Dikecualikan'
                    ];
                    echo $sections[$_GET['section']] ?? 'Unknown';
                    ?>
                </h5>
            </div>
            <div class="card-body">
                <!-- Content Management Tabs -->
                <ul class="nav nav-tabs mb-4" id="contentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                            <i class="fas fa-file-alt me-1"></i>Ikhtisar
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
                            <i class="fas fa-folder me-1"></i>Dokumen
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                            <i class="fas fa-cog me-1"></i>Pengaturan
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="contentTabsContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="page_title" class="form-label fw-bold">Judul Halaman</label>
                                        <input type="text" class="form-control" id="page_title" name="page_title"
                                               value="Informasi Berkala PPID PKTJ" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="page_description" class="form-label fw-bold">Deskripsi Halaman</label>
                                        <textarea class="form-control" id="page_description" name="page_description"
                                                  rows="4" required>Deskripsi lengkap tentang kategori informasi ini...</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="main_content" class="form-label fw-bold">Konten Utama</label>
                                        <textarea class="form-control" id="main_content" name="main_content"
                                                  rows="12" required>Konten utama halaman akan dimuat di sini...</textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Informasi Halaman</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="published">Published</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Terakhir Update</label>
                                                <input type="text" class="form-control"
                                                       value="<?php echo date('d M Y H:i'); ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Dokumen</label>
                                                <input type="text" class="form-control" value="0 dokumen" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="admin.php?page=informasi" class="btn btn-secondary">
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

                    <!-- Documents Tab -->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="mb-0">Dokumen dalam Kategori Ini</h6>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Dokumen
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-file me-1"></i>Nama Dokumen</th>
                                        <th><i class="fas fa-calendar me-1"></i>Tanggal Upload</th>
                                        <th><i class="fas fa-file-alt me-1"></i>Tipe File</th>
                                        <th><i class="fas fa-weight me-1"></i>Ukuran</th>
                                        <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                                            <br>Belum ada dokumen di kategori ini
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="settings" role="tabpanel">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-3">Pengaturan Tampilan</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Tampilkan di Menu Utama</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="show_in_menu" checked>
                                            <label class="form-check-label">Ya, tampilkan di menu navigasi</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Urutan di Menu</label>
                                        <input type="number" class="form-control" name="menu_order" value="1" min="1">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Icon Menu</label>
                                        <select class="form-control" name="menu_icon">
                                            <option value="fas fa-calendar-alt">Calendar</option>
                                            <option value="fas fa-bolt">Bolt</option>
                                            <option value="fas fa-clock">Clock</option>
                                            <option value="fas fa-shield-alt">Shield</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="mb-3">Pengaturan SEO</h6>

                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                               value="Informasi Berkala - PPID PKTJ">
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description"
                                                  rows="3">Informasi berkala PPID Politeknik Kesehatan Jakarta I</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keywords" class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords"
                                               value="PPID, informasi berkala, PKTJ">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>Simpan Pengaturan
                                </button>
                            </div>
                        </form>
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
            <div class="stats-icon bg-success text-white">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stats-number">4</div>
            <div class="stats-title">Kategori Aktif</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-primary text-white">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stats-number">0</div>
            <div class="stats-title">Total Dokumen</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning text-white">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">1,234</div>
            <div class="stats-title">Dilihat Bulan Ini</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-info text-white">
                <i class="fas fa-download"></i>
            </div>
            <div class="stats-number">89</div>
            <div class="stats-title">Download Bulan Ini</div>
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
</style>
