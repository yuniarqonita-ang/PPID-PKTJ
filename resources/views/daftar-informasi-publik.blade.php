<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - Portal PPID PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #9333ea 0%, #6366f1 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .content-section {
            line-height: 1.6;
        }
        .content-section h1, .content-section h2, .content-section h3 {
            margin: 1.5rem 0 1rem 0;
            color: #1f2937;
        }
        .content-section p {
            margin-bottom: 1rem;
        }
        .content-section ul, .content-section ol {
            margin: 1rem 0;
            padding-left: 2rem;
        }
        .content-section li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- NAVBAR -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-bolt text-blue-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">PPID PKTJ</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="/profil" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Profil</a>
                    <a href="/informasi-publik" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Informasi Publik</a>
                    <a href="/daftar-informasi-publik" class="text-purple-600 hover:text-purple-800 px-3 py-2 rounded-md text-sm font-medium border-b-2 border-purple-600">Daftar Informasi</a>
                    <a href="/kontak" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="hero-gradient relative h-96 flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <i class="fas fa-list-alt text-6xl mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Daftar Informasi Publik</h1>
            <p class="text-xl md:text-2xl">Daftar lengkap informasi yang tersedia untuk publik</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($informasi && $informasi->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($informasi as $item)
                    <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-100 text-purple-600 p-3 rounded-lg mr-3">
                                <i class="fas fa-file-alt text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">
                                    {{ $item->kategori }}
                                </span>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $item->judul }}</h3>
                        
                        @if($item->konten)
                            <div class="content-section text-gray-600 text-sm mb-4">
                                {!! Str::limit(strip_tags($item->konten), 100) !!}
                            </div>
                        @endif

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </span>
                            @if($item->frekuensi)
                                <span>
                                    <i class="fas fa-sync mr-1"></i>
                                    {{ $item->frekuensi }}
                                </span>
                            @endif
                        </div>

                        @if($item->file)
                            <a href="{{ asset('storage/daftar-informasi/' . $item->file) }}" 
                               target="_blank" 
                               class="inline-flex items-center px-3 py-2 bg-purple-500 text-white text-sm rounded-lg hover:bg-purple-600 transition">
                                <i class="fas fa-download mr-2"></i>
                                Download
                            </a>
                        @endif

                        @if($item->biaya)
                            <div class="mt-3 text-sm text-gray-600">
                                <i class="fas fa-money-bill mr-1"></i>
                                <strong>Biaya:</strong> {{ $item->biaya }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <i class="fas fa-list-alt text-6xl text-purple-500 mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Informasi Publik</h2>
                <p class="text-gray-600 mb-6">Saat ini tidak ada daftar informasi publik yang tersedia.</p>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 text-left max-w-3xl mx-auto">
                    <h3 class="text-lg font-semibold text-purple-800 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>Tentang Daftar Informasi Publik
                    </h3>
                    <p class="text-gray-700 mb-3">Daftar Informasi Publik berisi katalog informasi yang wajib disediakan oleh PPID:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Informasi Berkala yang diterbitkan secara berkala</li>
                        <li>Informasi Serta Merta yang harus segera disampaikan</li>
                        <li>Informasi Setiap Saat yang tersedia kapan saja</li>
                        <li>Informasi Dikecualikan sesuai peraturan perundangan</li>
                        <li>Format dan biaya perolehan informasi</li>
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="mb-2">&copy; 2024 PPID Politeknik Ketenagalistrikan. All rights reserved.</p>
                <p class="text-sm text-gray-400">Jl. Gajah Mada No. 2, Jakarta Pusat, 10130</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
        <div class="container">
            <h1 style="color: #333; font-size: 36px; font-weight: bold; margin-bottom: 30px;">Daftar Informasi Publik</h1>

            {{-- Filter Section --}}
            <div style="background: white; padding: 25px; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <!-- Filter Informasi -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Informasi</label>
                        <input type="text" placeholder="Cari informasi..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <!-- Filter Ringkasan Informasi -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Ringkasan Informasi</label>
                        <input type="text" placeholder="Cari ringkasan..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <!-- Filter Waktu Pembuatan -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Waktu Pembuatan</label>
                        <input type="text" placeholder="Masukkan waktu..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <!-- Filter Penanggung Jawab -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Penanggung Jawab</label>
                        <input type="text" placeholder="Pilih penanggung jawab..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>
                </div>

                {{-- Tombol Cari --}}
                <div>
                    <button style="background-color: #27ae60; color: white; padding: 10px 30px; border: none; border-radius: 5px; font-size: 15px; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-search" style="margin-right: 8px;"></i>Cari
                    </button>
                </div>
            </div>

            {{-- Item Counter --}}
            <div style="font-size: 14px; color: #666; margin-bottom: 15px;">
                Showing 1-20 of 670 items.
            </div>

            {{-- Tabel --}}
            <div style="overflow-x: auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="background-color: white; border-bottom: 2px solid #ddd;">
                            <th style="padding: 12px; text-align: center; color: #333; font-weight: 600; width: 60px;">#</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">PENANGGUNG JAWAB</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">INFORMASI</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">JENIS INFORMASI</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">RINGKASAN INFORMASI</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">PEJABAT YANG MENGUASAI INFORMASI</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">PENERBIT INFORMASI</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">BENTUK INFORMASI YANG TERSEDIA</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">TEMPAT PEMBUATAN</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">WAKTU PEMBUATAN</th>
                            <th style="padding: 12px; text-align: left; color: #0066cc; font-weight: 600;">JANGKA WAKTU PENYIMPANAN/RETENSI WAKTU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px; text-align: center; color: #333;">1</td>
                            <td style="padding: 12px;">PPID UTAMA</td>
                            <td style="padding: 12px;">
                                <a href="#" style="color: #0066cc; text-decoration: none; font-weight: 600;">Rencang Pembangunan Jangka Panjang</a>
                            </td>
                            <td style="padding: 12px;">Informasi berkala</td>
                            <td style="padding: 12px;">Latar belakang dan uraih pembangunan transportasi</td>
                            <td style="padding: 12px;">PPID Utama</td>
                            <td style="padding: 12px;">Biro Perencanaan</td>
                            <td style="padding: 12px;">Hard copy dan soft copy</td>
                            <td style="padding: 12px;">Jakarta (Jangka Waktu Pembuatan)</td>
                            <td style="padding: 12px;">2025</td>
                            <td style="padding: 12px;">20 Tahun</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
