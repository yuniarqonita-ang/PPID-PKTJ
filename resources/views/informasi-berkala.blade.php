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

        .rich-content table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 16px 0 !important;
            background: #ffffff !important;
        }
        .rich-content th, .rich-content td {
            border: 1px solid #cbd5e1 !important;
            padding: 10px 14px !important;
            vertical-align: middle !important;
        }
        .rich-content th {
            background-color: #004a99 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
        }
        .rich-content a {
            color: #004a99 !important;
            text-decoration: underline !important;
            font-weight: 600 !important;
        }
        .rich-content a.btn {
            text-decoration: none !important;
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

    <div class="container-fluid px-3 px-md-5">
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

            <!-- ATM POLTRADA BALI: TABEL DAFTAR INFORMASI PUBLIK (DIP) BERKALA -->
            <div class="my-5 p-4 p-md-5 rounded-4 border shadow-sm bg-white" style="border-color: #cbd5e1;" data-aos="fade-up">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                    <div>
                        <div class="badge bg-primary text-white font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <i class="fas fa-table me-1"></i> Standar DIP Berkala Kemenhub & Poltrada
                        </div>
                        <h3 class="fw-bold outfit mb-1" style="color: #004a99; font-size: 1.65rem;">
                            Tabel Daftar Informasi Publik (DIP) Berkala
                        </h3>
                        <p class="text-muted small mb-0">Format master tabel informasi berkala yang dikuasai dan dipublikasikan resmi oleh PPID Pelaksana PKTJ Tegal.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="btnModeTable" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold" onclick="switchBerkalaDisplay('table')">
                            <i class="fas fa-table-list me-1"></i> Tampilan Tabel DIP
                        </button>
                        <button type="button" id="btnModeCards" class="btn btn-outline-secondary btn-sm rounded-pill px-4 py-2 fw-bold" onclick="switchBerkalaDisplay('cards')">
                            <i class="fas fa-th-large me-1"></i> Tampilan Kartu
                        </button>
                    </div>
                </div>

                <!-- 1. TABEL VIEW (STANDAR RESMI POLTRADA & KEMENHUB - 9 KOLOM) -->
                <div id="berkalaTableView" class="table-responsive rounded-3 border mb-4" style="border-color: #e2e8f0;">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                        <thead style="background: #002b5c; color: white;">
                            <tr>
                                <th class="text-center py-3 px-2" style="width: 50px;">No</th>
                                <th class="py-3 px-3" style="min-width: 180px;">Informasi</th>
                                <th class="py-3 px-3" style="min-width: 250px;">Ringkasan Informasi</th>
                                <th class="py-3 px-3" style="min-width: 160px;">Pejabat yang Menguasai Informasi</th>
                                <th class="py-3 px-3" style="min-width: 150px;">Penerbit Informasi</th>
                                <th class="py-3 px-2 text-center" style="min-width: 130px;">Bentuk Informasi</th>
                                <th class="py-3 px-3 text-center" style="min-width: 140px;">Waktu & Tempat Pembuatan</th>
                                <th class="py-3 px-2 text-center" style="min-width: 110px;">Retensi Arsip</th>
                                <th class="py-3 px-3 text-center" style="min-width: 130px;">Tautan</th>
                            </tr>
                        </thead>
                                                                        <tbody>
                            <!-- KELOMPOK: PROFIL KELEMBAGAAN & PEJABAT -->
                            <tr class="table-light fw-bold">
                                <td colspan="9" class="py-2 px-3 text-uppercase" style="background: #e0f2fe; color: #004a99; font-size: 12px; letter-spacing: 0.5px;">
                                    <i class="fas fa-university me-2"></i> PROFIL & KELEMBAGAAN
                                </td>
                            </tr>
                            <tr class="searchable-berkala-row" data-keywords="profil pktj tegal gambaran umum tugas fungsi kedudukan alamat kontak">
                                <td class="text-center fw-bold">1</td>
                                <td><strong class="text-dark">Profil PKTJ Tegal</strong></td>
                                <td class="text-muted">Informasi mengenai kedudukan, alamat kampus I & II, kontak resmi, gambaran umum, tugas dan fungsi, serta visi-misi PKTJ Tegal.</td>
                                <td>PPID Pelaksana UPT PKTJ Tegal</td>
                                <td>Bagian Keuangan dan Umum</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">Hardcopy & Softcopy</span></td>
                                <td class="text-center">Tegal, 2025</td>
                                <td class="text-center">1 Tahun</td>
                                <td class="text-center">
                                    <a href="{{ route('profil.ppid') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                        Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="searchable-berkala-row" data-keywords="struktur organisasi ppid pktj bagian unit pelaksana struktural">
                                <td class="text-center fw-bold">2</td>
                                <td><strong class="text-dark">Struktur Organisasi PKTJ Tegal</strong></td>
                                <td class="text-muted">Bagan struktur pejabat pimpinan, unit kerja struktural/fungsional, dan susunan PPID Pelaksana PKTJ.</td>
                                <td>PPID Pelaksana UPT PKTJ Tegal</td>
                                <td>Bagian Keuangan dan Umum</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">Hardcopy & Softcopy</span></td>
                                <td class="text-center">Tegal, 2025</td>
                                <td class="text-center">1 Tahun</td>
                                <td class="text-center">
                                    <a href="{{ route('profil.struktur-organisasi') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                        Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="searchable-berkala-row" data-keywords="profil singkat pejabat pktj pimpinan direktur wakil biografi riwayat jabatan">
                                <td class="text-center fw-bold">3</td>
                                <td><strong class="text-dark">Profil Singkat Pejabat PKTJ Tegal</strong></td>
                                <td class="text-muted">Data diri pimpinan pejabat struktural, riwayat pendidikan, rekam jejak karir, serta tugas dan wewenang jajaran pimpinan.</td>
                                <td>PPID Pelaksana UPT PKTJ Tegal</td>
                                <td>Bagian Keuangan dan Umum</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">Softcopy</span></td>
                                <td class="text-center">Tegal, 2025</td>
                                <td class="text-center">1 Tahun</td>
                                <td class="text-center">
                                    <a href="{{ route('profil.pejabat') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                        Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="searchable-berkala-row" data-keywords="lhkpn laporan harta kekayaan pejabat negara kpk kepatuhan pejabat pimpinan">
                                <td class="text-center fw-bold">4</td>
                                <td><strong class="text-dark">Laporan Harta Kekayaan Pejabat Negara (LHKPN)</strong></td>
                                <td class="text-muted">Laporan LHKPN pimpinan yang telah diverifikasi dan diumumkan oleh Komisi Pemberantasan Korupsi (KPK RI).</td>
                                <td>PPID Pelaksana UPT PKTJ Tegal</td>
                                <td>Bagian Keuangan dan Umum</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">Hardcopy & Softcopy</span></td>
                                <td class="text-center">Tegal, 2025</td>
                                <td class="text-center">1 Tahun</td>
                                <td class="text-center">
                                    <a href="{{ route('profil.pejabat') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                        Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- KELOMPOK: PROGRAM, KINERJA & DOKUMEN BERKALA -->
                            @if(isset($items) && $items->count() > 0)
                            <tr class="table-light fw-bold">
                                <td colspan="9" class="py-2 px-3 text-uppercase" style="background: #e0f2fe; color: #004a99; font-size: 12px; letter-spacing: 0.5px;">
                                    <i class="fas fa-folder-open me-2"></i> PROGRAM, KINERJA & ARSIP BERKALA
                                </td>
                            </tr>
                            @foreach($items as $idx => $it)
                            @php
                                $rowNo = $idx + 5;
                                $cleanDesc = Str::limit(strip_tags($it->deskripsi ?? ''), 130);
                                if (empty($cleanDesc) || $cleanDesc === 'Tidak ada deskripsi') {
                                    $cleanDesc = 'Dokumen berkala keterbukaan informasi publik resmi Politeknik Keselamatan Transportasi Jalan Tegal.';
                                }
                                $tahun = \Carbon\Carbon::parse($it->tanggal ?? $it->created_at)->format('Y');
                            @endphp
                            <tr class="searchable-berkala-row" data-keywords="{{ strtolower($it->judul . ' ' . $cleanDesc) }}">
                                <td class="text-center fw-bold">{{ $rowNo }}</td>
                                <td><strong class="text-dark">{{ $it->judul }}</strong></td>
                                <td class="text-muted small">{{ $cleanDesc }}</td>
                                <td>{{ $it->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal' }}</td>
                                <td>{{ $it->penanggung_jawab ?? $it->penerbit_informasi ?? 'Bagian Keuangan dan Umum' }}</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $it->bentuk_informasi ?? 'Softcopy' }}</span></td>
                                <td class="text-center">{{ $it->tempat_pembuatan ?? 'Tegal' }}, {{ $it->waktu_pembuatan ?? $tahun }}</td>
                                <td class="text-center">{{ $it->jangka_waktu ?? '1 Tahun' }}</td>
                                <td class="text-center">
                                    @if(has_valid_document($it->file_path))
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" 
                                                style="font-size: 11.5px;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#previewModal" 
                                                data-url="{{ route('preview.dokumen', ['file' => $it->file_path, 'title' => $it->judul, 'is_blurred' => $it->is_blurred ? 1 : 0]) }}">
                                            Disini <i class="fas fa-file-pdf ms-1"></i>
                                        </button>
                                    @else
                                        <span class="badge bg-light text-muted border">Tersedia Fisik</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- PAGINATION CONTROLS -->
                <div class="p-3 bg-light border rounded-3 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div id="berkalaPaginationInfo" class="text-muted small fw-medium">
                            Menampilkan data...
                        </div>
                        <div class="d-flex align-items-center gap-1.5 ms-md-2">
                            <span class="text-muted small">Tampilkan:</span>
                            <select class="form-select form-select-sm py-0 px-2" style="width: auto; font-size: 12px; height: 28px;" onchange="changeBerkalaPageSize(this.value)">
                                <option value="10" selected>10 data per halaman</option>
                                <option value="25">25 data per halaman</option>
                                <option value="50">50 data per halaman</option>
                                <option value="all">Semua data</option>
                            </select>
                        </div>
                    </div>
                    <div id="berkalaPaginationControls">
                        <!-- Filled by JS -->
                    </div>
                </div>


                <!-- 2. CARDS VIEW (ALTERNATIF TAMPILAN RINCI) -->
                <div id="berkalaCardsView" style="display: none;">
                    <div class="row mt-2" id="berkalaItemsContainer">
                        @forelse($items as $item)
                            <div class="col-12 searchable-berkala-item" data-keywords="{{ strtolower($item->judul . ' ' . strip_tags($item->deskripsi)) }}">
                                <div class="info-item hover-lift mb-3" data-aos="fade-up">
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
                                                    @if(has_valid_document($item->file_path) && isset($item->file_size) && $item->file_size !== '-' && $item->file_size !== '')
                                                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill" style="font-size: 12px;">
                                                        <i class="fas fa-file-pdf me-1 text-danger"></i> {{ $item->file_size }}
                                                    </span>
                                                    @endif
                                                </div>
                                                @if(has_valid_document($item->file_path))
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
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        if (typeof AOS !== 'undefined') {
            AOS.init({duration: 800, once: true});
        }

        function switchBerkalaDisplay(mode) {
            const tbl = document.getElementById('berkalaTableView');
            const crd = document.getElementById('berkalaCardsView');
            const btnTbl = document.getElementById('btnModeTable');
            const btnCrd = document.getElementById('btnModeCards');
            if (!tbl || !crd) return;

            if (mode === 'table') {
                tbl.style.display = 'block';
                crd.style.display = 'none';
                if (btnTbl) {
                    btnTbl.classList.add('btn-primary');
                    btnTbl.classList.remove('btn-outline-secondary');
                }
                if (btnCrd) {
                    btnCrd.classList.add('btn-outline-secondary');
                    btnCrd.classList.remove('btn-primary');
                }
            } else {
                tbl.style.display = 'none';
                crd.style.display = 'block';
                if (btnCrd) {
                    btnCrd.classList.add('btn-primary');
                    btnCrd.classList.remove('btn-outline-secondary');
                }
                if (btnTbl) {
                    btnTbl.classList.add('btn-outline-secondary');
                    btnTbl.classList.remove('btn-primary');
                }
            }
        }

        function filterBerkalaContent() {
            const searchInput = document.getElementById('topSearchInputBerkala');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            
            // Filter cards view
            document.querySelectorAll('.searchable-berkala-item').forEach(el => {
                const kw = el.getAttribute('data-keywords') || '';
                if (!query || kw.includes(query) || el.innerText.toLowerCase().includes(query)) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });

            // Update table pagination and view
            currentBerkalaPage = 1;
            initBerkalaPagination();
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Chart === 'undefined') return;
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
    
        // PAGINATION & LIVE FILTER LOGIC (10 BARIS PER HALAMAN)
                function changeBerkalaPageSize(val) {
            berkalaRowsPerPage = val === 'all' ? 9999 : parseInt(val);
            currentBerkalaPage = 1;
            initBerkalaPagination();
        }

        let currentBerkalaPage = 1;
        let berkalaRowsPerPage = 10;
        let filteredBerkalaRows = [];

        function initBerkalaPagination() {
            const allRows = Array.from(document.querySelectorAll('#berkalaTableView tbody tr.searchable-berkala-row'));
            const searchInput = document.getElementById('topSearchInputBerkala');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

            filteredBerkalaRows = allRows.filter(row => {
                const kw = row.getAttribute('data-keywords') || '';
                const text = row.innerText.toLowerCase();
                return !query || kw.includes(query) || text.includes(query);
            });

            // If page is beyond total pages, reset to page 1
            const totalPages = Math.ceil(filteredBerkalaRows.length / berkalaRowsPerPage) || 1;
            if (currentBerkalaPage > totalPages) currentBerkalaPage = 1;

            renderBerkalaTablePage();
            renderBerkalaPaginationControls();
        }

        function renderBerkalaTablePage() {
            const allRows = document.querySelectorAll('#berkalaTableView tbody tr.searchable-berkala-row');
            allRows.forEach(r => r.style.display = 'none');

            const total = filteredBerkalaRows.length;
            const startIdx = (currentBerkalaPage - 1) * berkalaRowsPerPage;
            const endIdx = Math.min(startIdx + berkalaRowsPerPage, total);

            for (let i = startIdx; i < endIdx; i++) {
                if (filteredBerkalaRows[i]) {
                    filteredBerkalaRows[i].style.display = '';
                    const noCell = filteredBerkalaRows[i].querySelector('td:first-child');
                    if (noCell) {
                        noCell.innerText = (i + 1);
                    }
                }
            }

            // Also hide or show section header tr based on filtered results
            const sectionHeaders = document.querySelectorAll('#berkalaTableView tbody tr.table-light');
            sectionHeaders.forEach(sh => {
                sh.style.display = total === 0 ? 'none' : '';
            });

            const infoEl = document.getElementById('berkalaPaginationInfo');
            if (infoEl) {
                if (total === 0) {
                    infoEl.innerHTML = '<span class="text-danger"><i class="fas fa-search me-1"></i> Tidak ada informasi berkala yang cocok dengan pencarian.</span>';
                } else {
                    infoEl.innerHTML = `Menampilkan baris <strong>${startIdx + 1}</strong> - <strong>${endIdx}</strong> dari total <strong>${total}</strong> data informasi publik`;
                }
            }
        }

        function goToBerkalaPage(page) {
            const totalPages = Math.ceil(filteredBerkalaRows.length / berkalaRowsPerPage) || 1;
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;
            currentBerkalaPage = page;
            renderBerkalaTablePage();
            renderBerkalaPaginationControls();

            const tbl = document.getElementById('berkalaTableView');
            if (tbl) tbl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function renderBerkalaPaginationControls() {
            const container = document.getElementById('berkalaPaginationControls');
            if (!container) return;

            const totalPages = Math.ceil(filteredBerkalaRows.length / berkalaRowsPerPage) || 1;
            if (totalPages <= 1 && filteredBerkalaRows.length <= berkalaRowsPerPage) {
                container.innerHTML = '<span class="badge bg-white text-muted border px-2.5 py-1.5 rounded-pill">Halaman 1 dari 1</span>';
                return;
            }

            let html = '<ul class="pagination pagination-sm mb-0 gap-1 d-flex flex-wrap">';
            
            if (currentBerkalaPage > 1) {
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToBerkalaPage(1)" title="Halaman Pertama"><i class="fas fa-angles-left"></i></button></li>`;
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToBerkalaPage(${currentBerkalaPage - 1})"><i class="fas fa-chevron-left me-1"></i> Prev</button></li>`;
            }

            for (let p = 1; p <= totalPages; p++) {
                const active = p === currentBerkalaPage ? 'btn-primary text-white active font-black' : 'btn-outline-secondary text-dark';
                html += `<li class="page-item"><button type="button" class="btn btn-sm ${active} rounded-pill px-3 fw-bold" onclick="goToBerkalaPage(${p})">${p}</button></li>`;
            }

            if (currentBerkalaPage < totalPages) {
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToBerkalaPage(${currentBerkalaPage + 1})">Next <i class="fas fa-chevron-right ms-1"></i></button></li>`;
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToBerkalaPage(${totalPages})" title="Halaman Terakhir"><i class="fas fa-angles-right"></i></button></li>`;
            }

            html += '</ul>';
            container.innerHTML = html;
        }

        // Initialize pagination reliably
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initBerkalaPagination);
        } else {
            initBerkalaPagination();
        }

    </script>
</body>
</html>

