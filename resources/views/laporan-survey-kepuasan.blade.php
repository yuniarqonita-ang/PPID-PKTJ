<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Survey Kepuasan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('https://images.unsplash.com/photo-1551288049-bbbda546697a?q=80&w=2070');
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
            <h1 class="display-3 fw-black outfit uppercase">Survey Kepuasan</h1>
            <p class="lead opacity-75 mb-0">Hasil Indeks Kepuasan Masyarakat terhadap Pelayanan Informasi Publik.</p>
        </div>
    </div>

    <div class="container-fluid px-lg-5">
        <div class="content-card shadow-lg border-0" style="border-radius: 20px;">
            <h1 class="fw-bold mb-4" style="color: #333; font-size: 2.5rem;">Laporan Kepuasan Pelayanan Informasi Publik {{ $settings['ppid_nama'] ?? 'Kementerian Perhubungan' }}</h1>

            <div class="mb-3 text-muted small">
                Showing 1-{{ count($laporan ?? []) }} of {{ count($laporan ?? []) }} items.
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border-top" style="border-collapse: separate; border-spacing: 0;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="px-4 py-3 text-center" style="width: 60px; color: #004a99; font-weight: 800;">#</th>
                            <th class="px-4 py-3" style="color: #004a99; font-weight: 800;">Judul Laporan</th>
                            <th class="px-4 py-3" style="width: 200px;"></th>
                            <th class="px-4 py-3" style="width: 200px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan ?? [] as $index => $item)
                        <tr style="background-color: {{ $index % 2 == 0 ? '#ececec' : '#ffffff' }}; transition: all 0.2s;">
                            <td class="px-4 py-4 text-center fw-bold">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 fw-medium text-dark" style="font-size: 1.05rem;">{{ $item->judul }}</td>
                            <td class="px-2 py-4">
                                <a href="{{ route('dokumen.download', $item->id) }}" class="btn w-100 fw-bold d-flex align-items-center justify-content-center gap-2" style="background-color: #ffc107; color: #ffffff; border-radius: 5px; padding: 10px 15px; border: none;">
                                    <i class="fas fa-save"></i> Unduh Dokumen
                                </a>
                            </td>
                            <td class="px-4 py-4">
                                <a href="{{ route('dokumen.view', $item->id) }}" target="_blank" class="btn w-100 fw-bold d-flex align-items-center justify-content-center gap-2" style="background-color: #28a745; color: #ffffff; border-radius: 5px; padding: 10px 15px; border: none;">
                                    <i class="fas fa-eye"></i> Preview Dokumen
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-poll fa-4x text-muted mb-4 opacity-25"></i>
                                <h3 class="text-muted">Data Belum Tersedia</h3>
                                <p class="text-muted">Belum ada data laporan survey tersedia saat ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'laporan_survey'])

            @if(isset($settings['laporan_survey_file_laporan']) && $settings['laporan_survey_file_laporan'])
            <div class="main-download-box mt-5">
                <h3 class="outfit fw-bold mb-3">Dokumen Laporan Lengkap</h3>
                <p class="opacity-75 mb-4">Unduh dokumen laporan survey kepuasan masyarakat secara keseluruhan.</p>
                <a href="{{ asset('storage/halaman/'.$settings['laporan_survey_file_laporan']) }}" 
                   target="_blank" 
                   class="btn-premium btn-gold d-inline-flex px-5 py-3 mx-auto" 
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

