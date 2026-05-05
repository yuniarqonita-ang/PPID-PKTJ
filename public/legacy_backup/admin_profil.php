<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-user-circle me-3"></i>
        Kelola Profil PPID
    </h1>
    <p class="page-subtitle">
        Edit konten dan informasi pada halaman-halaman profil PPID PKTJ
    </p>
</div>

<!-- Profile Pages Overview -->
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Halaman Profil PPID
                </h5>
                <span class="badge bg-light text-primary">6 Halaman</span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Profil PPID -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-building fa-3x text-primary"></i>
                                </div>
                                <h6 class="card-title fw-bold">Profil PPID</h6>
                                <p class="card-text text-muted small">
                                    Informasi umum tentang PPID PKTJ
                                </p>
                                <a href="admin.php?page=profil&section=ppid" class="btn btn-primary-custom btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tugas dan Tanggung Jawab -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-tasks fa-3x text-success"></i>
                                </div>
                                <h6 class="card-title fw-bold">Tugas & Tanggung Jawab</h6>
                                <p class="card-text text-muted small">
                                    Fungsi dan kewajiban PPID
                                </p>
                                <a href="admin.php?page=profil&section=tugas" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Visi dan Misi -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-eye fa-3x text-info"></i>
                                </div>
                                <h6 class="card-title fw-bold">Visi & Misi</h6>
                                <p class="card-text text-muted small">
                                    Visi dan misi PPID PKTJ
                                </p>
                                <a href="admin.php?page=profil&section=visi" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Struktur Organisasi -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-sitemap fa-3x text-warning"></i>
                                </div>
                                <h6 class="card-title fw-bold">Struktur Organisasi</h6>
                                <p class="card-text text-muted small">
                                    Organisasi dan struktur PPID
                                </p>
                                <a href="admin.php?page=profil&section=struktur" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Regulasi -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-gavel fa-3x text-danger"></i>
                                </div>
                                <h6 class="card-title fw-bold">Regulasi</h6>
                                <p class="card-text text-muted small">
                                    Peraturan dan regulasi terkait
                                </p>
                                <a href="admin.php?page=profil&section=regulasi" class="btn btn-danger btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-address-book fa-3x text-secondary"></i>
                                </div>
                                <h6 class="card-title fw-bold">Kontak</h6>
                                <p class="card-text text-muted small">
                                    Informasi kontak dan lokasi
                                </p>
                                <a href="admin.php?page=profil&section=kontak" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Konten
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
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Konten -
                    <?php
                    $sections = [
                        'ppid' => 'Profil PPID',
                        'tugas' => 'Tugas dan Tanggung Jawab',
                        'visi' => 'Visi dan Misi',
                        'struktur' => 'Struktur Organisasi',
                        'regulasi' => 'Regulasi',
                        'kontak' => 'Kontak'
                    ];
                    echo $sections[$_GET['section']] ?? 'Unknown';
                    ?>
                </h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="page_title" class="form-label fw-bold">Judul Halaman</label>
                        <input type="text" class="form-control" id="page_title" name="page_title"
                               value="Judul Default Halaman" required>
                    </div>

                    <div class="mb-3">
                        <label for="page_content" class="form-label fw-bold">Konten Halaman</label>
                        <textarea class="form-control" id="page_content" name="page_content"
                                  rows="15" required>Konten halaman akan dimuat di sini...</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label fw-bold">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description"
                                  rows="3" placeholder="Deskripsi singkat untuk SEO">Deskripsi meta untuk halaman ini</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_updated" class="form-label fw-bold">Terakhir Update</label>
                                <input type="text" class="form-control" id="last_updated"
                                       value="<?php echo date('d M Y H:i'); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="admin.php?page=profil" class="btn btn-secondary">
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
        </div>
    </div>
</div>

<script>
// Simple rich text editor placeholder
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('page_content');
    // In a real implementation, you would integrate a rich text editor like TinyMCE or CKEditor here
});
</script>

<?php else: ?>

<!-- Quick Stats -->
<div class="row">
    <div class="col-md-4">
        <div class="stats-card">
            <div class="stats-icon bg-primary text-white">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stats-number">6</div>
            <div class="stats-title">Total Halaman</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stats-card">
            <div class="stats-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-number">6</div>
            <div class="stats-title">Halaman Aktif</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stats-card">
            <div class="stats-icon bg-info text-white">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number">0</div>
            <div class="stats-title">Update Terbaru</div>
        </div>
    </div>
</div>

<?php endif; ?>

<style>
    .card-custom .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
</style>
