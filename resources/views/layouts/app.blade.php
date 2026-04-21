<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin PPID PKTJ</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap');
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background-color: #f8f9fa;
                color: #333;
                min-height: 100vh;
            }
            
            .sidebar {
                width: 280px;
                background-color: #004a99; /* Navy Blue Utama PPID */
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                overflow-y: auto;
            }
            
            .sidebar::-webkit-scrollbar { width: 6px; }
            .sidebar::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.1); }
            .sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 3px; }
            
            .logo-section {
                padding: 30px 20px;
                border-bottom: 2px solid #ffc107; /* Warning Yellow Accent */
                text-align: center;
                background-color: rgba(0, 0, 0, 0.1);
            }
            
            .logo-section img {
                width: 70px;
                height: 70px;
                object-fit: contain;
                margin-bottom: 12px;
                filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
            }
            
            .logo-title {
                color: #fff;
                font-size: 22px;
                font-weight: 800;
                margin-bottom: 2px;
                letter-spacing: 1px;
            }
            
            .logo-subtitle {
                color: #ffc107;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-weight: 700;
            }
            
            .nav-menu { padding: 15px 0; }
            .nav-item { margin-bottom: 2px; }
            
            .nav-link {
                display: flex;
                align-items: center;
                padding: 14px 25px;
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: all 0.2s ease;
                font-size: 14px;
                font-weight: 500;
                position: relative;
            }
            
            .nav-link:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
                padding-left: 28px;
            }
            
            .nav-link.active {
                color: #004a99;
                background-color: #ffc107;
                font-weight: 700;
                box-shadow: inset 4px 0 0 #fff;
            }
            
            .nav-icon {
                margin-right: 15px;
                font-size: 16px;
                width: 20px;
                text-align: center;
            }
            
            .accordion-toggle {
                background: none;
                border: none;
                color: rgba(255, 255, 255, 0.8);
                cursor: pointer;
                width: 100%;
                text-align: left;
                font-size: 14px;
                font-weight: 500;
                padding: 14px 25px;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
            }
            
            .accordion-toggle:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
                padding-left: 28px;
            }
            
            .accordion-toggle.active {
                color: #fff;
                background: rgba(255, 255, 255, 0.15);
                border-left: 4px solid #ffc107;
            }
            
            .submenu {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                background: rgba(0, 0, 0, 0.2);
            }
            .submenu.open { max-height: 1000px; }
            
            .submenu-link {
                display: block;
                padding: 10px 25px 10px 60px;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                font-size: 13px;
                transition: color 0.2s;
            }
            
            .submenu-link:hover {
                color: #ffc107;
            }
            
            .submenu-link.active {
                color: #ffc107;
                font-weight: 600;
            }
            
            .main-content {
                margin-left: 280px;
                min-height: 100vh;
                background-color: #f8f9fa;
            }
            
            .top-header {
                background: #ffffff;
                padding: 15px 30px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e9ecef;
            }
            
            .page-title {
                font-family: 'Manrope', sans-serif;
                font-size: 22px;
                font-weight: 800;
                color: #004a99;
                margin: 0;
                text-transform: uppercase;
            }
            
            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #004a99;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: 700;
                font-size: 16px;
                border: 2px solid #ffc107;
            }
            
            .content-area { padding: 30px; }
            
            @media (max-width: 768px) {
                .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
                .sidebar.open { transform: translateX(0); }
                .main-content { margin-left: 0; }
                .mobile-menu-toggle { display: block; position: fixed; top: 15px; left: 15px; z-index: 1001; background: #004a99; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; }
            }
            @media (min-width: 769px) { .mobile-menu-toggle { display: none; } }
            
            /* Overrides to kill Dark Theme Elements if leftover */
            .content-area h1, .content-area h2, .content-area h3 { color: #004a99 !important; }
            .content-area table { background: #fff; }
            .content-area thead th { background-color: #004a99 !important; color: #fff !important; }
            .content-area tbody td { color: #333 !important; }
            .content-area tbody tr:hover { background-color: #f1f5f9 !important; }
        </style>
    </head>
    <body class="antialiased">
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
                    <a href="{{ route('halaman.index') }}" class="nav-link {{ request()->routeIs('halaman.index') || request()->is('admin/halaman*') ? 'active' : '' }}">
                        <i class="fas fa-file nav-icon"></i> Halaman
                    </a>
                </div>

                {{-- PROFIL PPID --}}
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-users nav-icon"></i>
                        Profil PPID
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.profil.edit', 'profil') }}" class="submenu-link {{ request()->is('admin/profil/profil/edit') || request()->get('type') == 'profil' ? 'active' : '' }}">Profil PPID</a>
                        <a href="{{ route('admin.profil.edit', 'tugas') }}" class="submenu-link {{ request()->get('type') == 'tugas' ? 'active' : '' }}">Tugas dan Tanggung Jawab</a>
                        <a href="{{ route('admin.profil.edit', 'visi') }}" class="submenu-link {{ request()->get('type') == 'visi' ? 'active' : '' }}">Visi dan Misi</a>
                        <a href="{{ route('admin.profil.edit', 'struktur') }}" class="submenu-link {{ request()->get('type') == 'struktur' ? 'active' : '' }}">Struktur Organisasi</a>
                        <a href="{{ route('admin.profil.edit', 'regulasi') }}" class="submenu-link {{ request()->get('type') == 'regulasi' ? 'active' : '' }}">Regulasi</a>
                        <a href="{{ route('admin.profil.edit', 'kontak') }}" class="submenu-link {{ request()->get('type') == 'kontak' ? 'active' : '' }}">Kontak</a>
                    </div>
                </div>

                {{-- INFORMASI PUBLIK --}}
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-newspaper nav-icon"></i>
                        Informasi Publik
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.informasi.berkala') }}" class="submenu-link {{ request()->routeIs('admin.informasi.berkala*') ? 'active' : '' }}">Berkala</a>
                        <a href="{{ route('admin.informasi.sertamerta') }}" class="submenu-link {{ request()->routeIs('admin.informasi.sertamerta*') ? 'active' : '' }}">Serta Merta</a>
                        <a href="{{ route('admin.informasi.setiapsaat') }}" class="submenu-link {{ request()->routeIs('admin.informasi.setiapsaat*') ? 'active' : '' }}">Setiap Saat</a>
                        <a href="{{ route('admin.informasi.dikecualikan') }}" class="submenu-link {{ request()->routeIs('admin.informasi.dikecualikan*') ? 'active' : '' }}">Dikecualikan</a>
                    </div>
                </div>

                {{-- LAYANAN INFORMASI --}}
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-info-circle nav-icon"></i>
                        Layanan Informasi
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.layanan.daftar-informasi') }}" class="submenu-link">Daftar Informasi</a>
                        <a href="{{ route('admin.layanan.maklumat-pelayanan') }}" class="submenu-link">Maklumat Pelayanan</a>
                        <a href="{{ route('admin.layanan.laporan-layanan') }}" class="submenu-link">Laporan Layanan</a>
                        <a href="{{ route('admin.layanan.laporan-akses') }}" class="submenu-link">Laporan Akses</a>
                        <a href="{{ route('admin.layanan.laporan-survey') }}" class="submenu-link">Laporan Survey</a>
                    </div>
                </div>

                {{-- PROSEDUR --}}
                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-list-ol nav-icon"></i>
                        Prosedur
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="submenu-link">Permintaan Informasi</a>
                        <a href="{{ route('admin.prosedur.sop-keberatan') }}" class="submenu-link">Pengajuan Keberatan</a>
                        <a href="{{ route('admin.prosedur.sop-sengketa') }}" class="submenu-link">Sengketa Informasi</a>
                        <a href="{{ route('admin.prosedur.sop-penetapan') }}" class="submenu-link">Penetapan & Pemutakhiran</a>
                        <a href="{{ route('admin.prosedur.sop-pengujian') }}" class="submenu-link">Pengujian Konsekuensi</a>
                        <a href="{{ route('admin.prosedur.sop-pendokumentasian') }}" class="submenu-link">Pendokumentasian</a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->is('admin/faq*') ? 'active' : '' }}">
                        <i class="fas fa-question-circle nav-icon"></i> FAQ
                    </a>
                </div>

                <div class="nav-item">
                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-envelope nav-icon"></i>
                        Permohonan Info
                        <i class="fas fa-chevron-down" style="margin-left: auto; transition: transform 0.3s;"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.permohonan.index') }}" class="submenu-link">Daftar Permohonan</a>
                        <a href="{{ route('admin.permohonan.form') }}" class="submenu-link">Form Permohonan</a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->is('admin/berita*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper nav-icon"></i> Berita
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/user-management*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog nav-icon"></i> User Management
                    </a>
                </div>
            </nav>
            
            <div style="padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div style="flex: 1;">
                        <div style="color: #fff; font-weight: 600; font-size: 14px;">{{ Auth::user()->name }}</div>
                        <div style="color: #a0a0a0; font-size: 11px;">
                            @if(isset(Auth::user()->role) && Auth::user()->role === 'operator')
                                Operator Panel
                            @else
                                Admin Panel
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #a0a0a0; cursor: pointer;" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <header class="top-header">
                <h1 class="page-title">
                    @yield('title')
                    @if(!View::hasSection('title'))
                        @if(request()->routeIs('dashboard')) Dashboard 
                        @elseif(request()->is('admin/halaman*')) Kelola Halaman
                        @elseif(request()->is('admin/profil*')) 
                            @php
                                $type = request()->route('type');
                                if(!$type) echo 'Kelola Profil';
                                else {
                                    $labels = [
                                        'profil' => 'Profil PPID',
                                        'tugas' => 'Tugas dan Fungsi',
                                        'visi' => 'Visi dan Misi',
                                        'struktur' => 'Struktur Organisasi',
                                        'regulasi' => 'Regulasi',
                                        'kontak' => 'Kontak'
                                    ];
                                    echo $labels[$type] ?? ucfirst($type);
                                }
                            @endphp
                        @else 
                            {{ ucfirst(request()->segment(2) ?? request()->segment(1)) }} 
                        @endif
                    @endif
                </h1>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
            </header>
            
            <main class="content-area">
                @yield('content')
            </main>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function toggleAccordion(button) {
                const submenu = button.nextElementSibling;
                submenu.classList.toggle('open');
                const icon = button.querySelector('.fa-chevron-down');
                if (icon) icon.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
            function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); }
            
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.submenu-link.active').forEach(link => {
                    const submenu = link.parentElement;
                    submenu.classList.add('open');
                    const btn = submenu.previousElementSibling;
                    const icon = btn.querySelector('.fa-chevron-down');
                    if(icon) icon.style.transform = 'rotate(180deg)';
                });
            });
        </script>
        
        <!-- TinyMCE -->
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '.tinymce-editor, .summernote-editor, #editor, #summernote-editor, [id^="editor_"]',
                license_key: 'gpl',
                height: 480,
                menubar: false,
                skin: 'oxide-dark',
                content_css: 'dark',
                plugins: ['advlist','autolink','lists','link','image','charmap','code','table','wordcount','fullscreen'],
                toolbar: 'undo redo | styles | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | code fullscreen',
                content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; color: #1e293b; background: #ffffff; padding: 12px; }'
            });

            $(document).on('submit', 'form', function() {
                if (typeof tinymce !== 'undefined') tinymce.triggerSave();
            });
        });
        </script>
        @stack('scripts')
    </body>
</html>
