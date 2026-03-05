<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dikecualikan - Portal PPID PKTJ</title>
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

        .exception-card {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .exception-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
        }

        .exception-card i {
            font-size: 36px;
            color: #856404;
            margin-bottom: 15px;
        }

        .exception-card h5 {
            color: #856404;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .exception-badge {
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

        .criteria-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }

        .criteria-box h6 {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .criteria-box ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .criteria-box ul li::before {
            content: '!';
            position: absolute;
            left: 0;
            color: #dc3545;
            font-weight: bold;
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
            background: #dc3545;
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
            background: #dc3545;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #dc3545;
        }

        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #dc3545;
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
                <h1 class="display-5 fw-bold mb-3">Informasi Dikecualikan</h1>
                <p class="lead">Informasi yang tidak dapat diakses berdasarkan ketentuan hukum</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">Informasi Dikecualikan</h1>

        <div class="content-box">
            <h2 class="section-title">Pengertian Informasi Dikecualikan</h2>
            <div class="profil-content">
                <p><strong>Informasi Dikecualikan</strong> adalah informasi yang tidak dapat diakses oleh publik berdasarkan ketentuan peraturan perundang-undangan. Pengecualian ini bersifat terbatas dan harus berdasarkan alasan yang sah serta tidak bersifat mutlak.</p>

                <p>Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, informasi dikecualikan harus melalui proses pengujian konsekuensi dan hanya dapat ditolak jika memenuhi kriteria yang ditentukan dalam undang-undang.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kriteria Pengecualian Informasi</h2>
            <div class="criteria-box">
                <h6>Informasi dikecualikan berdasarkan Pasal 17 UU KIP jika:</h6>
                <ul>
                    <li>Membahayakan negara dan mengganggu stabilitas nasional</li>
                    <li>Berkaitan dengan rahasia dagang dan kekayaan intelektual</li>
                    <li>Berkaitan dengan data pribadi sesuai peraturan perundang-undangan</li>
                    <li>Informasi yang masih dalam proses pengolahan</li>
                    <li>Informasi yang berkaitan dengan hasil penelitian yang belum selesai</li>
                    <li>Informasi yang berkaitan dengan kepentingan perlindungan anak</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kategori Informasi Dikecualikan</h2>

            <div class="exception-card">
                <div class="exception-badge">KRITIS</div>
                <i class="fas fa-shield-alt"></i>
                <h5>Rahasia Negara</h5>
                <p>Informasi yang apabila dibuka dapat membahayakan pertahanan dan keamanan negara, hubungan luar negeri, serta stabilitas nasional.</p>
                <ul class="mt-3">
                    <li>Strategi pertahanan negara</li>
                    <li>Intelijen negara</li>
                    <li>Operasi militer rahasia</li>
                    <li>Perjanjian internasional yang bersifat rahasia</li>
                </ul>
            </div>

            <div class="exception-card">
                <div class="exception-badge">BISNIS</div>
                <i class="fas fa-briefcase"></i>
                <h5>Rahasia Dagang</h5>
                <p>Informasi yang berkaitan dengan rahasia dagang, kekayaan intelektual, dan hak paten yang dimiliki oleh pihak lain.</p>
                <ul class="mt-3">
                    <li>Formula atau proses produksi rahasia</li>
                    <li>Data penjualan dan keuangan perusahaan</li>
                    <li>Strategi bisnis dan pemasaran</li>
                    <li>Hak kekayaan intelektual</li>
                </ul>
            </div>

            <div class="exception-card">
                <div class="exception-badge">PRIBADI</div>
                <i class="fas fa-user-secret"></i>
                <h5>Data Pribadi</h5>
                <p>Informasi yang berkaitan dengan data pribadi seseorang sesuai dengan ketentuan peraturan perundang-undangan.</p>
                <ul class="mt-3">
                    <li>Data kesehatan pribadi</li>
                    <li>Informasi keuangan pribadi</li>
                    <li>Data keluarga dan hubungan pribadi</li>
                    <li>Riwayat pribadi yang sensitif</li>
                </ul>
            </div>

            <div class="exception-card">
                <div class="exception-badge">PROSES</div>
                <i class="fas fa-cogs"></i>
                <h5>Informasi dalam Proses</h5>
                <p>Informasi yang masih dalam proses pengolahan, pembahasan internal, atau belum memiliki keputusan final.</p>
                <ul class="mt-3">
                    <li>Rancangan kebijakan yang belum final</li>
                    <li>Hasil penelitian yang belum selesai</li>
                    <li>Dokumen dalam proses audit</li>
                    <li>Berita acara yang belum ditandatangani</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Proses Pengujian Konsekuensi</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">1. Penerimaan Permintaan</h6>
                        <p>PPID menerima permintaan informasi dan melakukan verifikasi awal terhadap jenis informasi yang diminta.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">2. Identifikasi Potensi Risiko</h6>
                        <p>PPID mengidentifikasi apakah informasi yang diminta memiliki potensi risiko jika dibuka ke publik.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">3. Pengujian Konsekuensi</h6>
                        <p>PPID melakukan pengujian mendalam terhadap konsekuensi yang mungkin timbul jika informasi dibuka.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">4. Pertimbangan Kepentingan</h6>
                        <p>PPID mempertimbangkan antara kepentingan publik dengan kepentingan yang dilindungi undang-undang.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">5. Pengambilan Keputusan</h6>
                        <p>PPID mengambil keputusan untuk membuka atau menolak informasi berdasarkan hasil pengujian konsekuensi.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-danger">6. Pemberitahuan Keputusan</h6>
                        <p>PPID memberitahukan keputusan kepada pemohon informasi dengan alasan yang jelas dan dapat dipertanggungjawabkan.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengecualian Bersyarat</h2>
            <div class="profil-content">
                <p>Beberapa informasi dikecualikan dapat dibuka secara bersyarat jika:</p>
                <ul>
                    <li>Informasi tersebut telah berubah sifatnya menjadi tidak rahasia</li>
                    <li>Kepentingan publik lebih besar daripada kepentingan yang dilindungi</li>
                    <li>Informasi tersebut telah diumumkan oleh pihak lain yang berwenang</li>
                    <li>Informasi tersebut telah menjadi pengetahuan umum</li>
                    <li>Ada perintah pengadilan untuk membuka informasi</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Hak Pemohon Informasi</h2>
            <div class="profil-content">
                <p>Meskipun informasi dikecualikan, pemohon informasi tetap memiliki hak untuk:</p>
                <ul>
                    <li>Mendapatkan alasan penolakan yang jelas dan masuk akal</li>
                    <li>Mengajukan keberatan atas keputusan PPID</li>
                    <li>Mengajukan banding ke Komisi Informasi</li>
                    <li>Mengajukan gugatan ke Pengadilan Tata Usaha Negara</li>
                    <li>Mendapatkan informasi yang telah dianonimkan</li>
                </ul>
            </div>
        </div>

        <div class="important-note">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>PENTING</h6>
            <p>Pengecualian informasi publik bersifat terbatas dan sementara. PPID wajib melakukan pengujian ulang secara berkala terhadap informasi yang dikecualikan untuk menentukan apakah informasi tersebut masih perlu dikecualikan atau sudah dapat dibuka ke publik.</p>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengaduan dan Keberatan</h2>
            <div class="profil-content">
                <p>Jika Anda merasa permintaan informasi ditolak dengan alasan yang tidak sah, Anda dapat:</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5><i class="fas fa-gavel text-primary me-2"></i>Keberatan Internal</h5>
                        <p>Ajukan keberatan kepada PPID dalam waktu 30 hari kerja sejak menerima pemberitahuan penolakan.</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-balance-scale text-warning me-2"></i>Sengketa Informasi</h5>
                        <p>Ajukan sengketa informasi ke Komisi Informasi jika keberatan internal ditolak.</p>
                    </div>
                </div>

                <div class="alert alert-info mt-4">
                    <h6><i class="fas fa-info-circle me-2"></i>Kontak PPID</h6>
                    <p>Untuk informasi lebih lanjut tentang proses keberatan atau sengketa informasi, hubungi PPID PKTJ.</p>
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
