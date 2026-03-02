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
                        <li><a class="dropdown-item" href="{{ route('profil.ppid') }}">Profil PPID</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.tugas-tanggung-jawab') }}">Tugas dan Tanggung Jawab PPID</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi dan Misi PPID</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.regulasi') }}">Regulasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.kontak') }}">Kontak</a></li>
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
                        <li><a class="dropdown-item" href="#">JDIH Kementerian Perhubungan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">PROSEDUR</a>
                    <ul class="dropdown-menu" style="min-width: 380px;">
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-permintaan') }}">SOP Permintaan Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-keberatan') }}">SOP Penanganan Keberatan</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-sengketa') }}">SOP Pengajuan Sengketa Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-pemutakhiran') }}">SOP Penetapan dan Pemutakhiran Daftar Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-pengujian') }}">SOP Pengujian Konsekuensi</a></li>
                        <li><a class="dropdown-item" href="{{ route('prosedur.sop-pendokumentasian') }}">SOP Pendokumentasian Informasi Publik</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#">LPSE</a>
                    <ul class="dropdown-menu" style="min-width: 350px;">
                        <li><a class="dropdown-item" href="#">Pengadaan Barang dan Jasa</a></li>
                        <li><a class="dropdown-item" href="#">Informasi Pengadaan Barang dan Jasa</a></li>
                        <li><a class="dropdown-item" href="#">Dokumen Pengadaan Barang dan Jasa</a></li>
                        <li><a class="dropdown-item" href="#">Informasi Penyedia</a></li>
                        <li><a class="dropdown-item" href="#">Permohonan Informasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('faq.index') }}">FAQ</a>
                </li>
            </ul>

            <a class="btn btn-warning fw-bold px-4 py-2 text-dark rounded-1 shadow-sm" href="{{ route('permohonan.form') }}" style="font-size: 13px;">
                PERMOHONAN INFORMASI
            </a>
        </div>
    </div>
</nav>