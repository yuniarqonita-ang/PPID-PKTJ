<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block !important; 
                margin-top: 0; 
            } 
        }
        .dropdown-menu { z-index: 1050 !important; }
        
        .hero-section { 
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), url('https://via.placeholder.com/1920x600'); 
            background-size: cover; 
            color: white; 
            padding: 100px 0; 
            text-align: center; 
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
        
        .dokumen-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 74, 153, 0.1);
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }
        
        .dokumen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 74, 153, 0.2);
        }
        
        .dokumen-icon {
            font-size: 48px;
            color: #ffc107;
            margin: 20px 0;
        }
        
        .dokumen-title {
            color: #004a99;
            font-weight: bold;
            min-height: 60px;
            display: flex;
            align-items: center;
        }
        
        .dokumen-kategori {
            display: inline-block;
            background-color: #004a99;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .btn-action {
            padding: 8px 15px;
            margin: 5px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .btn-view {
            background-color: #004a99;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #003266;
            color: white;
        }
        
        .btn-download {
            background-color: #ffc107;
            color: #333;
        }
        
        .btn-download:hover {
            background-color: #e0a800;
            color: #333;
        }
        
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .pagination {
            margin-top: 30px;
            justify-content: center;
        }
        
        .pagination .page-link {
            color: #004a99;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #004a99;
            border-color: #004a99;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3">Dokumentasi PPID PKTJ</h1>
            <p class="lead">Pusat Informasi dan Dokumentasi Kementerian Perhubungan</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="page-title">Daftar Dokumen</h2>
            </div>
        </div>

        @if($dokumen->count() > 0)
            <div class="row g-4">
                @foreach($dokumen as $doc)
                    <div class="col-md-6 col-lg-4">
                        <div class="dokumen-card">
                            <div class="card-body text-center">
                                <div class="dokumen-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                
                                <div class="dokumen-kategori">
                                    {{ $doc->kategori ?? 'Umum' }}
                                </div>
                                
                                <h5 class="dokumen-title">{{ $doc->judul }}</h5>
                                
                                <small class="text-muted d-block mb-3">
                                    <i class="far fa-calendar"></i> 
                                    {{ $doc->created_at->format('d M Y') }}
                                </small>
                                
                                <div class="d-flex justify-content-center flex-wrap">
                                    <a href="{{ route('dokumen.view', $doc->id) }}" class="btn-action btn-view" target="_blank">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('dokumen.download', $doc->id) }}" class="btn-action btn-download">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $dokumen->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                <h5>Belum Ada Dokumen</h5>
                <p class="text-muted">Dokumentasi akan tersedia dalam waktu dekat.</p>
            </div>
        @endif
    </div>

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
