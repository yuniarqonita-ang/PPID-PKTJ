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
                    position: fixed;
                    left: -280px; 
                    transition: left 0.3s; 
                }
                .sidebar.open { left: 0; }
                .main-content { margin-left: 0; }
            }
            /* MOBILE SIDEBAR OVERLAY */
            #sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                backdrop-filter: blur(2px);
                z-index: 9999;
                pointer-events: none;
            }
            #sidebar-overlay.active { 
                display: block; 
                pointer-events: auto;
            }

            /* ANIMATIONS */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.4s ease-out forwards;
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
            .content-area iframe,
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
        </style>
    </head>
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

                        <button class="accordion-toggle {{ request()->is('admin/profil*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-university nav-icon"></i> PROFIL PPID
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/profil*') ? 'open' : '' }}">
                            <a href="{{ route('admin.profil.edit', 'profil') }}" class="submenu-link {{ request()->is('admin/profil/profil*') ? 'active' : '' }}">Profil PPID</a>
                            <a href="{{ route('admin.profil.edit', 'tugas') }}" class="submenu-link {{ request()->is('admin/profil/tugas*') ? 'active' : '' }}">Tugas & Tanggung Jawab</a>
                            <a href="{{ route('admin.profil.edit', 'visi') }}" class="submenu-link {{ request()->is('admin/profil/visi*') ? 'active' : '' }}">Visi & Misi</a>
                            <a href="{{ route('admin.profil.edit', 'struktur') }}" class="submenu-link {{ request()->is('admin/profil/struktur*') ? 'active' : '' }}">Struktur Organisasi</a>
                            <a href="{{ route('admin.profil.edit', 'regulasi') }}" class="submenu-link {{ request()->is('admin/profil/regulasi*') ? 'active' : '' }}">Regulasi</a>
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

                        <button class="accordion-toggle {{ request()->is('admin/layanan*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-concierge-bell nav-icon"></i> LAYANAN INFORMASI
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/layanan*') ? 'open' : '' }}">
                            <a href="{{ route('admin.layanan.daftar-informasi') }}" class="submenu-link {{ request()->routeIs('admin.layanan.daftar-informasi*') ? 'active' : '' }}">Daftar Informasi Publik</a>
                            <a href="{{ route('admin.layanan.maklumat-pelayanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.maklumat-pelayanan*') ? 'active' : '' }}">Maklumat & Standar Biaya</a>
                            <a href="{{ route('admin.layanan.laporan-layanan') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-layanan*') ? 'active' : '' }}">Laporan Layanan</a>
                            <a href="{{ route('admin.layanan.laporan-akses') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-akses*') ? 'active' : '' }}">Laporan Akses</a>
                            <a href="{{ route('admin.layanan.laporan-survey') }}" class="submenu-link {{ request()->routeIs('admin.layanan.laporan-survey*') ? 'active' : '' }}">Laporan Survey</a>
                        </div>

                        <button class="accordion-toggle {{ request()->is('admin/prosedur*') ? 'active' : '' }}" onclick="toggleAccordion(this)">
                            <i class="fas fa-file-signature nav-icon"></i> PROSEDUR
                            <i class="fas fa-chevron-down ml-auto opacity-50"></i>
                        </button>
                        <div class="submenu {{ request()->is('admin/prosedur*') ? 'open' : '' }}">
                            <a href="{{ route('admin.prosedur.sop-permintaan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-permintaan*') ? 'active' : '' }}">SOP Permintaan</a>
                            <a href="{{ route('admin.prosedur.sop-keberatan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-keberatan*') ? 'active' : '' }}">SOP Keberatan</a>
                            <a href="{{ route('admin.prosedur.sop-sengketa') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-sengketa*') ? 'active' : '' }}">SOP Sengketa</a>
                            <a href="{{ route('admin.prosedur.sop-penetapan') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-penetapan*') ? 'active' : '' }}">SOP Penetapan DIP</a>
                            <a href="{{ route('admin.prosedur.sop-pengujian') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-pengujian*') ? 'active' : '' }}">SOP Pengujian Konsekuensi</a>
                            <a href="{{ route('admin.prosedur.sop-pendokumentasian') }}" class="submenu-link {{ request()->routeIs('admin.prosedur.sop-pendokumentasian*') ? 'active' : '' }}">SOP Pendokumentasian</a>
                        </div>

                        <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->routeIs('admin.faq.*') || request()->is('admin/faq*') ? 'active' : '' }}">
                            <i class="fas fa-question-circle nav-icon"></i> FAQ / PERTANYAAN
                        </a>

                        <a href="{{ route('admin.permohonan.index') }}" class="nav-link {{ request()->is('admin/permohonan*') && !request()->is('admin/permohonan/report*') ? 'active' : '' }}">
                            <i class="fas fa-envelope-open-text nav-icon"></i> PERMOHONAN INFORMASI
                        </a>

                        <a href="{{ route('admin.permohonan.report') }}" class="nav-link {{ request()->is('admin/permohonan/report*') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice nav-icon"></i> LAPORAN BULANAN
                        </a>

                        <a href="{{ route('admin.keberatan.index') }}" class="nav-link {{ request()->is('admin/keberatan*') ? 'active' : '' }}">
                            <i class="fas fa-exclamation-circle nav-icon"></i> KEBERATAN PERMOHONAN INFORMASI
                        </a>

                        <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper nav-icon"></i> BERITA & ARTIKEL
                        </a>
                        <a href="{{ route('admin.agenda.index') }}" class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt nav-icon"></i> AGENDA KEGIATAN
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog nav-icon"></i> MANAJEMEN USER
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
                $('.submenu-link.active').each(function() {
                    $(this).closest('.submenu').addClass('open');
                    $(this).closest('.submenu').prev('.accordion-toggle').addClass('active');
                });
            });
        </script>
        
        <!-- TinyMCE - ADVANCED PREMIUM CONFIG -->
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '.tinymce-editor, #editor, [id^="editor_"], #deskripsi, #konten, #isi_informasi, #isi_maklumat, #isi_standar, #dasar_hukum, #deskripsi_singkat, textarea[name="konten"], textarea[name="deskripsi"], textarea[name="isi"], textarea[name="isi_informasi"], textarea[name="isi_maklumat"], textarea[name="isi_standar"], textarea[name="jawaban"], textarea[name="isi_prosedur"], textarea[name="dasar_hukum"], textarea[name="konsekuensi_dibuka"], textarea[name="konsekuensi_ditutup"], textarea[name="catatan"], textarea[name="keterangan"]',
                license_key: 'gpl',
                height: 550,
                menubar: 'edit insert view format table tools help',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline forecolor | ' +
                         'alignleft aligncenter alignright alignjustify | ' +
                         'bullist numlist outdent indent | link image media emoticons | premium_blur insert_preview insert_gdrive removeformat fullscreen',
                skin: 'oxide',
                content_css: 'default',
                content_style: 'body { font-family: "Inter", sans-serif; font-size: 16px; color: #0f172a; padding: 20px; line-height: 1.6; }',
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
                setup: function(editor) {
                    // Custom GDrive Icon
                    editor.ui.registry.addIcon('gdrive', '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.5 15.5L14.5 6.5H9.5L14.5 15.5H19.5Z" fill="#004a99"/><path d="M9.5 6.5L4.5 15.5L7 19.5L12 10.5L9.5 6.5Z" fill="#ffc107"/><path d="M12 10.5L7 19.5H17L22 10.5H12Z" fill="#006ccf"/></svg>');

                    editor.ui.registry.addButton('premium_blur', {
                        icon: 'lock',
                        tooltip: 'Apply Premium Blur to Selection',
                        onAction: function (_) {
                            editor.execCommand('mceToggleFormat', false, 'premium-blur');
                        }
                    });

                    editor.ui.registry.addButton('insert_gdrive', {
                        icon: 'gdrive',
                        tooltip: 'Insert GDrive Document (Premium Blur)',
                        onAction: function (_) {
                            editor.windowManager.open({
                                title: 'Insert Google Drive Preview',
                                body: {
                                    type: 'panel',
                                    items: [
                                        { type: 'input', name: 'url', label: 'Google Drive Link (Sharing URL)', placeholder: 'https://drive.google.com/file/d/...' },
                                        { type: 'input', name: 'title', label: 'Document Title' },
                                        { type: 'input', name: 'height', label: 'Preview Height (px)', placeholder: '600' },
                                        { type: 'checkbox', name: 'blurred', label: 'Apply Premium Blur (Page 2+)' }
                                    ]
                                },
                                buttons: [
                                    { type: 'cancel', text: 'Close' },
                                    { type: 'submit', text: 'Insert GDrive', primary: true }
                                ],
                                initialData: {
                                    blurred: true,
                                    height: '600'
                                },
                                onSubmit: function (api) {
                                    const data = api.getData();
                                    if (!data.url) return;

                                    const baseUrl = "{{ route('preview.dokumen') }}";
                                    const fullUrl = baseUrl + "?file=" + encodeURIComponent(data.url) + "&title=" + encodeURIComponent(data.title || 'Dokumen GDrive') + (data.blurred ? "&is_blurred=1" : "");
                                    
                                    const height = data.height || '600';
                                    const html = `<div class="gdrive-preview-wrapper" style="width: 100%; height: ${height}px; overflow: hidden; border-radius: 16px; border: 1px solid #e2e8f0; margin: 25px 0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                                    <iframe src="${fullUrl}" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
                                                  </div>`;
                                    editor.insertContent(html);
                                    api.close();
                                }
                            });
                        }
                    });

                    editor.ui.registry.addButton('insert_preview', {
                        icon: 'preview',
                        tooltip: 'Insert Document Preview Iframe',
                        onAction: function (_) {
                            editor.windowManager.open({
                                title: 'Insert Document Preview',
                                body: {
                                    type: 'panel',
                                    items: [
                                        { type: 'input', name: 'url', label: 'File URL (e.g. storage/berita/file.pdf)' },
                                        { type: 'input', name: 'title', label: 'Document Title' },
                                        { type: 'input', name: 'height', label: 'Preview Height (px)', placeholder: '600' },
                                        { type: 'checkbox', name: 'blurred', label: 'Apply Premium Blur (Page 2+)' }
                                    ]
                                },
                                buttons: [
                                    { type: 'cancel', text: 'Close' },
                                    { type: 'submit', text: 'Insert', primary: true }
                                ],
                                initialData: {
                                    height: '600',
                                    blurred: false
                                },
                                onSubmit: function (api) {
                                    const data = api.getData();
                                    const baseUrl = "{{ route('preview.dokumen') }}";
                                    const fullUrl = baseUrl + "?file=" + encodeURIComponent(data.url) + "&title=" + encodeURIComponent(data.title) + (data.blurred ? "&is_blurred=1" : "");
                                    
                                    const height = data.height || '600';
                                    const html = `<div style="width: 100%; height: ${height}px; overflow: hidden; border-radius: 16px; border: 1px solid #e2e8f0; margin: 25px 0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                                    <iframe src="${fullUrl}" style="width: 100%; height: 100%; border: none;"></iframe>
                                                  </div>`;
                                    editor.insertContent(html);
                                    api.close();
                                }
                            });
                        }
                    });
                    
                    editor.on('init', function() {
                        editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
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
                              '.premium-blur { filter: blur(5px); background: #f1f5f9; display: inline-block; padding: 2px 4px; border-radius: 4px; border: 1px dashed #004a99; }'
            });
            
            $(document).on('submit', 'form', function() { if (typeof tinymce !== 'undefined') tinymce.triggerSave(); });
        </script>
        @stack('scripts')
    </body>
</html>
