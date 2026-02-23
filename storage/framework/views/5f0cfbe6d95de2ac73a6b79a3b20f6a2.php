<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas dan Tanggung Jawab PPID - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }
        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .task-list {
            list-style-type: decimal;
            padding-left: 25px;
        }
        .task-list li {
            margin-bottom: 12px;
            line-height: 1.6;
            color: #333;
        }
        .table-section {
            margin-bottom: 40px;
        }
        .table-title {
            background-color: white;
            padding: 15px;
            font-weight: bold;
            color: #333;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid #004a99;
        }
        .responsibility-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .responsibility-table thead {
            background-color: #ffc107;
            font-weight: bold;
            color: #333;
        }
        .responsibility-table thead th {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .responsibility-table tbody td {
            padding: 15px;
            border: 1px solid #ddd;
            line-height: 1.6;
            vertical-align: top;
        }
        .responsibility-table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        .responsibility-table tbody tr:hover {
            background-color: #f0f0f0;
        }
        .col-left {
            width: 50%;
        }
        .col-right {
            width: 50%;
        }
        ol li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li {
            margin-bottom: 6px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <h1 class="page-title"><?php echo e($profil->judul ?? 'Tugas dan Tanggung Jawab PPID'); ?></h1>
        
        <?php if($profil): ?>
            <div class="content-box">
                <?php if($profil->konten_pembuka): ?>
                    <?php echo $profil->konten_pembuka; ?>

                <?php else: ?>
                    <ol class="task-list">
                        <li>Melakukan pengelolaan informasi publik;</li>
                        <li>Menyampaikan informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                        <li>Melakukan pemutakhiran dalam pengelolaan maupun pengembangan digital;</li>
                        <li>Menyediakan Sarana dan Prasarana dalam pelaksanaan pelayanan informasi.</li>
                    </ol>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- PPID UTAMA -->
        <div class="table-section">
            <div class="table-title">PPID Utama</div>
            <table class="responsibility-table">
                <thead>
                    <tr>
                        <th class="col-left">TANGGUNG JAWAB</th>
                        <th class="col-right">WEWENANG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-left">
                            <ul>
                                <li>a. menyediakan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. melakukan pengawasan terhadap pelaksanaan layanan Informasi sehingga dapat diakses dengan mudah;</li>
                                <li>c. meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>d. mengkoordinasikan setiap unit/satuan kerja di Badan Publik dalam melaksanakan pelayanan Informasi.</li>
                            </ul>
                        </td>
                        <td class="col-right">
                            <ul>
                                <li>a. memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. menetapkan daftar Informasi Publik dan Informasi yang dikecualikan;</li>
                                <li>c. menjamin tersimpan dan terdokumentasi seluruh Informasi secara fisik yang meliputi:
                                    <ol style="margin-top: 8px;">
                                        <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                        <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                        <li>Informasi terbuka lainnya yang diminta pemohon Informasi;</li>
                                    </ol>
                                </li>
                                <li>d. menolak permohonan Informasi dengan apabila Informasi yang dimohon termasuk Informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                                <li>e. membuat dan mengumumkan laporan tentang pelaksanaan layanan Informasi serta menyampaikan salinan laporan kepada Komisi Informasi dan atasan Pejabat Pengelola Informasi dan Dokumentasi;</li>
                                <li>f. menyediakan sarana dan prasarana layanan Informasi;</li>
                                <li>g. menugaskan pejabat fungsional dan/atau petugas Informasi dibawah wewenang dan koordinasinnya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                                <li>h. menetapkan program meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>i. melakukan evaluasi terhadap pelaksanaan layanan Informasi pada instansinnya.</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PPID PELAKSANA -->
        <div class="table-section">
            <div class="table-title">PPID Pelaksana</div>
            <table class="responsibility-table">
                <thead>
                    <tr>
                        <th class="col-left">TANGGUNG JAWAB</th>
                        <th class="col-right">WEWENANG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-left">
                            <ul>
                                <li>a. menyediakan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. melakukan pengawasan terhadap pelaksanaan layanan Informasi sehingga dapat diakses dengan mudah;</li>
                                <li>c. meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>d. mengkoordinasikan setiap unit/satuan kerja di lingkup kerja Eselon I dalam melaksanakan pelayanan Informasi.</li>
                            </ul>
                        </td>
                        <td class="col-left">
                            <ul>
                                <li>a. memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. mengajukan usulan daftar Informasi Publik dan Informasi dikecualikan kepada PPID Utama;</li>
                                <li>c. menjamin tersimpan dan terdokumentasi seluruh Informasi secara fisik yang meliputi:
                                    <ol style="margin-top: 8px;">
                                        <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                        <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                        <li>Informasi terbuka lainnya yang diminta pemohon Informasi;</li>
                                    </ol>
                                </li>
                                <li>d. menolak permohonan Informasi dengan apabila Informasi yang dimohon termasuk Informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                                <li>e. melaporkan perkembangan pelayanan Informasi yang dilaksanakan di lingkup unit kerjanya secara berkala kepada PPID Utama;</li>
                                <li>f. membuat dan mengumumkan laporan tentang pelaksanaan layanan Informasi serta menyampaikan salinan laporan kepada PPID Utama;</li>
                                <li>g. menyediakan sarana dan prasarana layanan Informasi;</li>
                                <li>h. menugaskan pejabat fungsional dan/atau petugas Informasi dibawah wewenang dan koordinasinnya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                                <li>i. menetapkan program meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>j. melakukan evaluasi terhadap pelaksanaan layanan Informasi pada lingkup unit kerjanya.</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PPID PELAKSANA UPT -->
        <div class="table-section">
            <div class="table-title">PPID Pelaksana UPT</div>
            <table class="responsibility-table">
                <thead>
                    <tr>
                        <th class="col-left">TANGGUNG JAWAB</th>
                        <th class="col-right">WEWENANG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-left">
                            <ul>
                                <li>a. menyediakan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. melakukan pengawasan terhadap pelaksanaan layanan Informasi sehingga dapat diakses dengan mudah;</li>
                                <li>c. meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>d. mengkoordinasikan setiap unit/satuan kerja di lingkup kerja Eselon I dalam melaksanakan pelayanan Informasi.</li>
                            </ul>
                        </td>
                        <td class="col-left">
                            <ul>
                                <li>a. memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                                <li>b. mengajukan usulan daftar Informasi Publik dan Informasi dikecualikan kepada PPID Utama;</li>
                                <li>c. menjamin tersimpan dan terdokumentasi seluruh Informasi secara fisik yang meliputi:
                                    <ol style="margin-top: 8px;">
                                        <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                        <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                        <li>Informasi terbuka lainnya yang diminta pemohon Informasi;</li>
                                    </ol>
                                </li>
                                <li>d. menolak permohonan Informasi dengan apabila Informasi yang dimohon termasuk Informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                                <li>e. melaporkan perkembangan pelayanan Informasi yang dilaksanakan di lingkup unit kerjanya secara berkala kepada PPID Utama;</li>
                                <li>f. membuat dan mengumumkan laporan tentang pelaksanaan layanan Informasi serta menyampaikan salinan laporan kepada PPID Utama;</li>
                                <li>g. menyediakan sarana dan prasarana layanan Informasi dibawah wewenang dan koordinasinnya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                                <li>h. menugaskan pejabat fungsional dan/atau petugas Informasi dibawah wewenang dan koordinasinnya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                                <li>i. menetapkan program meningkatkan sumber daya manusia dalam pelayanan Informasi; dan</li>
                                <li>j. melakukan evaluasi terhadap pelaksanaan layanan Informasi pada lingkup unit kerjanya.</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if($profil && $profil->konten_detail): ?>
            <div class="content-box mt-4">
                <h3 class="mb-3"><?php echo e($profil->judul_sub ?? 'Detail Informasi Tambahan'); ?></h3>
                <?php echo $profil->konten_detail; ?>

            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/profil-tugas-tanggung-jawab.blade.php ENDPATH**/ ?>