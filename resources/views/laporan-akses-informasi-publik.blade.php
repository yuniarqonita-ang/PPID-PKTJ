<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['laporan_akses_judul_hero'] ?? 'Statistik & Laporan Akses Informasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Data statistik akses layanan informasi publik PPID Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
    
    <style>
        :root {
            --pktj-navy: #002b5c;
            --pktj-blue: #004a99;
            --pktj-sky: #0284c7;
            --pktj-gold: #ffc107;
            --pktj-amber: #f59e0b;
            --pktj-emerald: #10b981;
            --pktj-purple: #6366f1;
            --pktj-bg: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--pktj-bg);
            color: #1e293b;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* HERO SECTION */
        .hero-laporan {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.96) 0%, rgba(0, 74, 153, 0.92) 100%), 
                        url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 75px 0 95px;
            color: white;
            position: relative;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 22px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(12px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 800;
            color: #ffd166;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .page-container {
            margin-top: -50px;
            position: relative;
            z-index: 20;
            margin-bottom: 70px;
        }

        /* MAIN DASHBOARD CONTAINER (CERIA, UNIK, TERANG) */
        .dashboard-main-card {
            background: #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 50px rgba(0, 43, 92, 0.07);
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            padding: 36px 40px;
            position: relative;
        }

        @media (max-width: 768px) {
            .dashboard-main-card {
                padding: 24px 18px;
                border-radius: 24px;
            }
        }

        /* STATUS CARDS (CERIA & ELEGAN) */
        .stat-card-cheerful {
            border-radius: 22px;
            padding: 24px 22px;
            border: 1.5px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card-cheerful:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0, 43, 92, 0.08);
        }

        /* Amber Card (Belum Ditindaklanjuti) */
        .stat-amber {
            background: linear-gradient(145deg, #ffffff 0%, #fffbeb 100%);
            border-color: #fde68a;
        }
        .stat-amber:hover {
            border-color: #f59e0b;
        }
        .icon-circle-amber {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #b45309;
        }

        /* Blue Card (Diproses) */
        .stat-blue {
            background: linear-gradient(145deg, #ffffff 0%, #f0f9ff 100%);
            border-color: #bae6fd;
        }
        .stat-blue:hover {
            border-color: #0284c7;
        }
        .icon-circle-blue {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            color: #0369a1;
        }

        /* Emerald Card (Selesai) */
        .stat-emerald {
            background: linear-gradient(145deg, #ffffff 0%, #ecfdf5 100%);
            border-color: #a7f3d0;
        }
        .stat-emerald:hover {
            border-color: #10b981;
        }
        .icon-circle-emerald {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #047857;
        }

        /* Purple Card (Total) */
        .stat-purple {
            background: linear-gradient(145deg, #ffffff 0%, #f5f3ff 100%);
            border-color: #ddd6fe;
        }
        .stat-purple:hover {
            border-color: #8b5cf6;
        }
        .icon-circle-purple {
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #6d28d9;
        }

        .icon-circle {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .stat-number {
            font-size: 2.35rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        /* CHART CONTAINER */
        .chart-cheerful-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 26px 28px;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(0, 43, 92, 0.03);
            transition: all 0.3s ease;
            height: 100%;
        }

        .chart-cheerful-card:hover {
            box-shadow: 0 14px 35px rgba(0, 43, 92, 0.06);
            border-color: #cbd5e1;
        }

        .chart-header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 14px;
            border-radius: 9999px;
        }

        .year-select-pill {
            background-color: #ffffff;
            border: 2px solid #004a99;
            color: #002b5c;
            border-radius: 9999px;
            padding: 7px 18px;
            font-weight: 800;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(0, 74, 153, 0.12);
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .year-select-pill:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.18);
        }

        .pulse-emerald {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    @include('navigation')

    <!-- HERO SECTION -->
    <div class="hero-laporan">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="hero-badge-pill" data-aos="fade-down">
                <i class="fas fa-chart-pie text-warning"></i> Statistik Akses Real-Time & Interaktif
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-2 tracking-tight" data-aos="fade-up">
                {{ $settings['laporan_akses_judul_hero'] ?? 'Laporan Akses Informasi Publik' }}
            </h1>
            <p class="lead opacity-90 mx-auto mb-0" style="max-width: 800px; font-size: 16px;" data-aos="fade-up" data-aos-delay="100">
                {{ $settings['laporan_akses_tagline_hero'] ?? 'Transparansi Data & Rekapitulasi Pelayanan Permohonan Informasi di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal' }}
            </p>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="container page-container">
        
        @php
            $totPermohonan = ($permohonan_belum ?? 0) + ($permohonan_proses ?? 0) + ($permohonan_selesai ?? 0);
            $totKeberatan = ($keberatan_belum ?? 0) + ($keberatan_proses ?? 0) + ($keberatan_selesai ?? 0);
            $selesaiPercent = $totPermohonan > 0 ? round((($permohonan_selesai ?? 0) / $totPermohonan) * 100) : 100;
        @endphp

        <div class="dashboard-main-card" data-aos="fade-up">
            
            <!-- HEADER TOOLBAR: TITLE & FILTER TAHUN -->
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 pb-4 mb-4 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center text-white fw-bold rounded-2xl shadow-sm" style="width: 52px; height: 52px; background: linear-gradient(135deg, #002b5c, #004a99); font-size: 22px; border-radius: 16px;">
                        <i class="fas fa-chart-line text-warning"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="outfit fw-black text-[#002b5c] mb-0" style="font-size: 1.35rem;">Statistik Akses Layanan Informasi</h4>
                            <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                <span class="pulse-emerald me-1"></span> Live Data
                            </span>
                        </div>
                        <p class="text-muted small mb-0" style="font-size: 12.5px;">
                            PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan • Periode Data Tahun {{ $selectedYear }}
                        </p>
                    </div>
                </div>

                <!-- FILTER TAHUN CERIA -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small fw-bold"><i class="fas fa-calendar-alt text-primary me-1"></i> Pilih Tahun:</span>
                    <form action="{{ url()->current() }}" method="GET" class="m-0" id="filter-year-form">
                        <select name="filter_year" class="year-select-pill" onchange="document.getElementById('filter-year-form').submit()">
                            @foreach($available_years as $yr)
                                <option value="{{ $yr }}" {{ $yr == $selectedYear ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- RINGKASAN EKSEKUTIF (JIKA ADA DARI ADMIN) -->
            @if(isset($settings['laporan_akses_ringkasan_eksekutif']) && !empty($settings['laporan_akses_ringkasan_eksekutif']))
                <div class="p-4 rounded-3xl mb-5 border shadow-2xs" style="background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%); border-color: #fde68a !important; border-radius: 20px;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-bullhorn text-warning fs-5"></i>
                        <h6 class="outfit fw-bold mb-0 text-amber-900" style="font-size: 14.5px;">Ringkasan Eksekutif Pelayanan PPID PKTJ</h6>
                    </div>
                    <div class="small leading-relaxed text-slate-700">{!! $settings['laporan_akses_ringkasan_eksekutif'] !!}</div>
                </div>
            @endif

            <!-- SECTION 1: PERMOHONAN INFORMASI (KARTU CERIA & DINAMIS) -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="chart-header-badge" style="background: #e0f2fe; color: #0369a1;">
                            <i class="fas fa-inbox"></i> Kategori 1
                        </span>
                        <h5 class="outfit fw-bold text-[#002b5c] mb-0" style="font-size: 1.15rem;">Permohonan Informasi Publik</h5>
                    </div>
                    <span class="badge rounded-pill bg-light text-secondary border px-3 py-1.5 font-mono text-xs">
                        Total: <strong>{{ number_format($totPermohonan) }}</strong> Permohonan
                    </span>
                </div>

                <div class="row g-3">
                    <!-- 1. Belum Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-amber">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-amber">
                                    <i class="far fa-clock"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #fef3c7; color: #b45309;">
                                    Menunggu
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-amber-900">{{ number_format($permohonan_belum ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Belum Ditindaklanjuti</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Permohonan baru yang masuk dalam antrean</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Sedang Diproses -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-blue">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-blue">
                                    <i class="fas fa-arrows-rotate"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #e0f2fe; color: #0284c7;">
                                    Dalam Proses
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-blue-900">{{ number_format($permohonan_proses ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Sedang Diproses</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Sedang diverifikasi / dihimpun oleh tim PPID</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Selesai Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-emerald">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-emerald">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #d1fae5; color: #059669;">
                                    Tuntas 100%
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-emerald-900">{{ number_format($permohonan_selesai ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Selesai Ditindaklanjuti</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Informasi telah disampaikan kepada pemohon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: KEBERATAN INFORMASI (KARTU CERIA & DINAMIS) -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="chart-header-badge" style="background: #fef3c7; color: #b45309;">
                            <i class="fas fa-triangle-exclamation"></i> Kategori 2
                        </span>
                        <h5 class="outfit fw-bold text-[#002b5c] mb-0" style="font-size: 1.15rem;">Keberatan Informasi Publik</h5>
                    </div>
                    <span class="badge rounded-pill bg-light text-secondary border px-3 py-1.5 font-mono text-xs">
                        Total: <strong>{{ number_format($totKeberatan) }}</strong> Pengajuan
                    </span>
                </div>

                <div class="row g-3">
                    <!-- 1. Belum Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-amber">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-amber">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #fef3c7; color: #b45309;">
                                    Menunggu
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-amber-900">{{ number_format($keberatan_belum ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Belum Ditindaklanjuti</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Pengajuan keberatan dalam antrean verifikasi</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Sedang Diproses -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-blue">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-blue">
                                    <i class="fas fa-arrows-spin"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #e0f2fe; color: #0284c7;">
                                    Pemeriksaan
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-blue-900">{{ number_format($keberatan_proses ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Sedang Diproses</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Dalam telaah Atasan PPID PKTJ</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Selesai Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="stat-card-cheerful stat-emerald">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-circle icon-circle-emerald">
                                    <i class="fas fa-circle-check"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-bold" style="background: #d1fae5; color: #059669;">
                                    Tuntas Diselesaikan
                                </span>
                            </div>
                            <div>
                                <div class="stat-number outfit text-emerald-900">{{ number_format($keberatan_selesai ?? 0) }}</div>
                                <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 14.5px;">Selesai Ditindaklanjuti</h6>
                                <p class="text-muted small mb-0" style="font-size: 12px;">Tanggapan resmi atasan telah diterbitkan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: GRAFIK TREN 12 BULAN (CERIA, BERSIH, TERANG) -->
            <div class="row g-4">
                
                <!-- Grafik 1: Permohonan Informasi -->
                <div class="col-lg-6 col-12">
                    <div class="chart-cheerful-card">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <div>
                                <h6 class="outfit fw-bold text-[#002b5c] mb-0" style="font-size: 15px;">
                                    <i class="fas fa-chart-line text-[#004a99] me-2"></i>Tren Permohonan Informasi
                                </h6>
                                <span class="text-muted small" style="font-size: 11.5px;">Pergerakan data 12 bulan terakhir</span>
                            </div>
                            <span class="badge rounded-pill text-xs fw-bold" style="background: #e0f2fe; color: #0284c7;">
                                Area Chart
                            </span>
                        </div>
                        <div style="position: relative; height: 260px; width: 100%;">
                            <canvas id="chartPermohonan12Bulan"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Grafik 2: Keberatan Informasi -->
                <div class="col-lg-6 col-12">
                    <div class="chart-cheerful-card">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <div>
                                <h6 class="outfit fw-bold text-[#002b5c] mb-0" style="font-size: 15px;">
                                    <i class="fas fa-chart-area text-amber-500 me-2"></i>Tren Keberatan Informasi
                                </h6>
                                <span class="text-muted small" style="font-size: 11.5px;">Pergerakan data 12 bulan terakhir</span>
                            </div>
                            <span class="badge rounded-pill text-xs fw-bold" style="background: #fef3c7; color: #b45309;">
                                Area Chart
                            </span>
                        </div>
                        <div style="position: relative; height: 260px; width: 100%;">
                            <canvas id="chartKeberatan12Bulan"></canvas>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('footer')

    <!-- Chart.js Engine (Clean, Bright & Cheerful Theme) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trendMonths = {!! json_encode($trendMonths ?? ['Okt 2025', 'Nov 2025', 'Des 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026', 'Apr 2026', 'Mei 2026', 'Jun 2026', 'Jul 2026', 'Agt 2026', 'Sep 2026']) !!};
            const permohonanDiterima = {!! json_encode($permohonan_trend_diterima ?? array_fill(0, 12, 0)) !!};
            const permohonanSelesai = {!! json_encode($permohonan_trend_selesai ?? array_fill(0, 12, 0)) !!};
            const keberatanDiterima = {!! json_encode($keberatan_trend_diterima ?? array_fill(0, 12, 0)) !!};
            const keberatanSelesai = {!! json_encode($keberatan_trend_selesai ?? array_fill(0, 12, 0)) !!};

            const lightChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#475569',
                            font: { family: 'Plus Jakarta Sans', size: 12, weight: '700' },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18
                        }
                    },
                    tooltip: {
                        backgroundColor: '#002b5c',
                        titleColor: '#ffd166',
                        bodyColor: '#ffffff',
                        borderColor: 'rgba(255,255,255,0.2)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        boxPadding: 6
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(226, 232, 240, 0.6)',
                            borderDash: [4, 4]
                        },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        suggestedMax: 4,
                        grid: {
                            color: 'rgba(226, 232, 240, 0.7)',
                            borderDash: [4, 4]
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            color: '#64748b',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' }
                        }
                    }
                }
            };

            // 1. Chart Permohonan 12 Bulan (Spline / Area)
            const ctxPermohonan = document.getElementById('chartPermohonan12Bulan');
            if (ctxPermohonan) {
                new Chart(ctxPermohonan.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: trendMonths,
                        datasets: [
                            {
                                label: 'Diterima',
                                data: permohonanDiterima,
                                borderColor: '#004a99',
                                backgroundColor: 'rgba(0, 74, 153, 0.12)',
                                pointBackgroundColor: '#004a99',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            },
                            {
                                label: 'Selesai',
                                data: permohonanSelesai,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            }
                        ]
                    },
                    options: lightChartOptions
                });
            }

            // 2. Chart Keberatan 12 Bulan (Spline / Area)
            const ctxKeberatan = document.getElementById('chartKeberatan12Bulan');
            if (ctxKeberatan) {
                new Chart(ctxKeberatan.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: trendMonths,
                        datasets: [
                            {
                                label: 'Diterima',
                                data: keberatanDiterima,
                                borderColor: '#f59e0b',
                                backgroundColor: 'rgba(245, 158, 11, 0.12)',
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            },
                            {
                                label: 'Selesai',
                                data: keberatanSelesai,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            }
                        ]
                    },
                    options: lightChartOptions
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>