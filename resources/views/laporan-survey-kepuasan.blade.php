<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Survey Kepuasan Layanan Informasi Publik - Portal PPID PKTJ</title>
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

        .survey-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .survey-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .survey-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .survey-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .rating-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .rating-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .rating-score {
            font-size: 24px;
            font-weight: bold;
            color: #004a99;
            margin-bottom: 5px;
        }

        .rating-label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .satisfaction-bar {
            background: #e9ecef;
            border-radius: 20px;
            height: 20px;
            margin: 10px 0;
            overflow: hidden;
        }

        .satisfaction-fill {
            height: 100%;
            border-radius: 20px;
            transition: width 0.3s ease;
        }

        .satisfaction-fill.excellent { background: #28a745; width: 85%; }
        .satisfaction-fill.good { background: #17a2b8; width: 70%; }
        .satisfaction-fill.fair { background: #ffc107; width: 55%; }
        .satisfaction-fill.poor { background: #dc3545; width: 25%; }

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

        .improvement-list {
            background: #f0f8ff;
            border: 2px solid #0066cc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .improvement-list h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .improvement-list ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .improvement-list ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #28a745;
            font-weight: bold;
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
                <h1 class="display-5 fw-bold mb-3">Laporan Survey Kepuasan</h1>
                <p class="lead">Hasil survei kepuasan pemohon informasi publik PPID PKTJ</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Laporan Survey Kepuasan Layanan Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Metodologi Survey</h2>
            <div class="profil-content">
                <p>Survey kepuasan layanan informasi publik PPID PKTJ tahun 2024 dilaksanakan dengan metodologi sebagai berikut:</p>
                <ul>
                    <li><strong>Jumlah Responden:</strong> 1.247 pemohon informasi yang telah mendapatkan pelayanan</li>
                    <li><strong>Periode Survey:</strong> Januari - Desember 2024</li>
                    <li><strong>Metode Pengumpulan Data:</strong> Online survey, telepon, dan wawancara langsung</li>
                    <li><strong>Skala Penilaian:</strong> 1-5 (1 = Sangat Tidak Puas, 5 = Sangat Puas)</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Indeks Kepuasan Keseluruhan</h2>
            <div class="rating-grid">
                <div class="rating-card">
                    <div class="rating-score">4.7</div>
                    <div class="rating-label">Indeks Kepuasan</div>
                    <div class="satisfaction-bar">
                        <div class="satisfaction-fill excellent"></div>
                    </div>
                    <small class="text-muted">Sangat Puas</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">94.2%</div>
                    <div class="rating-label">Tingkat Kepuasan</div>
                    <div class="satisfaction-bar">
                        <div class="satisfaction-fill excellent"></div>
                    </div>
                    <small class="text-muted">Puas & Sangat Puas</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">87.6%</div>
                    <div class="rating-label">Rekomendasi Layanan</div>
                    <div class="satisfaction-bar">
                        <div class="satisfaction-fill excellent"></div>
                    </div>
                    <small class="text-muted">Bersedia Merekomendasikan</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">4.2</div>
                    <div class="rating-label">Rata-rata Waktu Tunggu</div>
                    <div class="satisfaction-bar">
                        <div class="satisfaction-fill good"></div>
                    </div>
                    <small class="text-muted">Hari Kerja</small>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Penilaian Berdasarkan Aspek Layanan</h2>

            <div class="survey-card">
                <i class="fas fa-chart-pie"></i>
                <h5>Distribusi Penilaian Layanan</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/004a99/white?text=Chart+Aspek+Layanan" alt="Chart Aspek" class="img-fluid">
                    <p class="text-muted mt-2">Grafik penilaian berdasarkan aspek layanan tahun 2024</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Aspek Layanan</th>
                            <th>Nilai Rata-rata</th>
                            <th>Sangat Puas</th>
                            <th>Puas</th>
                            <th>Cukup</th>
                            <th>Kurang</th>
                            <th>Sangat Kurang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-clock text-primary me-2"></i>Kecepatan Pelayanan</td>
                            <td><strong>4.6</strong></td>
                            <td>68.5%</td>
                            <td>24.3%</td>
                            <td>5.7%</td>
                            <td>1.2%</td>
                            <td>0.3%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-tie text-success me-2"></i>Kompetensi Petugas</td>
                            <td><strong>4.8</strong></td>
                            <td>72.1%</td>
                            <td>22.4%</td>
                            <td>4.2%</td>
                            <td>1.0%</td>
                            <td>0.3%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-handshake text-warning me-2"></i>Keramahan Petugas</td>
                            <td><strong>4.7</strong></td>
                            <td>69.8%</td>
                            <td>23.7%</td>
                            <td>5.2%</td>
                            <td>1.1%</td>
                            <td>0.2%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-alt text-info me-2"></i>Kualitas Informasi</td>
                            <td><strong>4.5</strong></td>
                            <td>65.3%</td>
                            <td>25.8%</td>
                            <td>7.1%</td>
                            <td>1.5%</td>
                            <td>0.3%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-tools text-danger me-2"></i>Kemudahan Prosedur</td>
                            <td><strong>4.4</strong></td>
                            <td>62.7%</td>
                            <td>26.9%</td>
                            <td>8.1%</td>
                            <td>1.9%</td>
                            <td>0.4%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-globe text-secondary me-2"></i>Aksesibilitas Layanan</td>
                            <td><strong>4.3</strong></td>
                            <td>59.4%</td>
                            <td>28.6%</td>
                            <td>9.2%</td>
                            <td>2.4%</td>
                            <td>0.4%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Analisis Kepuasan Berdasarkan Kategori Pemohon</h2>

            <div class="survey-card">
                <i class="fas fa-users"></i>
                <h5>Kepuasan Berdasarkan Kategori Pemohon</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/28a745/white?text=Chart+Kategori+Pemohon" alt="Chart Kategori" class="img-fluid">
                    <p class="text-muted mt-2">Grafik kepuasan berdasarkan kategori pemohon tahun 2024</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kategori Pemohon</th>
                            <th>Jumlah Responden</th>
                            <th>Nilai Rata-rata</th>
                            <th>Tingkat Kepuasan</th>
                            <th>Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-user-graduate text-primary me-2"></i>Mahasiswa/Pelajar</td>
                            <td>423</td>
                            <td>4.8</td>
                            <td><span class="badge bg-success">96.2%</span></td>
                            <td>89.4%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-chalkboard-teacher text-success me-2"></i>Dosen/Peneliti</td>
                            <td>345</td>
                            <td>4.7</td>
                            <td><span class="badge bg-success">94.8%</span></td>
                            <td>87.2%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-users text-warning me-2"></i>Masyarakat Umum</td>
                            <td>289</td>
                            <td>4.6</td>
                            <td><span class="badge bg-success">92.7%</span></td>
                            <td>85.1%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-newspaper text-info me-2"></i>Media/Jurnalis</td>
                            <td>156</td>
                            <td>4.5</td>
                            <td><span class="badge bg-success">90.4%</span></td>
                            <td>82.7%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-building text-danger me-2"></i>Instansi Pemerintah</td>
                            <td>34</td>
                            <td>4.2</td>
                            <td><span class="badge bg-warning">85.3%</span></td>
                            <td>76.5%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Saran dan Masukan Pemohon</h2>
            <div class="profil-content">
                <p>Berdasarkan hasil survey, berikut adalah saran dan masukan dari pemohon informasi yang perlu menjadi perhatian PPID:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-thumbs-up text-success me-2"></i>Hal Positif yang Dihargai</h5>
                        <ul>
                            <li>Responsivitas petugas dalam memberikan pelayanan</li>
                            <li>Kemudahan akses informasi melalui website</li>
                            <li>Kompetensi petugas dalam menjelaskan informasi</li>
                            <li>Kerapian dan kejelasan dokumen yang diberikan</li>
                            <li>Fasilitas yang memadai untuk pelayanan langsung</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-lightbulb text-warning me-2"></i>Saran Perbaikan</h5>
                        <ul>
                            <li>Perluasan jam layanan untuk hari Sabtu</li>
                            <li>Penambahan kanal komunikasi WhatsApp</li>
                            <li>Peningkatan kecepatan respon email</li>
                            <li>Penambahan informasi dalam berbagai bahasa</li>
                            <li>Pengembangan aplikasi mobile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Tren Kepuasan Tahunan</h2>

            <div class="survey-card">
                <i class="fas fa-chart-line"></i>
                <h5>Perkembangan Indeks Kepuasan 2020-2024</h5>
                <div class="chart-container">
                    <img src="https://via.placeholder.com/600x300/d4af37/white?text=Chart+Tren+Tahunan" alt="Chart Tren" class="img-fluid">
                    <p class="text-muted mt-2">Grafik tren kepuasan layanan informasi publik 2020-2024</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="rating-card">
                    <div class="rating-score">2020</div>
                    <div class="rating-label">3.8</div>
                    <small class="text-muted">Baseline</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">2021</div>
                    <div class="rating-label">4.1</div>
                    <small class="text-muted">+8.2%</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">2022</div>
                    <div class="rating-label">4.3</div>
                    <small class="text-muted">+4.9%</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">2023</div>
                    <div class="rating-label">4.5</div>
                    <small class="text-muted">+4.7%</small>
                </div>
                <div class="rating-card">
                    <div class="rating-score">2024</div>
                    <div class="rating-label">4.7</div>
                    <small class="text-muted">+4.4%</small>
                </div>
            </div>
        </div>

        <div class="improvement-list">
            <h6><i class="fas fa-target me-2"></i>Inisiatif Perbaikan Layanan 2025</h6>
            <ul>
                <li>Meningkatkan kecepatan respon melalui implementasi sistem manajemen antrian online</li>
                <li>Mengembangkan aplikasi mobile untuk kemudahan akses informasi</li>
                <li>Memperluas jam operasional layanan informasi</li>
                <li>Meningkatkan kompetensi petugas melalui pelatihan berkala</li>
                <li>Mengembangkan sistem feedback real-time untuk perbaikan berkelanjutan</li>
                <li>Memperluas kanal komunikasi digital (WhatsApp, chat online)</li>
                <li>Meningkatkan kualitas dan kuantitas informasi yang disediakan</li>
                <li>Mengembangkan sistem monitoring dan evaluasi layanan</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Download Laporan Lengkap</h2>
            <div class="profil-content">
                <p>Untuk mendapatkan laporan lengkap hasil survey kepuasan layanan informasi publik PPID PKTJ, silakan download dokumen berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="fas fa-file-pdf text-danger me-3" style="font-size: 24px;"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Laporan Survey 2024</h6>
                                <small class="text-muted">PDF • 4.1 MB • 124 halaman</small>
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
                                <h6 class="mb-1">Data Survey 2024</h6>
                                <small class="text-muted">Excel • 2.8 MB • Dataset lengkap</small>
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
