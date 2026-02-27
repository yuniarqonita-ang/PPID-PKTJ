<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Akses Informasi Publik - Portal PPID PKTJ</title>
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
            <h1 style="color: #333; font-size: 32px; font-weight: bold; margin-bottom: 25px;">Rekapitulasi Jumlah Permintaan Informasi Publik</h1>

            
            <div style="overflow-x: auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                            <th style="padding: 15px; text-align: center; color: #333; font-weight: 600; width: 60px;">#</th>
                            <th style="padding: 15px; text-align: left; color: #0066cc; font-weight: 600;">Judul Laporan</th>
                            <th style="padding: 15px; text-align: center; color: #333; font-weight: 600; width: 180px;">Unduh Dokumen</th>
                            <th style="padding: 15px; text-align: center; color: #333; font-weight: 600; width: 180px;">Preview Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center;">1</td>
                            <td style="padding: 15px;">Akses Layanan Informasi Tahun 2026</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #ffc107; color: #333; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-download" style="margin-right: 6px;"></i>Unduh Dokumen
                                </a>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-eye" style="margin-right: 6px;"></i>Preview Dokumen
                                </a>
                            </td>
                        </tr>

                        <tr style="background-color: white; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center;">2</td>
                            <td style="padding: 15px;">Akses Layanan Informasi Tahun 2025</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #ffc107; color: #333; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-download" style="margin-right: 6px;"></i>Unduh Dokumen
                                </a>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-eye" style="margin-right: 6px;"></i>Preview Dokumen
                                </a>
                            </td>
                        </tr>

                        <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center;">3</td>
                            <td style="padding: 15px;">Akses Layanan Informasi Tahun 2024</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #ffc107; color: #333; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-download" style="margin-right: 6px;"></i>Unduh Dokumen
                                </a>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-eye" style="margin-right: 6px;"></i>Preview Dokumen
                                </a>
                            </td>
                        </tr>

                        <tr style="background-color: white; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center;">4</td>
                            <td style="padding: 15px;">Jumlah Permohonan Informasi Tahun 2019</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #ffc107; color: #333; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-download" style="margin-right: 6px;"></i>Unduh Dokumen
                                </a>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-eye" style="margin-right: 6px;"></i>Preview Dokumen
                                </a>
                            </td>
                        </tr>

                        <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px; text-align: center;">5</td>
                            <td style="padding: 15px;">Jumlah Permohonan Informasi Tahun 2018</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #ffc107; color: #333; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-download" style="margin-right: 6px;"></i>Unduh Dokumen
                                </a>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; font-size: 13px;">
                                    <i class="fas fa-eye" style="margin-right: 6px;"></i>Preview Dokumen
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/laporan-akses-informasi-publik.blade.php ENDPATH**/ ?>