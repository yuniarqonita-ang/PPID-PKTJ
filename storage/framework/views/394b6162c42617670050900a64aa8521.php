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
            <!-- SIDEBAR ACCORDION MODERN -->
            <div class="w-80 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white hidden md:flex md:flex-col shadow-2xl fixed top-0 left-0 h-screen border-r border-blue-500/20 z-30">
                
                <!-- Logo Area -->
                <div class="h-24 flex items-center justify-center border-b border-blue-500/20 bg-gradient-to-r from-blue-950/50 to-purple-950/50 backdrop-blur-xl">
                    <div class="text-center">
                        <h1 class="text-3xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-cyan-300 mb-1">
                            PPID PKTJ
                        </h1>
                        <p class="text-[9px] text-slate-400 tracking-widest uppercase font-bold">Management Panel</p>
                    </div>
                </div>
                
                <nav class="flex-1 overflow-y-auto sidebar-scroll px-3 py-4 space-y-2">
                    <!-- Dashboard Link -->
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center py-3 px-4 rounded-lg transition-all duration-300 group <?php echo e(request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'hover:bg-slate-800/50 text-slate-300'); ?>">
                        <span class="text-2xl mr-3 group-hover:scale-110 transition-transform">🏠</span>
                        <span class="font-bold text-sm tracking-wide">DASHBOARD</span>
                    </a>

                    <!-- ==================== ACCORDION GROUP 1: PROFIL PPID ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-blue-600/20 to-blue-500/10 hover:from-blue-600/30 hover:to-blue-500/20 border border-blue-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">📋</span>
                                <span class="font-bold text-sm text-blue-300 tracking-wider uppercase">Profil PPID</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-blue-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="<?php echo e(route('admin.profil.edit', 'profil')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'profil' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Profil PPID
                            </a>
                            <a href="<?php echo e(route('admin.profil.edit', 'tugas')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'tugas' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Tugas dan tanggung jawab PPID
                            </a>
                            <a href="<?php echo e(route('admin.profil.edit', 'visi')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'visi' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Visi dan misi PPID
                            </a>
                            <a href="<?php echo e(route('admin.profil.edit', 'struktur')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'struktur' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Struktur organisasi
                            </a>
                            <a href="<?php echo e(route('admin.profil.edit', 'regulasi')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'regulasi' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Regulasi
                            </a>
                            <a href="<?php echo e(route('admin.profil.edit', 'kontak')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-blue-500/20 hover:border-l-2 hover:border-blue-400 transition-all duration-200 <?php echo e(request()->get('type') === 'kontak' ? 'bg-blue-500/30 text-blue-300 border-l-2 border-blue-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Kontak
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 2: INFORMASI PUBLIK ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-yellow-600/20 to-yellow-500/10 hover:from-yellow-600/30 hover:to-yellow-500/20 border border-yellow-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">📰</span>
                                <span class="font-bold text-sm text-yellow-300 tracking-wider uppercase">Informasi Publik</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-yellow-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="<?php echo e(route('admin.informasi.berkala')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-yellow-500/20 hover:border-l-2 hover:border-yellow-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.informasi.berkala') ? 'bg-yellow-500/30 text-yellow-300 border-l-2 border-yellow-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Informasi berkala
                            </a>
                            <a href="<?php echo e(route('admin.informasi.sertamerta')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-yellow-500/20 hover:border-l-2 hover:border-yellow-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.informasi.sertamerta') ? 'bg-yellow-500/30 text-yellow-300 border-l-2 border-yellow-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Informasi serta merta
                            </a>
                            <a href="<?php echo e(route('admin.informasi.setiapsaat')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-yellow-500/20 hover:border-l-2 hover:border-yellow-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.informasi.setiapsaat') ? 'bg-yellow-500/30 text-yellow-300 border-l-2 border-yellow-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Informasi setiap saat
                            </a>
                            <a href="<?php echo e(route('admin.informasi.dikecualikan')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-yellow-500/20 hover:border-l-2 hover:border-yellow-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.informasi.dikecualikan') ? 'bg-yellow-500/30 text-yellow-300 border-l-2 border-yellow-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Informasi dikecualikan
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 3: LAYANAN INFORMASI ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-purple-600/20 to-purple-500/10 hover:from-purple-600/30 hover:to-purple-500/20 border border-purple-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">📋</span>
                                <span class="font-bold text-sm text-purple-300 tracking-wider uppercase">Layanan Informasi</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-purple-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Daftar informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Maklumat pelayanan dan standar biaya
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Laporan layanan informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Laporan akses informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Laporan survey kepuasan layanan informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-purple-500/20 hover:border-l-2 hover:border-purple-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> JDIH kementrian perhubungan
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 4: PROSEDUR ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-orange-600/20 to-orange-500/10 hover:from-orange-600/30 hover:to-orange-500/20 border border-orange-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">⚙️</span>
                                <span class="font-bold text-sm text-orange-300 tracking-wider uppercase">Prosedur</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-orange-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP permintaan informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP penanganan keberatan
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP pengajuan sengketa informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP penetapan dan pemiktakhiran daftar informasi publik
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP pengujian konsekuensi
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-orange-500/20 hover:border-l-2 hover:border-orange-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> SOP pendokumentasian informasi publik
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 5: LPSE ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-green-600/20 to-green-500/10 hover:from-green-600/30 hover:to-green-500/20 border border-green-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">🏪</span>
                                <span class="font-bold text-sm text-green-300 tracking-wider uppercase">LPSE</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-green-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-green-500/20 hover:border-l-2 hover:border-green-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Pengadaan barang dan jasa
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-green-500/20 hover:border-l-2 hover:border-green-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Informasi pengadaan barang dan jasa
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-green-500/20 hover:border-l-2 hover:border-green-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Dokumen pengadaan barang dan jasa
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-green-500/20 hover:border-l-2 hover:border-green-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Informasi penyedia
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-green-500/20 hover:border-l-2 hover:border-green-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Permohonan informasi
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 6: FAQ & PERMOHONAN ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-pink-600/20 to-pink-500/10 hover:from-pink-600/30 hover:to-pink-500/20 border border-pink-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">❓</span>
                                <span class="font-bold text-sm text-pink-300 tracking-wider uppercase">FAQ & Permohonan</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-pink-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="<?php echo e(route('admin.faq.index')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-pink-500/20 hover:border-l-2 hover:border-pink-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.faq.index') ? 'bg-pink-500/30 text-pink-300 border-l-2 border-pink-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> FAQ
                            </a>
                            <a href="#" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-pink-500/20 hover:border-l-2 hover:border-pink-400 transition-all duration-200">
                                <span class="mr-2 opacity-70">▸</span> Permohonan informasi
                            </a>
                        </div>
                    </div>

                    <!-- ==================== ACCORDION GROUP 7: KONTEN LAINNYA ==================== -->
                    <div class="accordion-item pt-2">
                        <button class="accordion-toggle w-full flex items-center justify-between py-3 px-4 rounded-lg bg-gradient-to-r from-cyan-600/20 to-cyan-500/10 hover:from-cyan-600/30 hover:to-cyan-500/20 border border-cyan-500/30 transition-all duration-300 group"
                                onclick="toggleAccordion(this)">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">📝</span>
                                <span class="font-bold text-sm text-cyan-300 tracking-wider uppercase">Konten & Berita</span>
                            </div>
                            <span class="accordion-arrow text-slate-400 group-hover:text-cyan-300 transition-all duration-300">▼</span>
                        </button>
                        <div class="accordion-content hidden space-y-1 mt-2 ml-2">
                            <a href="<?php echo e(route('admin.berita.index')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-cyan-500/20 hover:border-l-2 hover:border-cyan-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.berita.index') ? 'bg-cyan-500/30 text-cyan-300 border-l-2 border-cyan-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> Berita Terkini
                            </a>
                            <a href="<?php echo e(route('admin.dokumen.index')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-cyan-500/20 hover:border-l-2 hover:border-cyan-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.dokumen.index') ? 'bg-cyan-500/30 text-cyan-300 border-l-2 border-cyan-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> File Dokumen
                            </a>
                            <a href="<?php echo e(route('admin.users')); ?>" class="flex items-center py-2.5 px-4 rounded-lg text-xs font-medium text-slate-300 hover:text-white hover:bg-cyan-500/20 hover:border-l-2 hover:border-cyan-400 transition-all duration-200 <?php echo e(request()->routeIs('admin.users') ? 'bg-cyan-500/30 text-cyan-300 border-l-2 border-cyan-400' : ''); ?>">
                                <span class="mr-2 opacity-70">▸</span> User Management
                            </a>
                        </div>
                    </div>

                </nav>

                <!-- Footer -->
                <div class="border-t border-slate-700/50 bg-slate-950/50 backdrop-blur-xl p-3 text-center">
                    <p class="text-[9px] text-slate-500 font-semibold tracking-wider uppercase">Admin Panel v2.1</p>
                </div>
            </div>

            <div class="flex-1 flex flex-col">
                <header class="bg-gray-800 shadow-sm py-4 px-8 flex justify-between items-center sticky top-0 z-20 border-b border-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs text-yellow-400 font-bold uppercase tracking-wider">Administrator</span>
                        <h2 class="text-lg font-bold text-yellow-300 leading-tight"><?php echo e(Auth::user()->name); ?></h2>
                    </div>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full text-xs transition shadow-lg shadow-red-200">
                            KELUAR (LOGOUT)
                        </button>
                    </form>
                </header>

                <main class="w-full" style="margin-left: 320px; padding: 32px; max-width: calc(100vw - 320px);">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>

        <!-- ACCORDION JAVASCRIPT -->
        <script>
            // Accordion Toggle Function
            function toggleAccordion(button) {
                const accordionItem = button.closest('.accordion-item');
                const content = accordionItem.querySelector('.accordion-content');
                const arrow = button.querySelector('.accordion-arrow');
                
                // Close all other accordion items
                document.querySelectorAll('.accordion-item').forEach(item => {
                    if (item !== accordionItem) {
                        item.querySelector('.accordion-content').classList.add('hidden');
                        item.querySelector('.accordion-arrow').style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current accordion
                content.classList.toggle('hidden');
                
                // Rotate arrow based on state
                if (content.classList.contains('hidden')) {
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    arrow.style.transform = 'rotate(180deg)';
                }
                
                // Save state to localStorage
                const accordionName = button.querySelector('span:nth-child(2)').textContent.trim();
                const isOpen = !content.classList.contains('hidden');
                localStorage.setItem('accordion_' + accordionName, isOpen);
            }

            // Restore accordion state on page load
            window.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.accordion-item').forEach(item => {
                    const button = item.querySelector('.accordion-toggle');
                    const accordionName = button.querySelector('span:nth-child(2)').textContent.trim();
                    const wasOpen = localStorage.getItem('accordion_' + accordionName) === 'true';
                    
                    if (wasOpen) {
                        toggleAccordion(button);
                    }
                });

                // Optional: Expand the first accordion on initial load (comment out if not needed)
                // const firstToggle = document.querySelector('.accordion-toggle');
                // if (firstToggle) toggleAccordion(firstToggle);
            });

            // Add smooth scroll for sidebar
            const sidebar = document.querySelector('.sidebar-scroll');
            if (sidebar) {
                sidebar.addEventListener('mouseenter', function() {
                    this.style.scrollBehavior = 'smooth';
                });
            }
        </script>

        <!-- ACCORDION STYLES -->
        <style>
            .accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
                opacity: 0;
            }

            .accordion-content:not(.hidden) {
                max-height: 500px;
                opacity: 1;
            }

            .accordion-arrow {
                display: inline-block;
                transition: transform 0.3s ease-in-out;
                font-size: 0.85em;
            }

            /* Smooth hover effects for accordion items */
            .accordion-item .accordion-toggle:active {
                transform: scale(0.98);
            }

            /* Custom scrollbar for sidebar */
            .sidebar-scroll {
                scrollbar-width: thin;
                scrollbar-color: rgba(59, 130, 246, 0.5) rgba(15, 23, 42, 0.1);
            }

            .sidebar-scroll::-webkit-scrollbar {
                width: 6px;
            }

            .sidebar-scroll::-webkit-scrollbar-track {
                background: rgba(15, 23, 42, 0.1);
                border-radius: 10px;
            }

            .sidebar-scroll::-webkit-scrollbar-thumb {
                background: rgba(59, 130, 246, 0.5);
                border-radius: 10px;
                transition: background 0.3s;
            }

            .sidebar-scroll::-webkit-scrollbar-thumb:hover {
                background: rgba(59, 130, 246, 0.8);
            }

            /* Active state styling */
            .nav-item-active {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(139, 92, 246, 0.2) 100%);
                border-left: 3px solid rgb(59, 130, 246);
                padding-left: calc(1rem - 3px);
            }
        </style>
    </body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/layouts/app.blade.php ENDPATH**/ ?>