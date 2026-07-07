<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['sop_permintaan_judul_hero'] ?? 'Prosedur Permintaan Informasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['sop_permintaan_tagline_hero'] ?? 'Alur dan prosedur permintaan informasi publik PPID PKTJ' }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-file-alt me-2"></i> Prosedur Layanan
            </div>
            <h1 class="hero-title outfit">{{ $settings['sop_permintaan_judul_hero'] ?? 'Prosedur Permintaan Informasi' }}</h1>
            <p class="hero-tagline">{{ $settings['sop_permintaan_tagline_hero'] ?? 'Alur dan prosedur permintaan informasi publik PPID PKTJ' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @php
                $d = $settings ?? [];
                $hasContent = ($d['sop_permintaan_isi_konten'] ?? null) ||
                              ($d['sop_permintaan_gambar_sop'] ?? null) ||
                              ($d['sop_permintaan_gambar_proses'] ?? null) ||
                              ($d['sop_permintaan_youtube_link'] ?? null) ||
                              ($d['sop_permintaan_isi_maklumat'] ?? null);
            @endphp

            @if($hasContent)
                @include('components.konten-dinamis', ['prefix' => 'sop_permintaan'])
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Konten Sedang Disiapkan</h3>
                    <p>Informasi mengenai Prosedur Permintaan Informasi sedang dalam proses penyusunan oleh tim PPID PKTJ.</p>
                    <a href="{{ route('permohonan.form') }}" class="btn-action btn-action-gold">
                        <i class="fas fa-paper-plane"></i> Ajukan Permohonan Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
