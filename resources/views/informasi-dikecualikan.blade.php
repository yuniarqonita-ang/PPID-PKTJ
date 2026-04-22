<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dikecualikan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
            --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
        }
        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8faff;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(rgba(30, 41, 59, 0.8), rgba(30, 41, 59, 0.8)), 
                        url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
        }
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }
        .section-title {
            color: #1e293b;
            font-weight: 800;
            margin-bottom: 25px;
            border-left: 5px solid var(--secondary-gold);
            padding-left: 15px;
        }
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0.9;
        }
        .info-icon {
            width: 50px;
            height: 50px;
            background: #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 20px;
            margin-right: 20px;
        }
        .badge-locked {
            background: #64748b;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold uppercase">{{ $settings['informasi_dikecualikan_judul_hero'] ?? 'Informasi Dikecualikan' }}</h1>
            <p class="lead opacity-75">{{ $settings['informasi_dikecualikan_tagline_hero'] ?? 'Informasi yang tidak dapat dibuka untuk umum berdasarkan pengujian konsekuensi' }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="section-title">{{ $settings['informasi_dikecualikan_judul_daftar'] ?? 'Daftar Informasi Dikecualikan' }}</h2>
            <p class="text-muted mb-5">{{ $settings['informasi_dikecualikan_deskripsi_daftar'] ?? 'Berikut adalah daftar informasi yang dikategorikan sebagai rahasia/dikecualikan sesuai peraturan perundang-undangan.' }}</p>

            @if(count($informasi) > 0)
                <div class="row">
                    @foreach($informasi as $item)
                        <div class="col-12">
                            <div class="info-card">
                                <div class="d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-muted">{{ $item->judul }}</h6>
                                        <p class="small text-muted mb-0">{{ $item->deskripsi ?? 'Informasi Rahasia' }}</p>
                                        <small class="text-secondary">{{ \Carbon\Carbon::parse($item->created_at)->format('Y') }}</small>
                                    </div>
                                </div>
                                <div class="badge-locked">
                                    <i class="fas fa-shield-alt me-2"></i>DIKECUALIKAN
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada data informasi dikecualikan yang dipublikasikan.</p>
                </div>
            @endif

            <div class="alert alert-warning mt-5 rounded-4 p-4 border-0 shadow-sm">
                <h5 class="fw-bold"><i class="fas fa-info-circle me-2"></i>Catatan Penting</h5>
                <p class="mb-0">Informasi yang dikategorikan sebagai "Dikecualikan" telah melalui proses Pengujian Konsekuensi sesuai dengan Pasal 17 UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</p>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>
