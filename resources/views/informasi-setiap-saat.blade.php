<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Setiap Saat - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
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
                <i class="fas fa-clock me-1"></i> Daftar Informasi Publik (DIP)
            </div>
            <h1 class="display-5 fw-bold outfit text-uppercase mb-2">Informasi Setiap Saat</h1>
            <p class="lead opacity-90 mx-auto mb-0" style="max-width: 800px; font-size: 15px;">
                Daftar informasi publik yang disediakan dan dapat diakses sewaktu-waktu oleh masyarakat di lingkungan PKTJ Tegal.
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
                            <input type="text" id="topSearchInputSetiapSaat" placeholder="Cari dokumen, pedoman, SK, atau informasi setiap saat..." onkeyup="filterSetiapSaatContent()" class="form-control ps-5 rounded-pill border-2 bg-light" style="font-size: 13.5px;">
                        </div>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-lg-end align-items-center gap-2">
                        <span class="text-muted small me-1">Mode Tampilan:</span>
                        <button type="button" id="btnModeTableSetiap" class="btn btn-primary btn-sm rounded-pill px-3 py-1.5 fw-bold" onclick="switchSetiapDisplay('table')">
                            <i class="fas fa-table-list me-1"></i> Tampilan Tabel DIP
                        </button>
                        <button type="button" id="btnModeCardsSetiap" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5 fw-bold" onclick="switchSetiapDisplay('cards')">
                            <i class="fas fa-th-large me-1"></i> Tampilan Kartu
                        </button>
                    </div>
                </div>
            </div>

            @include('components.konten-dinamis', ['prefix' => 'informasi_setiapsaat'])

            <!-- 1. TABEL VIEW (STANDAR RESMI POLTRADA & KEMENHUB - 9 KOLOM) -->
            <div id="setiapTableView" class="table-responsive rounded-3 border mb-3" style="border-color: #e2e8f0;">
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
                                                            <tbody id="setiapTableBody">
                        <!-- KELOMPOK: INFORMASI OPERASIONAL & PEDOMAN POKOK -->
                        <tr class="table-light fw-bold">
                            <td colspan="9" class="py-2 px-3 text-uppercase" style="background: #e0f2fe; color: #004a99; font-size: 12px; letter-spacing: 0.5px;">
                                <i class="fas fa-book me-2"></i> PEDOMAN, KEBIJAKAN & INFORMASI POKOK
                            </td>
                        </tr>

                        <tr class="searchable-setiapsaat-row" data-keywords="dokumentasi kegiatan pimpinan direktur manajemen rapat koordinasi dinas">
                            <td class="text-center fw-bold">1</td>
                            <td><strong class="text-dark">Dokumentasi Kegiatan Pimpinan PKTJ</strong></td>
                            <td class="text-muted">Informasi dan dokumentasi agenda pimpinan, rapat koordinasi kedinasan, kunjungan kerja, serta kegiatan institusi PKTJ Tegal.</td>
                            <td>PPID Pelaksana UPT PKTJ Tegal</td>
                            <td>Subbagian Tata Usaha & Rumah Tangga</td>
                            <td class="text-center"><span class="badge bg-light text-dark border">Softcopy</span></td>
                            <td class="text-center">Tegal, 2025</td>
                            <td class="text-center">1 Tahun</td>
                            <td class="text-center">
                                <a href="{{ route('profil.pejabat') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                    Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </td>
                        </tr>

                        <tr class="searchable-setiapsaat-row" data-keywords="peraturan keputusan kebijakan institusi surat edaran direktur ppid">
                            <td class="text-center fw-bold">2</td>
                            <td><strong class="text-dark">Peraturan, Keputusan, dan Kebijakan PKTJ</strong></td>
                            <td class="text-muted">Himpunan surat keputusan, peraturan dinas internal, dan kebijakan strategis direktur di lingkungan Politeknik Keselamatan Transportasi Jalan.</td>
                            <td>PPID Pelaksana UPT PKTJ Tegal</td>
                            <td>Bagian Keuangan dan Umum</td>
                            <td class="text-center"><span class="badge bg-light text-dark border">Hardcopy & Softcopy</span></td>
                            <td class="text-center">Tegal, 2025</td>
                            <td class="text-center">1 Tahun</td>
                            <td class="text-center">
                                <a href="{{ route('profil.regulasi') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                    Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </td>
                        </tr>

                        <tr class="searchable-setiapsaat-row" data-keywords="informasi kurikulum silabus pendidikan pelatihan vokasi transportasi darat sk direktur">
                            <td class="text-center fw-bold">3</td>
                            <td><strong class="text-dark">Informasi Kurikulum dan Silabus Diklat PKTJ</strong></td>
                            <td class="text-muted">Keputusan Direktur PKTJ tentang penetapan kurikulum vokasi dan silabus pendidikan pelatihan bidang keselamatan jalan.</td>
                            <td>PPID Pelaksana UPT PKTJ Tegal</td>
                            <td>Bagian Akademik & Ketarunaan</td>
                            <td class="text-center"><span class="badge bg-light text-dark border">Softcopy</span></td>
                            <td class="text-center">Tegal, 2025</td>
                            <td class="text-center">1 Tahun</td>
                            <td class="text-center">
                                <a href="https://pktj.ac.id" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                    Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </td>
                        </tr>

                        <tr class="searchable-setiapsaat-row" data-keywords="daftar nama fungsional dosen instruktur tenaga pendidik lektor asisten ahli">
                            <td class="text-center fw-bold">4</td>
                            <td><strong class="text-dark">Daftar Nama Fungsional Dosen & Instruktur PKTJ</strong></td>
                            <td class="text-muted">Informasi daftar nama, jenjang fungsional, dan bidang keahlian dosen serta instruktur pengajar di lingkungan PKTJ Tegal.</td>
                            <td>PPID Pelaksana UPT PKTJ Tegal</td>
                            <td>Bagian Akademik & Ketarunaan</td>
                            <td class="text-center"><span class="badge bg-light text-dark border">Softcopy</span></td>
                            <td class="text-center">Tegal, 2025</td>
                            <td class="text-center">1 Tahun</td>
                            <td class="text-center">
                                <a href="https://pktj.ac.id" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                    Disini <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- DOKUMEN DINAMIS DARI DATABASE -->
                        @if(isset($items) && $items->count() > 0)
                        <tr class="table-light fw-bold">
                            <td colspan="9" class="py-2 px-3 text-uppercase" style="background: #e0f2fe; color: #004a99; font-size: 12px; letter-spacing: 0.5px;">
                                <i class="fas fa-database me-2"></i> ARSIP DOKUMEN & PEDOMAN PUBLIK LAINNYA
                            </td>
                        </tr>
                        @foreach($items as $idx => $it)
                        @php
                            $rowNo = $idx + 5;
                            $cleanDesc = Str::limit(strip_tags($it->deskripsi ?? ''), 130);
                            if (empty($cleanDesc) || $cleanDesc === 'Tidak ada deskripsi') {
                                $cleanDesc = 'Dokumen arsip informasi setiap saat resmi PPID Politeknik Keselamatan Transportasi Jalan.';
                            }
                            $tahun = \Carbon\Carbon::parse($it->tanggal ?? $it->created_at)->format('Y');
                        @endphp
                        <tr class="searchable-setiapsaat-row" data-keywords="{{ strtolower($it->judul . ' ' . $cleanDesc) }}">
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
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION CONTROLS -->
            <div class="p-3 bg-light border rounded-3 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div id="setiapPaginationInfo" class="text-muted small fw-medium">
                        Menampilkan data...
                    </div>
                    <div class="d-flex align-items-center gap-1.5 ms-md-2">
                        <span class="text-muted small">Tampilkan:</span>
                        <select class="form-select form-select-sm py-0 px-2" style="width: auto; font-size: 12px; height: 28px;" onchange="changeSetiapPageSize(this.value)">
                            <option value="10">10 data</option>
                            <option value="25">25 data</option>
                            <option value="50" selected>50 data</option>
                            <option value="all">Semua data</option>
                        </select>
                    </div>
                </div>
                <div id="setiapPaginationControls">
                    <!-- Filled by JS -->
                </div>
            </div>

            <!-- 2. CARDS VIEW (ALTERNATIF TAMPILAN KARTU) -->
            <div id="setiapCardsView" style="display: none;" class="mt-4">
                <div class="row" id="setiapItemsContainer">
                    @forelse($items as $item)
                        <div class="col-12 searchable-setiapsaat-card-item" data-keywords="{{ strtolower($item->judul . ' ' . strip_tags($item->deskripsi)) }}">
                            <div class="info-item hover-lift">
                                <div class="d-flex align-items-start flex-column flex-md-row gap-4">
                                    <div class="info-icon" style="width: 50px; height: 50px; border-radius: 14px; background: #e0f2fe; color: #004a99; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                        <i class="fas fa-clock"></i>
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
                            <i class="fas fa-folder-open fa-4x text-muted mb-4 opacity-25"></i>
                            <h4 class="text-muted outfit fw-bold">Belum Ada Arsip Tambahan</h4>
                            <p class="text-muted">Arsip informasi setiap saat di atas merupakan daftar resmi yang dikuasai PKTJ Tegal.</p>
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

        function switchSetiapDisplay(mode) {
            const tbl = document.getElementById('setiapTableView');
            const crd = document.getElementById('setiapCardsView');
            const btnTbl = document.getElementById('btnModeTableSetiap');
            const btnCrd = document.getElementById('btnModeCardsSetiap');

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
                function changeSetiapPageSize(val) {
            setiapRowsPerPage = val === 'all' ? 9999 : parseInt(val);
            currentSetiapPage = 1;
            initSetiapPagination();
        }

        let currentSetiapPage = 1;
        let setiapRowsPerPage = 50;
        let filteredSetiapRows = [];

        function initSetiapPagination() {
            const allRows = Array.from(document.querySelectorAll('#setiapTableBody tr.searchable-setiapsaat-row'));
            const searchInput = document.getElementById('topSearchInputSetiapSaat');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

            filteredSetiapRows = allRows.filter(row => {
                const kw = row.getAttribute('data-keywords') || '';
                const text = row.innerText.toLowerCase();
                return !query || kw.includes(query) || text.includes(query);
            });

            const totalPages = Math.ceil(filteredSetiapRows.length / setiapRowsPerPage) || 1;
            if (currentSetiapPage > totalPages) currentSetiapPage = 1;

            renderSetiapTablePage();
            renderSetiapPaginationControls();
        }

        function renderSetiapTablePage() {
            const allRows = document.querySelectorAll('#setiapTableBody tr.searchable-setiapsaat-row');
            allRows.forEach(r => r.style.display = 'none');

            const total = filteredSetiapRows.length;
            const startIdx = (currentSetiapPage - 1) * setiapRowsPerPage;
            const endIdx = Math.min(startIdx + setiapRowsPerPage, total);

            for (let i = startIdx; i < endIdx; i++) {
                if (filteredSetiapRows[i]) {
                    filteredSetiapRows[i].style.display = '';
                }
            }

            const sectionHeaders = document.querySelectorAll('#setiapTableBody tr.table-light');
            sectionHeaders.forEach(sh => {
                sh.style.display = total === 0 ? 'none' : '';
            });

            const infoEl = document.getElementById('setiapPaginationInfo');
            if (infoEl) {
                if (total === 0) {
                    infoEl.innerHTML = '<span class="text-danger"><i class="fas fa-search me-1"></i> Tidak ada informasi setiap saat yang cocok dengan pencarian.</span>';
                } else {
                    infoEl.innerHTML = `Menampilkan baris <strong>${startIdx + 1}</strong> - <strong>${endIdx}</strong> dari total <strong>${total}</strong> data informasi publik`;
                }
            }
        }

        function goToSetiapPage(page) {
            const totalPages = Math.ceil(filteredSetiapRows.length / setiapRowsPerPage) || 1;
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;
            currentSetiapPage = page;
            renderSetiapTablePage();
            renderSetiapPaginationControls();

            const tbl = document.getElementById('setiapTableView');
            if (tbl) tbl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function renderSetiapPaginationControls() {
            const container = document.getElementById('setiapPaginationControls');
            if (!container) return;

            const totalPages = Math.ceil(filteredSetiapRows.length / setiapRowsPerPage) || 1;
            if (totalPages <= 1 && filteredSetiapRows.length <= setiapRowsPerPage) {
                container.innerHTML = '<span class="badge bg-white text-muted border px-2.5 py-1.5 rounded-pill">Halaman 1 dari 1</span>';
                return;
            }

            let html = '<ul class="pagination pagination-sm mb-0 gap-1 d-flex flex-wrap">';
            
            if (currentSetiapPage > 1) {
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToSetiapPage(1)" title="Halaman Pertama"><i class="fas fa-angles-left"></i></button></li>`;
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToSetiapPage(${currentSetiapPage - 1})"><i class="fas fa-chevron-left me-1"></i> Prev</button></li>`;
            }

            for (let p = 1; p <= totalPages; p++) {
                const active = p === currentSetiapPage ? 'btn-primary text-white active font-black' : 'btn-outline-secondary text-dark';
                html += `<li class="page-item"><button type="button" class="btn btn-sm ${active} rounded-pill px-3 fw-bold" onclick="goToSetiapPage(${p})">${p}</button></li>`;
            }

            if (currentSetiapPage < totalPages) {
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToSetiapPage(${currentSetiapPage + 1})">Next <i class="fas fa-chevron-right ms-1"></i></button></li>`;
                html += `<li class="page-item"><button type="button" class="page-link rounded-pill px-3 fw-bold" onclick="goToSetiapPage(${totalPages})" title="Halaman Terakhir"><i class="fas fa-angles-right"></i></button></li>`;
            }

            html += '</ul>';
            container.innerHTML = html;
        }

        function filterSetiapSaatContent() {
            const searchInput = document.getElementById('topSearchInputSetiapSaat');
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

            // Filter cards
            document.querySelectorAll('.searchable-setiapsaat-card-item').forEach(el => {
                const kw = el.getAttribute('data-keywords') || '';
                if (!query || kw.includes(query) || el.innerText.toLowerCase().includes(query)) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });

            currentSetiapPage = 1;
            initSetiapPagination();
        }

        document.addEventListener('DOMContentLoaded', function() {
            initSetiapPagination();
        });
    </script>
</body>
</html>
