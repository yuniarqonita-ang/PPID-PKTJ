<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Layanan Informasi Publik - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #004a99 !important;
            border-bottom: 3px solid #ffc107;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 12px;
        }

        @media (min-width: 992px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block !important;
                margin-top: 0;
            }
        }

        .dropdown-menu {
            z-index: 1050 !important;
        }

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
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }

        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #004a99;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .profil-content {
            text-align: justify;
            line-height: 1.8;
            color: #333;
        }

        .report-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .report-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .report-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #004a99;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .table-responsive {
            margin: 20px 0;
        }

        .table th {
            background-color: #004a99;
            color: white;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
        }

        .table td {
            border: none;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .download-btn {
            background: #d4af37;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .download-btn:hover {
            background: #c99a2b;
            transform: scale(1.05);
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #e9ecef;
        }

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
            background: #d4af37;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 40px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -23px;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #d4af37;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #d4af37;
        }

        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
        }

        .footer {
            background: #1a3a52;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold me-4 d-flex align-items-center" href="/">
                <img src="images/logo-pktj.png" alt="Logo PKTJ">
                <span>PPID PKTJ</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-white px-3 fw-bold uppercase" href="/">BERANDA</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">PROFIL PPID</a>
                        <ul class="dropdown-menu" style="min-width: 280px;">
                            <li><a class="dropdown-item" href="/profil/ppid">Profil PPID</a></li>
                            <li><a class="dropdown-item" href="/profil/tugas-tanggung-jawab">Tugas dan Tanggung Jawab PPID</a></li>
                            <li><a class="dropdown-item" href="/profil/visi-misi">Visi dan Misi</a></li>
                            <li><a class="dropdown-item" href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="/profil/regulasi">Regulasi</a></li>
                            <li><a class="dropdown-item" href="/profil/kontak">Kontak</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">INFORMASI PUBLIK</a>
                        <ul class="dropdown-menu" style="min-width: 250px;">
                            <li><a class="dropdown-item" href="/informasi-publik/berkala">Informasi Berkala</a></li>
                            <li><a class="dropdown-item" href="/informasi-publik/serta-merta">Informasi Serta Merta</a></li>
                            <li><a class="dropdown-item" href="/informasi-publik/setiap-saat">Informasi Setiap Saat</a></li>
                            <li><a class="dropdown-item" href="/informasi-publik/dikecualikan">Informasi Dikecualikan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">LAYANAN INFORMASI</a>
                        <ul class="dropdown-menu" style="min-width: 320px;">
                            <li><a class="dropdown-item" href="/layanan-informasi/daftar">Daftar Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/layanan-informasi/maklumat">Maklumat Pelayanan & Standar Biaya</a></li>
                            <li><a class="dropdown-item" href="/layanan-informasi/laporan">Laporan Layanan Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/layanan-informasi/laporan-akses">Laporan Akses Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/layanan-informasi/laporan-survey">Laporan Survey Kepuasan Layanan Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="#">JDIH Kementerian Perhubungan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">PROSEDUR</a>
                        <ul class="dropdown-menu" style="min-width: 380px;">
                            <li><a class="dropdown-item" href="/prosedur/sop-permintaan-informasi">SOP Permintaan Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/prosedur/sop-penanganan-keberatan">SOP Penanganan Keberatan</a></li>
                            <li><a class="dropdown-item" href="/prosedur/sop-pengajuan-sengketa">SOP Pengajuan Sengketa Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/prosedur/sop-penetapan-pemutakhiran">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</a></li>
                            <li><a class="dropdown-item" href="/prosedur/sop-pengujian-konsekuensi">SOP Pengujian Konsekuensi</a></li>
                            <li><a class="dropdown-item" href="/prosedur/sop-pendokumentasian">SOP Pendokumentasian Informasi Publik</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white px-3 fw-bold uppercase" href="/faq">FAQ</a>
                    </li>
                </ul>

                <a class="btn btn-warning fw-bold px-4 py-2 text-dark rounded-1 shadow-sm" href="/permohonan-informasi">
                    PERMOHONAN INFORMASI
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3">Laporan Layanan Informasi Publik</h1>
                <p class="lead">Laporan kinerja PPID dalam melayani permintaan informasi publik</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Laporan Layanan Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Laporan Layanan Informasi Publik PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Statistik Layanan Tahun 2024</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">1,247</div>
                    <div class="stat-label">Total Permintaan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">98.5%</div>
                    <div class="stat-label">Tingkat Pemenuhan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4.2</div>
                    <div class="stat-label">Rata-rata Waktu (hari)</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4.7/5</div>
                    <div class="stat-label">Indeks Kepuasan</div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kategori Permintaan Informasi</h2>

            <div class="report-card">
                <i class="fas fa-chart-pie"></i>
                <h5>Distribusi Permintaan Berdasarkan Kategori</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/004a99/white?text=Chart+Kategori+Permintaan" alt="Chart Kategori" class="img-fluid">
                    <p class="text-muted mt-2">Grafik distribusi permintaan informasi berdasarkan kategori tahun 2024</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Jumlah Permintaan</th>
                            <th>Persentase</th>
                            <th>Status Pemenuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-building text-primary me-2"></i>Profil Organisasi</td>
                            <td>342</td>
                            <td>27.4%</td>
                            <td><span class="badge bg-success">100%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-contract text-success me-2"></i>Regulasi & Kebijakan</td>
                            <td>298</td>
                            <td>23.9%</td>
                            <td><span class="badge bg-success">98%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-chart-line text-warning me-2"></i>Data & Statistik</td>
                            <td>234</td>
                            <td>18.8%</td>
                            <td><span class="badge bg-success">97%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-users text-info me-2"></i>Layanan Publik</td>
                            <td>187</td>
                            <td>15.0%</td>
                            <td><span class="badge bg-success">99%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-gavel text-danger me-2"></i>Pengadaan & Kontrak</td>
                            <td>156</td>
                            <td>12.5%</td>
                            <td><span class="badge bg-warning">95%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-shield-alt text-secondary me-2"></i>Lainnya</td>
                            <td>30</td>
                            <td>2.4%</td>
                            <td><span class="badge bg-success">100%</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kinerja Layanan</h2>

            <div class="report-card">
                <i class="fas fa-clock"></i>
                <h5>Waktu Penyelesaian Permintaan</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/d4af37/white?text=Chart+Waktu+Penyelesaian" alt="Chart Waktu" class="img-fluid">
                    <p class="text-muted mt-2">Grafik waktu penyelesaian permintaan informasi tahun 2024</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5><i class="fas fa-check-circle text-success me-2"></i>Permintaan Diselesaikan</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Informasi tersedia langsung: 876 (70.2%)</li>
                        <li><i class="fas fa-check text-success me-2"></i>Informasi perlu penyiapan: 312 (25.0%)</li>
                        <li><i class="fas fa-check text-success me-2"></i>Permintaan ditolak: 59 (4.7%)</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-clock text-warning me-2"></i>Rata-rata Waktu Penyelesaian</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-clock text-info me-2"></i>Informasi tersedia: 1.2 hari</li>
                        <li><i class="fas fa-clock text-warning me-2"></i>Informasi penyiapan: 8.7 hari</li>
                        <li><i class="fas fa-clock text-danger me-2"></i>Penolakan: 2.1 hari</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kepuasan Pemohon</h2>

            <div class="report-card">
                <i class="fas fa-star"></i>
                <h5>Indeks Kepuasan Layanan</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/28a745/white?text=Chart+Kepuasan" alt="Chart Kepuasan" class="img-fluid">
                    <p class="text-muted mt-2">Grafik indeks kepuasan pemohon informasi tahun 2024</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">4.7</div>
                    <div class="stat-label">Kualitas Informasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4.5</div>
                    <div class="stat-label">Kecepatan Layanan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4.8</div>
                    <div class="stat-label">Keramahan Petugas</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">4.6</div>
                    <div class="stat-label">Kemudahan Akses</div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengaduan dan Keberatan</h2>

            <div class="report-card">
                <i class="fas fa-exclamation-triangle"></i>
                <h5>Statistik Pengaduan</h5>
                <p>Total pengaduan yang diterima PPID PKTJ tahun 2024</p>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Pengaduan</th>
                            <th>Jumlah</th>
                            <th>Persentase</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-clock text-warning me-2"></i>Keterlambatan Penyelesaian</td>
                            <td>23</td>
                            <td>45.1%</td>
                            <td><span class="badge bg-success">Diselesaikan</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-times-circle text-danger me-2"></i>Penolakan Permintaan</td>
                            <td>15</td>
                            <td>29.4%</td>
                            <td><span class="badge bg-success">Diselesaikan</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-tie text-info me-2"></i>Pelayanan Petugas</td>
                            <td>8</td>
                            <td>15.7%</td>
                            <td><span class="badge bg-success">Diselesaikan</span></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt text-secondary me-2"></i>Kualitas Informasi</td>
                            <td>5</td>
                            <td>9.8%</td>
                            <td><span class="badge bg-success">Diselesaikan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Inisiatif Peningkatan Layanan</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Januari 2024</h6>
                        <p>Peluncuran sistem permohonan informasi online untuk mempercepat proses pengajuan dan tracking status permintaan.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Maret 2024</h6>
                        <p>Peningkatan kapasitas petugas PPID melalui pelatihan keterampilan komunikasi dan manajemen informasi publik.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Juni 2024</h6>
                        <p>Pengembangan portal data terbuka untuk memudahkan akses informasi publik yang sering diminta.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">September 2024</h6>
                        <p>Implementasi sistem survey kepuasan otomatis untuk mendapatkan feedback langsung dari pemohon informasi.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">November 2024</h6>
                        <p>Optimalisasi kanal komunikasi dengan penambahan layanan WhatsApp Business untuk respons cepat.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Download Laporan Lengkap</h2>
            <div class="profil-content">
                <p>Untuk mendapatkan laporan lengkap dan detail statistik layanan informasi publik PPID PKTJ, silakan download dokumen berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="fas fa-file-pdf text-danger me-3" style="font-size: 24px;"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Laporan Tahunan 2024</h6>
                                <small class="text-muted">PDF • 2.4 MB • 145 halaman</small>
                            </div>
                            <button class="download-btn">
                                <i class="fas fa-download me-1"></i>Download
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="fas fa-file-excel text-success me-3" style="font-size: 24px;"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Data Statistik 2024</h6>
                                <small class="text-muted">Excel • 1.8 MB • Dataset lengkap</small>
                            </div>
                            <button class="download-btn">
                                <i class="fas fa-download me-1"></i>Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">PPID PKTJ</h5>
                    <p>Pejabat Pengelola Informasi dan Dokumentasi</p>
                    <p>Menyediakan layanan informasi publik yang transparan dan akuntabel sesuai peraturan perundang-undangan.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Kontak</h5>
            <p><i class="fas fa-map-marker-alt me-2"></i>Alamat: [Alamat Lengkap]</p>
            <p><i class="fas fa-phone me-2"></i>Telepon: [Nomor Telepon]</p>
            <p><i class="fas fa-envelope me-2"></i>Email: info@pktj.ac.id</p>
        </div>
    </div>
    <hr class="my-4 bg-light">
    <div class="text-center">
        <p class="mb-0">&copy; 2026 PPID PKTJ. All rights reserved.</p>
        <p class="mb-0">Dikembangkan dengan ❤️ untuk kemudahan akses informasi publik</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
