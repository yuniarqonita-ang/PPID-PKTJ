<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin PPID PKTJ | Executive Panel</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700;900&display=swap');
            
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8fafc;
                color: #1e293b;
                min-height: 100vh;
                margin: 0;
            }
            
            .admin-wrapper {
                display: flex;
                min-height: 100vh;
                width: 100%;
            }

            .sidebar {
                width: 280px;
                background: #004a99;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                flex-shrink: 0;
                display: flex;
                flex-direction: column;
                box-shadow: 4px 0 15px rgba(0,0,0,0.05);
                z-index: 100;
            }

            .logo-section {
                padding: 40px 20px;
                text-align: center;
                margin-bottom: 10px;
            }
            
            .logo-section img {
                height: 50px;
                width: auto;
                margin: 0 auto 15px;
                display: block;
            }
            
            .logo-title {
                color: #ffffff;
                font-size: 20px;
                font-weight: 800;
                letter-spacing: 1px;
                text-transform: uppercase;
            }
            
            .logo-subtitle {
                color: #ffc107;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 3px;
                opacity: 0.9;
                margin-top: 5px;
            }

            .sidebar-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 10px 15px;
            }
            
            .sidebar-scroll::-webkit-scrollbar { width: 4px; }
            .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
            
            .nav-link {
                display: flex;
                align-items: center;
                padding: 12px 18px;
                color: rgba(255,255,255,0.85);
                text-decoration: none;
                transition: all 0.2s;
                font-size: 13px;
                font-weight: 600;
                border-radius: 8px;
                margin-bottom: 4px;
            }
            
            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }
            
            .nav-link.active {
                background: #ffc107;
                color: #004a99;
                font-weight: 700;
                box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
            }
            
            .nav-icon {
                margin-right: 12px;
                font-size: 16px;
                width: 20px;
                text-align: center;
                opacity: 0.8;
            }
            
            .accordion-toggle {
                width: 100%;
                background: none;
                border: none;
                display: flex;
                align-items: center;
                padding: 12px 18px;
                color: rgba(255,255,255,0.85);
                cursor: pointer;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                transition: 0.2s;
                margin-bottom: 2px;
            }
            
            .accordion-toggle:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }

            .accordion-toggle.active {
                color: #ffc107;
                background: rgba(0, 0, 0, 0.1);
            }
            
            .submenu {
                max-height: 0;
                overflow: hidden;
                transition: all 0.3s ease-out;
                background: rgba(0, 0, 0, 0.05);
                border-radius: 6px;
                margin-bottom: 5px;
            }
            .submenu.open { max-height: 600px; padding: 5px 0; }
            
            .submenu-link {
                display: block;
                padding: 10px 15px 10px 50px;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                font-size: 12px;
                border-radius: 6px;
                transition: 0.2s;
            }
            
            .submenu-link:hover, .submenu-link.active {
                color: #ffc107;
                background: rgba(255,255,255,0.05);
            }
            
            .sidebar-footer {
                padding: 20px;
                background: rgba(0, 0, 0, 0.1);
                border-top: 1px solid rgba(255,255,255,0.05);
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                background: #ffc107;
                color: #004a99;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 18px;
            }
            
            .main-content {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                background: #f8f9fa;
                margin-left: 280px;
            }
            
            .top-header {
                height: 70px;
                background: #ffffff;
                padding: 0 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0;
                position: sticky;
                top: 0;
                z-index: 90;
            }
            
            .page-title {
                font-size: 18px;
                font-weight: 700;
                color: #004a99;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            
            .content-area {
                padding: 30px;
                flex: 1;
            }

            /* Responsive Adjustments */
            @media (max-width: 1024px) {
                .sidebar { 
                    position: fixed !important;
                    left: -280px; 
                    transition: left 0.3s ease; 
                    z-index: 10001 !important;
                    box-shadow: 10px 0 30px rgba(0,0,0,0.25);
                }
                .sidebar.open { left: 0 !important; }
                .sidebar .nav-link,
                .sidebar .accordion-toggle,
                .sidebar .submenu-link {
                    pointer-events: auto !important;
                    position: relative;
                    z-index: 10002 !important;
                }
                .main-content { margin-left: 0 !important; }
            }
            /* MOBILE SIDEBAR OVERLAY */
            #sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 9998 !important;
                pointer-events: none;
            }
            #sidebar-overlay.active { 
                display: block !important; 
                pointer-events: auto !important;
            }

            /* ANIMATIONS */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.4s ease-out forwards;
            }

            /* FIX ACCORDION & MODALS OVERFLOW */
            .modal:not(.show) {
                display: none !important;
            }

            /* GLOBAL INTERACTION & SCROLL FIX */
            html, body {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                height: auto !important;
                min-height: 100vh !important;
                background-color: #f8fafc !important;
                position: relative !important;
            }

            /* FIX: GDrive iframe tidak scroll horizontal */
            .gdrive-preview-wrapper {
                width: 100% !important;
                max-width: 100% !important;
                overflow: hidden !important;
                box-sizing: border-box !important;
            }
            .gdrive-preview-wrapper iframe,
            .content-area iframe:not(.tox-edit-area__iframe),
            .prose iframe,
            article iframe {
                width: 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;
                border: none !important;
            }
            /* Fix konten TinyMCE hasil insert GDrive agar tidak overflow */
            .mce-content-body iframe,
            [class*="gdrive"] {
                max-width: 100% !important;
                overflow: hidden !important;
            }
            /* ============================================
               FIX TINYMCE EDITOR: BISA SCROLL ATAS-BAWAH
               ============================================ */
            /* Container utama TinyMCE: pastikan tidak clip konten */
            .tox-tinymce {
                overflow: visible !important;
                display: flex !important;
                flex-direction: column !important;
            }
            /* Sidebar toolbar wrapper – tidak boleh overflow:hidden */
            .tox-sidebar-wrap {
                overflow: visible !important;
                flex: 1 !important;
            }
            /* Area editable: bisa scroll atas-bawah */
            .tox-edit-area {
                flex: 1 !important;
                overflow-y: auto !important;
                overflow-x: hidden !important;
                position: relative !important;
            }
            /* Iframe editor itu sendiri */
            .tox-edit-area__iframe {
                width: 100% !important;
                /* Jangan set height:100% di sini – biarkan TinyMCE atur via JS */
                border: none !important;
                display: block !important;
                overflow: auto !important;
            }
            /* Pastikan body di dalam iframe bisa scroll */
            .tox-tinymce iframe body,
            .mce-content-body {
                overflow-y: auto !important;
                overflow-x: hidden !important;
            }
            /* Fix: Hilangkan whitespace putih kosong di bawah halaman admin */
            /* min-h-screen di dalam content-area menyebabkan ruang kosong berlebih */
            body .admin-wrapper .main-content .content-area .min-h-screen,
            body .admin-wrapper .main-content .content-area [class*="min-h-screen"],
            body .admin-wrapper .main-content .min-h-screen,
            body .admin-wrapper .main-content [class*="min-h-screen"] {
                min-height: 0 !important;
                height: auto !important;
            }

            /* Force Admin Panel Content Areas, forms, cards, and editors to expand fully to the right */
            .content-area,
            .content-area form,
            .content-area .max-w-3xl,
            .content-area .max-w-4xl,
            .content-area .max-w-5xl,
            .content-area .max-w-6xl,
            .content-area .max-w-7xl,
            .content-area .max-w-8xl,
            .content-area div[class*="max-w-"]:not(.max-w-xs):not(.max-w-sm):not(.max-w-md):not(.max-w-lg),
            .content-area .grid,
            .content-area div[class*="grid-cols-"] {
                width: 100% !important;
                max-width: 100% !important;
            }
            .tox-tinymce {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Override form grid columns to stack vertically on large screens for full-width editors, wrapping sidebars below horizontally */
            @media (min-width: 1024px) {
                .content-area form .grid[class*="lg:grid-cols-3"] {
                    display: flex !important;
                    flex-direction: column !important;
                    gap: 24px !important;
                }
                .content-area form .grid[class*="lg:grid-cols-3"] > [class*="lg:col-span-2"] {
                    width: 100% !important;
                    max-width: 100% !important;
                }
                .content-area form .grid[class*="lg:grid-cols-3"] > .space-y-6 {
                    width: 100% !important;
                    max-width: 100% !important;
                    display: grid !important;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
                    gap: 24px !important;
                    margin-top: 24px !important;
                }
                .content-area form .grid[class*="lg:grid-cols-3"] > .space-y-6 > div {
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                }
            }
        </style>
    <body class="antialiased overflow-y-auto">
        <div id="sidebar-overlay" onclick="toggleSidebar()"></div>
        <div class="admin-wrapper">
            <!-- SIDEBAR -->
            <div class="sidebar" id="sidebar">
                <div class="logo-section">
                    <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ">
                    <div class="logo-title">PPID PKTJ</div>
                    <div class="logo-subtitle">PANEL ADMIN</div>
                </div>
                
                <div class="sidebar-scroll">
                    <nav class="py-4">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-line nav-icon"></i> DASHBOARD
                        </a>

                        <button class="accordion-toggle {{ request()->is('admin/profil*') || request()->is('admin/pejabat*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-university nav-icon"></i> PROFIL PPID
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/profil*') || request()->is('admin/pejabat*') ? 'open' : '' }}">
                            <a href="{{ route('admin.pejabat.index') }}" class="submenu-link {{ request()->is('admin/pejabat*') ? 'active' : '' }}"><i class="fas fa-user-tie mr-1 text-[#004a99]"></i> Profil Pejabat PKTJ</a>
                            <a href="{{ route('admin.profil.edit', 'profil') }}" class="submenu-link {{ request()->is('admin/profil/profil*') ? 'active' : '' }}">Profil PPID</a>
                            <a href="{{ route('admin.profil.edit', 'tugas') }}" class="submenu-link {{ request()->is('admin/profil/tugas*') ? 'active' : '' }}">Tugas & Fungsi PPID</a>
                            <a href="{{ route('admin.profil.edit', 'visi') }}" class="submenu-link {{ request()->is('admin/profil/visi*') ? 'active' : '' }}">Visi & Misi</a>
                            <a href="{{ route('admin.profil.edit', 'struktur') }}" class="submenu-link {{ request()->is('admin/profil/struktur*') ? 'active' : '' }}">Struktur Organisasi</a>
                            <a href="{{ route('admin.regulasi.index') }}" class="submenu-link {{ request()->is('admin/regulasi*') || request()->is('admin/profil/regulasi*') ? 'active' : '' }}">Regulasi & Dasar Hukum</a>
                            <a href="{{ route('admin.profil.edit', 'kontak') }}" class="submenu-link {{ request()->is('admin/profil/kontak*') ? 'active' : '' }}">Kontak Kami</a>
                        </div>

                        <button class="accordion-toggle {{ request()->is('admin/informasi*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-database nav-icon"></i> INFORMASI PUBLIK
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/informasi*') ? 'open' : '' }}">
                            <a href="{{ route('admin.informasi.berkala.index') }}" class="submenu-link {{ request()->is('admin/informasi/berkala*') ? 'active' : '' }}">Informasi Berkala</a>
                            <a href="{{ route('admin.informasi.sertamerta.index') }}" class="submenu-link {{ request()->is('admin/informasi/serta-merta*') ? 'active' : '' }}">Informasi Serta Merta</a>
                            <a href="{{ route('admin.informasi.setiapsaat.index') }}" class="submenu-link {{ request()->is('admin/informasi/setiap-saat*') ? 'active' : '' }}">Informasi Setiap Saat</a>
                            <a href="{{ route('admin.informasi.dikecualikan.index') }}" class="submenu-link {{ request()->is('admin/informasi/dikecualikan*') ? 'active' : '' }}">Informasi Dikecualikan</a>
                        </div>

                        <button class="accordion-toggle {{ request()->is('admin/layanan*') || request()->is('admin/dokumen*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-concierge-bell nav-icon"></i> LAYANAN INFORMASI
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/layanan*') || request()->is('admin/dokumen*') ? 'open' : '' }}">
                            <a href="{{ route('admin.layanan.daftar-informasi') }}" class="submenu-link {{ request()->routeIs('admin.layanan.daftar-informasi*') ? 'active' : '' }}">Daftar Informasi Publik</a>
                            <a href="{{ route('admin.layanan.maklumat-pelayanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.maklumat-pelayanan*') ? 'active' : '' }}">Maklumat & Standar Biaya</a>
                            <a href="{{ route('admin.layanan.laporan-layanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-layanan*') ? 'active' : '' }}">Laporan Layanan</a>
                            <a href="{{ route('admin.layanan.laporan-akses') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-akses*') ? 'active' : '' }}">Laporan Akses</a>
                            <a href="{{ route('admin.layanan.laporan-survey') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-survey*') ? 'active' : '' }}">Laporan Survey</a>
                            <a href="{{ route('admin.layanan.aksesibilitas') }}" class="submenu-link {{ request()->routeIs('admin.layanan.aksesibilitas*') ? 'active' : '' }}">
                                <i class="fas fa-universal-access mr-1.5 text-[#ffc107]"></i> Layanan Inklusif (Braille)
                            </a>
                        </div>

                        <button class="accordion-toggle {{ request()->is('admin/prosedur*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-file-signature nav-icon"></i> PROSEDUR
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/prosedur*') ? 'open' : '' }}">
                            <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-permintaan*') ? 'active' : '' }}">SOP Permintaan</a>
                            <a href="{{ route('admin.prosedur.sop-keberatan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-keberatan*') ? 'active' : '' }}">SOP Keberatan</a>
                            <a href="{{ route('admin.prosedur.sop-sengketa') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-sengketa*') ? 'active' : '' }}">SOP Sengketa</a>
                        </div>

                        <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->routeIs('admin.faq.*') || request()->is('admin/faq*') ? 'active' : '' }}">
                            <i class="fas fa-question-circle nav-icon"></i> FAQ / PERTANYAAN
                        </a>

                        <a href="{{ route('admin.permohonan.index') }}" class="nav-link {{ request()->is('admin/permohonan*') && !request()->is('admin/permohonan/report*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open-text nav-icon"></i> PERMOHONAN INFORMASI
                        </a>

                        <a href="{{ route('admin.pemohon.index') }}" class="nav-link {{ request()->routeIs('admin.pemohon.*') ? 'active' : '' }}">
                            <i class="fas fa-id-card nav-icon"></i> VERIFIKASI PEMOHON
                        </a>

                        <a href="{{ route('admin.pesan-kontak.index') }}" class="nav-link {{ request()->is('admin/pesan-kontak*') ? 'active' : '' }}">
                            <i class="fas fa-inbox nav-icon"></i> PESAN KONTAK
                        </a>

                        <a href="{{ route('admin.permohonan.report') }}" class="nav-link {{ request()->is('admin/permohonan/report*') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice nav-icon"></i> LAPORAN BULANAN
                        </a>

                        <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper nav-icon"></i> BERITA & ARTIKEL
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog nav-icon"></i> MANAJEMEN USER
                        </a>
                        <a href="{{ route('admin.menu.index') }}" class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                            <i class="fas fa-compass nav-icon"></i> KELOLA MENU NAVIGASI
                        </a>
                        <a href="{{ route('dashboard.edit') }}" class="nav-link {{ request()->routeIs('dashboard.edit') ? 'active' : '' }}">
                            <i class="fas fa-images nav-icon"></i> HERO BANNER
                        </a>
                    </nav>
                </div>
                
                <div class="sidebar-footer">
                    <div class="flex items-center gap-3">
                        <div class="user-avatar text-sm">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div class="flex-1 min-w-0">
                            <div class="text-white text-xs font-bold truncate">{{ Auth::user()->name }}</div>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="text-[#ffc107] text-[10px] font-bold uppercase tracking-wider hover:underline border-none bg-transparent p-0 cursor-pointer">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <header class="top-header">
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 flex items-center justify-center bg-slate-100 rounded-lg text-[#004a99]">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="page-title">
                            Admin <span class="text-slate-400">Panel</span>
                        </h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden md:flex flex-col text-right">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ Auth::user()->role ?? 'Administrator' }}</span>
                        </div>
                        <div class="w-10 h-10 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-center text-slate-400">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                </header>
            <main class="content-area">
                <div class="animate-fade-in">
                    @yield('content')
                </div>
            </main>
            </div><!-- /.main-content -->
        </div><!-- /.admin-wrapper -->
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            }

            function toggleAccordion(button) {
                const submenu = button.nextElementSibling;
                const isOpening = !submenu.classList.contains('open');
                
                // Menutup submenu lainnya untuk merapikan
                document.querySelectorAll('.submenu').forEach(s => s.classList.remove('open'));
                document.querySelectorAll('.accordion-toggle').forEach(b => b.classList.remove('active'));
                
                if (isOpening) {
                    submenu.classList.add('open');
                    button.classList.add('active');
                }
            }
            
            $(document).ready(function() {
                // Remove any lingering Tailwind min-h-screen utilities that cause extra vertical space
                $('.content-area .min-h-screen, .content-area [class*="min-h-screen"]').removeClass('min-h-screen');
                $('.main-content .min-h-screen, .main-content [class*="min-h-screen"]').removeClass('min-h-screen');
                // Preserve submenu open state
                $('.submenu-link.active').each(function() {
                    $(this).closest('.submenu').addClass('open');
                    $(this).closest('.submenu').prev('.accordion-toggle').addClass('active');
                });
            });
        </script>
        
        <!-- PDF.js for Page Detection -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
        <!-- TinyMCE - ADVANCED PREMIUM CONFIG -->
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            // Global helpers for TinyMCE custom Page Blur Checkboxes
            window.updateBlurCheckboxes = function(totalPages, initialPagesStr) {
                const container = document.getElementById('dialog-checkboxes-container');
                if (!container) return;
                
                container.innerHTML = '';
                const total = parseInt(totalPages) || 0;
                
                const initialPages = initialPagesStr ? initialPagesStr.split(',').map(p => p.trim()) : [];
                
                for (let i = 1; i <= total; i++) {
                    const checked = initialPages.includes(String(i)) ? 'checked' : '';
                    const chkDiv = document.createElement('div');
                    chkDiv.style.display = 'flex';
                    chkDiv.style.alignItems = 'center';
                    chkDiv.style.gap = '6px';
                    chkDiv.style.background = '#f1f5f9';
                    chkDiv.style.padding = '5px 10px';
                    chkDiv.style.borderRadius = '6px';
                    chkDiv.style.border = '1px solid #cbd5e1';
                    chkDiv.style.fontSize = '12px';
                    chkDiv.style.cursor = 'pointer';
                    chkDiv.style.userSelect = 'none';
                    
                    chkDiv.innerHTML = `
                        <input type="checkbox" id="chk-page-${i}" value="${i}" ${checked} onchange="window.updateBlurredPagesValue()" style="cursor:pointer; width:14px; height:14px; margin:0;" />
                        <label for="chk-page-${i}" style="cursor:pointer; font-weight:600; color:#1e293b; margin:0;">Hal ${i}</label>
                    `;
                    container.appendChild(chkDiv);
                }
            };

            window.updateBlurredPagesValue = function() {
                const container = document.getElementById('dialog-checkboxes-container');
                if (!container) return;
                const checkboxes = container.querySelectorAll('input[type="checkbox"]');
                const checkedPages = [];
                checkboxes.forEach(chk => {
                    if (chk.checked) {
                        checkedPages.push(chk.value);
                    }
                });
                const hiddenInput = document.getElementById('dialog-blurred-pages-value');
                if (hiddenInput) {
                    hiddenInput.value = checkedPages.join(',');
                }
            };

            window.detectPdfPages = function(fileUrl) {
                if (!fileUrl) return;
                
                let absoluteUrl = null;
                
                // Parse Google Drive URL
                let gdriveId = null;
                const fileDMatch = fileUrl.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
                const openIdMatch = fileUrl.match(/[?&]id=([a-zA-Z0-9_-]+)/);
                if (fileDMatch) {
                    gdriveId = fileDMatch[1];
                } else if (openIdMatch) {
                    gdriveId = openIdMatch[1];
                }
                
                if (gdriveId) {
                    absoluteUrl = window.location.origin + '/proxy-gdrive/' + gdriveId;
                } else {
                    // Check if it's a PDF file
                    if (!fileUrl.toLowerCase().endsWith('.pdf') && !fileUrl.includes('.pdf?')) return;
                    
                    // Resolve absolute URL
                    absoluteUrl = fileUrl;
                    if (!fileUrl.startsWith('http') && !fileUrl.startsWith('//')) {
                        absoluteUrl = window.location.origin + (fileUrl.startsWith('/') ? '' : '/') + fileUrl;
                    }
                }
                
                const pdfjsLib = window['pdfjs-dist/build/pdf'];
                if (pdfjsLib && absoluteUrl) {
                    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
                    pdfjsLib.getDocument(absoluteUrl).promise.then(function(pdf) {
                        const pages = pdf.numPages;
                        const totalPagesInput = document.getElementById('dialog-total-pages');
                        if (totalPagesInput) {
                            totalPagesInput.value = pages;
                            window.updateBlurCheckboxes(pages, document.getElementById('dialog-blurred-pages-value')?.value || '');
                        }
                    }).catch(function(err) {
                        console.log('Error detecting pages:', err);
                    });
                }
            };

            tinymce.init({
                selector: '.tinymce-editor, #editor, [id^="editor_"], #deskripsi, #konten, #isi_informasi, #isi_maklumat, #isi_standar, #dasar_hukum, #deskripsi_singkat, textarea[name="konten"], textarea[name="deskripsi"], textarea[name="isi"], textarea[name="isi_informasi"], textarea[name="isi_maklumat"], textarea[name="isi_standar"], textarea[name="jawaban"], textarea[name="isi_prosedur"], textarea[name="dasar_hukum"], textarea[name="konsekuensi_dibuka"], textarea[name="konsekuensi_ditutup"], textarea[name="catatan"], textarea[name="keterangan"]',
                license_key: 'gpl',
                min_height: 400,
                max_height: 900,
                autoresize_bottom_margin: 30,
                object_resizing: 'img,table,iframe',
                menubar: 'file edit insert view format table tools help',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons', 'noneditable', 'autoresize'
                ],
                noneditable_noneditable_class: 'mce-no-border-dummy',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | ' +
                         'alignleft aligncenter alignright alignjustify | ' +
                         'table tableprops tablerowprops tablecellprops table_valign_menu tablemergecells tablesplitcells | ' +
                         'bullist numlist outdent indent | link image media emoticons | premium_blur insert_preview insert_gdrive | removeformat code fullscreen',
                table_appearance_options: true,
                table_grid: true,
                table_cell_advtab: true,
                table_row_advtab: true,
                table_advtab: true,
                table_resize_bars: true,
                table_responsive_width: true,
                table_default_styles: {
                    'width': '100%',
                    'border-collapse': 'collapse'
                },
                table_default_attributes: {
                    'class': 'table-custom-ppid'
                },
                table_toolbar: 'tableprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | tablemergecells tablesplitcells | alignleft aligncenter alignright alignjustify | table_valign_top table_valign_middle table_valign_bottom',
                color_map: [
                    '004A99', 'Navy PPID PKTJ',
                    '002B5C', 'Dark Navy',
                    '0284C7', 'Sky Blue',
                    '2563EB', 'Royal Blue',
                    'FFC107', 'Gold PKTJ',
                    'D97706', 'Amber Gold',
                    'DC2626', 'Red Accent',
                    '16A34A', 'Green Success',
                    '0F172A', 'Dark Text',
                    '475569', 'Slate Gray',
                    '94A3B8', 'Light Slate',
                    'FFFFFF', 'White',
                    'FEF08A', 'Highlight Kuning',
                    'BBF7D0', 'Highlight Hijau',
                    'BFDBFE', 'Highlight Biru',
                    'FECACA', 'Highlight Merah',
                    'FBCFE8', 'Highlight Pink',
                    'E2E8F0', 'Highlight Abu-abu'
                ],
                custom_colors: true,
                color_cols: 6,
                skin: 'oxide',
                content_css: 'default',
                content_style: 'body { font-family: "Inter", sans-serif; font-size: 16px; color: #334155; padding: 25px; line-height: 1.8; min-height: 250px; } ' +
                              'p { margin: 0 0 18px 0; line-height: 1.8; color: #334155; font-size: 16px; } ' +
                              'p:empty, p > br:only-child { min-height: 1.6em; display: block; margin-bottom: 18px; } ' +
                              'ol, ul { margin: 0 0 22px 0; padding-left: 28px; } ' +
                              'ol > li, ul > li { margin-bottom: 16px; line-height: 1.8; color: #334155; font-size: 16px; } ' +
                              'ol > li:last-child, ul > li:last-child { margin-bottom: 0; } ' +
                              'ol > li > p, ul > li > p { margin-bottom: 12px; } ' +
                              'ol > li > p:last-child, ul > li > p:last-child { margin-bottom: 0; } ' +
                              'table { border-collapse: collapse !important; width: 100% !important; margin: 20px 0 !important; border: 1.5px solid #cbd5e1 !important; border-radius: 12px; overflow: hidden; background: #ffffff !important; box-shadow: 0 4px 16px rgba(0,0,0,0.03); } ' +
                              'table th, table td { padding: 18px 24px !important; border: 1px solid #cbd5e1 !important; vertical-align: top !important; text-align: left; color: #334155 !important; line-height: 1.75 !important; font-size: 15px; } ' +
                              'table th { background: linear-gradient(135deg, #001e40 0%, #004a99 100%) !important; color: #ffffff !important; font-weight: 700; border: 1px solid rgba(255,255,255,0.2) !important; font-size: 15px; } ' +
                              'table th p, table td p, table th div, table td div { margin: 0 0 14px 0 !important; padding: 0 !important; line-height: 1.75 !important; } ' +
                              'table th p:empty, table td p:empty, table th p > br:only-child, table td p > br:only-child { min-height: 1.5em; display: block; margin-bottom: 14px !important; } ' +
                              'table td ul, table td ol { padding-left: 24px !important; margin: 0 0 14px 0 !important; } ' +
                              'table td li { margin-bottom: 12px !important; line-height: 1.75 !important; } ' +
                              'table td li:last-child { margin-bottom: 0 !important; } ' +
                              'table th > *:first-child, table td > *:first-child { margin-top: 0 !important; padding-top: 0 !important; } ' +
                              'table th > *:last-child, table td > *:last-child { margin-bottom: 0 !important; } ' +
                              'table tr:nth-child(even) td { background-color: #f8fafc; } ' +
                              'table tr:hover td { background-color: #f1f5f9; } ' +
                              'a, a:link, a:visited { color: #004a99; font-weight: 600; text-decoration: underline; text-underline-offset: 3px; } ' +
                              'a:hover { color: #002b5c; }',
                branding: false,
                promotion: false,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: "{{ route('admin.upload.image') }}",
                file_picker_types: 'image media',
                image_advtab: true,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: false,
                // Media embed configuration
                media_live_embeds: true,
                extended_valid_elements: 'iframe[src|title|width|height|allowfullscreen|frameborder|style]',
                // Handle CSRF Token for local uploads
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise((resolve, reject) => {
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', "{{ route('admin.upload.image') }}");
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                        xhr.upload.onprogress = function (e) {
                            progress(e.loaded / e.total * 100);
                        };

                        xhr.onload = function() {
                            var json;
                            if (xhr.status === 403) {
                                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                                return;
                            }
                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                            json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.location != 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            resolve(json.location);
                        };

                        xhr.onerror = function () {
                            reject('Image upload failed due to a Network Error.');
                        };

                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        xhr.send(formData);
                    });
                },
                file_picker_callback: function (callback, value, meta) {
                    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    let type = 'image' === meta.filetype ? 'Images' : 'Files';
                    let url  = "{{ route('admin.file-browser') }}";

                    tinymce.activeEditor.windowManager.openUrl({
                        url : url,
                        title : 'File Browser',
                        width : x * 0.8,
                        height : y * 0.8,
                        onMessage: (instance, data) => {
                            if (data.mceAction === 'fileSelected') {
                                callback(data.data.url);
                                instance.close();
                            }
                        }
                    });
                },
                file_picker_types: 'file image media',
                setup: function(editor) {
                    // Otomatis terapkan Standar Excel & Word: Rata Atas di setiap sel tabel
                    editor.on('init', function() {
                        editor.dom.select('table td, table th').forEach(function(cell) {
                            if (!cell.style.verticalAlign) {
                                cell.style.verticalAlign = 'top';
                            }
                        });
                    });

                    // Pastikan saat paste link GDrive ditangani tanpa mengganggu ketikan normal (TIDAK memakai keyup)
                    editor.on('PastePostProcess', function(e) {
                        try {
                            const gdriveRegex = /(https?:\/\/(?:drive|docs)\.google\.com\/[^\s<"']+)/gi;
                            const textNodes = editor.dom.select('p, span, div, td', e.node);
                            textNodes.forEach(node => {
                                const text = node.textContent || '';
                                const match = text.match(gdriveRegex);
                                if (match && match.length > 0) {
                                    const rawUrl = match[0];
                                    if (!node.querySelector('.gdrive-pdf-chip') && !node.classList.contains('gdrive-pdf-chip')) {
                                        const chipHtml = `<a href="${rawUrl}" target="_blank" class="gdrive-pdf-chip" style="display:inline-flex; align-items:center; gap:8px; background:#eff6ff; color:#004a99; padding:6px 14px; border-radius:10px; font-weight:700; border:1px solid #bfdbfe; text-decoration:none; margin:4px 2px;"><i class="fas fa-file-pdf" style="color:#e11d48; font-size:16px;"></i> <span>Dokumen PDF</span> <i class="fas fa-external-link-alt" style="font-size:11px; opacity:0.6;"></i></a>&nbsp;`;
                                        node.innerHTML = node.innerHTML.replace(rawUrl, chipHtml);
                                    }
                                }
                            });
                        } catch (err) {
                            console.log('GDrive paste error:', err);
                        }
                    });

                    editor.ui.registry.addButton('premium_blur', {
                        icon: 'lock',
                        tooltip: 'Apply Premium Blur to Selection',
                        onAction: function (_) {
                            editor.execCommand('mceToggleFormat', false, 'premium-blur');
                        }
                    });

                    // === CUSTOM TABLE VERTICAL ALIGNMENT TOOLS ===
                    editor.ui.registry.addButton('table_valign_top', {
                        text: '⬆️ Atas',
                        tooltip: 'Rata Atas Sel Tabel (Vertical Align Top)',
                        onAction: function () {
                            const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                            if (selectedCells.length > 0) {
                                selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'top'));
                            } else {
                                const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                if (cell) editor.dom.setStyle(cell, 'vertical-align', 'top');
                            }
                        }
                    });

                    editor.ui.registry.addButton('table_valign_middle', {
                        text: '↕️ Tengah',
                        tooltip: 'Rata Tengah Sel Tabel (Vertical Align Middle)',
                        onAction: function () {
                            const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                            if (selectedCells.length > 0) {
                                selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'middle'));
                            } else {
                                const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                if (cell) editor.dom.setStyle(cell, 'vertical-align', 'middle');
                            }
                        }
                    });

                    editor.ui.registry.addButton('table_valign_bottom', {
                        text: '⬇️ Bawah',
                        tooltip: 'Rata Bawah Sel Tabel (Vertical Align Bottom)',
                        onAction: function () {
                            const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                            if (selectedCells.length > 0) {
                                selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'bottom'));
                            } else {
                                const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                if (cell) editor.dom.setStyle(cell, 'vertical-align', 'bottom');
                            }
                        }
                    });

                    editor.ui.registry.addMenuButton('table_valign_menu', {
                        text: 'Posisi Tabel ↕',
                        tooltip: 'Atur Posisi Teks Sel Tabel (Atas, Tengah, Bawah)',
                        fetch: function (callback) {
                            var items = [
                                {
                                    type: 'menuitem',
                                    text: '⬆️ Rata Atas (Top)',
                                    onAction: function () {
                                        const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                                        if (selectedCells.length > 0) {
                                            selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'top'));
                                        } else {
                                            const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                            if (cell) editor.dom.setStyle(cell, 'vertical-align', 'top');
                                        }
                                    }
                                },
                                {
                                    type: 'menuitem',
                                    text: '↕️ Rata Tengah (Middle)',
                                    onAction: function () {
                                        const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                                        if (selectedCells.length > 0) {
                                            selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'middle'));
                                        } else {
                                            const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                            if (cell) editor.dom.setStyle(cell, 'vertical-align', 'middle');
                                        }
                                    }
                                },
                                {
                                    type: 'menuitem',
                                    text: '⬇️ Rata Bawah (Bottom)',
                                    onAction: function () {
                                        const selectedCells = editor.dom.select('td[data-mce-selected], th[data-mce-selected]');
                                        if (selectedCells.length > 0) {
                                            selectedCells.forEach(cell => editor.dom.setStyle(cell, 'vertical-align', 'bottom'));
                                        } else {
                                            const cell = editor.dom.getParent(editor.selection.getNode(), 'td,th');
                                            if (cell) editor.dom.setStyle(cell, 'vertical-align', 'bottom');
                                        }
                                    }
                                }
                            ];
                            callback(items);
                        }
                    });

                    // === Helper: Build preview box HTML ===
                    function buildPreviewBoxHtml(fullUrl, boxWidth, boxHeight, originalUrl, originalTitle, isBlurred, blurredPages) {
                        return `<iframe class="premium-box-outer" contenteditable="false" src="${fullUrl}" data-url="${originalUrl.replace(/"/g, '&quot;')}" data-title="${(originalTitle || '').replace(/"/g, '&quot;')}" data-width="${boxWidth}" data-height="${boxHeight}" data-blurred="${isBlurred ? '1' : '0'}" data-blurred-pages="${(blurredPages || '').replace(/"/g, '&quot;')}" style="border:none !important; outline:none !important; display:block; float:left; width:${boxWidth}px; height:${boxHeight}px; margin:0 15px 15px 0; max-width:100%;"></iframe>`;
                    }

                    // === Helper: Build full preview URL ===
                    function buildPreviewUrl(fileUrl, title, blurred, blurredPages) {
                        const baseUrl = "{{ route('preview.dokumen') }}";
                        let url = baseUrl + "?file=" + encodeURIComponent(fileUrl) + "&title=" + encodeURIComponent(title || 'Dokumen') + "&embed=1";
                        if (blurred) {
                            url += "&is_blurred=1";
                        }
                        if (blurredPages) {
                            url += "&blurred_pages=" + encodeURIComponent(blurredPages);
                        }
                        return url;
                    }

                    // === Helper: Open preview dialog (for insert AND edit) ===
                    function openPreviewDialog(dialogTitle, submitLabel, defaults, isGdrive, existingNode) {
                        let ratio = (parseInt(defaults.width) || 900) / (parseInt(defaults.height) || 600);

                        editor.windowManager.open({
                            title: dialogTitle,
                            body: {
                                type: 'panel',
                                items: [
                                    { type: 'input', name: 'url', label: isGdrive ? 'Google Drive Link (Sharing URL)' : 'File URL (e.g. storage/berita/file.pdf)', placeholder: isGdrive ? 'https://drive.google.com/file/d/...' : '' },
                                    { type: 'input', name: 'title', label: 'Document Title' },
                                    { type: 'grid', columns: 2, items: [
                                        { type: 'input', name: 'width', label: 'Width (px)' },
                                        { type: 'input', name: 'height', label: 'Height (px)' }
                                    ]},
                                    { type: 'checkbox', name: 'constrain', label: 'Constrain proportions' },
                                    { type: 'checkbox', name: 'blurred', label: 'Apply Premium Blur' },
                                    {
                                        type: 'htmlpanel',
                                        html: '<div style="margin-top:10px; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">' +
                                              '  <label style="font-weight:bold; font-size:13px; color:#0f172a; display:block; margin-bottom:6px;">Pilih Halaman yang Di-blur:</label>' +
                                              '  <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">' +
                                              '    <span style="font-size:12px; color:#475569;">Total Halaman Dokumen:</span>' +
                                              '    <input type="number" id="dialog-total-pages" value="5" min="1" max="100" oninput="window.updateBlurCheckboxes(this.value)" style="width:65px; padding:4px 8px; border:1px solid #cbd5e1; border-radius:4px; font-size:12px; font-weight:bold;" />' +
                                              '  </div>' +
                                              '  <div id="dialog-checkboxes-container" style="display:flex; flex-wrap:wrap; gap:8px; max-height:100px; overflow-y:auto; padding:4px; border:1px dashed #cbd5e1; border-radius:6px; background:white; min-height:40px;">' +
                                              '    <!-- Checkboxes generated dynamically -->' +
                                              '  </div>' +
                                              '  <input type="hidden" id="dialog-blurred-pages-value" />' +
                                              '</div>'
                                    }
                                ]
                            },
                            buttons: [
                                { type: 'cancel', text: 'Close' },
                                { type: 'submit', text: submitLabel, primary: true }
                            ],
                            initialData: defaults,
                            onChange: function (api, details) {
                                const data = api.getData();
                                const w = parseInt(data.width) || 0;
                                const h = parseInt(data.height) || 0;
                                if (data.constrain && w > 0 && h > 0) {
                                    if (details.name === 'width') {
                                        api.setData({ height: String(Math.round(w / ratio)) });
                                    } else if (details.name === 'height') {
                                        api.setData({ width: String(Math.round(h * ratio)) });
                                    }
                                }
                                if (details.name === 'constrain' && data.constrain && w > 0 && h > 0) {
                                    ratio = w / h;
                                }
                                if (details.name === 'url') {
                                    window.detectPdfPages(data.url);
                                }
                            },
                            onSubmit: function (api) {
                                const data = api.getData();
                                if (!data.url) return;

                                const blurredPagesVal = document.getElementById('dialog-blurred-pages-value') ? document.getElementById('dialog-blurred-pages-value').value : '';
                                const fullUrl = buildPreviewUrl(data.url, data.title, data.blurred, blurredPagesVal);
                                const boxWidth = parseInt(data.width) || 900;
                                const boxHeight = parseInt(data.height) || 600;
                                const html = buildPreviewBoxHtml(fullUrl, boxWidth, boxHeight, data.url, data.title, data.blurred, blurredPagesVal);

                                if (existingNode) {
                                    // Edit mode: replace existing node
                                    const tempDiv = editor.dom.create('div');
                                    tempDiv.innerHTML = html;
                                    const newNode = tempDiv.firstChild;
                                    editor.dom.replace(newNode, existingNode);
                                } else {
                                    // Insert mode
                                    editor.insertContent(html);
                                }
                                api.close();
                            }
                        });

                        // Dynamic checkboxes initialization
                        setTimeout(() => {
                            const savedBlurredPages = defaults.blurredPages || '';
                            let totalPagesVal = 5;
                            if (savedBlurredPages) {
                                const pagesArray = savedBlurredPages.split(',').map(p => parseInt(p.trim())).filter(p => !isNaN(p));
                                if (pagesArray.length > 0) {
                                    totalPagesVal = Math.max(5, Math.max(...pagesArray));
                                }
                            }
                            const totalPagesInput = document.getElementById('dialog-total-pages');
                            if (totalPagesInput) {
                                totalPagesInput.value = totalPagesVal;
                            }
                            window.updateBlurCheckboxes(totalPagesVal, savedBlurredPages);
                            
                            // Auto detect on open if URL exists
                            if (defaults.url) {
                                window.detectPdfPages(defaults.url);
                            }
                        }, 100);
                    }

                    // === Button: Insert GDrive ===
                    editor.ui.registry.addButton('insert_gdrive', {
                        icon: 'gdrive',
                        tooltip: 'Insert GDrive Document (Premium Box)',
                        onAction: function (_) {
                            openPreviewDialog('Insert Google Drive Preview', 'Insert GDrive', {
                                url: '', title: '', width: '500', height: '400', constrain: true, blurred: true, blurredPages: ''
                            }, true, null);
                        }
                    });

                    // === Button: Insert Document Preview ===
                    editor.ui.registry.addButton('insert_preview', {
                        icon: 'preview',
                        tooltip: 'Insert Document Preview (Premium Box)',
                        onAction: function (_) {
                            openPreviewDialog('Insert Document Preview', 'Insert', {
                                url: '', title: '', width: '500', height: '400', constrain: true, blurred: false, blurredPages: ''
                            }, false, null);
                        }
                    });

                    // === Listener: ObjectResized for manual drag scale ===
                    editor.on('ObjectResized', function (e) {
                        const target = e.target;
                        if (target && target.classList.contains('premium-box-outer')) {
                            const newWidth = e.width || target.clientWidth || target.style.width;
                            const newHeight = e.height || target.clientHeight || target.style.height;
                            const cleanWidth = String(newWidth).replace('px', '');
                            const cleanHeight = String(newHeight).replace('px', '');
                            
                            target.setAttribute('data-width', cleanWidth);
                            target.setAttribute('data-height', cleanHeight);
                            target.setAttribute('width', cleanWidth);
                            target.setAttribute('height', cleanHeight);
                            target.style.width = cleanWidth + 'px';
                            target.style.height = cleanHeight + 'px';
                        }
                    });

                    // === Right click (contextmenu) to edit existing preview box ===
                    editor.on('contextmenu', function (e) {
                        const box = e.target.closest('.premium-box-outer');
                        if (!box) return;

                        e.preventDefault();
                        e.stopPropagation();

                        const savedUrl = box.getAttribute('data-url') || '';
                        const savedTitle = box.getAttribute('data-title') || '';
                        const savedWidth = box.getAttribute('data-width') || '500';
                        const savedHeight = box.getAttribute('data-height') || '400';
                        const savedBlurred = box.getAttribute('data-blurred') === '1';
                        const savedBlurredPages = box.getAttribute('data-blurred-pages') || '';
                        const isGdrive = savedUrl.includes('drive.google.com');

                        openPreviewDialog(
                            isGdrive ? 'Edit Google Drive Preview' : 'Edit Document Preview',
                            'Save',
                            { url: savedUrl, title: savedTitle, width: savedWidth, height: savedHeight, constrain: true, blurred: savedBlurred, blurredPages: savedBlurredPages },
                            isGdrive,
                            box
                        );
                    });
                    
                    editor.on('init', function() {
                        editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
                        
                        // Periodic injector to ensure iframe previews are borderless, scrollable, and clean
                        setInterval(function() {
                            try {
                                editor.getDoc().querySelectorAll('iframe.premium-box-outer').forEach(function(iframe) {
                                    if (iframe.contentDocument && !iframe.contentDocument.getElementById('editor-borderless-style')) {
                                        const style = iframe.contentDocument.createElement('style');
                                        style.id = 'editor-borderless-style';
                                        style.innerHTML = `
                                            #top-bar, #bottom-bar { display: none !important; }
                                            :root { --toolbar-height: 0px !important; }
                                            html, body, #page-wrapper { height: 100% !important; overflow: hidden !important; background: transparent !important; }
                                            #scroll-area { height: 100% !important; overflow-y: auto !important; overflow-x: hidden !important; display: block !important; background: transparent !important; }
                                            .pdf-page-container { margin: 5px auto 15px auto !important; box-shadow: 0 1px 6px rgba(0,0,0,0.1) !important; border-radius: 8px !important; width: 95% !important; max-width: 95% !important; }
                                            #viewer-content { padding: 5px 0 !important; width: 100% !important; max-width: 100% !important; }
                                        `;
                                        iframe.contentDocument.head.appendChild(style);
                                    }
                                });
                            } catch(e) {}
                        }, 500);

                        // Capture wheel event on editor body and programmatically scroll the preview document
                        editor.getBody().addEventListener('wheel', function(e) {
                            const x = e.clientX;
                            const y = e.clientY;
                            const iframes = editor.getBody().querySelectorAll('iframe.premium-box-outer');
                            for (let iframe of iframes) {
                                const rect = iframe.getBoundingClientRect();
                                if (x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom) {
                                    if (iframe.contentDocument) {
                                        const scrollArea = iframe.contentDocument.getElementById('scroll-area');
                                        if (scrollArea) {
                                            e.preventDefault();
                                            scrollArea.scrollTop += e.deltaY;
                                            return;
                                        }
                                    }
                                }
                            }
                        }, { passive: false });
                    });

                    // Capture Backspace or Delete to cleanly remove selected preview boxes
                    editor.on('keydown', function(e) {
                        if (e.keyCode === 8 || e.keyCode === 46) { // Backspace or Delete
                            const selectedNode = editor.selection.getNode();
                            if (selectedNode && selectedNode.classList.contains('premium-box-outer')) {
                                e.preventDefault();
                                editor.dom.remove(selectedNode);
                                editor.nodeChanged();
                            }
                        }
                    });

                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                },
                formats: {
                    'premium-blur': { inline: 'span', classes: 'premium-blur' }
                },
                style_formats: [
                    { title: 'Premium Blur', format: 'premium-blur' },
                    { title: 'Premium Button', inline: 'span', classes: 'premium-cta-trigger' }
                ],
                content_style: 'body { font-family: "Inter", sans-serif; font-size: 16px; color: #0f172a; padding: 20px; line-height: 1.6; } ' +
                              '.premium-blur { filter: blur(5px); background: #f1f5f9; display: inline-block; padding: 2px 4px; border-radius: 4px; border: 1px dashed #004a99; } ' +
                              '.premium-box-outer { display: inline-block !important; vertical-align: bottom !important; cursor: pointer; outline: none !important; border: none !important; pointer-events: none !important; } ' +
                              '.mce-item-selected, .premium-box-outer.mce-item-selected { outline: none !important; border: none !important; box-shadow: none !important; } ' +
                              '[contenteditable=false] { outline: none !important; border: none !important; }'
            });
            
            $(document).on('submit', 'form', function() { if (typeof tinymce !== 'undefined') tinymce.triggerSave(); });
        </script>
        <!-- PREMIUM DOCUMENT VIEWER MODAL (UNIVERSAL) -->
        <style>
            #previewModal .modal-content { height:100%; background:#e8ecf0; border-radius:0; border:none; }
            #previewModal .modal-body { flex:1; padding:0; overflow:hidden; position:relative; }
            #previewModal .modal-body iframe { width:100%; height:100%; border:none; display:block; background:#e8ecf0; }
            #previewModal .btn-close-custom {
                position:absolute; top:10px; right:10px; z-index:9999;
                background:rgba(0,0,0,0.6); border:none; border-radius:50%;
                width:38px; height:38px; color:white; font-size:20px; font-weight:bold;
                cursor:pointer; display:flex; align-items:center; justify-content:center;
                line-height:1; backdrop-filter:blur(4px); transition:background 0.2s;
            }
            #previewModal .btn-close-custom:hover { background:rgba(0,0,0,0.85); }
        </style>
        <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true" style="z-index:9999;">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        <iframe id="previewIframe" src="" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle for Modal Previews -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const previewModal = document.getElementById('previewModal');
                const previewIframe = document.getElementById('previewIframe');

                if (previewModal && previewIframe) {
                    // Handle when modal is shown via data-bs-toggle
                    previewModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        if (button) {
                            const url = button.getAttribute('data-url');
                            if (url) previewIframe.src = url;
                        }
                    });

                    // Global listener for links inside content (TinyMCE or dynamic text)
                    document.addEventListener('click', function(e) {
                        const target = e.target.closest('a');
                        if (target && target.href) {
                            const url = target.href;

                            // Jangan intersep: btn-premium-action (tombol blur overlay) dan link ke permohonan
                            if (target.classList.contains('btn-premium-action') || 
                                url.includes('/permohonan-informasi') || 
                                url.includes('/permohonan')) {
                                return; // biarkan navigasi normal
                            }

                            const isPreview = url.includes('/preview-dokumen') || 
                                              url.includes('/preview-peraturan') || 
                                              url.includes('/dokumen/view/');
                            const isDirectDoc = url.includes('/storage/') && url.match(/\.(pdf|png|jpg|jpeg|webp)$/i);

                            if ((isPreview || isDirectDoc) && !target.hasAttribute('data-bs-toggle')) {
                                e.preventDefault();
                                if (typeof bootstrap !== 'undefined') {
                                    const modalInstance = bootstrap.Modal.getOrCreateInstance(previewModal);
                                    let finalUrl = url;
                                    if (isDirectDoc && !isPreview) {
                                        const relativePath = url.split('/storage/').pop();
                                        finalUrl = `/preview-dokumen?file=storage/${relativePath}`;
                                    }
                                    previewIframe.src = finalUrl;
                                    modalInstance.show();
                                } else {
                                    window.open(url, '_blank');
                                }
                            }
                        }
                    });

                    // Clear iframe when modal is hidden
                    previewModal.addEventListener('hidden.bs.modal', function () {
                        previewIframe.src = '';
                    });
                }
            });
        </script>
        <!-- REAL-TIME SUBMISSION ALERT TOAST & AUDIO CHIME -->
        <div id="realtime-notification-toast" style="display:none; position:fixed; top:20px; right:20px; z-index:99999; max-width:420px; width:90%; background:#004a99; color:white; padding:16px 20px; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.35); border:2px solid #ffc107;">
            <div style="display:flex; align-items:flex-start; gap:12px;">
                <div style="background:#ffc107; color:#002b5c; width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:20px; font-weight:bold;">
                    🔔
                </div>
                <div style="flex:1;">
                    <h5 id="notif-title" style="margin:0 0 4px 0; font-size:14px; font-weight:800; text-transform:uppercase; color:#ffc107;">Notifikasi Masuk!</h5>
                    <p id="notif-body" style="margin:0 0 10px 0; font-size:12px; line-height:1.4; opacity:0.9;">Permohonan informasi atau pesan kontak baru diterima.</p>
                    <a id="notif-link" href="#" style="display:inline-block; background:#ffc107; color:#002b5c; padding:6px 14px; border-radius:8px; font-size:11px; font-weight:800; text-decoration:none; text-transform:uppercase;">Buka Sekarang &rarr;</a>
                </div>
                <button onclick="document.getElementById('realtime-notification-toast').style.display='none'" style="background:transparent; border:none; color:white; font-size:18px; cursor:pointer;">&times;</button>
            </div>
        </div>

        <script>
            (function() {
                let lastPesanTime = localStorage.getItem('last_seen_pesan_time');
                let lastPermohonanTime = localStorage.getItem('last_seen_permohonan_time');

                function playLoudNotificationChime() {
                    try {
                        const AudioContext = window.AudioContext || window.webkitAudioContext;
                        if (!AudioContext) return;
                        const ctx = new AudioContext();
                        const now = ctx.currentTime;
                        
                        // Note 1 (D5)
                        const osc1 = ctx.createOscillator();
                        const gain1 = ctx.createGain();
                        osc1.type = 'sine';
                        osc1.frequency.setValueAtTime(587.33, now);
                        gain1.gain.setValueAtTime(0.6, now);
                        gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
                        osc1.connect(gain1);
                        gain1.connect(ctx.destination);
                        osc1.start(now);
                        osc1.stop(now + 0.35);

                        // Note 2 (A5)
                        const osc2 = ctx.createOscillator();
                        const gain2 = ctx.createGain();
                        osc2.type = 'sine';
                        osc2.frequency.setValueAtTime(880, now + 0.18);
                        gain2.gain.setValueAtTime(0.7, now + 0.18);
                        gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.55);
                        osc2.connect(gain2);
                        gain2.connect(ctx.destination);
                        osc2.start(now + 0.18);
                        osc2.stop(now + 0.55);

                        // Note 3 (High Loud D6)
                        const osc3 = ctx.createOscillator();
                        const gain3 = ctx.createGain();
                        osc3.type = 'triangle';
                        osc3.frequency.setValueAtTime(1174.66, now + 0.38);
                        gain3.gain.setValueAtTime(0.9, now + 0.38);
                        gain3.gain.exponentialRampToValueAtTime(0.001, now + 0.9);
                        osc3.connect(gain3);
                        gain3.connect(ctx.destination);
                        osc3.start(now + 0.38);
                        osc3.stop(now + 0.9);
                    } catch(e){}
                }

                function checkNewSubmissions() {
                    fetch("{{ route('admin.api.check-submissions') }}")
                        .then(r => r.json())
                        .then(data => {
                            if (data.status !== 'success') return;

                            if (lastPesanTime === null || lastPermohonanTime === null) {
                                // Initial setup: store current baseline
                                lastPesanTime = data.pesan_latest_time || 0;
                                lastPermohonanTime = data.permohonan_latest_time || 0;
                                localStorage.setItem('last_seen_pesan_time', lastPesanTime);
                                localStorage.setItem('last_seen_permohonan_time', lastPermohonanTime);
                                return;
                            }

                            // Check Permohonan Baru
                            if (data.permohonan_latest_time > parseInt(lastPermohonanTime)) {
                                lastPermohonanTime = data.permohonan_latest_time;
                                localStorage.setItem('last_seen_permohonan_time', lastPermohonanTime);
                                
                                playLoudNotificationChime();
                                showToast('🔴 PERMOHONAN INFORMASI BARU!', 
                                          'Pemohon: ' + (data.permohonan_latest_nama || 'Masyarakat'), 
                                          "{{ route('admin.permohonan.submissions') }}");
                            } 
                            // Check Pesan Kontak Baru
                            else if (data.pesan_latest_time > parseInt(lastPesanTime)) {
                                lastPesanTime = data.pesan_latest_time;
                                localStorage.setItem('last_seen_pesan_time', lastPesanTime);
                                
                                playLoudNotificationChime();
                                showToast('✉️ PESAN KONTAK BARU!', 
                                          'Dari: ' + (data.pesan_latest_nama || 'Pengunjung') + ' (' + (data.pesan_latest_judul || 'Pesan Baru') + ')', 
                                          "{{ route('admin.pesan-kontak.index') }}");
                            }
                        })
                        .catch(e => {});
                }

                function showToast(title, body, link) {
                    const toast = document.getElementById('realtime-notification-toast');
                    document.getElementById('notif-title').innerText = title;
                    document.getElementById('notif-body').innerText = body;
                    document.getElementById('notif-link').href = link;
                    toast.style.display = 'block';
                }

                // Poll every 8 seconds
                setInterval(checkNewSubmissions, 8000);
                setTimeout(checkNewSubmissions, 2000);
            })();
        </script>

        @stack('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
