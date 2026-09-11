<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Visi & Misi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8faff; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

                /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 74, 153, 0.05);
            margin-top: -60px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            position: relative;
            z-index: 20;
            margin-bottom: 50px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 30px;
            border-left: 6px solid var(--secondary-gold);
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }

        .text-justify { text-align: justify; }

        .vision-box {
            background: #f1f5f9;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            border-bottom: 4px solid var(--secondary-gold);
        }
    </style>
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Visi & Misi' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Landasan Perjuangan PPID PKTJ dalam Layanan Informasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @if($profil)
                @php
                    $videoUrl = $settings['visi_youtube_link'] ?? null;
                    $embedUrl = null;
                    if ($videoUrl) {
                        $videoUrl = trim($videoUrl);
                        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/i';
                        if (preg_match($pattern, $videoUrl, $matches)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $matches[1];
                        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoUrl)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $videoUrl;
                        }
                    }
                @endphp

                @if($embedUrl)
                    <div class="video-container mb-5 rounded-4 overflow-hidden shadow-sm border border-slate-100">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <div class="rich-content">
                    @if($profil->konten_pembuka)
                        <div class="text-justify mb-4">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    @endif
                    
                    @if($profil->judul_sub)
                        <h3 class="outfit fw-bold text-dark mb-3 mt-5">{{ $profil->judul_sub }}</h3>
                    @endif
                    
                    @if($profil->konten_detail)
                        <div class="text-justify mb-4">
                            {!! $profil->konten_detail !!}
                        </div>
                    @endif
                </div>

                @if($profil->additional_sections)
                    <div class="mt-5">
                        @foreach($profil->additional_sections as $section)
                            <div class="p-4 bg-light rounded-4 border mb-3">
                                @if($section['title'] ?? null)
                                    <h4 class="outfit fw-bold text-blue-900 mb-2">{{ $section['title'] }}</h4>
                                @endif
                                @if($section['content'] ?? null)
                                    <div class="rich-content">
                                        {!! $section['content'] !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                
                @if($profil->gambaran)
                    <div class="mt-5 pt-4 border-top">
                        <div class="rich-content">
                            {!! $profil->gambaran !!}
                        </div>
                    </div>
                @endif
            @else
                <!-- FALLBACK KONTEN VISI & MISI RESMI PPID PKTJ -->
                <div class="vision-banner p-4 p-md-5 rounded-4 text-center mb-5" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); color: white; border: 2px solid rgba(255, 193, 7, 0.3);">
                    <div class="badge bg-warning text-dark px-3.5 py-2 rounded-pill fw-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
                        <i class="fas fa-compass me-1.5"></i> Visi PPID PKTJ Tegal
                    </div>
                    <h3 class="outfit fw-black text-white mb-3" style="font-size: 1.85rem; line-height: 1.4;">
                        "Terwujudnya Pelayanan Informasi Publik Politeknik Keselamatan Transportasi Jalan yang Transparan, Objektif, dan Prima Guna Mendukung Tata Kelola Pendidikan Tinggi Vokasi yang Berintegritas dan Berkelanjutan"
                    </h3>
                    <p class="text-white text-opacity-85 mb-0 mx-auto" style="max-width: 850px; font-size: 14.5px;">
                        Berlandaskan semangat keterbukaan informasi dan pelayanan prima di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan Republik Indonesia.
                    </p>
                </div>

                <div class="misi-section mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #e0e7ff; color: #002b5c; font-size: 20px;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div>
                            <h4 class="outfit fw-bold text-dark mb-0" style="font-size: 1.45rem;">Misi Pelayanan Informasi Publik</h4>
                            <span class="text-muted small">Empat pilar pelaksanaan mandat keterbukaan informasi di lingkungan PKTJ Tegal</span>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">1</span>
                                <div>
                                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Pelayanan Cepat, Tepat Waktu & Bebas Biaya (Rp 0)</strong>
                                    <p class="text-muted small mb-0" style="line-height: 1.6;">Menyelenggarakan pelayanan informasi publik yang profesional, cepat, proporsional, dan tanpa pungutan biaya sesuai standar perundang-undangan KIP.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">2</span>
                                <div>
                                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Modernisasi Sistem Digital & Aksesibilitas Disabilitas</strong>
                                    <p class="text-muted small mb-0" style="line-height: 1.6;">Membangun dan mengembangkan infrastruktur portal informasi publik mandiri yang mudah diakses 24/7 serta dilengkapi fasilitas inklusif bagi penyandang disabilitas.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">3</span>
                                <div>
                                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Peningkatan Kompetensi & Integritas Pengelola</strong>
                                    <p class="text-muted small mb-0" style="line-height: 1.6;">Meningkatkan kualitas sumber daya manusia pengelola PPID PKTJ melalui bimbingan teknis, pelatihan kearsipan, dan penguatan integritas anti-korupsi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">4</span>
                                <div>
                                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Sinergi Tata Kelola Kemenhub Terintegrasi</strong>
                                    <p class="text-muted small mb-0" style="line-height: 1.6;">Memperkuat koordinasi dan harmonisasi pengelolaan data satu pintu antara PPID UPT PKTJ Tegal, PPID BPSDM Perhubungan, dan PPID Utama Kementerian Perhubungan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="principles-section mt-5 pt-4 border-top">
                    <div class="text-center mb-4">
                        <span class="badge bg-light text-primary border px-3 py-1.5 rounded-pill fw-bold text-uppercase" style="font-size: 11.5px; letter-spacing: 1px;">
                            <i class="fas fa-gem text-warning me-1"></i> Nilai-Nilai Dasar Pelayanan
                        </span>
                        <h3 class="outfit fw-black text-dark mt-2 mb-1" style="font-size: 1.75rem;">Prinsip Utama: Transparan, Objektif, dan Prima</h3>
                        <p class="text-muted small mx-auto mb-0" style="max-width: 700px;">Komitmen penyelenggaraan keterbukaan informasi publik di Politeknik Keselamatan Transportasi Jalan Tegal</p>
                    </div>

                    <div class="row g-4">
                        <!-- 1. TRANSPARAN -->
                        <div class="col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #0284c7 !important;">
                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(2, 132, 199, 0.12); color: #0284c7; font-size: 26px;">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">TRANSPARAN</h4>
                                <div class="badge bg-info bg-opacity-25 text-info px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Keterbukaan Berintegritas</div>
                                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                                    Memberikan akses terbuka, mudah, dan seluas-luasnya kepada masyarakat dan pemohon informasi publik mengenai penyelenggaraan pendidikan vokasi, realisasi anggaran DIPA, pengadaan barang dan jasa, serta akuntabilitas kinerja PKTJ Tegal tanpa birokrasi yang berbelit.
                                </p>
                            </div>
                        </div>

                        <!-- 2. OBJEKTIF -->
                        <div class="col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #16a34a !important;">
                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(22, 163, 74, 0.12); color: #16a34a; font-size: 26px;">
                                    <i class="fas fa-scale-balanced"></i>
                                </div>
                                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">OBJEKTIF</h4>
                                <div class="badge bg-success bg-opacity-25 text-success px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Akurat & Bebas Bias</div>
                                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                                    Menyajikan informasi dan dokumentasi publik berbasis data faktual yang valid, teruji kebenarannya, bebas dari manipulasi, serta tidak memihak demi menjaga netralitas aparatur dan mengutamakan kepentingan keselamatan transportasi jalan nasional.
                                </p>
                            </div>
                        </div>

                        <!-- 3. PRIMA -->
                        <div class="col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #d97706 !important;">
                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(217, 119, 6, 0.12); color: #d97706; font-size: 26px;">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">PRIMA</h4>
                                <div class="badge bg-warning bg-opacity-25 text-amber-700 px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Responsif & Inklusif</div>
                                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                                    Mengedepankan keramahan layanan (Hospitality), pemenuhan respon cepat maksimal 10 hari kerja (+7 hari perpanjangan), pemanfaatan portal teknologi digital mandiri, serta penyediaan fasilitas fisik yang ramah disabilitas (Text-to-Speech, Bisindo, Braille).
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2 NILAI PENDUKUNG: AKUNTABEL & TERINTEGRASI -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 bg-white border shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: #f1f5f9; color: #002b5c; font-size: 22px;">
                                    <i class="fas fa-shield-halved"></i>
                                </div>
                                <div>
                                    <h6 class="outfit fw-bold text-dark mb-0.5" style="font-size: 14.5px;">Akuntabel</h6>
                                    <p class="text-muted small mb-0" style="font-size: 12px;">Setiap kebijakan dan pelayanan informasi dapat dipertanggungjawabkan secara hukum dan audit publik.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3.5 rounded-4 bg-white border shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: #f1f5f9; color: #002b5c; font-size: 22px;">
                                    <i class="fas fa-network-wired"></i>
                                </div>
                                <div>
                                    <h6 class="outfit fw-bold text-dark mb-0.5" style="font-size: 14.5px;">Terintegrasi</h6>
                                    <p class="text-muted small mb-0" style="font-size: 12px;">Tata kelola satu data selaras dengan BPSDM Perhubungan dan Kementerian Perhubungan RI.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
