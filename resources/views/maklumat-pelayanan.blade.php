<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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
            background: linear-gradient(rgba(0, 74, 153, 0.9), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 60px;
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0, 74, 153, 0.1);
            margin-top: -80px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 40px;
            border-left: 8px solid var(--secondary-gold);
            padding-left: 25px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
        }

        .rich-content {
            font-size: 1.15rem;
            color: #334155;
            line-height: 1.8;
        }

        .rich-content h3 {
            color: var(--primary-blue);
            font-weight: 800;
            margin-top: 40px;
            margin-bottom: 20px;
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-2">{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }}</h1>
            <p class="lead opacity-75">{{ $settings['maklumat_pelayanan_tagline_hero'] ?? 'Standar Komitmen Kami Terhadap Publik' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            <h2 class="section-title">{{ $settings['maklumat_pelayanan_judul_maklumat'] ?? $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan PPID PKTJ' }}</h2>
            
            @if(isset($settings['maklumat_pelayanan_isi_maklumat']) && $settings['maklumat_pelayanan_isi_maklumat'])
            <div class="rich-content mb-4">
                {!! $settings['maklumat_pelayanan_isi_maklumat'] !!}
            </div>
            @endif

            @if(isset($settings['maklumat_pelayanan_gambar_maklumat']) && $settings['maklumat_pelayanan_gambar_maklumat'])
            <div class="text-center mt-4">
                <img src="{{ asset('storage/halaman/'.$settings['maklumat_pelayanan_gambar_maklumat']) }}" 
                     alt="Maklumat Pelayanan PPID PKTJ" 
                     class="img-fluid rounded shadow" 
                     style="max-height: 700px; margin: 0 auto;">
            </div>
            @else
            <div class="rich-content">
                @include('components.konten-dinamis', ['prefix' => 'maklumat_pelayanan'])
            </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
