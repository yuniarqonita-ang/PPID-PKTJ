<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt me-3"></i>
                Dashboard Admin PPID PKTJ Tegal
            </h1>
            <p class="page-subtitle">
                Kelola dan pantau semua konten website PPID Politeknik Keselamatan Transportasi Jalan Tegal
            </p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline-primary me-2" onclick="toggleStats()">
                <i class="fas fa-chart-line me-1"></i>
                <span id="stats-toggle-text">Sembunyikan Statistik</span>
            </button>
            <button class="btn btn-outline-success" onclick="toggleActivities()">
                <i class="fas fa-history me-1"></i>
                <span id="activities-toggle-text">Sembunyikan Aktivitas</span>
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards (Toggleable) -->
<div id="stats-section" class="stats-section">
<div class="row">
    <div class="col-md-3">
        <div class="stats-card stats-card-hover">
            <div class="stats-icon bg-primary text-white">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="stats-number">6</div>
            <div class="stats-title">Halaman Profil</div>
            <div class="stats-badge">
                <span class="badge bg-primary">Aktif</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card stats-card-hover">
            <div class="stats-icon bg-success text-white">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="stats-number">4</div>
            <div class="stats-title">Kategori Informasi</div>
            <div class="stats-badge">
                <span class="badge bg-success">Lengkap</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card stats-card-hover">
            <div class="stats-icon bg-warning text-white">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="stats-number">5</div>
            <div class="stats-title">Layanan Informasi</div>
            <div class="stats-badge">
                <span class="badge bg-warning">Siap</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card stats-card-hover">
            <div class="stats-icon bg-danger text-white">
                <i class="fas fa-file-contract"></i>
            </div>
            <div class="stats-number">6</div>
            <div class="stats-title">Dokumen Prosedur</div>
            <div class="stats-badge">
                <span class="badge bg-danger">Tersedia</span>
            </div>
        </div>
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
                        <a href="admin.php?page=profil" class="btn btn-primary-custom w-100">
                            <i class="fas fa-edit me-2"></i>
                            Edit Profil PPID
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin.php?page=informasi" class="btn btn-success w-100">
                            <i class="fas fa-info-circle me-2"></i>
                            Kelola Informasi
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin.php?page=layanan" class="btn btn-warning w-100">
                            <i class="fas fa-concierge-bell me-2"></i>
                            Atur Layanan
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="admin.php?page=faq" class="btn btn-info w-100">
                            <i class="fas fa-question-circle me-2"></i>
                            Update FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Overview -->
<div class="row">
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Halaman Yang Dapat Dikelola
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="admin.php?page=profil" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            Profil PPID
                        </div>
                        <span class="badge bg-primary">6 halaman</span>
                    </a>
                    <a href="admin.php?page=informasi" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-info-circle text-success me-2"></i>
                            Informasi Publik
                        </div>
                        <span class="badge bg-success">4 kategori</span>
                    </a>
                    <a href="admin.php?page=layanan" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-concierge-bell text-warning me-2"></i>
                            Layanan Informasi
                        </div>
                        <span class="badge bg-warning">5 layanan</span>
                    </a>
                    <a href="admin.php?page=prosedur" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-contract text-danger me-2"></i>
                            Prosedur & SOP
                        </div>
                        <span class="badge bg-danger">6 dokumen</span>
                    </a>
                    <a href="admin.php?page=faq" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-question-circle text-info me-2"></i>
                            FAQ
                        </div>
                        <span class="badge bg-info">Dinamis</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>
                    Status Website
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Halaman Publik</span>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            Aktif
                        </span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Admin Panel</span>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            Aktif
                        </span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Navigasi & Routing</span>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            Berfungsi
                        </span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Database Content</span>
                        <span class="badge bg-warning">
                            <i class="fas fa-clock me-1"></i>
                            Dalam Pengembangan
                        </span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Toggleable) -->
<div id="activities-section" class="activities-section">
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>
                    Aktivitas Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item mb-3">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Website PPID PKTJ Tegal Berhasil Diperbaharui</h6>
                            <p class="text-muted small mb-0">Semua branding dan konten telah disesuaikan untuk PPID PKTJ Tegal</p>
                            <small class="text-muted"><?php echo date('d M Y H:i'); ?></small>
                        </div>
                    </div>

                    <div class="timeline-item mb-3">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Admin Panel dengan Fitur Lengkap</h6>
                            <p class="text-muted small mb-0">Panel admin dengan tombol show/hide dan desain yang lebih menarik telah siap</p>
                            <small class="text-muted"><?php echo date('d M Y H:i'); ?></small>
                        </div>
                    </div>

                    <div class="timeline-item mb-3">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Sistem Login Aman</h6>
                            <p class="text-muted small mb-0">Login menggunakan email admin@pktj.ac.id dengan autentikasi yang aman</p>
                            <small class="text-muted"><?php echo date('d M Y H:i'); ?></small>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker bg-danger"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Website PPID PKTJ Tegal Siap Digunakan</h6>
                            <p class="text-muted small mb-0">Semua halaman publik dan admin panel telah siap dengan desain yang menarik</p>
                            <small class="text-muted"><?php echo date('d M Y H:i'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        margin-left: 30px;
    }

    .timeline-marker {
        position: absolute;
        left: -22px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #e9ecef;
    }

    .timeline-content h6 {
        color: var(--primary-color);
        font-weight: 600;
    }

    .stats-card-hover {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stats-card-hover::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .stats-card-hover:hover::before {
        left: 100%;
    }

    .stats-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .stats-badge {
        margin-top: 10px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .stats-section, .activities-section {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-custom-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-custom-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 58, 82, 0.3);
    }
</style>

<script>
function toggleStats() {
    const statsSection = document.getElementById('stats-section');
    const toggleText = document.getElementById('stats-toggle-text');

    if (statsSection.style.display === 'none') {
        statsSection.style.display = 'block';
        toggleText.textContent = 'Sembunyikan Statistik';
    } else {
        statsSection.style.display = 'none';
        toggleText.textContent = 'Tampilkan Statistik';
    }
}

function toggleActivities() {
    const activitiesSection = document.getElementById('activities-section');
    const toggleText = document.getElementById('activities-toggle-text');

    if (activitiesSection.style.display === 'none') {
        activitiesSection.style.display = 'block';
        toggleText.textContent = 'Sembunyikan Aktivitas';
    } else {
        activitiesSection.style.display = 'none';
        toggleText.textContent = 'Tampilkan Aktivitas';
    }
}

// Add some interactive effects
document.addEventListener('DOMContentLoaded', function() {
    // Add click effects to stat cards
    const statCards = document.querySelectorAll('.stats-card-hover');
    statCards.forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Add loading animation to page
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});
</script>
