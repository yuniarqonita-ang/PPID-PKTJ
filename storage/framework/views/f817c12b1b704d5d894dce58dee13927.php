<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Portal PPID PKTJ</title>
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
        .hero-section { 
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), url('https://via.placeholder.com/1920x600'); 
            background-size: cover; 
            color: white; 
            padding: 100px 0; 
            text-align: center; 
        }
        .faq-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .faq-title {
            font-size: 32px;
            font-weight: bold;
            color: #004a99;
            margin-bottom: 10px;
        }
        .faq-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
        }
        .faq-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .faq-question {
            background-color: #f7f9fc;
            padding: 1.25rem;
            font-weight: bold;
            color: #004a99;
        }
        .faq-answer {
            padding: 1.25rem;
            background-color: #fff;
            border-top: 1px solid #e0e0e0;
            line-height: 1.6;
            color: #333;
        }
    </style>
</head>
<body>

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <div class="faq-container">
            <h2 class="faq-title">Frequently asked questions</h2>
            <p class="faq-subtitle">Menampilkan <?php echo e($faqs->count()); ?> dari <?php echo e($faqs->count()); ?> FAQ yang tersedia.</p>

            <?php if($faqs->count()): ?>
                <div id="faq-list">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="faq-item">
                            <div class="faq-question">
                                <i class="fas fa-question-circle me-2"></i>
                                <?php echo e($faq->pertanyaan); ?>

                            </div>
                            <div class="faq-answer">
                                <p class="mb-0"><?php echo nl2br(e($faq->jawaban)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5 text-muted">
                    <div class="faq-item" style="opacity: 0.6; text-align: left;">
                        <div class="faq-question">
                            <i class="fas fa-question-circle me-2"></i>
                            Ini adalah contoh pertanyaan...
                        </div>
                        <div class="faq-answer">
                            <p class="mb-0">... dan ini adalah contoh jawaban. Konten FAQ akan muncul di sini jika sudah tersedia.</p>
                        </div>
                    </div>
                    <p class="mt-4">Belum ada FAQ yang tersedia saat ini.</p>
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
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/faq.blade.php ENDPATH**/ ?>