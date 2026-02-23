<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi PPID - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; scroll-behavior: smooth; }
        @media (min-width: 992px) { .nav-item.dropdown:hover .dropdown-menu { display: block !important; margin-top: 0; } }
        .dropdown-menu { z-index: 1050 !important; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }
        .content-box { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); line-height: 1.8; }
        .content-box img { max-width: 100%; height: auto; margin-top: 20px; border-radius: 8px; }
    </style>
</head>
<body>
    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="container py-5">
        <h1 class="page-title"><?php echo e($profil->judul ?? 'Struktur Organisasi PPID'); ?></h1>
        <div class="content-box">
            <?php if($profil): ?>
                <?php if($profil->konten_pembuka): ?>
                    <div class="mb-4"><?php echo $profil->konten_pembuka; ?></div>
                <?php endif; ?>
                
                <?php if($profil->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $profil->gambar)); ?>" alt="<?php echo e($profil->judul); ?>">
                <?php endif; ?>
                
                <?php if($profil->konten_detail): ?>
                    <div class="mt-4"><?php echo $profil->konten_detail; ?></div>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-muted">Konten struktur organisasi PPID belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/profil-struktur-organisasi.blade.php ENDPATH**/ ?>