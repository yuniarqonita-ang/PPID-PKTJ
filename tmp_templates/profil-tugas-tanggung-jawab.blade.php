<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Tugas dan Tanggung Jawab' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
            --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
        }
        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8faff;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('{{ $profil && $profil->image_hero ? asset("storage/profil/" . $profil->image_hero) : "https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070" }}');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .hero-tagline {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
        }
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .section-title {
            color: var(--primary-blue);
            font-weight: 800;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-gold);
            border-radius: 2px;
        }
        .rich-text {
            line-height: 1.8;
            font-size: 1.1rem;
            text-align: justify;
        }
        .responsibility-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #e2e8f0;
            margin: 20px 0;
        }
        .responsibility-table thead {
            background-color: var(--secondary-gold);
            color: #1e293b;
        }
        .responsibility-table th, .responsibility-table td {
            padding: 20px;
            border: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }
        .additional-section {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <h1 class="page-title">{{ $profil->judul ?? 'Tugas & Tanggung Jawab' }}</h1>
            <p class="hero-tagline">{{ $profil->tagline_hero ?? ($settings['hero_subtitle'] ?? 'Layanan Informasi Publik Terintegrasi dan Transparan') }}</p>
        </div>
    </div>

    <div class="container py-5 mb-5">
        <div class="content-box">
            @if($profil)
                <div class="rich-text mb-4">
                    {!! $profil->konten_pembuka !!}
                </div>

                @if(!$profil->konten_pembuka)
                    <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
                        <i class="fas fa-info-circle me-2"></i> Konten pembuka belum diatur di admin panel.
                    </div>
                @endif

                @if($profil->judul_sub || $profil->konten_detail)
                    <h3 class="section-title mt-5">{{ $profil->judul_sub ?? 'Detail Pelaksanaan Tugas' }}</h3>
                    <div class="rich-text">
                        {!! $profil->konten_detail !!}
                    </div>
                @endif

                {{-- Hardcoded Fallback for Table if no additional sections --}}
                @if(!$profil->additional_sections)
                    <div class="table-responsive mt-5">
                        <h4 class="fw-bold mb-3 text-primary"><i class="fas fa-users-cog me-2"></i>PPID Pelaksana UPT</h4>
                        <table class="responsibility-table shadow-sm rounded-3">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-clipboard-list me-2"></i>TANGGUNG JAWAB</th>
                                    <th><i class="fas fa-gavel me-2"></i>WEWENANG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul class="ps-3 mb-0">
                                            <li class="mb-2">Menyediakan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                            <li class="mb-2">Melakukan pengawasan terhadap pelaksanaan layanan Informasi sehingga dapat diakses dengan mudah;</li>
                                            <li>Meningkatkan sumber daya manusia dalam pelayanan Informasi;</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="ps-3 mb-0">
                                            <li class="mb-2">Memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                            <li class="mb-2">Mengajukan usulan daftar Informasi Publik dan Informasi dikecualikan kepada PPID Utama;</li>
                                            <li class="mb-2">Menjamin tersimpan dan terdokumentasi seluruh Informasi secara fisik;</li>
                                            <li>Menolak permohonan Informasi apabila Informasi yang dimohon termasuk Informasi yang dikecualikan.</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($profil->additional_sections)
                    @foreach($profil->additional_sections as $section)
                        <div class="additional-section">
                            <h3 class="section-title">{{ $section['title'] }}</h3>
                            <div class="rich-text text-dark">
                                {!! $section['content'] !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Konten Tugas & Tanggung Jawab belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
