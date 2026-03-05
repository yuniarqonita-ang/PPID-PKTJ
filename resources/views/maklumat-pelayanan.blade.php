<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Pelayanan - Portal PPID PKTJ</title>
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

        .service-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .service-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .service-card h5 {
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

        .price-table {
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
        }

        .price-table table {
            width: 100%;
            margin: 0;
        }

        .price-table th {
            background: #d4af37;
            color: #1a3a52;
            padding: 15px;
            font-weight: bold;
            text-align: center;
        }

        .price-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }

        .price-table tbody tr:hover {
            background: #fff3e0;
        }

        .contact-box {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        .contact-box i {
            font-size: 48px;
            margin-bottom: 20px;
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
                <h1 class="display-5 fw-bold mb-3">Maklumat Pelayanan</h1>
                <p class="lead">Standar Pelayanan Informasi Publik PPID PKTJ</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Maklumat Pelayanan PPID PKTJ</h1>

        <div class="content-box">
            <h2 class="section-title">Pengertian Maklumat Pelayanan</h2>
            <div class="profil-content">
                <p><strong>Maklumat Pelayanan</strong> adalah informasi yang wajib disediakan oleh badan publik untuk memberikan informasi tentang pelayanan yang diberikan kepada masyarakat. Maklumat pelayanan memuat standar, prosedur, dan biaya pelayanan informasi publik.</p>

                <p>Maklumat pelayanan disusun berdasarkan Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik dan harus memuat informasi yang jelas, lengkap, dan mudah dipahami oleh masyarakat.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="service-card text-center">
                    <i class="fas fa-clock"></i>
                    <h5>Waktu Pelayanan</h5>
                    <p>Informasi tentang jam kerja, hari kerja, dan waktu pelayanan informasi publik</p>
                    <ul class="list-unstyled">
                        <li><strong>Hari:</strong> Senin - Jumat</li>
                        <li><strong>Jam:</strong> 08:00 - 16:00 WIB</li>
                        <li><strong>Istirahat:</strong> 12:00 - 13:00 WIB</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="service-card text-center">
                    <i class="fas fa-route"></i>
                    <h5>Prosedur Pelayanan</h5>
                    <p>Langkah-langkah yang harus dilakukan pemohon informasi untuk mendapatkan pelayanan</p>
                    <ul class="list-unstyled">
                        <li><strong>1.</strong> Mengajukan permintaan</li>
                        <li><strong>2.</strong> Verifikasi identitas</li>
                        <li><strong>3.</strong> Proses permintaan</li>
                        <li><strong>4.</strong> Penyerahan informasi</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="service-card text-center">
                    <i class="fas fa-money-bill-wave"></i>
                    <h5>Biaya Pelayanan</h5>
                    <p>Informasi tentang biaya yang dikenakan untuk pelayanan informasi publik</p>
                    <ul class="list-unstyled">
                        <li><strong>Informasi Umum:</strong> Gratis</li>
                        <li><strong>Penggandaan:</strong> Rp 500/lembar</li>
                        <li><strong>Pengiriman:</strong> Sesuai ongkos kirim</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="service-card text-center">
                    <i class="fas fa-headset"></i>
                    <h5>Kontak Pelayanan</h5>
                    <p>Informasi kontak yang dapat dihubungi untuk mendapatkan pelayanan informasi</p>
                    <ul class="list-unstyled">
                        <li><strong>Telepon:</strong> (021) 3847790</li>
                        <li><strong>Email:</strong> ppid@pktj.dephub.go.id</li>
                        <li><strong>Website:</strong> ppid.pktj.ac.id</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Alur Pelayanan Informasi Publik</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">1. Penerimaan Permintaan</h6>
                        <p>PPID menerima permintaan informasi melalui berbagai kanal (online, datang langsung, surat, telepon)</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">2. Pendaftaran & Verifikasi</h6>
                        <p>Permintaan didaftarkan dan diverifikasi kelengkapan data pemohon informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">3. Klarifikasi & Konfirmasi</h6>
                        <p>PPID melakukan klarifikasi jika diperlukan dan mengkonfirmasi pemahaman permintaan</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">4. Pencarian & Pengolahan Informasi</h6>
                        <p>PPID mencari dan mengolah informasi yang diminta sesuai dengan prosedur yang berlaku</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">5. Pemberitahuan & Penyerahan</h6>
                        <p>PPID memberitahukan ketersediaan informasi dan menyerahkan informasi kepada pemohon</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Standar Biaya Pelayanan</h2>
            <div class="price-table">
                <table>
                    <thead>
                        <tr>
                            <th>Jenis Pelayanan</th>
                            <th>Biaya</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pemberian Informasi Umum</td>
                            <td>Gratis</td>
                            <td>Informasi yang dapat langsung diberikan</td>
                        </tr>
                        <tr>
                            <td>Penggandaan Dokumen</td>
                            <td>Rp 500/lembar</td>
                            <td>Untuk dokumen A4 berwarna</td>
                        </tr>
                        <tr>
                            <td>Scan Dokumen</td>
                            <td>Rp 1.000/lembar</td>
                            <td>Dalam format PDF</td>
                        </tr>
                        <tr>
                            <td>Pengiriman Dokumen</td>
                            <td>Sesuai ongkos kirim</td>
                            <td>Melalui pos/jasa kurir</td>
                        </tr>
                        <tr>
                            <td>Media Penyimpanan</td>
                            <td>Rp 10.000/CD</td>
                            <td>CD/DVD kosong</td>
                        </tr>
                        <tr>
                            <td>Biaya Administrasi</td>
                            <td>Rp 5.000</td>
                            <td>Untuk setiap permintaan</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info mt-3">
                <h6><i class="fas fa-info-circle me-2"></i>Catatan:</h6>
                <p>Biaya di atas dapat berubah sesuai dengan ketentuan yang berlaku. Untuk informasi terkini, silakan hubungi PPID.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Persyaratan Pengajuan Informasi</h2>
            <div class="profil-content">
                <h5 class="text-primary mb-3">Persyaratan Administratif:</h5>
                <ul>
                    <li>Formulir permohonan informasi yang telah diisi lengkap</li>
                    <li>Fotokopi identitas diri (KTP/SIM/Paspor)</li>
                    <li>Surat kuasa (jika diwakilkan)</li>
                    <li>Surat keterangan dari instansi (untuk keperluan penelitian)</li>
                </ul>

                <h5 class="text-primary mb-3 mt-4">Persyaratan Teknis:</h5>
                <ul>
                    <li>Permintaan informasi harus jelas dan spesifik</li>
                    <li>Mencantumkan tujuan penggunaan informasi</li>
                    <li>Menyertakan alamat email/telepon untuk konfirmasi</li>
                    <li>Menyatakan kesanggupan membayar biaya (jika ada)</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="content-box">
                    <h2 class="section-title">Jaminan Pelayanan</h2>
                    <div class="profil-content">
                        <p>PPID PKTJ menjamin pelayanan informasi publik yang:</p>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6><i class="fas fa-check-circle text-success me-2"></i>Kualitas</h6>
                                <p>Informasi yang akurat, benar, dan tidak menyesatkan</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-clock text-info me-2"></i>Kesepatan Waktu</h6>
                                <p>Pelayanan sesuai dengan waktu yang telah ditentukan</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-balance-scale text-warning me-2"></i>Keadilan</h6>
                                <p>Pelayanan yang sama dan setara untuk semua pihak</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-shield-alt text-danger me-2"></i>Keamanan</h6>
                                <p>Perlindungan data pribadi dan kerahasiaan informasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-box">
                    <i class="fas fa-comments"></i>
                    <h4>Punya Pertanyaan?</h4>
                    <p>Hubungi kami untuk mendapatkan informasi lebih lanjut tentang pelayanan PPID PKTJ</p>
                    <div class="mt-3">
                        <p><strong>📞 (021) 3847790</strong></p>
                        <p><strong>✉️ ppid@pktj.dephub.go.id</strong></p>
                        <a href="/permohonan-informasi" class="btn btn-light mt-3">
                            <i class="fas fa-file-alt me-2"></i>Ajukan Permintaan
                        </a>
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
