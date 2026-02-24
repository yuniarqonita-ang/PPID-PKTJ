<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Berkala - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
        }
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block !important; 
                margin-top: 0; 
            } 
        }
        .dropdown-menu {
            z-index: 1050 !important;
        }
        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }
        .breadcrumb-container {
            background-color: #f0f0f0;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 30px;
        }
        .breadcrumb-container .breadcrumb {
            margin-bottom: 0;
        }
        .breadcrumb-container .breadcrumb-item a {
            color: #004a99;
            text-decoration: none;
        }
        .breadcrumb-container .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #004a99;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
            border-left: 4px solid #d4af37;
            padding-left: 15px;
        }
        p {
            text-align: justify;
            line-height: 1.8;
            color: #333;
        }
        .info-box {
            background-color: #e3f2fd;
            border-left: 4px solid #004a99;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 5px;
            display: flex;
            gap: 15px;
        }
        .info-box i {
            color: #004a99;
            font-size: 24px;
            flex-shrink: 0;
        }
        .info-box p {
            margin-bottom: 0;
            color: #1a3a52;
        }
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #1a3a52;
            color: white;
        }
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .table tbody td {
            padding: 12px 15px;
            border-color: #e9ecef;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .table a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .table a:hover {
            color: #d4af37;
            text-decoration: underline;
        }
        .file-icon {
            color: #d4af37;
            margin-right: 8px;
        }
        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .card-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
        }
        .card-item h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 15px;
        }
        .card-item p {
            margin-bottom: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <h1 class="page-title">Informasi Berkala</h1>

        <!-- BREADCRUMB -->
        <div class="breadcrumb-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Berkala</li>
                </ol>
            </nav>
        </div>

        <!-- INFO BOX -->
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <p><strong>Definisi:</strong> Informasi berkala adalah informasi yang disusun dan disiarkan oleh PPID secara berkala untuk memenuhi kebutuhan dasar masyarakat tentang kegiatan dan kinerja lembaga publik.</p>
        </div>

        <!-- 1. PROFIL KEMENTERIAN PERHUBUNGAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-building me-2" style="color: #d4af37;"></i>1. Profil Kementerian Perhubungan</h2>
            
            <p style="margin-bottom: 20px;">
                Kementerian Perhubungan memiliki struktur organisasi yang efisien dan terkoordinasi untuk menjalankan tugasnya. Berdasarkan <strong>Peraturan Menteri Perhubungan Nomor 4 Tahun 2025</strong> tentang Organisasi dan Tata Kerja Kementerian Perhubungan, terdapat beberapa unit organisasi, yaitu Sekretariat Jenderal, Direktorat Jenderal, Badan, Inspektorat Jenderal, Staf Ahli, serta Pusat. Setiap unit ini bertanggung jawab langsung kepada Menteri Perhubungan.
            </p>

            <p style="margin-bottom: 20px;">
                Menteri Perhubungan bertugas merumuskan, menetapkan, dan menjalankan kebijakan di bidang transportasi, yang mencakup pelayanan, keselamatan, keamanan, aksesibilitas, dan konektivitas. Menteri juga memberikan bimbingan teknis dan supervisi pelayanan transportasi di daerah untuk memastikan mobilitas masyarakat dan distribusi barang serta jasa berjalan lancar.
            </p>

            <p>
                <strong>Wakil Menteri Perhubungan</strong> membantu Menteri dalam memimpin pelaksanaan tugas kementerian. Tugas dan wewenangnya meliputi membantu perumusan dan pelaksanaan kebijakan, mengkoordinasikan pencapaian kebijakan strategis antar-unit organisasi, mewakili Menteri pada acara tertentu, dan menjalankan tugas lain yang diberikan oleh Menteri.
            </p>
        </div>

        <!-- 2. PROFIL PEJABAT KEMENTERIAN PERHUBUNGAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-users me-2" style="color: #d4af37;"></i>2. Profil Pejabat Kementerian Perhubungan</h2>
            
            <p style="font-style: italic; margin-bottom: 20px;">
                <strong>Deskripsi:</strong> Informasi mengenai Profil Pejabat Kementerian Perhubungan berupa Nama, Jabatan, Sejarah Karir, Sejarah Pendidikan, Penghargaan dan Laporan Kekayaan
            </p>

            <div class="grid-layout">
                <div class="card-item">
                    <h5>Menteri Perhubungan</h5>
                    <p><strong>Nama:</strong> [Nama Menteri]</p>
                    <p><strong>Jabatan:</strong> Menteri Perhubungan</p>
                </div>
                <div class="card-item">
                    <h5>Wakil Menteri Perhubungan</h5>
                    <p><strong>Nama:</strong> [Nama Wakil Menteri]</p>
                    <p><strong>Jabatan:</strong> Wakil Menteri Perhubungan</p>
                </div>
            </div>
        </div>

        <!-- 3. KEGIATAN, PROGRAM DAN RENCANA -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-tasks me-2" style="color: #d4af37;"></i>3. Kegiatan, Program dan Rencana</h2>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Jenis Rencana</th>
                            <th>Deskripsi</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rencana Jangka Panjang (RJP)</td>
                            <td>Rencana strategis pembangunan transportasi jangka panjang</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                        <tr>
                            <td>Rencana Strategis (Renstra)</td>
                            <td>Rencana strategis Kementerian Perhubungan periode 5 tahun</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                        <tr>
                            <td>Rencana Kerja Tahunan (RKT)</td>
                            <td>Rencana kerja tahunan yang dirancang untuk mencapai target strategis</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4. LAPORAN PELAKSANAAN KEGIATAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-chart-line me-2" style="color: #d4af37;"></i>4. Laporan Pelaksanaan Kegiatan</h2>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Jenis Laporan</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tahun 2024</td>
                            <td>Laporan Realisasi Kegiatan Triwulan I</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Laporan</a></td>
                        </tr>
                        <tr>
                            <td>Tahun 2024</td>
                            <td>Laporan Realisasi Kegiatan Triwulan II</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Laporan</a></td>
                        </tr>
                        <tr>
                            <td>Tahun 2024</td>
                            <td>Laporan Realisasi Kegiatan Triwulan III</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Laporan</a></td>
                        </tr>
                        <tr>
                            <td>Tahun 2024</td>
                            <td>Laporan Realisasi Kegiatan Triwulan IV</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Laporan</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. PERATURAN, KEPUTUSAN DAN ATAU KEBIJAKAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-file-contract me-2" style="color: #d4af37;"></i>5. Peraturan, Keputusan dan atau Kebijakan</h2>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nomor Peraturan</th>
                            <th>Judul</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Peraturan Menteri Perhubungan No. 4 Tahun 2025</td>
                            <td>Organisasi dan Tata Kerja Kementerian Perhubungan</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                        <tr>
                            <td>Peraturan Menteri Perhubungan No. 46 Tahun 2018</td>
                            <td>Pedoman Pengelolaan Informasi dan Dokumentasi di Kementerian Perhubungan</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                        <tr>
                            <td>Keputusan Menteri Perhubungan No. KM 117 Tahun 2022</td>
                            <td>Standar Operasional Prosedur PPID di Kementerian Perhubungan</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Lihat Dokumen</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 6. KEPUTUSAN DAN KEBIJAKAN STRATEGIS -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-gavel me-2" style="color: #d4af37;"></i>6. Keputusan dan Kebijakan Strategis</h2>
            
            <p style="margin-bottom: 20px;">
                Keputusan dan kebijakan strategis Kementerian Perhubungan mencakup berbagai aspek pengembangan transportasi nasional, termasuk:
            </p>

            <ul style="margin-bottom: 20px;">
                <li>Kebijakan pengembangan sistem transportasi yang berkelanjutan</li>
                <li>Strategi peningkatan keselamatan transportasi darat, laut, dan udara</li>
                <li>Program modernisasi infrastruktur transportasi</li>
                <li>Kebijakan logistik nasional</li>
                <li>Pengembangan transportasi publik dan massal</li>
            </ul>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Keputusan/Kebijakan</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kebijakan Transportasi Berkelanjutan 2024-2029</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Download</a></td>
                        </tr>
                        <tr>
                            <td>Strategi Peningkatan Keselamatan Transportasi</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 7. INFORMASI DAN PENGADUAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-phone me-2" style="color: #d4af37;"></i>7. Informasi dan Pengaduan</h2>
            
            <p style="margin-bottom: 20px;">
                Masyarakat dapat menghubungi PPID Kementerian Perhubungan melalui berbagai saluran komunikasi yang tersedia:
            </p>

            <div class="grid-layout">
                <div class="card-item">
                    <h5><i class="fas fa-map-marker-alt me-2" style="color: #d4af37;"></i>Alamat</h5>
                    <p>Jl. Medan Merdeka Barat No. 8</p>
                    <p>Jakarta Pusat 10110</p>
                </div>
                <div class="card-item">
                    <h5><i class="fas fa-phone me-2" style="color: #d4af37;"></i>Telepon</h5>
                    <p>(021) 3501-441</p>
                    <p>Ext. PPID</p>
                </div>
                <div class="card-item">
                    <h5><i class="fas fa-envelope me-2" style="color: #d4af37;"></i>Email</h5>
                    <p>ppid@kemenhub.go.id</p>
                    <p>pengaduan@kemenhub.go.id</p>
                </div>
                <div class="card-item">
                    <h5><i class="fas fa-globe me-2" style="color: #d4af37;"></i>Website</h5>
                    <p>www.kemenhub.go.id</p>
                    <p>portal.iku.gov.id</p>
                </div>
            </div>
        </div>

        <!-- 8. DAFTAR INFORMASI PUBLIK -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-list me-2" style="color: #d4af37;"></i>8. Daftar Informasi Publik</h2>
            
            <p style="margin-bottom: 20px;">
                Daftar informasi publik yang tersedia dan dapat diakses oleh masyarakat:
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Informasi</th>
                            <th>Status Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Profil Organisasi dan Struktur</td>
                            <td><span class="badge bg-success">Terbuka</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laporan Keuangan dan Aset</td>
                            <td><span class="badge bg-success">Terbuka</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Program dan Kegiatan Strategis</td>
                            <td><span class="badge bg-success">Terbuka</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Pengaduan dan Tindak Lanjut</td>
                            <td><span class="badge bg-success">Terbuka</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 9. STATISTIK DAN INFORMASI TRANSPORTASI -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-chart-bar me-2" style="color: #d4af37;"></i>9. Statistik dan Informasi Transportasi</h2>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sektor Transportasi</th>
                            <th>Tahun 2023</th>
                            <th>Tahun 2024</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Transportasi Darat (Jalan) - Volume (Juta Kendaraan)</td>
                            <td>142.5</td>
                            <td>155.3</td>
                        </tr>
                        <tr>
                            <td>Transportasi Laut - Jumlah Kapal Terdaftar</td>
                            <td>28,456</td>
                            <td>29,102</td>
                        </tr>
                        <tr>
                            <td>Transportasi Udara - Penumpang (Juta Orang)</td>
                            <td>105.2</td>
                            <td>118.7</td>
                        </tr>
                        <tr>
                            <td>Transportasi Pipa - Kapasitas (Juta Ton)</td>
                            <td>45.8</td>
                            <td>48.2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 10. INFORMASI REALISASI PENYERAPAN KEUANGAN -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-money-bill-wave me-2" style="color: #d4af37;"></i>10. Informasi Realisasi Penyerapan Keuangan</h2>
            
            <p style="margin-bottom: 20px;">
                <strong>Rincian Penyerapan Anggaran Tahun 2024:</strong>
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Anggaran (Rp Juta)</th>
                            <th>Realisasi (Rp Juta)</th>
                            <th>Persentase (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Januari</td>
                            <td>500,000</td>
                            <td>125,000</td>
                            <td>25%</td>
                        </tr>
                        <tr>
                            <td>Februari</td>
                            <td>500,000</td>
                            <td>180,000</td>
                            <td>36%</td>
                        </tr>
                        <tr>
                            <td>Maret</td>
                            <td>500,000</td>
                            <td>220,000</td>
                            <td>44%</td>
                        </tr>
                        <tr>
                            <td>April</td>
                            <td>500,000</td>
                            <td>275,000</td>
                            <td>55%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 11. INFORMASI PROSEDUR EVAKUASI DARURAT -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-exclamation-triangle me-2" style="color: #d4af37;"></i>11. Informasi Prosedur Evakuasi Darurat</h2>
            
            <p style="margin-bottom: 20px;">
                Prosedur evakuasi darurat di lingkungan Kementerian Perhubungan dirancang untuk memastikan keselamatan seluruh pegawai dan pengunjung:
            </p>

            <ul style="margin-bottom: 20px;">
                <li><strong>Titik Kumpul Utama:</strong> Halaman depan gedung utama (Lapangan Medan Merdeka)</li>
                <li><strong>Titik Kumpul Cadangan:</strong> Halaman samping Gedung PPID (jika akses utama terhambat)</li>
                <li><strong>Saluran Komunikasi Darurat:</strong> (021) 3501-441 Ext. Keamanan</li>
                <li><strong>Penanggung Jawab Evakuasi:</strong> Kepala Bagian Keamanan Kementerian</li>
            </ul>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Jenis Darurat</th>
                            <th>Prosedur</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bencana Alam (Gempa, Banjir)</td>
                            <td>Evakuasi ke titik kumpul terdekat, koordinasi dengan posko darurat</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">SOP</a></td>
                        </tr>
                        <tr>
                            <td>Kebakaran</td>
                            <td>Aktifkan alarm, gunakan tangga darurat, hindari lift, kumpul di titik aman</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">SOP</a></td>
                        </tr>
                        <tr>
                            <td>Keadaan Darurat Lainnya</td>
                            <td>Mengikuti instruksi petugas keamanan dan unit penanganan darurat</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">SOP</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 12. LAPORAN KEUANGAN AUDITED -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-balance-scale me-2" style="color: #d4af37;"></i>12. Laporan Keuangan Audited</h2>
            
            <p style="margin-bottom: 20px;">
                Laporan keuangan tahunan Kementerian Perhubungan yang telah diaudit oleh Badan Pemeriksa Keuangan (BPK):
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tahun Anggaran</th>
                            <th>Jenis Laporan</th>
                            <th>Opini BPK</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2023</td>
                            <td>Laporan Keuangan Tahunan</td>
                            <td><span class="badge bg-success">WTP (Wajar Tanpa Pengecualian)</span></td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Laporan</a></td>
                        </tr>
                        <tr>
                            <td>2022</td>
                            <td>Laporan Keuangan Tahunan</td>
                            <td><span class="badge bg-success">WTP (Wajar Tanpa Pengecualian)</span></td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Laporan</a></td>
                        </tr>
                        <tr>
                            <td>2021</td>
                            <td>Laporan Keuangan Tahunan</td>
                            <td><span class="badge bg-success">WTP (Wajar Tanpa Pengecualian)</span></td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Laporan</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 13. INFORMASI PROGRAM/KEGIATAN STRATEGIS -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-rocket me-2" style="color: #d4af37;"></i>13. Informasi Program/Kegiatan Strategis</h2>
            
            <p style="margin-bottom: 20px;">
                Program dan kegiatan strategis yang menjadi prioritas utama Kementerian Perhubungan:
            </p>

            <div class="grid-layout">
                <div class="card-item">
                    <h5>Program Transportasi Berkelanjutan</h5>
                    <p><strong>Tahun:</strong> 2024-2029</p>
                    <p><strong>Target:</strong> Meningkatkan efisiensi transportasi dan mengurangi emisi</p>
                    <p><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Detail</a></p>
                </div>
                <div class="card-item">
                    <h5>Pengembangan Infrastruktur Transportasi</h5>
                    <p><strong>Tahun:</strong> 2024-2029</p>
                    <p><strong>Target:</strong> Modernisasi dan perluasan jaringan transportasi</p>
                    <p><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Detail</a></p>
                </div>
                <div class="card-item">
                    <h5>Peningkatan Keselamatan Transportasi</h5>
                    <p><strong>Tahun:</strong> 2024-2029</p>
                    <p><strong>Target:</strong> Mengurangi angka kecelakaan transportasi</p>
                    <p><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Detail</a></p>
                </div>
                <div class="card-item">
                    <h5>Program Logistik Nasional</h5>
                    <p><strong>Tahun:</strong> 2024-2029</p>
                    <p><strong>Target:</strong> Optimalisasi efisiensi sistem logistik nasional</p>
                    <p><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Detail</a></p>
                </div>
            </div>
        </div>

        <!-- 14. RENCANA UMUM PENGADAAN SESUAI SIRUP -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-shopping-cart me-2" style="color: #d4af37;"></i>14. Rencana Umum Pengadaan Sesuai SIRUP</h2>
            
            <p style="margin-bottom: 20px;">
                Rencana Umum Pengadaan (RUP) Kementerian Perhubungan yang telah didaftarkan dalam Sistem Informasi Rencana Umum Pengadaan (SIRUP) Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (Kemenpan RB):
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tahun Anggaran</th>
                            <th>Jumlah Paket Pengadaan</th>
                            <th>Nilai Pengadaan (Rp Juta)</th>
                            <th>Dokumen RUP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024</td>
                            <td>245</td>
                            <td>1,250,000</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">RUP 2024</a></td>
                        </tr>
                        <tr>
                            <td>2023</td>
                            <td>210</td>
                            <td>1,080,000</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">RUP 2023</a></td>
                        </tr>
                        <tr>
                            <td>2022</td>
                            <td>195</td>
                            <td>950,000</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">RUP 2022</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="margin-top: 20px;">
                <strong>Link SIRUP Kemenpan RB:</strong> <a href="http://sirup.pemproc.go.id" target="_blank">http://sirup.pemproc.go.id</a>
            </p>
        </div>

        <!-- 15. WAJIB LHKSN (LAPORAN HARTA KEKAYAAN) -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-file-signature me-2" style="color: #d4af37;"></i>15. WAJIB LHKSN (Laporan Harta Kekayaan)</h2>
            
            <p style="margin-bottom: 20px;">
                Laporan Harta Kekayaan Satuan Negara (LHKSN) dari pejabat-pejabat Kementerian Perhubungan sesuai amandat Undang-Undang Nomor 8 Tahun 1997 tentang Dokumen Perusahaan dan Undang-Undang Nomor 28 Tahun 1999 tentang Penyelenggaraan Negara Yang Bersih dan Bebas dari Korupsi, Kolusi, dan Nepotisme (Tap MPR No. XI/MPR/1998):
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pejabat</th>
                            <th>Jabatan</th>
                            <th>Tahun Pelaporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Menteri Perhubungan</td>
                            <td>Menteri</td>
                            <td>2024</td>
                            <td><span class="badge bg-info">Terlapor</span></td>
                        </tr>
                        <tr>
                            <td>Wakil Menteri Perhubungan</td>
                            <td>Wakil Menteri</td>
                            <td>2024</td>
                            <td><span class="badge bg-info">Terlapor</span></td>
                        </tr>
                        <tr>
                            <td>Sekretaris Jenderal</td>
                            <td>Pejabat Tinggi</td>
                            <td>2024</td>
                            <td><span class="badge bg-info">Terlapor</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="margin-top: 20px;">
                <strong>Catatan:</strong> Data LHKSN merupakan dokumen negara yang kerahasiaannya dijaga sesuai ketentuan peraturan perundang-undangan yang berlaku.
            </p>
        </div>

        <!-- 16. PENGADAAN BARANG DAN JASA -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-box me-2" style="color: #d4af37;"></i>16. Pengadaan Barang dan Jasa</h2>
            
            <p style="margin-bottom: 20px;">
                Informasi tentang pengadaan barang dan jasa yang dilakukan oleh Kementerian Perhubungan:
            </p>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pengadaan Barang</td>
                            <td>Peralatan kantor, kendaraan operasional, dan peralatan transportasi</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Katalog</a></td>
                        </tr>
                        <tr>
                            <td>Pengadaan Jasa</td>
                            <td>Jasa konsultansi, layanan teknis, dan jasa pendukung lainnya</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Katalog</a></td>
                        </tr>
                        <tr>
                            <td>Pengadaan Konstruksi</td>
                            <td>Pembangunan infrastruktur transportasi dan perbaikan fasilitas</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Katalog</a></td>
                        </tr>
                        <tr>
                            <td>Pengadaan Lainnya</td>
                            <td>Pemeliharaan, renovasi, dan pengembangan aset Kementerian</td>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Katalog</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="margin-top: 20px;">
                <strong>Portal e-Procurement:</strong> <a href="https://lpse.kemenhub.go.id" target="_blank">https://lpse.kemenhub.go.id</a>
            </p>
        </div>

        <!-- 17. INFORMASI KHUSUS PELAYANAN PUBLIK -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-handshake me-2" style="color: #d4af37;"></i>17. Informasi Khusus Pelayanan Publik</h2>
            
            <p style="margin-bottom: 20px;">
                Informasi khusus mengenai layanan-layanan publik yang disediakan oleh Kementerian Perhubungan untuk memudahkan akses masyarakat:
            </p>

            <h5 style="color: #004a99; margin-top: 20px; margin-bottom: 15px;">Jam Operasional Layanan</h5>
            <ul style="margin-bottom: 20px;">
                <li><strong>Hari Kerja (Senin-Jumat):</strong> 08:00 - 16:30 WIB</li>
                <li><strong>Istirahat Siang:</strong> 12:00 - 13:00 WIB</li>
                <li><strong>Hari Libur:</strong> Tutup (Sabtu, Minggu, dan Hari Raya)</li>
            </ul>

            <h5 style="color: #004a99; margin-bottom: 15px;">Saluran Komunikasi Pelayanan</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Saluran</th>
                            <th>Kontak</th>
                            <th>Jam Layanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Telepon PPID</td>
                            <td>(021) 3501-441 Ext. PPID</td>
                            <td>08:00 - 16:30</td>
                        </tr>
                        <tr>
                            <td>Email PPID</td>
                            <td>ppid@kemenhub.go.id</td>
                            <td>24/7 (Dibalas pada jam kerja)</td>
                        </tr>
                        <tr>
                            <td>Email Pengaduan</td>
                            <td>pengaduan@kemenhub.go.id</td>
                            <td>24/7 (Dibalas pada jam kerja)</td>
                        </tr>
                        <tr>
                            <td>Portal Online</td>
                            <td>www.kemenhub.go.id</td>
                            <td>24/7</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h5 style="color: #004a99; margin-top: 20px; margin-bottom: 15px;">Panduan Akses Informasi Publik</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Panduan Permohonan Informasi Publik</a></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Panduan Akses Informasi Publik untuk Penyandang Disabilitas</a></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-pdf file-icon"></i><a href="#" target="_blank">Informasi Layanan Untuk Penyandang Disabilitas</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/informasi-berkala.blade.php ENDPATH**/ ?>