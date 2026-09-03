<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi Keterbukaan Informasi Publik - PPID PKTJ Tegal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #002b5c;
            --secondary-blue: #004a99;
            --accent-gold: #ffc107;
            --bg-canvas: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* HERO CLEAN GRADIENT */
        .hero-regulasi {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            padding: 70px 0 80px;
            color: white;
            position: relative;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 20px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(12px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffd166;
            margin-bottom: 16px;
        }

        .page-container {
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        /* TOOLBAR & CONTROLS */
        .showcase-toolbar {
            background: white;
            border-radius: 20px;
            padding: 20px 24px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.9);
            margin-bottom: 25px;
        }

        .search-regulasi-input {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px 12px 44px;
            font-size: 14px;
            width: 100%;
            transition: all 0.25s ease;
            background: #f8fafc;
        }

        .search-regulasi-input:focus {
            outline: none;
            border-color: #004a99;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
        }

        .search-icon-pos {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
        }

        /* CATEGORY FILTER TABS */
        .cat-tab-btn {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.25s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .cat-tab-btn:hover {
            border-color: #cbd5e1;
            background: #f1f5f9;
            color: #002b5c;
        }

        .cat-tab-btn.active {
            background: #002b5c;
            color: white;
            border-color: #002b5c;
            box-shadow: 0 4px 12px rgba(0, 43, 92, 0.2);
        }

        .cat-tab-btn .badge-count {
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 9999px;
            background: rgba(0, 0, 0, 0.08);
            color: inherit;
        }

        .cat-tab-btn.active .badge-count {
            background: rgba(255, 255, 255, 0.25);
            color: white;
        }

        /* VIEW MODE TOGGLE */
        .view-mode-btn {
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .view-mode-btn.active {
            background: #004a99;
            color: white;
            border-color: #004a99;
        }

        /* SMART TABLE VIEW */
        .smart-regulasi-table {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.9);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .smart-regulasi-table thead th {
            background: #002b5c;
            color: white;
            font-weight: 700;
            font-size: 13px;
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

        /* BENTO CARDS VIEW */
        .regulasi-bento-card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 8px 25px rgba(0, 43, 92, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.9);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .regulasi-bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 35px rgba(0, 43, 92, 0.1);
            border-color: #cbd5e1;
        }

        .nomor-badge {
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
            letter-spacing: 0.3px;
            background: #e2e8f0;
            color: #1e293b;
        }

        .cat-tag {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }

        .cat-tag-uu { background: #e0e7ff; color: #3730a3; }
        .cat-tag-kip { background: #fce7f3; color: #9d174d; }
        .cat-tag-kemenhub { background: #e0f2fe; color: #075985; }
        .cat-tag-pktj { background: #fef3c7; color: #92400e; }

        .btn-action-preview {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action-preview:hover {
            background: #e2e8f0;
            color: #002b5c;
        }

        .btn-action-download {
            background: #002b5c;
            color: white;
            border: none;
            padding: 7px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action-download:hover {
            background: #004a99;
            color: white;
        }

        /* MODAL PREVIEW */
        .modal-regulasi-preview .modal-dialog { max-width: 900px; }
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
                <i class="fas fa-balance-scale text-warning"></i> Landasan Hukum PPID PKTJ
            </div>
            <h1 class="display-6 fw-bold outfit text-uppercase mb-3 tracking-tight" data-aos="fade-up">
                {{ $profil->judul ?? 'Regulasi Keterbukaan Informasi Publik' }}
            </h1>
            <p class="lead opacity-90 mx-auto mb-4" style="max-width: 820px; font-size: 15px;" data-aos="fade-up" data-aos-delay="100">
                Pusat data seluruh peraturan perundang-undangan nasional, standar Komisi Informasi Pusat, regulasi Kementerian Perhubungan, dan Keputusan Direktur PKTJ.
            </p>
            <div data-aos="fade-up" data-aos-delay="150">
                <a href="https://bpsdm.kemenhub.go.id/jdih/" target="_blank" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill text-dark shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fas fa-external-link-alt"></i> Portal JDIH BPSDM Perhubungan
                </a>
            </div>
        </div>
    </div>

    <!-- PREPARE DATA FAILSAFE -->
    @php
        $fallbackRegulasi = [
            [
                'id' => 1,
                'judul' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik',
                'nomor' => 'UU No. 14 Tahun 2008',
                'tahun' => 2008,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Undang-Undang induk yang menjamin hak warga negara untuk memperoleh informasi publik dan kewajiban badan publik menyediakan informasi secara terbuka, transparan, dan akuntabel.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 2,
                'judul' => 'Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik',
                'nomor' => 'UU No. 25 Tahun 2009',
                'tahun' => 2009,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Mengatur prinsip kepastian hukum, keterbukaan, akuntabilitas, fasilitas khusus bagi kelompok rentan, serta ketepatan waktu dalam penyelenggaraan pelayanan publik di Indonesia.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 3,
                'judul' => 'Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan UU Keterbukaan Informasi Publik',
                'nomor' => 'PP No. 61 Tahun 2010',
                'tahun' => 2010,
                'kategori' => 'Undang-Undang',
                'deskripsi' => 'Ketentuan teknis mengenai hak dan kewajiban pemohon informasi, pejabat pengelola informasi dan dokumentasi, pengujian konsekuensi, serta tata cara ganti rugi.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 4,
                'judul' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik',
                'nomor' => 'Peraturan KIP No. 1 Tahun 2021',
                'tahun' => 2021,
                'kategori' => 'Komisi Informasi Pusat',
                'deskripsi' => 'Pedoman komprehensif tata kelola klasifikasi informasi publik, penyusunan DIP dan DIK, akomodasi disabilitas, serta standar waktu pelayanan informasi publik.',
                'file_path' => 'https://komisiinformasi.go.id/',
            ],
            [
                'id' => 5,
                'judul' => 'Peraturan Komisi Informasi Nomor 1 Tahun 2013 tentang Prosedur Penyelesaian Sengketa Informasi Publik',
                'nomor' => 'Peraturan KIP No. 1 Tahun 2013',
                'tahun' => 2013,
                'kategori' => 'Komisi Informasi Pusat',
                'deskripsi' => 'Tata cara dan mekanisme penyelesaian sengketa informasi publik melalui mediasi dan ajudikasi non-litigasi.',
                'file_path' => 'https://komisiinformasi.go.id/',
            ],
            [
                'id' => 6,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kemenhub',
                'nomor' => 'Permenhub PM 46/2018',
                'tahun' => 2018,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Regulasi pokok struktur, tugas wewenang, dan tata kerja PPID Utama, PPID Pelaksana, dan PPID Pelaksana UPT di lingkungan Kementerian Perhubungan.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 7,
                'judul' => 'Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang Penetapan Klasifikasi Informasi yang Dikecualikan',
                'nomor' => 'Kepmenhub KM 117/2022',
                'tahun' => 2022,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Daftar resmi informasi yang dikecualikan di lingkungan Kementerian Perhubungan beserta alasan dan uji konsekuensinya.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 8,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 58 Tahun 2020 tentang Pengendalian Gratifikasi di Lingkungan Kementerian Perhubungan',
                'nomor' => 'Permenhub PM 58/2020',
                'tahun' => 2020,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Mekanisme pencegahan tindak pidana korupsi dan pengendalian penerimaan atau penolakan gratifikasi.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 9,
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 85 Tahun 2020 tentang Penyelenggaraan SPIP di Lingkungan Kementerian Perhubungan',
                'nomor' => 'Permenhub PM 85/2020',
                'tahun' => 2020,
                'kategori' => 'Kementerian Perhubungan',
                'deskripsi' => 'Pedoman sistem pengendalian intern pemerintah dalam menciptakan tata kelola keuangan dan operasional yang transparan.',
                'file_path' => 'https://jdih.dephub.go.id/',
            ],
            [
                'id' => 10,
                'judul' => 'Keputusan Direktur PKTJ tentang Penunjukan Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana UPT PKTJ Tegal',
                'nomor' => 'SK PPID PKTJ 2024',
                'tahun' => 2024,
                'kategori' => 'PKTJ',
                'deskripsi' => 'Penetapan struktur, tim pembantu, dan penanggung jawab layanan keterbukaan informasi publik di lingkungan kampus PKTJ Tegal.',
                'file_path' => 'storage/dokumen/B1.pdf',
            ],
            [
                'id' => 11,
                'judul' => 'Surat Keputusan Direktur PKTJ tentang Standar Operasional Prosedur (SOP) Pelayanan Informasi Publik PKTJ Tegal',
                'nomor' => 'SOP PKTJ 2024',
                'tahun' => 2024,
                'kategori' => 'PKTJ',
                'deskripsi' => 'Buku pedoman SOP permohonan informasi, penanganan keberatan, penetapan daftar informasi, dan pengujian konsekuensi di lingkungan PKTJ.',
                'file_path' => 'storage/dokumen/G2.pdf',
            ],
        ];

        $itemsList = collect();
        if (isset($allRegulasi) && $allRegulasi->count() > 0) {
            foreach ($allRegulasi as $r) {
                $kat = $r->kategori ?? 'Umum';
                if ($kat === 'PKTJ Tegal') $kat = 'PKTJ';
                if ($kat === 'Komisi Informasi Pusat') $kat = 'Peraturan KIP';

                $itemsList->push([
                    'id' => $r->id,
                    'judul' => $r->judul,
                    'nomor' => $r->nomor ?? 'Regulasi Resmi',
                    'tahun' => $r->tahun ?? 2024,
                    'kategori' => $kat,
                    'deskripsi' => $r->deskripsi ?? 'Dokumen landasan hukum keterbukaan informasi publik resmi.',
                    'file_path' => $r->file_path ? asset($r->file_path) : ($r->link_download ?? 'https://bpsdm.kemenhub.go.id/jdih/'),
                ]);
            }
        } else {
            $itemsList = collect($fallbackRegulasi);
        }

        $cntTotal = $itemsList->count();
        $cntUU = $itemsList->where('kategori', 'Undang-Undang')->count();
        $cntKIP = $itemsList->where('kategori', 'Komisi Informasi Pusat')->count() ?: $itemsList->where('kategori', 'Peraturan KIP')->count();
        $cntKemenhub = $itemsList->where('kategori', 'Kementerian Perhubungan')->count();
        $cntPKTJ = $itemsList->where('kategori', 'PKTJ')->count() ?: $itemsList->where('kategori', 'PKTJ Tegal')->count();
    @endphp

    <div class="container page-container">

        <!-- CONTROLS & SEARCH TOOLBAR -->
        <div class="showcase-toolbar" data-aos="fade-up">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-lg-7">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon-pos"></i>
                        <input type="text" id="liveSearchRegulasi" class="search-regulasi-input" placeholder="Cari judul peraturan, nomor SK/UU, atau kata kunci topik hukum..." oninput="handleSearch()">
                    </div>
                </div>
                <div class="col-lg-5 d-flex align-items-center justify-content-lg-end gap-2">
                    <span class="text-muted small me-1">Tampilan:</span>
                    <button type="button" id="btnViewTable" class="view-mode-btn active" onclick="switchViewMode('table')">
                        <i class="fas fa-table me-1"></i> Tabel
                    </button>
                    <button type="button" id="btnViewGrid" class="view-mode-btn" onclick="switchViewMode('grid')">
                        <i class="fas fa-th-large me-1"></i> Kartu
                    </button>
                    <a href="https://bpsdm.kemenhub.go.id/jdih/" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1.5 fw-bold ms-2" style="font-size: 12px;">
                        <i class="fas fa-arrow-up-right-from-square me-1"></i> JDIH BPSDM
                    </a>
                </div>
            </div>

            <!-- HORIZONTAL CATEGORY TABS -->
            <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                <button type="button" class="cat-tab-btn active" onclick="filterByCategory('all', this)">
                    <i class="fas fa-layer-group text-primary"></i> Semua Regulasi
                    <span class="badge-count">{{ $cntTotal }}</span>
                </button>
                <button type="button" class="cat-tab-btn" onclick="filterByCategory('Undang-Undang', this)">
                    <i class="fas fa-landmark text-indigo"></i> Undang-Undang RI
                    <span class="badge-count">{{ $cntUU }}</span>
                </button>
                <button type="button" class="cat-tab-btn" onclick="filterByCategory('Peraturan KIP', this)">
                    <i class="fas fa-scale-balanced text-danger"></i> Peraturan KIP
                    <span class="badge-count">{{ $cntKIP }}</span>
                </button>
                <button type="button" class="cat-tab-btn" onclick="filterByCategory('Kementerian Perhubungan', this)">
                    <i class="fas fa-building-columns text-info"></i> Kementerian Perhubungan
                    <span class="badge-count">{{ $cntKemenhub }}</span>
                </button>
                <button type="button" class="cat-tab-btn" onclick="filterByCategory('PKTJ', this)">
                    <i class="fas fa-university text-warning"></i> PKTJ
                    <span class="badge-count">{{ $cntPKTJ }}</span>
                </button>
            </div>
        </div>

        <!-- 1. SMART TABLE VIEW (DEFAULT) -->
        <div id="regulasiTableView" class="smart-regulasi-table" data-aos="fade-up">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th style="width: 24%;">Nomor / Tahun</th>
                            <th style="width: 44%;">Judul Regulasi & Intisari</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 12%;" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="smartTableBody">
                        @foreach($itemsList as $idx => $item)
                        @php
                            $catBadge = 'cat-tag-uu';
                            $cleanCat = $item['kategori'];
                            if (str_contains($cleanCat, 'KIP') || str_contains($cleanCat, 'Komisi')) {
                                $catBadge = 'cat-tag-kip';
                                $cleanCat = 'Peraturan KIP';
                            } elseif (str_contains($cleanCat, 'Kemenhub') || str_contains($cleanCat, 'Perhubungan')) {
                                $catBadge = 'cat-tag-kemenhub';
                                $cleanCat = 'Kementerian Perhubungan';
                            } elseif (str_contains($cleanCat, 'PKTJ')) {
                                $catBadge = 'cat-tag-pktj';
                                $cleanCat = 'PKTJ';
                            }
                        @endphp
                        <tr class="regulasi-table-row"
                            data-category="{{ $cleanCat }}" 
                            data-year="{{ $item['tahun'] }}"
                            data-search="{{ strtolower($item['judul'] . ' ' . $item['nomor'] . ' ' . $item['deskripsi'] . ' ' . $cleanCat . ' ' . $item['tahun']) }}">
                            <td class="text-muted fw-bold text-center">{{ $idx + 1 }}</td>
                            <td>
                                <div class="nomor-badge d-inline-block mb-1">{{ $item['nomor'] }}</div>
                                <div class="text-muted font-monospace small" style="font-size: 11.5px;">
                                    <i class="far fa-calendar me-1"></i> Tahun {{ $item['tahun'] }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1" style="font-size: 14.5px; color: #002b5c !important;">
                                    {{ $item['judul'] }}
                                </div>
                                <div class="text-muted small" style="font-size: 12.5px; line-height: 1.5;">
                                    {{ $item['deskripsi'] }}
                                </div>
                            </td>
                            <td>
                                <span class="cat-tag {{ $catBadge }} d-inline-flex align-items-center gap-1">
                                    @if($cleanCat === 'Kementerian Perhubungan')
                                        <i class="fas fa-building-columns"></i>
                                    @elseif($cleanCat === 'PKTJ')
                                        <i class="fas fa-university"></i>
                                    @elseif($cleanCat === 'Peraturan KIP')
                                        <i class="fas fa-scale-balanced"></i>
                                    @else
                                        <i class="fas fa-landmark"></i>
                                    @endif
                                    {{ $cleanCat }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1.5">
                                    <button type="button" class="btn-action-preview" onclick="openPreviewModal('{{ addslashes($item['judul']) }}', '{{ $item['nomor'] }}', '{{ $item['file_path'] }}', '{{ $cleanCat }}')">
                                        <i class="far fa-eye"></i> Lihat
                                    </button>
                                    <a href="{{ $item['file_path'] }}" target="_blank" class="btn-action-download">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. BENTO CARDS VIEW (HIDDEN BY DEFAULT) -->
        <div id="regulasiGridView" class="row g-3 d-none mb-5" data-aos="fade-up">
            @foreach($itemsList as $item)
            @php
                $catBadge = 'cat-tag-uu';
                $cleanCat = $item['kategori'];
                if (str_contains($cleanCat, 'KIP') || str_contains($cleanCat, 'Komisi')) {
                    $catBadge = 'cat-tag-kip';
                    $cleanCat = 'Peraturan KIP';
                } elseif (str_contains($cleanCat, 'Kemenhub') || str_contains($cleanCat, 'Perhubungan')) {
                    $catBadge = 'cat-tag-kemenhub';
                    $cleanCat = 'Kementerian Perhubungan';
                } elseif (str_contains($cleanCat, 'PKTJ')) {
                    $catBadge = 'cat-tag-pktj';
                    $cleanCat = 'PKTJ';
                }
            @endphp
            <div class="col-md-6 regulasi-card-item" 
                 data-category="{{ $cleanCat }}" 
                 data-year="{{ $item['tahun'] }}"
                 data-search="{{ strtolower($item['judul'] . ' ' . $item['nomor'] . ' ' . $item['deskripsi'] . ' ' . $cleanCat . ' ' . $item['tahun']) }}">
                <div class="regulasi-bento-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="cat-tag {{ $catBadge }} d-inline-flex align-items-center gap-1">
                                @if($cleanCat === 'Kementerian Perhubungan')
                                    <i class="fas fa-building-columns"></i>
                                @elseif($cleanCat === 'PKTJ')
                                    <i class="fas fa-university"></i>
                                @elseif($cleanCat === 'Peraturan KIP')
                                    <i class="fas fa-scale-balanced"></i>
                                @else
                                    <i class="fas fa-landmark"></i>
                                @endif
                                {{ $cleanCat }}
                            </span>
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
                            <button type="button" class="btn-action-preview" onclick="openPreviewModal('{{ addslashes($item['judul']) }}', '{{ $item['nomor'] }}', '{{ $item['file_path'] }}', '{{ $cleanCat }}')">
                                <i class="far fa-eye"></i> Lihat
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

        <!-- NO RESULTS FALLBACK -->
        <div id="noResultsBox" class="p-5 text-center bg-white rounded-4 border my-4 d-none">
            <i class="fas fa-file-circle-question fa-3x text-muted mb-3 opacity-50"></i>
            <h5 class="fw-bold outfit text-dark">Regulasi Tidak Ditemukan</h5>
            <p class="text-muted small mb-3">Tidak ada peraturan yang cocok dengan kata kunci atau filter pencarian Anda.</p>
            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="resetFilters()">
                <i class="fas fa-rotate-left me-1"></i> Reset Pencarian
            </button>
        </div>

    </div>

    <!-- MODAL PREVIEW DOKUMEN REGULASI -->
    <div class="modal fade modal-regulasi-preview" id="modalPreviewRegulasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header text-white border-0 py-3 px-4" style="background: #002b5c;">
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
                    <div class="p-4 bg-white rounded-3 border text-center my-2">
                        <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                        <h6 class="fw-bold text-dark mb-1" id="modalRegulasiNomor">Nomor Regulasi</h6>
                        <p class="text-muted small mb-3">Salinan format dokumen PDF resmi.</p>
                        <a id="modalDownloadBtn" href="#" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
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
        let currentSearchQuery = '';

        function filterByCategory(cat, btnElement) {
            currentCategory = cat;
            document.querySelectorAll('.cat-tab-btn').forEach(el => el.classList.remove('active'));
            if (btnElement) btnElement.classList.add('active');
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
                const searchTerms = card.getAttribute('data-search');

                const matchCat = (currentCategory === 'all' || itemCat === currentCategory);
                const matchSearch = (!currentSearchQuery || searchTerms.includes(currentSearchQuery));

                if (matchCat && matchSearch) {
                    card.classList.remove('d-none');
                    visibleCount++;
                } else {
                    card.classList.add('d-none');
                }
            });

            tableRows.forEach(row => {
                const itemCat = row.getAttribute('data-category');
                const searchTerms = row.getAttribute('data-search');

                const matchCat = (currentCategory === 'all' || itemCat === currentCategory);
                const matchSearch = (!currentSearchQuery || searchTerms.includes(currentSearchQuery));

                if (matchCat && matchSearch) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });

            const noResults = document.getElementById('noResultsBox');
            if (visibleCount === 0 && (currentSearchQuery || currentCategory !== 'all')) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }

        function resetFilters() {
            currentCategory = 'all';
            currentSearchQuery = '';
            document.getElementById('liveSearchRegulasi').value = '';
            const allBtn = document.querySelector('.cat-tab-btn');
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
