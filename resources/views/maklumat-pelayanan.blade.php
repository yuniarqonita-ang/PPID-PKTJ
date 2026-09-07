<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['maklumat_pelayanan_tagline_hero'] ?? 'Standar Komitmen Pelayanan Informasi Publik PPID PKTJ' }}">
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
                <i class="fas fa-handshake me-2"></i> Layanan Informasi
            </div>
            <h1 class="hero-title outfit">{{ $settings['maklumat_pelayanan_judul_hero'] ?? 'Maklumat Pelayanan' }}</h1>
            <p class="hero-tagline">{{ $settings['maklumat_pelayanan_tagline_hero'] ?? 'Standar Komitmen Kami Terhadap Publik' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            <!-- HEADER RESMI MAKLUMAT -->
            <div class="text-center pb-4 mb-4 border-bottom">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-primary-subtle text-primary border border-primary-subtle fw-bold mb-3" style="font-size: 11.5px; letter-spacing: 0.5px;">
                    <i class="fas fa-certificate text-warning"></i> PERNYATAAN KOMITMEN RESMI PPID PKTJ
                </div>
                <h2 class="fw-bold outfit text-[#002b5c] mb-2" style="font-size: 28px;">
                    MAKLUMAT PELAYANAN INFORMASI PUBLIK
                </h2>
                <p class="text-muted mx-auto" style="max-width: 720px; font-size: 14.5px;">
                    Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal berkomitmen memberikan pelayanan informasi publik yang prima, transparan, cepat, dan akuntabel sesuai amanat Undang-Undang Nomor 14 Tahun 2008.
                </p>
            </div>

            <!-- PIAGAM MAKLUMAT RESMI -->
            <div class="card border-0 rounded-4 shadow-sm mb-5 overflow-hidden" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); color: white;">
                <div class="card-body p-4 p-lg-5 text-center position-relative">
                    <div class="position-absolute top-0 start-50 translate-middle-x mt-3 opacity-10">
                        <i class="fas fa-award" style="font-size: 140px;"></i>
                    </div>
                    <div class="position-relative z-1">
                        <div class="d-inline-block p-3 rounded-circle bg-white text-primary mb-3 shadow">
                            <i class="fas fa-balance-scale fs-3"></i>
                        </div>
                        <h3 class="outfit fw-bold text-warning mb-3" style="letter-spacing: 1px;">
                            "KAMI PIMPINAN DAN SELURUH JAJARAN PPID PKTJ MENYATAKAN"
                        </h3>
                        <blockquote class="blockquote my-4 px-lg-5" style="font-size: 17px; line-height: 1.8; font-weight: 500;">
                            "Sanggup menyelenggarakan pelayanan informasi publik sesuai dengan standar pelayanan yang telah ditetapkan, memberikan kemudahan akses, menjamin kepastian waktu dan biaya, serta siap menerima sanksi dan/atau memberikan kompensasi apabila pelayanan yang diberikan tidak sesuai dengan standar yang dijanjikan."
                        </blockquote>
                        <div class="mt-4 pt-3 border-top border-white border-opacity-25 d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                            <div class="text-white-50 small">Ditetapkan di Kota Tegal oleh:</div>
                            <div class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill fs-6">
                                <i class="fas fa-user-tie me-1"></i> Direktur & Atasan PPID PKTJ
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 PILAR STANDAR PELAYANAN -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="p-4 rounded-4 border bg-white shadow-sm h-100 text-center hover-lift" style="border-top: 4px solid #004a99 !important;">
                        <div class="w-12 h-12 rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center fs-4 mb-3" style="width: 52px; height: 52px;">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <h5 class="fw-bold outfit text-dark mb-2">Bebas Biaya (Rp 0,-)</h5>
                        <p class="text-muted small mb-0">Permohonan informasi dan perolehan softcopy tidak dipungut biaya apapun (Gratis 100%).</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="p-4 rounded-4 border bg-white shadow-sm h-100 text-center hover-lift" style="border-top: 4px solid #ffc107 !important;">
                        <div class="w-12 h-12 rounded-circle bg-warning-subtle text-warning d-inline-flex align-items-center justify-content-center fs-4 mb-3" style="width: 52px; height: 52px;">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <h5 class="fw-bold outfit text-dark mb-2">Kepastian Waktu</h5>
                        <p class="text-muted small mb-0">Tanggapan permohonan maksimal 10 hari kerja (+7 hari perpanjangan tertulis).</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="p-4 rounded-4 border bg-white shadow-sm h-100 text-center hover-lift" style="border-top: 4px solid #198754 !important;">
                        <div class="w-12 h-12 rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center fs-4 mb-3" style="width: 52px; height: 52px;">
                            <i class="fas fa-laptop-house"></i>
                        </div>
                        <h5 class="fw-bold outfit text-dark mb-2">Multi-Kanal Akses</h5>
                        <p class="text-muted small mb-0">Tersedia layanan online melalui website, email, WhatsApp, serta Meja Layanan Fisik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="p-4 rounded-4 border bg-white shadow-sm h-100 text-center hover-lift" style="border-top: 4px solid #0dcaf0 !important;">
                        <div class="w-12 h-12 rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center fs-4 mb-3" style="width: 52px; height: 52px;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold outfit text-dark mb-2">Kompensasi Layanan</h5>
                        <p class="text-muted small mb-0">Jaminan tindak lanjut cepat dan pemenuhan hak pemohon jika terjadi keterlambatan.</p>
                    </div>
                </div>
            </div>

            <!-- JADWAL DAN LOKASI MEJA LAYANAN FISIK -->
            <div class="p-4 rounded-4 bg-light border mb-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 text-primary fw-bold mb-2">
                            <i class="fas fa-clock text-warning"></i> JAM PELAYANAN DESK MEJA LAYANAN PPID
                        </div>
                        <h4 class="fw-bold outfit text-dark mb-3">Waktu Operasional Pelayanan Langsung (Tatap Muka)</h4>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="bg-white p-3 rounded-3 border">
                                    <div class="fw-bold text-dark"><i class="fas fa-calendar-day text-primary me-1.5"></i> Senin s/d Kamis</div>
                                    <div class="text-muted small">08.00 - 12.00 WIB (Sesi Pagi)</div>
                                    <div class="text-muted small">13.00 - 16.00 WIB (Sesi Siang)</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-white p-3 rounded-3 border">
                                    <div class="fw-bold text-dark"><i class="fas fa-calendar-day text-primary me-1.5"></i> Hari Jumat</div>
                                    <div class="text-muted small">08.00 - 11.30 WIB (Sesi Pagi)</div>
                                    <div class="text-muted small">13.30 - 16.30 WIB (Sesi Siang)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="bg-white p-3.5 rounded-3 border h-100 d-flex flex-column justify-content-center">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-map-marker-alt text-danger me-1.5"></i> Lokasi Desk Meja Layanan Fisik</div>
                            <p class="text-muted small mb-3">Gedung Rektorat Kampus I PKTJ, Jl. Perintis Kemerdekaan No. 17, Panggung, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52122.</p>
                            <div class="d-flex gap-2">
                                <a href="https://bpsdm.kemenhub.go.id/ppid/pktj/login" target="_blank" class="btn btn-warning text-dark fw-bold btn-sm rounded-pill px-3 py-2 flex-grow-1 text-center">
                                    <i class="fas fa-file-signature me-1"></i> Ajukan Online
                                </a>
                                <a href="{{ route('profil.kontak') }}" class="btn btn-outline-primary fw-bold btn-sm rounded-pill px-3 py-2 text-center">
                                    <i class="fas fa-phone-alt me-1"></i> Kontak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KONTEN DINAMIS TAMBAHAN DARI ADMIN PANEL (BILA ADA) -->
            @php
                $d = $settings ?? [];
                $pfx = 'maklumat_pelayanan';
                $hasCustom = ($d[$pfx.'_isi_maklumat'] ?? null) || ($d[$pfx.'_isi_standar'] ?? null);
            @endphp
            @if($hasCustom)
                <div class="pt-3 border-top">
                    @include('components.konten-dinamis', ['prefix' => 'maklumat_pelayanan'])
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
