<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Serta Merta - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
            background: linear-gradient(rgba(153, 0, 0, 0.8), rgba(153, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1579546673336-0ca77063065b?q=80&w=2070');
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
            color: #990000;
            font-weight: 800;
            margin-bottom: 25px;
            border-left: 5px solid var(--secondary-gold);
            padding-left: 15px;
        }
        .info-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .info-card:hover {
            transform: translateX(10px);
            border-color: #990000;
            box-shadow: 0 5px 15px rgba(153, 0, 0, 0.1);
        }
        .info-icon {
            width: 50px;
            height: 50px;
            background: #fff5f5;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #990000;
            font-size: 20px;
            margin-right: 20px;
        }
        .btn-download {
            background: #990000;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-download:hover { background: #660000; color: white; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold uppercase">Informasi Serta Merta</h1>
            <p class="lead opacity-75">Informasi yang berkaitan dengan hajat hidup orang banyak</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            <h2 class="section-title">Daftar Informasi Serta Merta</h2>
            <p class="text-muted mb-5">Informasi terkait situasi darurat, bencana, atau kebijakan yang berdampak luas.</p>

            @if(count($informasi) > 0)
                <div class="row">
                    @foreach($informasi as $item)
                        <div class="col-12">
                            <div class="info-card">
                                <div class="d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                                        <p class="small text-muted mb-0">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                        <small class="text-danger fw-bold">{{ $item->file_size ?? '' }} | {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('download.file', ['model' => 'sertamerta', 'id' => $item->id]) }}" class="btn-download">
                                    <i class="fas fa-download me-2"></i>Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <p class="text-muted">Saat ini tidak ada informasi serta merta yang perlu diumumkan.</p>
                </div>
            @endif
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
