<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['sop_sengketa_judul_hero'] ?? 'SOP Pengajuan Sengketa' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['sop_sengketa_tagline_hero'] ?? 'Prosedur Penyelesaian Sengketa Informasi Publik PPID PKTJ' }}">
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
                <i class="fas fa-balance-scale me-2"></i> Prosedur Sengketa
            </div>
            <h1 class="hero-title outfit">{{ $settings['sop_sengketa_judul_hero'] ?? 'SOP Pengajuan Sengketa' }}</h1>
            <p class="hero-tagline">{{ $settings['sop_sengketa_tagline_hero'] ?? 'Prosedur Penyelesaian Sengketa Informasi Publik' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card">
            @php
                $d = $settings ?? [];
                $hasContent = ($d['sop_sengketa_isi_konten'] ?? null) ||
                              ($d['sop_sengketa_gambar_sop'] ?? null) ||
                              ($d['sop_sengketa_gambar_proses'] ?? null) ||
                              ($d['sop_sengketa_youtube_link'] ?? null) ||
                              ($d['sop_sengketa_isi_maklumat'] ?? null) ||
                              (isset($laporan) && $laporan->count() > 0);
            @endphp

            @if($hasContent)
                @include('components.konten-dinamis', ['prefix' => 'sop_sengketa'])
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3>Konten Sedang Disiapkan</h3>
                    <p>Informasi mengenai SOP Pengajuan Sengketa sedang dalam proses penyusunan oleh tim PPID PKTJ.</p>
                    <a href="{{ route('layanan.daftar-informasi') }}" class="btn-action">
                        <i class="fas fa-info-circle me-2"></i> Lihat Daftar Informasi
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
