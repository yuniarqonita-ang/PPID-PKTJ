<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Akses Informasi Publik - Portal PPID PKTJ</title>
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

        .channel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .channel-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .channel-card .channel-icon {
            font-size: 24px;
            color: #d4af37;
            margin-bottom: 10px;
        }

        .channel-card .channel-name {
            font-weight: bold;
            color: #004a99;
            margin-bottom: 5px;
        }

        .channel-card .channel-count {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
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
                <h1 class="display-5 fw-bold mb-3">Laporan Akses Informasi Publik</h1>
                <p class="lead">Laporan statistik akses dan penggunaan informasi publik</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Laporan Akses Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Laporan Akses Informasi Publik PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan UU KIP</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Statistik Akses Tahun 2024</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">45,678</div>
                    <div class="stat-label">Total Kunjungan Website</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">12,345</div>
                    <div class="stat-label">Download Dokumen</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">8,901</div>
                    <div class="stat-label">Permintaan Informasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">156</div>
                    <div class="stat-label">Keberatan Diajukan</div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kanal Akses Informasi</h2>

            <div class="channel-grid">
                <div class="channel-card">
                    <div class="channel-icon"><i class="fas fa-globe"></i></div>
                    <div class="channel-name">Website</div>
                    <div class="channel-count">32,456</div>
                    <small class="text-muted">71.2% dari total akses</small>
                </div>
                <div class="channel-card">
                    <div class="channel-icon"><i class="fas fa-envelope"></i></div>
                    <div class="channel-name">Email</div>
                    <div class="channel-count">6,789</div>
                    <small class="text-muted">14.9% dari total akses</small>
                </div>
                <div class="channel-card">
                    <div class="channel-icon"><i class="fas fa-phone"></i></div>
                    <div class="channel-name">Telepon</div>
                    <div class="channel-count">3,456</div>
                    <small class="text-muted">7.6% dari total akses</small>
                </div>
                <div class="channel-card">
                    <div class="channel-icon"><i class="fas fa-building"></i></div>
                    <div class="channel-name">Datang Langsung</div>
                    <div class="channel-count">2,977</div>
                    <small class="text-muted">6.3% dari total akses</small>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Halaman Paling Banyak Dikunjungi</h2>

            <div class="report-card">
                <i class="fas fa-chart-bar"></i>
                <h5>Top 10 Halaman Website PPID PKTJ</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/004a99/white?text=Chart+Halaman+Populer" alt="Chart Halaman" class="img-fluid">
                    <p class="text-muted mt-2">Grafik halaman paling banyak dikunjungi tahun 2024</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Halaman</th>
                            <th>Kunjungan</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-warning">1</span></td>
                            <td>Beranda</td>
                            <td>18,234</td>
                            <td>40.0%</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-secondary">2</span></td>
                            <td>Daftar Informasi Publik</td>
                            <td>8,765</td>
                            <td>19.2%</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-dark">3</span></td>
                            <td>Maklumat Pelayanan</td>
                            <td>6,543</td>
                            <td>14.4%</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Informasi Berkala</td>
                            <td>4,321</td>
                            <td>9.5%</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>FAQ</td>
                            <td>3,456</td>
                            <td>7.6%</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Profil PPID</td>
                            <td>2,345</td>
                            <td>5.2%</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>SOP Permintaan Informasi</td>
                            <td>1,234</td>
                            <td>2.7%</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Kontak PPID</td>
                            <td>987</td>
                            <td>2.2%</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Regulasi</td>
                            <td>654</td>
                            <td>1.4%</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Laporan Layanan</td>
                            <td>543</td>
                            <td>1.2%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Demografi Pengunjung</h2>

            <div class="report-card">
                <i class="fas fa-users"></i>
                <h5>Distribusi Pengunjung Berdasarkan Kategori</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/28a745/white?text=Chart+Demografi" alt="Chart Demografi" class="img-fluid">
                    <p class="text-muted mt-2">Grafik demografi pengunjung website PPID PKTJ tahun 2024</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h5><i class="fas fa-user-tie text-primary me-2"></i>Kategori Pengunjung</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-circle text-info me-2" style="font-size: 8px;"></i>Mahasiswa/Pelajar: 35.2%</li>
                        <li><i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>Dosen/Peneliti: 28.7%</li>
                        <li><i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i>Umum/Masyarakat: 18.9%</li>
                        <li><i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i>Media/Jurnalis: 12.3%</li>
                        <li><i class="fas fa-circle text-secondary me-2" style="font-size: 8px;"></i>Lainnya: 4.9%</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-map-marker-alt text-warning me-2"></i>Asal Wilayah</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-circle text-primary me-2" style="font-size: 8px;"></i>Jakarta: 45.6%</li>
                        <li><i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>Jawa Barat: 18.3%</li>
                        <li><i class="fas fa-circle text-info me-2" style="font-size: 8px;"></i>Jawa Timur: 12.1%</li>
                        <li><i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i>Jawa Tengah: 9.8%</li>
                        <li><i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i>Lainnya: 14.2%</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Dokumen Paling Banyak Diunduh</h2>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Dokumen</th>
                            <th>Kategori</th>
                            <th>Download</th>
                            <th>Ukuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-warning">1</span></td>
                            <td>Maklumat Pelayanan PPID PKTJ 2024</td>
                            <td>Maklumat</td>
                            <td>2,345</td>
                            <td>2.1 MB</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-secondary">2</span></td>
                            <td>Formulir Permohonan Informasi Publik</td>
                            <td>Formulir</td>
                            <td>1,987</td>
                            <td>156 KB</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-dark">3</span></td>
                            <td>Daftar Informasi Publik Lengkap</td>
                            <td>Daftar</td>
                            <td>1,654</td>
                            <td>4.2 MB</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Laporan Tahunan PPID 2023</td>
                            <td>Laporan</td>
                            <td>1,234</td>
                            <td>8.7 MB</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Regulasi Keterbukaan Informasi Publik</td>
                            <td>Regulasi</td>
                            <td>987</td>
                            <td>1.8 MB</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Tren Akses Bulanan</h2>

            <div class="report-card">
                <i class="fas fa-chart-line"></i>
                <h5>Grafik Tren Kunjungan Website</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/d4af37/white?text=Chart+Tren+Bulanan" alt="Chart Tren" class="img-fluid">
                    <p class="text-muted mt-2">Grafik tren kunjungan website PPID PKTJ tahun 2024</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">Jan</div>
                    <div class="stat-label">3,456 Kunjungan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Feb</div>
                    <div class="stat-label">3,789 Kunjungan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Mar</div>
                    <div class="stat-label">4,123 Kunjungan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Apr</div>
                    <div class="stat-label">4,567 Kunjungan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Mei</div>
                    <div class="stat-label">5,234 Kunjungan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Jun</div>
                    <div class="stat-label">5,678 Kunjungan</div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Analisis dan Kesimpulan</h2>
            <div class="profil-content">
                <p>Berdasarkan data akses informasi publik tahun 2024, PPID PKTJ mencatat peningkatan signifikan dalam:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-chart-line text-success me-2"></i>Peningkatan Akses</h5>
                        <ul>
                            <li>Total kunjungan website meningkat 35% dari tahun sebelumnya</li>
                            <li>Permintaan informasi online meningkat 42%</li>
                            <li>Download dokumen meningkat 28%</li>
                            <li>Penggunaan kanal digital meningkat 55%</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-users text-info me-2"></i>Preferensi Pengunjung</h5>
                        <ul>
                            <li>Website sebagai kanal utama (71.2%)</li>
                            <li>Email sebagai kanal kedua (14.9%)</li>
                            <li>Daftar informasi publik paling diminati</li>
                            <li>Maklumat pelayanan sering diakses</li>
                        </ul>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <h6><i class="fas fa-lightbulb me-2"></i>Rekomendasi Pengembangan</h6>
                    <p>Berdasarkan analisis data akses, PPID PKTJ akan fokus pada pengembangan kanal digital, peningkatan konten informasi publik, dan optimalisasi layanan informasi untuk memenuhi kebutuhan masyarakat.</p>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Download Laporan Lengkap</h2>
            <div class="profil-content">
                <p>Untuk mendapatkan laporan lengkap dan detail data akses informasi publik PPID PKTJ, silakan download dokumen berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="fas fa-file-pdf text-danger me-3" style="font-size: 24px;"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Laporan Akses 2024</h6>
                                <small class="text-muted">PDF • 3.2 MB • 89 halaman</small>
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
                                <h6 class="mb-1">Data Akses 2024</h6>
                                <small class="text-muted">Excel • 2.1 MB • Dataset lengkap</small>
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
