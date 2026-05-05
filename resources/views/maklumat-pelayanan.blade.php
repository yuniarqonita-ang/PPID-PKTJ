<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['maklumat_pelayanan_tagline_hero'] ?? 'Standar Komitmen Pelayanan Informasi Publik PPID PKTJ' }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
</head>
<body>
    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-handshake me-2"></i> Layanan Informasi
            </div>
            <h1 class="hero-title outfit">{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }}</h1>
            <p class="hero-tagline">{{ $settings['maklumat_pelayanan_tagline_hero'] ?? 'Standar Komitmen Kami Terhadap Publik' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card">
            @php
                $d = $settings ?? [];
                $pfx = 'maklumat_pelayanan';
                $hasContent = ($d[$pfx.'_isi_maklumat'] ?? null) ||
                              ($d[$pfx.'_gambar_maklumat'] ?? null) ||
                              ($d[$pfx.'_judul_maklumat'] ?? null) ||
                              ($d[$pfx.'_judul_hero'] ?? null);
            @endphp

            @if($hasContent)
                @include('components.konten-dinamis', ['prefix' => 'maklumat_pelayanan'])
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Maklumat Pelayanan Sedang Disiapkan</h3>
                    <p>Maklumat Pelayanan PPID {{ $settings['ppid_nama'] ?? 'PKTJ' }} sedang dalam proses penyusunan. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                    <a href="{{ route('profil.kontak') }}" class="btn-action">
                        <i class="fas fa-envelope me-2"></i> Hubungi Kami
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
