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
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
        <!-- Header Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
            <div class="max-w-full px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Selamat Datang, <?php echo e(Auth::user()->name); ?></h1>
                        <p class="text-blue-100 mt-2">Update Terakhir: <?php echo e($last_update); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full font-bold shadow-lg transition">
                            KELUAR (LOGOUT)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-full px-4 sm:px-6 lg:px-8 py-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-blue-600 hover:shadow-xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Total Berita</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalBerita); ?></h3>
                        </div>
                        <div class="text-blue-600 text-4xl">📰</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-500 hover:shadow-xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Dokumen Publik</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalDokumen); ?></h3>
                        </div>
                        <div class="text-yellow-500 text-4xl">📁</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-500 hover:shadow-xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">User Terdaftar</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalUser); ?></h3>
                        </div>
                        <div class="text-red-500 text-4xl">👥</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-500 hover:shadow-xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-semibold uppercase">Total FAQ</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalFaq); ?></h3>
                        </div>
                        <div class="text-green-500 text-4xl">❓</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Publikasi Artikel -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                            <h2 class="text-white font-bold text-lg">📰 PUBLIKASI ARTIKEL TERKINI</h2>
                        </div>
                        <div class="p-6">
                            <?php if($totalBerita > 0): ?>
                                <p class="text-gray-700 mb-4">Sistem mendeteksi <span class="font-bold text-blue-600"><?php echo e($totalBerita); ?></span> artikel telah dipublikasikan.</p>
                                <a href="<?php echo e(route('admin.berita.index')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition shadow-lg">
                                    Kelola Berita
                                </a>
                            <?php else: ?>
                                <p class="text-gray-400 italic">Belum ada konten berita.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <div class="space-y-4">
                    <!-- Profil PPID Menu -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                            <h3 class="text-white font-bold flex items-center">
                                <span class="mr-2">📂</span> PROFIL PPID
                            </h3>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="<?php echo e(route('admin.profil.edit')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Profil
                            </a>
                            <a href="<?php echo e(route('admin.profil.tugas')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Tugas & Fungsi
                            </a>
                            <a href="<?php echo e(route('admin.profil.visi')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Visi & Misi
                            </a>
                            <a href="<?php echo e(route('admin.profil.struktur')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Struktur Organisasi
                            </a>
                            <a href="<?php echo e(route('admin.profil.regulasi')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Regulasi PPID
                            </a>
                            <a href="<?php echo e(route('admin.profil.kontak')); ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700 font-medium hover:text-blue-600 transition border-l-4 border-transparent hover:border-blue-600">
                                ● Kontak
                            </a>
                        </div>
                    </div>

                    <!-- Informasi Publik Menu -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                            <h3 class="text-white font-bold flex items-center">
                                <span class="mr-2">📊</span> INFORMASI PUBLIK
                            </h3>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="<?php echo e(route('admin.informasi.berkala')); ?>" class="block px-4 py-2 rounded-lg hover:bg-yellow-50 text-gray-700 font-medium hover:text-yellow-600 transition border-l-4 border-transparent hover:border-yellow-600">
                                ● Berkala
                            </a>
                            <a href="<?php echo e(route('admin.informasi.sertamerta')); ?>" class="block px-4 py-2 rounded-lg hover:bg-yellow-50 text-gray-700 font-medium hover:text-yellow-600 transition border-l-4 border-transparent hover:border-yellow-600">
                                ● Serta Merta
                            </a>
                            <a href="<?php echo e(route('admin.informasi.setiapsaat')); ?>" class="block px-4 py-2 rounded-lg hover:bg-yellow-50 text-gray-700 font-medium hover:text-yellow-600 transition border-l-4 border-transparent hover:border-yellow-600">
                                ● Setiap Saat
                            </a>
                            <a href="<?php echo e(route('admin.informasi.dikecualikan')); ?>" class="block px-4 py-2 rounded-lg hover:bg-yellow-50 text-gray-700 font-medium hover:text-yellow-600 transition border-l-4 border-transparent hover:border-yellow-600">
                                ● Dikecualikan
                            </a>
                        </div>
                    </div>

                    <!-- Layanan Terkait Menu -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                            <h3 class="text-white font-bold flex items-center">
                                <span class="mr-2">🔗</span> LAYANAN TERKAIT
                            </h3>
                        </div>
                        <div class="p-4 flex gap-2">
                            <a href="<?php echo e(route('admin.lpse.index')); ?>" class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2 px-3 rounded-lg text-center transition uppercase text-sm">
                                LPSE
                            </a>
                            <a href="<?php echo e(route('admin.jdih.index')); ?>" class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2 px-3 rounded-lg text-center transition uppercase text-sm">
                                JDIH
                            </a>
                        </div>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>