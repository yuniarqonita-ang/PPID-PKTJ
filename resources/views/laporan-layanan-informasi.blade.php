<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['laporan_layanan_judul_hero'] ?? 'Laporan Layanan Informasi Publik' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Laporan tahunan dan kinerja pelayanan informasi publik PPID Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --pktj-blue: #004a99;
            --pktj-navy: #002b5c;
            --pktj-gold: #ffc107;
            --pktj-gold-dark: #d39e00;
        }

        .hero-section {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 50%, #0066cc 100%);
            padding: 90px 0 60px;
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
            background: #f8fafc;
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(255, 193, 7, 0.2);
            border: 1px solid rgba(255, 193, 7, 0.4);
            color: #ffc107;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .hero-title {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 15px;
        }
        .hero-tagline {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 780px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* STATS HIGHLIGHTS */
        .stat-card-unique {
            background: white;
            border-radius: 20px;
            padding: 22px 26px;
            border: 1px solid rgba(0, 74, 153, 0.08);
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.04);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 20px;
            height: 100%;
        }
        .stat-card-unique:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 74, 153, 0.1);
            border-color: rgba(0, 74, 153, 0.2);
        }
        .stat-icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* TABLE WRAPPER & STYLING */
        .table-container-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            border: 1px solid rgba(0, 74, 153, 0.08);
            box-shadow: 0 15px 40px rgba(0, 43, 92, 0.05);
        }
        .table-header-custom {
            background: linear-gradient(135deg, #002b5c, #004a99);
            color: white;
            border-radius: 16px 16px 0 0;
            overflow: hidden;
        }
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .table-custom thead th {
            background: #002b5c;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 18px 20px;
            border: none;
            vertical-align: middle;
        }
        .table-custom thead th:first-child {
            border-top-left-radius: 16px;
        }
        .table-custom thead th:last-child {
            border-top-right-radius: 16px;
        }
        .table-custom tbody tr {
            transition: all 0.2s ease;
            background: #ffffff;
        }
        .table-custom tbody tr:nth-child(even) {
            background: #f8fbff;
        }
        .table-custom tbody tr:hover {
            background: #eef6ff !important;
            transform: scale([1.002]);
        }
        .table-custom tbody td {
            padding: 20px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
            font-size: 0.95rem;
        }
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        /* BUTTONS */
        .btn-poltrada-unduh {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #059669, #10b981);
            color: white !important;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transition: all 0.2s ease;
            border: none;
        }
        .btn-poltrada-unduh:hover {
            background: linear-gradient(135deg, #047857, #059669);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35);
        }

        .btn-poltrada-lihat {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #004a99, #0284c7);
            color: white !important;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-poltrada-lihat:hover {
            background: linear-gradient(135deg, #002b5c, #004a99);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.35);
        }

        .no-badge {
            width: 38px;
            height: 38px;
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 800;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 0.95rem;
        }

        .search-box-wrap {
            position: relative;
            max-width: 420px;
            width: 100%;
        }
        .search-box-wrap input {
            padding: 14px 20px 14px 48px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            width: 100%;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
        }
        .search-box-wrap input:focus {
            border-color: #004a99;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
        }
        .search-box-wrap i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
        }

        /* EMPTY STATE */
        .empty-state-modern {
            padding: 60px 20px;
            text-align: center;
        }
        .empty-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 20px;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .table-container-card { padding: 18px; }
            .btn-poltrada-unduh, .btn-poltrada-lihat {
                padding: 8px 14px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body class="bg-[#f8fafc]">
    @include('navigation')

    <!-- HERO SECTION -->
    <div class="hero-section">
        <div class="container hero-content text-center" data-aos="fade-up">
            <div class="hero-badge">
                <i class="fas fa-file-invoice me-1"></i> Layanan Informasi Publik
            </div>
            @php
                $heroTagline = $settings['laporan_layanan_tagline_hero'] ?? '';
                if (str_contains(strtolower($heroTagline), 'jks') || strlen(trim($heroTagline)) < 6) {
                    $heroTagline = 'Wujud komitmen keterbukaan dan transparansi akuntabilitas pelayanan informasi publik Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.';
                }
            @endphp
            <h1 class="hero-title">{{ $settings['laporan_layanan_judul_hero'] ?? 'Laporan Layanan Informasi Publik' }}</h1>
            <p class="hero-tagline">{{ $heroTagline }}</p>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="container my-5">
        
        <!-- UNIQUE STATS / INFO HIGHLIGHTS -->
        <div class="row g-4 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-4">
                <div class="stat-card-unique">
                    <div class="stat-icon-wrap bg-blue-50 text-[#004a99]">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Arsip Dokumen</div>
                        <h4 class="fw-bold mb-0 text-dark" id="count-laporan">Memuat...</h4>
                        <div class="small text-muted">Laporan Resmi Terpublikasi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-unique">
                    <div class="stat-icon-wrap bg-emerald-50 text-emerald-600">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Dasar Hukum</div>
                        <h4 class="fw-bold mb-0 text-dark">UU No. 14 / 2008</h4>
                        <div class="small text-muted">Keterbukaan Informasi Publik</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-unique">
                    <div class="stat-icon-wrap bg-amber-50 text-amber-600">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Akses Publik</div>
                        <h4 class="fw-bold mb-0 text-dark">Terbuka & Bebas</h4>
                        <div class="small text-muted">Pratinjau & Unduh Langsung</div>
                    </div>
                </div>
            </div>
        </div>

        @php
            // Filter dokumen laporan yang valid (memiliki berkas fisik / link aktif)
            $validLaporan = collect($laporan ?? [])->filter(function($item) {
                $path = trim($item->file_path ?? '');
                return $path !== '' && $path !== '-' && $path !== '#';
            })->values();
        @endphp

        <!-- TABLE SECTION ALA POLTRADA BALI (UPGRADED) -->
        <div class="table-container-card" data-aos="fade-up" data-aos-delay="200">
            
            <!-- TOOLBAR: TITLE & LIVE SEARCH -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
                <div>
                    <h3 class="fw-bold outfit text-[#002b5c] mb-1">
                        <i class="fas fa-table text-[#004a99] me-2"></i>Daftar Laporan Tahunan Layanan Informasi
                    </h3>
                    <p class="text-muted small mb-0">Klik <strong>Unduh Laporan</strong> untuk mengunduh dokumen atau <strong>Lihat Laporan</strong> untuk pratinjau langsung.</p>
                </div>
                
                @if($validLaporan->count() > 0)
                <div class="search-box-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama laporan atau tahun..." onkeyup="filterLaporanTable()">
                </div>
                @endif
            </div>

            @if($validLaporan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom align-middle" id="laporanTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">Nomor</th>
                                <th>Judul Laporan</th>
                                <th class="text-center" style="width: 140px;">Tahun</th>
                                <th class="text-center" style="width: 180px;">Unduh Laporan</th>
                                <th class="text-center" style="width: 180px;">Lihat Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($validLaporan as $index => $item)
                            @php
                                $isGDrive = $item->file_path && (str_starts_with($item->file_path, 'http://') || str_starts_with($item->file_path, 'https://'));
                                $directDownload = $isGDrive ? $item->file_path : route('dokumen.download', $item->id);
                                $previewUrl = $isGDrive ? $item->file_path : asset('storage/' . $item->file_path);
                                
                                // Deteksi tahun
                                $tahunLaporan = '-';
                                if ($item->tanggal) {
                                    $tahunLaporan = \Carbon\Carbon::parse($item->tanggal)->format('Y');
                                } elseif ($item->created_at) {
                                    $tahunLaporan = $item->created_at->format('Y');
                                }
                                if (preg_match('/20\d{2}/', $item->judul, $matches)) {
                                    $tahunLaporan = $matches[0];
                                }
                            @endphp
                            <tr class="laporan-row">
                                <td class="text-center">
                                    <div class="no-badge">{{ $index + 1 }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="text-[#004a99] mt-1" style="font-size: 1.3rem;">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-dark mb-1 laporan-title" style="font-size: 1rem; line-height: 1.4;">
                                                {{ $item->judul }}
                                            </h5>
                                            @if($item->deskripsi)
                                                <div class="text-muted small mt-1 mb-2 line-clamp-2" style="font-size: 0.85rem;">
                                                    {!! strip_tags($item->deskripsi) !!}
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center gap-2 flex-wrap mt-1">
                                                <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="fas fa-calendar-alt me-1 text-primary"></i> {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : ($item->created_at ? $item->created_at->translatedFormat('d F Y') : '-') }}
                                                </span>
                                                @if($item->file_size && $item->file_size !== '-')
                                                <span class="badge bg-light text-secondary border px-2.5 py-1 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="fas fa-hdd me-1 text-primary"></i> {{ $item->file_size }}
                                                </span>
                                                @endif
                                                <span class="badge bg-blue-50 text-[#004a99] border border-blue-100 px-2.5 py-1 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="fas fa-shield-alt me-1"></i> PPID PKTJ Resmi
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning-subtle text-dark border border-warning px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.85rem;">
                                        {{ $tahunLaporan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $directDownload }}" 
                                       target="{{ $isGDrive ? '_blank' : '_self' }}"
                                       class="btn-poltrada-unduh w-100">
                                        <i class="fas fa-download"></i> Unduh Laporan
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($isGDrive)
                                        <a href="{{ $item->file_path }}" target="_blank" rel="noopener noreferrer" class="btn-poltrada-lihat w-100">
                                            <i class="fas fa-external-link-alt"></i> Buka Dokumen
                                        </a>
                                    @else
                                        <button type="button" class="btn-poltrada-lihat w-100" 
                                            onclick="openLaporanModal('{{ addslashes($item->judul) }}', '{{ $previewUrl }}', '{{ $item->is_blurred ? '1' : '0' }}')">
                                            <i class="fas fa-eye"></i> Lihat Laporan
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state-modern">
                    <div class="empty-icon-circle">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h4 class="fw-bold text-dark outfit mb-2">Laporan Layanan Sedang Dalam Proses Publikasi</h4>
                    <p class="text-muted max-w-md mx-auto mb-4" style="max-width: 550px;">
                        Dokumen Laporan Layanan Informasi Publik PPID Politeknik Keselamatan Transportasi Jalan sedang dalam tahap kurasi dan segera ditayangkan. Anda dapat memantau kembali secara berkala atau menghubungi layanan PPID kami.
                    </p>
                    <a href="{{ route('profil.kontak') }}" class="btn btn-primary px-4 py-2.5 rounded-pill fw-bold shadow-sm">
                        <i class="fas fa-envelope me-2"></i> Hubungi Layanan PPID
                    </a>
                </div>
            @endif

        </div>

    </div>

    <!-- MODAL PRATINJAU DOKUMEN INTERAKTIF -->
    <div class="modal fade" id="previewLaporanModal" tabindex="-1" aria-labelledby="previewLaporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden">
                <div class="modal-header bg-[#002b5c] text-white p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="w-10 h-10 rounded-circle bg-white/10 d-flex align-items-center justify-content-center text-warning fs-5">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold outfit text-white mb-0" id="modalLaporanTitle">Pratinjau Laporan</h5>
                            <span class="badge bg-warning text-dark font-monospace mt-1">Dokumen Resmi PPID PKTJ</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 bg-dark position-relative" style="height: 75vh;">
                    <iframe id="modalLaporanFrame" src="" class="w-100 h-100 border-0" allow="fullscreen"></iframe>
                </div>
                <div class="modal-footer bg-light p-3 d-flex justify-content-between">
                    <span class="text-muted small">
                        <i class="fas fa-info-circle me-1 text-primary"></i> Anda dapat membaca seluruh isi laporan publik melalui jendela ini.
                    </span>
                    <button type="button" class="btn btn-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Tutup Pratinjau</button>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({duration: 800, once: true});

        // Set total count
        document.addEventListener("DOMContentLoaded", function() {
            const rowCount = document.querySelectorAll('.laporan-row').length;
            const countElem = document.getElementById('count-laporan');
            if (countElem) {
                countElem.textContent = rowCount + ' Dokumen';
            }
        });

        // Live Search Filter
        function filterLaporanTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.laporan-row');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Open Modal Preview
        function openLaporanModal(title, url, isBlurred) {
            document.getElementById('modalLaporanTitle').textContent = title;
            
            // Generate Google Docs Viewer URL or direct PDF
            let embedUrl = url;
            if (url.endsWith('.pdf')) {
                embedUrl = url;
            } else {
                embedUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent(url) + '&embedded=true';
            }
            
            document.getElementById('modalLaporanFrame').src = embedUrl;
            const modal = new bootstrap.Modal(document.getElementById('previewLaporanModal'));
            modal.show();
        }

        // Clean frame on close
        document.getElementById('previewLaporanModal')?.addEventListener('hidden.bs.modal', function () {
            document.getElementById('modalLaporanFrame').src = '';
        });
    </script>
</body>
</html>
