<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dikecualikan - Portal PPID PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #dc2626 0%, #ec4899 100%);
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
                    <a href="/informasi-dikecualikan" class="text-red-600 hover:text-red-800 px-3 py-2 rounded-md text-sm font-medium border-b-2 border-red-600">Dikecualikan</a>
                    <a href="/kontak" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="hero-gradient relative h-96 flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <i class="fas fa-shield-alt text-6xl mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Informasi Dikecualikan</h1>
            <p class="text-xl md:text-2xl">Informasi yang tidak dapat diakses sesuai peraturan</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($informasi && $informasi->count() > 0)
            @foreach($informasi as $item)
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8 card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $item->judul }}</h2>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                    <i class="fas fa-gavel mr-1"></i>{{ $item->kategori }}
                                </span>
                                <span>
                                    <i class="fas fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-gray-700 font-medium mb-2">
                            <i class="fas fa-balance-scale text-red-500 mr-2"></i>
                            <strong>Dasar Hukum:</strong> {{ $item->dasar_hukum }}
                        </p>
                    </div>

                    @if($item->konten)
                        <div class="content-section mb-6">
                            {!! $item->konten !!}
                        </div>
                    @endif

                    @if($item->file)
                        <div class="border-t pt-4">
                            <a href="{{ asset('storage/informasi-dikecualikan/' . $item->file) }}" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Lihat Dokumen Pendukung
                            </a>
                        </div>
                    @endif

                    @if($item->tanggal_mulai && $item->tanggal_selesai)
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>
                                <strong>Masa Berlaku Pengecualian:</strong> 
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <i class="fas fa-info-circle text-6xl text-red-500 mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Dikecualikan</h2>
                <p class="text-gray-600 mb-6">Saat ini tidak ada informasi yang dikecualikan.</p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-left max-w-3xl mx-auto">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>Informasi yang Dikecualikan
                    </h3>
                    <p class="text-gray-700 mb-3">Berdasarkan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik, informasi yang dapat dikecualikan meliputi:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Informasi yang dapat membahayakan pertahanan dan keamanan negara</li>
                        <li>Informasi yang mengungkap rahasia dagang</li>
                        <li>Informasi yang mengungkap hak pribadi</li>
                        <li>Informasi yang mengungkap kepentingan ekonomi makro</li>
                        <li>Informasi yang berkaitan dengan proses pengadilan</li>
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
            <h1 style="color: #333; font-size: 36px; font-weight: bold; margin-bottom: 30px;">Informasi Dikecualikan</h1>

            {{-- Filter Section --}}
            <div style="background: white; padding: 25px; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <!-- Filter Informasi -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Informasi</label>
                        <input type="text" placeholder="Cari informasi..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <!-- Filter Dasar Hukum -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Dasar Hukum Pengecualian</label>
                        <input type="text" placeholder="Pilih dasar hukum..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    </div>

                    <!-- Filter Penanggung Jawab -->
                    <div>
                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Penanggung Jawab</label>
                        <select style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                            <option value="">-- Pilih Penanggung Jawab --</option>
                            <option value="PPID UTAMA">PPID UTAMA</option>
                            <option value="Inspektorat">Inspektorat Jenderal Kementerian Perhubungan</option>
                            <option value="Darat">Direktorat Jenderal Perhubungan Darat</option>
                            <option value="Laut">Direktorat Jenderal Perhubungan Laut</option>
                            <option value="Udara">Direktorat Jenderal Perhubungan Udara</option>
                            <option value="Kereta">Direktorat Jenderal Perkeretaapian</option>
                            <option value="Kebijakan">Badan Kebijakan Transportasi</option>
                            <option value="SDM">Badan Pengembangan Sumber Daya Manusia Perhubungan</option>
                            <option value="Jabodetabek">Badan Pengelola Transportasi Jabodetabek</option>
                        </select>
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
                Showing 1-20 of 43 items.
            </div>

            {{-- Tabel --}}
            <div style="overflow-x: auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: white; border-bottom: 2px solid #ddd;">
                            <th style="padding: 15px; text-align: center; color: #333; font-weight: 600; width: 70px;">#</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Informasi</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Dasar Hukum Pengecualian Informasi</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Konsekuensi/Pertimbangan Dibuka Bagi Publik</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Konsekuensi/Pertimbangan Ditutup Bagi Publik</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Jangka Waktu</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center; color: #333;">1</td>
                            <td style="padding: 15px;">Laporan Keuangan sebelum diaudit (unaudited) 2023</td>
                            <td style="padding: 15px;">• Undang-Undang Nomor 17 Tahun 2003 Tentang Keuangan Negara Pasal 30 ayat (1): Presiden menyampaikan rancangan undang-undang tentang</td>
                            <td style="padding: 15px;">Jika informasi dibuka, dapat mengganggu proses pemeriksaan laporan keuangan negara</td>
                            <td style="padding: 15px;">Jika informasi ditutup, maka dapat melindungi proses pemeriksaan laporan keuangan negara</td>
                            <td style="padding: 15px;">1 Tahun</td>
                            <td style="padding: 15px;">PPID UTAMA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
