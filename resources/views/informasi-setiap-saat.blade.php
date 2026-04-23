<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Setiap Saat - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
        }
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f8faff;
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.9), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 60px;
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0, 74, 153, 0.1);
            margin-top: -80px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 40px;
            border-left: 8px solid var(--secondary-gold);
            padding-left: 25px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
        }

        .info-item {
            background: #f8fafc;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-item:hover {
            transform: translateY(-10px);
            background: white;
            border-color: var(--primary-blue);
            box-shadow: 0 20px 40px rgba(0, 74, 153, 0.1);
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: rgba(0, 74, 153, 0.1);
            color: var(--primary-blue);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 25px;
            flex-shrink: 0;
        }

        .btn-download-premium {
            background: var(--primary-blue);
            color: white;
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-download-premium:hover {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            transform: scale(1.05);
        }

        .rich-content {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.8;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-3 fw-black outfit uppercase">Informasi Setiap Saat</h1>
            <p class="lead opacity-75 mb-0">Daftar informasi publik yang dapat diakses sewaktu-waktu oleh masyarakat.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <h2 class="section-title">Akses Dokumen</h2>

            @include('components.konten-dinamis', ['prefix' => 'informasi_setiapsaat'])

            <div class="row mt-4">
                @forelse($informasi as $item)
                    <div class="col-12">
                        <div class="info-item">
                            <div class="d-flex align-items-start">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold outfit text-dark mb-3">{{ $item->judul }}</h4>
                                    <div class="rich-content mb-4">
                                        {!! $item->deskripsi ?? 'Tidak ada deskripsi terperinci.' !!}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                        <div class="d-flex gap-3">
                                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('d M Y') }}
                                            </span>
                                            @if(isset($item->file_size))
                                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-file-pdf me-1"></i> {{ $item->file_size }}
                                            </span>
                                            @endif
                                        </div>
                                        <a href="{{ route('download.file', ['model' => 'setiapsaat', 'id' => $item->id]) }}" class="btn-download-premium">
                                            <i class="fas fa-download"></i> Download Dokumen
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-4 opacity-25"></i>
                        <h3 class="text-muted">Data Belum Tersedia</h3>
                        <p class="text-muted">Belum ada data informasi setiap saat tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

