<style>
.pagination-box-group {
    display: flex;
    align-items: center;
    gap: 6px;
}
.page-box-btn {
    min-width: 38px;
    height: 38px;
    padding: 0 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 3px;
    font-size: 14px;
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
    background-color: #142238 !important;
    border-color: #142238 !important;
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
    <title>Informasi Serta Merta - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            padding: 85px 0 100px;
            color: white;
            position: relative;
        }

        .content-card {
            background: white;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 43, 92, 0.08);
            margin-top: -50px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            position: relative;
            z-index: 20;
            margin-bottom: 60px;
        }

        .smart-table thead th {
            background: #002b5c;
            color: white;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border: none;
        }

        .smart-table td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        .smart-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .info-item {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 20px;
            border: 1.5px solid #e2e8f0;
            border-left: 5px solid #004a99;
            box-shadow: 0 8px 25px rgba(0, 43, 92, 0.04);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-4px);
            border-color: #004a99;
            box-shadow: 0 16px 35px rgba(0, 74, 153, 0.1);
        }

        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 16px 35px rgba(0,0,0,0.08); }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container text-center hero-content">
            <div class="badge bg-warning text-dark font-black px-3 py-1.5 rounded-pill mb-2 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                <i class="fas fa-triangle-exclamation me-1"></i> Daftar Informasi Publik (DIP)
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-2">Informasi Serta Merta</h1>
            <p class="lead opacity-90 mx-auto mb-0" style="max-width: 800px; font-size: 15px;">
                Informasi yang wajib diumumkan secara serta merta yang menyangkut hajat hidup orang banyak dan ketertiban umum di lingkungan PKTJ Tegal.
            </p>
        </div>
    </div>

    <div class="container-fluid px-3 px-md-5">
        <div class="content-card" data-aos="fade-up">
            
            <!-- TOOLBAR PENCARIAN & TOGGLE VIEW -->
            <div class="p-3 mb-4 rounded-4 border shadow-sm bg-white" style="border-color: #cbd5e1;">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted ms-3" style="font-size: 15px;"></i>
                            <input type="text" id="topSearchInputSertaMerta" placeholder="Cari informasi darurat, penutupan fasilitas, atau info serta merta..." onkeyup="filterSertaMertaContent()" class="form-control ps-5 rounded-pill border-2 bg-light" style="font-size: 13.5px;">
                        </div>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-lg-end align-items-center gap-2">
                        <span class="text-muted small me-1">Mode Tampilan:</span>
                        <button type="button" id="btnModeTableSerta" class="btn btn-primary btn-sm rounded-pill px-3 py-1.5 fw-bold" onclick="switchSertaDisplay('table')">
                            <i class="fas fa-table-list me-1"></i> Tampilan Tabel DIP
                        </button>
                        <button type="button" id="btnModeCardsSerta" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5 fw-bold" onclick="switchSertaDisplay('cards')">
                            <i class="fas fa-th-large me-1"></i> Tampilan Kartu
                        </button>
                    </div>
                </div>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'informasi_sertamerta'])

            <!-- 1. TABEL VIEW (STANDAR RESMI POLTRADA & KEMENHUB - 9 KOLOM) -->
            <div id="sertaTableView" class="table-responsive rounded-3 border mb-3" style="border-color: #e2e8f0;">
                <table class="table table-hover align-middle mb-0 smart-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="min-width: 190px;">Informasi</th>
                            <th style="min-width: 260px;">Ringkasan Informasi</th>
                            <th style="min-width: 160px;">Pejabat yang Menguasai</th>
                            <th style="min-width: 150px;">Penerbit Informasi</th>
                            <th class="text-center" style="min-width: 120px;">Bentuk Informasi</th>
                            <th class="text-center" style="min-width: 130px;">Waktu & Tempat</th>
                            <th class="text-center" style="min-width: 100px;">Retensi</th>
                            <th class="text-center" style="min-width: 120px;">Tautan</th>
                        </tr>
                    </thead>
                                        <tbody id="sertaTableBody">
                        @if(isset($items) && $items->count() > 0)
                        @foreach($items as $idx => $it)
                        @php
                            $rowNo = $idx + 1;
                            $cleanDesc = Str::limit(strip_tags($it->deskripsi ?? ''), 130);
                            if (empty($cleanDesc) || $cleanDesc === 'Tidak ada deskripsi') {
                                $cleanDesc = 'Pengumuman informasi serta merta resmi PPID Politeknik Keselamatan Transportasi Jalan.';
                            }
                            $tahun = \Carbon\Carbon::parse($it->tanggal ?? $it->created_at)->format('Y');
                        @endphp
                        <tr class="searchable-sertamerta-row" data-keywords="{{ strtolower($it->judul . ' ' . $cleanDesc) }}">
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
                                    <span class="badge bg-light text-muted border">Tersedia di Meja PPID</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">Belum ada dokumen informasi serta merta yang tersedia.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION CONTROLS -->
            <div class="p-3 bg-light border rounded-3 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div id="sertaPaginationInfo" class="text-muted small fw-medium">
                        Menampilkan data...
                    </div>
                    <div class="d-flex align-items-center gap-1.5 ms-md-2">
                        <span class="text-muted small">Tampilkan:</span>
                        <select class="form-select form-select-sm py-0 px-2" style="width: auto; font-size: 12px; height: 28px;" onchange="changeSertaPageSize(this.value)">
                <option value="5" selected>5 data per halaman</option>
                <option value="10">10 data per halaman</option>
                <option value="25">25 data per halaman</option>
                <option value="all">Semua data</option>
            </select>
                    </div>
                </div>
                <div id="sertaPaginationControls">
                    <!-- Filled by JS -->
                </div>
            </div>

            <!-- 2. CARDS VIEW (ALTERNATIF TAMPILAN KARTU) -->
            <div id="sertaCardsView" style="display: none;" class="mt-4">
                <div class="row" id="sertaItemsContainer">
                    @forelse($items as $item)
                        <div class="col-12 searchable-sertamerta-card-item" data-keywords="{{ strtolower($item->judul . ' ' . strip_tags($item->deskripsi)) }}">
                            <div class="info-item hover-lift">
                                <div class="d-flex align-items-start flex-column flex-md-row gap-4">
                                    <div class="info-icon" style="width: 50px; height: 50px; border-radius: 14px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                        <i class="fas fa-triangle-exclamation"></i>
                                    </div>
                                    <div class="flex-grow-1 w-100" style="min-width: 0;">
                                        <h4 class="fw-bold outfit text-dark mb-2" style="font-size: 1.25rem;">{{ $item->judul }}</h4>
                                        <div class="text-muted small mb-3">
                                            {!! $item->deskripsi ?? 'Tidak ada deskripsi terperinci.' !!}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-2">
                                            <span class="badge bg-light text-secondary border px-3 py-1.5 rounded-pill font-monospace" style="font-size: 11.5px;">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('d M Y') }}
                                            </span>
                                            @if(has_valid_document($item->file_path))
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary rounded-pill px-3 py-1.5 fw-bold" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#previewModal" 
                                                    data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? 1 : 0]) }}">
                                                <i class="fas fa-eye me-1"></i> Lihat Dokumen
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-shield-halved fa-4x text-muted mb-4 opacity-25"></i>
                            <h4 class="text-muted outfit fw-bold">Situasi Terkendali & Layanan Normal</h4>
                            <p class="text-muted">Saat ini tidak ada keadaan darurat atau force majeure penutupan layanan publik di lingkungan PKTJ Tegal.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        function switchSertaDisplay(mode) {
            const tbl = document.getElementById('sertaTableView');
            const crd = document.getElementById('sertaCardsView');
            const btnTbl = document.getElementById('btnModeTableSerta');
            const btnCrd = document.getElementById('btnModeCardsSerta');

            if (mode === 'table') {
                tbl.style.display = 'block';
                crd.style.display = 'none';
                btnTbl.classList.add('btn-primary');
                btnTbl.classList.remove('btn-outline-secondary');
                btnCrd.classList.add('btn-outline-secondary');
                btnCrd.classList.remove('btn-primary');
            } else {
                tbl.style.display = 'none';
                crd.style.display = 'block';
                btnCrd.classList.add('btn-primary');
                btnCrd.classList.remove('btn-outline-secondary');
                btnTbl.classList.add('btn-outline-secondary');
                btnTbl.classList.remove('btn-primary');
            }
        }

        // PAGINATION & FILTER LOGIC (10 BARIS PER HALAMAN)
                        function changeSertaPageSize(val) {
            sertaRowsPerPage = val === 'all' ? 9999 : parseInt(val);
            currentSertaPage = 1;
            initSertaPagination();
        }

        let currentSertaPage = 1;
        let sertaRowsPerPage = 5;
        let filteredSertaRows = [];

        function initSertaPagination() {
            const allRows = Array.from(document.querySelectorAll('#sertaTableBody tr.searchable-sertamerta-row'));
            const searchInput = document.getElementById('topSearchInputSerta');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

            filteredSertaRows = allRows.filter(row => {
                const kw = row.getAttribute('data-keywords') || '';
                const text = row.innerText.toLowerCase();
                return !query || kw.includes(query) || text.includes(query);
            });

            const totalPages = Math.ceil(filteredSertaRows.length / sertaRowsPerPage) || 1;
            if (currentSertaPage > totalPages) currentSertaPage = 1;

            renderSertaTablePage();
            renderSertaPaginationControls();
        }

        function renderSertaTablePage() {
            const allRows = document.querySelectorAll('#sertaTableBody tr.searchable-sertamerta-row');
            allRows.forEach(r => r.style.display = 'none');

            const total = filteredSertaRows.length;
            const startIdx = (currentSertaPage - 1) * sertaRowsPerPage;
            const endIdx = Math.min(startIdx + sertaRowsPerPage, total);

            for (let i = startIdx; i < endIdx; i++) {
                if (filteredSertaRows[i]) {
                    filteredSertaRows[i].style.display = '';
                    const noCell = filteredSertaRows[i].querySelector('td:first-child');
                    if (noCell) {
                        noCell.innerText = (i + 1);
                    }
                }
            }

            const sectionHeaders = document.querySelectorAll('#sertaTableBody tr.table-light');
            sectionHeaders.forEach(sh => {
                sh.style.display = total === 0 ? 'none' : '';
            });

            const infoEl = document.getElementById('sertaPaginationInfo');
            if (infoEl) {
                if (total === 0) {
                    infoEl.innerHTML = '<span class="text-danger"><i class="fas fa-search me-1"></i> Tidak ada informasi serta merta yang cocok dengan pencarian.</span>';
                } else {
                    infoEl.innerHTML = `Menampilkan baris <strong>${startIdx + 1}</strong> - <strong>${endIdx}</strong> dari total <strong>${total}</strong> data informasi publik`;
                }
            }
        }

        function goToSertaPage(page) {
            const totalPages = Math.ceil(filteredSertaRows.length / sertaRowsPerPage) || 1;
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;
            currentSertaPage = page;
            renderSertaTablePage();
            renderSertaPaginationControls();

            const tbl = document.getElementById('sertaTableBody');
            if (tbl) tbl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function renderSertaPaginationControls() {
            const container = document.getElementById('sertaPaginationControls');
            if (!container) return;

            const totalPages = Math.ceil(filteredSertaRows.length / sertaRowsPerPage) || 1;

            let html = '<div class="pagination-box-group d-flex align-items-center gap-1">';

            // Tombol Panah Kiri (Prev)
            if (currentSertaPage > 1) {
                html += `<button type="button" class="page-box-btn" onclick="goToSertaPage(${currentSertaPage - 1})" title="Halaman Sebelumnya">←</button>`;
            }

            // Tombol Kotak Nomor (1, 2, 3, ...) persis Gambar 2
            for (let p = 1; p <= totalPages; p++) {
                const isCur = p === currentSertaPage;
                const activeClass = isCur ? 'page-box-btn active' : 'page-box-btn';
                html += `<button type="button" class="${activeClass}" onclick="goToSertaPage(${p})">${p}</button>`;
            }

            // Tombol Panah Kanan (Next)
            if (currentSertaPage < totalPages) {
                html += `<button type="button" class="page-box-btn" onclick="goToSertaPage(${currentSertaPage + 1})" title="Halaman Selanjutnya">→</button>`;
            }

            html += '</div>';
            container.innerHTML = html;
        }

        // Initialize pagination reliably
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSertaPagination);
        } else {
            initSertaPagination();
        }
    </script>
</body>
</html>
