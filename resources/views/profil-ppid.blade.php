<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Profil PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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

        .text-justify { text-align: justify; }

        .image-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin: 30px 0;
        }

        .btn-download {
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            text-transform: uppercase;
            transition: all 0.3s;
            border: none;
        }

        .btn-download:hover {
            background: #003770;
            transform: translateY(-3px);
            color: white;
            box-shadow: 0 10px 20px rgba(0, 74, 153, 0.2);
        }

        /* Rich Editor Content Styling */
        .rich-content {
            font-size: 1.05rem;
            color: #334155;
        }
        
        .rich-content p { margin-bottom: 1.5rem; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Profil PPID' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Mengenal Lebih Dekat Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            @if($profil)
                <h2 class="section-title">{{ $profil->judul }}</h2>
                
                <div class="rich-content">
                    @if($profil->konten_pembuka)
                        <div class="text-justify mb-4">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    @endif
                    
                    @if($profil->judul_sub)
                        <h3 class="outfit fw-bold text-dark mb-3 mt-5">{{ $profil->judul_sub }}</h3>
                    @endif
                    
                    @if($profil->konten_detail)
                        <div class="text-justify">
                            {!! $profil->konten_detail !!}
                        </div>
                    @endif
                    
                    @if($profil->gambar)
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="w-100 h-auto">
                        </div>
                    @endif
                    
                    @if($profil->link_dokumen)
                        <div class="mt-5 text-center">
                            <a href="{{ $profil->link_dokumen }}" target="_blank" class="btn-download btn-lg">
                                <i class="fas fa-file-pdf me-2"></i> Download Dokumen Profil Lengkap
                            </a>
                        </div>
                    @endif
                </div>

                @if($profil->gambaran)
                    <div class="mt-5 pt-4 border-top">
                        <h3 class="section-title" style="font-size: 1.8rem;">Gambaran Umum</h3>
                        <div class="rich-content text-justify">
                            {!! $profil->gambaran !!}
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-info-circle fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Konten Belum Tersedia</h3>
                    <p class="text-muted">Administrator sedang mempersiapkan informasi profil untuk Anda.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>
