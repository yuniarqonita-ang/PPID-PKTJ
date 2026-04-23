<style>
    /* Hover Dropdown Logic */
    @media (min-width: 992px) {
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            animation: dropdownFadeIn 0.3s ease;
        }
        /* Bridge to prevent menu from closing when moving mouse from toggle to menu */
        .nav-item.dropdown .dropdown-menu::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 0;
            width: 100%;
            height: 20px;
        }
    }

    @keyframes dropdownFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Enhanced Clickable Areas */
    .dropdown-item {
        padding: 12px 20px !important;
        font-weight: 500;
        color: #334155;
        transition: all 0.2s ease;
        border-radius: 8px;
        margin-bottom: 2px;
    }

    .dropdown-item:last-child { margin-bottom: 0; }

    .dropdown-item:hover {
        background-color: #f1f5f9;
        color: #004a99 !important;
        padding-left: 25px !important;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        border-radius: 15px;
        padding: 10px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .nav-link {
        position: relative;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--secondary-gold, #ffc107);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .nav-link:hover::after {
        width: 70%;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #004a99; border-bottom: 3px solid #ffc107; padding: 12px 0;">
    <div class="container">
        <a class="navbar-brand fw-bold me-4 d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ" style="height: 50px; margin-right: 12px;">
            <span>PPID PKTJ</span>
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('home') }}">BERANDA</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">PROFIL PPID</a>
                    <ul class="dropdown-menu" style="min-width: 280px;">
                        <li><a class="dropdown-item" href="{{ route('profil.ppid.html') }}">Profil PPID</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.tugas.html') }}">Tugas dan Tanggung Jawab PPID</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi.html') }}">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.struktur.html') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.regulasi.html') }}">Regulasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.kontak.html') }}">Kontak</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">INFORMASI PUBLIK</a>
                    <ul class="dropdown-menu" style="min-width: 250px;">
                        <li><a class="dropdown-item" href="{{ route('informasi.berkala') }}">Informasi Berkala</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.serta-merta') }}">Informasi Serta Merta</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.setiap-saat') }}">Informasi Setiap Saat</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.dikecualikan') }}">Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">LAYANAN INFORMASI</a>
                    <ul class="dropdown-menu" style="min-width: 320px;">
                        <li><a class="dropdown-item" href="{{ route('layanan.daftar-informasi') }}">Daftar Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.maklumat-pelayanan') }}">Maklumat Pelayanan & Standar Biaya</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.laporan-layanan') }}">Laporan Layanan Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.laporan-akses') }}">Laporan Akses Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.laporan-survey') }}">Laporan Survey Kepuasan Layanan Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="https://jdih.dephub.go.id/" target="_blank">JDIH Kementerian Perhubungan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">PROSEDUR</a>
                    <ul class="dropdown-menu" style="min-width: 380px;">
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-permintaan') }}">SOP Permintaan Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-keberatan') }}">SOP Penanganan Keberatan</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-sengketa') }}">SOP Pengajuan Sengketa Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-penetapan') }}">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-pengujian') }}">SOP Pengujian Konsekuensi</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-pendokumentasian') }}">SOP Pendokumentasian Informasi Publik</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('faq.public') }}">FAQ</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a class="btn btn-warning fw-bold px-3 py-2 text-dark rounded-1 shadow-sm" href="{{ route('permohonan.form') }}" style="font-size: 11px;">
                    PERMOHONAN INFORMASI
                </a>
                <a class="btn btn-danger fw-bold px-3 py-2 text-white rounded-1 shadow-sm" href="{{ route('keberatan.create') }}" style="font-size: 11px;">
                    AJUKAN KEBERATAN
                </a>
            </div>
        </div>
    </div>
</nav>