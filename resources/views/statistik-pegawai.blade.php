<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $data = $data ?? \App\Http\Controllers\StatistikPegawaiController::getMergedSettings();
        $totalSdm = (int) ($data['total_sdm'] ?? 160);
        $pnsCount = (int) ($data['pns_count'] ?? 114);
        $pppkCount = (int) ($data['pppk_count'] ?? 46);
        $nonAsnCount = (int) ($data['nonasn_count'] ?? 0);

        $statusPns = (int) ($data['status_pns'] ?? 114);
        $statusPppk = (int) ($data['status_pppk'] ?? 46);
        $statusNonAsn = (int) ($data['status_nonasn'] ?? 0);
        $statusCpns = (int) ($data['status_cpns'] ?? 0);
        $totalStatus = max(1, $statusPns + $statusPppk + $statusNonAsn + $statusCpns);

        $pctPns = number_format(($statusPns / $totalStatus) * 100, 1);
        $pctPppk = number_format(($statusPppk / $totalStatus) * 100, 1);
        $pctNonAsn = number_format(($statusNonAsn / $totalStatus) * 100, 1);
        $pctCpns = number_format(($statusCpns / $totalStatus) * 100, 1);

        $pendList = json_decode($data['pendidikan_list'] ?? '[]', true) ?: [];
        $golList = json_decode($data['golongan_list'] ?? '[]', true) ?: [];

        $pendLabels = array_column($pendList, 'jenjang');
        $pendCounts = array_column($pendList, 'jumlah');

        $golLabels = array_column($golList, 'golongan');
        $golCounts = array_column($golList, 'jumlah');
    @endphp
    <title>{{ $data['hero_judul'] ?? 'Data & Statistik Kepegawaian' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ Tegal' }}</title>
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
    </style>
</head>
<body>

    @include('navigation')

    <!-- HERO SECTION -->
    <div class="hero-statistik">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="hero-badge-pill" data-aos="fade-down">
                <i class="fas fa-users text-warning"></i> {{ $data['hero_badge'] ?? 'Data & Informasi Kepegawaian Resmi' }}
            </div>
            <h1 class="display-6 fw-bold outfit text-uppercase mb-3 tracking-tight" data-aos="fade-up">
                {{ $data['hero_judul'] ?? 'Data & Statistik Kepegawaian PKTJ' }}
            </h1>
            <p class="lead opacity-90 mx-auto mb-0" style="max-width: 840px; font-size: 15px;" data-aos="fade-up" data-aos-delay="100">
                {{ $data['hero_subjudul'] ?? 'Informasi publik berkala mengenai profil ketenagaan, klasifikasi status ASN/PPPK, tingkat pendidikan akhir, dan kepangkatan/golongan pegawai Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.' }}
            </p>
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
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ $data['total_sdm_label'] ?? 'Total Pegawai PKTJ' }}</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">{{ $totalSdm }} <span class="fs-6 fw-normal text-muted">Orang</span></div>
                            <div class="text-success fw-semibold" style="font-size: 11px;"><i class="fas fa-check-circle"></i> {{ $data['total_sdm_sub'] ?? '160 Pegawai (DRH Kemenhub)' }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #0284c7;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #0284c7, #38bdf8); width: 50px; height: 50px;">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ $data['pns_label'] ?? 'Pegawai Negeri Sipil (PNS)' }}</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">{{ $pnsCount }} <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">{{ $data['pns_sub'] ?? '71.3% Dari Total SDM' }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #10b981;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #059669, #34d399); width: 50px; height: 50px;">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ $data['pppk_label'] ?? 'Pegawai PPPK' }}</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">{{ $pppkCount }} <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">{{ $data['pppk_sub'] ?? '28.8% Dari Total SDM' }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="stat-card-kpi d-flex align-items-center gap-3" style="border-left: 4px solid #6366f1;">
                        <div class="rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #4f46e5, #818cf8); width: 50px; height: 50px;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ $data['nonasn_label'] ?? 'Non-ASN & CPNS' }}</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 26px; line-height: 1.1;">{{ $nonAsnCount }} <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-success fw-semibold" style="font-size: 11px;"><i class="fas fa-check"></i> {{ $data['nonasn_sub'] ?? '100% Pegawai ASN (PNS & PPPK)' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. CHARTS SECTION -->
            <div id="grafik-kepegawaian" class="mb-5 pt-3">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3 flex-wrap gap-2">
                    <div>
                        <h3 class="fw-bold outfit text-[#002b5c] mb-1">
                            <i class="fas fa-chart-line text-primary me-2"></i>Visualisasi Statistik Pegawai PKTJ
                        </h3>
                        <p class="text-muted small mb-0">Sumber Data: {{ $data['sumber_data'] ?? 'Sistem Informasi Kepegawaian (SIMPEG) Kementerian Perhubungan Republik Indonesia' }}</p>
                    </div>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1.5 rounded-pill fw-bold">{{ $data['tahun_anggaran'] ?? 'TA 2025 / 2026' }}</span>
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
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#0284c7;"></span> PNS: <strong>{{ $statusPns }} ({{ $pctPns }}%)</strong></span>
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#10b981;"></span> PPPK: <strong>{{ $statusPppk }} ({{ $pctPppk }}%)</strong></span>
                                @if($statusNonAsn > 0)
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#ef4444;"></span> Non-ASN: <strong>{{ $statusNonAsn }} ({{ $pctNonAsn }}%)</strong></span>
                                @else
                                <span class="badge rounded-pill text-muted border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#cbd5e1;"></span> Non-ASN: <strong>0 (0%)</strong></span>
                                @endif
                                @if($statusCpns > 0)
                                <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#a855f7;"></span> CPNS: <strong>{{ $statusCpns }} ({{ $pctCpns }}%)</strong></span>
                                @else
                                <span class="badge rounded-pill text-muted border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#cbd5e1;"></span> CPNS: <strong>0 (0%)</strong></span>
                                @endif
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
                                @foreach($pendList as $p)
                                <span class="badge bg-white text-dark border rounded-pill px-2.5 py-1">{{ $p['jenjang'] }}: <strong>{{ $p['jumlah'] }}</strong></span>
                                @endforeach
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
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <h4 class="fw-bold outfit text-[#002b5c] mb-0">
                        <i class="fas fa-table-list text-primary me-2"></i>Rincian Tabel Data Kepegawaian
                    </h4>
                    <span class="text-muted small">Update Berkala {{ $data['tahun_anggaran'] ?? 'TA 2025/2026' }}</span>
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
                                        <td class="text-center fw-bold text-[#004a99]">{{ $statusPns }}</td>
                                        <td class="text-center fw-semibold">{{ $pctPns }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="fw-bold text-success">Pegawai Pemerintah Perjanjian Kerja (PPPK)</td>
                                        <td class="text-center fw-bold text-success">{{ $statusPppk }}</td>
                                        <td class="text-center fw-semibold">{{ $pctPppk }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="text-muted">Calon Pegawai Negeri Sipil (CPNS)</td>
                                        <td class="text-center text-muted">{{ $statusCpns }}</td>
                                        <td class="text-center text-muted">{{ $pctCpns }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="text-muted">Pegawai Non-ASN / PPNPN</td>
                                        <td class="text-center text-muted">{{ $statusNonAsn }}</td>
                                        <td class="text-center text-muted">{{ $pctNonAsn }}%</td>
                                    </tr>
                                    <tr class="table-primary fw-bold" style="background: #e0f2fe; color: #002b5c;">
                                        <td colspan="2" class="text-uppercase text-center">Total Seluruh Pegawai PKTJ</td>
                                        <td class="text-center fs-6 text-[#002b5c]">{{ $totalStatus }}</td>
                                        <td class="text-center fs-6 text-[#002b5c]">100.0%</td>
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
                                    @forelse($pendList as $idx => $p)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $idx + 1 }}</td>
                                        <td class="fw-bold">{{ $p['jenjang'] }}</td>
                                        <td class="text-center fw-bold text-success">{{ $p['jumlah'] }}</td>
                                        <td class="text-center text-muted small">{{ $p['keterangan'] ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Belum ada data jenjang pendidikan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    <!-- 3. Rincian Golongan / Ruang Table -->
                    <div class="col-12 mt-3">
                        <div class="table-responsive rounded-4 border shadow-sm">
                            <div class="px-4 py-3 bg-[#002b5c] text-white d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <h6 class="fw-bold outfit text-white mb-0">
                                    <i class="fas fa-layer-group me-2 text-warning"></i>Distribusi Pangkat & Golongan / Ruang Pegawai PKTJ
                                </h6>
                                <span class="badge bg-white text-dark rounded-pill px-3 py-1 font-semibold" style="font-size: 11px;">Rincian Pangkat PNS & Golongan PPPK</span>
                            </div>
                            <table class="table table-hover table-custom-stat mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 8%;">No</th>
                                        <th style="width: 45%;">Golongan / Ruang & Pangkat</th>
                                        <th class="text-center" style="width: 17%;">Kategori</th>
                                        <th class="text-center" style="width: 15%;">Jumlah</th>
                                        <th class="text-center" style="width: 15%;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalGolonganSum = array_sum(array_column($golList, 'jumlah')) ?: $totalSdm;
                                    @endphp
                                    @forelse($golList as $idx => $g)
                                    @php
                                        $isPppk = str_contains(strtoupper($g['golongan'] ?? ''), 'PPPK') || str_contains(strtoupper($g['golongan'] ?? ''), 'GOLONGAN');
                                        $pctG = number_format(($g['jumlah'] / max(1, $totalGolonganSum)) * 100, 1);
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $idx + 1 }}</td>
                                        <td class="fw-bold">{{ $g['golongan'] }}</td>
                                        <td class="text-center">
                                            @if($isPppk)
                                            <span class="badge bg-emerald-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fw-bold">PPPK</span>
                                            @else
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold">PNS</span>
                                            @endif
                                        </td>
                                        <td class="text-center fw-bold text-[#004a99]">{{ $g['jumlah'] }} Orang</td>
                                        <td class="text-center fw-semibold text-muted">{{ $pctG }}%</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada data golongan.</td>
                                    </tr>
                                    @endforelse
                                    <tr class="table-primary fw-bold" style="background: #e0f2fe; color: #002b5c;">
                                        <td colspan="3" class="text-uppercase text-center">Total Akumulasi Seluruh Golongan / Ruang</td>
                                        <td class="text-center fs-6 text-[#002b5c]">{{ $totalGolonganSum }} Orang</td>
                                        <td class="text-center fs-6 text-[#002b5c]">100.0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Jenis Pegawai (Doughnut)
            const ctxJenis = document.getElementById('chartJenisPegawai');
            if (ctxJenis) {
                const jenisLabels = ['PNS ({{ $statusPns }})', 'PPPK ({{ $statusPppk }})'];
                const jenisData = [{{ $statusPns }}, {{ $statusPppk }}];
                const jenisColors = ['#0284c7', '#10b981'];
                @if($statusNonAsn > 0)
                    jenisLabels.push('Non-ASN ({{ $statusNonAsn }})');
                    jenisData.push({{ $statusNonAsn }});
                    jenisColors.push('#ef4444');
                @endif
                @if($statusCpns > 0)
                    jenisLabels.push('CPNS ({{ $statusCpns }})');
                    jenisData.push({{ $statusCpns }});
                    jenisColors.push('#a855f7');
                @endif
                const totalJenis = {{ $totalStatus }};
                new Chart(ctxJenis.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: jenisLabels,
                        datasets: [{
                            data: jenisData,
                            backgroundColor: jenisColors,
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
                                        let val = c.parsed;
                                        let pct = ((val / totalJenis) * 100).toFixed(1);
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
                const pendLabels = {!! json_encode($pendLabels) !!};
                const pendCounts = {!! json_encode($pendCounts) !!};
                const totalPend = pendCounts.reduce((a, b) => a + b, 0) || 1;

                new Chart(ctxPendidikan.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: pendLabels,
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: pendCounts,
                            backgroundColor: [
                                '#10b981', '#84cc16', '#a3e635', '#22c55e', '#f97316', '#06b6d4', '#3b82f6', '#eab308', '#ef4444', '#6366f1', '#ec4899'
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
                                        let val = c.parsed.y;
                                        let pct = ((val / totalPend) * 100).toFixed(1);
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
                const golLabels = {!! json_encode($golLabels) !!};
                const golCounts = {!! json_encode($golCounts) !!};
                const totalGol = golCounts.reduce((a, b) => a + b, 0) || {{ $totalSdm }};

                new Chart(ctxGolongan.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: golLabels,
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: golCounts,
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
                                        let val = c.parsed.y;
                                        let pct = ((val / totalGol) * 100).toFixed(1);
                                        return `${val} orang (${pct}%)`;
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
