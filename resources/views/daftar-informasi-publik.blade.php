<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('https://images.unsplash.com/photo-1521791136064-7986c29535a7?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
        }

        .hero-content { position: relative; z-index: 10; }

        .search-container {
            max-width: 600px;
            margin: 40px auto 0;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 12px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            background: transparent;
            border: none;
            color: white;
            padding: 10px 25px;
            width: 100%;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .search-input::placeholder { color: rgba(255,255,255,0.7); }
        .search-input:focus { outline: none; }

        .btn-search {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            border: none;
            padding: 12px 30px;
            border-radius: 22px;
            font-weight: 900;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-search:hover { transform: translateY(-3px) scale(1.02); background: #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

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
            padding: 25px 35px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-item:hover {
            transform: translateX(15px);
            background: white;
            border-color: var(--primary-blue);
            box-shadow: 0 15px 30px rgba(0, 74, 153, 0.08);
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-download-premium:hover {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            transform: scale(1.05);
        }

        .form-label {
            font-weight: 500;
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-3 fw-black outfit uppercase">Daftar Informasi Publik</h1>
            <p class="lead opacity-75 mb-0">Akses Transparan Informasi Publik untuk Masyarakat.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <h2 class="section-title">Daftar Informasi</h2>

            <div id="infoListContainer">
                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle custom-dip-table">
                        <thead>
                            <tr>
                                <th class="text-uppercase small fw-black tracking-wider">Informasi</th>
                                <th class="text-uppercase small fw-black tracking-wider">Otoritas / Penanggung Jawab</th>
                                <th class="text-uppercase small fw-black tracking-wider text-center">Bentuk</th>
                                <th class="text-uppercase small fw-black tracking-wider text-center">Waktu</th>
                                <th class="text-uppercase small fw-black tracking-wider text-end">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>
                                    <div class="fw-bold text-primary mb-1">{{ $item->judul_informasi }}</div>
                                    <span class="badge bg-light text-dark border">{{ $item->tipe_informasi ?? 'Umum' }}</span>
                                    <span class="badge bg-light text-dark border">{{ $item->kategori ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold small">{{ $item->pejabat_penguasa ?? '-' }}</div>
                                    <div class="text-muted extra-small">{{ $item->penanggung_jawab ?? '-' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted small fw-bold">{{ $item->bentuk_informasi ?? '-' }}</span>
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $item->waktu_pembuatan ?? '-' }}
                                    @if($item->jangka_waktu)
                                    <div class="extra-small opacity-75">Simpan: {{ $item->jangka_waktu }}</div>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($item->file_informasi)
                                    <a href="{{ asset($item->file_informasi) }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
                                        <i class="fas fa-file-pdf me-1"></i> LIHAT PDF
                                    </a>
                                    @else
                                    <span class="text-muted extra-small">Tersedia Fisik</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="opacity-25 mb-3">
                                        <i class="fas fa-folder-open fa-4x"></i>
                                    </div>
                                    <h5 class="text-muted fw-bold">Daftar Informasi Belum Tersedia</h5>
                                    <p class="text-muted small">Data sedang dalam proses pembaruan oleh admin.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <style>
                    .custom-dip-table thead th {
                        background: #f8fafc;
                        color: #64748b;
                        border-bottom: 2px solid #e2e8f0;
                        padding: 20px 15px;
                    }
                    .custom-dip-table tbody td {
                        padding: 20px 15px;
                        border-bottom: 1px solid #f1f5f9;
                    }
                    .extra-small { font-size: 0.75rem; }
                    .fw-black { font-weight: 900; }
                    .tracking-wider { letter-spacing: 0.05em; }
                </style>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
