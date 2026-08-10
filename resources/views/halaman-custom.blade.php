<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $menu->nama }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts & Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
        }
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f8faff;
            color: #1e293b;
            line-height: 1.6;
        }
        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero Banner */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.9), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }

        .content-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 74, 153, 0.05);
            margin-top: -60px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            margin-bottom: 50px;
            position: relative;
            z-index: 20;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 30px;
            border-left: 6px solid var(--secondary-gold);
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: -1.5px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }
        
        .rich-content {
            text-align: justify;
            font-size: 1.05rem;
            color: #334155;
        }
        
        .rich-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .rich-content table th, .rich-content table td {
            border: 1px solid #e2e8f0;
            padding: 12px;
        }
        
        .rich-content table th {
            background-color: #f8fafc;
            font-weight: 700;
        }

        /* Flow Chart CSS Mockup */
        .chart-box {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            margin-top: 30px;
        }

        .flow-step {
            background: white;
            border-radius: 12px;
            padding: 15px 25px;
            display: inline-block;
            font-weight: 700;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            box-shadow: 0 4px 12px rgba(0,74,153,0.05);
            margin: 10px;
            position: relative;
        }
        
        .flow-arrow {
            color: var(--secondary-gold);
            font-size: 1.5rem;
            margin: 10px 0;
            display: block;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    @include('navigation')

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-2" data-aos="fade-down">{{ $menu->nama }}</h1>
            <p class="lead opacity-75 mb-0" data-aos="fade-up">Halaman Informasi Publik PPID PKTJ</p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <div class="content-card" data-aos="fade-up">
            
            <!-- 1. TEXT EDITOR CONTENT -->
            @if($menu->is_editor && $menu->konten)
                <div class="rich-content mb-5">
                    {!! $menu->konten !!}
                </div>
            @endif

            <!-- 2. DIAGRAM / CHART MODULE -->
            @if($menu->is_chart)
                <div class="mb-5">
                    <h2 class="section-title">Alur / Bagan Prosedur</h2>
                    <div class="chart-box">
                        <div class="flow-step">1. Pengajuan Permohonan</div>
                        <div class="flow-arrow"><i class="fas fa-arrow-down"></i></div>
                        <div class="flow-step">2. Verifikasi & Registrasi Data</div>
                        <div class="flow-arrow"><i class="fas fa-arrow-down"></i></div>
                        <div class="flow-step">3. Pengolahan Data & Dokumen</div>
                        <div class="flow-arrow"><i class="fas fa-arrow-down"></i></div>
                        <div class="flow-step">4. Penyerahan Hasil Kepada Pemohon</div>
                    </div>
                </div>
            @endif

            <!-- 3. TABLE MODULE -->
            @if($menu->is_table)
                <div class="mb-5">
                    <h2 class="section-title">Daftar Dokumen Pendukung</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light text-primary font-bold">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Judul Dokumen / Informasi</th>
                                    <th>Format</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="fw-bold">Pedoman Pelaksanaan Keterbukaan Informasi Publik</td>
                                    <td><span class="badge bg-danger">PDF</span></td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                    <td><button class="btn btn-sm btn-primary w-100"><i class="fas fa-eye"></i> Preview</button></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="fw-bold">Laporan Realisasi Anggaran PPID PKTJ</td>
                                    <td><span class="badge bg-danger">PDF</span></td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                    <td><button class="btn btn-sm btn-primary w-100"><i class="fas fa-eye"></i> Preview</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- 4. CONTACT / FEEDBACK FORM MODULE -->
            @if($menu->is_form)
                <div class="mb-5">
                    <h2 class="section-title">Form Hubungi Kami / Pengaduan</h2>
                    <div class="bg-light p-5 rounded-4 border border-slate-100">
                        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Formulir berhasil dikirim (Mockup)!');">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label font-bold text-slate-700">Nama Lengkap</label>
                                    <input type="text" class="form-control py-3" placeholder="Masukkan nama Anda..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label font-bold text-slate-700">Alamat Email</label>
                                    <input type="email" class="form-control py-3" placeholder="Masukkan email Anda..." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label font-bold text-slate-700">Judul Pengaduan / Pertanyaan</label>
                                    <input type="text" class="form-control py-3" placeholder="Subjek pesan..." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label font-bold text-slate-700">Detail Pertanyaan / Isi Pengaduan</label>
                                    <textarea class="form-control" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5 py-3 fw-bold uppercase" style="background-color: var(--primary-blue); border: none;">Kirim Formulir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @include('footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
