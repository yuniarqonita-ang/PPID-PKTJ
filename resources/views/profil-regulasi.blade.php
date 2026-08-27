<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Regulasi & Dasar Hukum PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Pusat data regulasi resmi keterbukaan informasi publik, undang-undang, keputusan menteri perhubungan, dan keputusan direktur PKTJ Tegal.">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004a99' }};
            --deep-navy: #002b5c;
            --maritime-blue: #004a99;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#ffc107' }};
            --accent-gold: #f59e0b;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f1f5f9; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* HERO LUXURY SECTION */
        .hero-regulasi {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.95) 0%, rgba(0, 74, 153, 0.90) 100%), 
                        url('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 90px 0 110px;
            color: white;
            position: relative;
        }

        .hero-regulasi::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(to top, #f1f5f9, transparent);
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 22px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(12px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffd166;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* STATS BAR FLOATING */
        .stats-floating-grid {
            margin-top: -50px;
            position: relative;
            z-index: 25;
            margin-bottom: 35px;
        }

        .stat-mini-card {
            background: white;
            border-radius: 20px;
            padding: 22px 24px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            gap: 18px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-mini-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 35px rgba(0, 43, 92, 0.12);
        }

        .stat-icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* SPOTLIGHT SECTION */
        .spotlight-card {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            border-radius: 24px;
            padding: 30px;
            color: white;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 193, 7, 0.3);
            box-shadow: 0 15px 40px rgba(0, 43, 92, 0.15);
            margin-bottom: 40px;
        }

        .spotlight-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,193,7,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .spotlight-item {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .spotlight-item:hover {
            background: rgba(255, 255, 255, 0.16);
            border-color: #ffc107;
            transform: translateY(-3px);
        }

        /* SIDEBAR CATEGORY MATRIX */
        .sidebar-matrix-card {
            background: white;
            border-radius: 24px;
            padding: 26px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.9);
            position: sticky;
            top: 20px;
        }

        .category-nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 18px;
            border-radius: 14px;
            color: #334155;
            font-weight: 600;
            font-size: 13.5px;
            text-decoration: none;
            margin-bottom: 8px;
            border: 1px solid transparent;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.25s ease;
            width: 100%;
            text-align: left;
        }

        .category-nav-item:hover {
            background: #eef2ff;
            color: var(--deep-navy);
            border-color: #cbd5e1;
        }

        .category-nav-item.active {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white;
            font-weight: 700;
            box-shadow: 0 6px 18px rgba(0, 43, 92, 0.25);
            border-color: transparent;
        }

        .category-nav-item.active .cat-counter {
            background: rgba(255, 255, 255, 0.25);
            color: white;
        }

        .cat-counter {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 9px;
            border-radius: 9999px;
            transition: all 0.25s ease;
        }

        /* MAIN CONTENT SHOWCASE */
        .showcase-toolbar {
            background: white;
            border-radius: 20px;
            padding: 18px 24px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.9);
            margin-bottom: 25px;
        }

        .search-regulasi-input {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 18px 12px 46px;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            transition: all 0.25s ease;
            background: #f8fafc;
        }

        .search-regulasi-input:focus {
            outline: none;
            border-color: var(--maritime-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
        }

        .search-icon-pos {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .view-mode-btn {
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-mode-btn.active, .view-mode-btn:hover {
            background: var(--deep-navy);
            color: white;
            border-color: var(--deep-navy);
        }

        /* REGULASI BENTO CARD */
        .regulasi-bento-card {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 6px 20px rgba(0, 43, 92, 0.04);
            padding: 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .regulasi-bento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 35px rgba(0, 43, 92, 0.1);
            border-color: #cbd5e1;
        }

        .cat-tag {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .cat-tag-uu { background: #e0e7ff; color: #3730a3; }
        .cat-tag-kip { background: #fce7f3; color: #9d174d; }
        .cat-tag-kemenhub { background: #e0f2fe; color: #0369a1; }
        .cat-tag-pktj { background: #fef3c7; color: #b45309; }

        .nomor-badge {
            background: #f1f5f9;
            color: #0f172a;
            font-family: monospace;
            font-weight: 700;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .btn-action-preview {
            background: #f1f5f9;
            color: #002b5c;
            border: 1px solid #cbd5e1;
            padding: 9px 16px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action-preview:hover {
            background: #e2e8f0;
            color: #001e42;
        }

        .btn-action-download {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white !important;
            border: none;
            padding: 9px 18px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 700;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0, 74, 153, 0.2);
        }

        .btn-action-download:hover {
            background: linear-gradient(135deg, #001e42 0%, #003670 100%);
            transform: scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 74, 153, 0.3);
        }

        /* SMART TABLE VIEW */
        .smart-regulasi-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 6px 20px rgba(0, 43, 92, 0.04);
        }

        .smart-regulasi-table table {
            margin-bottom: 0;
        }

        .smart-regulasi-table th {
            background: #002b5c;
            color: white;
            font-size: 12.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            border: none;
        }

        .smart-regulasi-table td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px;
        }

        .smart-regulasi-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* MODAL PREVIEW PDF */
        .modal-regulasi-preview .modal-dialog {
            max-width: 900px;
        }

        .modal-regulasi-preview .modal-content {
            border-radius: 24px;
            overflow: hidden;
            border: none;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
    </style>
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <!-- HERO SECTION -->
    <div class="hero-regulasi">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="hero-badge-pill" data-aos="fade-down">
                <i class="fas fa-balance-scale text-warning"></i> Landasan Hukum & Regulasi Resmi PPID
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-3 tracking-tight" data-aos="fade-up">
                {{ $profil->judul ?? 'Regulasi Keterbukaan Informasi Publik' }}
            </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 800px; font-size: 16px;" data-aos="fade-up" data-aos-delay="100">
                Pusat data komprehensif seluruh peraturan perundang-undangan, standar layanan informasi publik Komisi Informasi Pusat, regulasi Kementerian Perhubungan, dan Keputusan Direktur PKTJ Tegal.
            </p>
        </div>
    </div>

    <!-- PREPARE DATA FAILSAFE -->
    @php
        // Hardcoded Master Fallback Data jika database kosong
        $fallbackRegulasi = [
            [
                'id' => 1,
                'judul' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik',
                'nomor' => 'UU No. 14 Tahun 2008',
                'tahun' => 2008,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Undang-Undang induk yang menjamin hak warga negara untuk memperoleh informasi publik dan kewajiban badan publik menyediakan informasi secara terbuka, transparan, dan akuntabel.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => true,
            ],
            [
                'id' => 2,
                'judul' => 'Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik',
                'nomor' => 'UU No. 25 Tahun 2009',
                'tahun' => 2009,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Pengaturan mengenai asas-asas kepatutan dan kepastian hukum dalam penyelenggaraan pelayanan publik di instansi pemerintah.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 3,
                'judul' => 'Undang-Undang Nomor 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan',
                'nomor' => 'UU No. 22 Tahun 2009',
                'tahun' => 2009,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Regulasi utama penyelenggaraan pembinaan, keselamatan, dan rekayasa transportasi jalan di Indonesia.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 4,
                'judul' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik (SLIP)',
                'nomor' => 'PerKI No. 1 Tahun 2021',
                'tahun' => 2021,
                'kategori' => 'Komisi Informasi Pusat',
                'deskripsi' => 'Pedoman operasional standar pelayanan informasi publik, klasifikasi informasi berkala, serta merta, setiap saat, dan dikecualikan.',
                'file_path' => 'https://komisiinformasi.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 5,
                'judul' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2013 tentang Prosedur Penyelesaian Sengketa Informasi Publik',
                'nomor' => 'PerKI No. 1 Tahun 2013',
                'tahun' => 2013,
                'kategori' => 'Komisi Informasi Pusat',
                'deskripsi' => 'Tata cara dan mekanisme penyelesaian sengketa informasi publik melalui mediasi dan ajudikasi non-litigasi.',
                'file_path' => 'https://komisiinformasi.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 6,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kemenhub',
                'nomor' => 'Permenhub PM 46/2018',
                'tahun' => 2018,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Regulasi pokok struktur, tugas wewenang, dan tata kerja PPID Utama, PPID Pelaksana, dan PPID Pelaksana UPT di lingkungan Kementerian Perhubungan.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => true,
            ],
            [
                'id' => 7,
                'judul' => 'Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang Penetapan Klasifikasi Informasi yang Dikecualikan',
                'nomor' => 'Kepmenhub KM 117/2022',
                'tahun' => 2022,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Daftar resmi informasi yang dikecualikan di lingkungan Kementerian Perhubungan beserta alasan dan uji konsekuensinya.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => true,
            ],
            [
                'id' => 8,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 58 Tahun 2020 tentang Pengendalian Gratifikasi di Lingkungan Kementerian Perhubungan',
                'nomor' => 'Permenhub PM 58/2020',
                'tahun' => 2020,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Mekanisme pencegahan tindak pidana korupsi dan pengendalian penerimaan atau penolakan gratifikasi.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 9,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 85 Tahun 2020 tentang Penyelenggaraan SPIP di Lingkungan Kementerian Perhubungan',
                'nomor' => 'Permenhub PM 85/2020',
                'tahun' => 2020,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Pedoman sistem pengendalian intern pemerintah dalam menciptakan tata kelola keuangan dan operasional yang transparan.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 10,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 36 Tahun 2019 tentang Tata Naskah Dinas di Lingkungan Kementerian Perhubungan',
                'nomor' => 'Permenhub PM 36/2019',
                'tahun' => 2019,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Standarisasi format, tata persuratan, dan penomoran dokumen kedinasan kementerian.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 11,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 41 Tahun 2022 tentang Organisasi dan Tata Kerja Balai Pengujian Laik Jalan',
                'nomor' => 'Permenhub PM 41/2022',
                'tahun' => 2022,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Regulasi struktur organisasi dan tata kerja unit pengujian laik jalan dan sertifikasi kendaraan bermotor.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 12,
                'judul' => 'Keputusan Menteri Perhubungan Nomor KM 211 Tahun 2020 tentang Petunjuk Teknis Pelaksanaan Survei Kepuasan Masyarakat (SKM)',
                'nomor' => 'Kepmenhub KM 211/2020',
                'tahun' => 2020,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Pedoman survei indeks kepuasan masyarakat atas pelayanan publik unit kerja perhubungan.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 13,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 22 Tahun 2023 tentang Pedoman Penanganan Benturan Kepentingan',
                'nomor' => 'Permenhub PM 22/2023',
                'tahun' => 2023,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Pedoman penanganan situasi benturan kepentingan dalam pengambilan keputusan dinas.',
                'file_path' => 'https://jdih.dephub.go.id/',
                'is_spotlight' => false,
            ],
            [
                'id' => 14,
                'judul' => 'Keputusan Direktur PKTJ Nomor KP-PKTJ 32 Tahun 2024 tentang Penetapan PPID Pelaksana PKTJ Tegal',
                'nomor' => 'KP-PKTJ 32/2024',
                'tahun' => 2024,
                'kategori' => 'PKTJ Tegal',
                'deskripsi' => 'Surat Keputusan Direktur PKTJ mengenai penetapan susunan Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana UPT PKTJ.',
                'file_path' => 'storage/dokumen/A1.pdf',
                'is_spotlight' => true,
            ],
            [
                'id' => 15,
                'judul' => 'Surat Keputusan Direktur PKTJ tentang Standar Operasional Prosedur (SOP) Pelayanan Informasi Publik PKTJ Tegal',
                'nomor' => 'SOP PKTJ 2024',
                'tahun' => 2024,
                'kategori' => 'PKTJ Tegal',
                'deskripsi' => 'Buku pedoman SOP permohonan informasi, penanganan keberatan, penetapan daftar informasi, dan pengujian konsekuensi di lingkungan PKTJ.',
                'file_path' => 'storage/dokumen/G2.pdf',
                'is_spotlight' => false,
            ],
        ];

        // Jika database ada isi, gabungkan / utamakan dari database
        $itemsList = collect();
        if (isset($allRegulasi) && $allRegulasi->count() > 0) {
            foreach ($allRegulasi as $r) {
                $itemsList->push([
                    'id' => $r->id,
                    'judul' => $r->judul,
                    'nomor' => $r->nomor ?? 'Regulasi Resmi',
                    'tahun' => $r->tahun ?? 2024,
                    'kategori' => $r->kategori ?? 'Umum',
                    'deskripsi' => $r->deskripsi ?? 'Dokumen landasan hukum keterbukaan informasi publik resmi.',
                    'file_path' => $r->file_path ? asset($r->file_path) : ($r->link_download ?? 'https://jdih.dephub.go.id/'),
                    'is_spotlight' => str_contains($r->judul, 'PM 46') || str_contains($r->judul, 'KP-PKTJ') || str_contains($r->judul, 'UU Nomor 14') || str_contains($r->judul, 'KM 117'),
                ]);
            }
        } else {
            $itemsList = collect($fallbackRegulasi);
        }

        $cntUU = $itemsList->where('kategori', 'Undang-Undang')->count();
        $cntKIP = $itemsList->where('kategori', 'Komisi Informasi Pusat')->count();
        $cntKemenhub = $itemsList->where('kategori', 'Kementerian Perhubungan')->count();
        $cntPKTJ = $itemsList->where('kategori', 'PKTJ Tegal')->count();
        $cntTotal = $itemsList->count();
    @endphp

    <div class="container page-container">

        <!-- 1. STATS BAR FLOATING -->
        <div class="stats-floating-grid" data-aos="fade-up">
            <div class="row g-3">
                <div class="col-6 col-lg-3">
                    <div class="stat-mini-card">
                        <div class="stat-icon-wrap" style="background: #e0f2fe; color: #004a99;">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div>
                            <div class="outfit fw-bold fs-4 text-dark mb-0">{{ $cntTotal }}</div>
                            <div class="text-muted small fw-medium">Total Regulasi Aktif</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-mini-card">
                        <div class="stat-icon-wrap" style="background: #e0e7ff; color: #4338ca;">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <div>
                            <div class="outfit fw-bold fs-4 text-dark mb-0">{{ $cntUU }} UU & {{ $cntKIP }} PerKI</div>
                            <div class="text-muted small fw-medium">Regulasi Nasional</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-mini-card">
                        <div class="stat-icon-wrap" style="background: #fef3c7; color: #b45309;">
                            <i class="fas fa-ship"></i>
                        </div>
                        <div>
                            <div class="outfit fw-bold fs-4 text-dark mb-0">{{ $cntKemenhub }} PM/KM</div>
                            <div class="text-muted small fw-medium">Kemenhub RI</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-mini-card">
                        <div class="stat-icon-wrap" style="background: #dcfce7; color: #15803d;">
                            <i class="fas fa-university"></i>
                        </div>
                        <div>
                            <div class="outfit fw-bold fs-4 text-dark mb-0">{{ $cntPKTJ }} SK/SOP</div>
                            <div class="text-muted small fw-medium">Internal PKTJ Tegal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. SPOTLIGHT REGULASI UTAMA (PINNED CORNERSTONE) -->
        <div class="spotlight-card" data-aos="fade-up">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill mb-2">
                        <i class="fas fa-star me-1"></i> REGULASI UTAMA (PINNED)
                    </span>
                    <h3 class="outfit fw-bold text-white mb-1">Pilar Pokok Keterbukaan Informasi PKTJ Tegal</h3>
                    <p class="text-light opacity-75 small mb-0">Empat regulasi fundamental yang menjadi dasar operasional PPID Pelaksana PKTJ.</p>
                </div>
                <div class="d-none d-md-block">
                    <a href="https://jdih.dephub.go.id/" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold">
                        <i class="fas fa-external-link-alt me-1"></i> Portal JDIH Kemenhub
                    </a>
                </div>
            </div>

            <div class="row g-3">
                @foreach($itemsList->where('is_spotlight', true)->take(4) as $spot)
                <div class="col-md-6 col-lg-3">
                    <div class="spotlight-item">
                        <div>
                            <span class="nomor-badge mb-2 d-inline-block bg-white text-dark">{{ $spot['nomor'] }}</span>
                            <h6 class="fw-bold text-white mb-2" style="font-size: 14px; line-height: 1.4;">{{ $spot['judul'] }}</h6>
                            <p class="text-light opacity-75 small mb-3" style="font-size: 12px; line-height: 1.5;">
                                {{ Str::limit($spot['deskripsi'], 95) }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $spot['file_path'] }}" target="_blank" class="btn btn-warning btn-sm w-100 fw-bold rounded-pill" style="font-size: 12px; color: #002b5c;">
                                <i class="fas fa-file-pdf me-1"></i> Buka Dokumen
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 3. MAIN INTERACTIVE SECTION (SIDEBAR FILTER MATRIX + SHOWCASE) -->
        <div class="row g-4 mb-5">
            
            <!-- LEFT COLUMN: CATEGORY SELECTOR & QUICK LINKS -->
            <div class="col-lg-3">
                <div class="sidebar-matrix-card" data-aos="fade-right">
                    <h6 class="outfit fw-bold text-dark text-uppercase tracking-wider mb-3" style="font-size: 13px;">
                        <i class="fas fa-filter text-primary me-2"></i> Kategori Regulasi
                    </h6>
                    
                    <button class="category-nav-item active" onclick="filterByCategory('all', this)">
                        <span><i class="fas fa-layer-group me-2 text-primary"></i> Semua Regulasi</span>
                        <span class="cat-counter" id="badgeAll">{{ $cntTotal }}</span>
                    </button>

                    <button class="category-nav-item" onclick="filterByCategory('Undang-Undang', this)">
                        <span><i class="fas fa-landmark me-2 text-indigo"></i> Undang-Undang RI</span>
                        <span class="cat-counter">{{ $cntUU }}</span>
                    </button>

                    <button class="category-nav-item" onclick="filterByCategory('Komisi Informasi Pusat', this)">
                        <span><i class="fas fa-shield-alt me-2 text-pink"></i> Komisi Informasi (PerKI)</span>
                        <span class="cat-counter">{{ $cntKIP }}</span>
                    </button>

                    <button class="category-nav-item" onclick="filterByCategory('Kementerian Perhubungan', this)">
                        <span><i class="fas fa-ship me-2 text-info"></i> Kementerian Perhubungan</span>
                        <span class="cat-counter">{{ $cntKemenhub }}</span>
                    </button>

                    <button class="category-nav-item" onclick="filterByCategory('PKTJ Tegal', this)">
                        <span><i class="fas fa-university me-2 text-warning"></i> Internal PKTJ Tegal</span>
                        <span class="cat-counter">{{ $cntPKTJ }}</span>
                    </button>

                    <hr class="my-4 text-muted opacity-25">

                    <h6 class="outfit fw-bold text-dark text-uppercase tracking-wider mb-3" style="font-size: 13px;">
                        <i class="fas fa-calendar-alt text-primary me-2"></i> Filter Tahun
                    </h6>
                    <div class="d-flex flex-wrap gap-1.5 mb-4">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('all')">Semua</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2024')">2024</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2023')">2023</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2022')">2022</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2021')">2021</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2020')">2020</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2009')">2009</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11.5px;" onclick="filterByYear('2008')">2008</button>
                    </div>

                    <!-- HELP BOX -->
                    <div class="p-3 rounded-4 bg-light border text-center">
                        <i class="fas fa-book-bookmark text-primary fs-4 mb-2"></i>
                        <h6 class="fw-bold outfit text-dark mb-1" style="font-size: 13px;">JDIH Kemenhub</h6>
                        <p class="text-muted small mb-2" style="font-size: 11.5px;">Cari peraturan transportasi terlengkap di Jaringan Dokumentasi dan Informasi Hukum.</p>
                        <a href="https://jdih.dephub.go.id/" target="_blank" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" style="font-size: 11px;">
                            Buka JDIH <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: TOOLBAR & SHOWCASE MATRIX -->
            <div class="col-lg-9">
                
                <!-- TOOLBAR -->
                <div class="showcase-toolbar" data-aos="fade-left">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-7">
                            <div class="position-relative">
                                <i class="fas fa-search search-icon-pos"></i>
                                <input type="text" id="liveSearchRegulasi" class="search-regulasi-input" placeholder="Cari judul peraturan, nomor SK/UU, atau topik hukum..." oninput="handleSearch()">
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-center justify-content-md-end gap-2">
                            <span class="text-muted small me-1">Tampilan:</span>
                            <button type="button" id="btnViewGrid" class="view-mode-btn active" onclick="switchViewMode('grid')">
                                <i class="fas fa-th-large"></i> Kartu
                            </button>
                            <button type="button" id="btnViewTable" class="view-mode-btn" onclick="switchViewMode('table')">
                                <i class="fas fa-table-list"></i> Tabel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 1. BENTO CARDS VIEW -->
                <div id="regulasiGridView" class="row g-3">
                    @foreach($itemsList as $item)
                    @php
                        $tagClass = 'cat-tag-uu';
                        if ($item['kategori'] === 'Komisi Informasi Pusat') $tagClass = 'cat-tag-kip';
                        elseif ($item['kategori'] === 'Kementerian Perhubungan') $tagClass = 'cat-tag-kemenhub';
                        elseif ($item['kategori'] === 'PKTJ Tegal') $tagClass = 'cat-tag-pktj';
                    @endphp
                    <div class="col-md-6 regulasi-card-item" 
                         data-category="{{ $item['kategori'] }}" 
                         data-year="{{ $item['tahun'] }}"
                         data-search="{{ strtolower($item['judul'] . ' ' . $item['nomor'] . ' ' . $item['deskripsi'] . ' ' . $item['kategori'] . ' ' . $item['tahun']) }}">
                        <div class="regulasi-bento-card">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="cat-tag {{ $tagClass }}">{{ $item['kategori'] }}</span>
                                    <span class="nomor-badge">{{ $item['nomor'] }}</span>
                                </div>
                                <h5 class="outfit fw-bold text-dark mb-2" style="font-size: 15px; line-height: 1.45; color: #002b5c !important;">
                                    {{ $item['judul'] }}
                                </h5>
                                <p class="text-muted small mb-4" style="font-size: 12.5px; line-height: 1.6;">
                                    {{ $item['deskripsi'] }}
                                </p>
                            </div>
                            <div class="pt-3 border-top d-flex align-items-center justify-content-between gap-2">
                                <span class="badge bg-light text-secondary border font-monospace" style="font-size: 11px;">
                                    <i class="far fa-calendar me-1"></i> Tahun {{ $item['tahun'] }}
                                </span>
                                <div class="d-flex gap-1.5">
                                    <button type="button" class="btn-action-preview" onclick="openPreviewModal('{{ addslashes($item['judul']) }}', '{{ $item['nomor'] }}', '{{ $item['file_path'] }}', '{{ $item['kategori'] }}')">
                                        <i class="far fa-eye"></i> Pratinjau
                                    </button>
                                    <a href="{{ $item['file_path'] }}" target="_blank" class="btn-action-download">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- 2. SMART TABLE VIEW (HIDDEN BY DEFAULT) -->
                <div id="regulasiTableView" class="smart-regulasi-table d-none">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 25%;">Nomor / Tahun</th>
                                    <th style="width: 45%;">Judul Regulasi & Intisari</th>
                                    <th style="width: 15%;">Kategori</th>
                                    <th style="width: 10%;" class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="smartTableBody">
                                @foreach($itemsList as $idx => $item)
                                <tr class="regulasi-table-row"
                                    data-category="{{ $item['kategori'] }}" 
                                    data-year="{{ $item['tahun'] }}"
                                    data-search="{{ strtolower($item['judul'] . ' ' . $item['nomor'] . ' ' . $item['deskripsi'] . ' ' . $item['kategori'] . ' ' . $item['tahun']) }}">
                                    <td class="text-muted fw-bold text-center">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="nomor-badge d-inline-block mb-1">{{ $item['nomor'] }}</div>
                                        <div class="small text-muted font-monospace"><i class="far fa-calendar me-1"></i>{{ $item['tahun'] }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark mb-1" style="font-size: 13.5px; color: #002b5c;">{{ $item['judul'] }}</div>
                                        <div class="text-muted small" style="font-size: 12px;">{{ Str::limit($item['deskripsi'], 120) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill" style="font-size: 11px;">
                                            {{ $item['kategori'] }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-primary" title="Pratinjau Dokumen" onclick="openPreviewModal('{{ addslashes($item['judul']) }}', '{{ $item['nomor'] }}', '{{ $item['file_path'] }}', '{{ $item['kategori'] }}')">
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <a href="{{ $item['file_path'] }}" target="_blank" class="btn btn-primary" title="Unduh Dokumen">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- EMPTY STATE SEARCH -->
                <div id="noResultsBox" class="text-center py-5 bg-white rounded-4 border d-none">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h5 class="outfit fw-bold text-dark mb-1">Regulasi Tidak Ditemukan</h5>
                    <p class="text-muted small mb-3">Tidak ada peraturan yang cocok dengan kata kunci pencarian atau filter yang dipilih.</p>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="resetFilters()">
                        <i class="fas fa-rotate-left me-1"></i> Reset Semua Filter
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- MODAL PRATINJAU DOKUMEN -->
    <div class="modal fade modal-regulasi-preview" id="modalPreviewRegulasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background: #002b5c; border: none; padding: 20px 24px;">
                    <div>
                        <span class="badge bg-warning text-dark fw-bold px-2.5 py-1 rounded-pill mb-1" id="modalRegulasiBadge">Kategori</span>
                        <h6 class="modal-title outfit fw-bold text-white mb-0" id="modalRegulasiTitle">Judul Regulasi</h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="alert alert-info d-flex align-items-center mb-3 rounded-3 py-2 px-3 small border-0" style="background: #e0f2fe; color: #0369a1;">
                        <i class="fas fa-info-circle me-2 fs-5"></i>
                        <div>Dokumen peraturan resmi ini dapat dibaca langsung atau diunduh dari repositori JDIH Kemenhub / PPID PKTJ.</div>
                    </div>
                    <div class="p-3 bg-white rounded-3 border text-center my-3">
                        <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                        <h6 class="fw-bold text-dark mb-1" id="modalRegulasiNomor">Nomor Regulasi</h6>
                        <p class="text-muted small mb-3">Salinan format softcopy PDF resmi.</p>
                        <a id="modalDownloadBtn" href="#" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold">
                            <i class="fas fa-arrow-up-right-from-square me-1"></i> Buka / Unduh Dokumen Lengkap
                        </a>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top py-2 px-4 d-flex justify-content-between">
                    <span class="text-muted small">PPID Politeknik Keselamatan Transportasi Jalan</span>
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        let currentCategory = 'all';
        let currentYear = 'all';
        let currentSearchQuery = '';

        function filterByCategory(cat, btnElement) {
            currentCategory = cat;
            document.querySelectorAll('.category-nav-item').forEach(el => el.classList.remove('active'));
            if (btnElement) btnElement.classList.add('active');
            applyAllFilters();
        }

        function filterByYear(year) {
            currentYear = year;
            applyAllFilters();
        }

        function handleSearch() {
            currentSearchQuery = document.getElementById('liveSearchRegulasi').value.toLowerCase().trim();
            applyAllFilters();
        }

        function applyAllFilters() {
            const cardItems = document.querySelectorAll('.regulasi-card-item');
            const tableRows = document.querySelectorAll('.regulasi-table-row');
            let visibleCount = 0;

            cardItems.forEach(card => {
                const itemCat = card.getAttribute('data-category');
                const itemYr = card.getAttribute('data-year');
                const searchTerms = card.getAttribute('data-search');

                const matchCat = (currentCategory === 'all' || itemCat === currentCategory);
                const matchYr = (currentYear === 'all' || itemYr === currentYear);
                const matchSearch = (!currentSearchQuery || searchTerms.includes(currentSearchQuery));

                if (matchCat && matchYr && matchSearch) {
                    card.classList.remove('d-none');
                    visibleCount++;
                } else {
                    card.classList.add('d-none');
                }
            });

            tableRows.forEach(row => {
                const itemCat = row.getAttribute('data-category');
                const itemYr = row.getAttribute('data-year');
                const searchTerms = row.getAttribute('data-search');

                const matchCat = (currentCategory === 'all' || itemCat === currentCategory);
                const matchYr = (currentYear === 'all' || itemYr === currentYear);
                const matchSearch = (!currentSearchQuery || searchTerms.includes(currentSearchQuery));

                if (matchCat && matchYr && matchSearch) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });

            const noResults = document.getElementById('noResultsBox');
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }

        function resetFilters() {
            currentCategory = 'all';
            currentYear = 'all';
            currentSearchQuery = '';
            document.getElementById('liveSearchRegulasi').value = '';
            const allBtn = document.querySelector('.category-nav-item');
            if (allBtn) filterByCategory('all', allBtn);
            else applyAllFilters();
        }

        function switchViewMode(mode) {
            const gridView = document.getElementById('regulasiGridView');
            const tableView = document.getElementById('regulasiTableView');
            const btnGrid = document.getElementById('btnViewGrid');
            const btnTable = document.getElementById('btnViewTable');

            if (mode === 'grid') {
                gridView.classList.remove('d-none');
                tableView.classList.add('d-none');
                btnGrid.classList.add('active');
                btnTable.classList.remove('active');
            } else {
                gridView.classList.add('d-none');
                tableView.classList.remove('d-none');
                btnGrid.classList.remove('active');
                btnTable.classList.add('active');
            }
        }

        function openPreviewModal(judul, nomor, link, kategori) {
            document.getElementById('modalRegulasiTitle').textContent = judul;
            document.getElementById('modalRegulasiNomor').textContent = nomor;
            document.getElementById('modalRegulasiBadge').textContent = kategori;
            document.getElementById('modalDownloadBtn').href = link;
            
            const modalEl = document.getElementById('modalPreviewRegulasi');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
</body>
</html>
