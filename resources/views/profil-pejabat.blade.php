<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pejabat Publik - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.96) 0%, rgba(0, 74, 153, 0.90) 100%), 
                        url('https://images.unsplash.com/photo-1521791136064-7986c29535a7?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 110px 0 130px;
            color: white;
            position: relative;
        }

        .content-card {
            background: white;
            padding: 45px 50px;
            border-radius: 32px;
            box-shadow: 0 20px 60px rgba(0, 43, 92, 0.08);
            margin-top: -65px;
            border: 1px solid rgba(226, 232, 240, 0.85);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        @media (max-width: 768px) {
            .content-card { padding: 25px 18px; border-radius: 20px; }
        }

        /* KEMENHUB OFFICIAL PEJABAT CARD STYLE */
        .kemenhub-pejabat-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.03);
        }

        .kemenhub-pejabat-box:hover {
            border-color: #004a99;
            box-shadow: 0 12px 30px rgba(0, 74, 153, 0.10);
            transform: translateY(-3px);
        }

        .pejabat-role-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: capitalize;
        }

        .pejabat-name-title {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 18px;
            font-family: 'Outfit', sans-serif;
        }

        .pejabat-body-flex {
            display: flex;
            gap: 22px;
            align-items: flex-start;
            flex-grow: 1;
        }

        .pejabat-photo-container {
            width: 190px;
            min-width: 190px;
            height: 270px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            background: #f8fafc;
            flex-shrink: 0;
            cursor: pointer;
            position: relative;
        }

        .pejabat-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform 0.4s ease;
        }

        .pejabat-photo-container:hover img {
            transform: scale(1.04);
        }

        .pejabat-info-content {
            font-size: 13px;
            line-height: 1.65;
            color: #334155;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pejabat-info-text p {
            margin-bottom: 10px;
            color: #334155;
        }

        .pejabat-lhkpn-link {
            display: inline-block;
            color: #0284c7;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            margin-top: 10px;
            transition: all 0.2s ease;
        }

        .pejabat-lhkpn-link:hover {
            color: #0369a1;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .pejabat-body-flex {
                flex-direction: column;
                align-items: center;
                text-align: left;
            }
            .pejabat-photo-container {
                width: 100%;
                max-width: 220px;
                height: 300px;
            }
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-4 fw-black outfit uppercase">Profil Pejabat Publik</h1>
            <p class="lead opacity-75 mb-0">Informasi profil pimpinan struktural dan riwayat karir di lingkungan PKTJ Tegal.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card" data-aos="fade-up">
            
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold outfit text-dark mb-1" style="color: #004a99; font-size: 24px;">Jajaran Pimpinan & Pejabat PKTJ Tegal</h2>
                    <p class="text-muted small mb-0">Dipublikasikan sesuai standar format resmi Kementerian Perhubungan RI & UU KIP No. 14 Tahun 2008</p>
                </div>
                <div>
                    <a href="{{ route('informasi.berkala') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold text-xs">
                        <i class="fas fa-arrow-left me-2"></i> Ke Informasi Berkala
                    </a>
                </div>
            </div>

            <!-- GRID DAFTAR PEJABAT SESUAI FORMAT RESMI KEMENHUB -->
            <div class="row g-4">
                @forelse($pejabats as $pejabat)
                <div class="col-lg-6 col-12" id="pejabat-{{ $pejabat->id }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="kemenhub-pejabat-box">
                        
                        <!-- Header Jabatan & Nama Sesuai Poltrada Bali -->
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge px-3 py-1.5 rounded-pill text-uppercase fw-bold" style="background: rgba(0, 74, 153, 0.1); color: #004a99; font-size: 11.5px; letter-spacing: 0.8px;">
                                {{ $pejabat->jabatan }}
                            </span>
                        </div>
                        <h3 class="pejabat-name-title mb-3" style="font-size: 17.5px; font-weight: 800; color: #0f172a; line-height: 1.35;">{{ $pejabat->nama }}</h3>
                        
                        <!-- Flex Body (Foto Kiri + Teks Biografi Kanan) -->
                        <div class="pejabat-body-flex">
                            
                            <!-- Foto Resmi Pejabat -->
                            <div class="pejabat-photo-container" onclick="openPejabatLightbox('{{ asset($pejabat->foto) }}', '{{ addslashes($pejabat->nama) }}', '{{ addslashes($pejabat->jabatan) }}')" title="Klik untuk memperbesar foto">
                                @if($pejabat->foto)
                                    <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" onerror="if(this.src.indexOf('Prima')!==-1){this.src='{{ asset('images/pejabat/Prima Anna Maria.png') }}';}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-user-tie fa-4x opacity-25"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Biografi Pejabat (Format Satu Paragraf Sesuai Poltrada Bali) -->
                            <div class="pejabat-info-content">
                                <div class="pejabat-info-text" style="text-align: justify; font-size: 13px; line-height: 1.65; color: #334155;">
                                    <p class="mb-0">
                                        {{ $pejabat->biografi }}
                                    </p>
                                </div>

                                @php
                                    // LHKPN hanya untuk Direktur dan hanya muncul jika file/link Google Drive telah diisi
                                    $isDirektur = ($pejabat->urutan == 1) || (stripos($pejabat->jabatan, 'direktur') !== false && stripos($pejabat->jabatan, 'wakil') === false);
                                    $lhkpnItems = [];
                                    if ($isDirektur) {
                                        if (!empty($pejabat->lhkpn_links) && is_array($pejabat->lhkpn_links)) {
                                            foreach ($pejabat->lhkpn_links as $item) {
                                                if (!empty($item['url']) && filter_var($item['url'], FILTER_VALIDATE_URL) && stripos($item['url'], 'elhkpn.kpk.go.id') === false) {
                                                    $lhkpnItems[] = [
                                                        'judul' => $item['judul'] ?? 'Dokumen LHKPN Resmi',
                                                        'url'   => $item['url']
                                                    ];
                                                }
                                            }
                                        }
                                        if (empty($lhkpnItems)) {
                                            if (!empty($pejabat->lhkpn_file) && has_valid_document($pejabat->lhkpn_file)) {
                                                $lhkpnItems[] = [
                                                    'judul' => 'Dokumen LHKPN Resmi',
                                                    'url'   => asset($pejabat->lhkpn_file)
                                                ];
                                            } elseif (!empty($pejabat->lhkpn_link) && filter_var($pejabat->lhkpn_link, FILTER_VALIDATE_URL) && stripos($pejabat->lhkpn_link, 'elhkpn.kpk.go.id') === false) {
                                                $lhkpnItems[] = [
                                                    'judul' => 'Dokumen LHKPN Resmi ' . ($pejabat->lhkpn_tahun ? '(' . $pejabat->lhkpn_tahun . ')' : ''),
                                                    'url'   => $pejabat->lhkpn_link
                                                ];
                                            }
                                        }
                                    }
                                @endphp

                                @if($isDirektur && !empty($lhkpnItems))
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="text-muted fw-bold text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                                            <i class="fas fa-file-invoice-dollar me-1 text-primary"></i> Laporan Harta Kekayaan Penyelenggara Negara (LHKPN)
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($lhkpnItems as $doc)
                                                <a href="{{ $doc['url'] }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1.5 fw-bold d-inline-flex align-items-center gap-1.5" style="font-size: 11.5px;">
                                                    <i class="fas fa-file-pdf text-danger"></i> {{ strtoupper($doc['judul']) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Data pejabat sedang dalam pemutakhiran berkala.</p>
                </div>
                @endforelse
            </div>

        </div>
        <!-- AKHIR CONTENT-CARD PEJABAT -->

        <!-- SECTION STATISTIK KEPEGAWAIAN PKTJ (E.8 AKIP 2026) -->
        <div class="content-card mt-5" id="statistik-pegawai" data-aos="fade-up">
            <!-- Header Section -->
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 pb-4 mb-4 border-bottom">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-primary-subtle text-primary border border-primary-subtle fw-bold mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                        <i class="fas fa-users-cog"></i> DATA STATISTIK SUMBER DAYA MANUSIA
                    </div>
                    <h3 class="fw-bold outfit text-[#002b5c] mb-1">
                        <i class="fas fa-chart-pie text-[#004a99] me-2"></i>Statistik Kepegawaian Politeknik Keselamatan Transportasi Jalan
                    </h3>
                    <p class="text-muted small mb-0">
                        Komposisi resmi aparatur sipil negara dan tenaga penunjang berdasarkan Sistem Informasi Manajemen Kepegawaian (SIMPEG).
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold" style="font-size: 12px;">
                        <i class="fas fa-calendar-check me-1"></i> Data Terverifikasi TA 2025
                    </span>
                    <a href="{{ url('/profil/statistik-pegawai') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center gap-1.5" style="font-size: 12px;">
                        <i class="fas fa-chart-pie text-primary"></i> Halaman Statistik Lengkap
                    </a>
                </div>
            </div>

            <!-- Alert Notice Keterbukaan Informasi TA 2025 -->
            <div class="alert alert-warning border-0 rounded-4 p-3.5 mb-4 shadow-sm d-flex align-items-center gap-3" style="background: rgba(255, 193, 7, 0.12); border: 1px solid rgba(255, 193, 7, 0.35) !important;">
                <div class="w-10 h-10 rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center flex-shrink-0 fs-5 shadow-sm">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="small text-dark leading-relaxed">
                    <strong>Catatan Pemutakhiran Data:</strong> Data statistik kepegawaian di bawah ini merupakan data resmi terverifikasi per <strong>Tahun Anggaran 2025</strong>. Proses pemutakhiran statistik formasi <strong>Tahun Anggaran 2026</strong> sedang berlangsung mengikuti penataan formasi ASN dan keputusan Badan Pengembangan SDM Perhubungan.
                </div>
            </div>

            <!-- KPI Summary Cards (4 Cards) -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-lg-3">
                    <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex align-items-center gap-3" style="border-color: rgba(0, 74, 153, 0.15) !important;">
                        <div class="w-12 h-12 rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #002b5c, #004a99) !important; width: 48px; height: 48px;">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Total Pegawai</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 24px; line-height: 1.1;">174 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-primary fw-semibold" style="font-size: 11px;">100% Seluruh Unit</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex align-items-center gap-3" style="border-color: rgba(14, 165, 233, 0.2) !important;">
                        <div class="w-12 h-12 rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #0284c7, #38bdf8) !important; width: 48px; height: 48px;">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">PNS</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 24px; line-height: 1.1;">115 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-success fw-semibold" style="font-size: 11px;">66.1% Komposisi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex align-items-center gap-3" style="border-color: rgba(16, 185, 129, 0.2) !important;">
                        <div class="w-12 h-12 rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #059669, #10b981) !important; width: 48px; height: 48px;">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">PPPK (P3K)</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 24px; line-height: 1.1;">41 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-success fw-semibold" style="font-size: 11px;">23.6% Komposisi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex align-items-center gap-3" style="border-color: rgba(239, 68, 68, 0.2) !important;">
                        <div class="w-12 h-12 rounded-3 text-white d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="background: linear-gradient(135deg, #dc2626, #f87171) !important; width: 48px; height: 48px;">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div>
                            <div class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Non-ASN & CPNS</div>
                            <div class="fw-bold outfit text-dark" style="font-size: 24px; line-height: 1.1;">18 <span class="fs-6 fw-normal text-muted">Org</span></div>
                            <div class="text-muted fw-semibold" style="font-size: 11px;">17 Non-ASN, 1 CPNS</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section: 2 Columns -->
            <div class="row g-4 mb-5">
                <!-- Doughnut Chart: Komposisi Status Pegawai -->
                <div class="col-lg-5 col-12">
                    <div class="p-4 rounded-4 border bg-light h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                                <i class="fas fa-chart-pie me-2 text-primary"></i>Komposisi Status Pegawai
                            </h5>
                            <span class="badge bg-white text-dark border px-2.5 py-1 rounded-pill small">TA 2025</span>
                        </div>
                        <div style="height: 250px; position: relative;">
                            <canvas id="chartJenisPegawai"></canvas>
                        </div>
                        <div class="d-flex flex-wrap gap-2 justify-content-center mt-3 pt-2 border-top">
                            <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#0284c7;"></span> PNS: <strong>115</strong></span>
                            <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#10b981;"></span> PPPK: <strong>41</strong></span>
                            <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#ef4444;"></span> Non-ASN: <strong>17</strong></span>
                            <span class="badge rounded-pill text-dark border bg-white px-2.5 py-1.5"><span class="d-inline-block rounded-circle me-1" style="width:8px; height:8px; background:#a855f7;"></span> CPNS: <strong>1</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart: Tingkat Pendidikan -->
                <div class="col-lg-7 col-12">
                    <div class="p-4 rounded-4 border bg-light h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                                <i class="fas fa-graduation-cap me-2 text-primary"></i>Tingkat Pendidikan Terakhir
                            </h5>
                            <span class="badge bg-white text-dark border px-2.5 py-1 rounded-pill small">Pendidikan Akhir</span>
                        </div>
                        <div style="height: 250px; position: relative;">
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

            <!-- Bar Chart: Golongan Pegawai -->
            <div class="p-4 rounded-4 border bg-light mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold outfit text-[#002b5c] mb-0">
                        <i class="fas fa-layer-group me-2 text-primary"></i>Komposisi Golongan / Ruang Pegawai (TA 2025)
                    </h5>
                    <span class="badge bg-primary text-white px-3 py-1 rounded-pill small">Golongan II, III, IV & PPPK</span>
                </div>
                <div style="height: 280px; position: relative;">
                    <canvas id="chartGolonganPegawai"></canvas>
                </div>
            </div>

            <!-- Footer Section & Original Proof Preview Modal Trigger -->
            <div class="p-4 rounded-4 border bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="w-10 h-10 rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fs-5 flex-shrink-0" style="width: 40px; height: 40px;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Data Dukung Penilaian Keterbukaan Informasi Publik (AKIP 2026 - Indikator E.8)</div>
                        <div class="text-muted small">Tersedia tangkapan layar resmi sistem SIMPEG dan arsip pendukung kepegawaian Politeknik Keselamatan Transportasi Jalan.</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold btn-sm" onclick="openKepegawaianProofModal()">
                        <i class="fas fa-images me-1 text-primary"></i> Lihat Tangkapan Layar Resmi
                    </button>
                    <a href="{{ url('/profil/statistik-pegawai') }}" class="btn btn-primary rounded-pill px-3.5 py-2 fw-bold btn-sm shadow-sm">
                        <i class="fas fa-chart-line me-1"></i> Dashboard Statistik Pegawai
                    </a>
                </div>
            </div>

        </div>
        <!-- AKHIR SECTION STATISTIK KEPEGAWAIAN -->

    </div>

    <!-- LIGHTBOX MODAL UNTUK PREVIEW FOTO PEJABAT BESAR -->
    <div class="modal fade" id="pejabatPhotoLightbox" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
            <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden bg-dark text-white">
                <div class="modal-header border-0 pb-0 pe-3 pt-3">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4 pt-1">
                    <img id="lightboxImg" src="" alt="Foto Pejabat" class="img-fluid rounded-3 shadow mb-3" style="max-height: 70vh; object-fit: contain; border: 2px solid rgba(255,255,255,0.2);">
                    <h5 id="lightboxName" class="fw-bold outfit text-white mb-1"></h5>
                    <p id="lightboxRole" class="text-warning small mb-0 fw-semibold"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TANGKAPAN LAYAR RESMI SIMPEG KEPEGAWAIAN -->
    <div class="modal fade" id="kepegawaianProofModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden">
                <div class="modal-header bg-[#002b5c] text-white p-3.5">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-chart-bar text-warning fs-5"></i>
                        <h5 class="modal-title fw-bold outfit text-white mb-0">Tangkapan Layar Resmi SIMPEG PKTJ (TA 2025)</h5>
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

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, once: true });

        function openPejabatLightbox(imgUrl, name, role) {
            document.getElementById('lightboxImg').src = imgUrl;
            document.getElementById('lightboxName').textContent = name;
            document.getElementById('lightboxRole').textContent = role;
            new bootstrap.Modal(document.getElementById('pejabatPhotoLightbox')).show();
        }

        function openKepegawaianProofModal() {
            new bootstrap.Modal(document.getElementById('kepegawaianProofModal')).show();
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
