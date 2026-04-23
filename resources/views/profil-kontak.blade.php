<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Kontak PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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

        .contact-method {
            background: #f8fafc;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .contact-method:hover {
            transform: translateY(-5px);
            border-color: var(--primary-blue);
            box-shadow: 0 15px 30px rgba(0, 74, 153, 0.05);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            box-shadow: 0 8px 15px rgba(0, 74, 153, 0.2);
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Hubungi Kami' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Kami Siap Melayani Kebutuhan Informasi Anda' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            @if($profil)
                <h2 class="section-title">Informasi Kontak</h2>
                
                @if($profil->konten_pembuka)
                    <div class="rich-content mb-5">
                        {!! $profil->konten_pembuka !!}
                    </div>
                @endif

                <div class="row g-4">
                    @if($profil->additional_sections)
                        @foreach($profil->additional_sections as $section)
                            <div class="col-md-6">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <h4 class="outfit fw-bold text-blue-900 mb-2">{{ $section['title'] }}</h4>
                                    <div class="rich-content">
                                        {!! $section['content'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if($profil->konten_detail)
                    <div class="mt-5 rich-content">
                        <div class="p-4 bg-light rounded-4 border">
                            {!! $profil->konten_detail !!}
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-headset fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Konten Belum Tersedia</h3>
                    <p class="text-muted">Tim kami sedang mempersiapkan informasi kontak lengkap.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
