<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Dokumen & Informasi: "{{ $q }}" - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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
            background-color: #f1f5f9; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-search-results {
            background: linear-gradient(135deg, rgba(0, 43, 92, 0.95) 0%, rgba(0, 74, 153, 0.90) 100%), 
                        url('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 85px 0 105px;
            color: white;
            position: relative;
        }

        .content-card-search {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 15px 45px rgba(0, 43, 92, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.9);
            margin-top: -50px;
            position: relative;
            z-index: 10;
            margin-bottom: 60px;
        }

        .search-big-input {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 20px 16px 52px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            background: #f8fafc;
            transition: all 0.25s ease;
        }

        .search-big-input:focus {
            outline: none;
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.12);
        }

        .result-item-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 22px 24px;
            transition: all 0.25s ease;
            margin-bottom: 16px;
        }

        .result-item-card:hover {
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 43, 92, 0.07);
        }

        .cat-pill {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .highlight-match {
            background-color: #fef08a;
            color: #854d0e;
            padding: 1px 4px;
            border-radius: 4px;
            font-weight: 700;
        }
    </style>
    @include('components.public-page-style')
</head>
<body>

    @include('navigation')

    <div class="hero-search-results">
        <div class="container text-center position-relative" style="z-index: 10;">
            <div class="badge bg-warning text-dark px-3 py-1.5 rounded-pill mb-3 font-monospace">
                <i class="fas fa-search me-1"></i> PENCARIAN DOKUMEN & INFORMASI
            </div>
            <h1 class="display-6 fw-bold outfit text-uppercase mb-2 tracking-tight">
                Hasil Pencarian: <span class="text-warning">"{{ $q }}"</span>
            </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 700px; font-size: 15px;">
                Ditemukan <strong>{{ $total }}</strong> dokumen & informasi yang cocok di seluruh pangkalan data PPID PKTJ.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="content-card-search">
            
            <!-- SEARCH BAR FORM -->
            <form action="{{ route('pencarian.public') }}" method="GET" class="mb-5">
                <div class="position-relative">
                    <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted fs-5" style="left: 20px;"></i>
                    <input type="text" name="q" value="{{ $q }}" class="search-big-input" placeholder="Cari nama dokumen, nomor SK, kata kunci hukum, DIPA, LHKPN, SOP...">
                </div>
            </form>

            <!-- CATEGORY FILTER CHIPS -->
            <div class="d-flex flex-wrap gap-2 mb-4 pb-3 border-bottom">
                <a href="{{ route('pencarian.public', ['q' => $q, 'kategori' => 'all']) }}" class="btn btn-sm rounded-pill px-3.5 py-1.5 fw-bold {{ $kategori === 'all' ? 'btn-dark' : 'btn-light border' }}">
                    Semua Kategori ({{ $total }})
                </a>
                <a href="{{ route('pencarian.public', ['q' => $q, 'kategori' => 'berkala']) }}" class="btn btn-sm rounded-pill px-3.5 py-1.5 fw-bold {{ $kategori === 'berkala' ? 'btn-primary' : 'btn-light border' }}">
                    <i class="fas fa-newspaper me-1"></i> Informasi Berkala
                </a>
                <a href="{{ route('pencarian.public', ['q' => $q, 'kategori' => 'setiapsaat']) }}" class="btn btn-sm rounded-pill px-3.5 py-1.5 fw-bold {{ $kategori === 'setiapsaat' ? 'btn-success' : 'btn-light border' }}">
                    <i class="fas fa-folder-open me-1"></i> Informasi Setiap Saat
                </a>
                <a href="{{ route('pencarian.public', ['q' => $q, 'kategori' => 'regulasi']) }}" class="btn btn-sm rounded-pill px-3.5 py-1.5 fw-bold {{ $kategori === 'regulasi' ? 'btn-warning text-dark' : 'btn-light border' }}">
                    <i class="fas fa-balance-scale me-1"></i> Regulasi
                </a>
                <a href="{{ route('pencarian.public', ['q' => $q, 'kategori' => 'disabilitas']) }}" class="btn btn-sm rounded-pill px-3.5 py-1.5 fw-bold {{ $kategori === 'disabilitas' ? 'btn-info text-dark' : 'btn-light border' }}">
                    <i class="fas fa-universal-access me-1"></i> Braille & Inklusi
                </a>
            </div>

            <!-- SEARCH RESULTS LIST -->
            @if(count($results) > 0)
                <div class="row g-3">
                    @foreach($results as $item)
                    <div class="col-12">
                        <div class="result-item-card">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-{{ $item['badge_color'] }} cat-pill">
                                        <i class="{{ $item['icon'] }} me-1"></i> {{ $item['category'] }}
                                    </span>
                                    <span class="badge bg-light text-dark border font-monospace" style="font-size: 11px;">
                                        Tahun {{ $item['year'] }}
                                    </span>
                                </div>
                                @if(!empty($item['download_url']))
                                    <a href="{{ $item['download_url'] }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 12px;">
                                        <i class="fas fa-download me-1"></i> Unduh File
                                    </a>
                                @endif
                            </div>

                            <h5 class="outfit fw-bold text-dark mb-2" style="font-size: 16px;">
                                <a href="{{ $item['url'] }}" class="text-decoration-none text-dark hover-primary" style="color: #002b5c;">
                                    {!! !empty($q) ? preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="highlight-match">$1</span>', e($item['title'])) : e($item['title']) !!}
                                </a>
                            </h5>

                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                {!! !empty($q) ? preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="highlight-match">$1</span>', e($item['desc'])) : e($item['desc']) !!}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted opacity-50 mb-3"></i>
                    <h5 class="outfit fw-bold text-dark">Dokumen Tidak Ditemukan</h5>
                    <p class="text-muted small mb-4">Tidak ada informasi yang sesuai dengan kata kunci "<strong>{{ $q }}</strong>". Silakan coba kata kunci lain seperti <em>DIPA, LHKPN, SOP, Braille, Pengadaan</em>.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
