<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi PPID - Portal PPID PKTJ</title>
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
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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

        .regulation-list {
            list-style: none;
            padding: 0;
        }

        .regulation-list li {
            background: #f8f9fa;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
        }

        .regulation-list li:hover {
            background: #fff3e0;
        }

        .regulation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .regulation-info h6 {
            margin: 0;
            color: #004a99;
            font-weight: bold;
        }

        .regulation-info small {
            color: #666;
        }

        .btn-download {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
            font-weight: 600;
        }

        .btn-download:hover {
            background-color: #c9a227;
            border-color: #c9a227;
            color: #1a3a52;
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
                <img src="/images/logo-pktj.png" alt="Logo PKTJ">
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
                <h1 class="display-5 fw-bold mb-3">Regulasi PPID</h1>
                <p class="lead">Pejabat Pengelola Informasi dan Dokumentasi</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Regulasi PPID</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum PPID</h2>
            <div class="profil-content">
                <p>PPID PKTJ dalam melaksanakan tugas dan fungsinya berpedoman pada peraturan perundang-undangan sebagai berikut:</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Peraturan Perundang-undangan</h2>
            <ul class="regulation-list">
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Undang-Undang Nomor 14 Tahun 2008</h6>
                            <small>Tentang Keterbukaan Informasi Publik</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Peraturan Pemerintah Nomor 61 Tahun 2010</h6>
                            <small>Tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Peraturan Menteri Perhubungan Nomor PM 123 Tahun 2017</h6>
                            <small>Tentang Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Keputusan Menteri Perhubungan Nomor KM 234 Tahun 2018</h6>
                            <small>Tentang Pembentukan PPID di Lingkungan Kementerian Perhubungan</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018</h6>
                            <small>Tentang Struktur Organisasi PPID PKTJ</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
                <li>
                    <div class="regulation-item">
                        <div class="regulation-info">
                            <h6>Peraturan Komisi Informasi Nomor 1 Tahun 2021</h6>
                            <small>Tentang Standar Layanan Informasi Publik</small>
                        </div>
                        <a href="#" class="btn btn-download btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Keputusan Internal</h2>
            <div class="profil-content">
                <p>Selain peraturan perundang-undangan di atas, PPID PKTJ juga berpedoman pada keputusan internal sebagai berikut:</p>
                <ul class="regulation-list">
                    <li>
                        <div class="regulation-item">
                            <div class="regulation-info">
                                <h6>Surat Keputusan Direktur PKTJ Nomor SK.001/DIR-PKTJ/2024</h6>
                                <small>Tentang Pembentukan Tim PPID PKTJ</small>
                            </div>
                            <a href="#" class="btn btn-download btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="regulation-item">
                            <div class="regulation-info">
                                <h6>Surat Keputusan Direktur PKTJ Nomor SK.002/DIR-PKTJ/2024</h6>
                                <small>Tentang SOP Pengelolaan Informasi Publik</small>
                            </div>
                            <a href="#" class="btn btn-download btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="regulation-item">
                            <div class="regulation-info">
                                <h6>Surat Keputusan Direktur PKTJ Nomor SK.003/DIR-PKTJ/2024</h6>
                                <small>Tentang Klasifikasi Informasi Publik</small>
                            </div>
                            <a href="#" class="btn btn-download btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Panduan dan Petunjuk Teknis</h2>
            <div class="profil-content">
                <p>Untuk memudahkan pelaksanaan tugas, PPID PKTJ menggunakan panduan dan petunjuk teknis sebagai berikut:</p>
                <ul class="regulation-list">
                    <li>
                        <div class="regulation-item">
                            <div class="regulation-info">
                                <h6>Buku Panduan Pengelolaan Informasi Publik</h6>
                                <small>Diterbitkan oleh Komisi Informasi Pusat</small>
                            </div>
                            <a href="#" class="btn btn-download btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="regulation-item">
                            <div class="regulation-info">
                                <h6>Petunjuk Teknis Klasifikasi Informasi</h6>
                                <small>Diterbitkan oleh Kementerian PANRB</small>
                            </div>
                            <a href="#" class="btn btn-download btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Informasi Tambahan</h2>
            <div class="profil-content">
                <p>Untuk mendapatkan dokumen regulasi yang lebih lengkap atau informasi terkini tentang peraturan perundang-undangan di bidang keterbukaan informasi publik, dapat menghubungi:</p>
                <div class="alert alert-info mt-3">
                    <h6><i class="fas fa-info-circle me-2"></i>Kontak PPID</h6>
                    <p class="mb-1"><strong>Email:</strong> ppid@pktj.dephub.go.id</p>
                    <p class="mb-1"><strong>Telepon:</strong> (021) 3847790</p>
                    <p class="mb-0"><strong>Alamat:</strong> Jl. Medan Merdeka Barat No. 8, Jakarta Pusat</p>
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
                <p class="mb-0">Dikembangkan dengan â¤ï¸ untuk kemudahan akses informasi publik</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
