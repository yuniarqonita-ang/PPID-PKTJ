

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600">Selamat datang kembali di Panel Admin PPID PKTJ.</p>
</div>

<!-- Profil Cards Section -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Profil PPID</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Profil Utama -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-blue-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <i class="fas fa-building text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Profil PPID</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola profil dan identitas Politeknik Keselamatan Transportasi Jalan</p>
                <a href="<?php echo e(route('admin.profil.edit', 'profil')); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>

        <!-- Tugas & Fungsi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-yellow-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <i class="fas fa-tasks text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Tugas & Fungsi</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola tugas pokok dan fungsi organisasi</p>
                <a href="<?php echo e(route('admin.profil.edit', 'tugas')); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-green-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Visi & Misi</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola visi dan misi organisasi</p>
                <a href="<?php echo e(route('admin.profil.edit', 'visi')); ?>" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-red-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-red-100 text-red-500">
                        <i class="fas fa-sitemap text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Struktur Organisasi</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola struktur dan susunan organisasi</p>
                <a href="<?php echo e(route('admin.profil.edit', 'struktur')); ?>" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>

        <!-- Regulasi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-purple-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <i class="fas fa-file-contract text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Regulasi PPID</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola peraturan dan regulasi PPID</p>
                <a href="<?php echo e(route('admin.profil.edit', 'regulasi')); ?>" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden border-t-4 border-cyan-500">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-cyan-100 text-cyan-500">
                        <i class="fas fa-phone text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 ml-3">Kontak</h3>
                </div>
                <p class="text-gray-600 text-sm mb-4">Kelola informasi kontak organisasi</p>
                <a href="<?php echo e(route('admin.profil.edit', 'kontak')); ?>" class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
            <i class="fas fa-newspaper text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Berita</p>
            <p class="text-2xl font-bold text-gray-800"><?php echo e(\App\Models\Berita::count()); ?></p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
            <i class="fas fa-file-pdf text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Dokumen Publik</p>
            <p class="text-2xl font-bold text-gray-800"><?php echo e(\App\Models\Dokumen::count()); ?></p>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 flex items-center">
        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
            <i class="fas fa-users text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Permohonan Info</p>
            <p class="text-2xl font-bold text-gray-800">0</p> <!-- Nanti diganti real data -->
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 flex items-center">
        <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Pengajuan Keberatan</p>
            <p class="text-2xl font-bold text-gray-800">0</p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>