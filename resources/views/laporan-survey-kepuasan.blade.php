<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings['laporan_survey_judul_hero'] ?? 'Survei Kepuasan & Indeks Pelayanan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Hasil Indeks Kepuasan Masyarakat (IKM) dan Formulir Survei Kepuasan Layanan Informasi Publik PPID Politeknik Keselamatan Transportasi Jalan.">
    
    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004a99' }};
            --deep-navy: #002b5c;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#ffc107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero */
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.94) 0%, rgba(0, 74, 153, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 95px 0 115px;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            color: #ffd166;
            margin-bottom: 20px;
        }

        .content-card {
            background: white;
            padding: 40px;
            border-radius: 28px;
            box-shadow: 0 20px 50px rgba(0, 43, 92, 0.06);
            margin-top: -65px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 20;
            margin-bottom: 60px;
        }

        @media (max-width: 768px) {
            .content-card { padding: 24px 18px; margin-top: -45px; }
            .hero-section { padding: 75px 0 95px; }
        }

        /* Mode Selection Card */
        .source-pill-btn {
            border: 2px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            padding: 14px 24px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .source-pill-btn:hover {
            border-color: var(--primary-blue);
            background: #f0f7ff;
            color: var(--primary-blue);
        }

        .source-pill-btn.active {
            border-color: var(--deep-navy);
            background: var(--deep-navy);
            color: white;
            box-shadow: 0 6px 20px rgba(0, 43, 92, 0.2);
        }

        /* Rating Button */
        .rating-btn-group {
            display: flex;
            gap: 12px;
        }

        .rating-box-btn {
            flex: 1;
            padding: 14px 0;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            border-radius: 14px;
            font-weight: 800;
            font-size: 18px;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .rating-box-btn:hover {
            border-color: var(--secondary-gold);
            background: #fffdf0;
            color: #b45309;
            transform: translateY(-2px);
        }

        .rating-box-btn.active {
            border-color: var(--deep-navy);
            background: var(--deep-navy);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.25);
            transform: scale(1.05);
        }

        /* Radio Options */
        .custom-radio-card {
            display: block;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 18px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .custom-radio-card:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .custom-radio-card input:checked ~ span {
            font-weight: 700;
            color: var(--deep-navy);
        }

        .custom-radio-card.selected {
            border-color: var(--primary-blue);
            background: #f0f7ff;
        }

        /* Stat Cards */
        .stat-card-pro {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            height: 100%;
        }

        .stat-score-badge {
            font-size: 3rem;
            font-weight: 900;
            font-family: 'Outfit', sans-serif;
            color: var(--deep-navy);
            line-height: 1;
        }
    </style>
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <div class="hero-badge">
                <i class="fas fa-chart-line"></i> Survei Kepuasan Masyarakat (IKM)
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-3 tracking-tight">
                {{ $settings['laporan_survey_judul_hero'] ?? 'Survei Kepuasan Layanan PPID' }}
            </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 780px; font-size: 16px;">
                Bantu kami meningkatkan kualitas layanan informasi publik PKTJ Tegal dengan memberikan penilaian dan masukan Anda secara langsung.
            </p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">

            <!-- NAVIGATION SUB TABS -->
            <ul class="nav nav-pills nav-justified mb-5 p-1.5 bg-light rounded-4 border" id="surveyMainTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-4 fw-bold py-3" id="tabFormBtn" data-bs-toggle="pill" data-bs-target="#surveyFormSection" type="button" role="tab">
                        <i class="fas fa-edit me-2"></i> Isi Survei Kepuasan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-4 fw-bold py-3" id="tabStatsBtn" data-bs-toggle="pill" data-bs-target="#surveyStatsSection" type="button" role="tab">
                        <i class="fas fa-chart-pie me-2"></i> Dashboard & Laporan IKM
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="surveyMainTabsContent">
                
                <!-- 1. FORMULIR PENGISIAN SURVEI (2 JALUR) -->
                <div class="tab-pane fade show active" id="surveyFormSection" role="tabpanel">
                    
                    <div id="surveySuccessAlert" class="alert alert-success d-none rounded-4 p-4 mb-4 border-0 shadow-sm" style="background: #ecfdf5; border-left: 6px solid #10b981 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Terima Kasih Atas Partisipasi Anda!</h5>
                                <p class="text-secondary small mb-0" id="surveySuccessMsg">Survei Anda telah berhasil dikirim dan hasil statistik kepuasan langsung diperbarui secara real-time.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 text-center">
                        <span class="badge bg-primary text-white px-3 py-1.5 rounded-pill text-uppercase font-black" style="font-size: 11px; letter-spacing: 0.5px;">Formulir Evaluasi</span>
                        <h3 class="fw-bold outfit text-dark mt-2 mb-1" style="color: #002b5c !important;">Isi Survei Kepuasan Layanan</h3>
                        <p class="text-muted small">Pilih saluran yang Anda gunakan untuk mendapatkan layanan informasi publik PKTJ:</p>
                    </div>

                    <!-- STEP 1: PILIH SUMBER INFORMASI (Website PPID vs Media Sosial) -->
                    <div class="row g-3 mb-5 max-w-xl mx-auto" style="max-width: 650px;">
                        <div class="col-6">
                            <button type="button" class="source-pill-btn active" id="btnSourceWebsite" onclick="selectSource('website')">
                                <i class="fas fa-globe text-primary fa-lg"></i>
                                <span>Website PPID</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="source-pill-btn" id="btnSourceSosmed" onclick="selectSource('sosial_media')">
                                <i class="fas fa-share-alt text-info fa-lg"></i>
                                <span>Media Sosial</span>
                            </button>
                        </div>
                    </div>

                    <form id="publicSurveyForm" action="{{ route('survey.store') }}" method="POST" onsubmit="submitSurvey(event)" class="mx-auto" style="max-width: 800px;">
                        @csrf
                        <input type="hidden" name="sumber_informasi" id="inputSumberInformasi" value="website">
                        <input type="hidden" name="rating" id="inputRatingValue" value="5">

                        <!-- JALUR 1: WEBSITE PPID FORM -->
                        <div id="sectionWebsiteForm" class="space-y-4">
                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-1">Mendapatkan informasi melalui apa? <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg bg-light" value="Website PPID" readonly>
                                <div class="text-muted small mt-1.5" style="font-size: 12.5px;">
                                    Masukkan nomor registrasi permohonan Anda untuk mengisi survei kepuasan layanan.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-1">Nomor Registrasi / Tiket Permohonan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="nomor_registrasi" id="inputNomorRegistrasi" class="form-control form-control-lg" placeholder="Contoh: PI-20250101001 atau REQ-001" required>
                                    <button class="btn btn-primary px-4 fw-bold" type="button" id="btnCekRegistrasi" onclick="checkRegNumber()" style="background: #004a99;">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </div>
                                <div id="regStatusMsg" class="mt-2 small"></div>
                            </div>
                        </div>

                        <!-- JALUR 2: MEDIA SOSIAL FORM -->
                        <div id="sectionSosmedForm" class="space-y-4 d-none">
                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-1">Mendapatkan informasi melalui apa? <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg bg-light" value="Media Sosial (Instagram / Facebook / YouTube / X)" readonly>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-1">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="inputNamaSosmed" class="form-control form-control-lg" placeholder="Masukkan nama Anda">
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-2 d-block">Usia <span class="text-danger">*</span></label>
                                <div class="row g-2">
                                    @foreach(['< 20 Tahun', '21-30 Tahun', '31-40 Tahun', '> 41 Tahun'] as $usiaOpt)
                                    <div class="col-sm-6 col-md-3">
                                        <label class="custom-radio-card text-center">
                                            <input type="radio" name="usia" value="{{ $usiaOpt }}" class="me-1.5" {{ $loop->first ? 'checked' : '' }}>
                                            <span class="small">{{ $usiaOpt }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-2 d-block">Kemudahan prosedur pelayanan informasi di PPID PKTJ <span class="text-danger">*</span></label>
                                <div class="space-y-2">
                                    @foreach(['Sangat Mudah', 'Mudah', 'Kurang Mudah', 'Tidak Mudah'] as $mudahOpt)
                                    <label class="custom-radio-card d-flex align-items-center">
                                        <input type="radio" name="kemudahan_prosedur" value="{{ $mudahOpt }}" class="me-2" {{ $loop->first ? 'checked' : '' }}>
                                        <span class="small">{{ $mudahOpt }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-dark small mb-2 d-block">Kesesuaian jawaban dengan permohonan informasi yang diajukan <span class="text-danger">*</span></label>
                                <div class="space-y-2">
                                    @foreach(['Sangat Sesuai', 'Sesuai', 'Kurang Sesuai', 'Tidak Sesuai'] as $sesuaiOpt)
                                    <label class="custom-radio-card d-flex align-items-center">
                                        <input type="radio" name="kesesuaian_jawaban" value="{{ $sesuaiOpt }}" class="me-2" {{ $loop->first ? 'checked' : '' }}>
                                        <span class="small">{{ $sesuaiOpt }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- PERTANYAAN UMUM BERSAMA -->
                        <div class="mb-4">
                            <label class="fw-bold text-dark small mb-1">Informasi yang diterima?</label>
                            <textarea name="informasi_diterima" rows="3" class="form-control" placeholder="Tuliskan informasi yang Anda terima dari layanan PPID PKTJ..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="fw-bold text-dark small mb-2 d-block">User interface / User Experience dari portal layanan informasi <span class="text-danger">*</span></label>
                            <div class="space-y-2">
                                @foreach([
                                    'Sangat menarik dan sangat mudah dipahami',
                                    'Menarik dan mudah dipahami',
                                    'Kurang menarik dan kurang dapat dipahami',
                                    'Tidak menarik dan tidak dapat dipahami'
                                ] as $uiOpt)
                                <label class="custom-radio-card d-flex align-items-center">
                                    <input type="radio" name="ui_ux" value="{{ $uiOpt }}" class="me-2" {{ $loop->first ? 'checked' : '' }}>
                                    <span class="small">{{ $uiOpt }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- RATING 1 - 5 -->
                        <div class="mb-4 p-4 rounded-3 border" style="background: #fbfcfe;">
                            <label class="fw-bold text-dark small mb-1 d-block">Rating layanan permohonan informasi publik (1-5) <span class="text-danger">*</span></label>
                            <p class="text-muted small mb-3">Angka terkecil (1) = Tidak Baik, Angka terbesar (5) = Sangat Baik</p>
                            
                            <div class="rating-btn-group">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="rating-box-btn {{ $i === 5 ? 'active' : '' }}" onclick="selectRating({{ $i }})">
                                    {{ $i }}
                                </button>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="fw-bold text-dark small mb-1">Masukan, saran, atau keluhan Anda</label>
                            <textarea name="saran_masukan" rows="4" class="form-control" placeholder="Tuliskan masukan, saran, atau keluhan Anda untuk peningkatan pelayanan..."></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-3 border-top gap-3">
                            <button type="reset" class="btn btn-light px-4 py-2.5 fw-bold rounded-pill text-muted">
                                Batal
                            </button>
                            <button type="submit" id="btnSubmitSurvey" class="btn btn-primary px-5 py-3 fw-bold rounded-pill shadow-lg" style="background: #004a99; font-size: 15px;">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Survei Kepuasan
                            </button>
                        </div>
                    </form>

                </div>

                <!-- 2. DASHBOARD LIVE STATISTIK & LAPORAN RESMI (IKM) -->
                <div class="tab-pane fade" id="surveyStatsSection" role="tabpanel">
                    
                    <div class="mb-5 text-center">
                        <span class="badge bg-success text-white px-3 py-1.5 rounded-pill text-uppercase font-black" style="font-size: 11px;">Real-Time IKM</span>
                        <h3 class="fw-bold outfit text-dark mt-2 mb-1" style="color: #002b5c !important;">Hasil Indeks Kepuasan Masyarakat (IKM)</h3>
                        <p class="text-muted small">Statistik evaluasi kepuasan pemohon informasi publik PKTJ Tegal yang terhitung otomatis dari basis data survei.</p>
                    </div>

                    <!-- TOP SCORE ROW -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="stat-card-pro text-center">
                                <div class="text-muted small fw-bold text-uppercase mb-2">Nilai Rata-Rata Kepuasan</div>
                                <div class="stat-score-badge" id="statAvgRating">{{ number_format($stats['avg_rating'], 1) }}</div>
                                <div class="text-warning my-2" style="font-size: 1.25rem;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="badge bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-pill" style="font-size: 12px; background: #d1fae5; color: #065f46;">
                                    Kategori: Sangat Baik (A)
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stat-card-pro text-center">
                                <div class="text-muted small fw-bold text-uppercase mb-2">Persentase Kepuasan</div>
                                <div class="stat-score-badge text-primary" id="statPercent">{{ number_format($stats['kepuasan_percent'], 1) }}%</div>
                                <div class="progress mt-3 mb-2 rounded-pill" style="height: 10px;">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="statProgressBar" style="width: {{ $stats['kepuasan_percent'] }}%"></div>
                                </div>
                                <p class="text-muted small mb-0">Tingkat kepuasan responden keseluruhan</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stat-card-pro text-center">
                                <div class="text-muted small fw-bold text-uppercase mb-2">Total Responden Masuk</div>
                                <div class="stat-score-badge text-dark" id="statTotalResponses">{{ $stats['total_responses'] }}</div>
                                <div class="text-muted small my-2">Partisipasi Masyarakat & Pemohon</div>
                                <span class="badge bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-pill" style="font-size: 12px;">
                                    <i class="fas fa-sync-alt fa-spin me-1"></i> Terhubung Langsung
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- CHARTS GRID -->
                    <div class="row g-4 mb-5">
                        <div class="col-lg-6">
                            <div class="stat-card-pro">
                                <h6 class="fw-bold outfit text-dark mb-3"><i class="fas fa-users text-primary me-2"></i>Distribusi Usia Responden</h6>
                                <div style="height: 250px;">
                                    <canvas id="chartUsia"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="stat-card-pro">
                                <h6 class="fw-bold outfit text-dark mb-3"><i class="fas fa-tasks text-success me-2"></i>Kemudahan Prosedur Layanan</h6>
                                <div style="height: 250px;">
                                    <canvas id="chartKemudahan"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="stat-card-pro">
                                <h6 class="fw-bold outfit text-dark mb-3"><i class="fas fa-check-double text-info me-2"></i>Kesesuaian Jawaban Informasi</h6>
                                <div style="height: 250px;">
                                    <canvas id="chartKesesuaian"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="stat-card-pro">
                                <h6 class="fw-bold outfit text-dark mb-3"><i class="fas fa-star text-warning me-2"></i>Sebaran Rating Bintang (1 - 5)</h6>
                                <div style="height: 250px;">
                                    <canvas id="chartRating"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DOKUMEN LAPORAN RESMI TAHUNAN -->
                    <div class="pt-5 border-top">
                        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                            <div>
                                <h4 class="fw-bold outfit text-dark mb-1" style="color: #002b5c !important;">
                                    <i class="fas fa-file-pdf text-danger me-2"></i> Dokumen Laporan Survei Resmi PKTJ
                                </h4>
                                <p class="text-muted small mb-0">Arsip laporan Indeks Kepuasan Masyarakat (IKM) resmi yang telah disahkan.</p>
                            </div>
                        </div>

                        @if(isset($laporan) && $laporan->count() > 0)
                            <div class="row g-3">
                                @foreach($laporan as $lap)
                                <div class="col-md-6">
                                    <div class="p-3.5 bg-light rounded-4 border d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-white p-2.5 rounded-3 border text-danger shadow-sm">
                                                <i class="fas fa-file-pdf fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0.5" style="font-size: 13.5px;">{{ $lap->judul }}</h6>
                                                <span class="text-muted small" style="font-size: 11px;">{{ $lap->tanggal ? $lap->tanggal->format('d M Y') : 'Tersedia' }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('dokumen.download', $lap->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" style="font-size: 12px; background: #004a99;">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 bg-light rounded-4 border text-center text-muted small">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block opacity-40"></i>
                                Laporan resmi survei kepuasan periode 2025/2026 sedang dalam proses pengesahan.
                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({duration: 800, once: true});

        let currentSource = 'website';
        let currentRating = 5;

        function selectSource(source) {
            currentSource = source;
            document.getElementById('inputSumberInformasi').value = source;

            const btnWeb = document.getElementById('btnSourceWebsite');
            const btnSosmed = document.getElementById('btnSourceSosmed');
            const secWeb = document.getElementById('sectionWebsiteForm');
            const secSosmed = document.getElementById('sectionSosmedForm');

            if (source === 'website') {
                btnWeb.classList.add('active');
                btnSosmed.classList.remove('active');
                secWeb.classList.remove('d-none');
                secSosmed.classList.add('d-none');
                document.getElementById('inputNomorRegistrasi').required = true;
                document.getElementById('inputNamaSosmed').required = false;
            } else {
                btnSosmed.classList.add('active');
                btnWeb.classList.remove('active');
                secSosmed.classList.remove('d-none');
                secWeb.classList.add('d-none');
                document.getElementById('inputNomorRegistrasi').required = false;
                document.getElementById('inputNamaSosmed').required = true;
            }
        }

        function selectRating(val) {
            currentRating = val;
            document.getElementById('inputRatingValue').value = val;
            document.querySelectorAll('.rating-box-btn').forEach((btn, idx) => {
                if (idx + 1 === val) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        async function checkRegNumber() {
            const regInput = document.getElementById('inputNomorRegistrasi').value.trim();
            const statusDiv = document.getElementById('regStatusMsg');
            if (!regInput) {
                statusDiv.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Mohon isi nomor registrasi Anda terlebih dahulu.</span>';
                return;
            }

            statusDiv.innerHTML = '<span class="text-primary"><i class="fas fa-spinner fa-spin"></i> Memeriksa status tiket...</span>';

            try {
                const res = await fetch("{{ route('survey.check-registrasi') }}?nomor_registrasi=" + encodeURIComponent(regInput));
                const data = await res.json();
                if (data.verified) {
                    statusDiv.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check-circle"></i> Terverifikasi: ${data.info.nama} (${data.info.status})</span>`;
                } else {
                    statusDiv.innerHTML = `<span class="text-success"><i class="fas fa-check-circle"></i> Nomor registrasi diterima untuk pengisian survei.</span>`;
                }
            } catch (err) {
                statusDiv.innerHTML = `<span class="text-success"><i class="fas fa-check-circle"></i> Nomor registrasi siap disimpan.</span>`;
            }
        }

        async function submitSurvey(e) {
            e.preventDefault();
            const form = document.getElementById('publicSurveyForm');
            const btnSubmit = document.getElementById('btnSubmitSurvey');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirimkan Survei...';

            const formData = new FormData(form);

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await res.json();
                if (result.status === 'success') {
                    document.getElementById('surveySuccessAlert').classList.remove('d-none');
                    document.getElementById('surveySuccessMsg').innerText = result.message;
                    form.reset();
                    selectRating(5);
                    window.scrollTo({ top: 150, behavior: 'smooth' });

                    // Update live dashboard stats if returned
                    if (result.stats) {
                        updateLiveDashboard(result.stats);
                    }
                }
            } catch (error) {
                // Fallback normal submit
                form.submit();
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Kirim Survei Kepuasan';
            }
        }

        // ==========================================
        // CHART.JS INITIALIZATION & LIVE UPDATES
        // ==========================================
        let statsData = @json($stats);
        let chartUsiaInstance, chartKemudahanInstance, chartKesesuaianInstance, chartRatingInstance;

        function initCharts() {
            // Usia
            const ctxUsia = document.getElementById('chartUsia');
            if (ctxUsia) {
                chartUsiaInstance = new Chart(ctxUsia, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(statsData.usia_data),
                        datasets: [{
                            data: Object.values(statsData.usia_data),
                            backgroundColor: ['#004a99', '#38bdf8', '#fbbf24', '#34d399']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }

            // Kemudahan
            const ctxKemudahan = document.getElementById('chartKemudahan');
            if (ctxKemudahan) {
                chartKemudahanInstance = new Chart(ctxKemudahan, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(statsData.kemudahan_data),
                        datasets: [{
                            label: 'Jumlah Responden',
                            data: Object.values(statsData.kemudahan_data),
                            backgroundColor: '#004a99',
                            borderRadius: 8
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                });
            }

            // Kesesuaian
            const ctxKesesuaian = document.getElementById('chartKesesuaian');
            if (ctxKesesuaian) {
                chartKesesuaianInstance = new Chart(ctxKesesuaian, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(statsData.kesesuaian_data),
                        datasets: [{
                            data: Object.values(statsData.kesesuaian_data),
                            backgroundColor: ['#10b981', '#60a5fa', '#f59e0b', '#ef4444']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }

            // Rating
            const ctxRating = document.getElementById('chartRating');
            if (ctxRating) {
                chartRatingInstance = new Chart(ctxRating, {
                    type: 'bar',
                    data: {
                        labels: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5'],
                        datasets: [{
                            label: 'Responden',
                            data: [
                                statsData.rating_data['1'] || 0,
                                statsData.rating_data['2'] || 0,
                                statsData.rating_data['3'] || 0,
                                statsData.rating_data['4'] || 0,
                                statsData.rating_data['5'] || 0
                            ],
                            backgroundColor: '#fbbf24',
                            borderRadius: 8
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                });
            }
        }

        function updateLiveDashboard(newStats) {
            document.getElementById('statAvgRating').innerText = newStats.avg_rating.toFixed(1);
            document.getElementById('statPercent').innerText = newStats.kepuasan_percent.toFixed(1) + '%';
            document.getElementById('statProgressBar').style.width = newStats.kepuasan_percent + '%';
            document.getElementById('statTotalResponses').innerText = newStats.total_responses;

            if (chartUsiaInstance) {
                chartUsiaInstance.data.datasets[0].data = Object.values(newStats.usia_data);
                chartUsiaInstance.update();
            }
            if (chartKemudahanInstance) {
                chartKemudahanInstance.data.datasets[0].data = Object.values(newStats.kemudahan_data);
                chartKemudahanInstance.update();
            }
            if (chartKesesuaianInstance) {
                chartKesesuaianInstance.data.datasets[0].data = Object.values(newStats.kesesuaian_data);
                chartKesesuaianInstance.update();
            }
            if (chartRatingInstance) {
                chartRatingInstance.data.datasets[0].data = [
                    newStats.rating_data['1'] || 0,
                    newStats.rating_data['2'] || 0,
                    newStats.rating_data['3'] || 0,
                    newStats.rating_data['4'] || 0,
                    newStats.rating_data['5'] || 0
                ];
                chartRatingInstance.update();
            }
        }

        document.addEventListener('DOMContentLoaded', initCharts);
    </script>
</body>
</html>
