<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['sop_permintaan_judul_hero'] ?? 'Prosedur Permintaan Informasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['sop_permintaan_tagline_hero'] ?? 'Prosedur Standar Layanan Informasi Publik PPID PKTJ' }}">
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
        <div class="hero-overlay"></div>
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-clipboard-list me-2"></i> Prosedur PPID
            </div>
            <h1 class="hero-title outfit">{{ $settings['sop_permintaan_judul_hero'] ?? 'Prosedur Permintaan Informasi' }}</h1>
            <p class="hero-tagline">{{ $settings['sop_permintaan_tagline_hero'] ?? 'Prosedur Standar Layanan Informasi Publik' }}</p>
        </div>
    </div>

    @php
        $d = $settings ?? [];
        $rawKonten = ($d['sop_permintaan_isi_konten'] ?? '') . ($d['sop_permintaan_konten'] ?? '') . ($d['sop_permintaan_isi_maklumat'] ?? '');
        $hasText = !empty(trim(strip_tags($rawKonten)));
        $hasDocs = isset($laporan) && $laporan->count() > 0;
        $hasContent = $hasText || $hasDocs;
    @endphp

    @if($hasContent)
    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @include('components.konten-dinamis', ['prefix' => 'sop_permintaan'])
        </div>
    </div>
    @endif

    {{-- ============================================================ --}}
    {{-- DENAH ALUR DIAGRAM SOP PERMINTAAN INTERAKTIF (DATABASE-DRIVEN) --}}
    {{-- ============================================================ --}}
    @include('components.sop-diagram-roadmap', ['pKey' => 'sop_perm'])

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({ duration: 800, once: true });
            }
        });
    </script>
</body>
</html>
