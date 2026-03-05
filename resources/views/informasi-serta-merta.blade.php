<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Serta Merta - Portal PPID PKTJ</title>
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

        .urgent-info-card {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .urgent-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
        }

        .urgent-info-card i {
            font-size: 36px;
            color: #856404;
            margin-bottom: 15px;
        }

        .urgent-info-card h5 {
            color: #856404;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-badge {
            position: absolute;
            top: -10px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
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

        .criteria-list {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .criteria-list h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .criteria-list ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .criteria-list ul li::before {
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
                <h1 class="display-5 fw-bold mb-3">Informasi Serta Merta</h1>
                <p class="lead">Informasi yang berkaitan dengan hajat hidup orang banyak</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Informasi Serta Merta</h1>

        <div class="content-box">
            <h2 class="section-title">Pengertian Informasi Serta Merta</h2>
            <div class="profil-content">
                <p><strong>Informasi Serta Merta</strong> adalah informasi yang berkaitan dengan hajat hidup orang banyak dan wajib diumumkan serta disebarluaskan secara cepat melalui berbagai kanal komunikasi. Informasi ini memiliki karakteristik mendesak dan berdampak luas terhadap masyarakat.</p>

                <p>Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik dan peraturan pelaksanaannya, PPID wajib mengumumkan informasi serta merta dalam waktu maksimal 2 x 24 jam sejak informasi tersebut diketahui.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kriteria Informasi Serta Merta</h2>
            <div class="criteria-list">
                <h6><i class="fas fa-list-check me-2"></i>Informasi yang termasuk kategori serta merta:</h6>
                <ul>
                    <li>Informasi tentang bencana alam, epidemi, wabah penyakit</li>
                    <li>Informasi tentang keamanan, ketertiban, dan ketenteraman masyarakat</li>
                    <li>Informasi tentang kebijakan yang berdampak langsung pada hajat hidup orang banyak</li>
                    <li>Informasi tentang kegiatan yang dapat membahayakan keselamatan masyarakat</li>
                    <li>Informasi tentang hasil pengujian produk yang berdampak pada kesehatan masyarakat</li>
                    <li>Informasi tentang pelanggaran hukum yang berdampak luas</li>
                    <li>Informasi tentang perubahan kebijakan yang mendesak</li>
                    <li>Informasi tentang kondisi darurat lainnya yang perlu diketahui masyarakat</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Contoh Informasi Serta Merta</h2>

            <div class="urgent-info-card">
                <div class="info-badge">DARURAT</div>
                <i class="fas fa-exclamation-triangle"></i>
                <h5>Bencana Alam</h5>
                <p>Informasi tentang gempa bumi, tsunami, banjir, tanah longsor, kebakaran hutan, dan bencana alam lainnya yang mengancam keselamatan masyarakat.</p>
            </div>

            <div class="urgent-info-card">
                <div class="info-badge">KESEHATAN</div>
                <i class="fas fa-virus"></i>
                <h5>Wabah Penyakit</h5>
                <p>Informasi tentang penyebaran penyakit menular, epidemi, pandemi, dan informasi kesehatan masyarakat yang bersifat mendesak.</p>
            </div>

            <div class="urgent-info-card">
                <div class="info-badge">KEAMANAN</div>
                <i class="fas fa-shield-alt"></i>
                <h5>Keamanan Publik</h5>
                <p>Informasi tentang gangguan keamanan, terorisme, kerusuhan, dan situasi yang membahayakan ketertiban masyarakat.</p>
            </div>

            <div class="urgent-info-card">
                <div class="info-badge">KEBIJAKAN</div>
                <i class="fas fa-gavel"></i>
                <h5>Perubahan Kebijakan Mendesak</h5>
                <p>Informasi tentang perubahan kebijakan yang berdampak langsung pada hajat hidup orang banyak dalam waktu singkat.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Prosedur Pengumuman Informasi Serta Merta</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">1. Penerimaan Informasi</h6>
                        <p>PPID menerima informasi serta merta dari unit kerja terkait atau sumber resmi lainnya. Informasi diverifikasi kebenarannya.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">2. Klasifikasi Informasi</h6>
                        <p>PPID melakukan klasifikasi informasi untuk memastikan bahwa informasi tersebut termasuk kategori serta merta.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">3. Penyusunan Pengumuman</h6>
                        <p>PPID menyusun pengumuman informasi yang jelas, akurat, dan tidak menyesatkan dalam berbagai format.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">4. Penyebarluasan Informasi</h6>
                        <p>Informasi disebarluaskan melalui berbagai kanal komunikasi dalam waktu maksimal 2 x 24 jam.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">5. Dokumentasi</h6>
                        <p>PPID mendokumentasikan seluruh proses pengumuman informasi serta merta untuk pelaporan dan audit.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kanal Penyebarluasan</h2>
            <div class="profil-content">
                <p>Informasi serta merta disebarluaskan melalui berbagai kanal untuk memastikan informasi dapat diterima oleh masyarakat secara cepat dan luas:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Media Online</h5>
                        <ul>
                            <li>Website PPID PKTJ</li>
                            <li>Media sosial resmi</li>
                            <li>Portal berita online</li>
                            <li>Aplikasi mobile</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-bullhorn text-warning me-2"></i>Media Tradisional</h5>
                        <ul>
                            <li>Televisi</li>
                            <li>Radio</li>
                            <li>Surat kabar</li>
                            <li>Spanduk/banner</li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-phone text-success me-2"></i>Komunikasi Langsung</h5>
                        <ul>
                            <li>Hotline PPID</li>
                            <li>Pengumuman di tempat umum</li>
                            <li>Koordinasi dengan instansi terkait</li>
                            <li>Surat edaran resmi</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-users text-info me-2"></i>Jaringan Sosial</h5>
                        <ul>
                            <li>WhatsApp group</li>
                            <li>Telegram channel</li>
                            <li>Email blast</li>
                            <li>SMS broadcast</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Tanggung Jawab PPID</h2>
            <div class="profil-content">
                <p>Dalam penanganan informasi serta merta, PPID bertanggung jawab untuk:</p>
                <ul>
                    <li>Menyediakan informasi yang akurat dan dapat dipertanggungjawabkan</li>
                    <li>Menyebarluaskan informasi secara cepat dan tepat sasaran</li>
                    <li>Melindungi kerahasiaan informasi yang dikecualikan</li>
                    <li>Mengkoordinasikan dengan instansi terkait dalam penanganan informasi</li>
                    <li>Mendokumentasikan seluruh proses penanganan informasi</li>
                    <li>Melaporkan pelaksanaan penyebarluasan informasi kepada pimpinan</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kontak Darurat</h2>
            <div class="profil-content">
                <p>Untuk informasi darurat atau melaporkan kejadian yang memerlukan penanganan segera, hubungi:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-phone-volume me-2"></i>Hotline PPID</h6>
                            <p class="mb-1"><strong>Telepon:</strong> (021) 3847790</p>
                            <p class="mb-1"><strong>WhatsApp:</strong> +62 812-3456-7890</p>
                            <p class="mb-0"><strong>Jam Operasional:</strong> 24 Jam</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-building me-2"></i>Kantor PPID</h6>
                            <p class="mb-1"><strong>Alamat:</strong> Jl. Medan Merdeka Barat No. 8</p>
                            <p class="mb-1"><strong>Email:</strong> ppid@pktj.dephub.go.id</p>
                            <p class="mb-0"><strong>Kode Pos:</strong> 10110</p>
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
