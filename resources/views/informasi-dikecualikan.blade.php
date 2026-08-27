<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dikecualikan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @include('components.public-page-style')
    <style>
        .outfit { font-family: 'Outfit', sans-serif; }

        /* Modern Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 30, 64, 0.95) 0%, rgba(0, 74, 153, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?q=80&w=2070');
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
            border-left: 6px solid #ef4444;
            box-shadow: 0 10px 30px rgba(0, 43, 92, 0.04);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .info-item:hover {
            transform: translateY(-6px);
            background: #ffffff;
            border-color: #ef4444;
            box-shadow: 0 20px 45px rgba(239, 68, 68, 0.12);
        }

        .info-icon {
            width: 58px;
            height: 58px;
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .badge-locked {
            background: #fef2f2;
            color: #b91c1c;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
            border: 1px solid #fecaca;
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
            <h1 class="display-3 fw-black outfit uppercase">Informasi Dikecualikan</h1>
            <p class="lead opacity-75 mb-0">Daftar informasi yang tidak dapat dibuka untuk umum berdasarkan pengujian konsekuensi.</p>
        </div>
    </div>

    <div class="container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            <!-- TOP HERO QUICK SEARCH BAR -->
            <div class="p-4 mb-4 rounded-4 border shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-color: #cbd5e1;">
                <form action="{{ route('informasi.dikecualikan') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-5">
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted ms-3" style="font-size: 15px;"></i>
                                <input type="text" name="informasi" value="{{ request('informasi') }}" placeholder="Cari nama informasi yang dikecualikan..." class="form-control form-control-lg ps-5 rounded-pill border-2 bg-white" style="font-size: 14px;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="dasar_hukum" value="{{ request('dasar_hukum') }}" placeholder="Dasar hukum pasal/UU..." class="form-control form-control-lg rounded-pill border-2 bg-white" style="font-size: 14px;">
                        </div>
                        <div class="col-lg-2">
                            @php
                                $options = \App\Models\InformasiDikecualikan::whereNotNull('penanggung_jawab')
                                    ->where('penanggung_jawab', '!=', '')
                                    ->distinct()
                                    ->pluck('penanggung_jawab')
                                    ->toArray();
                            @endphp
                            <select name="penanggung_jawab" class="form-select form-select-lg rounded-pill border-2 bg-white" style="font-size: 14px;">
                                <option value="">Semua Unit</option>
                                @foreach($options as $opt)
                                    @if(trim($opt))
                                        <option value="{{ trim($opt) }}" {{ request('penanggung_jawab') == trim($opt) ? 'selected' : '' }}>{{ trim($opt) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold w-100 shadow-sm" style="background: #004a99;">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            @if(request()->anyFilled(['informasi', 'dasar_hukum', 'penanggung_jawab']))
                                <a href="{{ route('informasi.dikecualikan') }}" class="btn btn-light rounded-pill px-3 py-2.5 border" title="Reset">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title mb-0" style="font-size: 1.5rem;">Daftar Informasi Yang Dikecualikan</h2>
                <span class="badge bg-light text-muted border px-3 py-2 rounded-pill font-mono small">
                    Total: {{ $items->total() }} Dokumen Uji Konsekuensi
                </span>
            </div>

            <div class="table-responsive rounded-4 shadow-sm border overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #002b5c; color: white;">
                        <tr class="small fw-black uppercase text-center align-middle" style="color: #ffffff;">
                            <th style="width: 50px; background: #002b5c; color: #ffd166;" class="py-3 px-3 border-end">No</th>
                            <th style="min-width: 250px; background: #002b5c; color: #ffffff;" class="py-3 px-3 border-end">Informasi</th>
                            <th style="min-width: 200px; background: #002b5c; color: #ffffff;" class="py-3 px-3 border-end">Dasar Hukum Pengecualian</th>
                            <th style="min-width: 200px; background: #002b5c; color: #ffffff;" class="py-3 px-3 border-end">Pertimbangan Dibuka</th>
                            <th style="min-width: 200px; background: #002b5c; color: #ffffff;" class="py-3 px-3 border-end">Pertimbangan Ditutup</th>
                            <th style="min-width: 120px; background: #002b5c; color: #ffffff;" class="py-3 px-3 border-end">Jangka Waktu</th>
                            <th style="min-width: 150px; background: #002b5c; color: #ffffff;" class="py-3 px-3">Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($items as $index => $item)
                        <tr class="text-secondary small fw-medium">
                            <td class="text-center py-4 border-end fw-black">{{ $items->firstItem() + $index }}</td>
                            <td class="py-4 px-4 border-end">
                                <div class="fw-bold text-dark mb-2">{{ $item->judul }}</div>
                                <div class="text-muted opacity-75">{!! $item->deskripsi !!}</div>
                            </td>
                            <td class="py-4 px-4 border-end text-center"><div class="rich-content">{!! $item->dasar_hukum ?: '-' !!}</div></td>
                            <td class="py-4 px-4 border-end text-center"><div class="rich-content">{!! $item->konsekuensi_dibuka ?: '-' !!}</div></td>
                            <td class="py-4 px-4 border-end text-center"><div class="rich-content">{!! $item->konsekuensi_ditutup ?: '-' !!}</div></td>
                            <td class="py-4 px-4 border-end text-center fw-bold">{{ $item->jangka_waktu ?: '-' }}</td>
                            <td class="py-4 px-4 border-end text-center fw-bold text-primary">{{ $item->penanggung_jawab ?: '-' }}</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-5">
                                    <i class="fas fa-shield-alt fa-4x text-muted mb-4 opacity-25"></i>
                                    <h3 class="text-muted">Data Tidak Ditemukan</h3>
                                    <p class="text-muted">Gunakan filter pencarian yang berbeda atau tambahkan data di admin.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $items->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>

