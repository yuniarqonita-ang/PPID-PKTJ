<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Struktur Organisasi' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8faff; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

                /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 74, 153, 0.05);
            margin-top: -60px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            position: relative;
            z-index: 20;
            margin-bottom: 50px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 30px;
            border-left: 6px solid var(--secondary-gold);
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }

        /* Organizational Chart Styling */
        .org-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 0;
            gap: 20px;
        }
        .org-group-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            background: rgba(0, 74, 153, 0.05);
            padding: 10px 24px;
            border-radius: 30px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 74, 153, 0.1);
            display: inline-block;
            font-family: 'Outfit', sans-serif;
        }
        .org-card {
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 74, 153, 0.06);
            border: 1px solid #e2e8f0;
            min-width: 230px;
            max-width: 280px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .org-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 74, 153, 0.12);
            border-color: var(--primary-blue);
        }
        .org-card.level-1 {
            background: linear-gradient(135deg, var(--primary-blue), #002d62);
            color: white;
            border: 2px solid var(--secondary-gold);
            min-width: 320px;
        }
        .org-card.level-1 .role-name {
            color: #ffffff !important;
            opacity: 0.95;
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .org-card .role-name {
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .org-card .person-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.4;
        }
        .org-card.level-1 .person-name {
            color: white;
            font-size: 1.15rem;
        }
        .org-level-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
        }
        .org-connector {
            width: 2px;
            height: 40px;
            background: linear-gradient(to bottom, var(--secondary-gold), var(--primary-blue));
            margin: 0 auto;
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
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Struktur Organisasi' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Susunan Organisasi Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @if($profil)
                @php
                    $videoUrl = $settings['struktur_youtube_link'] ?? null;
                    $embedUrl = null;
                    if ($videoUrl) {
                        $videoUrl = trim($videoUrl);
                        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/i';
                        if (preg_match($pattern, $videoUrl, $matches)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $matches[1];
                        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoUrl)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $videoUrl;
                        }
                    }
                @endphp

                @if($embedUrl)
                    <div class="video-container mb-5 rounded-4 overflow-hidden shadow-sm border border-slate-100">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                @if($profil->konten_pembuka)
                    <div class="mb-5 rich-content">
                        <h2 class="section-title">Dasar Struktur</h2>
                        <div class="text-justify">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    </div>
                @endif

                @if($profil->additional_sections)
                    @foreach($profil->additional_sections as $section)
                        <div class="mb-5">
                            <h2 class="section-title">{{ $section['title'] }}</h2>
                            
                            @if(($section['layout'] ?? 'default') === 'diagram')
                                <div class="org-container">
                                    <!-- Level 1 -->
                                    <div class="org-group-title" data-aos="fade-down">Tingkat 1: Pelaksana UPT</div>
                                    <div class="org-level-row">
                                        <div class="org-card level-1 hover-lift" data-aos="zoom-in">
                                            <div class="role-name">{{ $settings['struktur_l1_role'] ?? 'PPID Pelaksana UPT' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l1_name'] ?? 'Direktur PKTJ' }}</div>
                                        </div>
                                    </div>

                                    <div class="org-connector"></div>

                                    <!-- Level 2 -->
                                    <div class="org-group-title" data-aos="fade-down">Tingkat 2: Manager Informasi & Dokumentasi</div>
                                    <div class="org-level-row">
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="100">
                                            <div class="role-name">{{ $settings['struktur_l2_c1_role'] ?? 'Manager Bidang 1' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l2_c1_name'] ?? 'Wakil Direktur 1' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="200">
                                            <div class="role-name">{{ $settings['struktur_l2_c2_role'] ?? 'Manager Bidang 2' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l2_c2_name'] ?? 'Wakil Direktur 2' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="300">
                                            <div class="role-name">{{ $settings['struktur_l2_c3_role'] ?? 'Manager Bidang 3' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l2_c3_name'] ?? 'Wakil Direktur 3' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="400">
                                            <div class="role-name">{{ $settings['struktur_l2_c4_role'] ?? 'Manager Administrasi' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l2_c4_name'] ?? 'Kepala Bagian Administrasi Akademik dan Ketarunaan' }}</div>
                                        </div>
                                    </div>

                                    <div class="org-connector"></div>

                                    <!-- Level 3 -->
                                    <div class="org-group-title" data-aos="fade-down">Tingkat 3: Pengelola Dokumentasi</div>
                                    <div class="org-level-row">
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="100">
                                            <div class="role-name">{{ $settings['struktur_l3_c1_role'] ?? 'Pengelola Dokumentasi' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l3_c1_name'] ?? 'Kepala Bagian Keuangan, Umum dan Kerjasama' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="200">
                                            <div class="role-name">{{ $settings['struktur_l3_c2_role'] ?? 'Humas' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l3_c2_name'] ?? 'Pranata Hubungan Masyarakat Ahli Muda' }}</div>
                                        </div>
                                    </div>

                                    <div class="org-connector"></div>

                                    <!-- Level 4 -->
                                    <div class="org-group-title" data-aos="fade-down">Tingkat 4: Petugas Informasi</div>
                                    <div class="org-level-row">
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="50">
                                            <div class="role-name">{{ $settings['struktur_l4_c1_role'] ?? 'Petugas Keuangan' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c1_name'] ?? 'Analis Pengelolaan Keuangan APBN Ahli Muda' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="100">
                                            <div class="role-name">{{ $settings['struktur_l4_c2_role'] ?? 'Petugas SDM' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c2_name'] ?? 'Analis Sumber Daya Manusia Aparatur Ahli Muda' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="150">
                                            <div class="role-name">{{ $settings['struktur_l4_c3_role'] ?? 'Teknologi Pembelajaran' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c3_name'] ?? 'Para Pengembangan Teknologi Pembelajaran Ahli Muda' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="200">
                                            <div class="role-name">{{ $settings['struktur_l4_c4_role'] ?? 'Kepala Pusat' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c4_name'] ?? 'Para Kepala Pusat' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="250">
                                            <div class="role-name">{{ $settings['struktur_l4_c5_role'] ?? 'Ketua Program Studi' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c5_name'] ?? 'Para Ketua Program Studi' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="300">
                                            <div class="role-name">{{ $settings['struktur_l4_c6_role'] ?? 'Kepala Unit' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c6_name'] ?? 'Para Kepala Unit' }}</div>
                                        </div>
                                        <div class="org-card hover-lift" data-aos="fade-up" data-aos-delay="350">
                                            <div class="role-name">{{ $settings['struktur_l4_c7_role'] ?? 'Kehumasan' }}</div>
                                            <div class="person-name">{{ $settings['struktur_l4_c7_name'] ?? 'Pranata Kehumasan' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rich-content">
                                    {!! $section['content'] !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif

                <!-- Section Tugas & Wewenang Accordion -->
                <div class="mt-5" data-aos="fade-up" data-aos-delay="200">
                    @if($profil->konten_detail)
                        {!! $profil->konten_detail !!}
                    @else
                        <h2 class="section-title">Tugas & Wewenang Struktur PPID</h2>
                        <p class="text-muted mb-4">Uraian tugas, wewenang, dan tanggung jawab masing-masing bagian dalam struktur PPID Politeknik Keselamatan Transportasi Jalan sesuai Keputusan Direktur PKTJ.</p>
                        
                        <div class="accordion" id="accordionTugas">
                            <!-- Item 1: PPID Pelaksana UPT -->
                            <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                                        <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-user-tie"></i></span>
                                        1. PPID Pelaksana UPT (Direktur PKTJ)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
                                    <div class="accordion-body bg-light/50 p-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                                                <ol class="ps-3 mb-0 small text-justify">
                                                    <li class="mb-2">Menyediakan informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                                    <li class="mb-2">Melakukan pengawasan terhadap pelaksanaan layanan informasi sehingga dapat diakses dengan mudah;</li>
                                                    <li class="mb-2">Meningkatkan sumber daya manusia dalam pelayanan informasi; dan</li>
                                                    <li class="mb-2">Mengkoordinasikan setiap unit/satuan kerja di lingkup kerja Eselon I dalam melaksanakan pelayanan informasi.</li>
                                                </ol>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-shield-alt me-2 text-warning"></i> Wewenang:</h5>
                                                <ol class="ps-3 mb-0 small text-justify">
                                                    <li class="mb-2">Mengajukan usulan daftar informasi publik dan informasi yang dikecualikan kepada PPID Pelaksana;</li>
                                                    <li class="mb-2">Menjamin tersimpan dan terdokumentasi seluruh informasi secara fisik yang meliputi:
                                                        <ul class="ps-3 list-disc mt-1">
                                                            <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                                            <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                                            <li>Informasi terbuka lainnya yang diminta pemohon informasi.</li>
                                                        </ul>
                                                    </li>
                                                    <li class="mb-2">Menolak permohonan informasi apabila informasi yang dimohon termasuk informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                                                    <li class="mb-2">Membuat dan mengumumkan laporan tentang pelaksanaan layanan informasi serta menyampaikan salinan laporan kepada Komisi Informasi dan atasan PPID;</li>
                                                    <li class="mb-2">Menyediakan sarana dan prasarana layanan informasi;</li>
                                                    <li class="mb-2">Menugaskan pejabat fungsional dan/atau petugas informasi di bawah wewenang dan koordinasinya untuk membuat, memelihara, dan/atau memutakhirkan informasi;</li>
                                                    <li class="mb-2">Menetapkan program meningkatkan sumber daya manusia dalam pelayanan informasi; dan</li>
                                                    <li class="mb-2">Melakukan evaluasi terhadap pelaksanaan layanan informasi pada instansinya.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 2: Manager Informasi dan Dokumentasi -->
                            <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                                        <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-project-diagram"></i></span>
                                        2. Manager Informasi dan Dokumentasi
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
                                    <div class="accordion-body bg-light/50 p-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-clipboard-list me-2 text-warning"></i> Tanggung Jawab:</h5>
                                                <ol class="ps-3 mb-0 small text-justify">
                                                    <li class="mb-2">Menyediakan Informasi secara baik dan efisien;</li>
                                                    <li class="mb-2">Melakukan pengawasan terhadap pelaksanaan layanan Informasi secara baik dan efisien;</li>
                                                    <li class="mb-2">Meningkatkan sumber daya manusia dalam pelayanan Informasi;</li>
                                                    <li class="mb-2">Mengkoordinasikan setiap unit/satuan kerja di Badan Publik dalam melaksanakan pelayanan Informasi; dan</li>
                                                    <li class="mb-2">Menyimpan dan mendokumentasikan serta memutakhirkan seluruh Informasi secara fisik.</li>
                                                </ol>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                                                <ol class="ps-3 mb-0 small text-justify">
                                                    <li class="mb-2">Memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                                    <li class="mb-2">Menyediakan seluruh Informasi secara fisik yang meliputi:
                                                        <ul class="ps-3 list-disc mt-1">
                                                            <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                                            <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                                            <li>Informasi terbuka lainnya yang diminta pemohon Informasi.</li>
                                                        </ul>
                                                    </li>
                                                    <li class="mb-2">Menolak permohonan Informasi apabila Informasi yang dimohon termasuk Informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                                                    <li class="mb-2">Mengumumkan laporan tentang layanan Informasi serta menyampaikan salinan laporan kepada Komisi Informasi dan Atasan PPID;</li>
                                                    <li class="mb-2">Menyiapkan pejabat fungsional dan/atau petugas Informasi dibawah wewenang dan koordinasinya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                                                    <li class="mb-2">Menyusun program peningkatan sumber daya manusia dalam pelayanan Informasi;</li>
                                                    <li class="mb-2">Melakukan evaluasi terhadap pelaksanaan layanan Informasi pada instansinya;</li>
                                                    <li class="mb-2">Menyediakan dokumentasi dan Informasi secara fisik; dan</li>
                                                    <li class="mb-2">Menunjuk pejabat fungsional dibawah wewenang dan koordinasinya untuk menyimpan, mendokumentasikan dan memutakhirkan seluruh Informasi secara fisik.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3: Pengelola Dokumentasi -->
                            <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                                        <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-folder-open"></i></span>
                                        3. Pengelola Dokumentasi
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
                                    <div class="accordion-body bg-light/50 p-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-clipboard-list me-2 text-warning"></i> Tanggung Jawab:</h5>
                                                <p class="small ps-3 text-justify">Mengelola and mendokumentasikan informasi yang berada di bawah kewenangannya.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                                                <ol class="ps-3 mb-0 small text-justify">
                                                    <li class="mb-2">Menyediakan dokumentasi dan Informasi secara fisik yang meliputi:
                                                        <ul class="ps-3 list-disc mt-1">
                                                            <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                                            <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                                            <li>Informasi terbuka lainnya yang diminta pemohon Informasi.</li>
                                                        </ul>
                                                    </li>
                                                    <li class="mb-2">Melakukan koordinasi dengan manager dokumentasi untuk menyimpan, mendokumentasikan dan memutakhirkan seluruh Informasi secara fisik.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 4: Petugas Informasi -->
                            <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                                        <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-user-clock"></i></span>
                                        4. Petugas Informasi
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
                                    <div class="accordion-body bg-light/50 p-4">
                                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas Petugas Informasi:</h5>
                                        <ol class="ps-3 mb-0 small text-justify">
                                            <li class="mb-2">Menyiapkan formulir aplikasi permohonan Informasi;</li>
                                            <li class="mb-2">Menerima aplikasi permohonan Informasi;</li>
                                            <li class="mb-2">Melakukan verifikasi data pemohon;</li>
                                            <li class="mb-2">Melakukan verifikasi Informasi yang diminta (Informasi yang terbuka atau dikecualikan);</li>
                                            <li class="mb-2">Registrasi pencatatan permintaan Informasi dalam buku besar setelah selesai verifikasi;</li>
                                            <li class="mb-2">Memproses lanjut Informasi ke Pejabat Pengelola dan Informasi dan Dokumentasi;</li>
                                            <li class="mb-2">Melakukan pencatatan penomoran surat Informasi yang disampaikan kepada pemohon;</li>
                                            <li class="mb-2">Mendokumentasikan dan menyiapkan evaluasi pelaporan layanan Informasi setiap bulan dan setiap akhir tahun; dan</li>
                                            <li class="mb-2">Apabila menerima permohonan Informasi yang dikecualikan, wajib meneruskan kepada PPID.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-sitemap fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Bagan Belum Tersedia</h3>
                    <p class="text-muted">Administrator sedang menyusun bagan organisasi terbaru.</p>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
