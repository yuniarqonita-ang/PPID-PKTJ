<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
        .search-section {
            background: #fff;
            padding: 0;
            margin-bottom: 40px;
        }
        .form-label {
            font-weight: 500;
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background-color: #fff;
        }
        .btn-cari {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-cari:hover { background-color: #218838; color: white; }
        
        .table-container {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow-x: auto;
        }
        .table {
            margin-bottom: 0;
            min-width: 1600px;
        }
        .table thead th {
            background-color: #f1f5f9;
            color: #004a99;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            padding: 15px 10px;
            border: 1px solid #e2e8f0;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .table tbody td {
            padding: 15px 10px;
            vertical-align: top;
            border: 1px solid #f1f5f9;
            font-size: 0.85rem;
            color: #334155;
            line-height: 1.6;
        }
        .pagination-info {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-5 fw-bold uppercase">Daftar Informasi Publik</h1>
            <p class="lead opacity-75">Akses Transparan Informasi Publik untuk Masyarakat.</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="fw-bold mb-4" style="font-size: 2.2rem; color: #1e293b;">Daftar Informasi Publik</h2>

            <form class="search-section row g-3">
                <div class="col-md-3">
                    <label class="form-label">Informasi</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ringkasan Informasi</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Waktu Pembuatan</label>
                    <select class="form-select">
                        <option value="">- Pilih Tahun -</option>
                        @for($year = date('Y'); $year >= 2009; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Penanggung Jawab</label>
                    <select class="form-select">
                        <option value="">- Pilih Penanggung Jawab -</option>
                        <option>PPID UTAMA</option>
                        <option>Inspektorat Jenderal Kementerian Perhubungan</option>
                        <option>Direktorat Jenderal Perhubungan Darat</option>
                        <option>Direktorat Jenderal Perhubungan Laut</option>
                        <option>Direktorat Jenderal Perhubungan Udara</option>
                        <option>Direktorat Jenderal Perkeretaapian</option>
                        <option>Badan Kebijakan Transportasi</option>
                        <option>Badan Pengembangan Sumber Daya Manusia Perhubungan</option>
                        <option>Badan Pengelola Transportasi Jabodetabek</option>
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn-cari">
                        Cari <i class="fas fa-search ms-1"></i>
                    </button>
                </div>
            </form>

            @php
                $allDocs = [];
                if(isset($berkala)) foreach($berkala as $b) { $b->category = 'berkala'; $allDocs[] = $b; }
                if(isset($setiapsaat)) foreach($setiapsaat as $s) { $s->category = 'setiapsaat'; $allDocs[] = $s; }
                if(isset($sertamerta)) foreach($sertamerta as $sm) { $sm->category = 'sertamerta'; $allDocs[] = $sm; }
                
                // Sort by date
                usort($allDocs, function($a, $b) {
                    return (isset($b->created_at) && isset($a->created_at)) ? ($b->created_at <=> $a->created_at) : 0;
                });
            @endphp

            <div class="pagination-info mt-5">
                Showing <b>1-{{ count($allDocs) }}</b> of <b>{{ count($allDocs) }}</b> items.
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 200px;">Penanggung Jawab</th>
                            <th style="width: 250px;">Informasi</th>
                            <th style="width: 150px;">Jenis Informasi</th>
                            <th style="width: 300px;">Ringkasan Informasi</th>
                            <th style="width: 200px;">Pejabat Yang Menguasai Informasi</th>
                            <th style="width: 150px;">Penerbit Informasi</th>
                            <th style="width: 150px;">Bentuk Informasi Yang Tersedia</th>
                            <th style="width: 150px;">Tempat Pembuatan</th>
                            <th style="width: 120px;">Waktu Pembuatan</th>
                            <th style="width: 200px;">Jangka Waktu Penyimpanan / Retensi Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allDocs as $index => $doc)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $doc->penanggung_jawab ?? '-' }}</td>
                                <td class="fw-bold" style="color: #004a99;">{{ $doc->judul }}</td>
                                <td>{{ ucfirst($doc->category ?? '-') }}</td>
                                <td>{{ $doc->deskripsi ?? '-' }}</td>
                                <td>{{ $doc->pejabat ?? '-' }}</td>
                                <td>{{ $doc->penerbit ?? '-' }}</td>
                                <td>{{ $doc->bentuk ?? 'Softcopy' }}</td>
                                <td>{{ $doc->tempat ?? '-' }}</td>
                                <td>{{ isset($doc->created_at) ? $doc->created_at->format('Y') : '-' }}</td>
                                <td>{{ $doc->retensi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-5">
                                    <i class="fas fa-file-invoice d-block mb-3 opacity-25" style="font-size: 3rem;"></i>
                                    Belum ada data informasi publik tersedia.
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
