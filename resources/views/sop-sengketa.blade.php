<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Pengajuan Sengketa Informasi Publik - Portal PPID PKTJ</title>
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

        .court-info {
            background: #f0f8ff;
            border: 2px solid #0066cc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .court-info h6 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .court-info ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .court-info ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #28a745;
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
                <h1 class="display-5 fw-bold mb-3">SOP Pengajuan Sengketa</h1>
                <p class="lead">Standar Operasional Prosedur Pengajuan Sengketa Informasi Publik</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">SOP Pengajuan Sengketa Informasi Publik</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Standar Operasional Prosedur (SOP) Pengajuan Sengketa Informasi Publik PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
                    <li>Undang-Undang Nomor 51 Tahun 2009 tentang Peradilan Tata Usaha Negara</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang SOP PPID PKTJ</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengertian Sengketa Informasi</h2>
            <div class="profil-content">
                <p><strong>Sengketa Informasi</strong> adalah sengketa yang timbul dalam hal terjadinya perselisihan antara badan publik dengan pemohon informasi atau antara badan publik dengan Komisi Informasi terkait pelaksanaan Undang-Undang Keterbukaan Informasi Publik.</p>

                <p>Sengketa informasi dapat diajukan jika keberatan kepada PPID telah ditolak atau dalam hal terjadi sengketa antar badan publik. Sengketa informasi diselesaikan melalui mekanisme mediasi oleh Komisi Informasi atau melalui pengadilan Tata Usaha Negara.</p>
            </div>
        </div>

        <div class="requirements-box">
            <h6><i class="fas fa-file-signature me-2"></i>Persyaratan Pengajuan Sengketa</h6>
            <ul>
                <li>Formulir sengketa informasi yang telah diisi lengkap</li>
                <li>Salinan keputusan PPID atas keberatan</li>
                <li>Salinan formulir permintaan informasi dan keberatan</li>
                <li>Identitas pemohon (KTP/SIM/Paspor)</li>
                <li>Bukti-bukti pendukung sengketa</li>
                <li>Diajukan dalam jangka waktu 30 hari kerja sejak menerima keputusan PPID</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Mekanisme Penyelesaian Sengketa</h2>

            <div class="step-card">
                <div class="step-number">1</div>
                <i class="fas fa-balance-scale"></i>
                <h5>Mediasi Komisi Informasi</h5>
                <p>Sengketa informasi pertama-tama diselesaikan melalui mediasi oleh Komisi Informasi. Mediasi dilakukan untuk mencapai kesepakatan bersama antara para pihak.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <i class="fas fa-gavel"></i>
                <h5>Ajudikasi Komisi Informasi</h5>
                <p>Jika mediasi tidak mencapai kesepakatan, Komisi Informasi akan melakukan ajudikasi untuk memutus sengketa berdasarkan fakta dan bukti yang ada.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <i class="fas fa-university"></i>
                <h5>Banding ke Pengadilan</h5>
                <p>Para pihak dapat mengajukan banding terhadap putusan Komisi Informasi ke Pengadilan Tata Usaha Negara dalam waktu 14 hari kerja.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <i class="fas fa-check-circle"></i>
                <h5>Eksekusi Putusan</h5>
                <p>Putusan yang telah berkekuatan hukum tetap wajib dilaksanakan oleh para pihak yang bersengketa.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Jangka Waktu Penyelesaian</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Proses Mediasi</h6>
                        <p>Maksimal 30 hari kerja sejak sengketa diterima Komisi Informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Proses Ajudikasi</h6>
                        <p>Maksimal 60 hari kerja sejak sengketa diterima Komisi Informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Pengajuan Banding</h6>
                        <p>Maksimal 14 hari kerja sejak menerima putusan Komisi Informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">Proses di Pengadilan</h6>
                        <p>Maksimal 90 hari kerja untuk tingkat pertama, dapat diperpanjang</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="court-info">
            <h6><i class="fas fa-landmark me-2"></i>Komisi Informasi Pusat</h6>
            <ul>
                <li>Jl. Rasuna Said Kav. C1 No. 1, Kuningan, Jakarta Selatan</li>
                <li>Telepon: (021) 50827100</li>
                <li>Fax: (021) 50827101</li>
                <li>Email: info@komisiinformasi.go.id</li>
                <li>Website: www.komisiinformasi.go.id</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Biaya Sengketa</h2>
            <div class="profil-content">
                <p>Biaya penyelesaian sengketa informasi publik ditetapkan sebagai berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-money-bill-wave text-success me-2"></i>Biaya Gratis</h5>
                        <ul>
                            <li>Pengajuan sengketa ke Komisi Informasi</li>
                            <li>Proses mediasi oleh Komisi Informasi</li>
                            <li>Proses ajudikasi oleh Komisi Informasi</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-calculator text-warning me-2"></i>Biaya Pengadilan</h5>
                        <ul>
                            <li>Pengajuan banding ke PTUN: Rp 500.000,-</li>
                            <li>Biaya materai dan administrasi</li>
                            <li>Biaya saksi dan ahli (jika diperlukan)</li>
                            <li>Biaya pengacara (jika menggunakan jasa)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Hak dan Kewajiban Para Pihak</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="text-primary"><i class="fas fa-user-check me-2"></i>Hak Pemohon</h5>
                    <ul class="mt-3">
                        <li>Mendapatkan putusan yang adil dan objektif</li>
                        <li>Mendapatkan informasi yang diminta jika sengketa dikabulkan</li>
                        <li>Mengajukan banding jika tidak puas dengan putusan</li>
                        <li>Mendapatkan ganti rugi jika badan publik terbukti salah</li>
                        <li>Mendapatkan bantuan hukum (jika memenuhi syarat)</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h5 class="text-danger"><i class="fas fa-building me-2"></i>Kewajiban Badan Publik</h5>
                    <ul class="mt-3">
                        <li>Menyampaikan jawaban atas sengketa dalam waktu yang ditentukan</li>
                        <li>Menyediakan bukti-bukti pendukung dalam proses sengketa</li>
                        <li>Melaksanakan putusan yang telah berkekuatan hukum tetap</li>
                        <li>Menyampaikan laporan pelaksanaan putusan</li>
                        <li>Membayar ganti rugi jika terbukti melanggar ketentuan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="important-note">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>PENTING</h6>
            <p>Sengketa informasi merupakan mekanisme terakhir dalam penyelesaian perselisihan informasi publik. Sebelum mengajukan sengketa, pastikan telah melalui proses keberatan internal terlebih dahulu. Sengketa yang diajukan tanpa melalui proses keberatan internal akan ditolak.</p>
        </div>

        <div class="content-box">
            <h2 class="section-title">Cara Mengajukan Sengketa</h2>
            <div class="profil-content">
                <p>Untuk mengajukan sengketa informasi publik, ikuti langkah-langkah berikut:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-list-check text-primary me-2"></i>Persiapan Dokumen</h5>
                        <ol>
                            <li>Kumpulkan semua dokumen yang diperlukan</li>
                            <li>Isi formulir sengketa dengan lengkap</li>
                            <li>Siapkan alasan sengketa yang jelas</li>
                            <li>Kumpulkan bukti-bukti pendukung</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-paper-plane text-success me-2"></i>Pengajuan Sengketa</h5>
                        <ol>
                            <li>Ajukan ke Komisi Informasi setempat</li>
                            <li>Serahkan dokumen secara langsung atau online</li>
                            <li>Tunggu pemberitahuan pendaftaran sengketa</li>
                            <li>Ikuti proses mediasi/ajudikasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kontak dan Informasi Tambahan</h2>
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-landmark text-primary me-2"></i>Komisi Informasi</h5>
                    <p>Jl. Rasuna Said Kav. C1 No. 1<br>
                    Kuningan, Jakarta Selatan 12910<br>
                    Indonesia</p>
                </div>
                <div class="col-md-6">
                    <h5><i class="fas fa-phone text-success me-2"></i>Kontak</h5>
                    <p>Telepon: (021) 50827100<br>
                    Fax: (021) 50827101<br>
                    Email: info@komisiinformasi.go.id</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="https://www.komisiinformasi.go.id/" target="_blank" class="btn btn-warning me-3">
                    <i class="fas fa-external-link-alt me-2"></i>Website Komisi Informasi
                </a>
                <a href="/prosedur/sop-penanganan-keberatan" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke SOP Keberatan
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
