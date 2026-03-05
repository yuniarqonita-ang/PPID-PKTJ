<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - Portal PPID PKTJ</title>
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

        .info-category {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .info-category i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            background: #f8f9fa;
            margin: 8px 0;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #d4af37;
            transition: all 0.3s ease;
        }

        .info-list li:hover {
            background: #fff3e0;
            transform: translateX(5px);
        }

        .info-list li strong {
            color: #004a99;
            display: block;
            margin-bottom: 5px;
        }

        .info-list li small {
            color: #666;
            font-style: italic;
        }

        .btn-download {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-download:hover {
            background-color: #c9a227;
            border-color: #c9a227;
            color: #1a3a52;
        }

        .search-box {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 12px 25px;
            color: white;
            width: 100%;
            max-width: 400px;
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

        .filter-buttons {
            margin-bottom: 30px;
        }

        .filter-buttons .btn {
            margin: 5px;
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
                <h1 class="display-5 fw-bold mb-3">Daftar Informasi Publik</h1>
                <p class="lead">Informasi yang Tersedia di PPID PKTJ</p>
                <div class="mt-4">
                    <form class="d-flex justify-content-center">
                        <input class="form-control search-box me-2" type="search" placeholder="Cari informasi...">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Daftar Informasi Publik PPID PKTJ</h1>

        <div class="content-box">
            <h2 class="section-title">Pengertian Daftar Informasi Publik</h2>
            <div class="profil-content">
                <p><strong>Daftar Informasi Publik</strong> adalah katalog yang berisi kumpulan informasi yang tersedia dan dapat diakses oleh publik. Daftar ini disusun secara sistematis dan diklasifikasikan berdasarkan jenis, kategori, dan subyek informasi.</p>

                <p>Daftar informasi publik wajib disusun oleh setiap badan publik sesuai dengan Peraturan Pemerintah Nomor 61 Tahun 2010 dan harus diperbaharui secara berkala.</p>
            </div>
        </div>

        <div class="filter-buttons text-center">
            <button class="btn btn-outline-primary active" onclick="filterInfo('all')">Semua</button>
            <button class="btn btn-outline-success" onclick="filterInfo('berkala')">Berkala</button>
            <button class="btn btn-outline-info" onclick="filterInfo('serta-merta')">Serta Merta</button>
            <button class="btn btn-outline-warning" onclick="filterInfo('setiap-saat')">Setiap Saat</button>
        </div>

        <!-- Informasi Berkala -->
        <div class="info-category">
            <i class="fas fa-calendar-alt"></i>
            <h4>Informasi Berkala</h4>
            <p>Informasi yang wajib disediakan dan diumumkan secara rutin</p>
        </div>

        <div class="content-box">
            <h3 class="text-primary mb-4"><i class="fas fa-building me-2"></i>Profil Badan Publik</h3>
            <ul class="info-list" data-category="berkala">
                <li>
                    <strong>Visi dan Misi PPID PKTJ</strong>
                    <small>Dokumen visi dan misi Pejabat Pengelola Informasi dan Dokumentasi</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Tugas Pokok dan Fungsi PPID</strong>
                    <small>Deskripsi tugas dan fungsi PPID berdasarkan peraturan perundang-undangan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Struktur Organisasi PPID</strong>
                    <small>Diagram dan penjelasan struktur organisasi PPID PKTJ</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Profil Pejabat PPID</strong>
                    <small>Data pejabat yang menangani pengelolaan informasi dan dokumentasi</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Program Kerja PPID</strong>
                    <small>Rencana program kerja PPID untuk tahun berjalan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>

            <h3 class="text-primary mb-4 mt-5"><i class="fas fa-chart-line me-2"></i>Laporan Kegiatan</h3>
            <ul class="info-list" data-category="berkala">
                <li>
                    <strong>Laporan Tahunan PPID 2025</strong>
                    <small>Laporan kegiatan PPID selama tahun 2025</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Laporan Triwulanan PPID</strong>
                    <small>Laporan kegiatan PPID per triwulan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Laporan Kinerja PPID</strong>
                    <small>Evaluasi kinerja PPID dalam melayani informasi publik</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Statistik Permintaan Informasi</strong>
                    <small>Data statistik permintaan informasi publik</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>

            <h3 class="text-primary mb-4 mt-5"><i class="fas fa-file-invoice-dollar me-2"></i>Laporan Keuangan</h3>
            <ul class="info-list" data-category="berkala">
                <li>
                    <strong>Laporan Keuangan Tahunan</strong>
                    <small>Laporan keuangan PPID tahun 2025</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Anggaran PPID</strong>
                    <small>Rencana anggaran PPID untuk tahun berjalan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>
        </div>

        <!-- Informasi Setiap Saat -->
        <div class="info-category">
            <i class="fas fa-clock"></i>
            <h4>Informasi Setiap Saat</h4>
            <p>Informasi yang dapat diakses setiap saat melalui berbagai kanal</p>
        </div>

        <div class="content-box">
            <h3 class="text-primary mb-4"><i class="fas fa-cogs me-2"></i>Pelayanan Informasi</h3>
            <ul class="info-list" data-category="setiap-saat">
                <li>
                    <strong>Maklumat Pelayanan PPID</strong>
                    <small>Informasi tentang prosedur, waktu, dan biaya pelayanan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Standar Operasional Prosedur</strong>
                    <small>SOP pengelolaan informasi dan dokumentasi</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Formulir Permohonan Informasi</strong>
                    <small>Format formulir untuk mengajukan permintaan informasi</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Formulir Keberatan</strong>
                    <small>Format formulir untuk mengajukan keberatan atas keputusan PPID</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>

            <h3 class="text-primary mb-4 mt-5"><i class="fas fa-gavel me-2"></i>Regulasi</h3>
            <ul class="info-list" data-category="setiap-saat">
                <li>
                    <strong>Undang-Undang Keterbukaan Informasi Publik</strong>
                    <small>UU Nomor 14 Tahun 2008</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Peraturan Pemerintah Nomor 61 Tahun 2010</strong>
                    <small>PP tentang Pelaksanaan UU KIP</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Peraturan Komisi Informasi</strong>
                    <small>Regulasi yang diterbitkan oleh Komisi Informasi Pusat</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>

            <h3 class="text-primary mb-4 mt-5"><i class="fas fa-users me-2"></i>Informasi Umum</h3>
            <ul class="info-list" data-category="setiap-saat">
                <li>
                    <strong>Profil PPID PKTJ</strong>
                    <small>Informasi lengkap tentang PPID PKTJ</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Daftar Informasi Publik</strong>
                    <small>Katalog lengkap informasi yang tersedia</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>Kontak PPID</strong>
                    <small>Informasi kontak dan alamat PPID</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
                <li>
                    <strong>FAQ PPID</strong>
                    <small>Pertanyaan yang sering diajukan</small>
                    <br><button class="btn btn-download btn-sm">Download</button>
                </li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Cara Mengakses Informasi</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-globe text-primary me-2"></i>Online</h5>
                    <ul>
                        <li>Melalui website PPID PKTJ</li>
                        <li>Download dokumen langsung</li>
                        <li>Pencarian informasi real-time</li>
                        <li>Akses 24 jam</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-building text-success me-2"></i>Offline</h5>
                    <ul>
                        <li>Datang langsung ke kantor PPID</li>
                        <li>Mengajukan permintaan informasi</li>
                        <li>Mendapatkan dokumen fisik</li>
                        <li>Konsultasi langsung dengan petugas</li>
                    </ul>
                </div>
            </div>

            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Pemberitahuan</h6>
                <p>Daftar informasi publik ini diperbaharui secara berkala. Untuk mendapatkan informasi terkini, silakan hubungi PPID atau akses website secara berkala.</p>
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
    <script>
        function filterInfo(category) {
            const items = document.querySelectorAll('.info-list li');
            const buttons = document.querySelectorAll('.filter-buttons .btn');

            // Reset all buttons
            buttons.forEach(btn => btn.classList.remove('active'));

            // Set active button
            event.target.classList.add('active');

            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
