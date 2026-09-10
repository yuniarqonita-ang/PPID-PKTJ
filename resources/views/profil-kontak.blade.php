<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Hubungi Kami' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --primary-dark: #002b5c;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
            --bg-light: #f3f7fa;
            --card-shadow: 0 20px 40px rgba(0, 43, 92, 0.06);
            --transition-speed: 0.3s;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            color: #334155;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 43, 92, 0.85), rgba(0, 74, 153, 0.85)), 
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        /* Glassmorphism Hero Title Box */
        .hero-card-outline {
            display: inline-block;
            border: 2.5px solid rgba(255, 255, 255, 0.9);
            padding: 2.5rem 4rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            max-width: 90%;
        }

        .hero-card-outline h1 {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        /* Content Card */
        .main-container {
            margin-top: -50px;
            position: relative;
            z-index: 30;
        }

        .premium-card {
            background: white;
            border-radius: 32px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 74, 153, 0.05);
            overflow: hidden;
        }

        .section-header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 74, 153, 0.08);
            color: var(--primary-blue);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--primary-dark);
            font-weight: 900;
            font-size: 2.5rem;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        /* Social Media Section */
        .social-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
            margin-top: 35px;
        }

        .social-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .social-item i {
            font-size: 28px;
            margin-bottom: 12px;
            transition: transform var(--transition-speed) ease;
        }

        /* Social Brand Colors on Hover */
        .social-item.instagram:hover {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%);
            border-color: transparent;
            color: white;
        }
        .social-item.facebook:hover {
            background: #1877F2;
            border-color: transparent;
            color: white;
        }
        .social-item.twitter:hover {
            background: #000000;
            border-color: transparent;
            color: white;
        }
        .social-item.twitter:hover i,
        .social-item.twitter:hover .social-x-icon {
            color: white !important;
            transform: scale(1.18);
        }
        .social-item.youtube:hover {
            background: #FF0000;
            border-color: transparent;
            color: white;
        }
        .social-item.linktree:hover {
            background: #39E09B;
            border-color: transparent;
            color: white;
        }
        .social-item.whatsapp:hover {
            background: #25D366;
            border-color: transparent;
            color: white;
        }
        .social-item.tiktok:hover {
            background: #010101;
            border-color: transparent;
            color: white;
        }
        .social-item.website:hover {
            background: var(--primary-blue);
            border-color: transparent;
            color: white;
        }

        .social-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .social-item:hover i {
            transform: scale(1.18);
        }

        /* SP4N-LAPOR Modern Card Styling */
        .sp4n-lapor-card {
            background: white;
            border-radius: 28px;
            border: 1.5px solid rgba(0, 74, 153, 0.1);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
        }

        .sp4n-lapor-card:hover {
            box-shadow: 0 25px 50px rgba(0, 43, 92, 0.12);
        }

        .sp4n-header {
            background: linear-gradient(135deg, #002b5c 0%, #003d80 50%, #004a99 100%);
            padding: 34px 34px 28px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .sp4n-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.22) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sp4n-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: white;
        }

        .sp4n-tag {
            background: #dc2626;
            color: white;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sp4n-icon-circle {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sp4n-title {
            font-size: 1.85rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: white;
            margin: 0;
            line-height: 1.15;
        }

        .sp4n-sub {
            font-size: 11px;
            font-weight: 700;
            color: #ffc107;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 0;
        }

        .sp4n-desc {
            color: rgba(255, 255, 255, 0.88);
            font-size: 13.5px;
            line-height: 1.65;
            margin-top: 14px;
            margin-bottom: 0;
        }

        .sp4n-body {
            padding: 28px 32px 32px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
        }

        .sp4n-pillars-heading {
            font-size: 10.5px;
            font-weight: 900;
            letter-spacing: 1.5px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .sp4n-pillar-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px 14px;
            height: 100%;
            transition: all 0.25s ease;
        }

        .sp4n-pillar-box:hover {
            border-color: #004a99;
            background: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 74, 153, 0.08);
        }

        .sp4n-pillar-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .sp4n-pillar-icon.bg-blue-soft {
            background: #eff6ff;
        }
        .sp4n-pillar-icon.bg-gold-soft {
            background: #fefce8;
        }
        .sp4n-pillar-icon.bg-emerald-soft {
            background: #ecfdf5;
        }

        .sp4n-pillar-box h6 {
            font-weight: 800;
            font-size: 12.5px;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .sp4n-pillar-box p {
            font-size: 11.5px;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }

        .sp4n-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-sp4n-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #ffc107 0%, #f59e0b 100%);
            color: #002b5c;
            font-weight: 900;
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 16px 22px;
            border-radius: 16px;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .btn-sp4n-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.45);
            color: #001a38;
        }

        .btn-sp4n-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #f8fafc;
            color: #004a99;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            font-size: 12.5px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 13px 20px;
            border-radius: 16px;
            border: 1.5px solid #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-sp4n-secondary:hover {
            background: #004a99;
            color: white;
            border-color: #004a99;
        }

        .sp4n-footer-info {
            background: #f8fafc;
            border-top: 1px dashed #e2e8f0;
            padding: 14px 28px;
            border-bottom-left-radius: 28px;
            border-bottom-right-radius: 28px;
        }

        .sp4n-sms-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #002b5c;
            color: white;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.5px;
            flex-shrink: 0;
        }

        /* Campus Map Cards */
        .campus-section-title {
            color: var(--primary-dark);
            font-weight: 900;
            font-size: 2rem;
            text-align: center;
            margin: 60px 0 30px;
            position: relative;
        }
        
        .campus-section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--secondary-gold);
            margin: 12px auto 0;
            border-radius: 10px;
        }

        .campus-card {
            background: white;
            border-radius: 28px;
            border: 1px solid rgba(0, 43, 92, 0.05);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .campus-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 43, 92, 0.09);
        }

        .campus-badge {
            background: var(--primary-blue);
            color: white;
            padding: 6px 14px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            border-radius: 50px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 15px;
        }

        .campus-info-list {
            list-style: none;
            padding: 0;
            margin: 25px 0 0;
        }

        .campus-info-list li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .campus-info-list li i {
            color: var(--primary-blue);
            font-size: 18px;
            width: 24px;
            text-align: center;
            margin-top: 3px;
        }

        .campus-info-list li a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .campus-info-list li a:hover {
            color: var(--primary-blue);
        }

        .map-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 280px;
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            min-height: 280px;
            border: 0;
            display: block;
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary-blue), #003770);
            color: white;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 16px 30px;
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 74, 153, 0.2);
            transition: all var(--transition-speed) ease;
        }

        .btn-premium:hover {
            background: linear-gradient(135deg, #0056b3, var(--primary-blue));
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(0, 74, 153, 0.3);
            color: white;
        }

        .btn-premium:active {
            transform: translateY(0);
        }

        .captcha-box {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .captcha-label {
            font-weight: 700;
            font-size: 14px;
            color: var(--primary-dark);
            margin: 0;
        }

        /* ============================================================ */
        /* UNIQUE SHOWCASE STYLES: DESK MEJA LAYANAN PPID              */
        /* ============================================================ */
        .desk-layanan-hero-card {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            border-radius: 32px;
            padding: 38px 42px;
            box-shadow: 0 25px 60px rgba(0, 43, 92, 0.22);
            color: white;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.12);
        }
        .desk-layanan-hero-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .desk-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #ffc107;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .desk-title {
            font-size: clamp(1.35rem, 2.2vw, 1.85rem);
            font-weight: 900;
            letter-spacing: -0.5px;
            color: white;
        }
        .desk-subtitle {
            color: rgba(255, 255, 255, 0.82);
            font-size: 13.5px;
            max-width: 680px;
            line-height: 1.55;
        }
        /* 3 CARDS: UNIFIED FROSTED GLASS & GOLD ACCENTS (NO VAST EMPTY WHITE) */
        .schedule-pill-card {
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1.5px solid rgba(255, 255, 255, 0.22);
            border-top: 3.5px solid #ffc107;
            border-radius: 20px;
            padding: 18px 20px;
            color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 0 12px 30px rgba(0, 20, 50, 0.15);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }
        .schedule-pill-card.location-card {
            padding: 20px;
        }
        .schedule-pill-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 193, 7, 0.6);
            box-shadow: 0 20px 40px rgba(0, 20, 50, 0.25);
        }
        .schedule-day-plaque {
            background: linear-gradient(135deg, #ffc107 0%, #f59e0b 100%);
            border-radius: 12px;
            padding: 9px 16px;
            text-align: center;
            box-shadow: 0 4px 14px rgba(255, 193, 7, 0.3);
            margin-bottom: 12px;
        }
        .schedule-day-plaque.location {
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: none;
        }
        .schedule-day-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 900;
            margin: 0;
            color: #002b5c;
            letter-spacing: 0.2px;
        }
        .schedule-day-plaque.location .schedule-day-title {
            color: #ffffff;
        }
        .schedule-times-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .time-frame-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transition: all 0.25s ease;
            border-left: 4px solid #004a99;
        }
        .time-frame-box:hover {
            background: #f8fafc;
            transform: translateX(3px);
            box-shadow: 0 6px 16px rgba(255, 193, 7, 0.3);
            border-left-color: #ffc107;
        }
        .time-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 15px;
            color: #002b5c;
            letter-spacing: 0.4px;
        }
        .time-zone-badge {
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: 900;
            color: #ffffff;
            background: #004a99;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }
        .location-address {
            font-size: 13px;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 14px;
        }
        .btn-desk-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none !important;
            transition: all 0.25s ease;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.3px;
            border: none;
            cursor: pointer;
        }
        .btn-desk-action.warning {
            background: #ffc107;
            color: #002b5c;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }
        .btn-desk-action.warning:hover {
            background: #f59e0b;
            color: #001a38;
            transform: translateY(-2px);
        }
        .btn-desk-action.primary {
            background: rgba(255, 255, 255, 0.18);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.35);
        }
        .btn-desk-action.primary:hover {
            background: rgba(255, 255, 255, 0.28);
            color: white;
            transform: translateY(-2px);
        }
        .btn-desk-action.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.22);
        }
        .btn-desk-action.secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }
        @media (max-width: 767px) {
            .desk-layanan-hero-card { padding: 26px 20px; border-radius: 24px; }
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

    <!-- Hero Banner -->
    <div class="hero-section">
        <div class="container hero-content">
            <div class="hero-card-outline animate__animated animate__fadeInDown">
                <h1 class="display-5 fw-bold outfit uppercase mb-2 text-white">{{ $profil->judul ?? 'Hubungi Kami' }}</h1>
                <p class="lead opacity-90 mb-0 font-medium">{{ $profil->tagline_hero ?? 'Kami Siap Melayani Kebutuhan Informasi Anda' }}</p>
            </div>
        </div>
    </div>

    <div class="container main-container mb-5">
        <!-- ============================================================ -->
        <!-- SHOWCASE CARD: JAM OPERASIONAL & DESK MEJA LAYANAN FISIK PPID -->
        <!-- ============================================================ -->
        <div class="desk-layanan-hero-card mb-5 animate__animated animate__fadeInUp">
            <div class="desk-layanan-inner position-relative" style="z-index: 2;">
                <!-- TOP HEADER -->
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 pb-4 mb-4 border-bottom border-white border-opacity-15">
                    <div>
                        <div class="desk-badge">
                            <i class="fas fa-headset text-warning"></i> JAM PELAYANAN DESK MEJA LAYANAN PPID
                        </div>
                        <h2 class="desk-title outfit mb-1">Waktu Operasional Pelayanan Langsung (Tatap Muka)</h2>
                        <p class="desk-subtitle mb-0">Layanan tatap muka pemberian informasi publik, konsultasi, dan penerimaan permohonan langsung di Kampus PKTJ.</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <button type="button" class="btn btn-warning btn-sm rounded-pill px-3 py-1.5 fw-bold text-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#modalFotoMejaLayanan" style="font-size: 12px; font-family: 'Outfit', sans-serif;">
                            <i class="fas fa-camera me-1.5"></i> Foto Meja Layanan
                        </button>
                        <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 px-3.5 py-2 rounded-pill fw-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">
                            <i class="fas fa-circle-check text-warning me-1.5"></i> Jam Layanan Aktif
                        </span>
                    </div>
                </div>

                <!-- 3 CARDS: SENIN-KAMIS, JUMAT, LOKASI FISIK -->
                <div class="row g-4 align-items-stretch">
                    <!-- Senin s/d Kamis -->
                    <div class="col-md-6 col-lg-4">
                        <div class="schedule-pill-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="schedule-day-plaque">
                                    <h4 class="schedule-day-title">Senin s.d Kamis</h4>
                                </div>
                                <div class="schedule-times-stack">
                                    <div class="time-frame-box">
                                        <span class="time-text">{{ $settings['jam_layanan_senin_kamis'] ?? '09.00 - 16.00' }}</span>
                                        <span class="time-zone-badge">WIB</span>
                                    </div>
                                    <div class="time-frame-box" style="background: rgba(255, 255, 255, 0.12); border: 1px dashed rgba(255, 255, 255, 0.3);">
                                        <span class="time-text" style="font-size: 12.5px; font-weight: 600;"><i class="fas fa-mug-hot me-1.5 text-warning"></i> Istirahat: {{ $settings['jam_istirahat_senin_kamis'] ?? '12.00 s.d 13.30' }}</span>
                                        <span class="time-zone-badge">WIB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-2 text-center border-top border-white border-opacity-15">
                                <span class="badge bg-white bg-opacity-15 text-white fw-bold px-3 py-1 rounded-pill" style="font-size: 11px;">
                                    <i class="fas fa-door-open me-1 text-warning"></i> Jam Layanan Tatap Muka
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Hari Jumat -->
                    <div class="col-md-6 col-lg-4">
                        <div class="schedule-pill-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="schedule-day-plaque">
                                    <h4 class="schedule-day-title">Jumat</h4>
                                </div>
                                <div class="schedule-times-stack">
                                    <div class="time-frame-box">
                                        <span class="time-text">{{ $settings['jam_layanan_jumat'] ?? '09.00 - 16.30' }}</span>
                                        <span class="time-zone-badge">WIB</span>
                                    </div>
                                    <div class="time-frame-box" style="background: rgba(255, 255, 255, 0.12); border: 1px dashed rgba(255, 255, 255, 0.3);">
                                        <span class="time-text" style="font-size: 12.5px; font-weight: 600;"><i class="fas fa-mug-hot me-1.5 text-warning"></i> Istirahat: {{ $settings['jam_istirahat_jumat'] ?? '11.30 s.d 14.00' }}</span>
                                        <span class="time-zone-badge">WIB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-2 text-center border-top border-white border-opacity-15">
                                <span class="badge bg-white bg-opacity-15 text-white fw-bold px-3 py-1 rounded-pill" style="font-size: 11px;">
                                    <i class="fas fa-door-open me-1 text-warning"></i> Jam Layanan Tatap Muka
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi Meja Layanan Fisik -->
                    <div class="col-lg-4">
                        <div class="schedule-pill-card location-card">
                            <div class="schedule-day-plaque location">
                                <h4 class="schedule-day-title">Desk Meja Layanan Fisik</h4>
                            </div>

                            <!-- Foto Meja Layanan Preview Thumbnail -->
                            <div class="my-2 position-relative rounded-3 overflow-hidden shadow-sm border border-white border-opacity-25" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFotoMejaLayanan" onclick="openFotoModal()" title="Klik untuk melihat foto meja layanan">
                                <img src="{{ asset('images/sarana/meja-layanan-ppid.png') }}" class="w-100" style="height: 100px; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'" alt="Foto Meja Layanan PPID PKTJ">
                                <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 py-1 px-2 text-center">
                                    <span class="text-white fw-bold" style="font-size: 11px;"><i class="fas fa-camera text-warning me-1"></i> Foto Meja Layanan</span>
                                </div>
                            </div>

                            <p class="location-address mb-2">
                                <strong class="text-white d-block mb-0.5" style="font-size: 14px;">Kampus Margadana</strong>
                                <span style="font-size: 12px; opacity: 0.9; line-height: 1.45; display: block;">Jl. Abdul Syukur No. 17, Margadana, Kota Tegal, Jawa Tengah 52143.</span>
                            </p>
                            <div class="d-flex flex-column gap-2 mt-2">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn-desk-action warning flex-fill" data-bs-toggle="modal" data-bs-target="#modalFotoMejaLayanan" onclick="openFotoModal()">
                                        <i class="fas fa-camera me-1.5"></i> Foto Meja Layanan
                                    </button>
                                    <a href="https://maps.google.com/?q=Politeknik+Keselamatan+Transportasi+Jalan+Kampus+2+Margadana" target="_blank" class="btn-desk-action primary flex-fill">
                                        <i class="fas fa-map-location-dot me-1.5"></i> Google Maps
                                    </a>
                                </div>
                                <a href="https://bpsdm.kemenhub.go.id/ppid/pktj/login" target="_blank" class="btn-desk-action secondary w-100 text-center">
                                    <i class="fas fa-file-signature me-1.5"></i> Ajukan Permohonan Online
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banner Hari Libur Sesuai Brosur Resmi UPT -->
                <div class="mt-4 p-3 rounded-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3" style="background: rgba(239, 68, 68, 0.18); border: 1px solid rgba(239, 68, 68, 0.35); backdrop-filter: blur(8px);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-danger bg-opacity-30 d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 42px; height: 42px;">
                            <i class="fas fa-calendar-xmark text-warning fs-5"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-0" style="font-size: 14.5px;">{{ $settings['jam_layanan_libur'] ?? 'Sabtu - Minggu dan Hari Besar Nasional (Libur)' }}</h6>
                            <p class="mb-0 text-white text-opacity-75 small">Layanan tatap muka di meja layanan tutup pada hari libur. Layanan permohonan daring (online) tetap aktif 24 jam melalui portal PPID & SP4N-LAPOR!.</p>
                        </div>
                    </div>
                    <span class="badge bg-danger text-white px-3.5 py-2 rounded-pill fw-bold text-uppercase flex-shrink-0" style="font-size: 11px; letter-spacing: 0.5px;">
                        <i class="fas fa-ban me-1"></i> Tutup Tatap Muka
                    </span>
                </div>
            </div>
        </div>

        <div class="premium-card p-4 p-md-5 animate__animated animate__fadeInUp">
            
            <!-- Success Alert -->
            @if(session('success_message'))
                <div class="alert alert-success border-0 rounded-4 p-4 mb-5 shadow-sm d-flex align-items-center gap-3 animate__animated animate__bounceIn" style="background-color: #ecfdf5; color: #065f46;">
                    <i class="fa-solid fa-circle-check fs-2 text-emerald-500" style="color: #10b981;"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Berhasil Terkirim</h5>
                        <p class="mb-0 text-sm opacity-90">{{ session('success_message') }}</p>
                    </div>
                </div>
            @endif

            <div class="row g-5">
                <!-- Left Column: Media & Channels -->
                <div class="col-lg-5">
                    <div class="pe-xl-4">
                        <span class="section-header-badge">
                            <i class="fa-solid fa-paper-plane"></i> PPID PKTJ Tegal
                        </span>
                        <h2 class="section-title outfit">Informasi, Saran & Pengaduan</h2>
                        
                        <div class="text-slate-500 mb-4 font-medium">
                            {!! $profil->konten_pembuka ?? '<p>Silakan sampaikan pertanyaan, permohonan informasi, aspirasi, atau pengaduan pelayanan publik Anda melalui kanal resmi SP4N-LAPOR! atau hubungi kami lewat jejaring sosial resmi kami di bawah ini.</p>' !!}
                        </div>

                        <!-- Social Media Icons Grid -->
                        @php
                            $instagram = !empty($settings['kontak_instagram_link']) && $settings['kontak_instagram_link'] !== '#' ? $settings['kontak_instagram_link'] : (!empty($settings['instagram_link']) && $settings['instagram_link'] !== '#' ? $settings['instagram_link'] : 'https://www.instagram.com/pktj_tegal/');
                            
                            $facebook = !empty($settings['kontak_facebook_link']) && $settings['kontak_facebook_link'] !== '#' ? $settings['kontak_facebook_link'] : (!empty($settings['facebook_link']) && $settings['facebook_link'] !== '#' ? $settings['facebook_link'] : 'https://www.facebook.com/PKTJTegal/');
                            
                            $twitter = !empty($settings['kontak_twitter_link']) && $settings['kontak_twitter_link'] !== '#' ? $settings['kontak_twitter_link'] : (!empty($settings['twitter_link']) && $settings['twitter_link'] !== '#' ? $settings['twitter_link'] : 'https://x.com/pktjtegal');
                            
                            $youtube = !empty($settings['kontak_youtube_link']) && $settings['kontak_youtube_link'] !== '#' ? $settings['kontak_youtube_link'] : (!empty($settings['youtube_link']) && $settings['youtube_link'] !== '#' ? $settings['youtube_link'] : 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA');
                            
                            $linktree = !empty($settings['kontak_linktree_link']) && $settings['kontak_linktree_link'] !== '#' ? $settings['kontak_linktree_link'] : (!empty($settings['linktree_link']) && $settings['linktree_link'] !== '#' ? $settings['linktree_link'] : 'https://linktr.ee/pktj_tegal');
                            
                            $whatsapp = !empty($settings['kontak_whatsapp_link']) && $settings['kontak_whatsapp_link'] !== '#' ? $settings['kontak_whatsapp_link'] : (!empty($settings['whatsapp_link']) && $settings['whatsapp_link'] !== '#' ? $settings['whatsapp_link'] : 'https://api.whatsapp.com/send/?phone=6281234700230&text&type=phone_number&app_absent=0');
                            
                            $tiktok = !empty($settings['kontak_tiktok_link']) && $settings['kontak_tiktok_link'] !== '#' ? $settings['kontak_tiktok_link'] : (!empty($settings['tiktok_link']) && $settings['tiktok_link'] !== '#' ? $settings['tiktok_link'] : 'https://www.tiktok.com/@pktj_tegal');
                            
                            $website = !empty($settings['kontak_website_link']) && $settings['kontak_website_link'] !== '#' ? $settings['kontak_website_link'] : (!empty($settings['website_link']) && $settings['website_link'] !== '#' ? $settings['website_link'] : 'https://pktj.ac.id');
                        @endphp
                        
                        <h5 class="outfit fw-extrabold text-slate-800 uppercase tracking-wider mb-3 mt-5" style="font-size: 11px;">Ikuti Saluran Resmi Kami</h5>
                        <div class="social-grid">
                            <!-- Instagram -->
                            <a href="{{ $instagram }}" target="_blank" class="social-item instagram">
                                <i class="fa-brands fa-instagram text-pink-600"></i>
                                <span>Instagram</span>
                            </a>
                            <!-- Facebook -->
                            <a href="{{ $facebook }}" target="_blank" class="social-item facebook">
                                <i class="fa-brands fa-facebook-f text-blue-600"></i>
                                <span>Facebook</span>
                            </a>
                            <!-- Twitter/X -->
                            <a href="{{ $twitter }}" target="_blank" class="social-item twitter" title="Twitter / X Resmi PPID PKTJ">
                                <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" class="social-x-icon" style="margin-bottom: 12px; transition: transform var(--transition-speed) ease;">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                <span>Twitter / X</span>
                            </a>
                            <!-- YouTube -->
                            <a href="{{ $youtube }}" target="_blank" class="social-item youtube">
                                <i class="fa-brands fa-youtube text-red-600"></i>
                                <span>YouTube</span>
                            </a>
                            <!-- Linktree -->
                            <a href="{{ $linktree }}" target="_blank" class="social-item linktree">
                                <i class="fa-solid fa-tree text-green-500"></i>
                                <span>Linktree</span>
                            </a>
                            <!-- WhatsApp -->
                            <a href="{{ $whatsapp }}" target="_blank" class="social-item whatsapp">
                                <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                <span>WhatsApp</span>
                            </a>
                            <!-- TikTok -->
                            <a href="{{ $tiktok }}" target="_blank" class="social-item tiktok">
                                <i class="fa-brands fa-tiktok text-slate-950"></i>
                                <span>TikTok</span>
                            </a>
                            <!-- Website -->
                            <a href="{{ $website }}" target="_blank" class="social-item website">
                                <i class="fa-solid fa-globe text-blue-500"></i>
                                <span>Website</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: SP4N-LAPOR! Official Grievance Channel -->
                <div class="col-lg-7">
                    <div class="sp4n-lapor-card">
                        <!-- Top Banner Header -->
                        <div class="sp4n-header">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                                <div class="sp4n-badge">
                                    <i class="fa-solid fa-bullhorn text-[#ffc107]"></i>
                                    <span>LAYANAN PENGADUAN NASIONAL</span>
                                </div>
                                <span class="sp4n-tag">KEMENHUB &amp; PKTJ TEGAL</span>
                            </div>
                            
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="sp4n-icon-circle">
                                    <i class="fa-solid fa-comments text-white fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="sp4n-title outfit">SP4N - LAPOR!</h3>
                                    <p class="sp4n-sub outfit">Layanan Aspirasi &amp; Pengaduan Online Rakyat</p>
                                </div>
                            </div>

                            <p class="sp4n-desc">
                                {{ $settings['span_lapor_deskripsi'] ?? 'Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional - Layanan Aspirasi dan Pengaduan Online Rakyat. Sampaikan kritik, aspirasi, saran, dan pengaduan pelayanan publik secara transparan, aman, dan langsung ditindaklanjuti oleh PPID PKTJ Tegal.' }}
                            </p>
                        </div>

                        <!-- 3 Pilar Jaminan SP4N -->
                        <div class="sp4n-body">
                            <div>
                                <h6 class="sp4n-pillars-heading outfit">JAMINAN &amp; STANDAR LAYANAN PENGADUAN</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="sp4n-pillar-box">
                                            <div class="sp4n-pillar-icon bg-blue-soft">
                                                <i class="fa-solid fa-user-shield text-[#004a99]"></i>
                                            </div>
                                            <h6 class="outfit">Anonim &amp; Rahasia</h6>
                                            <p>Identitas pelapor terjamin kerahasiaannya sesuai UU No. 25 Tahun 2009.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="sp4n-pillar-box">
                                            <div class="sp4n-pillar-icon bg-gold-soft">
                                                <i class="fa-solid fa-qrcode text-[#d97706]"></i>
                                            </div>
                                            <h6 class="outfit">Tracking ID Unik</h6>
                                            <p>Pantau progres dan tindak lanjut aduan secara realtime melalui kode laporan.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="sp4n-pillar-box">
                                            <div class="sp4n-pillar-icon bg-emerald-soft">
                                                <i class="fa-solid fa-bolt text-[#059669]"></i>
                                            </div>
                                            <h6 class="outfit">Respon Cepat</h6>
                                            <p>Laporan langsung diverifikasi dan ditindaklanjuti secara resmi oleh tim PKTJ.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- CTA Action Buttons -->
                                <div class="sp4n-actions">
                                    <a href="{{ $settings['span_lapor_link'] ?? 'https://www.lapor.go.id/instansi/politeknik-keselamatan-transportasi-jalan-tegal' }}" target="_blank" rel="noopener" class="btn-sp4n-primary">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        <span>BUAT LAPORAN / PENGADUAN SEKARANG</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square fs-6 opacity-75"></i>
                                    </a>
                                    <a href="https://www.lapor.go.id" target="_blank" rel="noopener" class="btn-sp4n-secondary">
                                        <i class="fa-solid fa-globe"></i>
                                        <span>Portal www.lapor.go.id</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Hotline / SMS Section -->
                        <div class="sp4n-footer-info">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="sp4n-sms-badge">
                                    <i class="fa-solid fa-comment-sms"></i> SMS 1708
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campus Contact Cards (Kampus I & II) -->
        <h3 class="campus-section-title outfit">Lokasi Kampus Politeknik Keselamatan Transportasi Jalan</h3>
        
        <div class="row g-4 mt-2">
            <!-- Kampus I Card -->
            <div class="col-lg-6">
                <div class="campus-card">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="outfit fw-black text-slate-900 mb-3" style="font-size: 20px; line-height: 1.3;">
                                    Kampus Perintis
                                </h4>
                                <ul class="campus-info-list">
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>{{ $settings['kontak_kampus_1_alamat'] ?? 'Jl. Perintis Kemerdekaan No. 17, Slerok, Tegal Timur, Kota Tegal' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-wrapper">
                                @if(isset($settings['kontak_kampus_1_map']) && !empty($settings['kontak_kampus_1_map']))
                                    {!! $settings['kontak_kampus_1_map'] !!}
                                @else
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.23846665793!2d109.1396263!3d-6.8687256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb797c0000001%3A0xbd8ffc1a1154737d!2sPoliteknik%20Keselamatan%20Transportasi%20Jalan!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kampus II Card -->
            <div class="col-lg-6">
                <div class="campus-card">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="outfit fw-black text-slate-900 mb-3" style="font-size: 20px; line-height: 1.3;">
                                    Kampus Margadana
                                </h4>
                                <ul class="campus-info-list">
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>{{ $settings['kontak_kampus_2_alamat'] ?? 'Jl. KH. Abdul Syukur No. 17, Margadana, Kota Tegal' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-wrapper">
                                @if(isset($settings['kontak_kampus_2_map']) && !empty($settings['kontak_kampus_2_map']))
                                    {!! $settings['kontak_kampus_2_map'] !!}
                                @else
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.077224213794!2d109.09886317578768!3d-6.882898767355088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb86a87799d19%3A0x644265697669d255!2sPKTJ%20Kampus%20I!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <!-- MODAL FOTO MEJA LAYANAN & FORMULIR FISIK (AKIP C.1 & C.2) -->
    <div class="modal fade" id="modalFotoMejaLayanan" tabindex="-1" aria-labelledby="modalFotoMejaLayananLabel" aria-hidden="true" style="z-index: 99999;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: linear-gradient(135deg, #002b5c, #004a99) !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-building text-warning fs-5"></i>
                        <h5 class="modal-title outfit fw-bold mb-0 text-white" id="modalFotoMejaLayananLabel">Sarana & Jam Pelayanan Informasi Publik Terpadu (AKIP C.1 & C.2)</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closeFotoModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                                <div class="card-header bg-white py-2 fw-bold text-dark small">
                                    <i class="fas fa-clock text-amber-500 me-1"></i> Jam Pelayanan & Alur Permohonan
                                </div>
                                <img src="{{ asset('images/sarana/jam-pelayanan-ppid.jpg') }}" class="card-img-top img-fluid" alt="Jam Pelayanan & Alur Permohonan Informasi PPID PKTJ" style="object-fit: cover; max-height: 250px;">
                                <div class="card-body p-2.5">
                                    <p class="small text-muted mb-0">Brosur resmi jam pelayanan & alur permohonan informasi PPID Pelaksana UPT PKTJ.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                                <div class="card-header bg-white py-2 fw-bold text-dark small">
                                    <i class="fas fa-desktop text-primary me-1"></i> Desk / Meja Layanan PPID (C.1)
                                </div>
                                <img src="{{ asset('images/sarana/meja-layanan-ppid.png') }}" class="card-img-top img-fluid" alt="Meja Layanan PPID PKTJ" style="object-fit: cover; max-height: 250px;">
                                <div class="card-body p-2.5">
                                    <p class="small text-muted mb-0">Lokasi: Meja Layanan Terpadu Kampus Margadana Kota Tegal.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                                <div class="card-header bg-white py-2 fw-bold text-dark small">
                                    <i class="fas fa-file-alt text-warning me-1"></i> Formulir Permohonan & Keberatan Fisik (C.2)
                                </div>
                                <img src="{{ asset('images/sarana/formulir-meja-layanan.jpg') }}" class="card-img-top img-fluid" alt="Formulir Fisik Meja Layanan" style="object-fit: cover; max-height: 250px;">
                                <div class="card-body p-2.5">
                                    <p class="small text-muted mb-0">Ketersediaan formulir fisik permohonan informasi & pengajuan keberatan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3 pt-2 border-top">
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4 fw-bold" data-bs-dismiss="modal" onclick="closeFotoModal()">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({duration: 800, once: true});

        function openFotoModal() {
            const modalEl = document.getElementById('modalFotoMejaLayanan');
            if (!modalEl) return;
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const inst = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    inst.show();
                    return;
                }
            } catch(e) {}
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
            modalEl.removeAttribute('aria-hidden');
            let backdrop = document.querySelector('.modal-backdrop');
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                document.body.appendChild(backdrop);
            }
            document.body.classList.add('modal-open');
        }

        function closeFotoModal() {
            const modalEl = document.getElementById('modalFotoMejaLayanan');
            if (!modalEl) return;
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const inst = bootstrap.Modal.getInstance(modalEl);
                    if (inst) inst.hide();
                }
            } catch(e) {}
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('modalFotoMejaLayanan');
            if (modalEl) {
                modalEl.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeFotoModal();
                    }
                });
            }
        });
    </script>
</body>
</html>
