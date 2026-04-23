<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Berkala - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                        url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 60px 0;
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
        .pagination-info {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 10px;
        }
        .table-container {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #f1f5f9;
        }
        .table thead th {
            font-weight: 700;
            color: #004a99;
            border-bottom: 2px solid #e2e8f0;
            padding: 15px;
        }
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .item-judul {
            font-weight: 700;
            color: #1e293b;
            display: block;
            text-decoration: none;
            font-size: 1.05rem;
        }
        .item-judul:hover { color: #004a99; }
        .item-deskripsi {
            font-style: italic;
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 2px;
        }
        .btn-dl {
            padding: 6px 15px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 50px;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-5 fw-bold uppercase">Informasi Berkala</h1>
            <p class="lead opacity-75">Akses daftar informasi publik yang disediakan secara rutin oleh PPID PKTJ.</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="fw-bold mb-1" style="font-size: 2.2rem; color: #1e293b;">Informasi Berkala</h2>
            <div class="pagination-info mb-4">
                Showing <b>1-{{ count($informasi) }}</b> of <b>{{ count($informasi) }}</b> items.
            </div>

            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="ps-4">#</th>
                            <th>Judul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($informasi as $index => $item)
                            <tr>
                                <td class="text-muted ps-4">{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('download.file', ['model' => 'berkala', 'id' => $item->id]) }}" class="item-judul">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="item-deskripsi">
                                        Deskripsi : {{ $item->deskripsi ?? '-' }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-5">
                                    <i class="fas fa-folder-open d-block mb-3 opacity-25" style="font-size: 3rem;"></i>
                                    Belum ada data informasi berkala tersedia.
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
