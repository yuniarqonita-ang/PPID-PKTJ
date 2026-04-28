<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Permintaan Informasi - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070');
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

        .report-item {
            background: #f8fafc;
            border-radius: 24px;
            padding: 25px 35px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .report-item:hover {
            transform: translateX(15px);
            background: white;
            border-color: var(--primary-blue);
            box-shadow: 0 15px 30px rgba(0, 74, 153, 0.08);
        }

        .report-icon {
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

        .btn-action-premium {
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .btn-download-premium {
            background: var(--primary-blue);
            color: white;
        }

        .btn-download-premium:hover {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            transform: scale(1.05);
        }

        .btn-preview-premium {
            background: white;
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
        }

        .btn-preview-premium:hover {
            background: #f1f5f9;
            transform: scale(1.05);
        }

        .main-download-box {
            background: linear-gradient(135deg, var(--primary-blue), #003366);
            border-radius: 30px;
            padding: 40px;
            color: white;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-3 fw-black outfit uppercase">{{ $settings['laporan_akses_judul_hero'] ?? 'Rekapitulasi Permintaan Informasi' }}</h1>
            <p class="lead opacity-75 mb-0">{{ $settings['laporan_akses_tagline_hero'] ?? 'Data Statistik Akses Layanan Informasi Publik.' }}</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <h2 class="section-title">Laporan Rekapitulasi</h2>

            @include('components.konten-dinamis', ['prefix' => 'laporan_akses'])

            <div class="row mt-4">
                @forelse($laporan ?? [] as $item)
                    <div class="col-12">
                        <div class="report-item">
                            <div class="d-flex align-items-center">
                                <div class="report-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold outfit mb-0 text-dark">{{ $item->judul }}</h5>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ isset($item->created_at) ? $item->created_at->format('d M Y') : '-' }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ asset('storage/'.$item->file) }}" class="btn-action-premium btn-preview-premium" target="_blank">
                                    <i class="fas fa-eye"></i> Preview
                                </a>
                                <a href="{{ asset('storage/'.$item->file) }}" class="btn-action-premium btn-download-premium" target="_blank">
                                    <i class="fas fa-save"></i> Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-file-invoice fa-4x text-muted mb-4 opacity-25"></i>
                        <h3 class="text-muted">Data Belum Tersedia</h3>
                        <p class="text-muted">Belum ada data rekapitulasi tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            @if(isset($settings['laporan_akses_file_laporan']) && $settings['laporan_akses_file_laporan'])
            <div class="main-download-box">
                <h3 class="outfit fw-bold mb-3">Dokumen Laporan Lengkap</h3>
                <p class="opacity-75 mb-4">Unduh dokumen laporan akses informasi publik secara keseluruhan.</p>
                <a href="{{ asset('storage/halaman/'.$settings['laporan_akses_file_laporan']) }}" 
                   target="_blank" 
                   class="btn-action-premium btn-download-premium d-inline-flex px-5 py-3 mx-auto" 
                   style="background: var(--secondary-gold); color: var(--primary-blue);">
                    <i class="fas fa-file-pdf"></i> Unduh Laporan Lengkap
                </a>
            </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

