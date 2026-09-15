<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['laporan_akses_judul_hero'] ?? 'Rekapitulasi Akses Informasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Data statistik akses layanan informasi publik PPID PKTJ">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
    
    <!-- Additional Styles for Visual Dashboard -->
    <style>
        .dashboard-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(0, 74, 153, 0.08);
            box-shadow: 0 15px 35px rgba(0, 74, 153, 0.04);
            padding: 30px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, #004a99, #ffc107);
        }

        .metric-card {
            background: #f8faff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.06);
            border-color: #ffc107;
        }

        .metric-icon-wrapper {
            width: 60px;
            height: 60px;
            background: rgba(0, 74, 153, 0.08);
            color: #004a99;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .metric-card:hover .metric-icon-wrapper {
            background: #004a99;
            color: #ffffff;
        }

        .metric-value {
            font-size: 32px;
            font-weight: 900;
            color: #002b5c;
            line-height: 1.1;
            font-family: 'Outfit', sans-serif;
        }

        .metric-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-top: 2px;
        }

        .chart-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.01);
            height: 100%;
            min-height: 380px;
            display: flex;
            flex-direction: column;
        }

        .chart-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 12px;
        }

        .chart-indicator-bar {
            width: 4px;
            height: 20px;
            background: #ffc107;
            border-radius: 2px;
        }

        .chart-title {
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            color: #002b5c;
            letter-spacing: 0.5px;
            margin: 0;
            font-family: 'Outfit', sans-serif;
        }

        .chart-canvas-wrapper {
            position: relative;
            flex-grow: 1;
            width: 100%;
            height: 100%;
            min-height: 250px;
        }

        /* Filter Row style */
        .filter-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .filter-title {
            font-size: 20px;
            font-weight: 800;
            color: #004a99;
            margin: 0;
            font-family: 'Outfit', sans-serif;
        }

        .select-custom {
            padding: 10px 24px;
            border-radius: 12px;
            border: 2px solid rgba(0, 74, 153, 0.12);
            color: #002b5c;
            font-weight: 700;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
        }

        .select-custom:focus {
            border-color: #ffc107;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.2);
        }

        .badge-live-pulse {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 100px;
            color: #059669;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: live-pulse-anim 1.5s infinite;
        }

        @keyframes live-pulse-anim {
            0% { transform: scale(0.9); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.5; }
            100% { transform: scale(0.9); opacity: 1; }
        }

        /* TABLE WRAPPER & STYLING */
        .table-container-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            border: 1px solid rgba(0, 74, 153, 0.08);
            box-shadow: 0 15px 40px rgba(0, 43, 92, 0.05);
        }
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .table-custom thead th {
            background: #002b5c;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 18px 20px;
            border: none;
            vertical-align: middle;
        }
        .table-custom thead th:first-child { border-top-left-radius: 16px; }
        .table-custom thead th:last-child { border-top-right-radius: 16px; }
        .table-custom tbody tr {
            transition: all 0.2s ease;
            background: #ffffff;
        }
        .table-custom tbody tr:nth-child(even) {
            background: #f8fbff;
        }
        .table-custom tbody tr:hover {
            background: #eef6ff !important;
        }
        .table-custom tbody td {
            padding: 20px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
            font-size: 0.95rem;
        }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .btn-poltrada-unduh {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #059669, #10b981);
            color: white !important;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transition: all 0.2s ease;
            border: none;
        }
        .btn-poltrada-unduh:hover {
            background: linear-gradient(135deg, #047857, #059669);
            transform: translateY(-2px);
        }
        .btn-poltrada-lihat {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #004a99, #0284c7);
            color: white !important;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-poltrada-lihat:hover {
            background: linear-gradient(135deg, #003366, #004a99);
            transform: translateY(-2px);
        }
        .no-badge {
            width: 36px;
            height: 36px;
            background: #eef2f6;
            color: #002b5c;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            margin: 0 auto;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-database me-2"></i> Rekapitulasi Data
            </div>
            <h1 class="hero-title outfit">{{ $settings['laporan_akses_judul_hero'] ?? 'Laporan Akses Informasi Publik' }}</h1>
            <p class="hero-tagline">{{ $settings['laporan_akses_tagline_hero'] ?? 'Data Statistik Akses Layanan Informasi Publik PPID PKTJ' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <!-- VISUAL STATS DASHBOARD (MODERN THEME MATCHING SCREENSHOT) -->
        <div class="rounded-4 overflow-hidden shadow-2xl mb-5" style="background: #081225; border: 1px solid rgba(255,255,255,0.08); border-radius: 28px; padding: 28px 32px; color: #fff;">
            
            <!-- Top Banner / Header Bar -->
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 pb-4 mb-4" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center text-white fw-bold rounded-circle shadow-sm" style="width: 44px; height: 44px; background: linear-gradient(135deg, #004a99, #0284c7); font-size: 18px;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h4 class="outfit fw-black text-white mb-0" style="font-size: 1.25rem; letter-spacing: -0.02em;">Dashboard Statistik Akses Informasi Publik</h4>
                        <span class="small" style="font-size: 0.8rem; color: #94a3b8;">PPID Pelaksana Politeknik Keselamatan Transportasi Jalan • Data Realtime</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill px-3 py-2 fw-bold font-mono d-inline-flex align-items-center gap-1.5" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 11px;">
                        <span class="pulse-dot" style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></span> SISTEM AKTIF
                    </span>
                    <form action="{{ url()->current() }}" method="GET" class="m-0" id="filter-year-form">
                        <select name="filter_year" class="form-select form-select-sm rounded-pill fw-bold text-white" style="background-color: #132238; border-color: rgba(255,255,255,0.12); font-size: 12px; padding-left: 14px; padding-right: 32px;" onchange="document.getElementById('filter-year-form').submit()">
                            @foreach($available_years as $yr)
                                <option value="{{ $yr }}" {{ $yr == $selectedYear ? 'selected' : '' }} style="background-color: #132238; color: #fff;">Tahun {{ $yr }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- Executive Summary (if provided by admin) -->
            @if(isset($settings['laporan_akses_ringkasan_eksekutif']) && !empty($settings['laporan_akses_ringkasan_eksekutif']))
                <div class="mb-4 p-4 rounded-3xl" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06);">
                    <h5 class="fw-bold outfit text-warning mb-2" style="font-size: 14px;"><i class="fas fa-info-circle me-2"></i> Ringkasan Eksekutif</h5>
                    <div class="small leading-relaxed" style="color: #cbd5e1;">{!! $settings['laporan_akses_ringkasan_eksekutif'] !!}</div>
                </div>
            @endif

            <!-- SECTION 1: PERMOHONAN INFORMASI (3 STATUS CARDS) -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="outfit fw-bold text-white mb-0" style="font-size: 1.05rem; letter-spacing: -0.01em;">
                        Permohonan Informasi
                    </h5>
                    <span class="small" style="color: #64748b; font-size: 12px;">Klasifikasi status terkini</span>
                </div>
                
                <div class="row g-3">
                    <!-- 1. Belum Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border-radius: 12px; font-size: 18px;">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Belum Ditindaklanjuti</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Permohonan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($permohonan_belum) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Diproses -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border-radius: 12px; font-size: 18px;">
                                    <i class="fas fa-arrows-rotate"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Diproses</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Permohonan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($permohonan_proses) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Selesai -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 12px; font-size: 18px;">
                                    <i class="far fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Selesai</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Permohonan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($permohonan_selesai) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: KEBERATAN INFORMASI (3 STATUS CARDS) -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="outfit fw-bold text-white mb-0" style="font-size: 1.05rem; letter-spacing: -0.01em;">
                        Keberatan Informasi
                    </h5>
                    <span class="small" style="color: #64748b; font-size: 12px;">Klasifikasi status keberatan</span>
                </div>
                
                <div class="row g-3">
                    <!-- 1. Belum Ditindaklanjuti -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border-radius: 12px; font-size: 18px;">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Belum Ditindaklanjuti</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Keberatan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($keberatan_belum) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Diproses -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border-radius: 12px; font-size: 18px;">
                                    <i class="fas fa-arrows-rotate"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Diproses</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Keberatan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($keberatan_proses) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Selesai -->
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="p-4 rounded-4 h-100" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.15); color: #10b981; border-radius: 12px; font-size: 18px;">
                                    <i class="far fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold" style="font-size: 14.5px;">Selesai</div>
                                    <div class="small" style="color: #94a3b8; font-size: 12px;">Keberatan Informasi</div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="outfit fw-black text-white" style="font-size: 32px; line-height: 1;">{{ number_format($keberatan_selesai) }}</div>
                                <div class="small mt-1" style="color: #64748b; font-size: 11.5px;">total data</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: SPLINE CHART - JUMLAH PERMOHONAN INFORMASI PUBLIK -->
            <div class="p-4 rounded-4 mb-4" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px;">
                <div class="mb-3">
                    <h5 class="outfit fw-bold text-white mb-0" style="font-size: 15px;">Jumlah Permohonan Informasi Publik</h5>
                    <div class="small" style="color: #94a3b8; font-size: 12px;">Data 12 bulan terakhir</div>
                </div>
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="chartPermohonan12Bulan"></canvas>
                </div>
            </div>

            <!-- SECTION 4: SPLINE CHART - JUMLAH KEBERATAN INFORMASI -->
            <div class="p-4 rounded-4" style="background: #111e36; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px;">
                <div class="mb-3">
                    <h5 class="outfit fw-bold text-white mb-0" style="font-size: 15px;">Jumlah Keberatan Informasi</h5>
                    <div class="small" style="color: #94a3b8; font-size: 12px;">Data 12 bulan terakhir</div>
                </div>
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="chartKeberatan12Bulan"></canvas>
                </div>
            </div>

        </div>
        <!-- AKHIR VISUAL STATS DASHBOARD -->

        @php
            $validLaporan = collect($laporan ?? [])->filter(function($item) {
                $path = trim(is_array($item) ? ($item['file_path'] ?? '') : ($item->file_path ?? ''));
                return $path !== '' && $path !== '-' && $path !== '#';
            })->values();

            if ($validLaporan->isEmpty()) {
                $validLaporan = collect([
                    (object)[
                        'id' => 17,
                        'judul' => 'Rekapitulasi Pelayanan Informasi Publik Bulanan PKTJ TA 2024',
                        'file_path' => 'https://drive.google.com/drive/folders/17uWXBspza1_i7ffnpGS1jCTGD0tv7lCr',
                        'tanggal' => '2024-12-31',
                        'deskripsi' => 'Rekapitulasi permohonan informasi publik bulanan Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2024.',
                        'is_blurred' => 0
                    ],
                    (object)[
                        'id' => 18,
                        'judul' => 'Rekapitulasi Pelayanan Informasi Publik dan Pertanyaan Masuk di Media Sosial PKTJ TA 2026',
                        'file_path' => 'https://docs.google.com/spreadsheets/d/1q8R8llMqjE8wNysRQ39q8vafcsXcvKxNRSEkIe-JR_c/edit?usp=sharing',
                        'tanggal' => '2026-08-31',
                        'deskripsi' => 'Rekapitulasi log bulanan permohonan informasi dan pertanyaan masuk di kanal media sosial resmi Politeknik Keselamatan Transportasi Jalan Tahun Berjalan 2026.',
                        'is_blurred' => 0
                    ]
                ]);
            }
        @endphp

        <!-- DAFTAR DOKUMEN & REKAPITULASI AKSES INFORMASI PUBLIK -->
        <div class="table-container-card mb-5" data-aos="fade-up">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-primary-subtle text-primary border border-primary-subtle fw-bold mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                        <i class="fas fa-file-alt"></i> ARSIP DOKUMEN & LOG RESMI
                    </div>
                    <h3 class="fw-bold outfit text-[#002b5c] mb-1">
                        <i class="fas fa-table text-[#004a99] me-2"></i>Daftar Rekapitulasi & Log Akses Layanan Informasi Publik
                    </h3>
                    <p class="text-muted small mb-0">
                        Unduh atau telusuri langsung dokumen log bulanan permohonan informasi serta catatan pertanyaan masuk di media sosial resmi PKTJ.
                    </p>
                </div>

                @if($validLaporan->count() > 0)
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill fw-bold" style="font-size: 12px;">
                        <i class="fas fa-check-circle me-1"></i> {{ $validLaporan->count() }} Dokumen Terverifikasi
                    </span>
                </div>
                @endif
            </div>

            @if($validLaporan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom align-middle" id="laporanAksesTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">Nomor</th>
                                <th>Judul Rekapitulasi / Log Dokumen</th>
                                <th class="text-center" style="width: 140px;">Tahun</th>
                                <th class="text-center" style="width: 180px;">Unduh / Akses</th>
                                <th class="text-center" style="width: 180px;">Pratinjau Langsung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($validLaporan as $index => $item)
                            @php
                                $isGDrive = $item->file_path && (str_starts_with($item->file_path, 'http://') || str_starts_with($item->file_path, 'https://'));
                                $directDownload = $isGDrive ? $item->file_path : route('dokumen.download', $item->id);
                                $previewUrl = $isGDrive ? $item->file_path : asset('storage/' . $item->file_path);
                                
                                $tahunLaporan = '-';
                                if ($item->tanggal) {
                                    $tahunLaporan = \Carbon\Carbon::parse($item->tanggal)->format('Y');
                                } elseif ($item->created_at) {
                                    $tahunLaporan = $item->created_at->format('Y');
                                }
                                if (preg_match('/20\d{2}/', $item->judul, $matches)) {
                                    $tahunLaporan = $matches[0];
                                }
                            @endphp
                            <tr class="laporan-row">
                                <td class="text-center">
                                    <div class="no-badge">{{ $index + 1 }}</div>
                                </td>
                                <td>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 1.02rem; line-height: 1.45;">
                                        {{ $item->judul }}
                                    </h5>
                                    @if($item->deskripsi)
                                        <div class="text-muted small" style="font-size: 0.85rem; line-height: 1.5;">
                                            {!! strip_tags($item->deskripsi) !!}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning-subtle text-dark border border-warning px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.85rem;">
                                        {{ $tahunLaporan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $directDownload }}" 
                                       target="{{ $isGDrive ? '_blank' : '_self' }}"
                                       class="btn-poltrada-unduh w-100">
                                        <i class="fas fa-download"></i> Unduh Berkas
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($isGDrive)
                                        <a href="{{ $item->file_path }}" target="_blank" rel="noopener noreferrer" class="btn-poltrada-lihat w-100">
                                            <i class="fas fa-external-link-alt"></i> Buka Dokumen
                                        </a>
                                    @else
                                        <button type="button" class="btn-poltrada-lihat w-100" 
                                            onclick="openLaporanModal('{{ addslashes($item->judul) }}', '{{ $previewUrl }}')">
                                            <i class="fas fa-eye"></i> Pratinjau
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted opacity-50 mb-3"></i>
                    <h5 class="fw-bold text-dark outfit mb-1">Dokumen Rekapitulasi Sedang Disinkronkan</h5>
                    <p class="text-muted small">Arsip dokumen log akses informasi publik sedang dimuat ke sistem.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- MODAL PRATINJAU DOKUMEN -->
    <div class="modal fade" id="previewLaporanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden">
                <div class="modal-header bg-[#002b5c] text-white p-3.5">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-file-invoice text-warning fs-5"></i>
                        <h5 class="modal-title fw-bold outfit text-white mb-0" id="modalLaporanTitle">Pratinjau Dokumen Akses</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 bg-dark" style="height: 75vh;">
                    <iframe id="modalLaporanFrame" src="" class="w-100 h-100 border-0" allow="fullscreen"></iframe>
                </div>
                <div class="modal-footer bg-light p-3 justify-content-between">
                    <span class="text-muted small"><i class="fas fa-shield-alt text-primary me-1"></i> Dokumen Resmi PPID Politeknik Keselamatan Transportasi Jalan</span>
                    <button type="button" class="btn btn-secondary px-4 rounded-pill fw-bold btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <!-- Chart.js Engine -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trendMonths = {!! json_encode($trendMonths ?? ['Okt 2025', 'Nov 2025', 'Des 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026', 'Apr 2026', 'Mei 2026', 'Jun 2026', 'Jul 2026', 'Agt 2026', 'Sep 2026']) !!};
            const permohonanDiterima = {!! json_encode($permohonan_trend_diterima ?? array_fill(0, 12, 0)) !!};
            const permohonanSelesai = {!! json_encode($permohonan_trend_selesai ?? array_fill(0, 12, 0)) !!};
            const keberatanDiterima = {!! json_encode($keberatan_trend_diterima ?? array_fill(0, 12, 0)) !!};
            const keberatanSelesai = {!! json_encode($keberatan_trend_selesai ?? array_fill(0, 12, 0)) !!};

            const darkChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94a3b8',
                            font: { family: 'Inter', size: 12, weight: 'bold' },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 10
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            borderDash: [4, 4]
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        suggestedMax: 4,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.06)',
                            borderDash: [4, 4]
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            color: '#94a3b8',
                            font: { family: 'Inter', size: 11 }
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
                                borderColor: '#0284c7',
                                backgroundColor: 'rgba(2, 132, 199, 0.1)',
                                pointBackgroundColor: '#0284c7',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 1.5,
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
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 1.5,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            }
                        ]
                    },
                    options: darkChartOptions
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
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 1.5,
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
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 1.5,
                                pointHoverRadius: 6,
                                pointRadius: 4,
                                tension: 0.35,
                                borderWidth: 2.5,
                                fill: true
                            }
                        ]
                    },
                    options: darkChartOptions
                });
            }
        });

        function openLaporanModal(title, url) {
            document.getElementById('modalLaporanTitle').textContent = title;
            document.getElementById('modalLaporanFrame').src = url;
            new bootstrap.Modal(document.getElementById('previewLaporanModal')).show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
