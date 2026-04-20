<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin PPID PKTJ | Executive Panel</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700;900&display=swap');
            
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f4f7fa;
                color: #0f172a; /* Deep Navy - Jauh lebih jelas */
                min-height: 100vh;
            }
            
            .sidebar {
                width: 300px; /* Diperlebar sedikit agar lebih lega */
                background: linear-gradient(180deg, #002b5c 0%, #00152e 100%);
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                display: flex;
                flex-direction: column;
                box-shadow: 10px 0 30px rgba(0,0,0,0.1);
                border-right: 1px solid rgba(255,255,255,0.05);
            }

            .logo-section {
                padding: 50px 30px; /* Jarak lebih luas agar tidak "nabrak" */
                text-align: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                margin-bottom: 10px;
            }
            
            .logo-section img {
                height: 60px; /* Ukuran proporsional */
                width: auto;
                margin: 0 auto 20px;
                display: block;
            }
            
            .logo-title {
                color: #ffffff;
                font-size: 26px; /* Lebih besar dan mantap */
                font-weight: 800;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 4px;
                line-height: 1.2;
            }
            
            .logo-subtitle {
                color: #ffc107;
                font-size: 13px;
                font-weight: 800;
                letter-spacing: 4px;
                opacity: 0.9;
            }

            .sidebar-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 10px 20px;
            }
            
            /* Global Contrast Fix for unreadable text */
            .text-slate-400, .text-slate-300, .text-gray-400, .text-gray-300 {
                color: #334155 !important; /* Gunakan Abu-abu sangat tua jika di background putih */
            }

            .sidebar-scroll::-webkit-scrollbar { width: 5px; }
            .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
            
            .nav-link {
                display: flex;
                align-items: center;
                padding: 14px 20px;
                color: #e2e8f0; /* Putih kebiruan terang - SANGAT JELAS */
                text-decoration: none;
                transition: all 0.3s;
                font-size: 14px; /* Diperbesar */
                font-weight: 600;
                border-radius: 12px;
                margin-bottom: 6px;
            }
            
            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }
            
            .nav-link.active {
                background: #ffc107;
                color: #002b5c; /* Kontras maksimal */
                font-weight: 800;
                box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
            }
            
            .nav-icon {
                margin-right: 15px;
                font-size: 18px;
                width: 25px;
                text-align: center;
            }
            
            .accordion-toggle {
                width: 100%;
                background: none;
                border: none;
                display: flex;
                align-items: center;
                padding: 14px 20px;
                color: #e2e8f0;
                cursor: pointer;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 600;
                transition: 0.3s;
                margin-bottom: 4px;
            }
            
            .accordion-toggle:hover {
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }

            .accordion-toggle.active {
                color: #ffc107;
                background: rgba(255, 255, 255, 0.05);
            }
            
            .submenu {
                max-height: 0;
                overflow: hidden;
                transition: all 0.4s ease-out;
                background: rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                margin-bottom: 5px;
            }
            .submenu.open { max-height: 500px; padding: 5px 0; }
            
            .submenu-link {
                display: block;
                padding: 10px 20px 10px 55px;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                font-size: 13px; /* Diperbesar */
                border-radius: 8px;
                transition: 0.2s;
            }
            
            .submenu-link:hover, .submenu-link.active {
                color: #ffc107;
            }
            
            .sidebar-footer {
                padding: 25px;
                background: rgba(0, 0, 0, 0.3); /* Membedakan bagian profil */
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .user-avatar {
                width: 45px;
                height: 45px;
                background: #ffc107;
                color: #002b5c;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 900;
                font-size: 20px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            }
            
            .main-content {
                margin-left: 280px;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            .top-header {
                height: 80px;
                background: #ffffff;
                padding: 0 40px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0;
                position: sticky;
                top: 0;
                z-index: 900;
            }
            
            .page-title {
                font-size: 22px;
                font-weight: 800;
                color: #002b5c;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .page-title span { color: #ffc107; background: #002b5c; padding: 2px 8px; border-radius: 6px; }
            
            .content-area {
                padding: 40px;
                flex: 1;
            }

            /* Fix all small fonts in content area */
            .text-xs { font-size: 12px !important; }
            .text-[10px], .text-[9px], .text-[11px] { font-size: 13px !important; font-weight: 700 !important; }
            
            @media (max-width: 1024px) {
                .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
                .sidebar.open { transform: translateX(0); }
                .main-content { margin-left: 0; }
            }
        </style>
    </head>
    <body class="antialiased">
        
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="logo-section">
                <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ">
                <div class="logo-title">PPID PKTJ</div>
                <div class="logo-subtitle">PANEL DASHBOARD</div>
            </div>
            
            <div class="sidebar-scroll">
                <nav class="py-6">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i> BERANDA
                    </a>

                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-university nav-icon"></i> PROFIL PPID
                        <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.profil.edit', 'profil') }}" class="submenu-link">Profil PPID</a>
                        <a href="{{ route('admin.profil.edit', 'tugas') }}" class="submenu-link">Tugas dan Tanggung Jawab PPID</a>
                        <a href="{{ route('admin.profil.edit', 'visi') }}" class="submenu-link">Visi dan Misi</a>
                        <a href="{{ route('admin.profil.edit', 'struktur') }}" class="submenu-link">Struktur Organisasi</a>
                        <a href="{{ route('admin.profil.edit', 'regulasi') }}" class="submenu-link">Regulasi</a>
                        <a href="{{ route('admin.profil.edit', 'kontak') }}" class="submenu-link">Kontak</a>
                    </div>

                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-database nav-icon"></i> INFORMASI PUBLIK
                        <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.informasi.berkala') }}" class="submenu-link">Informasi Berkala</a>
                        <a href="{{ route('admin.informasi.sertamerta') }}" class="submenu-link">Informasi Serta Merta</a>
                        <a href="{{ route('admin.informasi.setiapsaat') }}" class="submenu-link">Informasi Setiap Saat</a>
                        <a href="{{ route('admin.informasi.dikecualikan') }}" class="submenu-link">Informasi Dikecualikan</a>
                    </div>

                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-concierge-bell nav-icon"></i> LAYANAN INFORMASI
                        <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.layanan.daftar-informasi') }}" class="submenu-link">Daftar Informasi Publik</a>
                        <a href="{{ route('admin.layanan.maklumat-pelayanan') }}" class="submenu-link">Maklumat Pelayanan & Standar Biaya</a>
                        <a href="{{ route('admin.layanan.laporan-layanan') }}" class="submenu-link">Laporan Layanan Informasi Publik</a>
                        <a href="{{ route('admin.layanan.laporan-akses') }}" class="submenu-link">Laporan Akses Informasi Publik</a>
                        <a href="{{ route('admin.layanan.laporan-survey') }}" class="submenu-link">Laporan Survey Kepuasan Layanan</a>
                        <a href="{{ route('admin.jdih.index') }}" class="submenu-link">JDIH Kementerian Perhubungan</a>
                    </div>

                    <button class="accordion-toggle" onclick="toggleAccordion(this)">
                        <i class="fas fa-file-signature nav-icon"></i> PROSEDUR
                        <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                    </button>
                    <div class="submenu">
                        <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="submenu-link">SOP Permintaan Informasi Publik</a>
                        <a href="{{ route('admin.prosedur.sop-keberatan') }}" class="submenu-link">SOP Penanganan Keberatan</a>
                        <a href="{{ route('admin.prosedur.sop-sengketa') }}" class="submenu-link">SOP Pengajuan Sengketa</a>
                        <a href="{{ route('admin.prosedur.sop-penetapan') }}" class="submenu-link">SOP Penetapan dan Pemutakhiran DIP</a>
                        <a href="{{ route('admin.prosedur.sop-pengujian') }}" class="submenu-link">SOP Pengujian Konsekuensi</a>
                        <a href="{{ route('admin.prosedur.sop-pendokumentasian') }}" class="submenu-link">SOP Pendokumentasian Informasi</a>
                    </div>

                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->is('admin/faq*') ? 'active' : '' }}">
                        <i class="fas fa-question-circle nav-icon"></i> FAQ
                    </a>

                    <a href="{{ route('admin.permohonan.index') }}" class="nav-link {{ request()->is('admin/permohonan*') ? 'active' : '' }}">
                        <i class="fas fa-envelope-open-text nav-icon"></i> PERMOHONAN INFORMASI
                    </a>

                    <div class="mt-10 px-6 py-4 border-t border-white/5">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[3px] mb-4">MANAJEMEN ADMIN</h4>
                        <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper nav-icon"></i> Berita PKTJ
                        </a>
                        <a href="{{ route('admin.agenda.index') }}" class="nav-link">
                            <i class="fas fa-calendar-alt nav-icon"></i> Agenda Kegiatan
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="fas fa-users-cog nav-icon"></i> User Management
                        </a>
                        <a href="{{ route('dashboard.edit') }}" class="nav-link">
                            <i class="fas fa-image nav-icon"></i> Pengaturan Banner
                        </a>
                    </div>
                </nav>
            </div>
            
            <!-- FOOTER SIDEBAR - TIDAK AKAN PERNAH TUMPUK -->
            <div class="sidebar-footer">
                <div class="flex items-center gap-4">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-white text-sm font-bold truncate">{{ Auth::user()->name }}</div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-[#ffc107] text-[11px] font-bold uppercase tracking-wider hover:underline border-none bg-transparent p-0 cursor-pointer">KELUAR SISTEM</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <header class="top-header">
                <h1 class="page-title">
                    PPID <span>PKTJ</span> CONTROL
                </h1>
                <div class="flex items-center gap-6">
                    <div class="hidden md:flex flex-col text-right">
                        <span class="text-sm font-black text-[#002b5c] uppercase tracking-wider">{{ Auth::user()->name }}</span>
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Administrator Utama</span>
                    </div>
                    <div class="w-12 h-12 bg-slate-50 border-2 border-slate-100 rounded-xl flex items-center justify-center text-[#002b5c] text-xl shadow-sm">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
            </header>
            
            <main class="content-area">
                <div class="animate-fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
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
                $('.submenu-link.active').each(function() {
                    $(this).closest('.submenu').addClass('open');
                    $(this).closest('.submenu').prev('.accordion-toggle').addClass('active');
                });
            });
        </script>
        
        <!-- TinyMCE - SET TO LIGHT CLEAR SKIN -->
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '.tinymce-editor, #editor, [id^="editor_"]',
                license_key: 'gpl',
                height: 480,
                menubar: false,
                skin: 'oxide', // LIGHT SKIN
                content_css: 'default',
                plugins: ['advlist','autolink','lists','link','image','code','table','fullscreen'],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline forecolor | alignleft aligncenter alignright | bullist numlist outdent indent | table link image | removeformat fullscreen',
                content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; color: #0f172a; background: #ffffff; padding: 20px; }',
                branding: false
            });
            
            $(document).on('submit', 'form', function() { if (typeof tinymce !== 'undefined') tinymce.triggerSave(); });
        </script>
        @stack('scripts')
    </body>
</html>
