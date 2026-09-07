<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data & Statistik Kepegawaian - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ Tegal' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }
        
        .hero-statistik {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            padding: 70px 0 85px;
            color: white;
            position: relative;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 20px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(12px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            color: #ffd166;
            margin-bottom: 16px;
        }

        .content-card-main {
            background: white;
            padding: 40px;
            border-radius: 28px;
            box-shadow: 0 15px 45px rgba(0, 43, 92, 0.08);
            margin-top: -50px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            position: relative;
            z-index: 20;
            margin-bottom: 70px;
        }

        @media (max-width: 768px) {
            .content-card-main { padding: 22px 16px; border-radius: 18px; margin-top: -35px; }
        }

        .stat-card-kpi {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 22px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.03);
            height: 100%;
        }

        .stat-card-kpi:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 74, 153, 0.10);
        }

        .chart-box-container {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 24px;
            height: 100%;
        }

        .table-custom-stat thead th {
            background: #002b5c;
            color: white;
            font-size: 12.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
            border: none;
        }

        .table-custom-stat tbody td {
            padding: 12px 16px;
            font-size: 13.5px;
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
        }

        .proof-img-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
        }

        .proof-img-card:hover {
            border-color: #004a99;
            box-shadow: 0 10px 30px rgba(0, 74, 153, 0.12);
            transform: translateY(-3px);
        }

        .proof-img-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            object-position: top center;
            cursor: pointer;
            transition: transform 0.4s ease;
        }

        .proof-img-card:hover img {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

    @include('navigation')

    <!-- HERO SECTION -->
    <div class="hero-statistik">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="hero-badge-pill" data-aos="fade-down">
                <i class="fas fa-users-cog text-warning"></i> Pemenuhan Standar AKIP 2026 • Indikator E.8
            </div>
            <h1 class="display-6 fw-bold outfit text-uppercase mb-3 tracking-tight" data-aos="fade-up">
                Data & Statistik Kepegawaian PKTJ
            </h1>
            <p class="lead opacity-90 mx-auto mb-4" style="max-width: 840px; font-size: 15px;" data-aos="fade-up" data-aos-delay="100">
                Informasi publik berkala mengenai profil ketenagaan, klasifikasi status ASN/PPPK, tingkat pendidikan akhir, dan kepangkatan/golongan pegawai Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.
            </p>
            <div class="d-flex justify-content-center gap-2 flex-wrap" data-aos="fade-up" data-aos-delay="150">
                <a href="#grafik-kepegawaian" class="btn btn-warning fw-bold px-4 py-2 rounded-pill text-dark shadow-sm" style="font-size: 13.5px;">
                    <i class="fas fa-chart-pie me-1"></i> Lihat Visualisasi Grafik
                </a>
                <a href="#bukti-otentik" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill shadow-sm" style="font-size: 13.5px;">
                    <i class="fas fa-file-shield me-1"></i> Tangkapan Layar SIMPEG
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card-main">

            <!-- 1. KPI STATS SUMMARY (4 CARDS) -->
            <div class="row g-3 mb-5" data-aos="fade-up">
                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #002b5c;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #002b5c, #004a99); width: 50px; height: 50px;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Total SDM Pegawai</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">174 <span class="fs-6 fw-normal text-muted">Orang</span></div>
                            <div class="text-success fw-semibold" style="font-size: 11px;"><i class="fas fa-check-circle"></i> SIMPEG Kemenhub</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #0284c7;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #0284c7, #38bdf8); width: 50px; height: 50px;">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Pegawai Negeri Sipil</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">115 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">66.1% Dari Total SDM</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #10b981;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #059669, #34d399); width: 50px; height: 50px;">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Pegawai PPPK</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">41 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">23.6% Dari Total SDM</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #ef4444;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #dc2626, #f87171); width: 50px; height: 50px;">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Non-ASN & CPNS</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">18 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">17 Non-ASN, 1 CPNS</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. CHARTS SECTION -->
            <div id="grafik-kepegawaian" class="mb-5 pt-3">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <div>
                        <h3 class="fw-bold outfit text-[#002b5c] mb-1">
                            <i class="fas fa-chart-line text-primary me-2"></i>Visualisasi Statistik Pegawai PKTJ
                        </h3>
                        <p class="text-muted small mb-0">Sumber Data: Sistem Informasi Kepegawaian (SIMPEG) Kementerian Perhubungan Republik Indonesia</p>
                    </div>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1.5 rounded-pill fw-bold">TA 2025 / 2026</span>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Doughnut: Status Kepegawaian -->
                    <div class="col-lg-5 col-12" data-aos="fade-up">
                        <div class="chart-box-container">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                                    <i class="fas fa-chart-pie me-2 text-primary"></i>Komposisi Status Pegawai
                                </h5>
                                <span class="badge bg-white text-dark border px-2.5 py-1 rounded-pill small">Proporsi SDM</span>
                            </div>
                            <div style="height: 260px; position: relative;">
                                <canvas id="chartJenisPegawai"></canvas>
                            </div>
                            <div class="d-flex flex-wrap gap-2 justify-content-center mt-3 pt-2 border-top">
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#0284c7;"></span> PNS: <strong>115 (66.1%)</strong></span>
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#10b981;"></span> PPPK: <strong>41 (23.6%)</strong></span>
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#ef4444;"></span> Non-ASN: <strong>17 (9.8%)</strong></span>
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#a855f7;"></span> CPNS: <strong>1 (0.6%)</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Bar: Tingkat Pendidikan -->
                    <div class="col-lg-7 col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="chart-box-container">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                                    <i class="fas fa-graduation-cap me-2 text-primary"></i>Tingkat Pendidikan Terakhir
                                </h5>
                                <span class="badge bg-white text-dark border px-2.5 py-1 rounded-pill small">Kualifikasi Akademik</span>
                            </div>
                            <div style="height: 260px; position: relative;">
                                <canvas id="chartPendidikanPegawai"></canvas>
                            </div>
                            <div class="d-flex flex-wrap gap-2 justify-content-center mt-3 pt-2 border-top">
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">S-2: <strong>68 (39.1%)</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">D-III: <strong>31 (17.8%)</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">D-IV: <strong>24 (13.8%)</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">S-1: <strong>23 (13.2%)</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">SLTA: <strong>23 (13.2%)</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">Profesi: <strong>6</strong></span>
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">S-3: <strong>2</strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bar: Golongan Pegawai -->
                <div class="chart-box-container mb-4" data-aos="fade-up">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                            <i class="fas fa-layer-group me-2 text-primary"></i>Komposisi Golongan / Ruang Pegawai PKTJ
                        </h5>
                        <span class="badge bg-primary text-white px-3 py-1 rounded-pill small">Golongan II, III, IV & PPPK</span>
                    </div>
                    <div style="height: 280px; position: relative;">
                        <canvas id="chartGolonganPegawai"></canvas>
                    </div>
                </div>
            </div>

            <!-- 3. DETAILED DATA TABLES SECTION -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4 class="fw-bold outfit text-[#002b5c] mb-0">
                        <i class="fas fa-table-list text-primary me-2"></i>Rincian Tabel Data Kepegawaian
                    </h4>
                    <span class="text-muted small">Update Berkala TA 2025/2026</span>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="table-responsive rounded-4 border shadow-sm">
                            <table class="table table-hover table-custom-stat mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%;">No</th>
                                        <th>Status Kepegawaian</th>
                                        <th class="text-center" style="width: 25%;">Jumlah</th>
                                        <th class="text-center" style="width: 25%;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="fw-bold text-[#004a99]">Pegawai Negeri Sipil (PNS)</td>
                                        <td class="text-center fw-bold">115</td>
                                        <td class="text-center">66.1%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="fw-bold text-success">Pegawai Pemerintah Perjanjian Kerja (PPPK)</td>
                                        <td class="text-center fw-bold">41</td>
                                        <td class="text-center">23.6%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="fw-bold text-danger">Pegawai Non-ASN / PPNPN</td>
                                        <td class="text-center fw-bold">17</td>
                                        <td class="text-center">9.8%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="fw-bold text-purple" style="color: #a855f7;">Calon Pegawai Negeri Sipil (CPNS)</td>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="text-center">0.6%</td>
                                    </tr>
                                    <tr class="table-primary fw-bold">
                                        <td colspan="2" class="text-uppercase text-center">Total Seluruh Pegawai PKTJ</td>
                                        <td class="text-center">174</td>
                                        <td class="text-center">100.0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="table-responsive rounded-4 border shadow-sm">
                            <table class="table table-hover table-custom-stat mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%;">No</th>
                                        <th>Jenjang Pendidikan Terakhir</th>
                                        <th class="text-center" style="width: 25%;">Jumlah</th>
                                        <th class="text-center" style="width: 25%;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="fw-bold">Magister / S-2</td>
                                        <td class="text-center fw-bold text-success">68</td>
                                        <td class="text-center text-muted small">Dosen & Fungsional</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="fw-bold">Diploma III (D-III)</td>
                                        <td class="text-center fw-bold">31</td>
                                        <td class="text-center text-muted small">Teknis & Instruktur</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="fw-bold">Diploma IV / Sarjana Terapan (D-IV)</td>
                                        <td class="text-center fw-bold">24</td>
                                        <td class="text-center text-muted small">Fungsional Teknis</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="fw-bold">Sarjana (S-1)</td>
                                        <td class="text-center fw-bold">23</td>
                                        <td class="text-center text-muted small">Administrasi & Dosen</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">5</td>
                                        <td class="fw-bold">SLTA / SMK Sederajat</td>
                                        <td class="text-center fw-bold">23</td>
                                        <td class="text-center text-muted small">Pelaksana & Teknis</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">6</td>
                                        <td class="fw-bold">Profesi / S-3 / D-II</td>
                                        <td class="text-center fw-bold">10</td>
                                        <td class="text-center text-muted small">Doktor & Profesi</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. TANGKAPAN LAYAR RESMI SIMPEG (BUKTI OTENTIK AKIP) -->
            <div id="bukti-otentik" class="mb-5 pt-3">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                    <div>
                        <h4 class="fw-bold outfit text-[#002b5c] mb-1">
                            <i class="fas fa-file-shield text-primary me-2"></i>Tangkapan Layar Resmi SIMPEG Kemenhub
                        </h4>
                        <p class="text-muted small mb-0">Arsip otentik sistem kepegawaian sebagai bukti sah penilaian AKIP 2026 (Klik gambar untuk memperbesar)</p>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1.5 fw-bold" onclick="openKepegawaianProofModal()">
                        <i class="fas fa-expand me-1"></i> Mode Galeri
                    </button>
                </div>

                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="proof-img-card">
                            <img src="{{ asset('images/kepegawaian/E6a.jpg') }}" alt="Pegawai Per Jenis - SIMPEG PKTJ" onclick="openProofLightbox('{{ asset('images/kepegawaian/E6a.jpg') }}', '1. Pegawai Per Jenis - SIMPEG PKTJ')">
                            <div class="p-3 bg-white">
                                <span class="badge bg-primary-subtle text-primary fw-bold mb-1" style="font-size: 11px;">Indikator E.8a</span>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Data Pegawai Berdasarkan Jenis</h6>
                                <p class="text-muted small mb-0">Tangkapan layar otentik data PNS, PPPK, dan Non-ASN SIMPEG.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="proof-img-card">
                            <img src="{{ asset('images/kepegawaian/E6b.jpg') }}" alt="Tingkat Pendidikan Pegawai - SIMPEG PKTJ" onclick="openProofLightbox('{{ asset('images/kepegawaian/E6b.jpg') }}', '2. Tingkat Pendidikan Pegawai - SIMPEG PKTJ')">
                            <div class="p-3 bg-white">
                                <span class="badge bg-success-subtle text-success fw-bold mb-1" style="font-size: 11px;">Indikator E.8b</span>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Data Tingkat Pendidikan Pegawai</h6>
                                <p class="text-muted small mb-0">Komposisi jenjang pendidikan S-2, D-III, D-IV, dan S-1.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="proof-img-card">
                            <img src="{{ asset('images/kepegawaian/E6c.jpg') }}" alt="Golongan Pegawai - SIMPEG PKTJ" onclick="openProofLightbox('{{ asset('images/kepegawaian/E6c.jpg') }}', '3. Golongan Pegawai - SIMPEG PKTJ')">
                            <div class="p-3 bg-white">
                                <span class="badge bg-warning-subtle text-dark fw-bold mb-1" style="font-size: 11px;">Indikator E.8c</span>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Data Golongan / Ruang Pegawai</h6>
                                <p class="text-muted small mb-0">Komposisi pegawai dari Golongan II/c hingga IV/b dan PPPK.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. CALLOUT DOKUMEN DUKUNG -->
            <div class="p-4 rounded-4 border bg-light d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="w-12 h-12 rounded-3 bg-primary text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="width: 48px; height: 48px;">
                        <i class="fas fa-user-shield text-warning"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark fs-6">Data Kepegawaian & Profil Pimpinan PPID PKTJ</div>
                        <div class="text-muted small">Informasi resmi komposisi ketenagaan serta kepatuhan Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) pimpinan PKTJ Tegal.</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <a href="{{ url('/profil/pejabat') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold btn-sm shadow-sm">
                        <i class="fas fa-user-tie me-1"></i> Profil Pejabat & LHKPN
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL TANGKAPAN LAYAR RESMI SIMPEG KEPEGAWAIAN -->
    <div class="modal fade" id="kepegawaianProofModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden">
                <div class="modal-header bg-[#002b5c] text-white p-3.5" style="background: #002b5c;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-chart-bar text-warning fs-5"></i>
                        <h5 class="modal-title fw-bold outfit text-white mb-0">Tangkapan Layar Resmi SIMPEG PKTJ (TA 2025/2026)</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <ul class="nav nav-pills mb-3 gap-2" id="simpegTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill fw-bold btn-sm px-3" id="tab-jenis-tab" data-bs-toggle="pill" data-bs-target="#tab-jenis" type="button" role="tab">1. Pegawai Per Jenis</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill fw-bold btn-sm px-3" id="tab-pendidikan-tab" data-bs-toggle="pill" data-bs-target="#tab-pendidikan" type="button" role="tab">2. Tingkat Pendidikan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill fw-bold btn-sm px-3" id="tab-golongan-tab" data-bs-toggle="pill" data-bs-target="#tab-golongan" type="button" role="tab">3. Golongan Pegawai</button>
                        </li>
                    </ul>
                    <div class="tab-content bg-white p-3 rounded-3 border shadow-sm" id="simpegTabsContent">
                        <div class="tab-pane fade show active text-center" id="tab-jenis" role="tabpanel">
                            <img src="{{ asset('images/kepegawaian/E6a.jpg') }}" alt="Pegawai Per Jenis" class="img-fluid rounded border shadow-sm" style="max-height: 65vh; object-fit: contain;">
                            <div class="text-muted small mt-2">Sumber: SIMPEG Kementerian Perhubungan - Politeknik Keselamatan Transportasi Jalan</div>
                        </div>
                        <div class="tab-pane fade text-center" id="tab-pendidikan" role="tabpanel">
                            <img src="{{ asset('images/kepegawaian/E6b.jpg') }}" alt="Tingkat Pendidikan Pegawai" class="img-fluid rounded border shadow-sm" style="max-height: 65vh; object-fit: contain;">
                            <div class="text-muted small mt-2">Komposisi Pegawai Berdasarkan Tingkat Pendidikan Akhir</div>
                        </div>
                        <div class="tab-pane fade text-center" id="tab-golongan" role="tabpanel">
                            <img src="{{ asset('images/kepegawaian/E6c.jpg') }}" alt="Golongan Pegawai" class="img-fluid rounded border shadow-sm" style="max-height: 65vh; object-fit: contain;">
                            <div class="text-muted small mt-2">Komposisi Pegawai Berdasarkan Golongan / Ruang</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white p-3 justify-content-between">
                    <span class="text-muted small"><i class="fas fa-check-circle text-success me-1"></i> Data otentik terverifikasi untuk pemenuhan Indikator E.8 AKIP 2026</span>
                    <button type="button" class="btn btn-secondary px-4 rounded-pill fw-bold btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX SINGLE PROOF MODAL -->
    <div class="modal fade" id="proofSingleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden bg-dark text-white">
                <div class="modal-header border-0 pb-0 pe-3 pt-3">
                    <h6 id="proofSingleTitle" class="fw-bold outfit text-white mb-0"></h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4 pt-2">
                    <img id="proofSingleImg" src="" alt="Bukti Kepegawaian" class="img-fluid rounded-3 shadow mb-2" style="max-height: 75vh; object-fit: contain;">
                    <p class="text-muted small mb-0">Tangkapan Layar Resmi SIMPEG Kementerian Perhubungan Republik Indonesia</p>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, once: true });

        function openKepegawaianProofModal() {
            new bootstrap.Modal(document.getElementById('kepegawaianProofModal')).show();
        }

        function openProofLightbox(imgUrl, title) {
            document.getElementById('proofSingleImg').src = imgUrl;
            document.getElementById('proofSingleTitle').textContent = title;
            new bootstrap.Modal(document.getElementById('proofSingleModal')).show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Jenis Pegawai (Doughnut)
            const ctxJenis = document.getElementById('chartJenisPegawai');
            if (ctxJenis) {
                new Chart(ctxJenis.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['PNS', 'PPPK', 'Non-ASN', 'CPNS'],
                        datasets: [{
                            data: [115, 41, 17, 1],
                            backgroundColor: ['#0284c7', '#10b981', '#ef4444', '#a855f7'],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(c) {
                                        let total = 174;
                                        let val = c.parsed;
                                        let pct = ((val / total) * 100).toFixed(1);
                                        return `${c.label}: ${val} orang (${pct}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Chart 2: Pendidikan Pegawai (Bar)
            const ctxPendidikan = document.getElementById('chartPendidikanPegawai');
            if (ctxPendidikan) {
                new Chart(ctxPendidikan.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['S-2', 'D-III', 'D-IV', 'S-1', 'SLTA', 'Profesi', 'S-3', 'D-II', 'SMK'],
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: [68, 31, 24, 23, 23, 6, 2, 1, 1],
                            backgroundColor: [
                                '#10b981', '#84cc16', '#a3e635', '#22c55e', '#f97316', '#06b6d4', '#3b82f6', '#eab308', '#ef4444'
                            ],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(c) {
                                        let total = 179;
                                        let val = c.parsed.y;
                                        let pct = ((val / total) * 100).toFixed(1);
                                        return `${val} orang (${pct}%)`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { grid: { display: false } },
                            y: { beginAtZero: true, ticks: { precision: 0 } }
                        }
                    }
                });
            }

            // Chart 3: Golongan Pegawai (Bar)
            const ctxGolongan = document.getElementById('chartGolonganPegawai');
            if (ctxGolongan) {
                new Chart(ctxGolongan.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Penata (III/c)', 'Penata Muda Tk I (III/b)', 'Penata Tk I (III/d)', 'Gol. VII (PPPK)', 'Gol. IX (PPPK)', 'Pembina (IV/a)', 'Penata Muda (III/a)', 'Pengatur (II/c)', 'Gol. X (PPPK)', 'Gol. V (PPPK)', 'Pengatur Tk I (II/d)', 'Pembina Tk I (IV/b)'],
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: [30, 21, 20, 17, 14, 14, 13, 9, 5, 5, 5, 4],
                            backgroundColor: '#004a99',
                            hoverBackgroundColor: '#ffc107',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(c) {
                                        return `${c.parsed.y} orang (${((c.parsed.y / 174) * 100).toFixed(1)}%)`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 11 } }
                            },
                            y: { beginAtZero: true, ticks: { precision: 0 } }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
