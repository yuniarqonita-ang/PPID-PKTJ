<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Visi dan Misi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
            --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
        }
        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8faff;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069" }}');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .hero-tagline {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
        }
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .section-title {
            color: var(--primary-blue);
            font-weight: 800;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-gold);
            border-radius: 2px;
        }
        .rich-text {
            line-height: 1.8;
            font-size: 1.1rem;
            text-align: justify;
        }
        .vision-card {
            background: #f1f5f9;
            border-left: 5px solid var(--secondary-gold);
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 0 15px 15px 0;
        }
        .mission-item {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: flex-start;
        }
        .mission-number {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="page-title">{{ $profil->judul ?? 'Visi dan Misi' }}</h1>
            <p class="hero-tagline">{{ $profil->tagline_hero ?? ($settings['hero_subtitle'] ?? 'Layanan Informasi Publik Terintegrasi dan Transparan') }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            @if($profil)
                <div class="rich-text mb-4">
                    {!! $profil->konten_pembuka !!}
                </div>

                @if($profil->judul_sub || $profil->konten_detail)
                    <h3 class="section-title mt-5">{{ $profil->judul_sub ?? 'Detail Informasi' }}</h3>
                    <div class="rich-text">
                        {!! $profil->konten_detail !!}
                    </div>
                @endif
                
                {{-- Fallback for Visi Misi if no additional sections --}}
                @if(!$profil->additional_sections)
                    <div class="vision-card mt-5">
                        <h3 class="fw-bold mb-3 text-primary">VISI</h3>
                        <p class="mb-0 fs-5">Terwujudnya layanan informasi publik yang Transparan, Objektif dan Prima.</p>
                    </div>
                    
                    <h3 class="section-title mt-5">MISI</h3>
                    <div class="mt-4">
                        <div class="mission-item">
                            <div class="mission-number">1</div>
                            <div class="fs-5">Menjamin akses informasi publik sesuai Undang-Undang No. 14 tahun 2008.</div>
                        </div>
                        <div class="mission-item">
                            <div class="mission-number">2</div>
                            <div class="fs-5">Meningkatkan kualitas layanan informasi publik yang akuntabel.</div>
                        </div>
                    </div>
                @endif

                @if($profil->additional_sections)
                    @foreach($profil->additional_sections as $section)
                        <div class="mt-5 p-4 border rounded-4 bg-light shadow-sm">
                            <h3 class="section-title">{{ $section['title'] }}</h3>
                            <div class="rich-text">
                                {!! $section['content'] !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-bullseye fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Konten Visi & Misi belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
