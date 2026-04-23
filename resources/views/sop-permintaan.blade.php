<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['sop_permintaan_judul_hero'] ?? 'SOP Permintaan Informasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-2">{{ $settings['sop_permintaan_judul_hero'] ?? 'SOP Permintaan' }}</h1>
            <p class="lead opacity-75">{{ $settings['sop_permintaan_tagline_hero'] ?? 'Prosedur Standar Layanan Informasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            <h2 class="section-title">{{ $settings['sop_permintaan_judul_hero'] ?? 'SOP Permintaan Informasi Publik' }}</h2>
            
            <div class="rich-content">
                @include('components.konten-dinamis', ['prefix' => 'sop_permintaan'])
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
