<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068" }}');
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
        .info-category {
            background: #f1f5f9;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-blue);
            display: flex;
            align-items: center;
        }
        .info-category i {
            font-size: 24px;
            color: var(--primary-blue);
            margin-right: 15px;
        }
        .info-category h4 { margin: 0; font-weight: 700; color: #1e293b; }

        .info-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 12px;
            transition: all 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .info-card:hover { background: #f8f9fa; border-color: var(--primary-blue); transform: scale(1.01); }
        .btn-download {
            background: var(--primary-blue);
            color: white;
            padding: 5px 15px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
        }
        .btn-download:hover { background: #003d80; color: white; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold uppercase">{{ $profil->tagline_hero ?? 'Daftar Informasi Publik' }}</h1>
            <p class="lead opacity-75">Katalog lengkap informasi yang tersedia di PPID PKTJ</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <div class="mb-5">
                {!! $profil->konten_pembuka !!}
            </div>

            <!-- Berkala -->
            <div class="info-category mt-5">
                <i class="fas fa-calendar-check text-primary"></i>
                <h4>Informasi Berkala</h4>
            </div>
            @forelse($berkala as $item)
                <div class="info-card">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->deskripsi }}</small>
                    </div>
                    <a href="{{ route('download.file', ['model' => 'berkala', 'id' => $item->id]) }}" class="btn-download">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            @empty
                <p class="text-muted text-center py-3">Belum ada data tersedia.</p>
            @endforelse

            <!-- Serta Merta -->
            <div class="info-category mt-5">
                <i class="fas fa-exclamation-triangle text-danger"></i>
                <h4>Informasi Serta Merta</h4>
            </div>
            @forelse($sertamerta as $item)
                <div class="info-card">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->deskripsi }}</small>
                    </div>
                    <a href="{{ route('download.file', ['model' => 'sertamerta', 'id' => $item->id]) }}" class="btn-download">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            @empty
                <p class="text-muted text-center py-3">Belum ada data tersedia.</p>
            @endforelse

            <!-- Setiap Saat -->
            <div class="info-category mt-5">
                <i class="fas fa-history text-success"></i>
                <h4>Informasi Setiap Saat</h4>
            </div>
            @forelse($setiapsaat as $item)
                <div class="info-card">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->deskripsi }}</small>
                    </div>
                    <a href="{{ route('download.file', ['model' => 'setiapsaat', 'id' => $item->id]) }}" class="btn-download">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            @empty
                <p class="text-muted text-center py-3">Belum ada data tersedia.</p>
            @endforelse

            @if($profil->konten_detail)
                <div class="mt-5 pt-4 border-t">
                    {!! $profil->konten_detail !!}
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
