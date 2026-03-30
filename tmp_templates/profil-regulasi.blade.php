<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Regulasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1589829545856-d10d557cf95f?q=80&w=2070" }}');
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
        .regulation-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .regulation-card:hover {
            transform: translateX(10px);
            border-color: var(--primary-blue);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .reg-icon {
            width: 50px;
            height: 50px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            font-size: 20px;
            margin-right: 20px;
        }
        .btn-dl {
            background: var(--primary-blue);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-dl:hover {
            background: #003d80;
            color: white;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="page-title">{{ $profil->judul ?? 'Regulasi' }}</h1>
            <p class="hero-tagline">{{ $profil->tagline_hero ?? 'Landasan Hukum Keterbukaan Informasi Publik' }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            @if($profil)
                <div class="rich-text mb-4">
                    {!! $profil->konten_pembuka !!}
                </div>

                @if($profil->judul_sub || $profil->konten_detail)
                    <h3 class="section-title mt-5">{{ $profil->judul_sub ?? 'Daftar Peraturan' }}</h3>
                    <div class="rich-text">
                        {!! $profil->konten_detail !!}
                    </div>
                @endif
                
                {{-- Dynamic Peraturan Groups --}}
                @foreach($peraturan as $category => $items)
                    <h4 class="fw-bold mt-5 mb-4 text-primary"><i class="fas fa-layer-group me-2"></i>{{ $category }}</h4>
                    @foreach($items as $reg)
                        <div class="regulation-card">
                            <div class="d-flex align-items-center">
                                <div class="reg-icon"><i class="fas fa-file-pdf"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $reg->nama }}</h6>
                                    <small class="text-muted">{{ $reg->nomor ?? 'Tahun '.$reg->tahun }}</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/'.$reg->file_path) }}" target="_blank" class="btn-dl">
                                <i class="fas fa-download me-2"></i>Download
                            </a>
                        </div>
                    @endforeach
                @endforeach

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
                    <i class="fas fa-gavel fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Konten Regulasi belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
