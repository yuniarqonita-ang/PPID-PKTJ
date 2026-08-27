<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Berkala - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        /* Modern Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.95) 0%, rgba(0, 74, 153, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 130px 0 140px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(to top, rgba(248, 250, 252, 1), transparent);
            pointer-events: none;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 50px 55px;
            border-radius: 36px;
            box-shadow: 0 25px 60px rgba(0, 43, 92, 0.09), 0 4px 16px rgba(0,0,0,0.02);
            margin-top: -70px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 40px;
            border-left: 8px solid var(--secondary-gold);
            padding-left: 25px;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }

        .info-item {
            background: #ffffff;
            border-radius: 26px;
            padding: 32px 36px;
            margin-bottom: 28px;
            border: 1.5px solid #e2e8f0;
            border-left: 6px solid #004a99;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.04);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-item:hover {
            transform: translateY(-6px);
            background: #ffffff;
            border-color: #004a99;
            border-left: 6px solid var(--secondary-gold);
            box-shadow: 0 20px 45px rgba(0, 74, 153, 0.12);
        }

        .info-icon {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, rgba(0, 74, 153, 0.1) 0%, rgba(0, 74, 153, 0.04) 100%);
            color: var(--primary-blue);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
            border: 1px solid rgba(0, 74, 153, 0.15);
        }

        .btn-download-premium {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white;
            padding: 11px 22px;
            border-radius: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.92rem;
            box-shadow: 0 4px 14px rgba(0, 74, 153, 0.2);
            border: none;
        }

        .btn-download-premium:hover {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(217, 119, 6, 0.3);
        }

        .rich-content {
            color: #334155;
            font-size: 1.02rem;
            line-height: 1.8;
        }

        .rich-content p {
            margin-bottom: 14px;
            line-height: 1.8;
            color: #334155;
        }

        .rich-content p:last-child {
            margin-bottom: 0;
        }

        .rich-content p:empty,
        .rich-content p > br:only-child {
            min-height: 1.5em;
            display: block;
            margin-bottom: 14px;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-3 fw-black outfit uppercase">Informasi Berkala</h1>
            <p class="lead opacity-75 mb-0">Akses daftar informasi publik yang disediakan secara rutin oleh PPID PKTJ.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @include('components.konten-dinamis', ['prefix' => 'informasi_berkala'])

            <!-- SECTION PROFIL PEJABAT PUBLIK & LHKPN (STANDAR PPID KEMENHUB SLIDE 25) -->
            @if(isset($pejabats) && $pejabats->count() > 0)
            <style>
                .pejabat-table-photo {
                    width: 155px !important;
                    height: 230px !important;
                    object-fit: cover !important;
                    object-position: top center !important;
                    border-radius: 14px !important;
                    box-shadow: 0 6px 18px rgba(0, 43, 92, 0.12) !important;
                    border: 2.5px solid #ffffff !important;
                    outline: 1.5px solid #cbd5e1 !important;
                    cursor: pointer !important;
                    transition: transform 0.35s ease, box-shadow 0.35s ease !important;
                }
                .pejabat-table-photo:hover {
                    transform: scale(1.04);
                    box-shadow: 0 10px 25px rgba(0, 74, 153, 0.22) !important;
                    outline-color: #004a99 !important;
                }
                .pejabat-card-pro {
                    background: #ffffff;
                    border: 1.5px solid #e2e8f0;
                    border-radius: 24px;
                    overflow: hidden;
                    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
                    display: flex;
                    flex-direction: column;
                    height: 100%;
                }
                .pejabat-card-pro:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 22px 40px rgba(0, 74, 153, 0.14);
                    border-color: #004a99;
                }
                .pejabat-card-img-wrapper {
                    height: 390px;
                    background: linear-gradient(180deg, #f1f5f9 0%, #e2e8f0 100%);
                    position: relative;
                    overflow: hidden;
                }
                .pejabat-card-img-wrapper img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: top center;
                    transition: transform 0.5s ease;
                }
                .pejabat-card-pro:hover .pejabat-card-img-wrapper img {
                    transform: scale(1.04);
                }
                .pejabat-card-overlay {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    height: 100px;
                    background: linear-gradient(to top, rgba(0, 43, 92, 0.9) 0%, transparent 100%);
                    display: flex;
                    align-items: flex-end;
                    padding: 18px;
                }
                .view-animate {
                    animation: viewFadeIn 0.35s ease;
                }
                @keyframes viewFadeIn {
                    from { opacity: 0; transform: translateY(8px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>

            <div class="my-5 p-4 p-md-5 rounded-4 border shadow-sm" style="background: #ffffff; border-color: #cbd5e1;">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                    <div>
                        <div class="badge bg-warning text-dark font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <i class="fas fa-certificate me-1"></i> Standar PPID Kemenhub: Slide 25
                        </div>
                        <h3 class="fw-bold outfit mb-1" style="color: #004a99; font-size: 1.75rem;">
                            <i class="fas fa-user-tie me-2 text-primary"></i> Profil Pejabat Publik & LHKPN PKTJ
                        </h3>
                        <p class="text-muted small mb-0">Informasi profil, riwayat jabatan, riwayat pendidikan, dan laporan harta kekayaan jajaran Pimpinan PKTJ Tegal.</p>
                    </div>

                    <!-- VIEW SWITCHER (TABEL / KARTU) -->
                    <div class="btn-group p-1 bg-light rounded-pill border" role="group">
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 fw-bold" id="btnViewTable" onclick="switchPejabatView('table')">
                            <i class="fas fa-table me-1"></i> Mode Tabel
                        </button>
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 py-1.5 fw-bold text-muted" id="btnViewGrid" onclick="switchPejabatView('grid')">
                            <i class="fas fa-th-large me-1"></i> Mode Kartu
                        </button>
                    </div>
                </div>

                <!-- 1. TAMPILAN MODE TABEL RESMI (FOTO BESAR 4x6) -->
                <div id="pejabatTableView" class="table-responsive view-animate">
                    <table class="table table-bordered table-hover align-middle mb-0" style="border-color: #e2e8f0;">
                        <thead style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); color: white;">
                            <tr class="text-center align-middle" style="font-size: 12.5px; letter-spacing: 0.5px; text-transform: uppercase;">
                                <th style="width: 45px; padding: 16px 8px;">No</th>
                                <th style="width: 185px; padding: 16px 10px;">Pas Foto Resmi (4x6)</th>
                                <th style="width: 230px; padding: 16px 15px;" class="text-start">Nama & NIP</th>
                                <th style="width: 210px; padding: 16px 15px;" class="text-start">Jabatan</th>
                                <th style="min-width: 320px; padding: 16px 15px;" class="text-start">Biografi & Riwayat Karir</th>
                                <th style="width: 130px; padding: 16px 10px;">LHKPN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($pejabats as $pejabat)
                            <tr style="background: {{ $loop->even ? '#f8fafc' : '#ffffff' }}; font-size: 13.5px;">
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-center p-3">
                                    @if($pejabat->foto)
                                        <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" class="pejabat-table-photo mx-auto" onclick="window.open('{{ asset($pejabat->foto) }}', '_blank')" title="Klik untuk memperbesar foto">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border mx-auto" style="width: 155px; height: 230px;">
                                            <i class="fas fa-user-tie fa-4x text-muted opacity-40"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 14px; line-height: 1.4;">{{ $pejabat->nama }}</h6>
                                    <span class="badge bg-light text-secondary border font-mono px-2 py-1" style="font-size: 11.5px;">
                                        NIP: {{ $pejabat->nip ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="badge bg-primary text-wrap text-start lh-base px-2.5 py-1.5 rounded-2" style="background-color: #004a99 !important; font-size: 12px;">
                                        {{ $pejabat->jabatan }}
                                    </span>
                                </td>
                                <td class="p-3 text-secondary" style="line-height: 1.6;">
                                    @if($pejabat->biografi)
                                        <p class="mb-2 text-dark small" style="font-size: 13px;">{{ $pejabat->biografi }}</p>
                                    @endif

                                    @if(!empty($pejabat->pendidikan) && is_array($pejabat->pendidikan))
                                        <div class="mb-1.5">
                                            <strong class="text-primary d-block" style="font-size: 11.5px; text-transform: uppercase;">
                                                <i class="fas fa-graduation-cap me-1"></i> Riwayat Pendidikan:
                                            </strong>
                                            <ul class="mb-0 ps-3 small text-muted" style="font-size: 12px;">
                                                @foreach($pejabat->pendidikan as $pend)
                                                    <li>{{ $pend }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if(!empty($pejabat->riwayat_jabatan) && is_array($pejabat->riwayat_jabatan))
                                        <div class="mt-2">
                                            <strong class="text-primary d-block" style="font-size: 11.5px; text-transform: uppercase;">
                                                <i class="fas fa-briefcase me-1"></i> Riwayat Jabatan:
                                            </strong>
                                            <ul class="mb-0 ps-3 small text-muted" style="font-size: 12px;">
                                                @foreach(array_slice($pejabat->riwayat_jabatan, 0, 3) as $jab)
                                                    <li>{{ $jab }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center p-3">
                                    @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                        <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 py-1.5 fw-bold shadow-sm d-inline-flex align-items-center gap-1.5" style="font-size: 12px;">
                                            <i class="fas fa-file-invoice-dollar"></i> LHKPN
                                        </a>
                                        <div class="text-muted mt-1" style="font-size: 10.5px;">{{ $pejabat->lhkpn_tahun ?? '2025/2026' }}</div>
                                    @else
                                        <span class="badge bg-light text-muted border">Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- 2. TAMPILAN MODE GRID KARTU (SMOOTH & ELEGANT) -->
                <div id="pejabatGridView" class="row g-4 d-none view-animate">
                    @foreach($pejabats as $pejabat)
                        <div class="col-lg-4 col-md-6">
                            <div class="pejabat-card-pro">
                                <div class="pejabat-card-img-wrapper">
                                    @if($pejabat->foto)
                                        <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-user-tie fa-4x opacity-25"></i>
                                        </div>
                                    @endif
                                    <div class="pejabat-card-overlay">
                                        <span class="badge bg-warning text-dark font-black px-3 py-1 rounded-pill" style="font-size: 11px;">
                                            {{ $pejabat->jabatan }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                                    <div>
                                        <h5 class="fw-bold outfit text-dark mb-1" style="font-size: 1.15rem; line-height: 1.35;">{{ $pejabat->nama }}</h5>
                                        <p class="text-muted small mb-3">NIP: {{ $pejabat->nip ?? '-' }}</p>
                                        @if($pejabat->biografi)
                                            <p class="text-secondary small mb-4" style="font-size: 12.5px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $pejabat->biografi }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="pt-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPejabatBerkala{{ $pejabat->id }}">
                                            <i class="fas fa-id-card me-1"></i> Detail & Riwayat
                                        </button>
                                        @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                            <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 py-1.5 fw-bold shadow-sm">
                                                <i class="fas fa-file-invoice-dollar me-1"></i> LHKPN
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL PEJABAT -->
                        <div class="modal fade" id="modalPejabatBerkala{{ $pejabat->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden">
                                    <div class="modal-header text-white p-4" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($pejabat->foto)
                                                <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" class="rounded-3 border border-white shadow-sm" style="width: 65px; height: 80px; object-fit: cover; object-position: top center;">
                                            @endif
                                            <div>
                                                <h5 class="modal-title fw-bold outfit text-white mb-0">{{ $pejabat->nama }}</h5>
                                                <span class="badge bg-warning text-dark font-black mt-1">{{ $pejabat->jabatan }}</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 p-md-5">
                                        @if($pejabat->biografi)
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-quote-left me-2"></i>Biografi</h6>
                                            <p class="text-secondary" style="line-height: 1.7;">{{ $pejabat->biografi }}</p>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->pendidikan) && is_array($pejabat->pendidikan))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h6>
                                            <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                                @foreach($pejabat->pendidikan as $pend)
                                                    <li class="list-group-item small py-2.5"><i class="fas fa-check-circle text-success me-2"></i>{{ $pend }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->riwayat_jabatan) && is_array($pejabat->riwayat_jabatan))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-briefcase me-2"></i>Riwayat Jabatan</h6>
                                            <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                                @foreach($pejabat->riwayat_jabatan as $jab)
                                                    <li class="list-group-item small py-2.5"><i class="fas fa-chevron-right text-primary me-2"></i>{{ $jab }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->penghargaan) && is_array($pejabat->penghargaan))
                                        <div>
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-medal me-2"></i>Penghargaan</h6>
                                            <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                                                @foreach($pejabat->penghargaan as $peng)
                                                    <li class="list-group-item small py-2.5"><i class="fas fa-star text-warning me-2"></i>{{ $peng }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer bg-light p-3">
                                        @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                            <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn btn-success fw-bold px-4 py-2 rounded-pill small">
                                                <i class="fas fa-file-invoice-dollar me-2"></i> LHKPN ({{ $pejabat->lhkpn_tahun ?? '2025/2026' }})
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-secondary fw-bold px-4 py-2 rounded-pill small" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <script>
                function switchPejabatView(mode) {
                    const tableV = document.getElementById('pejabatTableView');
                    const gridV = document.getElementById('pejabatGridView');
                    const btnT = document.getElementById('btnViewTable');
                    const btnG = document.getElementById('btnViewGrid');

                    if (mode === 'table') {
                        tableV.classList.remove('d-none');
                        gridV.classList.add('d-none');
                        btnT.className = 'btn btn-sm btn-primary rounded-pill px-3 py-1.5 fw-bold';
                        btnG.className = 'btn btn-sm btn-light rounded-pill px-3 py-1.5 fw-bold text-muted';
                    } else {
                        tableV.classList.add('d-none');
                        gridV.classList.remove('d-none');
                        btnT.className = 'btn btn-sm btn-light rounded-pill px-3 py-1.5 fw-bold text-muted';
                        btnG.className = 'btn btn-sm btn-primary rounded-pill px-3 py-1.5 fw-bold';
                    }
                }
            </script>
            @endif

            <!-- DOKUMEN LAINNYA DI INFORMASI BERKALA -->
            <h3 class="fw-bold outfit text-dark mb-4" style="color: #004a99; font-size: 1.5rem;">
                <i class="fas fa-file-alt me-2 text-primary"></i> Dokumen & Laporan Informasi Berkala
            </h3>

            <div class="row mt-2">
                @forelse($items as $item)
                    <div class="col-12">
                        <div class="info-item hover-lift" data-aos="fade-up">
                            <div class="d-flex align-items-start flex-column flex-md-row gap-4">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="flex-grow-1 w-100" style="min-width: 0;">
                                    <h4 class="fw-bold outfit text-dark mb-3" style="font-size: 1.35rem; line-height: 1.4;">{{ $item->judul }}</h4>
                                    <div class="rich-content mb-4">
                                        {!! $item->deskripsi ?? 'Tidak ada deskripsi' !!}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-3">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill" style="font-size: 12px;">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->translatedFormat('d F Y') }}
                                            </span>
                                            @if($item->file_path && $item->file_path !== '#' && $item->file_path !== '' && isset($item->file_size) && $item->file_size !== '-' && $item->file_size !== '')
                                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill" style="font-size: 12px;">
                                                <i class="fas fa-file-pdf me-1 text-danger"></i> {{ $item->file_size }}
                                            </span>
                                            @endif
                                        </div>
                                        @if($item->file_path && $item->file_path !== '#' && $item->file_path !== '')
                                        <div class="d-flex gap-2 flex-wrap">
                                            @if(is_previewable($item->file_path))
                                            <button type="button" 
                                                    class="btn-download-premium" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#previewModal" 
                                                    data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? 1 : 0]) }}">
                                                <i class="fas fa-eye"></i> Lihat Dokumen
                                            </button>
                                            @endif
                                            @if($item->bisa_download)
                                            <a href="{{ route('download.file', ['model' => 'berkala', 'id' => $item->id]) }}" class="btn-download-premium" style="background: #198754; color: white;">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-4 opacity-25"></i>
                        <h3 class="text-muted outfit fw-bold">Data Belum Tersedia</h3>
                        <p class="text-muted">Belum ada data informasi berkala tersedia saat ini.</p>
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

