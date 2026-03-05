<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP Pengujian Konsekuensi - Portal PPID PKTJ</title>
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

        .criteria-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .criteria-box h6 {
            color: #856404;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .criteria-box ul li {
            margin-bottom: 8px;
        }

        .assessment-matrix {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }

        .assessment-matrix h6 {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .assessment-matrix ul li {
            margin-bottom: 8px;
            padding-left: 10px;
            position: relative;
        }

        .assessment-matrix ul li::before {
            content: '!';
            position: absolute;
            left: 0;
            color: #dc3545;
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
                <h1 class="display-5 fw-bold mb-3">SOP Pengujian Konsekuensi</h1>
                <p class="lead">Standar Operasional Prosedur Pengujian Konsekuensi Informasi Dikecualikan</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">SOP Pengujian Konsekuensi</h1>

        <div class="content-box">
            <h2 class="section-title">Dasar Hukum</h2>
            <div class="profil-content">
                <p>Standar Operasional Prosedur (SOP) Pengujian Konsekuensi PPID PKTJ disusun berdasarkan:</p>
                <ul>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
                    <li>Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik</li>
                    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang SOP PPID PKTJ</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pengertian Pengujian Konsekuensi</h2>
            <div class="profil-content">
                <p><strong>Pengujian Konsekuensi</strong> adalah proses evaluasi mendalam terhadap potensi dampak negatif yang mungkin timbul apabila informasi yang dikecualikan dari keterbukaan informasi publik dibuka kepada masyarakat. Pengujian ini dilakukan untuk menentukan apakah alasan pengecualian informasi masih relevan atau sudah tidak berlaku.</p>

                <p>Pengujian konsekuensi bersifat objektif dan dilakukan secara sistematis berdasarkan kriteria yang telah ditentukan dalam peraturan perundang-undangan. Hasil pengujian konsekuensi menjadi dasar bagi PPID dalam mengambil keputusan untuk membuka atau menolak informasi.</p>
            </div>
        </div>

        <div class="criteria-box">
            <h6><i class="fas fa-list-check me-2"></i>Kapan Pengujian Konsekuensi Dilakukan</h6>
            <ul>
                <li>Informasi yang dikecualikan berdasarkan Pasal 17 UU KIP akan dibuka</li>
                <li>Informasi telah berubah sifatnya menjadi tidak rahasia</li>
                <li>Kepentingan publik lebih besar daripada kepentingan yang dilindungi</li>
                <li>Informasi telah diumumkan oleh pihak lain yang berwenang</li>
                <li>Informasi telah menjadi pengetahuan umum</li>
                <li>Ada perintah pengadilan untuk membuka informasi</li>
                <li>Permintaan ulang terhadap informasi yang pernah ditolak</li>
            </ul>
        </div>

        <div class="content-box">
            <h2 class="section-title">Alur Prosedur Pengujian Konsekuensi</h2>

            <div class="step-card">
                <div class="step-number">1</div>
                <i class="fas fa-file-alt"></i>
                <h5>Penerimaan Permintaan</h5>
                <p>PPID menerima permintaan informasi atau permintaan ulang terhadap informasi yang pernah ditolak. Permintaan dicatat dalam register khusus.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <i class="fas fa-users"></i>
                <h5>Pembentukan Tim Penguji</h5>
                <p>PPID membentuk tim penguji yang terdiri dari minimal 3 orang yang memiliki kompetensi di bidangnya. Tim diketuai oleh pejabat PPID.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <i class="fas fa-search"></i>
                <h5>Analisis Awal</h5>
                <p>Tim penguji melakukan analisis awal terhadap informasi yang diminta, termasuk mengkaji alasan penolakan sebelumnya dan konteks permintaan.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <i class="fas fa-balance-scale"></i>
                <h5>Pengujian Konsekuensi</h5>
                <p>Tim melakukan pengujian konsekuensi berdasarkan kriteria yang telah ditentukan. Pengujian dilakukan secara obyektif dan sistematis.</p>
            </div>

            <div class="step-card">
                <div class="step-number">5</div>
                <i class="fas fa-gavel"></i>
                <h5>Pengambilan Keputusan</h5>
                <p>Tim mengambil keputusan untuk membuka atau tetap menolak informasi berdasarkan hasil pengujian konsekuensi.</p>
            </div>

            <div class="step-card">
                <div class="step-number">6</div>
                <i class="fas fa-envelope"></i>
                <h5>Pemberitahuan Keputusan</h5>
                <p>PPID memberitahukan keputusan kepada pemohon informasi dengan alasan yang jelas dan dapat dipertanggungjawabkan.</p>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Kriteria Pengujian Konsekuensi</h2>
            <div class="assessment-matrix">
                <h6>Kriteria yang Dinilai dalam Pengujian Konsekuensi:</h6>
                <ul>
                    <li>Dampak terhadap keamanan negara dan stabilitas nasional</li>
                    <li>Risiko terhadap kepentingan ekonomi nasional</li>
                    <li>Potensi pelanggaran hak privasi individu</li>
                    <li>Dampak terhadap proses peradilan yang sedang berlangsung</li>
                    <li>Risiko terhadap keselamatan masyarakat</li>
                    <li>Dampak terhadap rahasia dagang dan kekayaan intelektual</li>
                    <li>Konsekuensi terhadap hubungan internasional</li>
                    <li>Potensi gangguan terhadap fungsi pengawasan</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Metode Pengujian</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">1. Kajian Internal</h6>
                        <p>Mengkaji dampak pembukaan informasi terhadap kepentingan internal badan publik</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">2. Kajian Eksternal</h6>
                        <p>Mengkaji dampak pembukaan informasi terhadap kepentingan publik dan pihak terkait</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">3. Analisis Risiko</h6>
                        <p>Melakukan analisis risiko terhadap berbagai skenario pembukaan informasi</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">4. Konsultasi</h6>
                        <p>Berkonsultasi dengan unit kerja terkait dan ahli yang kompeten</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <h6 class="text-primary">5. Pembobotan</h6>
                        <p>Memberikan bobot pada setiap aspek konsekuensi yang diidentifikasi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Komposisi Tim Penguji</h2>
            <div class="profil-content">
                <p>Tim penguji konsekuensi terdiri dari:</p>
                <ul>
                    <li><strong>Ketua Tim:</strong> Pejabat PPID yang memiliki kompetensi di bidang keterbukaan informasi</li>
                    <li><strong>Sekretaris:</strong> Staf PPID yang bertugas mencatat dan mendokumentasikan proses pengujian</li>
                    <li><strong>Anggota:</strong> Minimal 2 orang dari unit kerja yang mengelola informasi atau ahli terkait</li>
                    <li><strong>Observer:</strong> Perwakilan dari unit kerja terkait (jika diperlukan)</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Jangka Waktu Pengujian</h2>
            <div class="profil-content">
                <p>Jangka waktu pelaksanaan pengujian konsekuensi:</p>
                <ul>
                    <li><strong>Pembentukan Tim:</strong> Maksimal 3 hari kerja sejak permintaan diterima</li>
                    <li><strong>Proses Pengujian:</strong> Maksimal 10 hari kerja</li>
                    <li><strong>Pengambilan Keputusan:</strong> Maksimal 7 hari kerja setelah pengujian selesai</li>
                    <li><strong>Total Jangka Waktu:</strong> Maksimal 20 hari kerja</li>
                </ul>
            </div>
        </div>

        <div class="important-note">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>PENTING</h6>
            <p>Pengujian konsekuensi harus dilakukan secara obyektif dan profesional. Hasil pengujian harus dapat dipertanggungjawabkan secara hukum. Tim penguji dilarang menerima intervensi dari pihak manapun yang dapat mempengaruhi obyektivitas pengujian.</p>
        </div>

        <div class="content-box">
            <h2 class="section-title">Dokumentasi Pengujian</h2>
            <div class="profil-content">
                <p>PPID wajib mendokumentasikan seluruh proses pengujian konsekuensi dengan mencatat:</p>
                <ul>
                    <li>Identitas tim penguji dan tanggal pengujian</li>
                    <li>Ringkasan permintaan informasi</li>
                    <li>Hasil analisis awal dan kajian mendalam</li>
                    <li>Argumentasi pro dan kontra pembukaan informasi</li>
                    <li>Keputusan akhir dan alasan yang mendasarinya</li>
                    <li>Tanda tangan seluruh anggota tim penguji</li>
                </ul>
            </div>
        </div>

        <div class="content-box">
            <h2 class="section-title">Pelaporan dan Evaluasi</h2>
            <div class="profil-content">
                <p>PPID wajib:</p>
                <ul>
                    <li>Melaporkan hasil pengujian konsekuensi kepada pimpinan badan publik</li>
                    <li>Menyimpan dokumentasi pengujian sebagai arsip penting</li>
                    <li>Melakukan evaluasi terhadap proses pengujian secara berkala</li>
                    <li>Meningkatkan kapasitas tim penguji melalui pelatihan</li>
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
                <a href="/informasi-publik/dikecualikan" class="btn btn-warning me-3">
                    <i class="fas fa-shield-alt me-2"></i>Lihat Informasi Dikecualikan
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
