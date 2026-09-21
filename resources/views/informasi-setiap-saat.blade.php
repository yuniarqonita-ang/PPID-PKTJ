<style>
.pagination-box-group {
    display: flex;
    align-items: center;
    gap: 6px;
}
.page-box-btn {
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
    user-select: none;
    line-height: 1;
}
.page-box-btn:hover {
    background-color: #f1f5f9;
    border-color: #94a3b8;
    color: #0f172a;
}
.page-box-btn.active {
    background-color: #004a99 !important;
    border-color: #004a99 !important;
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.12);
    cursor: default;
}
</style>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Setiap Saat - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.95) 0%, rgba(0, 74, 153, 0.92) 100%);
            padding: 70px 0 85px;
            color: white;
            position: relative;
        }

        .content-card {
            background: white;
            padding: 24px 18px;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 43, 92, 0.06);
            margin-top: -45px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            position: relative;
            z-index: 20;
            margin-bottom: 70px;
        }

        /* Poltrada / BPSDM TablePress Style Table */
        .tablepress-dip {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 11.5px;
        }

        .tablepress-dip thead th {
            background: #dcecf8;
            color: #0f2b48;
            font-weight: 700;
            padding: 9px 5px;
            vertical-align: middle;
            border: 1px solid #cbd5e1;
            font-size: 11px;
            letter-spacing: 0.2px;
            text-transform: uppercase;
        }

        .tablepress-dip tbody td {
            padding: 8px 6px;
            vertical-align: middle;
            border-top: 1px solid #e2e8f0;
            border-right: 1px solid #f1f5f9;
            color: #334155;
            line-height: 1.4;
            font-size: 11.5px;
        }
        .tablepress-dip tbody td:last-child {
            border-right: none;
        }

        .tablepress-dip tbody tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .tablepress-dip tbody tr:hover td {
            background-color: #eff6ff !important;
        }

        /* Category Divider Row */
        .tablepress-dip tr.category-divider-row td {
            background: #f8fafc !important;
            color: #0f172a !important;
            font-weight: 800 !important;
            font-size: 12px !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 9px 12px !important;
            border-top: 1px solid #cbd5e1 !important;
            border-bottom: 1px solid #cbd5e1 !important;
        }

        .tautan-disini {
            color: #0056b3;
            font-weight: 700;
            font-size: 11.5px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }
        .tautan-disini:hover {
            color: #002b5c;
            text-decoration: underline;
        }

        /* ===== RESPONSIVE TABLE STYLES ===== */
        /* Desktop & Laptop (>= 992px): Pas 100% Layar Tanpa Geser Kanan-Kiri & Tanpa Huruf Terpotong */
        @media (min-width: 992px) {
            .table-responsive {
                overflow-x: visible !important;
            }
            .tablepress-dip {
                width: 100% !important;
                table-layout: fixed !important;
            }
            .tablepress-dip th, 
            .tablepress-dip td {
                word-break: normal !important;
                overflow-wrap: break-word !important;
                hyphens: none !important;
                white-space: normal !important;
            }
            
            /* Proporsi Lebar 9 Kolom Tepat 100% */
            .tablepress-dip th.col-no, .tablepress-dip td.col-no { width: 3.5% !important; text-align: center; font-weight: 700; }
            .tablepress-dip th.col-info, .tablepress-dip td.col-info { width: 19% !important; }
            .tablepress-dip th.col-ringkasan, .tablepress-dip td.col-ringkasan { width: 22.5% !important; }
            .tablepress-dip th.col-pejabat, .tablepress-dip td.col-pejabat { width: 13% !important; }
            .tablepress-dip th.col-penerbit, .tablepress-dip td.col-penerbit { width: 13% !important; }
            .tablepress-dip th.col-bentuk, .tablepress-dip td.col-bentuk { width: 7.5% !important; text-align: center; }
            .tablepress-dip th.col-waktu, .tablepress-dip td.col-waktu { width: 7.5% !important; text-align: center; }
            .tablepress-dip th.col-retensi, .tablepress-dip td.col-retensi { width: 6% !important; text-align: center; }
            .tablepress-dip th.col-tautan, .tablepress-dip td.col-tautan { width: 8% !important; text-align: center; }
            
            .dip-title {
                font-size: 11.5px !important;
                font-weight: 700 !important;
                line-height: 1.35 !important;
                color: #0f172a !important;
                display: block;
            }
            .dip-desc {
                font-size: 11px !important;
                line-height: 1.35 !important;
                color: #475569 !important;
            }
        }

        /* Tablet & Mobile (< 992px): Stacked Card Layout (HANYA SCROLL KE ATAS-BAWAH) */
        @media (max-width: 991px) {
            .content-card {
                padding: 18px 12px !important;
                border-radius: 16px !important;
            }
            .table-responsive {
                overflow: visible !important;
            }
            .tablepress-dip,
            .tablepress-dip tbody {
                display: block !important;
                width: 100% !important;
                border: none !important;
                background: transparent !important;
            }
            .tablepress-dip thead {
                display: none !important;
            }
            .tablepress-dip tr.dip-data-row {
                display: block !important;
                background: #ffffff !important;
                border: 1.5px solid #e2e8f0 !important;
                border-radius: 14px !important;
                padding: 14px 12px !important;
                margin-bottom: 14px !important;
                box-shadow: 0 3px 12px rgba(0, 43, 92, 0.04) !important;
                position: relative !important;
            }
            .tablepress-dip tr.dip-data-row:hover {
                box-shadow: 0 6px 18px rgba(0, 43, 92, 0.08) !important;
            }
            .tablepress-dip tr.dip-data-row:nth-child(even) td {
                background-color: transparent !important;
            }
            .tablepress-dip tr.dip-data-row td {
                display: block !important;
                width: 100% !important;
                padding: 5px 0 !important;
                border: none !important;
                background: transparent !important;
                text-align: left !important;
                line-height: 1.4 !important;
                word-break: normal !important;
                overflow-wrap: break-word !important;
            }
            /* Row number badge at top */
            .tablepress-dip tr.dip-data-row td.col-no {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: auto !important;
                min-width: 26px !important;
                height: 24px !important;
                background: #004a99 !important;
                color: #ffffff !important;
                border-radius: 6px !important;
                font-weight: 800 !important;
                font-size: 11px !important;
                padding: 0 8px !important;
                margin-bottom: 6px !important;
            }
            .tablepress-dip tr.dip-data-row td.col-no::before {
                content: "No. " !important;
                font-weight: 600 !important;
                font-size: 10.5px !important;
                margin-right: 2px !important;
            }
            /* Title of document */
            .tablepress-dip tr.dip-data-row td.col-info {
                padding-top: 0 !important;
                padding-bottom: 6px !important;
                border-bottom: 1px solid #e2e8f0 !important;
                margin-bottom: 8px !important;
            }
            .dip-title {
                font-size: 13.5px !important;
                font-weight: 700 !important;
                color: #002b5c !important;
                display: block !important;
                line-height: 1.35 !important;
            }
            /* Description box */
            .tablepress-dip tr.dip-data-row td.col-ringkasan {
                margin-bottom: 6px !important;
            }
            .dip-desc {
                background: #f8fafc !important;
                border-radius: 8px !important;
                padding: 8px 10px !important;
                margin: 4px 0 6px !important;
                border: 1px solid #edf2f7 !important;
                font-size: 11.5px !important;
                color: #475569 !important;
                line-height: 1.4 !important;
            }
            /* Meta rows: Pejabat, Penerbit, Bentuk, Waktu, Retensi */
            .tablepress-dip tr.dip-data-row td.col-meta {
                display: flex !important;
                justify-content: space-between !important;
                align-items: flex-start !important;
                gap: 10px !important;
                padding: 6px 0 !important;
                border-bottom: 1px dashed #edf2f7 !important;
                font-size: 11.5px !important;
                text-align: right !important;
            }
            .tablepress-dip tr.dip-data-row td.col-meta::before {
                content: attr(data-label);
                font-weight: 700;
                color: #64748b;
                font-size: 10.5px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                flex-shrink: 0;
                text-align: left;
            }
            /* Action Button / Tautan */
            .tablepress-dip tr.dip-data-row td.col-tautan {
                padding-top: 10px !important;
                margin-top: 4px !important;
                border-top: 1px solid #e2e8f0 !important;
                text-align: center !important;
            }
            .tablepress-dip tr.dip-data-row td.col-tautan .bpsdm-link-wrapper {
                max-width: 100% !important;
            }
            .tablepress-dip td[colspan] {
                display: block !important;
                text-align: center !important;
                padding: 20px 0 !important;
            }
        }
    </style>
