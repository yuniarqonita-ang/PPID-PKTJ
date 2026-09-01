<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Berkala - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <!-- TOP HERO QUICK SEARCH BAR -->
            <div class="p-4 mb-4 rounded-4 border shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-color: #cbd5e1;">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-8">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted ms-3" style="font-size: 16px;"></i>
                            <input type="text" id="topSearchInputBerkala" placeholder="Cari kata kunci, nama pejabat, jenis dokumen berkala..." onkeyup="filterBerkalaContent()" class="form-control form-control-lg ps-5 rounded-pill border-2 bg-white" style="font-size: 14.5px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end text-muted small">
                        <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-xs">
                            <i class="fas fa-list-check text-primary me-1"></i> Mode Penjelajahan Publik
                        </span>
                    </div>
                </div>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'informasi_berkala'])

            <!-- SECTION PROFIL PEJABAT PUBLIK & LHKPN (STANDAR PPID KEMENHUB SLIDE 25) -->
            @if(isset($pejabats) && $pejabats->count() > 0)
            @php
                $tblW = \App\Models\Dashboard::getValue('pejabat_foto_table_width', 155);
                $tblH = \App\Models\Dashboard::getValue('pejabat_foto_table_height', 230);
                $crdH = \App\Models\Dashboard::getValue('pejabat_foto_card_height', 390);
                $pos  = \App\Models\Dashboard::getValue('pejabat_foto_position', 'top center');
                $rad  = \App\Models\Dashboard::getValue('pejabat_foto_radius', '14px');
            @endphp
            <style>
                .pejabat-table-photo {
                    width: {{ $tblW }}px !important;
                    height: {{ $tblH }}px !important;
                    object-fit: cover !important;
                    object-position: {{ $pos }} !important;
                    border-radius: {{ $rad }} !important;
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
                    height: {{ $crdH }}px !important;
                    background: linear-gradient(180deg, #f1f5f9 0%, #e2e8f0 100%);
                    position: relative;
                    overflow: hidden;
                }
                .pejabat-card-img-wrapper img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: {{ $pos }} !important;
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
                        <p class="text-muted small mb-0">Informasi profil pimpinan struktural, riwayat karir, dan kepatuhan LHKPN jajaran Pimpinan PKTJ Tegal.</p>
                    </div>
                    <div>
                        <a href="{{ route('profil.pejabat') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold text-xs">
                            <i class="fas fa-external-link-alt me-1"></i> Buka Halaman Khusus Pejabat
                        </a>
                    </div>
                </div>

                <!-- GRID DAFTAR PEJABAT SESUAI FORMAT RESMI KEMENHUB -->
                <div class="row g-4">
                    @forelse($pejabats as $pejabat)
                    <div class="col-lg-6 col-12">
                        <div class="p-3 border rounded-3 h-100 bg-white shadow-xs" style="border-color: #e2e8f0;">
                            <!-- Header Jabatan & Nama -->
                            <div style="font-size: 12.5px; font-weight: 600; color: #64748b; margin-bottom: 2px;">{{ $pejabat->jabatan }}</div>
                            <div class="outfit" style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 14px;">{{ $pejabat->nama }}</div>
                            
                            <!-- Flex Body (Foto Kiri + Teks Kanan) -->
                            <div class="d-flex gap-3 align-items-start flex-column flex-sm-row">
                                <!-- Foto Resmi Pejabat -->
                                <div style="width: 175px; min-width: 175px; height: 250px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1; box-shadow: 0 4px 10px rgba(0,0,0,0.05); background: #f8fafc; flex-shrink: 0; cursor: pointer;" onclick="openPejabatLightbox('{{ asset($pejabat->foto) }}', '{{ addslashes($pejabat->nama) }}', '{{ addslashes($pejabat->jabatan) }}')" title="Klik untuk memperbesar foto">
                                    @if($pejabat->foto)
                                        <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" style="width: 100%; height: 100%; object-fit: cover; object-position: top center;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-user-tie fa-3x opacity-25"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informasi Detail Pejabat -->
                                <div style="font-size: 12.5px; line-height: 1.6; color: #334155;" class="flex-grow-1">
                                    @if($pejabat->biografi)
                                        <p class="mb-2">{{ $pejabat->biografi }}</p>
                                    @else
                                        <p class="mb-2">Alamat kantor Jl. Perintis Kemerdekaan No. 17 Kota Tegal, Jawa Tengah 52125. Telp: (0283) 351061.</p>
                                    @endif

                                    @if(!empty($pejabat->pendidikan) && is_array($pejabat->pendidikan))
                                        <p class="mb-2">
                                            <strong>Latar belakang pendidikan :</strong> 
                                            {{ implode(', ', $pejabat->pendidikan) }}.
                                        </p>
                                    @endif

                                    @if(!empty($pejabat->riwayat_jabatan) && is_array($pejabat->riwayat_jabatan))
                                        <p class="mb-2">
                                            <strong>Perjalanan karir :</strong> 
                                            pernah menduduki sejumlah posisi strategis diantaranya {{ implode(', ', $pejabat->riwayat_jabatan) }}.
                                        </p>
                                    @endif

                                    <div class="mt-2">
                                        <a href="{{ $pejabat->lhkpn_link ?? asset($pejabat->lhkpn_file ?? '#') }}" target="_blank" style="color: #0284c7; font-weight: 700; text-decoration: none;">
                                            LHKPN {{ $pejabat->nama }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4 text-muted">
                        Data pejabat sedang dimutakhirkan.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- LIGHTBOX MODAL UNTUK PAS FOTO BESAR (BISA DITUTUP DENGAN ESC ATAU KLIK LUAR) -->
            <div id="pejabatPhotoLightbox" class="lightbox-overlay" style="display: none;" onclick="if(event.target === this) closePejabatLightbox();">
                <div class="lightbox-container">
                    <button type="button" class="lightbox-close-btn" onclick="closePejabatLightbox()" title="Tutup Foto (Tekan ESC)">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="lightbox-content text-center">
                        <img id="lightboxImg" src="" alt="Pas Foto Pejabat" class="lightbox-image">
                        <div class="lightbox-caption">
                            <h4 id="lightboxName" class="fw-bold text-white mb-1" style="font-family: 'Outfit', sans-serif;"></h4>
                            <p id="lightboxJabatan" class="text-warning mb-0 small fw-bold"></p>
                            <div class="text-white-50 mt-2" style="font-size: 11.5px;">
                                <i class="fas fa-info-circle me-1"></i> Klik di luar foto atau tekan tombol <kbd style="background: rgba(255,255,255,0.25); padding: 2px 7px; border-radius: 5px; color: #fff;">ESC</kbd> untuk menutup
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
            .lightbox-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 15, 35, 0.93);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                z-index: 999999 !important;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                opacity: 0;
                transition: opacity 0.25s ease;
            }
            .lightbox-overlay.active {
                opacity: 1;
            }
            .lightbox-container {
                position: relative;
                max-width: 90vw;
                max-height: 92vh;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .lightbox-close-btn {
                position: absolute;
                top: -48px;
                right: 0;
                background: #ffc107;
                color: #002b5c;
                border: 2px solid #ffffff;
                width: 44px;
                height: 44px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                font-weight: 900;
                cursor: pointer;
                box-shadow: 0 4px 20px rgba(0,0,0,0.5);
                transition: all 0.2s ease;
                z-index: 1000000;
            }
            .lightbox-close-btn:hover {
                background: #ffffff;
                color: #dc2626;
                transform: scale(1.12);
            }
            .lightbox-image {
                max-width: 85vw;
                max-height: 72vh;
                border-radius: 18px;
                box-shadow: 0 25px 65px rgba(0,0,0,0.7);
                border: 4px solid #ffffff;
                object-fit: contain;
                background: #001f3f;
                animation: lightboxZoomIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            @keyframes lightboxZoomIn {
                from { transform: scale(0.88); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
            .lightbox-caption {
                margin-top: 15px;
                text-align: center;
            }
            </style>

            <script>
                function openPejabatLightbox(src, name, jabatan) {
                    if (!src) return;
                    const overlay = document.getElementById('pejabatPhotoLightbox');
                    const img = document.getElementById('lightboxImg');
                    const nameEl = document.getElementById('lightboxName');
                    const jabEl = document.getElementById('lightboxJabatan');

                    img.src = src;
                    nameEl.textContent = name || '';
                    jabEl.textContent = jabatan || '';

                    overlay.style.display = 'flex';
                    setTimeout(() => {
                        overlay.classList.add('active');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                }

                function closePejabatLightbox() {
                    const overlay = document.getElementById('pejabatPhotoLightbox');
                    if (!overlay) return;
                    overlay.classList.remove('active');
                    setTimeout(() => {
                        overlay.style.display = 'none';
                        document.body.style.overflow = '';
                    }, 250);
                }

                // Global keydown listener for ESC key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' || e.keyCode === 27) {
                        closePejabatLightbox();
                    }
                });

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

            <!-- SECTION DATA KEPEGAWAIAN (STANDAR AKIP KEMENHUB SLIDE 29) -->
            <div class="my-5 p-4 p-md-5 rounded-4 border shadow-sm" style="background: #ffffff; border-color: #cbd5e1;">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                    <div>
                        <div class="badge bg-primary text-white font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <i class="fas fa-users me-1"></i> Standar AKIP Kemenhub: Slide 29
                        </div>
                        <h3 class="fw-bold outfit mb-1" style="color: #004a99; font-size: 1.65rem;">
                            <i class="fas fa-chart-pie me-2 text-primary"></i> Statistik Data Kepegawaian PKTJ Tegal
                        </h3>
                        <p class="text-muted small mb-0">Informasi berkala profil sumber daya manusia, tingkat pendidikan, jenjang kepangkatan, dan sebaran gender pegawai PKTJ.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill font-mono small">
                        <i class="fas fa-user-check text-success me-1"></i> Total: <strong>142</strong> Pegawai Aktif
                    </span>
                </div>

                <div class="row g-4">
                    <!-- Chart 1: Jenjang Pendidikan -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-light rounded-4 border text-center h-100">
                            <h6 class="fw-bold text-dark small mb-3">Jenjang Pendidikan</h6>
                            <div style="height: 180px;">
                                <canvas id="chartPendidikan"></canvas>
                            </div>
                            <span class="text-muted text-[10px] mt-2 d-block">S3: 8, S2: 45, S1/D4: 64, D3: 15, SLTA: 10</span>
                        </div>
                    </div>

                    <!-- Chart 2: Golongan / Pangkat -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-light rounded-4 border text-center h-100">
                            <h6 class="fw-bold text-dark small mb-3">Golongan / Pangkat</h6>
                            <div style="height: 180px;">
                                <canvas id="chartGolongan"></canvas>
                            </div>
                            <span class="text-muted text-[10px] mt-2 d-block">Gol IV: 12, Gol III: 78, Gol II: 28, PPPK/Non: 24</span>
                        </div>
                    </div>

                    <!-- Chart 3: Komposisi Gender -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-light rounded-4 border text-center h-100">
                            <h6 class="fw-bold text-dark small mb-3">Komposisi Gender</h6>
                            <div style="height: 180px;">
                                <canvas id="chartGender"></canvas>
                            </div>
                            <span class="text-muted text-[10px] mt-2 d-block">Pria: 88 Pegawai • Wanita: 54 Pegawai</span>
                        </div>
                    </div>

                    <!-- Chart 4: Jenis Jabatan -->
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 bg-light rounded-4 border text-center h-100">
                            <h6 class="fw-bold text-dark small mb-3">Jenis Formasi Jabatan</h6>
                            <div style="height: 180px;">
                                <canvas id="chartJabatan"></canvas>
                            </div>
                            <span class="text-muted text-[10px] mt-2 d-block">Dosen: 48, Fungsional: 42, Umum: 32, Pengasuh: 20</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION TATA CARA PENGADUAN SP4N-LAPOR & WBS (STANDAR AKIP KEMENHUB SLIDE 49 & 30) -->
            <div class="my-5 p-4 p-md-5 rounded-4 border shadow-sm text-white" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); border-color: #002b5c;">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="badge bg-warning text-dark font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <i class="fas fa-shield-alt me-1"></i> Standar AKIP Kemenhub: Slide 49 & 30
                        </div>
                        <h3 class="fw-bold outfit text-white mb-2" style="font-size: 1.75rem;">
                            Kanal Pengaduan Resmi: SP4N-LAPOR! & Whistleblowing System (WBS)
                        </h3>
                        <p class="text-white-50 small mb-4" style="line-height: 1.6;">
                            Laporkan penyalahgunaan wewenang, pelanggaran kode etik, gratifikasi, atau keluhan pelayanan publik melalui kanal aduan nasional terintegrasi secara aman, rahasia, dan terverifikasi.
                        </p>
                        
                        <div class="d-flex flex-wrap gap-3">
                            <a href="https://www.lapor.go.id" target="_blank" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill shadow text-dark" style="font-size: 13px;">
                                <i class="fas fa-bullhorn me-1.5"></i> Buat Laporan di SP4N-LAPOR!
                            </a>
                            <a href="https://wbs.dephub.go.id" target="_blank" class="btn btn-outline-light fw-bold px-4 py-2.5 rounded-pill" style="font-size: 13px;">
                                <i class="fas fa-user-secret me-1.5"></i> Portal WBS Kemenhub
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="p-4 bg-white text-dark rounded-4 shadow-lg">
                            <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" alt="Logo SP4N LAPOR" class="img-fluid mb-3" style="max-height: 48px;" onerror="this.style.display='none'">
                            <h6 class="fw-bold text-danger mb-1" style="font-size: 14px;">Layanan Aspirasi & Pengaduan Online Rakyat</h6>
                            <p class="text-muted small mb-3" style="font-size: 11.5px;">Sampaikan aspirasi dan pengaduan Anda langsung kepada instansi berwenang.</p>
                            <div class="p-2.5 bg-light rounded-3 border text-start small font-mono" style="font-size: 11px;">
                                <div><i class="fas fa-sms text-primary me-1"></i> SMS: <strong>1708</strong> (Ketik pesan)</div>
                                <div><i class="fas fa-globe text-success me-1"></i> Web: <strong>www.lapor.go.id</strong></div>
                                <div><i class="fas fa-envelope-shield text-danger me-1"></i> SPI PKTJ: <strong>spi@pktj.ac.id</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DOKUMEN LAINNYA DI INFORMASI BERKALA -->
            <h3 class="fw-bold outfit text-dark mb-4" style="color: #004a99; font-size: 1.5rem;">
                <i class="fas fa-file-alt me-2 text-primary"></i> Dokumen & Laporan Informasi Berkala
            </h3>

            <div class="row mt-2" id="berkalaItemsContainer">
                @forelse($items as $item)
                    <div class="col-12 searchable-berkala-item" data-keywords="{{ strtolower($item->judul . ' ' . strip_tags($item->deskripsi)) }}">
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
    <script>
        AOS.init({duration: 800, once: true});

        function filterBerkalaContent() {
            const query = document.getElementById('topSearchInputBerkala').value.toLowerCase().trim();
            
            // Filter berkala items
            document.querySelectorAll('.searchable-berkala-item').forEach(el => {
                const kw = el.getAttribute('data-keywords') || '';
                if (!query || kw.includes(query)) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });

            // Filter pejabat rows in table view
            document.querySelectorAll('#pejabatTableBody tr').forEach(tr => {
                const text = tr.innerText.toLowerCase();
                if (!query || text.includes(query)) {
                    tr.style.display = '';
                } else {
                    tr.style.display = 'none';
                }
            });

            // Filter pejabat cards in grid view
            document.querySelectorAll('#pejabatGridView .col-md-6').forEach(card => {
                const text = card.innerText.toLowerCase();
                if (!query || text.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Pendidikan
            const ctxPend = document.getElementById('chartPendidikan');
            if (ctxPend) {
                new Chart(ctxPend, {
                    type: 'doughnut',
                    data: {
                        labels: ['S3', 'S2', 'S1/D4', 'D3', 'SLTA'],
                        datasets: [{
                            data: [8, 45, 64, 15, 10],
                            backgroundColor: ['#002b5c', '#004a99', '#38bdf8', '#fbbf24', '#94a3b8']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 9 } } } } }
                });
            }

            // Chart 2: Golongan
            const ctxGol = document.getElementById('chartGolongan');
            if (ctxGol) {
                new Chart(ctxGol, {
                    type: 'bar',
                    data: {
                        labels: ['Gol IV', 'Gol III', 'Gol II', 'PPPK/Non'],
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: [12, 78, 28, 24],
                            backgroundColor: ['#002b5c', '#004a99', '#38bdf8', '#fbbf24'],
                            borderRadius: 6
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                });
            }

            // Chart 3: Gender
            const ctxGen = document.getElementById('chartGender');
            if (ctxGen) {
                new Chart(ctxGen, {
                    type: 'pie',
                    data: {
                        labels: ['Pria (88)', 'Wanita (54)'],
                        datasets: [{
                            data: [88, 54],
                            backgroundColor: ['#004a99', '#ec4899']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 9 } } } } }
                });
            }

            // Chart 4: Jabatan
            const ctxJab = document.getElementById('chartJabatan');
            if (ctxJab) {
                new Chart(ctxJab, {
                    type: 'bar',
                    data: {
                        labels: ['Dosen', 'Fungsional', 'Umum', 'Pengasuh'],
                        datasets: [{
                            label: 'Pegawai',
                            data: [48, 42, 32, 20],
                            backgroundColor: '#10b981',
                            borderRadius: 6
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                });
            }
        });
    </script>
</body>
</html>

