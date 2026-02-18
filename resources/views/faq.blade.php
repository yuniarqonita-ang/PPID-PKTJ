<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block; 
                margin-top: 0; 
            } 
        }
        .hero-section { 
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), url('https://via.placeholder.com/1920x600'); 
            background-size: cover; 
            color: white; 
            padding: 100px 0; 
            text-align: center; 
        }
        .faq-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .faq-title {
            font-size: 32px;
            font-weight: bold;
            color: #004a99;
            margin-bottom: 10px;
        }
        .faq-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
        }
        .faq-table {
            width: 100%;
            border-collapse: collapse;
        }
        .faq-table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #004a99;
        }
        .faq-table thead th {
            color: #004a99;
            font-weight: bold;
            padding: 15px;
            text-align: left;
            font-size: 14px;
            text-transform: uppercase;
        }
        .faq-table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }
        .faq-table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .faq-table tbody td {
            padding: 20px 15px;
            vertical-align: top;
        }
        .faq-table .no-column {
            width: 60px;
            font-weight: bold;
            color: #004a99;
        }
        .faq-table .pertanyaan-column {
            width: 35%;
            font-weight: bold;
            color: #333;
        }
        .faq-table .jawaban-column {
            width: 65%;
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3">FAQ - Pertanyaan Umum</h1>
            <p class="lead">Jawaban atas pertanyaan yang sering diajukan tentang Layanan Informasi Publik</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="faq-container">
            <h2 class="faq-title">Frequently asked questions</h2>
            <p class="faq-subtitle">Showing 1-{{ count($faqs) }} of {{ count($faqs) }} items.</p>

            @if($faqs->count())
                <div class="table-responsive">
                    <table class="faq-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                            <tr>
                                <td class="no-column">{{ $faq->id }}</td>
                                <td class="pertanyaan-column">{{ $faq->pertanyaan }}</td>
                                <td class="jawaban-column">{{ $faq->jawaban }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <p>Belum ada FAQ yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
