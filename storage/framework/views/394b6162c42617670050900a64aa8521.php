<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen">
            <div class="w-64 bg-slate-900 text-white hidden md:block shadow-xl">
                <div class="p-6 text-xl font-bold border-b border-slate-800 text-blue-400">
                    PPID BACK OFFICE
                </div>
                <nav class="mt-6 px-4 h-[calc(100vh-100px)] overflow-y-auto">
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 mb-2 <?php echo e(request()->routeIs('dashboard') ? 'bg-slate-800 border-l-4 border-blue-500' : ''); ?>">
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>

                    <div class="text-xs font-semibold text-slate-500 uppercase px-4 mt-4 mb-2">Konten</div>
                    <a href="<?php echo e(route('admin.berita.index')); ?>" class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 mb-2 <?php echo e(request()->routeIs('admin.berita.*') ? 'bg-slate-800 border-l-4 border-blue-500' : ''); ?>">
                        <span class="ml-3 font-medium">Kelola Berita</span>
                    </a>
                    <a href="<?php echo e(route('admin.dokumen.index')); ?>" class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 mb-2 <?php echo e(request()->routeIs('admin.dokumen.*') ? 'bg-slate-800 border-l-4 border-blue-500' : ''); ?>">
                        <span class="ml-3 font-medium">Kelola Dokumen</span>
                    </a>
                    <a href="<?php echo e(route('admin.faq.index')); ?>" class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 mb-2 <?php echo e(request()->routeIs('admin.faq.*') ? 'bg-slate-800 border-l-4 border-blue-500' : ''); ?>">
                        <span class="ml-3 font-medium">Kelola FAQ</span>
                    </a>

                    <div class="text-xs font-semibold text-slate-500 uppercase px-4 mt-4 mb-2">Sistem</div>
                    <a href="<?php echo e(route('admin.users')); ?>" class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 mb-2 <?php echo e(request()->routeIs('admin.users') ? 'bg-slate-800 border-l-4 border-blue-500' : ''); ?>">
                        <span class="ml-3 font-medium">User Management</span>
                    </a>
                </nav>
            </div>

            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-700">
                        Selamat Datang, <?php echo e(Auth::check() ? Auth::user()->name : 'Tamu'); ?>

                    </h2>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium flex items-center gap-2">
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </header>

                <main class="p-8">
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div>
    </body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/layouts/app.blade.php ENDPATH**/ ?>