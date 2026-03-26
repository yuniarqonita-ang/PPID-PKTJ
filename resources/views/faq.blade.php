<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Portal PPID PKTJ</title>
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

        .accordion-button {
            background-color: #f8f9fa !important;
            color: #004a99 !important;
            font-weight: 600;
            border: 2px solid #d4af37;
        }

        .accordion-button:not(.collapsed) {
            background-color: #d4af37 !important;
            color: #1a3a52 !important;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            background-color: #f8f9fa;
            border: 1px solid #d4af37;
        }

        .faq-category {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .faq-category i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .contact-info {
            background: #e9ecef;
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
                <h1 class="display-5 fw-bold mb-3">Frequently Asked Questions</h1>
                <p class="lead">Pertanyaan yang Sering Diajukan tentang PPID PKTJ</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">FAQ PPID PKTJ</h1>

        <div class="faq-category">
            <i class="fas fa-question-circle"></i>
            <h4>Pertanyaan Umum tentang PPID</h4>
        </div>

        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        <i class="fas fa-question me-2"></i>Apa itu PPID?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        PPID adalah singkatan dari Pejabat Pengelola Informasi dan Dokumentasi. PPID adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        <i class="fas fa-question me-2"></i>Apa tugas PPID?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        PPID bertugas untuk menyimpan, mendokumentasikan, menyediakan, dan/atau melayani permintaan informasi publik; membuat dan mengembangkan sistem informasi dan dokumentasi; mengkoordinasikan pengumpulan bahan informasi dan dokumentasi; serta menyediakan informasi dan dokumentasi yang diperlukan oleh masyarakat.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        <i class="fas fa-question me-2"></i>Bagaimana cara mengajukan permintaan informasi?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Permintaan informasi dapat diajukan melalui beberapa cara:
                        <ul>
                            <li>Mengisi formulir permohonan informasi online di website PPID</li>
                            <li>Datang langsung ke kantor PPID dengan membawa identitas diri</li>
                            <li>Mengirim surat permohonan ke alamat PPID</li>
                            <li>Menghubungi hotline PPID untuk informasi awal</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        <i class="fas fa-question me-2"></i>Berapa lama waktu penyelesaian permintaan informasi?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Berdasarkan Undang-Undang KIP, waktu penyelesaian permintaan informasi adalah:
                        <ul>
                            <li>Maksimal 10 hari kerja untuk informasi yang tersedia dan dapat langsung diberikan</li>
                            <li>Maksimal 30 hari kerja untuk informasi yang perlu pencarian dan/atau penyiapan</li>
                            <li>Dapat diperpanjang maksimal 30 hari kerja dengan pemberitahuan tertulis</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        <i class="fas fa-question me-2"></i>Apakah ada biaya untuk mendapatkan informasi?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Untuk permintaan informasi yang berkaitan dengan kepentingan umum, PPID memberikan informasi tanpa biaya. Namun, untuk permintaan informasi yang memerlukan penggandaan atau pengiriman dokumen, pemohon informasi dapat dikenakan biaya sesuai dengan Standar Biaya Pelayanan Informasi Publik yang telah ditetapkan.</p>
                        <p>Biaya yang mungkin dikenakan meliputi:</p>
                        <ul>
                            <li>Biaya penggandaan dokumen</li>
                            <li>Biaya pengiriman dokumen</li>
                            <li>Biaya penyediaan media penyimpanan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        <i class="fas fa-question me-2"></i>Informasi apa saja yang tidak dapat diakses?
                    </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Informasi yang dikecualikan dari keterbukaan informasi publik meliputi:
                        <ul>
                            <li>Informasi yang dapat membahayakan negara</li>
                            <li>Informasi yang berkaitan dengan rahasia dagang</li>
                            <li>Informasi yang berkaitan dengan hak kekayaan intelektual</li>
                            <li>Informasi yang berkaitan dengan data pribadi</li>
                            <li>Informasi yang masih dalam proses pengolahan</li>
                        </ul>
                        <p>Pengecualian informasi harus berdasarkan alasan yang sah dan tidak bersifat mutlak.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                        <i class="fas fa-question me-2"></i>Apa yang harus dilakukan jika permintaan informasi ditolak?
                    </button>
                </h2>
                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Jika permintaan informasi ditolak, pemohon informasi dapat:
                        <ul>
                            <li>Mengajukan keberatan kepada PPID dalam waktu 30 hari kerja</li>
                            <li>Mengajukan sengketa informasi ke Komisi Informasi</li>
                            <li>Mengajukan gugatan ke Pengadilan Tata Usaha Negara</li>
                        </ul>
                        <p>Proses keberatan dan sengketa informasi diatur dalam Undang-Undang KIP dan peraturan pelaksanaannya.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                        <i class="fas fa-question me-2"></i>Kapan jam kerja PPID?
                    </button>
                </h2>
                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        PPID PKTJ melayani permintaan informasi pada hari dan jam kerja sebagai berikut:
                        <ul>
                            <li><strong>Hari kerja:</strong> Senin - Jumat</li>
                            <li><strong>Jam kerja:</strong> 08:00 - 16:00 WIB</li>
                            <li><strong>Istirahat:</strong> 12:00 - 13:00 WIB</li>
                            <li><strong>Hari libur:</strong> Sabtu, Minggu, dan hari libur nasional</li>
                        </ul>
                        <p>Untuk keadaan darurat, dapat menghubungi hotline PPID 24 jam.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                        <i class="fas fa-question me-2"></i>Bagaimana cara menghubungi PPID?
                    </button>
                </h2>
                <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        PPID PKTJ dapat dihubungi melalui berbagai kanal:
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6><i class="fas fa-map-marker-alt text-primary me-2"></i>Alamat Kantor</h6>
                                <p>Jl. Medan Merdeka Barat No. 8<br>
                                Jakarta Pusat 10110<br>
                                Indonesia</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-phone text-success me-2"></i>Kontak</h6>
                                <p>Telp: (021) 3847790<br>
                                Fax: (021) 3847791<br>
                                Email: ppid@pktj.dephub.go.id</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                        <i class="fas fa-question me-2"></i>Apa saja jenis informasi publik yang tersedia?
                    </button>
                </h2>
                <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Jenis informasi publik yang tersedia di PPID PKTJ meliputi:
                        <ul>
                            <li><strong>Informasi Berkala:</strong> Laporan tahunan, laporan keuangan, profil organisasi</li>
                            <li><strong>Informasi Serta Merta:</strong> Informasi yang berkaitan dengan hajat hidup orang banyak</li>
                            <li><strong>Informasi Setiap Saat:</strong> Daftar informasi publik, maklumat pelayanan</li>
                            <li><strong>Informasi Dikecualikan:</strong> Informasi yang dikecualikan berdasarkan alasan yang sah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box mt-4">
            <h2 class="section-title">Tidak Menemukan Jawaban?</h2>
            <div class="contact-info">
                <h5><i class="fas fa-headset text-primary me-2"></i>Hubungi Kami</h5>
                <p>Jika pertanyaan Anda tidak terjawab dalam FAQ ini, silakan hubungi PPID PKTJ melalui:</p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><i class="fas fa-phone text-success me-2"></i><strong>Hotline:</strong> (021) 3847790</p>
                        <p><i class="fas fa-envelope text-info me-2"></i><strong>Email:</strong> ppid@pktj.dephub.go.id</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-building text-warning me-2"></i><strong>Kantor:</strong> Jl. Medan Merdeka Barat No. 8</p>
                        <p><i class="fas fa-clock text-danger me-2"></i><strong>Jam Kerja:</strong> 08:00 - 16:00 WIB</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/permohonan-informasi" class="btn btn-warning me-2">
                        <i class="fas fa-file-alt me-2"></i>Ajukan Permintaan Informasi
                    </a>
                    <a href="/profil/kontak" class="btn btn-outline-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>Lihat Lokasi Kantor
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
