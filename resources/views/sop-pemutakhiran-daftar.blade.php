<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Penetapan dan Pemutakhiran Daftar Informasi Publik - Portal PPID PKTJ</title>
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

        .step-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .step-number {
            position: absolute;
            top: -15px;
            left: 20px;
            background: #d4af37;
            color: #1a3a52;
            font-weight: bold;
            font-size: 18px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
        }

        .step-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .step-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
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

        .requirements-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .requirements-box h6 {
            color: #856404;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .requirements-box ul li {
            margin-bottom: 8px;
        }

        .category-list {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #0066cc;
        }

        .category-list h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .category-list ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .category-list ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #0066cc;
            font-weight: bold;
        }

        .important-note {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .important-note h6 {
            color: #721c24;
            font-weight: bold;
            margin-bottom: 10px;
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
                <h1 class="display-5 fw-bold mb-3">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</h1>
                <p class="lead">Standar Operasional Prosedur Pengelolaan Daftar Informasi Publik</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Standar Operasional Prosedur (SOP) Penetapan dan Pemutakhiran Daftar Informasi Publik PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang SOP PPID PKTJ</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengertian Daftar Informasi Publik</h2>
            <div class="profil-content">
                <p><strong>Daftar Informasi Publik</strong> adalah katalog yang berisi sekumpulan informasi yang dapat diakses oleh publik dan disusun secara sistematis. Daftar informasi publik merupakan sarana bagi pemohon informasi untuk mengetahui jenis-jenis informasi yang tersedia dan dapat diminta.</p>

                <p>Daftar informasi publik wajib disusun oleh setiap badan publik dan harus selalu diperbaharui sesuai dengan perkembangan informasi yang ada. Daftar ini harus mudah diakses dan dapat diperoleh secara gratis.</p>
            </div>
        </div>

        <div class="category-list">
            <h6>Kategori Informasi dalam Daftar:</h6>
            <ul>
                <li>Informasi yang wajib disediakan dan diumumkan secara berkala</li>
                <li>Informasi yang wajib tersedia setiap saat</li>
                <li>Informasi yang wajib tersedia atas permintaan</li>
                <li>Informasi yang dikecualikan dari keterbukaan</li>
                <li>Informasi yang dapat diakses dengan permintaan tertentu</li>
                <li>Informasi tentang kegiatan dan program badan publik</li>
                <li>Informasi tentang keuangan dan anggaran</li>
                <li>Informasi tentang peraturan dan kebijakan</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Alur Prosedur Penetapan Daftar Informasi</h2>

            <div class="step-card">
                <div class="step-number">1</div>
                <i class="fas fa-search"></i>
                <h5>Inventarisasi Informasi</h5>
                <p>PPID melakukan inventarisasi seluruh informasi yang dimiliki oleh badan publik. Inventarisasi dilakukan secara menyeluruh pada semua unit kerja.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <i class="fas fa-tags"></i>
                <h5>Klasifikasi Informasi</h5>
                <p>Informasi yang telah diinventarisasi diklasifikasikan berdasarkan jenis, kategori, dan tingkat keterbukaannya sesuai ketentuan perundang-undangan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <i class="fas fa-edit"></i>
                <h5>Penyusunan Daftar</h5>
                <p>PPID menyusun daftar informasi publik dalam format yang mudah dipahami dan diakses oleh publik.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <i class="fas fa-check-circle"></i>
                <h5>Validasi dan Verifikasi</h5>
                <p>Daftar informasi diverifikasi oleh pimpinan badan publik untuk memastikan keakuratan dan kelengkapan informasi.</p>
            </div>

            <div class="step-card">
                <div class="step-number">5</div>
                <i class="fas fa-bullhorn"></i>
                <h5>Penetapan dan Pengumuman</h5>
                <p>Daftar informasi ditetapkan melalui keputusan pimpinan dan diumumkan melalui berbagai kanal komunikasi.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Prosedur Pemutakhiran Daftar</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Monitoring Berkala</h6>
                        <p>PPID melakukan monitoring terhadap perubahan informasi setiap 3 bulan sekali</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Identifikasi Perubahan</h6>
                        <p>Mengidentifikasi informasi baru, perubahan, atau penghapusan informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Update Daftar</h6>
                        <p>Memperbaharui daftar informasi sesuai dengan perubahan yang terjadi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Verifikasi Update</h6>
                        <p>Melakukan verifikasi terhadap daftar yang telah diperbaharui</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Pengumuman Update</h6>
                        <p>Mengumumkan daftar informasi yang telah diperbaharui kepada publik</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="requirements-box">
            <h6><i class="fas fa-file-signature me-2"></i>Persyaratan Format Daftar Informasi</h6>
            <ul>
                <li>Format daftar harus mudah dibaca dan dipahami</li>
                <li>Menggunakan bahasa Indonesia yang baku</li>
                <li>Dilengkapi dengan indeks dan sistem navigasi</li>
                <li>Tersedia dalam format cetak dan digital</li>
                <li>Mencantumkan tanggal pembuatan dan pemutakhiran</li>
                <li>Dilengkapi dengan penjelasan singkat setiap jenis informasi</li>
                <li>Mencantumkan unit kerja yang mengelola informasi</li>
                <li>Dilengkapi dengan kontak untuk mendapatkan informasi</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Tanggung Jawab Unit Kerja</h2>
            <div class="profil-content">
                <p>Dalam penetapan dan pemutakhiran daftar informasi publik, setiap unit kerja memiliki tanggung jawab sebagai berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-users text-primary me-2"></i>Unit Kerja Teknis</h5>
                        <ul>
                            <li>Menyediakan data dan informasi yang dikelola</li>
                            <li>Melakukan inventarisasi informasi internal</li>
                            <li>Menyampaikan perubahan informasi kepada PPID</li>
                            <li>Memverifikasi keakuratan informasi dalam daftar</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-user-tie text-success me-2"></i>PPID</h5>
                        <ul>
                            <li>Menyusun dan mengelola daftar informasi publik</li>
                            <li>Berkordinasi dengan unit kerja terkait</li>
                            <li>Melakukan pemutakhiran daftar secara berkala</li>
                            <li>Menyediakan akses mudah terhadap daftar informasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Sistem Pengelolaan Daftar</h2>
            <div class="profil-content">
                <p>PPID PKTJ menggunakan sistem pengelolaan daftar informasi publik yang terintegrasi dan dapat diakses melalui:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Media Online</h5>
                        <ul>
                            <li>Website resmi PPID PKTJ</li>
                            <li>Portal data terbuka</li>
                            <li>Aplikasi mobile (dalam pengembangan)</li>
                            <li>Database terintegrasi</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-building text-success me-2"></i>Media Offline</h5>
                        <ul>
                            <li>Buku daftar informasi cetak</li>
                            <li>Papan informasi di kantor</li>
                            <li>Brosur dan leaflet</li>
                            <li>CD/DVD data informasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="important-note">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>PENTING</h6>
            <p>Daftar informasi publik harus selalu diperbaharui secara berkala minimal setiap 6 bulan sekali atau setiap kali terjadi perubahan signifikan. Keterlambatan pemutakhiran daftar dapat dikenai sanksi sesuai ketentuan perundang-undangan.</p>
        </div>

        <div class="content-box">
            <h2 class="section-title">Monitoring dan Evaluasi</h2>
            <div class="profil-content">
                <p>PPID melakukan monitoring dan evaluasi terhadap efektivitas daftar informasi publik melalui:</p>
                <ul>
                    <li>Survei kepuasan pengguna daftar informasi</li>
                    <li>Analisis jumlah permintaan informasi dari daftar</li>
                    <li>Evaluasi kelengkapan dan keakuratan daftar</li>
                    <li>Penilaian kemudahan akses daftar informasi</li>
                    <li>Laporan periodik kepada pimpinan</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kontak dan Informasi Tambahan</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-building text-primary me-2"></i>Kantor PPID PKTJ</h5>
                    <p>Jl. Medan Merdeka Barat No. 8<br>
                    Jakarta Pusat 10110<br>
                    Indonesia</p>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-phone text-success me-2"></i>Kontak</h5>
                    <p>Telepon: (021) 3847790<br>
                    Fax: (021) 3847791<br>
                    Email: ppid@pktj.dephub.go.id</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="/layanan-informasi/daftar" class="btn btn-warning me-3">
                    <i class="fas fa-list-alt me-2"></i>Lihat Daftar Informasi Publik
                </a>
                <a href="/profil/kontak" class="btn btn-outline-primary">
                    <i class="fas fa-map-marker-alt me-2"></i>Lihat Lokasi Kantor
                </a>
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
