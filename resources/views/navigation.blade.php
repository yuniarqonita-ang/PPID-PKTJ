@php
    if (!isset($settings)) {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    }
@endphp
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

    /* PREMIUM BLUR & INTERACTIVE ELEMENTS */
    @if(\App\Models\Dashboard::getValue('premium_view_enabled'))
    .premium-blur {
        filter: blur(8px) !important;
        -webkit-filter: blur(8px) !important;
        transition: filter 0.5s ease;
        user-select: none;
        pointer-events: none;
        position: relative;
    }

    .premium-blur-container {
        position: relative;
        overflow: hidden;
    }

    .premium-blur-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 12px;
    }

    .premium-cta-trigger {
        background: #ffc107;
        color: #004a99 !important;
        padding: 5px 15px;
        border-radius: 50px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 1px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        text-decoration: none !important;
    }

    .premium-cta-trigger:hover {
        background: #004a99;
        color: white !important;
        transform: scale(1.05);
    }
    @endif
</style>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #004a99; border-bottom: 3px solid #ffc107; padding: 12px 0; position: relative; z-index: 1050;">
    <div class="container">
        <a class="navbar-brand fw-bold me-4 d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}" style="height: 50px; margin-right: 12px;">
            <span>{{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</span>
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('home') }}">BERANDA</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#" data-bs-toggle="dropdown" aria-expanded="false">PROFIL PPID</a>
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
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#" data-bs-toggle="dropdown" aria-expanded="false">INFORMASI PUBLIK</a>
                    <ul class="dropdown-menu" style="min-width: 250px;">
                        <li><a class="dropdown-item" href="{{ route('informasi.berkala') }}">Informasi Berkala</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.serta-merta') }}">Informasi Serta Merta</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.setiap-saat') }}">Informasi Setiap Saat</a></li>
                        <li><a class="dropdown-item" href="{{ route('informasi.dikecualikan') }}">Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#" data-bs-toggle="dropdown" aria-expanded="false">LAYANAN INFORMASI</a>
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
                    <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#" data-bs-toggle="dropdown" aria-expanded="false">PROSEDUR</a>
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
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('agenda.public') }}">AGENDA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ route('faq.public') }}">FAQ</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a class="btn btn-warning fw-bold px-3 py-2 text-dark rounded-1 shadow-sm" href="{{ route('permohonan.form') }}" style="font-size: 11px;">
                    PERMOHONAN INFORMASI
                </a>
                <a class="btn btn-outline-light fw-bold px-3 py-2 rounded-1 shadow-sm" href="{{ route('keberatan.create') }}" style="font-size: 11px; border-width: 2px;">
                    AJUKAN KEBERATAN
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- PREMIUM DOCUMENT VIEWER MODAL (GLOBAL) -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4 shadow-lg" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1100;"></button>
            </div>
            <div class="modal-body p-0 overflow-hidden">
                <iframe id="previewIframe" src="" frameborder="0" style="width: 100%; height: 100vh;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewModal = document.getElementById('previewModal');
        const previewIframe = document.getElementById('previewIframe');

        if (previewModal && previewIframe) {
            // Handle when modal is shown
            previewModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                previewIframe.src = url;
            });

            // Clear iframe when modal is hidden to stop any background processing
            previewModal.addEventListener('hidden.bs.modal', function () {
                previewIframe.src = '';
            });
        }
    });
</script>