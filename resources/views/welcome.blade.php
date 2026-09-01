<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $settings = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('dashboards')) {
                $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
            }
        } catch (\Exception $e) {}

        $total_permohonan = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('permohonan')) {
                $total_permohonan = \App\Models\Permohonan::count();
            }
        } catch (\Exception $e) {}

        $total_berita = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('beritas')) {
                $total_berita = \App\Models\Berita::count();
            }
        } catch (\Exception $e) {}

        $total_informasi = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('daftar_informasis')) {
                $total_informasi = \App\Models\DaftarInformasi::count();
            }
        } catch (\Exception $e) {}

        $total_dokumen = 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('dokumens')) {
                $total_dokumen = \App\Models\Dokumen::count();
            }
        } catch (\Exception $e) {}
    @endphp
    <title>{{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --accent-blue: #006ccf;
            --dark-blue: #002b5c;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --transition-speed: 0.4s;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fbff; 
            color: #1e293b;
            scroll-behavior: smooth; 
            overflow-x: hidden;
        }

        h1, h2, h3, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        
        /* Modern Navbar Styling */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(0, 74, 153, 0.95);
            transition: all 0.3s ease;
        }

        /* Hero Section - The WOW Factor */
        .hero-section {
            position: relative;
            background-color: var(--dark-blue);
            padding: 100px 0;
            color: white;
            text-align: center;
            min-height: 600px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .hero-video-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-video-wrapper iframe {
            width: 100vw;
            height: 56.25vw; /* 16:9 aspect ratio */
            min-height: 100vh;
            min-width: 177.77vh; /* 16:9 aspect ratio */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.15);
        }

        .hero-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-content-wrapper {
            position: relative;
            z-index: 5;
            width: 100%;
        }

        .hero-shapes {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 3;
            pointer-events: none;
        }

        .glass-hero-card {
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border: 2.5px solid rgba(255, 255, 255, 0.9);
            border-radius: 50px;
            padding: 60px 40px;
            box-shadow: none;
            max-width: 1000px;
            margin: 0 auto;
            animation: float-in 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes float-in {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            background: rgba(255, 193, 7, 0.2);
            border: 1px solid var(--secondary-gold);
            border-radius: 100px;
            color: var(--secondary-gold);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            line-height: 1;
            margin-bottom: 25px;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.35rem);
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            font-weight: 600;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .hero-custom-content {
            margin: 0 auto 40px;
            max-width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
        }

        .hero-custom-content iframe {
            max-width: 100%;
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .btn-premium {
            padding: 18px 45px;
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-gold {
            background: var(--secondary-gold);
            color: var(--dark-blue);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
        }

        .btn-gold:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-white {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.85);
            color: #ffffff;
        }

        .btn-outline-white:hover {
            transform: translateY(-5px);
            background: #ffffff;
            color: var(--primary-blue);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.25);
        }

        /* Stats Section */
        .stats-section {
            margin-top: -60px;
            position: relative;
            z-index: 20;
        }

        .stat-card {
            background: white;
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover { transform: translateY(-10px); box-shadow: 0 25px 50px rgba(0, 74, 153, 0.1); }

        .stat-icon {
            width: 60px; height: 60px;
            background: #f0f7ff;
            color: var(--primary-blue);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin: 0 auto 20px;
        }

        .stat-number { font-size: 32px; font-weight: 900; color: var(--dark-blue); margin-bottom: 5px; }
        .stat-label { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }

        /* Icon Grid Redesign */
        .info-grid-section { padding: 100px 0; }
        .section-header { text-align: center; margin-bottom: 60px; }
        .section-header h2 { font-size: 3rem; font-weight: 900; color: var(--primary-blue); text-transform: uppercase; letter-spacing: -1px; }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 40px;
            border: 1px solid #f1f5f9;
            text-align: center;
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .feature-card:hover {
            border-color: var(--secondary-gold);
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 74, 153, 0.08);
        }

        .icon-box {
            width: 140px; height: 140px;
            background: #f8faff;
            border-radius: 35px;
            margin-bottom: 25px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.4s ease;
        }

        .feature-card:hover .icon-box { background: var(--primary-blue); transform: rotate(5deg); }
        .icon-box svg { width: 80px; height: 80px; transition: all 0.4s ease; }
        .feature-card:hover .icon-box svg { filter: brightness(0) invert(1); transform: scale(1.1); }

        .feature-title { font-size: 15px; font-weight: 800; text-transform: uppercase; color: var(--dark-blue); }

        /* Article & News */
        .news-section { background: #f1f5f9; padding: 100px 0; }
        .article-card {
            background: white;
            border-radius: 35px;
            overflow: hidden;
            border: none;
            transition: all 0.5s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }

        .article-card:hover { transform: translateY(-12px); box-shadow: 0 30px 60px rgba(0, 74, 153, 0.1); }
        .article-image { height: 240px; overflow: hidden; position: relative; }
        .article-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease; }
        .article-card:hover .article-image img { transform: scale(1.1); }

        .article-badge {
            position: absolute; top: 20px; left: 20px;
            padding: 8px 16px; background: var(--secondary-gold);
            border-radius: 12px; font-size: 10px; font-weight: 900; color: var(--dark-blue);
            text-transform: uppercase;
        }

        .article-body { padding: 30px; }
        .article-title { font-size: 18px; font-weight: 800; color: var(--primary-blue); margin-bottom: 15px; line-height: 1.4; }
        .article-text { font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 20px; }

        /* Video Section */
        .video-box {
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.15);
            position: relative;
            background: var(--dark-blue);
        }

        /* Footer Modernization */
        .footer-cta {
            background: var(--primary-blue);
            padding: 80px 0;
            text-align: center;
            border-radius: 60px 60px 0 0;
            color: white;
        }

        /* ============================================================ */
        /* PINTASAN PROSEDUR & ALUR LAYANAN (SUPER PREMIUM DESIGN)      */
        /* ============================================================ */
        .prosedur-shortcut-wrapper {
            background: linear-gradient(145deg, #ffffff 0%, #f0f7ff 60%, #fffdf0 100%);
            border: 2.5px solid #e2e8f0;
            border-radius: 40px;
            padding: 55px 35px 60px;
            margin-top: 60px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 74, 153, 0.07);
            overflow: hidden;
        }

        .prosedur-shortcut-wrapper::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -120px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .prosedur-shortcut-wrapper::after {
            content: '';
            position: absolute;
            bottom: -120px;
            left: -120px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(0, 74, 153, 0.12) 0%, rgba(0, 74, 153, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .prosedur-badge-head {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e0f2fe;
            color: #004a99;
            border: 1.5px solid #bae6fd;
            font-weight: 900;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 7px 22px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .prosedur-main-title {
            font-size: clamp(28px, 3.5vw, 42px);
            font-weight: 900;
            font-family: 'Outfit', sans-serif;
            color: #0f172a;
            text-transform: uppercase;
            margin-bottom: 10px;
            line-height: 1.15;
        }

        .prosedur-main-title span {
            color: #004a99;
        }

        .prosedur-main-subtitle {
            font-size: 15px;
            color: #64748b;
            font-weight: 500;
            max-width: 650px;
            margin: 0 auto 45px;
            line-height: 1.6;
        }

        /* 3 CARDS BESPOKE DESIGN */
        .prosedur-card {
            background: #ffffff;
            border-radius: 32px;
            border: 2.5px solid #e2e8f0;
            padding: 34px 28px 28px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.04);
            text-decoration: none;
        }

        .prosedur-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 7px;
            background: var(--card-accent, #004a99);
            transition: height 0.3s ease;
        }

        .prosedur-card:hover {
            transform: translateY(-10px) scale(1.015);
            border-color: var(--card-accent, #004a99);
            box-shadow: 0 25px 50px rgba(0, 74, 153, 0.14);
        }

        .prosedur-card:hover::before {
            height: 10px;
        }

        .prosedur-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .prosedur-icon-box {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: var(--icon-bg, #f0f7ff);
            color: var(--icon-color, #004a99);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 10px 22px -4px var(--icon-shadow, rgba(0, 74, 153, 0.2));
            transition: all 0.4s ease;
        }

        .prosedur-card:hover .prosedur-icon-box {
            transform: scale(1.1) rotate(5deg);
            background: var(--card-accent, #004a99);
            color: #ffffff;
        }

        .prosedur-step-badge {
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 50px;
            background: var(--badge-bg, #e0f2fe);
            color: var(--badge-color, #004a99);
            border: 1.5px solid var(--badge-border, #bae6fd);
        }

        .prosedur-card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 900;
            color: #0f172a;
            margin: 0 0 10px;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .prosedur-card:hover .prosedur-card-title {
            color: var(--card-accent, #004a99);
        }

        .prosedur-card-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px;
            font-weight: 500;
        }

        .prosedur-pill-time {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 2px dashed #dc2626;
            color: #dc2626;
            background: #fff1f2;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 11.5px;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .prosedur-action-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            color: var(--card-accent, #004a99);
            font-weight: 900;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .prosedur-card:hover .prosedur-action-btn {
            background: var(--card-accent, #004a99);
            color: #ffffff;
            border-color: var(--card-accent, #004a99);
            box-shadow: 0 8px 20px -2px var(--card-accent, #004a99);
        }

        .prosedur-action-btn i {
            transition: transform 0.3s ease;
        }

        .prosedur-card:hover .prosedur-action-btn i {
            transform: translateX(4px);
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

    <!-- HERO SECTION -->
    <section class="hero-section">
        @php
            $heroVidLink = $settings['hero_video_link'] ?? null;
            $heroVidFile = $settings['hero_video_file'] ?? null;
            $hasHeroVideo = false;
            $heroEmbedUrl = null;
            
            if ($heroVidFile) {
                $hasHeroVideo = true;
            } elseif ($heroVidLink) {
                if (str_ends_with(strtolower($heroVidLink), '.mp4') || str_contains(strtolower($heroVidLink), '.mp4')) {
                    $hasHeroVideo = true;
                } else {
                    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/i';
                    if (preg_match($pattern, $heroVidLink, $matches)) {
                        $heroEmbedUrl = "https://www.youtube.com/embed/" . $matches[1] . "?autoplay=1&mute=1&controls=0&loop=1&playlist=" . $matches[1] . "&playsinline=1&enablejsapi=1";
                        $hasHeroVideo = true;
                    }
                }
            }
        @endphp

        @if($hasHeroVideo)
            <div class="hero-video-wrapper">
                @if($heroVidFile)
                    <video autoplay loop muted playsinline preload="auto">
                        <source src="{{ asset('storage/' . $heroVidFile) }}" type="video/mp4">
                    </video>
                @elseif($heroEmbedUrl)
                    <iframe src="{{ $heroEmbedUrl }}" title="Hero Video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                @else
                    <video autoplay loop muted playsinline preload="auto">
                        <source src="{{ $heroVidLink }}" type="video/mp4">
                    </video>
                @endif
                <div class="hero-image-overlay" style="background: rgba(0, 0, 0, 0.35);"></div>
            </div>
        @else
            <div class="hero-image-overlay" style="background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069') center/cover no-repeat;"></div>
        @endif

        <div class="hero-shapes">
            <svg class="w-100" style="height: 6vw; min-height: 40px; margin-bottom: -1px;" viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0 150V50C100 20 200 0 400 0C600 0 800 50 1000 50C1200 50 1340 20 1440 0V150H0Z" fill="#f8fbff"/>
            </svg>
        </div>
        
        <div class="container hero-content-wrapper">
            <div class="glass-hero-card">
                <div class="hero-badge">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full animate-ping"></span>
                    Portal Informasi Publik Tertinggi
                </div>
                <h1 class="hero-title">{{ $settings['hero_title'] ?? 'SELAMAT DATANG DI PORTAL PPID PKTJ' }}</h1>
                <p class="hero-subtitle">{{ $settings['hero_subtitle'] ?? 'Wujudkan transparansi informasi publik melalui layanan prima berbasis teknologi informasi yang cepat, mudah, dan transparan.' }}</p>
                
                @if(!empty($settings['hero_content']))
                    <div class="hero-custom-content">
                        {!! $settings['hero_content'] !!}
                    </div>
                @endif
                
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <a href="#informasi-publik" class="btn-premium btn-gold">
                        <i class="fas fa-search"></i> CARI INFORMASI
                    </a>
                    @php
                        $urlPermohonanBpsdm = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
                    @endphp
                    <a href="{{ $urlPermohonanBpsdm }}" target="_blank" class="btn-premium px-8 btn-outline-white">
                        <i class="fas fa-paper-plane mr-2"></i> AJUKAN PERMOHONAN
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI PUBLIK / KLASIFIKASI INFORMASI & LAYANAN CEPAT -->
    <section class="info-grid-section py-16" id="informasi-publik">
        <div class="container">
            <div class="section-header text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-[#004a99]">Klasifikasi Informasi</h2>
                <p class="text-muted font-bold mt-2">Akses daftar informasi publik berdasarkan kategorinya</p>
            </div>

            <div class="row justify-content-center g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('informasi.berkala') }}" class="text-decoration-none">
                        <div class="feature-card h-100">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 36 Q20 28 28 28 L52 28 Q60 28 60 36 L60 44 Q60 52 52 52 L28 52 Q20 52 20 44 Z" fill="#fbbf24"/>
                                    <text x="40" y="44" text-anchor="middle" fill="#1a1a1a" font-size="8" font-weight="900">BERKALA</text>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Berkala</h3>
                            <p class="mt-3 text-muted text-sm px-2">Daftar informasi yang wajib diperbarui dan dipublikasikan secara berkala.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('informasi.setiap-saat') }}" class="text-decoration-none">
                        <div class="feature-card h-100">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="18" y="14" width="44" height="52" rx="6" fill="#3b82f6"/>
                                    <rect x="26" y="32" width="28" height="4" rx="2" fill="white"/>
                                    <rect x="26" y="42" width="20" height="4" rx="2" fill="white"/>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Tersedia Setiap Saat</h3>
                            <p class="mt-3 text-muted text-sm px-2">Informasi yang wajib tersedia setiap saat untuk melayani masyarakat.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('informasi.serta-merta') }}" class="text-decoration-none">
                        <div class="feature-card h-100">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 30 L42 22 L42 55 L18 47 Z" fill="#fbbf24"/>
                                    <path d="M52 28 Q58 34 58 38.5 Q58 43 52 49" stroke="#004a99" stroke-width="3" fill="none"/>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Serta Merta</h3>
                            <p class="mt-3 text-muted text-sm px-2">Pengumuman darurat atau mendadak yang menyangkut hajat hidup orang banyak.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="https://bpsdm.kemenhub.go.id/ppid/setbpsdm/login" target="_blank" class="text-decoration-none">
                        <div class="feature-card h-100 border-warning border-2">
                            <div class="icon-box" style="background: linear-gradient(135deg, #004a99, #002b5c);">
                                <i class="fas fa-file-signature text-warning text-4xl"></i>
                            </div>
                            <h3 class="feature-title text-[#004a99]">Ajukan Permohonan Informasi Publik</h3>
                            <p class="mt-3 text-muted text-sm px-2">Layanan pengajuan permohonan informasi publik secara online resmi PPID PKTJ.</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- PINTASAN PROSEDUR & ALUR LAYANAN (SUPER PREMIUM DESIGN) -->
            <div class="prosedur-shortcut-wrapper" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="prosedur-badge-head">
                        <i class="fas fa-sitemap text-[#ffc107]"></i> Pintasan Prosedur Layanan
                    </div>
                    <h2 class="prosedur-main-title">
                        Alur &amp; Tata Cara <span>Pengajuan Layanan</span>
                    </h2>
                    <p class="prosedur-main-subtitle">
                        Panduan langkah demi langkah prosedur resmi permohonan informasi publik, penanganan keberatan, dan penyelesaian sengketa PPID PKTJ.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    <!-- Kartu 1: SOP Permintaan -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <a href="{{ route('prosedur.sop-permintaan') }}" class="prosedur-card" style="--card-accent: #004a99; --icon-bg: #e0f2fe; --icon-color: #004a99; --icon-shadow: rgba(0,74,153,0.3); --badge-bg: #e0f2fe; --badge-color: #004a99; --badge-border: #bae6fd;">
                            <div>
                                <div class="prosedur-card-top">
                                    <div class="prosedur-icon-box">
                                        <i class="fas fa-file-signature"></i>
                                    </div>
                                    <span class="prosedur-step-badge">Prosedur 01</span>
                                </div>
                                <h3 class="prosedur-card-title">SOP Permintaan Informasi</h3>
                                <p class="prosedur-card-desc">Tata cara dan syarat pengajuan permohonan informasi publik secara online maupun langsung.</p>
                                <div class="prosedur-pill-time">
                                    <i class="fas fa-clock"></i> 10 Menit / 10 Hari Kerja
                                </div>
                            </div>
                            <div class="prosedur-action-btn">
                                <span>Lihat Alur Permintaan</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>

                    <!-- Kartu 2: SOP Keberatan -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('prosedur.sop-keberatan') }}" class="prosedur-card" style="--card-accent: #d97706; --icon-bg: #fef3c7; --icon-color: #d97706; --icon-shadow: rgba(217,119,6,0.3); --badge-bg: #fef3c7; --badge-color: #d97706; --badge-border: #fde68a;">
                            <div>
                                <div class="prosedur-card-top">
                                    <div class="prosedur-icon-box">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <span class="prosedur-step-badge">Prosedur 02</span>
                                </div>
                                <h3 class="prosedur-card-title">SOP Penanganan Keberatan</h3>
                                <p class="prosedur-card-desc">Tata cara pengajuan keberatan jika permohonan informasi ditolak, terlambat, atau tidak memuaskan.</p>
                                <div class="prosedur-pill-time">
                                    <i class="fas fa-clock"></i> 30 Hari Kerja
                                </div>
                            </div>
                            <div class="prosedur-action-btn">
                                <span>Lihat Alur Keberatan</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>

                    <!-- Kartu 3: SOP Sengketa -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <a href="{{ route('prosedur.sop-sengketa') }}" class="prosedur-card" style="--card-accent: #dc2626; --icon-bg: #fee2e2; --icon-color: #dc2626; --icon-shadow: rgba(220,38,38,0.3); --badge-bg: #fee2e2; --badge-color: #dc2626; --badge-border: #fecaca;">
                            <div>
                                <div class="prosedur-card-top">
                                    <div class="prosedur-icon-box">
                                        <i class="fas fa-scale-balanced"></i>
                                    </div>
                                    <span class="prosedur-step-badge">Prosedur 03</span>
                                </div>
                                <h3 class="prosedur-card-title">SOP Penyelesaian Sengketa</h3>
                                <p class="prosedur-card-desc">Tata cara penyelesaian sengketa informasi publik melalui proses mediasi &amp; adjudikasi Komisi Informasi.</p>
                                <div class="prosedur-pill-time">
                                    <i class="fas fa-clock"></i> 14 Hari / 100 Hari Kerja
                                </div>
                            </div>
                            <div class="prosedur-action-btn">
                                <span>Lihat Alur Sengketa</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS COUNTER SECTION -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="stat-number">{{ number_format($total_permohonan) }}</div>
                        <div class="stat-label">Permohonan Informasi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-database"></i></div>
                        <div class="stat-number">{{ number_format($total_informasi) }}</div>
                        <div class="stat-label">Informasi Publik</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-file-pdf"></i></div>
                        <div class="stat-number">{{ number_format($total_dokumen) }}</div>
                        <div class="stat-label">Dokumen Tersedia</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
                        <div class="stat-number">{{ number_format($total_berita) }}</div>
                        <div class="stat-label">Berita & Artikel</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS & ARTICLES -->
    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <h2>Warta &amp; Dokumentasi</h2>
                <div class="d-flex justify-content-center mt-3">
                    <div class="bg-warning rounded-pill" style="height: 4px; width: 80px;"></div>
                </div>
                <p class="text-muted mt-3" style="font-size: 0.95rem;">Informasi terkini dan pengumuman resmi PPID PKTJ.</p>
            </div>

            <div class="row g-4">
                @forelse($artikel as $item)
                @php
                    $isArr = is_array($item);
                    $judul = $isArr ? ($item['judul'] ?? '') : $item->judul;
                    $ringkasan = $isArr ? ($item['ringkasan'] ?? \Illuminate\Support\Str::limit(strip_tags($item['konten'] ?? ''), 110)) : \Illuminate\Support\Str::limit(strip_tags($item->konten ?? ''), 110);
                    $kategori = $isArr ? ($item['kategori'] ?? 'Liputan/Berita') : ($item->kategori ?? 'Liputan/Berita');
                    $gambar = $isArr ? ($item['gambar'] ?? 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png') : ($item->gambar_url ?? 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png');
                    $link = $isArr ? ($item['link'] ?? url('/berita/' . ($item['slug'] ?? ''))) : ($item->url_berita ?? url('/berita/' . $item->slug));
                    $tanggal = $isArr ? ($item['tanggal_f'] ?? date('d M Y')) : ($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : $item->created_at->translatedFormat('d F Y'));
                    $isExternal = $isArr ? ($item['is_external'] ?? true) : ($item->is_external ?? false);
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="article-card h-100 shadow-sm hover-lift d-flex flex-column" style="border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; background: white;">
                        <div class="article-image position-relative" style="height: 220px; overflow: hidden; background: #0f172a;">
                            <img src="{{ $gambar }}" alt="{{ $judul }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=800'">
                            <div class="article-badge position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-xs fw-bold text-white shadow-sm" style="background: linear-gradient(135deg, #004a99, #0066cc); font-size: 11px; letter-spacing: 0.5px;">
                                <i class="fas fa-tag me-1 text-warning"></i> {{ $kategori }}
                            </div>
                            <div class="position-absolute bottom-0 end-0 m-3 px-2 py-1 rounded text-white text-xs" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); font-size: 11px;">
                                <i class="far fa-calendar-alt me-1"></i> {{ $tanggal }}
                            </div>
                        </div>
                        <div class="article-body p-4 d-flex flex-column flex-grow-1">
                            <h3 class="article-title fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; line-height: 1.4; color: #1e293b;">
                                <a href="{{ $link }}" {{ $isExternal ? 'target=_blank rel=noopener' : '' }} class="text-decoration-none text-dark hover-primary transition-all">
                                    {{ $judul }}
                                </a>
                            </h3>
                            <p class="article-text text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">{{ $ringkasan }}</p>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <a href="{{ $link }}" {{ $isExternal ? 'target=_blank rel=noopener' : '' }} class="text-decoration-none fw-bold text-xs text-primary text-uppercase tracking-wider hover-dark d-inline-flex align-items-center" style="color: #004a99 !important;">
                                    Baca Selengkapnya <i class="fas fa-external-link-alt ms-2 text-warning" style="font-size: 11px;"></i>
                                </a>
                                <span class="badge bg-light text-muted border text-xs" style="font-size: 10px;">pktj.ac.id</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 py-10 text-center">
                    <div class="p-10 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <i class="fas fa-newspaper text-6xl text-slate-200 mb-4"></i>
                        <p class="text-slate-400 font-bold">Sedang menyinkronkan warta dan berita resmi dari pktj.ac.id...</p>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/berita') }}" class="btn btn-outline-primary fw-bold px-5 py-3 rounded-pill shadow-sm" style="color: #004a99; border-color: #004a99; font-family: 'Outfit', sans-serif;">
                    <i class="fas fa-newspaper me-2"></i> Jelajahi Semua Berita PKTJ
                </a>
            </div>
        </div>
    </section>

    <!-- KONTAK TERPUSAT -->
    <section class="bg-white" style="padding-top: 80px; padding-bottom: 120px; position: relative; z-index: 10;">
        <div class="container">
            <div class="row g-5 align-items-stretch">
                <!-- Kolom Kiri: Detail Kontak -->
                <div class="col-lg-6">
                    <div class="shadow-2xl relative overflow-hidden h-100" style="background-color: var(--primary-blue); border-radius: 30px; padding: 40px !important; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 520px;">
                        <div class="absolute -right-20 -top-20 w-60 h-60 bg-white/5 rounded-full blur-3xl"></div>
                        <div>
                            <h3 class="uppercase tracking-widest text-center mb-4" style="font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;">
                                <i class="fas fa-headset text-yellow-500 mr-3"></i> Pusat Kontak
                            </h3>
                            
                            <div class="space-y-4">
                                <a href="mailto:{{ $settings['kontak_email'] ?? 'pktj@pktj.ac.id' }}" class="d-flex align-items-center gap-3 mb-3 text-decoration-none" style="color: inherit; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-envelope text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Email Resmi</div>
                                        <div style="font-weight: 700; font-size: 14px; color: white;">{{ $settings['kontak_email'] ?? 'pktj@pktj.ac.id' }}</div>
                                    </div>
                                </a>
                                <a href="tel:{{ $settings['kontak_telepon'] ?? '(0283) 351061' }}" class="d-flex align-items-center gap-3 mb-3 text-decoration-none" style="color: inherit; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-phone-alt text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Hotline</div>
                                        <div style="font-weight: 700; font-size: 14px; color: white;">{{ $settings['kontak_telepon'] ?? '(0283) 351061' }}</div>
                                    </div>
                                </a>
                                <a href="tel:(0283)358965" class="d-flex align-items-center gap-3 mb-3 text-decoration-none" style="color: inherit; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-print text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Fax</div>
                                        <div style="font-weight: 700; font-size: 14px; color: white;">(0283) 358965</div>
                                    </div>
                                </a>
                                <a href="https://maps.google.com/?q=Politeknik+Keselamatan+Transportasi+Jalan+Tegal" target="_blank" class="d-flex align-items-start gap-3 text-decoration-none" style="color: inherit; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                                        <i class="fas fa-map-marked-alt text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Alamat Kantor</div>
                                        <div style="font-weight: 700; font-size: 12px; line-height: 1.6; color: rgba(255,255,255,0.9);" class="text-wrap">
                                            Kampus I: {{ $settings['kontak_alamat'] ?? 'Jl. Perintis Kemerdekaan No. 17, Kota Tegal' }}<br>
                                            Kampus II: Jl. Abdul Syukur No. 17, Kota Tegal
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <a href="https://bpsdm.kemenhub.go.id/ppid/setbpsdm/login" target="_blank" class="btn-premium btn-gold w-100 justify-content-center py-4 mt-4">
                            KIRIM PERMOHONAN SEKARANG
                        </a>
                    </div>
                </div>

                <!-- Kolom Kanan: Peta Lokasi (Maps) -->
                <div class="col-lg-6">
                    <div class="card hover-lift " data-aos="fade-up" border-0 shadow-lg h-100 p-4" style="border-radius: 30px; background: #f8fafc; border: 1px solid #e2e8f0; min-height: 520px; display: flex; flex-direction: column;">
                        <h4 class="outfit fw-black text-[#002b5c] mb-4 text-center uppercase tracking-wide" style="font-size: 1.1rem; border-bottom: 2px solid var(--secondary-gold); padding-bottom: 10px; display: inline-block;">
                            <i class="fas fa-map-marked-alt text-[#004a99] mr-2"></i> Peta Lokasi Kampus PKTJ
                        </h4>
                        
                        <div class="row g-3 flex-grow-1">
                            <!-- Kampus I Map -->
                            <div class="col-sm-6 d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge bg-warning text-xs px-3 py-2 rounded-pill font-bold text-dark">Kampus I (Perintis)</span>
                                </div>
                                <div class="flex-grow-1 rounded-3xl overflow-hidden border border-slate-200 shadow-sm" style="min-height: 320px; height: 100%;">
                                    <iframe 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        style="border:0; min-height: 320px; width: 100%; height: 100%;" 
                                        src="https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20I%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                            
                            <!-- Kampus II Map -->
                            <div class="col-sm-6 d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge bg-warning text-xs px-3 py-2 rounded-pill font-bold text-dark">Kampus II (Margadana)</span>
                                </div>
                                <div class="flex-grow-1 rounded-3xl overflow-hidden border border-slate-200 shadow-sm" style="min-height: 320px; height: 100%;">
                                    <iframe 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        style="border:0; min-height: 320px; width: 100%; height: 100%;" 
                                        src="https://maps.google.com/maps?q=Politeknik%20Keselamatan%20Transportasi%20Jalan%20(PKTJ)%20Kampus%20II%20Tegal&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER CTA -->
    <section class="footer-cta">
        <div class="container">
            <h2 class="text-4xl font-black mb-4">Transparansi Informasi dalam Genggaman</h2>
            <p class="text-blue-100 mb-5 font-bold">Ayo wujudkan pemerintahan yang bersih dan transparan bersama PPID PKTJ.</p>
            <div class="d-flex justify-content-center gap-2">
                <div class="w-3 h-1 bg-yellow-400 rounded-full"></div>
                <div class="w-20 h-1 bg-yellow-400 rounded-full"></div>
            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
