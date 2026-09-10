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
            padding: 40px 45px;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0, 43, 92, 0.08);
            margin-top: -45px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            position: relative;
            z-index: 20;
            margin-bottom: 70px;
        }

        /* Poltrada Bali TablePress Style Table */
        .tablepress-dip {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            font-size: 13px;
        }

        .tablepress-dip thead th {
            background: #dcecf8;
            color: #0f172a;
            font-weight: 700;
            padding: 13px 12px;
            vertical-align: middle;
            border: 1px solid #cbd5e1;
            font-size: 13px;
            letter-spacing: 0.2px;
        }

        .tablepress-dip tbody td {
            padding: 12px 14px;
            vertical-align: middle;
            border-top: 1px solid #e2e8f0;
            border-right: 1px solid #f1f5f9;
            color: #334155;
            line-height: 1.5;
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
            font-size: 13px !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 11px 16px !important;
            border-top: 1px solid #cbd5e1 !important;
            border-bottom: 1px solid #cbd5e1 !important;
        }

        .tautan-disini {
            color: #0056b3;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }
        .tautan-disini:hover {
            color: #002b5c;
            text-decoration: underline;
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
    <div class="container-fluid px-3 px-md-5">
        <div class="content-card">
            
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 pb-3 border-bottom">
                <div>
                    <h3 class="fw-bold outfit mb-1" style="color: #002b5c; font-size: 1.7rem;">
                        Informasi Setiap Saat Tahun 2026
                    </h3>
                    <p class="text-muted small mb-0">Informasi publik yang wajib disediakan oleh Badan Publik dan siap tersedia setiap saat ketika dimohonkan oleh pemohon informasi.</p>
                </div>
                <!-- SEARCH INPUT -->
                <div style="min-width: 280px; max-width: 380px;" class="w-100 w-md-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" id="tableSearchInput" placeholder="Cari dokumen setiap saat..." onkeyup="filterDIPTable()" class="form-control border-start-0 ps-0" style="font-size: 13px;">
                    </div>
                </div>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'informasi_setiapsaat'])

            <!-- POLTRADA BALI MASTER 9-COLUMN DIP TABLE -->
            <div class="table-responsive mb-3">
                <table class="tablepress-dip" id="dipTableSetiapSaat">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 45px;">No</th>
                            <th style="min-width: 190px;">Informasi</th>
                            <th style="min-width: 260px;">Ringkasan Informasi</th>
                            <th style="min-width: 160px;">Pejabat yang Menguasai Informasi</th>
                            <th style="min-width: 150px;">Penerbit Informasi</th>
                            <th class="text-center" style="min-width: 120px;">Bentuk Informasi yang Tersedia</th>
                            <th class="text-center" style="min-width: 130px;">Tempat dan Waktu Pembuatan Informasi</th>
                            <th class="text-center" style="min-width: 110px;">Jangka Waktu Penyimpanan / Retensi Arsip</th>
                            <th class="text-center" style="min-width: 110px;">Tautan</th>
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

                                    // Resolve Tautan / Link
                                    $rawPath = trim($it->file_path ?? '');
                                    $isWeb = str_starts_with($rawPath, 'http://') || str_starts_with($rawPath, 'https://');
                                    $isInternal = str_starts_with($rawPath, '/');
                                @endphp
                                <tr class="dip-data-row" data-keywords="{{ strtolower($it->judul . ' ' . $cleanDesc) }}">
                                    <td class="text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                    <td><strong class="text-dark">{{ $it->judul }}</strong></td>
                                    <td class="text-muted small">{{ $cleanDesc }}</td>
                                    <td>{{ $it->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal' }}</td>
                                    <td>{{ $it->penanggung_jawab ?? $it->penerbit_informasi ?? 'Bagian Keuangan dan Umum' }}</td>
                                    <td class="text-center">{{ $it->bentuk_informasi ?? 'Hardcopy & Softcopy' }}</td>
                                    <td class="text-center">{{ $it->tempat_pembuatan ?? 'Tegal' }}, {{ $it->waktu_pembuatan ?? $tahun }}</td>
                                    <td class="text-center">{{ $it->jangka_waktu ?? '1 Tahun' }}</td>
                                    <td class="text-center">
                                        @if($isInternal)
                                            <a href="{{ url($rawPath) }}" class="tautan-disini">Disini</a>
                                        @elseif($isWeb)
                                            <a href="{{ $rawPath }}" target="_blank" rel="noopener noreferrer" class="tautan-disini">Disini</a>
                                        @elseif(has_valid_document($rawPath))
                                            <a href="javascript:void(0)" class="tautan-disini" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#previewModal" 
                                               data-url="{{ route('preview.dokumen', ['file' => $rawPath, 'title' => $it->judul, 'is_blurred' => $it->is_blurred ? 1 : 0]) }}">
                                                Disini
                                            </a>
                                        @else
                                            <a href="{{ url('/layanan-informasi/daftar') }}" class="tautan-disini" title="Lihat Detail Informasi">Disini</a>
                                        @endif
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
