<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container-fluid px-4 py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 shadow-sm rounded-xl border">
            <div>
                <h4 class="fw-bold m-0 text-gray-800">Selamat Datang, <?php echo e(Auth::user()->name); ?></h4>
                <small class="text-gray-500">Update Terakhir: <?php echo e($last_update); ?></small>
            </div>
            
            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm fw-bold px-4 rounded-pill shadow-sm">
                    KELUAR (LOGOUT)
                </button>
            </form>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-primary text-white">
                    <small class="text-uppercase fw-bold opacity-75">Total Berita</small>
                    <h2 class="fw-bold m-0"><?php echo e($totalBerita); ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-success text-white">
                    <small class="text-uppercase fw-bold opacity-75">Dokumen Publik</small>
                    <h2 class="fw-bold m-0"><?php echo e($totalDokumen); ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-warning text-dark">
                    <small class="text-uppercase fw-bold opacity-75">User Terdaftar</small>
                    <h2 class="fw-bold m-0"><?php echo e($totalUser); ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-xl p-3 bg-info text-white">
                    <small class="text-uppercase fw-bold opacity-75">Total FAQ</small>
                    <h2 class="fw-bold m-0"><?php echo e($totalFaq); ?></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-xl mb-4 border">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h6 class="fw-bold text-gray-700 m-0 text-uppercase">Publikasi Artikel Terkini</h6>
                    </div>
                    <div class="card-body p-5 text-center text-gray-400 italic font-medium">
                        <?php if($totalBerita > 0): ?>
                            <p class="text-gray-700 not-italic">Sistem mendeteksi <?php echo e($totalBerita); ?> artikel telah dipublikasikan.</p>
                            <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn btn-primary btn-sm mt-2">Kelola Berita</a>
                        <?php else: ?>
                            Belum ada konten berita.
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                <div class="card border-0 shadow-sm rounded-xl p-4 mb-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2">📂</span> MENU PROFIL PPID
                    </h6>
                    <div class="d-flex flex-wrap gap-2 text-sm text-gray-600">
                        <a href="<?php echo e(route('admin.profil.edit')); ?>" class="text-decoration-none hover:text-blue-600">● Profil</a>
                        <a href="<?php echo e(route('admin.profil.tugas')); ?>" class="text-decoration-none hover:text-blue-600">● Tugas</a>
                        <a href="<?php echo e(route('admin.profil.visi')); ?>" class="text-decoration-none hover:text-blue-600">● Visi Misi</a>
                        <a href="<?php echo e(route('admin.profil.struktur')); ?>" class="text-decoration-none hover:text-blue-600">● Struktur</a>
                        <a href="<?php echo e(route('admin.profil.regulasi')); ?>" class="text-decoration-none hover:text-blue-600">● Regulasi</a>
                        <a href="<?php echo e(route('admin.profil.kontak')); ?>" class="text-decoration-none hover:text-blue-600">● Kontak</a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-xl p-4 mb-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2 text-primary">📊</span> INFORMASI PUBLIK
                    </h6>
                    <div class="d-flex flex-wrap gap-2 text-sm text-gray-600">
                        <a href="<?php echo e(route('admin.informasi.berkala')); ?>" class="text-decoration-none">● Berkala</a>
                        <a href="<?php echo e(route('admin.informasi.sertamerta')); ?>" class="text-decoration-none">● Serta Merta</a>
                        <a href="<?php echo e(route('admin.informasi.setiapsaat')); ?>" class="text-decoration-none">● Setiap Saat</a>
                        <a href="<?php echo e(route('admin.informasi.dikecualikan')); ?>" class="text-decoration-none">● Dikecualikan</a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-xl p-4 border">
                    <h6 class="fw-bold text-gray-800 mb-3 flex align-items-center text-uppercase">
                        <span class="me-2 text-secondary">🔗</span> LAYANAN TERKAIT
                    </h6>
                    <div class="d-flex gap-3 text-xs fw-bold text-gray-500 text-uppercase">
                        <a href="<?php echo e(route('admin.lpse.index')); ?>" class="text-decoration-none text-primary">Data LPSE</a>
                        <a href="<?php echo e(route('admin.jdih.index')); ?>" class="text-decoration-none text-primary">JDIH</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>