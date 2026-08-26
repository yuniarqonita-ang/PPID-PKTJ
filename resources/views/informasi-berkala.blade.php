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
            <div class="my-5 p-4 p-md-5 rounded-4 border" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); border-color: #e2e8f0;">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                    <div>
                        <div class="badge bg-warning text-dark font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase">Slide 25 Sosialisasi Kemenhub</div>
                        <h3 class="fw-bold outfit mb-1" style="color: #004a99; font-size: 1.6rem;">
                            <i class="fas fa-user-tie me-2 text-warning"></i> Profil Pejabat Publik & LHKPN
                        </h3>
                        <p class="text-muted small mb-0">Laporan Profil Pimpinan, Riwayat Jabatan, & Laporan Harta Kekayaan Pejabat Negara (LHKPN)</p>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach($pejabats as $pejabat)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border rounded-4 shadow-sm overflow-hidden hover-lift" style="background: #ffffff;">
                                <div style="height: 240px; background: #f1f5f9; overflow: hidden; position: relative;">
                                    @if($pejabat->foto)
                                        <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" style="width: 100%; height: 100%; object-fit: cover; object-position: top center;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-user-tie fa-3x opacity-25"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="badge bg-primary text-uppercase small mb-2 text-wrap text-start" style="font-size: 0.75rem; background-color: #004a99 !important;">
                                            {{ $pejabat->jabatan }}
                                        </span>
                                        <h5 class="fw-bold outfit text-dark mb-1" style="font-size: 1.1rem;">{{ $pejabat->nama }}</h5>
                                        <p class="text-muted small mb-3">NIP: {{ $pejabat->nip ?? '-' }}</p>
                                    </div>
                                    <div class="pt-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPejabatBerkala{{ $pejabat->id }}">
                                            <i class="fas fa-id-card me-1"></i> Detail
                                        </button>
                                        @if($pejabat->lhkpn_link || $pejabat->lhkpn_file)
                                            <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
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
                                                <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" class="rounded-circle border border-white" style="width: 50px; height: 50px; object-fit: cover;">
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
                                            <p class="text-secondary">{{ $pejabat->biografi }}</p>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->pendidikan) && is_array($pejabat->pendidikan))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h6>
                                            <ul class="list-group list-group-flush border rounded-3">
                                                @foreach($pejabat->pendidikan as $pend)
                                                    <li class="list-group-item small py-2"><i class="fas fa-check text-success me-2"></i>{{ $pend }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->riwayat_jabatan) && is_array($pejabat->riwayat_jabatan))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-briefcase me-2"></i>Riwayat Jabatan</h6>
                                            <ul class="list-group list-group-flush border rounded-3">
                                                @foreach($pejabat->riwayat_jabatan as $jab)
                                                    <li class="list-group-item small py-2"><i class="fas fa-chevron-right text-primary me-2"></i>{{ $jab }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(!empty($pejabat->penghargaan) && is_array($pejabat->penghargaan))
                                        <div>
                                            <h6 class="fw-bold text-primary text-uppercase tracking-wider small mb-2"><i class="fas fa-medal me-2"></i>Penghargaan</h6>
                                            <ul class="list-group list-group-flush border rounded-3">
                                                @foreach($pejabat->penghargaan as $peng)
                                                    <li class="list-group-item small py-2"><i class="fas fa-star text-warning me-2"></i>{{ $peng }}</li>
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

