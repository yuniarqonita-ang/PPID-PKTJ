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
        <!-- VISUAL STATS DASHBOARD -->
        <div class="dashboard-card">
            <!-- Filter & Status Row -->
            <div class="filter-row">
                <div>
                    <h3 class="filter-title">Dashboard Visualisasi Akses</h3>
                    <p class="text-muted text-xs mb-0">Statistik real-time permohonan informasi publik PPID PKTJ</p>
                </div>
                
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span class="badge-live-pulse">
                        <span class="pulse-dot"></span> Realtime Data
                    </span>

                    <form action="{{ url()->current() }}" method="GET" class="m-0" id="filter-year-form">
                        <select name="filter_year" class="select-custom" onchange="document.getElementById('filter-year-form').submit()">
                            @foreach($available_years as $yr)
                                <option value="{{ $yr }}" {{ $yr == $selectedYear ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- Executive Summary Summary Box -->
            @if(isset($settings['laporan_akses_ringkasan_eksekutif']) && !empty($settings['laporan_akses_ringkasan_eksekutif']))
                <div class="mb-4 p-4 bg-light rounded-3xl border border-slate-100">
                    <h5 class="fw-bold outfit text-[#004a99] mb-2"><i class="fas fa-info-circle me-2"></i> Ringkasan Eksekutif</h5>
                    <div class="text-muted text-sm leading-relaxed">{!! $settings['laporan_akses_ringkasan_eksekutif'] !!}</div>
                </div>
            @endif

            <!-- High Level Metrics Row -->
            <div class="row g-4 mb-5">
                <div class="col-md-3 col-sm-6">
                    <div class="metric-card">
                        <div class="metric-icon-wrapper"><i class="fas fa-envelope-open-text"></i></div>
                        <div>
                            <div class="metric-value">{{ number_format($totalYearly) }}</div>
                            <div class="metric-label">Total Permohonan</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric-card">
                        <div class="metric-icon-wrapper" style="color: #059669; background: rgba(5, 150, 105, 0.08);"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <div class="metric-value">{{ number_format($ditindaklanjuti) }}</div>
                            <div class="metric-label">Ditindaklanjuti</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric-card">
                        <div class="metric-icon-wrapper" style="color: #ea580c; background: rgba(234, 88, 12, 0.08);"><i class="fas fa-clock"></i></div>
                        <div>
                            <div class="metric-value">{{ number_format($belum_ditindaklanjuti) }}</div>
                            <div class="metric-label">Dalam Proses</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric-card">
                        <div class="metric-icon-wrapper" style="color: #ca8a04; background: rgba(202, 138, 4, 0.08);"><i class="fas fa-history"></i></div>
                        <div>
                            <div class="metric-value">5 - 7</div>
                            <div class="metric-label">Rata-rata Hari Jawab</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="row g-4">
                <!-- Bar Chart: Bulanan -->
                <div class="col-lg-8 col-12">
                    <div class="chart-box">
                        <div class="chart-title-wrapper">
                            <span class="chart-indicator-bar"></span>
                            <h4 class="chart-title">Tren Permohonan Informasi Bulanan (Tahun {{ $selectedYear }})</h4>
                        </div>
                        <div class="chart-canvas-wrapper">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart: Tindak Lanjut -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="chart-box">
                        <div class="chart-title-wrapper">
                            <span class="chart-indicator-bar"></span>
                            <h4 class="chart-title">Persentase Tindak Lanjut</h4>
                        </div>
                        <div class="chart-canvas-wrapper">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Doughnut Chart: Kategori -->
                <div class="col-md-6 col-12">
                    <div class="chart-box">
                        <div class="chart-title-wrapper">
                            <span class="chart-indicator-bar"></span>
                            <h4 class="chart-title">Kategori Pemohon Informasi</h4>
                        </div>
                        <div class="chart-canvas-wrapper">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Horizontal Bar Chart: Metode -->
                <div class="col-md-6 col-12">
                    <div class="chart-box">
                        <div class="chart-title-wrapper">
                            <span class="chart-indicator-bar"></span>
                            <h4 class="chart-title">Metode / Media Pengajuan</h4>
                        </div>
                        <div class="chart-canvas-wrapper">
                            <canvas id="channelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- HISTORICAL ARCHIVE SECTION -->
        <div class="content-card">
            <h3 class="fw-bold outfit text-[#002b5c] mb-4 border-bottom pb-3">
                <i class="far fa-folder-open me-2 text-warning"></i> Arsip Dokumen Laporan Resmi
            </h3>

            @php
                $hasLaporanList = isset($laporan) && $laporan->count() > 0;
            @endphp

            @if($hasLaporanList)
                <div class="row">
                    @foreach($laporan as $item)
                    @php
                        $isGDrive = $item->file_path && (\Illuminate\Support\Str::startsWith($item->file_path, ['http://', 'https://']));
                        $previewUrl = $item->file_path ? ($isGDrive ? $item->file_path : 'storage/' . $item->file_path) : null;
                    @endphp
                    <div class="col-12">
                        <div class="info-item">
                            <div class="d-flex align-items-start flex-column flex-md-row">
                                <div class="info-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="flex-grow-1 w-100">
                                    <h4 class="fw-bold outfit text-dark mb-3">{{ $item->judul }}</h4>
                                    
                                    <div class="rich-content mb-4">
                                        {!! $item->deskripsi ?? 'Tidak ada deskripsi terperinci untuk laporan ini.' !!}
                                    </div>
                                    
                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ $item->tanggal ? $item->tanggal->translatedFormat('d F Y') : ($item->created_at ? $item->created_at->translatedFormat('d F Y') : '-') }}
                                            </span>
                                            @if($item->file_size && $item->file_size !== '-')
                                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-hdd me-1"></i> {{ $item->file_size }}
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            @if($previewUrl && is_previewable($previewUrl))
                                            <a href="#" class="btn-download-premium" 
                                                data-bs-toggle="modal" data-bs-target="#previewModal" 
                                                data-url="{{ route('preview.dokumen', ['file' => $previewUrl, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                                <i class="fas fa-eye"></i> Lihat Laporan
                                            </a>
                                            @endif
                                            
                                            @if($item->file_path && $item->bisa_download)
                                            <a href="{{ route('dokumen.download', $item->id) }}" class="btn-download-premium" style="background: #10b981; color: white;">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-icon text-muted mb-3" style="font-size: 48px;">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <h3>Dokumen Belum Tersedia</h3>
                    <p class="text-muted">Arsip dokumen rekapitulasi akses informasi belum diunggah.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <!-- Chart.js Engine -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data bindings from controller
            const monthlyData = {!! json_encode($monthlyData) !!};
            const categories = {!! json_encode($categories) !!};
            const channels = {!! json_encode($channels) !!};
            const ditindaklanjuti = {{ $ditindaklanjuti }};
            const belumDitindaklanjuti = {{ $belum_ditindaklanjuti }};

            // 1. Monthly Bar Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: monthlyData.map(item => item.bulan.substring(0, 3)),
                    datasets: [
                        {
                            label: 'Jumlah',
                            data: monthlyData.map(item => item.total),
                            backgroundColor: '#ffc107',
                            borderRadius: 6,
                        },
                        {
                            label: 'Diterima',
                            data: monthlyData.map(item => item.diterima),
                            backgroundColor: '#004a99',
                            borderRadius: 6,
                        },
                        {
                            label: 'Ditolak',
                            data: monthlyData.map(item => item.ditolak),
                            backgroundColor: '#ea580c',
                            borderRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { weight: 'bold', family: 'Inter' } } }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { 
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });

            // 2. Status Pie Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: ['Ditindaklanjuti', 'Dalam Proses'],
                    datasets: [{
                        data: [ditindaklanjuti, belumDitindaklanjuti],
                        backgroundColor: ['#004a99', '#ea580c'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { weight: 'bold', family: 'Inter' } } }
                    }
                }
            });

            // 3. Category Doughnut Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Perorangan', 'Kelompok / Organisasi', 'Badan Hukum'],
                    datasets: [{
                        data: [categories.perorangan, categories.kelompok, categories.badan_hukum],
                        backgroundColor: ['#004a99', '#ffc107', '#64748b'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { weight: 'bold', family: 'Inter' } } }
                    }
                }
            });

            // 4. Channel Horizontal Bar Chart
            const channelCtx = document.getElementById('channelChart').getContext('2d');
            new Chart(channelCtx, {
                type: 'bar',
                indexAxis: 'y',
                data: {
                    labels: ['Media Sosial', 'E-PPID / Website'],
                    datasets: [{
                        label: 'Pengajuan',
                        data: [channels.medsos, channels.website],
                        backgroundColor: ['#004a99', '#ffc107'],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { beginAtZero: true, ticks: { precision: 0 } },
                        y: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
