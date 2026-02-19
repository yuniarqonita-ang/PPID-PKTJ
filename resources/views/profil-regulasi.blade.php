<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi - Portal PPID PKTJ</title>
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
        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }
        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #333;
            font-size: 16px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .regulation-link {
            color: #0066cc;
            text-decoration: none;
            line-height: 1.8;
            margin-bottom: 12px;
            display: block;
        }
        .regulation-link:hover {
            text-decoration: underline;
        }
        .regulation-list {
            list-style: none;
            padding-left: 0;
        }
        .regulation-list li {
            margin-bottom: 12px;
        }
        .note-text {
            font-style: italic;
            color: #666;
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 3px solid #004a99;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="container py-5">
        <h1 class="page-title">Regulasi</h1>
        <div class="content-box">
            <!-- PERATURAN UNDANG-UNDANG -->
            <h2 class="section-title">Peraturan Undang-Undang :</h2>
            <ul class="regulation-list">
                <li><a href="#" class="regulation-link">Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik;</a></li>
                <li><a href="#" class="regulation-link">Undang-Undang Nomor 43 Tahun 2009 tentang Kearsipan;</a></li>
                <li><a href="#" class="regulation-link">Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik;</a></li>
                <li><a href="#" class="regulation-link">Undang-Undang Nomor 40 Tahun 1999 tentang Pers.</a></li>
            </ul>

            <!-- PERATURAN KOMISI INFORMASI PUSAT -->
            <h2 class="section-title">Peraturan Komisi Informasi Pusat :</h2>
            <ul class="regulation-list">
                <li><a href="#" class="regulation-link">Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2021 Tentang Standar Layanan Informasi Publik;</a></li>
                <li><a href="#" class="regulation-link">Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2013 Tentang Prosedur Penyelesaian Sengketa Informasi Publik.</a></li>
            </ul>

            <!-- PERATURAN KEMENTERIAN PERHUBUNGAN -->
            <h2 class="section-title">Peraturan Kementerian Perhubungan terkait Keterbukaan Informasi Publik :</h2>
            <ul class="regulation-list">
                <li><a href="#" class="regulation-link">Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan;</a></li>
                <li><a href="#" class="regulation-link">Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang SOP Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan;</a></li>
                <li><a href="#" class="regulation-link">Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 25 Tahun 2024 tentang Daftar Informasi Publik Tahun 2024;</a></li>
                <li><a href="#" class="regulation-link">Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 24 Tahun 2024 tentang Perubahan Atas Keputusan Sekretaris Jenderal Nomor KP 591 Tahun 2023 tentang Informasi yang Dikecualikan;</a></li>
                <li><a href="#" class="regulation-link">Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 15 Tahun 2025 tentang Daftar Informasi Publik Tahun 2025;</a></li>
                <li><a href="#" class="regulation-link">Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 16 Tahun 2025 tentang Perubahan Kedua Atas Keputusan Sekretaris Jenderal Nomor KP 591 Tahun 2023 tentang Informasi yang Dikecualikan.</a></li>
            </ul>

            <!-- RANCANGAN PERATURAN -->
            <h2 class="section-title">Rancangan Peraturan terkait Keterbukaan Informasi Publik :</h2>
            <p class="note-text">Saat ini belum terdapat rancangan terkait Keterbukaan Informasi Publik</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
