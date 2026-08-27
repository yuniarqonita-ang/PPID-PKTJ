<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Profil PPID PKTJ Tegal' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --deep-navy: #002b5c;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f1f5f9; 
            color: #1e293b;
            line-height: 1.7;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* HERO SECTION */
        .hero-profil {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.95) 0%, rgba(0, 74, 153, 0.90) 100%), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 90px 0 110px;
            color: white;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 22px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(12px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            color: #ffd166;
            margin-bottom: 18px;
        }

        /* FLOATING PILLARS */
        .pillars-grid {
            margin-top: -50px;
            position: relative;
            z-index: 25;
            margin-bottom: 35px;
        }

        .pillar-card {
            background: white;
            border-radius: 20px;
            padding: 22px 20px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
            height: 100%;
        }

        .pillar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(0, 43, 92, 0.12);
            border-color: #cbd5e1;
        }

        .pillar-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 14px;
        }

        /* MAIN CONTENT CARD */
        .main-profil-card {
            background: white;
            padding: 45px;
            border-radius: 28px;
            box-shadow: 0 15px 45px rgba(0, 43, 92, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.9);
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .main-profil-card { padding: 25px 20px; }
            .hero-profil { padding: 75px 0 95px; }
        }

        .section-header-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 18px;
            background: #eef2ff;
            color: #002b5c;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .service-channel-box {
            background: #f8fafc;
            border-radius: 20px;
            padding: 26px;
            border: 1px solid #e2e8f0;
            height: 100%;
            transition: all 0.3s ease;
        }

        .service-channel-box:hover {
            background: white;
            box-shadow: 0 12px 30px rgba(0, 43, 92, 0.08);
            border-color: var(--primary-blue);
        }

        .channel-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .btn-download-profile {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white !important;
            border-radius: 14px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(0, 74, 153, 0.25);
            transition: all 0.3s ease;
        }

        .btn-download-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.35);
        }
    </style>
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <!-- HERO -->
    <div class="hero-profil">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="hero-badge" data-aos="fade-down">
                <i class="fas fa-shield-alt text-warning"></i> Mengenal Pejabat Pengelola Informasi & Dokumentasi
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-3 tracking-tight" data-aos="fade-up">
                {{ $profil->judul ?? 'Profil PPID PKTJ Tegal' }}
            </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 800px; font-size: 16px;" data-aos="fade-up" data-aos-delay="100">
                {{ $profil->tagline_hero ?? 'Keterbukaan Informasi Publik Menuju Tata Kelola Pendidikan Vokasi yang Transparan, Akuntabel, dan Bebas Korupsi.' }}
            </p>
        </div>
    </div>

    <div class="container">
        
        <!-- 1. FLOATING 4 PILLARS -->
        <div class="pillars-grid" data-aos="fade-up">
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="pillar-card">
                        <div class="pillar-icon" style="background: #e0e7ff; color: #3730a3;">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h6 class="outfit fw-bold text-dark mb-1" style="font-size: 14.5px;">Amanat Regulasi</h6>
                        <p class="text-muted small mb-0" style="font-size: 12px;">Berlandaskan UU No. 14/2008 & Peraturan Menhub No. PM 46/2018.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pillar-card">
                        <div class="pillar-icon" style="background: #dcfce7; color: #15803d;">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h6 class="outfit fw-bold text-dark mb-1" style="font-size: 14.5px;">Biaya Rp 0 (Gratis)</h6>
                        <p class="text-muted small mb-0" style="font-size: 12px;">Seluruh permohonan dan dokumen informasi bebas biaya tarif.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pillar-card">
                        <div class="pillar-icon" style="background: #fef3c7; color: #b45309;">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <h6 class="outfit fw-bold text-dark mb-1" style="font-size: 14.5px;">Waktu Respon Cepat</h6>
                        <p class="text-muted small mb-0" style="font-size: 12px;">Standar penyelesaian permohonan 10 hari kerja (+7 hari perpanjangan).</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pillar-card">
                        <div class="pillar-icon" style="background: #e0f2fe; color: #0284c7;">
                            <i class="fas fa-universal-access"></i>
                        </div>
                        <h6 class="outfit fw-bold text-dark mb-1" style="font-size: 14.5px;">Akses Inklusif</h6>
                        <p class="text-muted small mb-0" style="font-size: 12px;">Dukungan aksesibilitas difabel (Text-to-Speech, Bisindo, Braille).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. MAIN PROFIL NARRATIVE -->
        <div class="main-profil-card" data-aos="fade-up" data-aos-delay="100">
            
            <!-- SECTION 1: LATAR BELAKANG -->
            <div class="mb-5">
                <div class="section-header-pill">
                    <i class="fas fa-landmark text-primary"></i> Latar Belakang & Komitmen Institusi
                </div>
                <div class="rich-content text-justify" style="font-size: 15px; color: #334155; line-height: 1.8;">
                    @if(!empty($profil->konten_pembuka))
                        {!! $profil->konten_pembuka !!}
                    @else
                        <p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai wujud komitmen nyata institusi dalam mengimplementasikan keterbukaan informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Peraturan Komisi Informasi (PerKI) Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik, serta Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
                        <p>Sebagai Unit Pelaksana Teknis (UPT) Pendidikan Tinggi Vokasi di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ menetapkan struktur PPID Pelaksana UPT melalui Surat Keputusan Direktur PKTJ. Pembentukan ini bertujuan memberikan kepastian hak bagi masyarakat, pemohon informasi, dan seluruh pemangku kepentingan untuk memperoleh informasi publik yang cepat, akurat, transparan, dan bebas biaya (Rp 0).</p>
                    @endif
                </div>
            </div>

            <!-- SECTION 2: PERAN & TUGAS FUNGSI DALAM MENDUKUNG PKTJ -->
            <div class="mb-5">
                <div class="section-header-pill" style="background: #fef3c7; color: #92400e;">
                    <i class="fas fa-bullseye text-warning"></i> {{ $profil->judul_sub ?? 'Peran & Dukungan Tugas Fungsi PKTJ' }}
                </div>
                <div class="rich-content text-justify" style="font-size: 15px; color: #334155; line-height: 1.8;">
                    @if(!empty($profil->konten_detail))
                        {!! $profil->konten_detail !!}
                    @else
                        <p>Dalam menjalankan perannya, PPID Pelaksana PKTJ berfungsi sebagai koordinator utama pengelolaan dan pelayanan dokumentasi informasi publik yang mendukung penyelenggaraan tridharma perguruan tinggi vokasi keselamatan transportasi jalan, pelaksanaan uji kompetensi teknis, penelitian keselamatan transportasi, serta pengelolaan tata kelola keuangan Badan Layanan Umum (BLU) yang bersih, transparan, dan akuntabel.</p>
                    @endif
                </div>
            </div>

            <!-- SECTION 3: DUA KANAL SALURAN LAYANAN UTAMA -->
            <div class="mb-5">
                <div class="section-header-pill" style="background: #e0f2fe; color: #0369a1;">
                    <i class="fas fa-network-wired text-info"></i> Kanal Saluran Layanan PPID PKTJ
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <div class="service-channel-box">
                            <div class="channel-icon" style="background: #e0f2fe; color: #0284c7;">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h5 class="outfit fw-bold text-dark mb-2">1. Layanan Daring (Online Portal)</h5>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Melalui portal mandiri <strong>ppid.pktj.ac.id</strong> yang siap diakses 24/7, dilengkapi permohonan informasi digital, pengajuan keberatan, dan fitur ramah disabilitas (Text-to-Speech audio, kontras warna, video Bisindo).
                            </p>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                                Jelajahi Portal <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-channel-box">
                            <div class="channel-icon" style="background: #fef3c7; color: #b45309;">
                                <i class="fas fa-building"></i>
                            </div>
                            <h5 class="outfit fw-bold text-dark mb-2">2. Meja Layanan Fisik (Luring / Offline)</h5>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Meja Layanan Terpadu PPID di <strong>Kampus I PKTJ Tegal</strong>, Jl. Perintis Kemerdekaan No. 17, Kota Tegal. Dilengkapi sarana komputer akses publik, ruang tunggu nyaman, dan formulir permohonan cetak & Braille.
                            </p>
                            <div class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill font-monospace" style="font-size: 11.5px;">
                                <i class="far fa-clock me-1 text-primary"></i> Senin-Jumat: 08.00 - 15.30 WIB
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: GAMBAR ATAU DOKUMEN PREVIEW -->
            @if(!empty($profil->gambar))
                <div class="my-5 text-center">
                    <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="img-fluid rounded-4 shadow-sm border" style="max-height: 450px;">
                </div>
            @endif

            @if(!empty($profil->link_dokumen) && is_previewable($profil->link_dokumen))
                <div class="text-center mt-5 pt-3">
                    <a href="{{ route('preview.dokumen', ['file' => $profil->link_dokumen, 'title' => 'Dokumen Profil Lengkap PPID']) }}" class="btn-download-profile">
                        <i class="fas fa-file-pdf fs-5"></i> Lihat Dokumen Profil Resmi Lengkap (PDF)
                    </a>
                </div>
            @endif

            <!-- FOOTNOTE BANNER -->
            <div class="mt-5 pt-4 border-top">
                <div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-4 mb-0" style="background: #eef2ff; color: #002b5c;">
                    <i class="fas fa-award fa-2x me-3 text-primary"></i>
                    <div>
                        <strong class="d-block mb-1">Standar Layanan Prima & Keterbukaan Informasi Publik:</strong>
                        PPID Politeknik Keselamatan Transportasi Jalan berkomitmen penuh menjaga integritas, profesionalisme, kecepatan respon, dan kemudahan akses bagi seluruh pemohon informasi publik.
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>
