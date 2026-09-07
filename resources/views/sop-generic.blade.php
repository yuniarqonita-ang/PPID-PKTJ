<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $d = $settings ?? [];
        $pfx = is_object($profil) ? ($profil->type ?? 'sop') : 'sop';
        
        if ($pfx === 'sop_biaya') {
            $defaultJudul = 'Standar Biaya Layanan Informasi';
            $defaultTagline = 'Ketetapan Biaya Penelusuran dan Penggandaan Informasi Publik PPID PKTJ (Bebas Biaya / Rp 0,-)';
        } elseif ($pfx === 'sop_waktu') {
            $defaultJudul = 'Standar Waktu Penyelesaian Layanan Informasi';
            $defaultTagline = 'Jangka Waktu Pemenuhan Informasi Publik dan Penanganan Keberatan (10 + 7 Hari Kerja)';
        } else {
            $defaultJudul = is_object($profil) ? ($profil->judul ?? 'Prosedur PPID') : 'Prosedur PPID';
            $defaultTagline = 'Informasi standar operasional prosedur PPID PKTJ';
        }
        
        $judul = $d[$pfx . '_judul_hero'] ?? $defaultJudul;
        $tagline = $d[$pfx . '_tagline_hero'] ?? $defaultTagline;
    @endphp
    <title>{{ $judul }} - {{ $d['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $tagline }}">
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
                <i class="fas fa-file-signature me-2"></i> Prosedur & SOP
            </div>
            <h1 class="hero-title outfit">{{ $judul }}</h1>
            <p class="hero-tagline">{{ $tagline }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @php
                $hasContent = ($d[$pfx . '_konten'] ?? null) ||
                              ($d[$pfx . '_isi_konten'] ?? null) ||
                              ($d[$pfx . '_isi_maklumat'] ?? null) ||
                              (isset($laporan) && $laporan->count() > 0);
            @endphp

            @if($hasContent)
                @include('components.konten-dinamis', ['prefix' => $pfx])
            @elseif($pfx === 'sop_biaya')
                <div class="p-3">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex p-3 rounded-circle bg-success bg-opacity-10 text-success mb-3">
                            <i class="fas fa-hand-holding-usd fa-3x"></i>
                        </div>
                        <h2 class="outfit fw-bold text-dark">Layanan Bebas Biaya (Rp 0,-)</h2>
                        <p class="text-muted max-w-700 mx-auto">Pejabat Pengelola Informasi dan Dokumentasi (PPID) Politeknik Keselamatan Transportasi Jalan menetapkan prinsip efisiensi, akuntabilitas, dan keterbukaan tanpa memungut biaya permohonan informasi.</p>
                    </div>

                    <div class="row g-4 my-2">
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <i class="fas fa-mouse-pointer fa-2x text-primary mb-3"></i>
                                <h5 class="fw-bold text-dark">1. Permohonan & Penelusuran</h5>
                                <p class="text-muted small mb-0">Biaya pendaftaran permohonan informasi publik dan penelusuran arsip dokumen adalah <strong>Rp 0,- (Gratis)</strong>.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <i class="fas fa-file-download fa-2x text-success mb-3"></i>
                                <h5 class="fw-bold text-dark">2. Dokumen Digital / Softcopy</h5>
                                <p class="text-muted small mb-0">Pengiriman salinan informasi publik dalam format softcopy (PDF, Excel, link email/cloud) adalah <strong>Rp 0,- (Gratis)</strong>.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <i class="fas fa-print fa-2x text-warning mb-3"></i>
                                <h5 class="fw-bold text-dark">3. Penggandaan Fisik (Hardcopy)</h5>
                                <p class="text-muted small mb-0">Jika pemohon menghendaki salinan cetak/fotokopi fisik, biaya penggandaan ditanggung sendiri oleh pemohon sesuai tarif riil.</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary rounded-4 border-0 p-4 mt-4 d-flex align-items-center gap-3" style="background: #eef2ff; color: #002b5c;">
                        <i class="fas fa-balance-scale fa-2x text-primary"></i>
                        <div>
                            <strong>Dasar Hukum Penetapan Biaya:</strong>
                            <p class="mb-0 small">Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik dan Peraturan Menteri Perhubungan Republik Indonesia Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
                        </div>
                    </div>
                </div>
            @elseif($pfx === 'sop_waktu')
                <div class="p-3">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3">
                            <i class="far fa-clock fa-3x"></i>
                        </div>
                        <h2 class="outfit fw-bold text-dark">Standar Waktu Penyelesaian Layanan</h2>
                        <p class="text-muted max-w-700 mx-auto">PPID Pelaksana Politeknik Keselamatan Transportasi Jalan berkomitmen menyelesaikan setiap permohonan informasi publik secara cepat, tepat waktu, dan transparan.</p>
                    </div>

                    <div class="row g-4 my-2">
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <div class="badge bg-primary fs-5 px-3 py-2 rounded-pill mb-3">10 Hari Kerja</div>
                                <h5 class="fw-bold text-dark">Waktu Pemenuhan Utama</h5>
                                <p class="text-muted small mb-0">PPID wajib menyampaikan pemberitahuan tertulis dan/atau menyerahkan informasi publik yang diminta dalam waktu maksimal <strong>10 (sepuluh) hari kerja</strong> sejak permohonan dinyatakan lengkap.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <div class="badge bg-warning text-dark fs-5 px-3 py-2 rounded-pill mb-3">+7 Hari Kerja</div>
                                <h5 class="fw-bold text-dark">Perpanjangan Waktu</h5>
                                <p class="text-muted small mb-0">Jika informasi memerlukan waktu pengumpulan tambahan, PPID dapat memperpanjang waktu paling lama <strong>7 (tujuh) hari kerja</strong> dengan disertai alasan tertulis resmi.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 border bg-white h-100 shadow-sm text-center">
                                <div class="badge bg-info text-white fs-5 px-3 py-2 rounded-pill mb-3">30 Hari Kerja</div>
                                <h5 class="fw-bold text-dark">Tanggapan Keberatan</h5>
                                <p class="text-muted small mb-0">Atasan PPID wajib memberikan tanggapan tertulis atas permohonan keberatan informasi publik paling lambat <strong>30 (tiga puluh) hari kerja</strong> sejak keberatan diterima.</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-primary rounded-4 border-0 p-4 mt-4 d-flex align-items-center gap-3" style="background: #eef2ff; color: #002b5c;">
                        <i class="fas fa-calendar-check fa-2x text-primary"></i>
                        <div>
                            <strong>Komitmen Standar Waktu Layanan:</strong>
                            <p class="mb-0 small">Ketetapan ini mengacu pada Pasal 22 UU No. 14 Tahun 2008 dan Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang SOP Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Konten Sedang Disiapkan</h3>
                    <p>Informasi mengenai <strong>{{ $judul }}</strong> sedang dalam proses penyusunan oleh tim PPID PKTJ.</p>
                    <a href="{{ route('home') }}" class="btn-action btn-action-gold">
                        <i class="fas fa-home"></i> Kembali ke Beranda
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
