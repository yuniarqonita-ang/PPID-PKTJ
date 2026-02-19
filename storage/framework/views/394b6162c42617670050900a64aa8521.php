<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Admin PPID PKTJ</title>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <style>
            /* Custom Scrollbar untuk Sidebar agar tetap estetik */
            .sidebar-scroll::-webkit-scrollbar { width: 4px; }
            .sidebar-scroll::-webkit-scrollbar-track { background: #0f172a; }
            .sidebar-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
            
            /* Efek Glassmorphism untuk Sidebar */
            .glass-nav {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(10px);
                border-right: 1px solid rgba(255, 255, 255, 0.1);
            }
            .nav-item-active {
                background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
                box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen">
            <!-- SIDEBAR BARU YANG LEBIH MENARIK -->
            <div class="w-72 bg-gradient-to-b from-slate-900 via-blue-950 to-slate-900 text-white hidden md:block shadow-2xl sticky top-0 h-screen flex flex-col border-r border-white/10">
                
                <!-- Logo Area -->
                <div class="h-20 flex items-center justify-center border-b border-white/10 bg-black/20">
                    <div class="text-center">
                        <h1 class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
                            ADMIN PPID
                        </h1>
                        <p class="text-[10px] text-slate-400 tracking-widest uppercase">Back Office System</p>
                    </div>
                </div>
                
                <nav class="flex-1 overflow-y-auto sidebar-scroll px-4 py-4">
                    <!-- Dashboard Link -->
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center py-3 px-4 rounded-xl mb-6 transition-all duration-300 group <?php echo e(request()->routeIs('dashboard') ? 'nav-item-active text-white' : 'hover:bg-white/10 text-slate-300'); ?>">
                        <span class="text-xl mr-3 group-hover:scale-110 transition-transform">🏠</span>
                        <span class="font-bold text-sm tracking-wide">DASHBOARD</span>
                    </a>

                    <!-- Group 1: Profil PPID -->
                    <div class="mb-6">
                        <div class="text-[10px] font-extrabold text-blue-400 uppercase px-4 mb-3 tracking-widest flex items-center">
                            <span class="w-2 h-2 rounded-full bg-blue-500 mr-2 animate-pulse"></span> PROFIL & IDENTITAS
                        </div>
                        <div class="space-y-1">
                            <?php $__currentLoopData = ['edit' => 'Profil Utama', 'tugas' => 'Tugas & Fungsi', 'visi' => 'Visi & Misi', 'struktur' => 'Struktur Organisasi', 'regulasi' => 'Regulasi PPID', 'kontak' => 'Kontak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.profil.'.$key)); ?>" 
                                   class="flex items-center py-2 px-4 rounded-lg text-xs font-medium transition-all duration-200 <?php echo e(request()->routeIs('admin.profil.'.$key) ? 'bg-blue-600/20 text-blue-300 border-l-2 border-blue-400' : 'text-slate-400 hover:text-white hover:bg-white/5 hover:pl-6'); ?>">
                                    <span class="mr-2 opacity-50">○</span> <?php echo e($label); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Group 2: Informasi Publik -->
                    <div class="mb-6">
                        <div class="text-[10px] font-extrabold text-yellow-500 uppercase px-4 mb-3 tracking-widest flex items-center">
                            <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span> INFORMASI PUBLIK
                        </div>
                        <div class="space-y-1">
                            <?php $__currentLoopData = ['berkala' => 'Info Berkala', 'sertamerta' => 'Info Serta Merta', 'setiapsaat' => 'Info Setiap Saat', 'dikecualikan' => 'Info Dikecualikan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('admin.informasi.'.$key)); ?>" 
                                   class="flex items-center py-2 px-4 rounded-lg text-xs font-medium transition-all duration-200 <?php echo e(request()->routeIs('admin.informasi.'.$key) ? 'bg-yellow-600/20 text-yellow-300 border-l-2 border-yellow-400' : 'text-slate-400 hover:text-white hover:bg-white/5 hover:pl-6'); ?>">
                                    <span class="mr-2 opacity-50">○</span> <?php echo e($label); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Group 3: Manajemen Konten -->
                    <div class="mb-8">
                        <div class="text-[10px] font-extrabold text-green-500 uppercase px-4 mb-3 tracking-widest flex items-center">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> UPDATE KONTEN
                        </div>
                        <?php
                            $menus = [
                                ['route' => 'admin.berita.index', 'icon' => '📰', 'label' => 'Berita Terkini'],
                                ['route' => 'admin.dokumen.index', 'icon' => '📁', 'label' => 'File Dokumen'],
                                ['route' => 'admin.faq.index', 'icon' => '❓', 'label' => 'FAQ System'],
                                ['route' => 'admin.prosedur.index', 'icon' => '⚙️', 'label' => 'SOP Layanan'],
                                ['route' => 'admin.users', 'icon' => '👥', 'label' => 'User Management'],
                            ];
                        ?>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route($menu['route'])); ?>" 
                               class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium mb-1 transition-all duration-200 <?php echo e(request()->routeIs($menu['route']) ? 'bg-green-600/20 text-green-300 border-l-2 border-green-400' : 'text-slate-400 hover:text-white hover:bg-white/5 hover:translate-x-1'); ?>">
                                <span class="mr-3 text-base"><?php echo e($menu['icon']); ?></span> <?php echo e($menu['label']); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Link Eksternal -->
                    <div class="mt-4 pt-4 border-t border-white/10">
                        <a href="<?php echo e(route('admin.lpse.index')); ?>" class="block py-2 px-4 text-[10px] text-slate-500 hover:text-white transition">↗ LPSE SYSTEM</a>
                        <a href="<?php echo e(route('admin.jdih.index')); ?>" class="block py-2 px-4 text-[10px] text-slate-500 hover:text-white transition">↗ JDIH KEMENHUB</a>
                    </div>
                </nav>
            </div>

            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center sticky top-0 z-20">
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Administrator</span>
                        <h2 class="text-lg font-bold text-slate-700 leading-tight"><?php echo e(Auth::user()->name); ?></h2>
                    </div>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full text-xs transition shadow-lg shadow-red-200">
                            KELUAR (LOGOUT)
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