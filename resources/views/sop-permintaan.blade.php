<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Permintaan Informasi Publik - Portal PPID PKTJ</title>
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
            background: #f0f8ff;
            border: 2px solid #0066cc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .requirements-box h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .requirements-box ul li {
            margin-bottom: 8px;
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
                <h1 class="display-5 fw-bold mb-3">SOP Permintaan Informasi Publik</h1>
                <p class="lead">Standar Operasional Prosedur Pengajuan Permintaan Informasi</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">SOP Permintaan Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Standar Operasional Prosedur (SOP) Permintaan Informasi Publik PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang SOP PPID PKTJ</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Persyaratan Pengajuan</h2>
            <div class="requirements-box">
                <h6><i class="fas fa-clipboard-list me-2"></i>Persyaratan Administratif:</h6>
                <ul>
                    <li>Formulir permohonan informasi yang telah diisi lengkap</li>
                    <li>Fotokopi identitas diri (KTP/SIM/Paspor) pemohon</li>
                    <li>Surat kuasa (jika diwakilkan oleh pihak lain)</li>
                    <li>Surat keterangan dari instansi (untuk keperluan penelitian)</li>
                </ul>

                <h6 class="mt-4"><i class="fas fa-file-signature me-2"></i>Persyaratan Teknis:</h6>
                <ul>
                    <li>Permintaan informasi harus jelas dan spesifik</li>
                    <li>Mencantumkan tujuan penggunaan informasi</li>
                    <li>Menyertakan alamat email/telepon untuk konfirmasi</li>
                    <li>Menyatakan kesanggupan membayar biaya (jika ada)</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Alur Prosedur Permintaan Informasi</h2>

            <div class="step-card">
                <div class="step-number">1</div>
                <i class="fas fa-file-alt"></i>
                <h5>Penerimaan Permintaan</h5>
                <p>PPID menerima permintaan informasi melalui berbagai kanal: online, datang langsung, surat, atau telepon. Permintaan dicatat dalam register khusus.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <i class="fas fa-user-check"></i>
                <h5>Verifikasi dan Klarifikasi</h5>
                <p>PPID melakukan verifikasi kelengkapan data pemohon dan melakukan klarifikasi jika permintaan informasi kurang jelas atau perlu penjelasan lebih lanjut.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <i class="fas fa-search"></i>
                <h5>Pencarian dan Pengolahan Informasi</h5>
                <p>PPID mencari informasi yang diminta dari database atau unit kerja terkait. Informasi diproses sesuai dengan ketentuan klasifikasi informasi publik.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <i class="fas fa-gavel"></i>
                <h5>Pengujian Konsekuensi</h5>
                <p>Jika informasi yang diminta termasuk informasi yang dikecualikan, PPID melakukan pengujian konsekuensi untuk menentukan dapat atau tidaknya informasi diberikan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">5</div>
                <i class="fas fa-clock"></i>
                <h5>Penetapan Jangka Waktu</h5>
                <p>PPID menetapkan jangka waktu penyelesaian sesuai dengan jenis informasi: maksimal 10 hari kerja untuk informasi tersedia, maksimal 30 hari kerja untuk informasi perlu penyiapan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">6</div>
                <i class="fas fa-envelope"></i>
                <h5>Pemberitahuan Keputusan</h5>
                <p>PPID memberitahukan kepada pemohon tentang ketersediaan informasi atau alasan penolakan. Pemberitahuan dilakukan secara tertulis dalam jangka waktu maksimal 10 hari kerja.</p>
            </div>

            <div class="step-card">
                <div class="step-number">7</div>
                <i class="fas fa-hand-holding"></i>
                <h5>Penyerahan Informasi</h5>
                <p>Informasi diserahkan kepada pemohon melalui berbagai cara: email, datang langsung ke kantor PPID, atau pengiriman melalui pos/jasa kurir.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Jangka Waktu Penyelesaian</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Informasi Tersedia Langsung</h6>
                        <p>Informasi yang sudah tersedia dalam bentuk siap saji dan dapat langsung diberikan kepada pemohon.</p>
                        <div class="alert alert-success mt-2">
                            <strong>Waktu Penyelesaian:</strong> Maksimal 10 hari kerja sejak permintaan diterima secara lengkap
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-warning">Informasi Perlu Penyiapan</h6>
                        <p>Informasi yang perlu dicari, dikumpulkan, atau diproses terlebih dahulu sebelum dapat diberikan.</p>
                        <div class="alert alert-warning mt-2">
                            <strong>Waktu Penyelesaian:</strong> Maksimal 30 hari kerja sejak permintaan diterima secara lengkap
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-info">Perpanjangan Jangka Waktu</h6>
                        <p>Dalam hal tertentu, jangka waktu dapat diperpanjang dengan pemberitahuan tertulis kepada pemohon.</p>
                        <div class="alert alert-info mt-2">
                            <strong>Perpanjangan:</strong> Maksimal 30 hari kerja dengan alasan yang sah
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Biaya Pelayanan</h2>
            <div class="profil-content">
                <p>Biaya pelayanan informasi publik PPID PKTJ ditetapkan berdasarkan Standar Biaya Pelayanan Informasi Publik yang berlaku:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-money-bill-wave text-success me-2"></i>Biaya Gratis</h5>
                        <ul>
                            <li>Pemberian informasi umum</li>
                            <li>Informasi yang berkaitan kepentingan umum</li>
                            <li>Pemberitahuan tertulis keputusan PPID</li>
                            <li>Konsultasi awal permintaan informasi</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-calculator text-warning me-2"></i>Biaya Berbayar</h5>
                        <ul>
                            <li>Penggandaan dokumen: Rp 500/lembar</li>
                            <li>Scan dokumen: Rp 1.000/lembar</li>
                            <li>Media penyimpanan: Rp 10.000/CD</li>
                            <li>Pengiriman dokumen: sesuai ongkos kirim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Hak dan Kewajiban</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="text-primary"><i class="fas fa-user-check me-2"></i>Hak Pemohon Informasi</h5>
                    <ul class="mt-3">
                        <li>Memperoleh informasi yang diminta</li>
                        <li>Mendapatkan pelayanan yang baik dan profesional</li>
                        <li>Mengajukan keberatan atas keputusan PPID</li>
                        <li>Mengajukan gugatan ke pengadilan</li>
                        <li>Mendapatkan ganti rugi atas kesalahan PPID</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h5 class="text-danger"><i class="fas fa-clipboard-check me-2"></i>Kewajiban Pemohon Informasi</h5>
                    <ul class="mt-3">
                        <li>Mengisi formulir permohonan dengan lengkap</li>
                        <li>Menyertakan identitas diri yang sah</li>
                        <li>Menggunakan informasi sesuai tujuan yang dinyatakan</li>
                        <li>Membayar biaya pelayanan (jika ada)</li>
                        <li>Menjaga kerahasiaan informasi yang dikecualikan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengajuan Keberatan</h2>
            <div class="profil-content">
                <p>Jika pemohon informasi tidak puas dengan keputusan PPID, dapat mengajukan keberatan dalam jangka waktu 30 hari kerja sejak menerima pemberitahuan tertulis dari PPID.</p>

                <div class="alert alert-warning mt-3">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Cara Mengajukan Keberatan:</h6>
                    <ol>
                        <li>Mengisi formulir keberatan yang disediakan</li>
                        <li>Melampirkan alasan keberatan secara jelas</li>
                        <li>Menyertakan bukti-bukti pendukung</li>
                        <li>Mengajukan ke PPID yang sama</li>
                    </ol>
                </div>

                <p><strong>Waktu Penyelesaian Keberatan:</strong> Maksimal 30 hari kerja sejak keberatan diterima secara lengkap.</p>
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
                <a href="/permohonan-informasi" class="btn btn-warning me-3">
                    <i class="fas fa-file-alt me-2"></i>Ajukan Permintaan Informasi
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
