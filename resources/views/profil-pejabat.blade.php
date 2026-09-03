<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pejabat Publik - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.96) 0%, rgba(0, 74, 153, 0.90) 100%), 
                        url('https://images.unsplash.com/photo-1521791136064-7986c29535a7?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 110px 0 130px;
            color: white;
            position: relative;
        }

        .content-card {
            background: white;
            padding: 45px 50px;
            border-radius: 32px;
            box-shadow: 0 20px 60px rgba(0, 43, 92, 0.08);
            margin-top: -65px;
            border: 1px solid rgba(226, 232, 240, 0.85);
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        @media (max-width: 768px) {
            .content-card { padding: 25px 18px; border-radius: 20px; }
        }

        /* KEMENHUB OFFICIAL PEJABAT CARD STYLE */
        .kemenhub-pejabat-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.03);
        }

        .kemenhub-pejabat-box:hover {
            border-color: #004a99;
            box-shadow: 0 12px 30px rgba(0, 74, 153, 0.10);
            transform: translateY(-3px);
        }

        .pejabat-role-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: capitalize;
        }

        .pejabat-name-title {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 18px;
            font-family: 'Outfit', sans-serif;
        }

        .pejabat-body-flex {
            display: flex;
            gap: 22px;
            align-items: flex-start;
            flex-grow: 1;
        }

        .pejabat-photo-container {
            width: 190px;
            min-width: 190px;
            height: 270px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            background: #f8fafc;
            flex-shrink: 0;
            cursor: pointer;
            position: relative;
        }

        .pejabat-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform 0.4s ease;
        }

        .pejabat-photo-container:hover img {
            transform: scale(1.04);
        }

        .pejabat-info-content {
            font-size: 13px;
            line-height: 1.65;
            color: #334155;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pejabat-info-text p {
            margin-bottom: 10px;
            color: #334155;
        }

        .pejabat-lhkpn-link {
            display: inline-block;
            color: #0284c7;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            margin-top: 10px;
            transition: all 0.2s ease;
        }

        .pejabat-lhkpn-link:hover {
            color: #0369a1;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .pejabat-body-flex {
                flex-direction: column;
                align-items: center;
                text-align: left;
            }
            .pejabat-photo-container {
                width: 100%;
                max-width: 220px;
                height: 300px;
            }
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-4 fw-black outfit uppercase">Profil Pejabat Publik</h1>
            <p class="lead opacity-75 mb-0">Informasi profil pimpinan struktural dan riwayat karir di lingkungan PKTJ Tegal.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card" data-aos="fade-up">
            
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold outfit text-dark mb-1" style="color: #004a99; font-size: 24px;">Jajaran Pimpinan & Pejabat PKTJ Tegal</h2>
                    <p class="text-muted small mb-0">Dipublikasikan sesuai standar format resmi Kementerian Perhubungan RI & UU KIP No. 14 Tahun 2008</p>
                </div>
                <div>
                    <a href="{{ route('informasi.berkala') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold text-xs">
                        <i class="fas fa-arrow-left me-2"></i> Ke Informasi Berkala
                    </a>
                </div>
            </div>

            <!-- GRID DAFTAR PEJABAT SESUAI FORMAT RESMI KEMENHUB -->
            <div class="row g-4">
                @forelse($pejabats as $pejabat)
                <div class="col-lg-6 col-12" id="pejabat-{{ $pejabat->id }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="kemenhub-pejabat-box">
                        
                        <!-- Header Jabatan & Nama -->
                        <div class="pejabat-role-label">{{ $pejabat->jabatan }}</div>
                        <div class="pejabat-name-title">{{ $pejabat->nama }}</div>
                        
                        <!-- Flex Body (Foto Kiri + Teks Kanan) -->
                        <div class="pejabat-body-flex">
                            
                            <!-- Foto Resmi Pejabat -->
                            <div class="pejabat-photo-container" onclick="openPejabatLightbox('{{ asset($pejabat->foto) }}', '{{ addslashes($pejabat->nama) }}', '{{ addslashes($pejabat->jabatan) }}')" title="Klik untuk memperbesar foto">
                                @if($pejabat->foto)
                                    <img src="{{ asset($pejabat->foto) }}" alt="{{ $pejabat->nama }}" onerror="if(this.src.indexOf('Prima')!==-1){this.src='{{ asset('images/pejabat/Prima Anna Maria.png') }}';}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-user-tie fa-4x opacity-25"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Informasi Detail Pejabat (Alamat, Pendidikan, Karir, LHKPN) -->
                            <div class="pejabat-info-content">
                                <div class="pejabat-info-text text-justify" style="text-align: justify;">
                                    
                                    <p class="mb-2">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                        <strong>Alamat kantor:</strong> Kampus I Jl. Perintis Kemerdekaan No. 17 / Kampus II Jl. Abdul Syukur No. 17, Kota Tegal. Telp: (0283) 351061.
                                        @if(!empty($pejabat->tempat_tanggal_lahir))
                                            Lahir di {{ $pejabat->tempat_tanggal_lahir }}.
                                        @endif
                                    </p>

                                    @if($pejabat->biografi)
                                        <p class="mb-2">{{ $pejabat->biografi }}</p>
                                    @endif

                                    @if(!empty($pejabat->pendidikan))
                                        <p class="mb-2">
                                            <strong>Riwayat Pendidikan:</strong> 
                                            {{ is_array($pejabat->pendidikan) ? implode(', ', $pejabat->pendidikan) : $pejabat->pendidikan }}.
                                        </p>
                                    @endif

                                    @if(!empty($pejabat->riwayat_jabatan))
                                        <p class="mb-2">
                                            <strong>Riwayat Jabatan & Karir:</strong> 
                                            pernah menduduki sejumlah posisi diantaranya {{ is_array($pejabat->riwayat_jabatan) ? implode(', ', $pejabat->riwayat_jabatan) : $pejabat->riwayat_jabatan }}.
                                        </p>
                                    @endif

                                    @if(!empty($pejabat->penghargaan))
                                        <p class="mb-2">
                                            <strong>Tanda Jasa / Penghargaan:</strong> 
                                            {{ is_array($pejabat->penghargaan) ? implode(', ', $pejabat->penghargaan) : $pejabat->penghargaan }}.
                                        </p>
                                    @endif
                                </div>

                                <!-- Bagian LHKPN Resmi (Tanpa Link Zonk) -->
                                <div class="mt-3 pt-3 border-top">
                                    <div class="text-muted fw-bold text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                                        <i class="fas fa-file-invoice-dollar me-1 text-primary"></i> Laporan Harta Kekayaan Penyelenggara Negara (LHKPN)
                                    </div>
                                    @php
                                        $lhkpnLink = null;
                                        if (!empty($pejabat->lhkpn_file) && has_valid_document($pejabat->lhkpn_file)) {
                                            $lhkpnLink = asset($pejabat->lhkpn_file);
                                        } elseif (!empty($pejabat->lhkpn_link) && filter_var($pejabat->lhkpn_link, FILTER_VALIDATE_URL) && $pejabat->lhkpn_link !== 'https://elhkpn.kpk.go.id/') {
                                            $lhkpnLink = $pejabat->lhkpn_link;
                                        }
                                    @endphp
                                    @if($lhkpnLink)
                                        <a href="{{ $lhkpnLink }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1.5 fw-bold" style="font-size: 11.5px;">
                                            <i class="fas fa-file-pdf me-1"></i> LIHAT DOKUMEN LHKPN RESMI
                                        </a>
                                    @else
                                        <span class="badge bg-light text-muted border px-2.5 py-1.5 rounded-pill" style="font-size: 11px;">
                                            <i class="fas fa-clock me-1 text-warning"></i> Dokumen LHKPN dalam proses verifikasi KPK / Pemutakhiran
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">
                    <p>Data pejabat sedang dalam pemutakhiran berkala.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- LIGHTBOX MODAL UNTUK PREVIEW FOTO PEJABAT BESAR -->
    <div class="modal fade" id="pejabatPhotoLightbox" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
            <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden bg-dark text-white">
                <div class="modal-header border-0 pb-0 pe-3 pt-3">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4 pt-1">
                    <img id="lightboxImg" src="" alt="Foto Pejabat" class="img-fluid rounded-3 shadow mb-3" style="max-height: 70vh; object-fit: contain; border: 2px solid rgba(255,255,255,0.2);">
                    <h5 id="lightboxName" class="fw-bold outfit text-white mb-1"></h5>
                    <p id="lightboxRole" class="text-warning small mb-0 fw-semibold"></p>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, once: true });

        function openPejabatLightbox(imgUrl, name, role) {
            document.getElementById('lightboxImg').src = imgUrl;
            document.getElementById('lightboxName').textContent = name;
            document.getElementById('lightboxRole').textContent = role;
            new bootstrap.Modal(document.getElementById('pejabatPhotoLightbox')).show();
        }
    </script>
</body>
</html>
