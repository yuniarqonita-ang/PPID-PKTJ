<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Setiap Saat - Portal PPID PKTJ</title>
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

        .always-info-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .always-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .always-info-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .always-info-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .info-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .info-item h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-item ul li {
            margin-bottom: 5px;
            color: #666;
        }

        .search-section {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 40px 0;
            text-align: center;
            margin: 30px 0;
        }

        .search-box {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 12px 25px;
            color: white;
            width: 100%;
            max-width: 500px;
        }

        .search-box::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .btn-search {
            background: #d4af37;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            color: white;
            font-weight: bold;
        }

        .btn-search:hover {
            background: #c99a2b;
            transform: scale(1.05);
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
                <h1 class="display-5 fw-bold mb-3">Informasi Setiap Saat</h1>
                <p class="lead">Informasi yang dapat diakses setiap saat tanpa batas waktu</p>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <h3 class="mb-4">Cari Informasi</h3>
            <form class="d-flex justify-content-center">
                <input class="form-control search-box me-2" type="search" placeholder="Ketik kata kunci informasi yang dicari...">
                <button class="btn btn-search" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Informasi Setiap Saat</h1>

        <div class="content-box">
            <h2 class="section-title">Pengertian Informasi Setiap Saat</h2>
            <div class="profil-content">
                <p><strong>Informasi Setiap Saat</strong> adalah informasi publik yang dapat diakses oleh pemohon informasi setiap saat tanpa batasan waktu dan dapat diperoleh melalui berbagai kanal komunikasi. Informasi ini bersifat umum dan tidak memerlukan proses pengolahan khusus.</p>

                <p>Informasi setiap saat meliputi maklumat pelayanan, daftar informasi publik, serta informasi lainnya yang wajib disediakan oleh badan publik berdasarkan peraturan perundang-undangan.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="always-info-card text-center">
                    <i class="fas fa-file-contract"></i>
                    <h5>Maklumat Pelayanan</h5>
                    <p>Informasi tentang prosedur, waktu, dan biaya pelayanan informasi publik yang disediakan PPID.</p>
                    <a href="/layanan-informasi/maklumat" class="btn btn-warning btn-sm">Lihat Detail</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="always-info-card text-center">
                    <i class="fas fa-list-alt"></i>
                    <h5>Daftar Informasi Publik</h5>
                    <p>Katalog lengkap informasi yang tersedia dan dapat diakses oleh masyarakat.</p>
                    <a href="/layanan-informasi/daftar" class="btn btn-warning btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="always-info-card text-center">
                    <i class="fas fa-gavel"></i>
                    <h5>Regulasi PPID</h5>
                    <p>Peraturan perundang-undangan yang menjadi dasar hukum pelaksanaan keterbukaan informasi publik.</p>
                    <a href="/profil/regulasi" class="btn btn-warning btn-sm">Lihat Detail</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="always-info-card text-center">
                    <i class="fas fa-question-circle"></i>
                    <h5>FAQ PPID</h5>
                    <p>Pertanyaan yang sering diajukan beserta jawabannya tentang layanan informasi publik.</p>
                    <a href="/faq" class="btn btn-warning btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kategori Informasi Setiap Saat</h2>
            <div class="info-grid">
                <div class="info-item">
                    <h6><i class="fas fa-user-tie text-primary me-2"></i>Profil Badan Publik</h6>
                    <ul>
                        <li>Visi dan misi organisasi</li>
                        <li>Struktur organisasi</li>
                        <li>Tugas pokok dan fungsi</li>
                        <li>Program kerja</li>
                        <li>Profil pejabat</li>
                    </ul>
                </div>

                <div class="info-item">
                    <h6><i class="fas fa-cogs text-success me-2"></i>Pelayanan Informasi</h6>
                    <ul>
                        <li>Maklumat pelayanan</li>
                        <li>Prosedur permintaan informasi</li>
                        <li>Standar biaya pelayanan</li>
                        <li>Jangka waktu penyelesaian</li>
                        <li>Formulir permohonan</li>
                    </ul>
                </div>

                <div class="info-item">
                    <h6><i class="fas fa-gavel text-warning me-2"></i>Regulasi dan Kebijakan</h6>
                    <ul>
                        <li>Undang-Undang KIP</li>
                        <li>Peraturan pemerintah</li>
                        <li>Peraturan menteri</li>
                        <li>Kebijakan internal</li>
                        <li>Standar operasional</li>
                    </ul>
                </div>

                <div class="info-item">
                    <h6><i class="fas fa-chart-line text-info me-2"></i>Laporan dan Statistik</h6>
                    <ul>
                        <li>Laporan tahunan kegiatan</li>
                        <li>Laporan keuangan</li>
                        <li>Statistik permintaan informasi</li>
                        <li>Laporan kinerja PPID</li>
                        <li>Hasil survei kepuasan</li>
                    </ul>
                </div>

                <div class="info-item">
                    <h6><i class="fas fa-users text-danger me-2"></i>Informasi Umum</h6>
                    <ul>
                        <li>Kontak PPID</li>
                        <li>Jam kerja kantor</li>
                        <li>Lokasi kantor</li>
                        <li>FAQ layanan informasi</li>
                        <li>Pengumuman penting</li>
                    </ul>
                </div>

                <div class="info-item">
                    <h6><i class="fas fa-file-alt text-secondary me-2"></i>Dokumentasi Publik</h6>
                    <ul>
                        <li>Perjanjian kerja sama</li>
                        <li>Hasil kajian dan penelitian</li>
                        <li>Data statistik publik</li>
                        <li>Laporan audit</li>
                        <li>Dokumen resmi lainnya</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Cara Mengakses Informasi Setiap Saat</h2>
            <div class="profil-content">
                <p>Informasi setiap saat dapat diakses melalui berbagai kanal yang telah disediakan oleh PPID PKTJ:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Media Online</h5>
                        <ul>
                            <li>Website resmi PPID PKTJ</li>
                            <li>Portal data terbuka</li>
                            <li>Media sosial resmi</li>
                            <li>Download center dokumen</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-building text-success me-2"></i>Akses Langsung</h5>
                        <ul>
                            <li>Datang langsung ke kantor PPID</li>
                            <li>Melalui layanan hotline</li>
                            <li>Email ke alamat resmi PPID</li>
                            <li>Pos atau kurir resmi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Komitmen PPID</h2>
            <div class="profil-content">
                <p>PPID PKTJ berkomitmen untuk:</p>
                <ul>
                    <li>Menyediakan informasi setiap saat sesuai dengan ketentuan yang berlaku</li>
                    <li>Memastikan informasi yang disediakan akurat, mutakhir, dan dapat dipertanggungjawabkan</li>
                    <li>Memperbaharui informasi secara berkala sesuai dengan perkembangan kebutuhan</li>
                    <li>Menyediakan berbagai kanal akses informasi untuk memudahkan masyarakat</li>
                    <li>Menjaga kerahasiaan informasi yang dikecualikan dari keterbukaan</li>
                    <li>Meningkatkan kualitas pelayanan informasi publik secara berkelanjutan</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Permintaan Informasi Tambahan</h2>
            <div class="profil-content">
                <p>Jika informasi yang Anda cari tidak tersedia dalam kategori informasi setiap saat, Anda dapat mengajukan permintaan informasi khusus melalui:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-file-alt me-2"></i>Formulir Online</h6>
                            <p>Gunakan formulir permohonan informasi yang tersedia di website ini untuk mengajukan permintaan informasi tambahan.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="fas fa-phone me-2"></i>Hotline PPID</h6>
                            <p>Hubungi hotline PPID untuk mendapatkan informasi awal atau bantuan dalam mengajukan permintaan informasi.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/permohonan-informasi" class="btn btn-warning btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Ajukan Permintaan Informasi
                    </a>
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
