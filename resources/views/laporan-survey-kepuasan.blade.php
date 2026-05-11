<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Hasil indeks kepuasan masyarakat terhadap pelayanan informasi publik PPID PKTJ">
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
                <i class="fas fa-poll me-2"></i> Survey Kepuasan
            </div>
            <h1 class="hero-title outfit">{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}</h1>
            <p class="hero-tagline">{{ $settings['laporan_survey_tagline_hero'] ?? 'Hasil Indeks Kepuasan Masyarakat terhadap Pelayanan Informasi Publik' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card">
            @php
                $d = $settings ?? [];
                $pfx = 'laporan_survey';
                $hasContent = ($d[$pfx.'_ringkasan_eksekutif'] ?? null) ||
                              ($d[$pfx.'_isi_laporan'] ?? null) ||
                              ($d[$pfx.'_file_laporan'] ?? null) ||
                              ($d[$pfx.'_judul_hero'] ?? null);
            @endphp

            @if($hasContent)
                {{-- Konten dinamis dari admin panel (ringkasan, detail laporan, dll) --}}
                @include('components.konten-dinamis', ['prefix' => 'laporan_survey'])

                {{-- Tombol download PDF jika tersedia --}}
                @if(!empty($d['laporan_survey_file_laporan']))
                <div class="mt-4 text-center pt-4" style="border-top: 2px solid #f0f4f8;">
                    <button type="button" 
                            class="btn-action btn-action-gold" 
                            data-bs-toggle="modal" 
                            data-bs-target="#previewModal" 
                            data-url="{{ route('preview.dokumen', ['file' => 'storage/halaman/' . $d['laporan_survey_file_laporan'], 'title' => 'Laporan Survey Kepuasan']) }}">
                        <i class="fas fa-eye"></i> Lihat Laporan Survey
                    </button>
                </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-poll"></i>
                    </div>
                    <h3>Laporan Belum Tersedia</h3>
                    <p>Laporan Survey Kepuasan {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }} sedang dalam proses pengumpulan data dan penyusunan.</p>
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
