<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Struktur Organisasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=2069" }}');
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
        .org-chart { text-align: center; padding: 40px 0; }
        .org-box { background: linear-gradient(135deg, var(--primary-blue) 0%, #0066cc 100%); color: white; padding: 25px; border-radius: 15px; margin: 10px; display: inline-block; box-shadow: 0 4px 20px rgba(0,0,0,0.15); min-width: 250px; }
        .org-box.director { background: linear-gradient(135deg, var(--secondary-gold) 0%, #c9a227 100%); color: #1e293b; font-weight: 800; }
        .org-line { border-left: 2px dashed var(--secondary-gold); height: 40px; margin: 0 auto; width: 0; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="page-title">{{ $profil->judul ?? 'Struktur Organisasi' }}</h1>
            <p class="hero-tagline">{{ $profil->tagline_hero ?? 'Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            @if($profil)
                <div class="rich-text mb-4">
                    {!! $profil->konten_pembuka !!}
                </div>

                @if($profil->judul_sub || $profil->konten_detail)
                    <h3 class="section-title mt-5">{{ $profil->judul_sub ?? 'Bagan Struktur' }}</h3>
                    <div class="rich-text">
                        {!! $profil->konten_detail !!}
                    </div>
                @endif
                
                @if($profil->gambar)
                    <div class="text-center mt-5">
                        <img src="{{ asset('storage/profil/' . $profil->gambar) }}" alt="Bagan Struktur" class="img-fluid rounded-4 shadow-lg border">
                    </div>
                @endif

                {{-- Fallback for Chart if no custom image/sections --}}
                @if(!$profil->gambar && !$profil->additional_sections)
                    <div class="org-chart">
                        <div class="org-box director">
                            <i class="fas fa-user-tie fa-2x mb-2"></i><br>
                            <strong>PENANGGUNG JAWAB</strong><br>
                            <small>Direktur PKTJ</small>
                        </div>
                        <div class="org-line"></div>
                        <div class="org-box">
                            <i class="fas fa-user-shield fa-2x mb-2"></i><br>
                            <strong>KOORDINATOR PPID</strong><br>
                            <small>Kepala Bagian Umum</small>
                        </div>
                        <div class="org-line"></div>
                        <div class="org-level d-flex justify-content-center flex-wrap">
                            <div class="org-box m-2"><strong>TIM DATA</strong></div>
                            <div class="org-box m-2"><strong>TIM LAYANAN</strong></div>
                            <div class="org-box m-2"><strong>TIM HUKUM</strong></div>
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
                    <i class="fas fa-sitemap fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Konten Struktur Organisasi belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
