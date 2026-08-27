<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Regulasi & Dasar Hukum PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Kumpulan regulasi, undang-undang, keputusan menteri, dan SOP terkait Keterbukaan Informasi Publik di lingkungan PPID PKTJ Tegal dan Kementerian Perhubungan.">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004a99' }};
            --deep-navy: #002b5c;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#ffc107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.92) 0%, rgba(0, 74, 153, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 95px 0 115px;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffd166;
            margin-bottom: 20px;
        }

        .content-card {
            background: white;
            padding: 40px;
            border-radius: 28px;
            box-shadow: 0 20px 50px rgba(0, 43, 92, 0.06);
            margin-top: -65px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 20;
            margin-bottom: 60px;
        }

        @media (max-width: 768px) {
            .content-card { padding: 24px 18px; margin-top: -45px; }
            .hero-section { padding: 75px 0 95px; }
        }

        /* Filter Tabs */
        .category-tab-btn {
            border: none;
            background: #f1f5f9;
            color: #475569;
            padding: 10px 22px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.25s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .category-tab-btn:hover {
            background: #e2e8f0;
            color: var(--deep-navy);
        }

        .category-tab-btn.active {
            background: var(--deep-navy);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.25);
        }

        /* Search Input */
        .regulasi-search-box {
            position: relative;
            width: 100%;
        }

        .regulasi-search-box input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            font-size: 14.5px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        }

        .regulasi-search-box input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.12);
        }

        .regulasi-search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        /* Regulasi Card Item */
        .regulasi-item-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 24px 26px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .regulasi-item-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }

        .regulasi-item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 35px rgba(0, 43, 92, 0.08);
            border-color: #cbd5e1;
        }

        .regulasi-item-card:hover::before {
            width: 8px;
            background: var(--secondary-gold);
        }

        .cat-badge {
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cat-uu { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
        .cat-kip { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .cat-kemenhub { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
        .cat-pktj { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .cat-default { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        .btn-download-reg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white !important;
            font-size: 12.5px;
            font-weight: 700;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 74, 153, 0.2);
        }

        .btn-download-reg:hover {
            background: linear-gradient(135deg, #001f42 0%, #003875 100%);
            transform: scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 74, 153, 0.3);
        }
    </style>
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <div class="hero-badge">
                <i class="fas fa-balance-scale"></i> Dasar Hukum & Regulasi Resmi
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-3 tracking-tight">
                {{ $profil->judul ?? 'Regulasi Keterbukaan Informasi' }}
            </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 780px; font-size: 16px;">
                {{ $profil->tagline_hero ?? 'Kumpulan Undang-Undang, Peraturan Komisi Informasi, Peraturan Menteri Perhubungan, dan Keputusan Terkait Keterbukaan Informasi Publik di Lingkungan PKTJ.' }}
            </p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">

            <!-- SEARCH BAR & STATS -->
            <div class="row g-3 align-items-center mb-4">
                <div class="col-lg-7">
                    <div class="regulasi-search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="regulasiSearchInput" placeholder="Ketik kata kunci, nomor regulasi, atau perihal peraturan..." onkeyup="filterRegulasi()">
                    </div>
                </div>
                <div class="col-lg-5 text-lg-end text-muted small">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill font-mono" style="font-size: 12.5px;">
                        <i class="fas fa-file-contract text-primary me-1"></i> Total: <strong id="totalRegulasiCount">{{ $allRegulasi->count() }}</strong> Regulasi
                    </span>
                </div>
            </div>

            <!-- CATEGORY FILTER TABS -->
            <div class="d-flex flex-wrap gap-2 mb-5 pb-3 border-bottom" id="categoryTabContainer">
                <button type="button" class="category-tab-btn active" onclick="setCategoryFilter('all', this)">
                    <i class="fas fa-layer-group"></i> Semua Regulasi
                </button>
                <button type="button" class="category-tab-btn" onclick="setCategoryFilter('Undang-Undang', this)">
                    <i class="fas fa-landmark"></i> Undang-Undang
                </button>
                <button type="button" class="category-tab-btn" onclick="setCategoryFilter('Komisi Informasi Pusat', this)">
                    <i class="fas fa-shield-alt"></i> Komisi Informasi Pusat
                </button>
                <button type="button" class="category-tab-btn" onclick="setCategoryFilter('Kementerian Perhubungan', this)">
                    <i class="fas fa-ship"></i> Kementerian Perhubungan
                </button>
                <button type="button" class="category-tab-btn" onclick="setCategoryFilter('PKTJ Tegal', this)">
                    <i class="fas fa-university"></i> PKTJ Tegal
                </button>
            </div>

            <!-- REGULASI GRID LIST -->
            <div class="row g-4" id="regulasiGrid">
                @forelse($allRegulasi as $reg)
                @php
                    $catClass = 'cat-default';
                    if (str_contains($reg->kategori, 'Undang')) $catClass = 'cat-uu';
                    elseif (str_contains($reg->kategori, 'Komisi')) $catClass = 'cat-kip';
                    elseif (str_contains($reg->kategori, 'Perhubungan')) $catClass = 'cat-kemenhub';
                    elseif (str_contains($reg->kategori, 'PKTJ')) $catClass = 'cat-pktj';

                    $targetLink = $reg->file_path ? asset($reg->file_path) : ($reg->link_download ?? '#');
                @endphp
                <div class="col-lg-6 regulasi-item-wrapper" data-category="{{ $reg->kategori }}" data-keywords="{{ strtolower($reg->judul . ' ' . $reg->nomor . ' ' . $reg->deskripsi . ' ' . $reg->tahun . ' ' . $reg->kategori) }}">
                    <div class="regulasi-item-card">
                        <div>
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                <span class="cat-badge {{ $catClass }}">{{ $reg->kategori }}</span>
                                @if($reg->tahun)
                                <span class="badge bg-light text-secondary border font-mono px-2.5 py-1 rounded-pill" style="font-size: 11.5px;">
                                    <i class="fas fa-calendar-alt me-1 text-warning"></i> {{ $reg->tahun }}
                                </span>
                                @endif
                            </div>

                            <h5 class="fw-bold outfit text-dark mb-2" style="font-size: 1.1rem; line-height: 1.4; color: #002b5c !important;">
                                {{ $reg->judul }}
                            </h5>

                            @if($reg->deskripsi)
                            <p class="text-secondary small mb-4" style="line-height: 1.6; font-size: 13px;">
                                {{ $reg->deskripsi }}
                            </p>
                            @endif
                        </div>

                        <div class="pt-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <span class="text-muted small" style="font-size: 11px;">
                                <i class="fas fa-check-circle text-success me-1"></i> Dokumen Resmi
                            </span>
                            @if($targetLink && $targetLink !== '#')
                            <a href="{{ $targetLink }}" target="_blank" class="btn-download-reg">
                                <i class="fas fa-file-download"></i> Unduh / Buka Dokumen
                            </a>
                            @else
                            <span class="badge bg-light text-muted border">Tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada regulasi yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>

            <!-- EMPTY STATE WHEN FILTER EMPTY -->
            <div id="noResultsState" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x text-muted opacity-30 mb-3"></i>
                <h5 class="fw-bold text-dark mb-1">Regulasi Tidak Ditemukan</h5>
                <p class="text-muted small">Tidak ada regulasi yang sesuai dengan kata kunci pencarian Anda.</p>
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-4" onclick="resetFilter()">Reset Pencarian</button>
            </div>

            <!-- INFORMASI TAMBAHAN JDIH -->
            <div class="mt-5 p-4 rounded-3 text-center" style="background: linear-gradient(135deg, #f0f7ff 0%, #e6f0fa 100%); border: 1px solid #cce3f5;">
                <h6 class="fw-bold outfit text-[#004a99] mb-1">
                    <i class="fas fa-info-circle me-1"></i> Mencari Peraturan Transportasi Lainnya?
                </h6>
                <p class="text-secondary small mb-3">Kunjungi Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kementerian Perhubungan RI untuk database lengkap peraturan sektor perhubungan.</p>
                <a href="https://jdih.dephub.go.id" target="_blank" class="btn btn-sm btn-primary rounded-pill px-4 py-2 fw-bold" style="background: #004a99;">
                    <i class="fas fa-external-link-alt me-1.5"></i> Buka Portal JDIH Dephub
                </a>
            </div>

        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({duration: 800, once: true});

        let currentCategory = 'all';

        function setCategoryFilter(cat, btnElem) {
            currentCategory = cat;
            document.querySelectorAll('.category-tab-btn').forEach(b => b.classList.remove('active'));
            btnElem.classList.add('active');
            filterRegulasi();
        }

        function filterRegulasi() {
            const query = document.getElementById('regulasiSearchInput').value.toLowerCase().trim();
            const items = document.querySelectorAll('.regulasi-item-wrapper');
            let visibleCount = 0;

            items.forEach(item => {
                const itemCat = item.getAttribute('data-category');
                const itemKeywords = item.getAttribute('data-keywords');

                const matchCat = (currentCategory === 'all' || itemCat.toLowerCase().includes(currentCategory.toLowerCase()));
                const matchQuery = (!query || itemKeywords.includes(query));

                if (matchCat && matchQuery) {
                    item.classList.remove('d-none');
                    visibleCount++;
                } else {
                    item.classList.add('d-none');
                }
            });

            document.getElementById('totalRegulasiCount').innerText = visibleCount;
            const noResults = document.getElementById('noResultsState');
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }

        function resetFilter() {
            document.getElementById('regulasiSearchInput').value = '';
            setCategoryFilter('all', document.querySelector('.category-tab-btn'));
        }
    </script>
</body>
</html>
