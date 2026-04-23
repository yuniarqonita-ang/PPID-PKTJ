<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Permintaan Informasi - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
        }
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f8faff;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.9), rgba(0, 74, 153, 0.9)), 
                        url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2026');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            color: white;
        }
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }
        .table-container {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #f1f5f9;
            color: #004a99;
            font-weight: 700;
            padding: 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .btn-unduh {
            background-color: #ffc107;
            color: #000;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
        }
        .btn-unduh:hover { background-color: #e0a800; color: #000; }
        
        .btn-preview {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-preview:hover { background-color: #218838; color: #fff; }
        .pagination-info {
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-5 fw-bold uppercase">Rekapitulasi Permintaan Informasi</h1>
            <p class="lead opacity-75">Data Statistik Akses Layanan Informasi Publik.</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="fw-bold mb-1" style="font-size: 2.2rem; color: #1e293b;">Rekapitulasi Jumlah Permintaan Informasi Publik</h2>
            <div class="pagination-info mb-4">
                Showing <b>1-{{ count($laporan ?? []) }}</b> of <b>{{ count($laporan ?? []) }}</b> items.
            </div>

            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center">#</th>
                            <th>Judul Laporan</th>
                            <th style="width: 200px;"></th>
                            <th style="width: 200px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan ?? [] as $index => $item)
                            <tr>
                                <td class="text-center text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold" style="color: #444;">{{ $item->judul }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/'.$item->file) }}" class="btn-unduh w-100" target="_blank">
                                        <i class="fas fa-save me-2"></i> Unduh Dokumen
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/'.$item->file) }}" class="btn-preview w-100" target="_blank">
                                        <i class="fas fa-eye me-2"></i> Preview Dokumen
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-file-invoice d-block mb-3 opacity-25" style="font-size: 3rem;"></i>
                                    Belum ada data rekapitulasi tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
