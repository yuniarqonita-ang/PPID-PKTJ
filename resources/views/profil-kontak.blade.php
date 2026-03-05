<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak PPID - Portal PPID PKTJ</title>
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

        .contact-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            text-align: center;
        }

        .contact-card i {
            font-size: 48px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .contact-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .contact-info {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .btn-contact {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
            font-weight: 600;
            margin-top: 15px;
        }

        .btn-contact:hover {
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
                <h1 class="display-5 fw-bold mb-3">Kontak PPID</h1>
                <p class="lead">Pejabat Pengelola Informasi dan Dokumentasi</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Kontak PPID</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="content-box">
                    <h2 class="section-title">Informasi Kontak</h2>
                    <div class="contact-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Alamat Kantor</h5>
                        <div class="contact-info">
                            <strong>PPID PKTJ</strong><br>
                            Jl. Medan Merdeka Barat No. 8<br>
                            Jakarta Pusat 10110<br>
                            Indonesia
                        </div>
                    </div>

                    <div class="contact-card">
                        <i class="fas fa-phone"></i>
                        <h5>Telepon</h5>
                        <div class="contact-info">
                            <strong>Call Center:</strong> (021) 3847790<br>
                            <strong>Fax:</strong> (021) 3847791<br>
                            <strong>WhatsApp:</strong> +62 812-3456-7890
                        </div>
                    </div>

                    <div class="contact-card">
                        <i class="fas fa-envelope"></i>
                        <h5>Email</h5>
                        <div class="contact-info">
                            <strong>PPID:</strong> ppid@pktj.dephub.go.id<br>
                            <strong>Admin:</strong> admin@pktj.dephub.go.id<br>
                            <strong>Info:</strong> info@pktj.dephub.go.id
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="content-box">
                    <h2 class="section-title">Jam Kerja</h2>
                    <div class="profil-content">
                        <p>PPID PKTJ melayani permintaan informasi publik pada hari dan jam kerja sebagai berikut:</p>

                        <div class="mt-4">
                            <h5><i class="fas fa-clock text-primary me-2"></i>Jam Kerja</h5>
                            <ul class="list-unstyled">
                                <li><strong>Senin - Kamis:</strong> 08:00 - 16:00 WIB</li>
                                <li><strong>Jumat:</strong> 08:00 - 16:30 WIB</li>
                                <li><strong>Sabtu - Minggu:</strong> Libur</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h5><i class="fas fa-calendar-alt text-success me-2"></i>Hari Libur Nasional</h5>
                            <p>PPID PKTJ tutup pada hari libur nasional sesuai dengan kalender yang ditetapkan pemerintah.</p>
                        </div>
                    </div>
                </div>

                <div class="content-box">
                    <h2 class="section-title">Cara Menghubungi</h2>
                    <div class="profil-content">
                        <p>Untuk mendapatkan informasi lebih lanjut atau mengajukan permintaan informasi publik, dapat menghubungi PPID PKTJ melalui:</p>

                        <div class="mt-3">
                            <h6><i class="fas fa-phone text-primary me-2"></i>Telepon/Hotline</h6>
                            <p>Hubungi nomor telepon kami selama jam kerja untuk mendapatkan informasi langsung.</p>

                            <h6 class="mt-3"><i class="fas fa-envelope text-info me-2"></i>Email</h6>
                            <p>Kirim email dengan subject yang jelas dan lengkap untuk mempercepat penanganan.</p>

                            <h6 class="mt-3"><i class="fas fa-file-alt text-warning me-2"></i>Formulir Online</h6>
                            <p>Gunakan formulir permohonan informasi online yang tersedia di website ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Lokasi Kantor</h2>
            <div class="profil-content">
                <p>Kantor PPID PKTJ terletak di Gedung Direktorat Jenderal Perhubungan Udara, Jl. Medan Merdeka Barat No. 8, Jakarta Pusat. Lokasi ini mudah diakses dengan berbagai transportasi umum.</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-subway text-primary me-2"></i>Transportasi Umum</h5>
                        <ul>
                            <li>Stasiun Jakarta Kota (Jarak: 1,5 km)</li>
                            <li>Halte Bus TransJakarta (Jarak: 500 m)</li>
                            <li>Terminal Bus (Jarak: 2 km)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-car text-success me-2"></i>Parkir</h5>
                        <ul>
                            <li>Parkir umum tersedia di sekitar gedung</li>
                            <li>Parkir khusus untuk tamu PPID</li>
                            <li>Parkir motor dan mobil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Informasi Tambahan</h2>
            <div class="profil-content">
                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle me-2"></i>Pengaduan dan Saran</h6>
                    <p>Kritik, saran, dan pengaduan dapat disampaikan melalui email atau formulir yang tersedia. Kami berkomitmen untuk memberikan pelayanan yang terbaik.</p>
                </div>

                <div class="alert alert-warning mt-3">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Penting</h6>
                    <p>Dalam keadaan darurat atau di luar jam kerja, hubungi nomor darurat Kementerian Perhubungan: 112</p>
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
