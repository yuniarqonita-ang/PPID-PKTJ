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
        .visi-misi-wrapper h3 { color: #002b5c !important; }
        .visi-misi-wrapper h4, .visi-misi-wrapper h5 { color: #002b5c !important; }
        .visi-misi-wrapper p { color: #334155 !important; }
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
                <div class="visi-misi-wrapper mb-5">
                    <!-- VISI HERO CARD -->
                    <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5 text-center mb-5 position-relative overflow-hidden" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%); border: 2px solid #bfdbfe !important; border-top: 6px solid #004a99 !important;">
                        <div class="d-inline-flex align-items-center gap-2 px-3.5 py-1.5 rounded-pill fw-bold text-uppercase mb-3 mx-auto" style="background: #002b5c; color: #ffc107 !important; font-size: 12px; letter-spacing: 1.5px;">
                            <i class="fas fa-eye text-warning"></i> VISI PPID PKTJ TEGAL
                        </div>
                        <h3 class="outfit fw-black text-center mb-0 px-2" style="color: #002b5c !important; font-size: 1.65rem; line-height: 1.6; max-width: 950px; margin: 15px auto;">
                            “Terwujudnya layanan informasi publik yang Transparan, Objektif dan Prima untuk meningkatkan peran serta aktif masyarakat dalam penyelenggaraan pembangunan sektor transportasi.”
                        </h3>
                        <p class="text-muted small text-center mb-0 mt-3" style="color: #64748b !important;">
                            <i class="fas fa-quote-left text-warning opacity-50 me-2"></i>Komitmen Utama Keterbukaan Informasi Publik di Lingkungan Politeknik Keselamatan Transportasi Jalan<i class="fas fa-quote-right text-warning opacity-50 ms-2"></i>
                        </p>
                    </div>

                    <!-- PENJELASAN MAKNA DARI VISI -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #e0f2fe; color: #0284c7; font-size: 22px;">
                                <i class="fas fa-shapes"></i>
                            </div>
                            <div>
                                <h4 class="outfit fw-bold text-dark mb-0" style="color: #002b5c !important; font-size: 1.35rem;">Makna dari Visi</h4>
                                <span class="text-muted small">Penjabaran prinsip utama penyelenggaraan informasi publik</span>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #0284c7 !important;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #e0f2fe; color: #0284c7 !important;">1</span>
                                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Layanan Informasi Publik</h5>
                                    </div>
                                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                                        Suatu usaha untuk memberikan informasi publik sesuai Undang- Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik di lingkungan Kementerian Perhubungan;
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #10b981 !important;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #d1fae5; color: #059669 !important;">2</span>
                                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Transparan</h5>
                                    </div>
                                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                                        Memberikan akses seluar-luasnya kepada masyarakat dalam memperoleh informasi publik dengan cepat dan tepat waktu, biaya ringan, dan cara yang sederhana;
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #6366f1 !important;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #ede9fe; color: #6366f1 !important;">3</span>
                                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Objektif</h5>
                                    </div>
                                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                                        Memberikan akses informasi kepada setiap kalangan, baik Perorangan, Kelompok, maupun Badan Hukum;
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #f59e0b !important;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #fef3c7; color: #d97706 !important;">4</span>
                                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Prima</h5>
                                    </div>
                                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                                        Terus Berupaya penuh dalam peningkatan Pelayanan, Pengelolaan dan Pendokumentasian Informasi Publik secara Akuntabel, Efisien dan Mudah Diakses.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MISI SECTION -->
                    <div class="misi-section mb-4">
                        <div class="d-flex align-items-center gap-3 mb-4 mt-5">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #e0e7ff; color: #002b5c; font-size: 22px;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <h4 class="outfit fw-bold text-dark mb-0" style="color: #002b5c !important; font-size: 1.45rem;">Misi</h4>
                                <span class="text-muted small">Lima komitmen penyelenggaraan pelayanan informasi publik PPID PKTJ</span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">1</span>
                                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                                        Menjamin akses informasi publik sesuai Undang-Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">2</span>
                                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                                        Meningkatkan kualitas layanan informasi publik;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">3</span>
                                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                                        Meningkatkan profesionalisme SDM layanan informasi publik;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">4</span>
                                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                                        Meningkatkan sarana-prasarana dalam rangka efisiensi dan efektivitas layanan informasi publik;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">5</span>
                                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                                        Meningkatkan pengelolaan informasi dan dokumentasi secara baik, efisien, mudah diakses dan bersifat desentralisasi.
                                    </div>
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
