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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.9), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 60px;
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0, 74, 153, 0.1);
            margin-top: -80px;
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
        }

        .info-item {
            background: #f8fafc;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .info-item:hover {
            transform: translateY(-10px);
            background: white;
            border-color: #ef4444;
            box-shadow: 0 20px 40px rgba(239, 68, 68, 0.1);
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 25px;
            flex-shrink: 0;
        }

        .badge-locked {
            background: #f1f5f9;
            color: #64748b;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            border: 1px solid #e2e8f0;
        }

        .rich-content {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.8;
        }
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
        <div class="content-card">
            <h1 class="section-title">Informasi Dikecualikan</h1>

            <!-- Search Filters -->
            <form action="{{ route('informasi.dikecualikan') }}" method="GET" class="mb-5">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold uppercase">Informasi</label>
                        <input type="text" name="informasi" value="{{ request('informasi') }}" class="form-control shadow-sm border-0 py-3 px-4 rounded-3" placeholder="Cari Informasi...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold uppercase">Dasar Hukum Pengecualian</label>
                        <input type="text" name="dasar_hukum" value="{{ request('dasar_hukum') }}" class="form-control shadow-sm border-0 py-3 px-4 rounded-3" placeholder="Cari Dasar Hukum...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold uppercase">Penanggung Jawab</label>
                        @php
                            $options = \App\Models\InformasiDikecualikan::whereNotNull('penanggung_jawab')
                                ->where('penanggung_jawab', '!=', '')
                                ->distinct()
                                ->pluck('penanggung_jawab')
                                ->toArray();
                        @endphp
                        <select name="penanggung_jawab" class="form-select shadow-sm border-0 py-3 px-4 rounded-3">
                            <option value="">Semua Penanggung Jawab</option>
                            @foreach($options as $opt)
                                @if(trim($opt))
                                    <option value="{{ trim($opt) }}" {{ request('penanggung_jawab') == trim($opt) ? 'selected' : '' }}>{{ trim($opt) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success px-5 py-3 rounded-3 fw-bold shadow-sm">
                            Cari <i class="fas fa-search ms-2"></i>
                        </button>
                        @if(request()->anyFilled(['informasi', 'dasar_hukum', 'penanggung_jawab']))
                            <a href="{{ route('informasi.dikecualikan') }}" class="btn btn-light px-4 py-3 rounded-3 fw-bold ms-2 shadow-sm border">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <div class="mb-3 text-muted small fw-bold">
                Showing {{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }} of {{ $items->total() }} items.
            </div>

            <div class="table-responsive rounded-4 shadow-sm border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-primary small fw-black uppercase text-center align-middle">
                            <th style="width: 50px;" class="py-4 px-3 border-end">#</th>
                            <th style="min-width: 250px;" class="py-4 px-3 border-end">Informasi</th>
                            <th style="min-width: 200px;" class="py-4 px-3 border-end">Dasar Hukum Pengecualian Informasi</th>
                            <th style="min-width: 200px;" class="py-4 px-3 border-end">Konsekuensi/Pertimbangan Dibuka Bagi Publik</th>
                            <th style="min-width: 200px;" class="py-4 px-3 border-end">Konsekuensi/Pertimbangan Ditutup Bagi Publik</th>
                            <th style="min-width: 120px;" class="py-4 px-3 border-end">Jangka Waktu</th>
                            <th style="min-width: 150px;" class="py-4 px-3 border-end">Penanggung Jawab</th>
                            <th style="min-width: 120px;" class="py-4 px-3">File / Lampiran</th>
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
                            <td class="py-4 px-4 text-center">
                                @if($item->file_path)
                                    @if(is_previewable($item->file_path))
                                        @if(strtolower($item->file_type) === 'gdrive')
                                            <button type="button" class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="modal" data-bs-target="#previewModal" 
                                                data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                                <i class="fab fa-google-drive"></i> Lihat
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" data-bs-target="#previewModal" 
                                                data-url="{{ route('preview.dokumen', ['file' => $item->file_path, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                                <i class="fas fa-file-download"></i> Lihat
                                            </button>
                                        @endif
                                    @endif
                                    @if($item->bisa_download)
                                        <a href="{{ route('download.file', ['model' => 'dikecualikan', 'id' => $item->id]) }}" class="btn btn-sm btn-outline-success ms-1">
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
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
</body>
</html>

