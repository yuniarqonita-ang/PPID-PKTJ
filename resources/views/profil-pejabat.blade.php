<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pejabat Publik & LHKPN - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.95) 0%, rgba(0, 74, 153, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1521791136064-7986c29535a7?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 130px 0 140px;
            color: white;
            position: relative;
        }

        .content-card {
            background: white;
            padding: 50px 55px;
            border-radius: 36px;
            box-shadow: 0 25px 60px rgba(0, 43, 92, 0.09);
            margin-top: -70px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        .pejabat-card {
            background: #ffffff;
            border-radius: 28px;
            border: 1.5px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.04);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .pejabat-card:hover {
            transform: translateY(-8px);
            border-color: #004a99;
            box-shadow: 0 22px 50px rgba(0, 74, 153, 0.14);
        }

        .pejabat-img-wrapper {
            position: relative;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding-top: 110%;
            overflow: hidden;
        }

        .pejabat-img-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform 0.5s ease;
        }

        .pejabat-card:hover .pejabat-img-wrapper img {
            transform: scale(1.05);
        }

        .pejabat-badge-jabatan {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 0.75rem;
            padding: 6px 14px;
            border-radius: 10px;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-lhkpn {
            background: #ecfdf5;
            color: #047857;
            border: 1.5px solid #a7f3d0;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-lhkpn:hover {
            background: #10b981;
            color: white;
            border-color: #10b981;
            transform: translateY(-2px);
        }

        .btn-detail {
            background: #f8fafc;
            color: #004a99;
            border: 1.5px solid #cbd5e1;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail:hover {
            background: #004a99;
            color: white;
            border-color: #004a99;
            transform: translateY(-2px);
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-3 fw-black outfit uppercase">Profil Pejabat Publik & LHKPN</h1>
            <p class="lead opacity-75 mb-0">Informasi profil, riwayat jabatan, dan laporan harta kekayaan jajaran pimpinan PKTJ Tegal.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card" data-aos="fade-up">
            
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3 pb-3 border-bottom">
                <div>
                    <h2 class="fw-bold outfit text-dark mb-1" style="color: #004a99;">Jajaran Pimpinan & Pejabat PKTJ</h2>
                    <p class="text-muted small mb-0">Sesuai amanat UU KIP No. 14 Tahun 2008 & PerKI No. 1 Tahun 2021 (Informasi Berkala)</p>
                </div>
                <a href="{{ route('informasi.berkala') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold text-xs">
                    <i class="fas fa-arrow-left me-2"></i> Ke Informasi Berkala
                </a>
            </div>

            <div class="row g-4">
                @forelse($pejabats as $pejabat)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="pejabat-card">
                            <div class="pejabat-img-wrapper">
                                @if($pejabat->foto)
                                    <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="position: absolute; top:0; left:0;">
                                        <i class="fas fa-user-tie fa-4x opacity-25"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                                <div>
                                    <span class="pejabat-badge-jabatan mb-3">{{ $pejabat->jabatan }}</span>
                                    <h4 class="fw-bold outfit text-dark mb-1" style="font-size: 1.15rem; line-height: 1.4;">{{ $pejabat->nama }}</h4>
                                    <p class="text-muted small mb-3">NIP: {{ $pejabat->nip ?? '-' }}</p>
                                    
                                    @if($pejabat->biografi)
                                        <p class="text-secondary small mb-4" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $pejabat->biografi }}
                                        </p>
                                    @endif
                                </div>

                                <div class="pt-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <button type="button" class="btn-detail" data-bs-toggle="modal" data-bs-target="#modalPejabat{{ $pejabat->id }}">
                                        <i class="fas fa-id-card"></i> Biografi & Riwayat
                                    </button>

                                    @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                        <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn-lhkpn">
                                            <i class="fas fa-file-invoice-dollar"></i> LHKPN
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL DETAIL BIOGRAFI & RIWAYAT -->
                    <div class="modal fade" id="modalPejabat{{ $pejabat->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden">
                                <div class="modal-header bg-gradient text-white p-4" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($pejabat->foto)
                                            <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" class="rounded-circle border-2 border-white shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <h5 class="modal-title fw-bold outfit text-white mb-0">{{ $pejabat->nama }}</h5>
                                            <span class="badge bg-warning text-dark font-black mt-1">{{ $pejabat->jabatan }}</span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4 p-md-5 space-y-4">
                                    @if($pejabat->biografi)
                                    <div class="mb-4">
                                        <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-quote-left me-2"></i>Biografi & Profil</h6>
                                        <p class="text-slate-700 leading-relaxed">{{ $pejabat->biografi }}</p>
                                    </div>
                                    @endif

                                    @if(!empty($pejabat->pendidikan) && is_array($pejabat->pendidikan))
                                    <div class="mb-4">
                                        <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h6>
                                        <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                            @foreach($pejabat->pendidikan as $pend)
                                                <li class="list-group-item bg-light text-dark small py-2.5 px-3"><i class="fas fa-check-circle text-success me-2"></i>{{ $pend }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    @if(!empty($pejabat->riwayat_jabatan) && is_array($pejabat->riwayat_jabatan))
                                    <div class="mb-4">
                                        <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-briefcase me-2"></i>Riwayat Jabatan & Karir</h6>
                                        <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                            @foreach($pejabat->riwayat_jabatan as $jab)
                                                <li class="list-group-item bg-light text-dark small py-2.5 px-3"><i class="fas fa-chevron-right text-primary me-2"></i>{{ $jab }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    @if(!empty($pejabat->penghargaan) && is_array($pejabat->penghargaan))
                                    <div>
                                        <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-medal me-2"></i>Tanda Jasa & Penghargaan</h6>
                                        <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                            @foreach($pejabat->penghargaan as $peng)
                                                <li class="list-group-item bg-light text-dark small py-2.5 px-3"><i class="fas fa-star text-warning me-2"></i>{{ $peng }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer bg-light p-3">
                                    @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                        <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn btn-success fw-bold px-4 py-2 rounded-pill small">
                                            <i class="fas fa-file-invoice-dollar me-2"></i> Laporan LHKPN ({{ $pejabat->lhkpn_tahun ?? '2025/2026' }})
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-secondary fw-bold px-4 py-2 rounded-pill small" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Data pejabat belum tersedia.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
