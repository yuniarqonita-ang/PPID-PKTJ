<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        
        /* Dropdown styles untuk desktop */
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block !important; 
                margin-top: 0; 
            } 
        }
        
        /* Dropdown z-index fix */
        .dropdown-menu {
            z-index: 1050 !important;
        }
        
        .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-left: 0.3em solid transparent;
            margin-left: 0.5em;
        }
        
        /* Hero Section */
        .hero-section { 
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 50%, #d4af37 100%);
            color: white; 
            padding: 100px 0; 
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-section h1 {
            font-size: 56px;
            font-weight: 900;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-section .lead {
            font-size: 22px;
            font-weight: 500;
            color: #d4af37;
            letter-spacing: 1px;
        }
        
        .section-title { 
            border-bottom: 3px solid #d4af37; 
            display: inline-block; 
            padding-bottom: 12px; 
            margin-bottom: 30px; 
            text-transform: uppercase; 
            font-weight: bold; 
            color: #1a3a52;
            font-size: 24px;
            letter-spacing: 1px;
        }
        
        .card { 
            border: none; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            transition: all 0.3s ease; 
            border-radius: 12px; 
            overflow: hidden; 
        }
        
        .card:hover { 
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }
        
        .btn-warning {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
            font-weight: 600;
        }
        
        .btn-warning:hover {
            background-color: #c9a227;
            border-color: #c9a227;
            color: #1a3a52;
        }
        
        .badge {
            background-color: #d4af37 !important;
            color: #1a3a52 !important;
            font-weight: 600;
        }
        
        .btn-outline-primary {
            color: #0066cc;
            border-color: #0066cc;
        }
        
        .btn-outline-primary:hover {
            background-color: #e6f2ff;
            border-color: #0066cc;
        }
        
        .list-group-item {
            border: none;
            border-bottom: 1px solid #e9ecef;
        }
        
        .list-group-item:hover {
            background-color: #fff3e0;
            color: #d4af37;
        }
        
        .bg-primary {
            background-color: #1a3a52 !important;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-5 fw-bold mb-3">Selamat Datang di Portal PPID PKTJ</h1>
                <p class="lead">Layanan Informasi Publik Terintegrasi dan Transparan</p>
                <div class="mt-4">
                    <a href="#informasi-publik" class="btn btn-warning btn-lg fw-bold px-4">
                        <i class="fas fa-search me-2"></i>CARI INFORMASI
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <section id="informasi-publik" class="mb-5">
            <h2 class="section-title">Informasi Publik</h2>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card h-100 p-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge me-2"><i class="fas fa-file-alt me-1"></i>Dokumen</span>
                            <small class="text-muted"><?php echo e($doc->kategori); ?></small>
                        </div>
                        <h6 class="fw-bold"><?php echo e($doc->nama_dokumen); ?></h6>
                        <a href="<?php echo e(asset('storage/'.$doc->file_path)); ?>" class="btn btn-outline-primary btn-sm mt-auto">
                            <i class="fas fa-eye me-1"></i>Lihat Selengkapnya
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">Belum ada dokumen publik yang diunggah.</div>
                <?php endif; ?>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="section-title">Artikel & Dokumentasi Kegiatan</h2>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?php echo e($item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/400x250'); ?>" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo e($item->judul); ?></h5>
                            <p class="card-text text-muted small"><?php echo e(Str::limit(strip_tags($item->konten), 120)); ?></p>
                            <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold" style="color: #d4af37;">
                                <i class="fas fa-arrow-right me-1"></i>Baca Berita
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center text-muted">Belum ada artikel kegiatan terbaru.</div>
                <?php endif; ?>
            </div>
        </section>

        <div class="row pt-4">
            <div class="col-md-8 mb-5">
                <h2 class="section-title">Video Layanan Informasi</h2>
                <div class="ratio ratio-16x9 card">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video Layanan" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <h2 class="section-title">Aplikasi Terkait</h2>
                <div class="list-group card p-0">
                    <a href="https://ppid.dephub.go.id" target="_blank" class="list-group-item list-group-item-action py-3 px-3">
                        <i class="fas fa-external-link-alt me-2" style="color: #d4af37;"></i>E-PPID Kemenhub
                    </a>
                    <a href="<?php echo e(route('admin.lpse.index')); ?>" class="list-group-item list-group-item-action py-3 px-3">
                        <i class="fas fa-link me-2" style="color: #d4af37;"></i>LPSE PKTJ
                    </a>
                    <a href="<?php echo e(route('admin.jdih.index')); ?>" class="list-group-item list-group-item-action py-3 px-3">
                        <i class="fas fa-link me-2" style="color: #d4af37;"></i>JDIH PKTJ
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-3 px-3">
                        <i class="fas fa-link me-2" style="color: #d4af37;"></i>Sistem Informasi PKTJ
                    </a>
                </div>
                <div class="mt-4 p-4 rounded-3 shadow" style="background-color: #1a3a52; color: white;">
                    <h6 class="mb-2"><i class="fas fa-info-circle me-2" style="color: #d4af37;"></i>PPID Pelaksana</h6>
                    <p class="small mb-0">Politeknik Keselamatan Transportasi Jalan Tegal</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get the parent dropdown
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    // Toggle display
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        // Hide all other dropdowns
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        
                        // Show current dropdown
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/welcome.blade.php ENDPATH**/ ?>