<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Kontak' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1516387933999-ed3315b13d74?q=80&w=2070" }}');
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
        .contact-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 74, 153, 0.1);
            border-color: var(--primary-blue);
        }
        .contact-icon {
            width: 70px;
            height: 70px;
            background: #f1f5f9;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            font-size: 30px;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="page-title">{{ $profil->judul ?? 'Kontak PPID' }}</h1>
            <p class="hero-tagline">{{ $profil->tagline_hero ?? 'Kami siap melayani kebutuhan informasi publik Anda' }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            @if($profil)
                <div class="rich-text mb-4 text-center">
                    {!! $profil->konten_pembuka !!}
                </div>

                <div class="row g-4 mt-4">
                    {{-- Standard Contact Cards --}}
                    <div class="col-md-4">
                        <div class="contact-card">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <h4 class="fw-bold mb-3">Alamat</h4>
                            <p class="text-muted">{{ $settings['ppid_alamat'] ?? 'Jl. Medan Merdeka Barat No. 8, Jakarta Pusat' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-card">
                            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <h4 class="fw-bold mb-3">Telepon</h4>
                            <p class="text-muted">{{ $settings['ppid_telp'] ?? '(021) 3847790' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-card">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <h4 class="fw-bold mb-3">Email</h4>
                            <p class="text-muted">{{ $settings['ppid_email'] ?? 'ppid@pktj.ac.id' }}</p>
                        </div>
                    </div>
                </div>

                @if($profil->judul_sub || $profil->konten_detail)
                    <h3 class="section-title mt-5">{{ $profil->judul_sub ?? 'Detail Jam Layanan' }}</h3>
                    <div class="rich-text">
                        {!! $profil->konten_detail !!}
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
                    <i class="fas fa-headset fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Konten Kontak belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
