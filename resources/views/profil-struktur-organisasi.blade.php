<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Struktur Organisasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
            --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
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
            background: linear-gradient(-45deg, var(--primary-blue), #0066CC, #1A3A52, #002b5c);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.1);
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

        /* Organizational Chart Styling */
        .org-chart { text-align: center; padding: 40px 0; }
        .org-level { margin: 30px 0; }
        .org-box {
            background: white;
            color: var(--primary-blue);
            padding: 25px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 74, 153, 0.1);
            min-width: 250px;
            border: 2px solid var(--primary-blue);
            transition: transform 0.3s ease;
        }
        .org-box:hover { transform: translateY(-5px); }
        .org-box.director {
            background: var(--primary-blue);
            color: white;
            border: 2px solid var(--secondary-gold);
        }
        .org-line {
            border-left: 3px dashed var(--secondary-gold);
            height: 40px;
            margin: 0 auto;
            width: 3px;
        }
        .org-box strong { display: block; font-size: 1.1rem; margin-bottom: 5px; font-family: 'Outfit', sans-serif; }
        .org-box small { opacity: 0.8; font-weight: 500; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Struktur Organisasi' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Susunan Organisasi Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            @if($profil)
                @if($profil->konten_pembuka)
                    <div class="mb-5 rich-content">
                        <h2 class="section-title">Dasar Struktur</h2>
                        <div class="text-justify">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    </div>
                @endif

                @if($profil->additional_sections)
                    @foreach($profil->additional_sections as $section)
                        <div class="mb-5">
                            <h2 class="section-title">{{ $section['title'] }}</h2>
                            
                            @if(($section['layout'] ?? 'default') === 'diagram')
                                <div class="org-chart">
                                    <div class="org-level">
                                        <div class="org-box director">
                                            <strong>{{ $settings['struktur_role_1'] ?? 'DIREKTUR PKTJ' }}</strong>
                                            <small>{{ $settings['struktur_sub_1'] ?? 'Pembina PPID' }}</small>
                                        </div>
                                    </div>

                                    <div class="org-line"></div>

                                    <div class="org-level">
                                        <div class="org-box">
                                            <strong>{{ $settings['struktur_role_2'] ?? 'KOORDINATOR PPID' }}</strong>
                                            <small>{{ $settings['struktur_sub_2'] ?? 'Kepala Bagian/Program' }}</small>
                                        </div>
                                    </div>

                                    <div class="org-line"></div>

                                    <div class="org-level d-flex flex-wrap justify-content-center gap-4">
                                        <div class="org-box">
                                            <strong>{{ $settings['struktur_role_3'] ?? 'TIM PPID' }}</strong>
                                            <small>{{ $settings['struktur_sub_3'] ?? 'Staff Teknis' }}</small>
                                        </div>
                                        <div class="org-box">
                                            <strong>{{ $settings['struktur_role_4'] ?? 'TIM PPID' }}</strong>
                                            <small>{{ $settings['struktur_sub_4'] ?? 'Staff Teknis' }}</small>
                                        </div>
                                        <div class="org-box">
                                            <strong>{{ $settings['struktur_role_5'] ?? 'TIM PPID' }}</strong>
                                            <small>{{ $settings['struktur_sub_5'] ?? 'Staff Teknis' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rich-content">
                                    {!! $section['content'] !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-sitemap fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Bagan Belum Tersedia</h3>
                    <p class="text-muted">Administrator sedang menyusun bagan organisasi terbaru.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
