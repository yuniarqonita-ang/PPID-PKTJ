<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin PPID PKTJ</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }
            
            .sidebar {
                width: 280px;
                background: linear-gradient(180deg, #1a1c2e 0%, #2d3561 100%);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                overflow-y: auto;
            }
            
            .sidebar::-webkit-scrollbar {
                width: 6px;
            }
            
            .sidebar::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
            }
            
            .sidebar::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 3px;
            }
            
            .logo-section {
                padding: 30px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                text-align: center;
                background: rgba(255, 255, 255, 0.05);
            }
            
            .logo-section img {
                width: 80px;
                height: 80px;
                object-fit: contain;
                margin-bottom: 15px;
                filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            }
            
            .logo-title {
                color: #fff;
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 5px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }
            
            .logo-subtitle {
                color: #a0a0a0;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 500;
            }
            
            .nav-menu {
                padding: 20px 0;
            }
            
            .nav-item {
                margin-bottom: 5px;
            }
            
            .nav-link {
                display: flex;
                align-items: center;
                padding: 15px 25px;
                color: #b0b0b0;
                text-decoration: none;
                transition: all 0.3s ease;
                font-size: 14px;
                font-weight: 500;
                position: relative;
                overflow: hidden;
            }
            
            .nav-link:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
                padding-left: 30px;
            }
            
            .nav-link.active {
                color: #fff;
                background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }
            
            .nav-link.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
                background: #fff;
            }
            
            .nav-icon {
                margin-right: 15px;
                font-size: 18px;
                width: 20px;
                text-align: center;
            }
            
            .accordion-toggle {
                background: none;
                border: none;
                color: #b0b0b0;
                cursor: pointer;
                width: 100%;
                text-align: left;
                font-size: 14px;
                font-weight: 500;
                padding: 15px 25px;
                transition: all 0.3s ease;
                position: relative;
            }
            
            .accordion-toggle:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
                padding-left: 30px;
            }
            
            .accordion-toggle.active {
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
            }
            
            .submenu {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                background: rgba(0, 0, 0, 0.2);
            }
            
            .submenu.open {
                max-height: 500px;
            }
            
            .submenu-link {
                display: block;
                padding: 12px 25px 12px 60px;
                color: #a0a0a0;
                text-decoration: none;
                font-size: 13px;
                transition: all 0.3s ease;
                border-left: 2px solid transparent;
            }
            
            .submenu-link:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.05);
                border-left-color: #667eea;
            }
            
            .submenu-link.active {
                color: #fff;
                background: rgba(102, 126, 234, 0.2);
                border-left-color: #667eea;
            }
            
            .main-content {
                margin-left: 280px;
                min-height: 100vh;
                background: #f8f9fa;
            }
            
            .top-header {
                background: #fff;
                padding: 20px 30px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .page-title {
                font-size: 24px;
                font-weight: 600;
                color: #2c3e50;
                margin: 0;
            }
            
            .user-menu {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            
            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: 600;
                font-size: 16px;
            }
            
            .content-area {
                padding: 30px;
            }
            
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }
                
                .sidebar.open {
                    transform: translateX(0);
                }
                
                .main-content {
                    margin-left: 0;
                }
                
                .mobile-menu-toggle {
                    display: block;
                    position: fixed;
                    top: 20px;
                    left: 20px;
                    z-index: 1001;
                    background: #fff;
                    border: none;
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    cursor: pointer;
                }
            }
            
            @media (min-width: 769px) {
                .mobile-menu-toggle {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="mobile-menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        
        <div class="sidebar" id="sidebar">
            <div class="logo-section">
                <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ">
                <div class="logo-title">PPID PKTJ</div>
                <div class="logo-subtitle">Management Panel</div>
            </div>
            
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        Dashboard
                    </a>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-users nav-icon"></i>
                        Profil PPID
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.profil.index') }}" class="submenu-link {{ request()->is('admin/profil*') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Kelola Profil
                        </a>
                        <a href="{{ route('admin.profil.edit', 'profil') }}" class="submenu-link {{ request()->get('type') === 'profil' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Profil PPID
                        </a>
                        <a href="{{ route('admin.profil.edit', 'tugas') }}" class="submenu-link {{ request()->get('type') === 'tugas' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Tugas dan Tanggung Jawab PPID
                        </a>
                        <a href="{{ route('admin.profil.edit', 'visi') }}" class="submenu-link {{ request()->get('type') === 'visi' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Visi dan Misi PPID
                        </a>
                        <a href="{{ route('admin.profil.edit', 'struktur') }}" class="submenu-link {{ request()->get('type') === 'struktur' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Struktur Organisasi
                        </a>
                        <a href="{{ route('admin.profil.edit', 'regulasi') }}" class="submenu-link {{ request()->get('type') === 'regulasi' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Regulasi
                        </a>
                        <a href="{{ route('admin.profil.edit', 'kontak') }}" class="submenu-link {{ request()->get('type') === 'kontak' ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Kontak
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-newspaper nav-icon"></i>
                        Informasi Publik
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.informasi.berkala') }}" class="submenu-link {{ request()->routeIs('admin.informasi.berkala') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Informasi Berkala
                        </a>
                        <a href="{{ route('admin.informasi.sertamerta') }}" class="submenu-link {{ request()->routeIs('admin.informasi.sertamerta') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Informasi Serta Merta
                        </a>
                        <a href="{{ route('admin.informasi.setiapsaat') }}" class="submenu-link {{ request()->routeIs('admin.informasi.setiapsaat') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Informasi Setiap Saat
                        </a>
                        <a href="{{ route('admin.informasi.dikecualikan') }}" class="submenu-link {{ request()->routeIs('admin.informasi.dikecualikan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Informasi Dikecualikan
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-concierge-bell nav-icon"></i>
                        Layanan Informasi
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.layanan.daftar-informasi') }}" class="submenu-link {{ request()->routeIs('admin.layanan.daftar-informasi') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Daftar Informasi Publik
                        </a>
                        <a href="{{ route('admin.layanan.maklumat-pelayanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.maklumat-pelayanan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Maklumat Pelayanan
                        </a>
                        <a href="{{ route('admin.layanan.laporan-layanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-layanan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Laporan Layanan
                        </a>
                        <a href="{{ route('admin.layanan.laporan-akses') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-akses') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Laporan Akses
                        </a>
                        <a href="{{ route('admin.layanan.laporan-survey') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-survey') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Laporan Survey
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-cogs nav-icon"></i>
                        Prosedur
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-permintaan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Permintaan
                        </a>
                        <a href="{{ route('admin.prosedur.sop-keberatan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-keberatan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Keberatan
                        </a>
                        <a href="{{ route('admin.prosedur.sop-sengketa') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-sengketa') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Sengketa
                        </a>
                        <a href="{{ route('admin.prosedur.sop-penetapan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-penetapan') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Penetapan
                        </a>
                        <a href="{{ route('admin.prosedur.sop-pengujian') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-pengujian') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Pengujian
                        </a>
                        <a href="{{ route('admin.prosedur.sop-pendokumentasian') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-pendokumentasian') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            SOP Pendokumentasian
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->routeIs('admin.faq.index') ? 'active' : '' }}">
                        <i class="fas fa-question-circle nav-icon"></i>
                        FAQ
                    </a>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-file-alt nav-icon"></i>
                        Permohonan Informasi
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.permohonan.index') }}" class="submenu-link {{ request()->routeIs('admin.permohonan.index') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Daftar Permohonan
                        </a>
                        <a href="{{ route('admin.permohonan.form') }}" class="submenu-link {{ request()->routeIs('admin.permohonan.form') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Form Permohonan
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-newspaper nav-icon"></i>
                        Berita
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.berita.index') }}" class="submenu-link {{ request()->routeIs('admin.berita.index') ? 'active' : '' }}">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Daftar Berita
                        </a>
                    </div>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('halaman.index') }}" class="nav-link {{ request()->routeIs('halaman.index') ? 'active' : '' }}">
                        <i class="fas fa-file nav-icon"></i>
                        Halaman
                    </a>
                </div>
                
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-calendar nav-icon"></i>
                        Galeri & Media
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="#" class="submenu-link">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Agenda
                        </a>
                        <a href="#" class="submenu-link">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Galeri
                        </a>
                        <a href="#" class="submenu-link">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Video
                        </a>
                        <a href="#" class="submenu-link">
                            <i class="fas fa-angle-right" style="margin-right: 8px; font-size: 10px;"></i>
                            Dokumen
                        </a>
                    </div>
                </div>
            </nav>
            
            <div style="padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div style="flex: 1;">
                        <div style="color: #fff; font-weight: 600; font-size: 14px;">{{ Auth::user()->name }}</div>
                        <div style="color: #a0a0a0; font-size: 12px;">{{ Auth::user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #a0a0a0; cursor: pointer; padding: 5px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <header class="top-header">
                <h1 class="page-title">
                    @if(request()->routeIs('dashboard'))
                        Dashboard
                    @elseif(request()->is('admin/profil*'))
                        Kelola Profil PPID
                    @else
                        {{ ucfirst(request()->segment(1)) }}
                    @endif
                </h1>
                <div class="user-menu">
                    <button style="background: none; border: none; position: relative; cursor: pointer;">
                        <i class="fas fa-bell" style="font-size: 18px; color: #666;"></i>
                        <span style="position: absolute; top: -5px; right: -5px; width: 8px; height: 8px; background: #e74c3c; border-radius: 50%;"></span>
                    </button>
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>
            
            <main class="content-area">
                @yield('content')
            </main>
        </div>
        
        <script>
            function toggleAccordion(button) {
                const submenu = button.nextElementSibling;
                const chevron = button.querySelector('.fa-chevron-down');
                
                // Close other accordions
                document.querySelectorAll('.submenu.open').forEach(menu => {
                    if (menu !== submenu) {
                        menu.classList.remove('open');
                        menu.previousElementSibling.querySelector('.fa-chevron-down').style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current accordion
                submenu.classList.toggle('open');
                chevron.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
            
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('open');
            }
            
            // Open accordion if active link is inside
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.submenu-link.active').forEach(link => {
                    const submenu = link.parentElement;
                    const button = submenu.previousElementSibling;
                    const chevron = button.querySelector('.fa-chevron-down');
                    
                    submenu.classList.add('open');
                    chevron.style.transform = 'rotate(180deg)';
                    button.classList.add('active');
                });
            });
        </script>
    </body>
</html>
