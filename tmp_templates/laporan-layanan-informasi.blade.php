<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->title ?? 'SOP' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
            line-height: 1.6;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070" }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
        }
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }
        .section-title {
            color: var(--primary-blue);
            font-weight: 800;
            margin-bottom: 25px;
            border-left: 5px solid var(--secondary-gold);
            padding-left: 15px;
        }
        .profil-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        .btn-download-sop {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background: var(--primary-blue);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            margin-top: 20px;
        }
        .btn-download-sop:hover {
            background: #003d80;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold uppercase">{{ $profil->tagline_hero ?? $profil->title }}</h1>
            <p class="lead opacity-75">Statistik & Laporan Layanan Informasi Publik</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="section-title">{{ $profil->judul ?? $profil->title }}</h2>
            
            <div class="profil-content">
                {!! $profil->konten_pembuka !!}
            </div>

            @if($profil->gambar)
                <div class="text-center my-5">
                    <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="{{ $profil->title }}" class="img-fluid rounded shadow">
                </div>
            @endif

            <div class="profil-content mt-4">
                {!! $profil->konten_detail !!}
            </div>

            @if($profil->link_dokumen)
                <div class="mt-5 p-4 bg-light rounded-4 border-l-4 border-primary">
                    <h5 class="fw-bold"><i class="fas fa-file-pdf me-2"></i>Unduh Dokumen Lengkap</h5>
                    <p class="text-muted small">Klik tombol di bawah ini untuk mengunduh dokumen resmi SOP ini.</p>
                    <a href="{{ $profil->link_dokumen }}" target="_blank" class="btn-download-sop">
                        <i class="fas fa-download me-2"></i>Download SOP (PDF)
                    </a>
                </div>
            @endif

            @if($profil->additional_sections)
                @foreach($profil->additional_sections as $section)
                    <div class="mt-5">
                        <h2 class="section-title">{{ $section['title'] }}</h2>
                        <div class="profil-content">
                            {!! $section['content'] !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
