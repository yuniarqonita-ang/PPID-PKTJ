<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Publik - Portal PPID PKTJ</title>
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

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div style="background-color: #f8f9fa; padding: 40px 0;">
        <div class="container">
            <h1 style="color: #333; font-size: 36px; font-weight: bold; margin-bottom: 30px;">Daftar Informasi Publik</h1>

            
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

                
                <div>
                    <button style="background-color: #27ae60; color: white; padding: 10px 30px; border: none; border-radius: 5px; font-size: 15px; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-search" style="margin-right: 8px;"></i>Cari
                    </button>
                </div>
            </div>

            
            <div style="font-size: 14px; color: #666; margin-bottom: 15px;">
                Showing 1-20 of 670 items.
            </div>

            
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
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/daftar-informasi-publik.blade.php ENDPATH**/ ?>