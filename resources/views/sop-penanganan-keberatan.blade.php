<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Penanganan Keberatan - Portal PPID PKTJ</title>
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

        .criteria-list {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }

        .criteria-list h6 {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .criteria-list ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .criteria-list ul li::before {
            content: '!';
            position: absolute;
            left: 0;
            color: #dc3545;
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
                <h1 class="display-5 fw-bold mb-3">SOP Penanganan Keberatan</h1>
                <p class="lead">Standar Operasional Prosedur Penanganan Keberatan atas Keputusan PPID</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">SOP Penanganan Keberatan</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Standar Operasional Prosedur (SOP) Penanganan Keberatan PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang SOP PPID PKTJ</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengertian Keberatan</h2>
            <div class="profil-content">
                <p><strong>Keberatan</strong> adalah hak pemohon informasi untuk mengajukan sanggahan terhadap keputusan PPID yang tidak atau belum sepenuhnya memuaskan pemohon informasi. Keberatan dapat diajukan atas:</p>
                <ul>
                    <li>Penolakan permintaan informasi</li>
                    <li>Tidak dipenuhinya permintaan informasi</li>
                    <li>Tidak tepat waktu dalam memberikan informasi</li>
                    <li>Tidak sesuai jumlah biaya yang dikenakan</li>
                    <li>Tidak sesuai format informasi yang diberikan</li>
                    <li>Tidak lengkapnya informasi yang diberikan</li>
                </ul>
            </div>
        </div>

        <div class="requirements-box">
            <h6><i class="fas fa-file-signature me-2"></i>Persyaratan Pengajuan Keberatan</h6>
            <ul>
                <li>Formulir keberatan yang telah diisi lengkap</li>
                <li>Salinan pemberitahuan tertulis keputusan PPID</li>
                <li>Identitas pemohon informasi (KTP/SIM/Paspor)</li>
                <li>Alasan keberatan yang jelas dan spesifik</li>
                <li>Bukti-bukti pendukung keberatan (jika ada)</li>
                <li>Diajukan dalam jangka waktu 30 hari kerja sejak menerima keputusan PPID</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Alur Prosedur Penanganan Keberatan</h2>

            <div class="step-card">
                <div class="step-number">1</div>
                <i class="fas fa-file-alt"></i>
                <h5>Penerimaan Keberatan</h5>
                <p>PPID menerima keberatan dari pemohon informasi melalui berbagai kanal. Keberatan dicatat dalam register khusus dengan nomor keberatan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <i class="fas fa-user-check"></i>
                <h5>Verifikasi Kelengkapan</h5>
                <p>PPID memverifikasi kelengkapan dokumen keberatan. Jika tidak lengkap, PPID memberitahukan kepada pemohon untuk melengkapi dalam waktu 7 hari kerja.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <i class="fas fa-balance-scale"></i>
                <h5>Pembentukan Tim Penanganan</h5>
                <p>PPID membentuk tim penanganan keberatan yang terdiri dari minimal 3 orang yang memiliki kompetensi dalam penanganan keberatan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <i class="fas fa-search"></i>
                <h5>Pemeriksaan dan Evaluasi</h5>
                <p>Tim penanganan melakukan pemeriksaan menyeluruh terhadap keberatan, termasuk mengkaji ulang keputusan awal dan mempertimbangkan alasan keberatan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">5</div>
                <i class="fas fa-gavel"></i>
                <h5>Pengambilan Keputusan</h5>
                <p>Tim penanganan mengambil keputusan untuk menolak atau mengabulkan keberatan berdasarkan kajian yang dilakukan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">6</div>
                <i class="fas fa-envelope"></i>
                <h5>Pemberitahuan Keputusan</h5>
                <p>PPID memberitahukan keputusan atas keberatan kepada pemohon dalam waktu maksimal 30 hari kerja sejak keberatan diterima secara lengkap.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Jangka Waktu Penanganan</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Penerimaan dan Verifikasi</h6>
                        <p>Maksimal 7 hari kerja untuk memverifikasi kelengkapan dokumen keberatan</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Pemeriksaan dan Evaluasi</h6>
                        <p>Maksimal 20 hari kerja untuk melakukan pemeriksaan menyeluruh terhadap keberatan</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Pengambilan Keputusan</h6>
                        <p>Maksimal 30 hari kerja sejak keberatan diterima secara lengkap</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Perpanjangan Jangka Waktu</h6>
                        <p>Dapat diperpanjang maksimal 30 hari kerja dengan pemberitahuan tertulis</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="criteria-list">
            <h6>Kriteria Pengabulan Keberatan:</h6>
            <ul>
                <li>Informasi yang diminta tidak termasuk informasi yang dikecualikan</li>
                <li>Alasan penolakan PPID tidak sesuai dengan ketentuan perundang-undangan</li>
                <li>Informasi yang diminta telah berubah sifatnya menjadi tidak rahasia</li>
                <li>Kepentingan publik lebih besar daripada kepentingan yang dilindungi</li>
                <li>Terjadi kesalahan prosedur dalam pengambilan keputusan awal</li>
                <li>Informasi yang diminta telah diumumkan oleh pihak lain yang berwenang</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Biaya Pelayanan Keberatan</h2>
            <div class="profil-content">
                <p>Biaya pelayanan keberatan ditetapkan berdasarkan Standar Biaya Pelayanan Informasi Publik:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-money-bill-wave text-success me-2"></i>Biaya Gratis</h5>
                        <ul>
                            <li>Pengajuan keberatan</li>
                            <li>Pemeriksaan dan evaluasi keberatan</li>
                            <li>Pemberitahuan keputusan keberatan</li>
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
                    <h5 class="text-primary"><i class="fas fa-user-check me-2"></i>Hak Pemohon Keberatan</h5>
                    <ul class="mt-3">
                        <li>Mendapatkan pemberitahuan tertulis atas keberatan</li>
                        <li>Mendapatkan alasan yang jelas jika keberatan ditolak</li>
                        <li>Mengajukan banding ke Komisi Informasi</li>
                        <li>Mengajukan gugatan ke Pengadilan Tata Usaha Negara</li>
                        <li>Mendapatkan ganti rugi jika PPID terbukti salah</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h5 class="text-danger"><i class="fas fa-clipboard-check me-2"></i>Kewajiban PPID</h5>
                    <ul class="mt-3">
                        <li>Menyelesaikan keberatan dalam jangka waktu yang ditentukan</li>
                        <li>Memberikan alasan yang jelas dan dapat dipertanggungjawabkan</li>
                        <li>Menyimpan dokumen keberatan sebagai arsip</li>
                        <li>Melaporkan penanganan keberatan kepada atasan</li>
                        <li>Menindaklanjuti keputusan yang diambil</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengajuan Sengketa</h2>
            <div class="profil-content">
                <p>Jika keberatan ditolak oleh PPID, pemohon dapat mengajukan sengketa informasi ke Komisi Informasi dalam waktu 30 hari kerja sejak menerima keputusan PPID.</p>

                <div class="alert alert-warning mt-3">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Cara Mengajukan Sengketa:</h6>
                    <ol>
                        <li>Mengisi formulir sengketa yang disediakan Komisi Informasi</li>
                        <li>Melampirkan salinan keberatan dan keputusan PPID</li>
                        <li>Menyertakan alasan sengketa secara jelas</li>
                        <li>Mengajukan ke Komisi Informasi setempat</li>
                    </ol>
                </div>

                <p><strong>Waktu Penyelesaian Sengketa:</strong> Maksimal 60 hari kerja sejak sengketa diterima secara lengkap.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Formulir dan Kontak</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-download text-primary me-2"></i>Download Formulir</h5>
                    <p>Formulir keberatan dapat didownload melalui:</p>
                    <ul>
                        <li><a href="#" class="text-decoration-none">Website PPID PKTJ</a></li>
                        <li><a href="#" class="text-decoration-none">Portal Kemenkominfo</a></li>
                        <li><a href="#" class="text-decoration-none">Datang langsung ke kantor PPID</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-building text-success me-2"></i>Kontak PPID</h5>
                    <p>Jl. Medan Merdeka Barat No. 8<br>
                    Jakarta Pusat 10110<br>
                    Indonesia</p>
                    <p><strong>Telepon:</strong> (021) 3847790<br>
                    <strong>Email:</strong> ppid@pktj.dephub.go.id</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="/permohonan-informasi" class="btn btn-warning me-3">
                    <i class="fas fa-file-alt me-2"></i>Ajukan Keberatan
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