</head>
<body>

    @include('navigation')

    <!-- HERO HEADER -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-black outfit uppercase mb-2">Informasi Setiap Saat</h1>
            <p class="lead opacity-85 mb-0" style="font-size: 1.15rem;">Daftar Informasi Publik (DIP) Setiap Saat Resmi Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal</p>
        </div>
    </div>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <div class="content-card">
            
            <!-- SEARCH & TOOLBAR -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill font-mono fw-bold" style="font-size: 12.5px;">
                        <i class="fas fa-file-lines me-1"></i> Total: {{ $items->count() }} Dokumen DIP
                    </span>
                </div>
                <!-- SEARCH INPUT -->
                <div style="min-width: 280px; max-width: 420px;" class="w-100 w-md-auto ms-auto">
                    <div class="input-group shadow-xs">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearchInput" placeholder="Cari nomor, nama dokumen, atau pejabat..." onkeyup="filterDIPTable()" class="form-control border-start-0 ps-0" style="font-size: 13px;">
                    </div>
                </div>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'informasi_setiapsaat'])

            <!-- OFFICIAL MASTER 9-COLUMN DIP TABLE -->
            <div class="table-responsive mb-3">
                <table class="tablepress-dip" id="dipTableSetiapSaat">
                    <thead>
                        <tr>
                            <th class="col-no text-center">No</th>
                            <th class="col-info">Informasi</th>
                            <th class="col-ringkasan">Ringkasan Informasi</th>
                            <th class="col-pejabat">Pejabat Penguasa</th>
                            <th class="col-penerbit">Penanggung Jawab</th>
                            <th class="col-bentuk text-center">Bentuk</th>
                            <th class="col-waktu text-center">Waktu & Tempat</th>
                            <th class="col-retensi text-center">Retensi</th>
                            <th class="col-tautan text-center">Tautan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($items) && $items->count() > 0)
                            @foreach($items as $idx => $it)
                                @php
                                    $cleanDesc = Str::limit(strip_tags($it->deskripsi ?? ''), 160);
                                    if (empty($cleanDesc) || $cleanDesc === 'Tidak ada deskripsi') {
                                        $cleanDesc = 'Informasi publik setiap saat resmi Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.';
                                    }
                                    $tahun = \Carbon\Carbon::parse($it->tanggal ?? $it->created_at)->format('Y');

                                    // Resolve Multi-links (ala BPSDM) atau Fallback ke Single Link
                                    $resolvedLinks = [];
                                    $rawTautanLinks = $it->tautan_links ?? [];
                                    if (is_string($rawTautanLinks)) {
                                        $rawTautanLinks = json_decode($rawTautanLinks, true);
                                    }

                                    if (!empty($rawTautanLinks) && is_array($rawTautanLinks)) {
                                        foreach ($rawTautanLinks as $lnk) {
                                            $lUrl = trim($lnk['url'] ?? '');
                                            $lNama = trim($lnk['nama'] ?? '');
                                            if (empty($lUrl) || in_array(strtolower($lUrl), ['#', '-', 'null', 'none', 'javascript:void(0)'])) {
                                                continue;
                                            }
                                            if (empty($lNama)) {
                                                $lNama = 'Lihat Dokumen';
                                            }

                                            if (str_starts_with($lUrl, 'http://') || str_starts_with($lUrl, 'https://')) {
                                                if (str_contains($lUrl, 'drive.google.com') || str_contains($lUrl, 'docs.google.com')) {
                                                    $tUrl = route('preview.dokumen', ['file' => $lUrl, 'title' => $lNama]);
                                                } else {
                                                    $tUrl = $lUrl;
                                                }
                                            } elseif (str_starts_with($lUrl, '/') && !in_array($lUrl, ['/', '/#', '/layanan-informasi/daftar'])) {
                                                $tUrl = url($lUrl);
                                            } else {
                                                $tUrl = route('preview.dokumen', ['file' => $lUrl, 'title' => $lNama]);
                                            }

                                            $resolvedLinks[] = [
                                                'nama' => $lNama,
                                                'url'  => $tUrl
                                            ];
                                        }
                                    }

                                    // Fallback ke single file/link jika resolvedLinks masih kosong
                                    if (empty($resolvedLinks)) {
                                        $rawPath = trim($it->file_path ?? $it->file_informasi ?? '');
                                        if (!empty($rawPath) && !in_array(strtolower($rawPath), ['#', '-', 'null', 'none', 'tanpa preview', 'tidak ada', '/layanan-informasi/daftar', 'javascript:void(0)'])) {
                                            if (str_starts_with($rawPath, 'http://') || str_starts_with($rawPath, 'https://')) {
                                                if (!str_contains($rawPath, 'elhkpn.kpk.go.id')) {
                                                    if (str_contains($rawPath, 'drive.google.com') || str_contains($rawPath, 'docs.google.com')) {
                                                        $tUrl = route('preview.dokumen', ['file' => $rawPath, 'title' => $it->judul]);
                                                    } else {
                                                        $tUrl = $rawPath;
                                                    }
                                                    $resolvedLinks[] = ['nama' => 'Lihat Dokumen', 'url' => $tUrl];
                                                }
                                            } elseif (str_starts_with($rawPath, '/') && !in_array($rawPath, ['/', '/#', '/layanan-informasi/daftar'])) {
                                                $resolvedLinks[] = ['nama' => 'Lihat Halaman', 'url' => url($rawPath)];
                                            } else {
                                                $resolvedLinks[] = ['nama' => 'Lihat Dokumen', 'url' => route('preview.dokumen', ['file' => $rawPath, 'title' => $it->judul])];
                                            }
                                        }
                                    }
                                @endphp
                                <tr class="dip-data-row" data-keywords="{{ strtolower($it->judul . ' ' . $cleanDesc) }}">
                                    <td class="col-no text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                    <td class="col-info" data-label="Informasi"><strong class="dip-title">{{ $it->judul }}</strong></td>
                                    <td class="col-ringkasan" data-label="Ringkasan"><div class="dip-desc">{{ $cleanDesc }}</div></td>
                                    <td class="col-meta col-pejabat" data-label="Pejabat Penguasa">{{ $it->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal' }}</td>
                                    <td class="col-meta col-penerbit" data-label="Penanggung Jawab">{{ $it->penanggung_jawab ?? $it->penerbit_informasi ?? 'Bagian Keuangan dan Umum' }}</td>
                                    <td class="col-meta col-bentuk text-center" data-label="Bentuk Informasi">{{ $it->bentuk_informasi ?? 'Hardcopy & Softcopy' }}</td>
                                    <td class="col-meta col-waktu text-center" data-label="Waktu & Tempat">{{ $it->tempat_pembuatan ?? 'Tegal' }}, {{ $it->waktu_pembuatan ?? $tahun }}</td>
                                    <td class="col-meta col-retensi text-center" data-label="Retensi Arsip">{{ $it->jangka_waktu ?? '1 Tahun' }}</td>
                                    <td class="col-tautan text-center" style="vertical-align: middle;">
                                        <x-dip-link-bpsdm :links="$resolvedLinks" :catatan="$it->catatan ?? null" :judul="$it->judul" />
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                                    <h6 class="fw-bold mb-1">Dokumen Sedang Dalam Proses Pemutakhiran</h6>
                                    <p class="small text-muted mb-0">Silakan hubungi Desk Layanan PPID PKTJ untuk permintaan informasi langsung.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION CONTROLS -->
            <div class="p-3 bg-light border rounded-3 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div id="tablePaginationInfo" class="text-muted small fw-medium">
                        Menampilkan data...
                    </div>
                    <div class="d-flex align-items-center gap-1.5 ms-md-2">
                        <span class="text-muted small">Tampilkan:</span>
                        <select class="form-select form-select-sm py-0 px-2" style="width: auto; font-size: 12px; height: 28px;" onchange="changePageSize(this.value)">
                            <option value="all" selected>Semua data</option>
                            <option value="10">10 data per halaman</option>
                            <option value="25">25 data per halaman</option>
                        </select>
                    </div>
                </div>
                <div id="tablePaginationControls">
                    <!-- Filled by JS -->
                </div>
            </div>

        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPage = 1;
        let rowsPerPage = 9999;
        let filteredRows = [];

        function filterDIPTable() {
            currentPage = 1;
            initTablePagination();
        }

        function changePageSize(val) {
            rowsPerPage = val === 'all' ? 9999 : parseInt(val);
            currentPage = 1;
            initTablePagination();
        }

        function initTablePagination() {
            const searchInput = document.getElementById('tableSearchInput');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const allRows = Array.from(document.querySelectorAll('#dipTableSetiapSaat tbody tr.dip-data-row'));

            filteredRows = allRows.filter(row => {
                const kw = row.getAttribute('data-keywords') || '';
                return !query || kw.includes(query) || row.innerText.toLowerCase().includes(query);
            });

            allRows.forEach(r => r.style.display = 'none');

            const total = filteredRows.length;
            const totalPages = Math.ceil(total / rowsPerPage) || 1;
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIdx = (currentPage - 1) * rowsPerPage;
            const endIdx = Math.min(startIdx + rowsPerPage, total);

            for (let i = startIdx; i < endIdx; i++) {
                if (filteredRows[i]) {
                    filteredRows[i].style.display = '';
                    const noCell = filteredRows[i].querySelector('td:first-child');
                    if (noCell) noCell.innerText = (i + 1);
                }
            }

            const infoEl = document.getElementById('tablePaginationInfo');
            if (infoEl) {
                if (total === 0) {
                    infoEl.innerHTML = '<span class="text-danger"><i class="fas fa-search me-1"></i> Tidak ada informasi yang cocok dengan kata kunci pencarian.</span>';
                } else if (rowsPerPage >= total) {
                    infoEl.innerHTML = `Menampilkan seluruh <strong>${total}</strong> data informasi setiap saat`;
                } else {
                    infoEl.innerHTML = `Menampilkan baris <strong>${startIdx + 1}</strong> - <strong>${endIdx}</strong> dari total <strong>${total}</strong> data informasi setiap saat`;
                }
            }

            renderPaginationControls(totalPages);
        }

        function goToPage(p) {
            currentPage = p;
            initTablePagination();
            const tbl = document.getElementById('dipTableSetiapSaat');
            if (tbl) tbl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function renderPaginationControls(totalPages) {
            const container = document.getElementById('tablePaginationControls');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<div class="pagination-box-group">';
            if (currentPage > 1) {
                html += `<button type="button" class="page-box-btn" onclick="goToPage(${currentPage - 1})" title="Sebelumnya">←</button>`;
            }

            for (let p = 1; p <= totalPages; p++) {
                const active = p === currentPage ? 'active' : '';
                html += `<button type="button" class="page-box-btn ${active}" onclick="goToPage(${p})">${p}</button>`;
            }

            if (currentPage < totalPages) {
                html += `<button type="button" class="page-box-btn" onclick="goToPage(${currentPage + 1})" title="Selanjutnya">→</button>`;
            }
            html += '</div>';
            container.innerHTML = html;
        }

        document.addEventListener('DOMContentLoaded', initTablePagination);
    </script>
</body>
</html>
