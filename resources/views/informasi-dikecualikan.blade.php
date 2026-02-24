<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Dikecualikan - Portal PPID PKTJ</title>
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
    </style>
</head>
<body>

    @include('navigation')

    <div style="background-color: #f8f9fa; padding: 40px 0;">
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
