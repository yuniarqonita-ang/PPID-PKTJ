<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['layanan_daftar_judul_hero'] ?? 'Daftar Informasi Publik' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
            --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8faff; 
            color: #1e293b;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

                /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }

        .search-container {
            max-width: 600px;
            margin: 30px auto 0;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 10px;
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            gap: 10px;
        }

        .search-input {
            background: transparent;
            border: none;
            color: white;
            padding: 10px 20px;
            width: 100%;
            font-weight: 600;
        }

        .search-input::placeholder { color: rgba(255,255,255,0.7); }
        .search-input:focus { outline: none; }

        .btn-search {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            border: none;
            padding: 10px 25px;
            border-radius: 18px;
            font-weight: 800;
            transition: all 0.3s ease;
        }

        .btn-search:hover { transform: scale(1.05); background: #fff; }

        .content-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 74, 153, 0.05);
            margin-top: -60px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            position: relative;
            z-index: 20;
            margin-bottom: 50px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 30px;
            border-left: 6px solid var(--secondary-gold);
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }

        .info-item {
            background: #f8fafc;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-item:hover {
            transform: translateX(10px);
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.05);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 20px;
        }

        .btn-download-premium {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            font-weight: 800;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-download-premium:hover {
            background: var(--primary-blue);
            color: white;
            transform: scale(1.05);
        }

        .filter-badge {
            padding: 8px 16px;
            border-radius: 50px;
            background: #f1f5f9;
            color: #64748b;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-right: 10px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-badge.active {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 74, 153, 0.2);
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-2">{{ $settings['layanan_daftar_judul_hero'] ?? 'Daftar Informasi Publik' }}</h1>
            <p class="lead opacity-75">{{ $settings['layanan_daftar_tagline_hero'] ?? 'Akses Transparan untuk Masyarakat' }}</p>
            
            <div class="search-container">
                <input type="text" class="search-input" id="infoSearch" placeholder="Cari regulasi, laporan, atau agenda...">
                <button class="btn-search"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <h2 class="section-title mb-0">Daftar Dokumen</h2>
                <div class="d-flex">
                    <div class="filter-badge active" onclick="filterList('all', this)">Semua</div>
                    <div class="filter-badge" onclick="filterList('berkala', this)">Berkala</div>
                    <div class="filter-badge" onclick="filterList('setiapsaat', this)">Setiap Saat</div>
                    <div class="filter-badge" onclick="filterList('sertamerta', this)">Serta Merta</div>
                </div>
            </div>

            <div id="infoListContainer">
                @include('components.konten-dinamis', ['prefix' => 'daftar_informasi'])
                
                @php
                    $allDocs = [];
                    if(isset($berkala)) foreach($berkala as $b) { $b->category = 'berkala'; $allDocs[] = $b; }
                    if(isset($setiapsaat)) foreach($setiapsaat as $s) { $s->category = 'setiapsaat'; $allDocs[] = $s; }
                    if(isset($sertamerta)) foreach($sertamerta as $sm) { $sm->category = 'sertamerta'; $allDocs[] = $sm; }
                    
                    // Sort by date
                    usort($allDocs, function($a, $b) {
                        return $b->created_at <=> $a->created_at;
                    });
                @endphp

                <div class="row g-4">
                    @forelse($allDocs as $doc)
                        <div class="col-12 info-document-item" data-category="{{ $doc->category }}">
                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="fas {{ $doc->category == 'berkala' ? 'fa-calendar-check' : ($doc->category == 'setiapsaat' ? 'fa-clock' : 'fa-bolt') }}"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold outfit mb-1">{{ $doc->judul }}</h5>
                                        <div class="d-flex gap-3">
                                            <small class="text-muted"><i class="fas fa-tag me-1"></i> {{ ucfirst($doc->category) }}</small>
                                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ $doc->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/'.$doc->file) }}" target="_blank" class="btn-download-premium">
                                    <i class="fas fa-download me-2"></i> Download
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-file-excel fa-4x text-muted mb-4"></i>
                            <h3 class="text-muted">Data Belum Tersedia</h3>
                            <p class="text-muted">Gunakan menu admin untuk mengelola daftar informasi publik.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterList(category, el) {
            // Update UI badges
            document.querySelectorAll('.filter-badge').forEach(b => b.classList.remove('active'));
            el.classList.add('active');

            // Filter items
            const items = document.querySelectorAll('.info-document-item');
            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Live Search
        document.getElementById('infoSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const items = document.querySelectorAll('.info-document-item');
            
            items.forEach(item => {
                const title = item.querySelector('h5').innerText.toLowerCase();
                if (title.includes(term)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
