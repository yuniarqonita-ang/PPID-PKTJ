<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; scroll-behavior: smooth; }
        @media (min-width: 992px) { .nav-item.dropdown:hover .dropdown-menu { display: block; margin-top: 0; } }
        .hero-section { background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), url('https://via.placeholder.com/1920x600'); background-size: cover; color: white; padding: 100px 0; text-align: center; }
        .section-title { border-bottom: 3px solid #004a99; display: inline-block; padding-bottom: 10px; margin-bottom: 30px; text-transform: uppercase; font-weight: bold; color: #004a99; }
        .card { border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: 0.3s; border-radius: 12px; overflow: hidden; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3">Selamat Datang di Portal PPID PKTJ</h1>
            <p class="lead">Layanan Informasi Publik Terintegrasi dan Transparan</p>
            <div class="mt-4">
                <a href="#informasi-publik" class="btn btn-warning btn-lg fw-bold px-4">CARI INFORMASI</a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <section id="informasi-publik" class="mb-5">
            <h2 class="section-title">Informasi Publik</h2>
            <div class="row g-4">
                @forelse($dokumen as $doc)
                <div class="col-md-4">
                    <div class="card h-100 p-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-primary me-2">Dokumen</span>
                            <small class="text-muted">{{ $doc->kategori }}</small>
                        </div>
                        <h6 class="fw-bold">{{ $doc->nama_dokumen }}</h6>
                        <a href="{{ asset('storage/'.$doc->file_path) }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Selengkapnya</a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada dokumen publik yang diunggah.</div>
                @endforelse
            </div>
        </section>

        <section class="mb-5">
            <h2 class="section-title">Artikel & Dokumentasi Kegiatan</h2>
            <div class="row g-4">
                @forelse($artikel as $item)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit(strip_tags($item->konten), 120) }}</p>
                            <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold">Baca Berita...</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada artikel kegiatan terbaru.</div>
                @endforelse
            </div>
        </section>

        <div class="row pt-4">
            <div class="col-md-8 mb-5">
                <h2 class="section-title">Video Layanan Informasi</h2>
                <div class="ratio ratio-16x9 card">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video Layanan" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <h2 class="section-title">Aplikasi Terkait</h2>
                <div class="list-group card">
                    <a href="https://ppid.dephub.go.id" target="_blank" class="list-group-item list-group-item-action py-3">E-PPID Kemenhub</a>
                    <a href="{{ route('admin.lpse.index') }}" class="list-group-item list-group-item-action py-3">LPSE PKTJ</a>
                    <a href="{{ route('admin.jdih.index') }}" class="list-group-item list-group-item-action py-3">JDIH PKTJ</a>
                    <a href="#" class="list-group-item list-group-item-action py-3">Sistem Informasi PKTJ</a>
                </div>
                <div class="mt-4 p-4 bg-primary text-white rounded-3 shadow">
                    <h6>PPID Pelaksana</h6>
                    <p class="small mb-0">Politeknik Keselamatan Transportasi Jalan Tegal</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>