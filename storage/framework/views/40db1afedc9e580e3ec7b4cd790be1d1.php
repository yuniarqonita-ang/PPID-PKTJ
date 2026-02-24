<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Setiap Saat - Portal PPID PKTJ</title>
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
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #1a3a52;
            color: white;
        }
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .table tbody td {
            padding: 15px;
            border-color: #e9ecef;
            vertical-align: top;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .table a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .table a:hover {
            color: #d4af37;
            text-decoration: underline;
        }
        .berita-title {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 15px;
        }
        .berita-deskripsi {
            color: #666;
            font-size: 13px;
            line-height: 1.6;
            text-align: justify;
        }
        .item-counter {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
        .no-data i {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <h1 class="page-title">Informasi Setiap Saat</h1>

        <!-- ITEM COUNTER -->
        <div class="content-box">
            <?php if($beritas->count() > 0): ?>
                <div class="item-counter">
                    <strong>Showing 1-<?php echo e($beritas->count()); ?> of <?php echo e($beritas->count()); ?> items.</strong>
                </div>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80px;">#</th>
                                <th>Judul</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center fw-bold"><?php echo e($key + 1); ?></td>
                                    <td>
                                        <div class="berita-title">
                                            <a href="#" title="<?php echo e($item->judul); ?>"><?php echo e($item->judul); ?></a>
                                        </div>
                                        <?php if($item->konten): ?>
                                            <div class="berita-deskripsi">
                                                <strong>Deskripsi :</strong>
                                                <div style="margin-top: 5px;">
                                                    <?php echo substr(strip_tags($item->konten), 0, 300) . (strlen(strip_tags($item->konten)) > 300 ? '...' : ''); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-data">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada Informasi Setiap Saat yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>

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
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/informasi-setiap-saat.blade.php ENDPATH**/ ?>