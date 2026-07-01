@php
    if (!isset($settings)) {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    }
@endphp
<style>
    /* Prevent horizontal overflow and blank white gaps on mobile devices */
    html, body {
        overflow-x: hidden !important;
        max-width: 100% !important;
        width: 100% !important;
    }

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

    /* ====== FIX IFRAME & KONTEN GDRIVE: Tidak scroll horizontal ====== */
    /* Ini berlaku di semua halaman publik yang render deskripsi */
    body {
        overflow-x: hidden !important;
    }
    .rich-content iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .content-area iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .prose iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .info-item iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .konten-dinamis iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    article iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .gdrive-preview-wrapper iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    [class*="content"] iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]),
    .mce-content-body iframe:not([src*="preview-dokumen"]):not([src*="drive.google.com"]) {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        border: none !important;
        aspect-ratio: 16/9;
        display: block;
        margin: 15px auto;
    }

    /* Google Drive & Document Preview Iframe Portrait custom styles */
    .rich-content iframe[src*="preview-dokumen"],
    .rich-content iframe[src*="drive.google.com"],
    .content-area iframe[src*="preview-dokumen"],
    .content-area iframe[src*="drive.google.com"],
    .konten-dinamis iframe[src*="preview-dokumen"],
    .konten-dinamis iframe[src*="drive.google.com"],
    .prose iframe[src*="preview-dokumen"],
    .prose iframe[src*="drive.google.com"],
    article iframe[src*="preview-dokumen"],
    article iframe[src*="drive.google.com"],
    .gdrive-preview-wrapper iframe[src*="preview-dokumen"],
    .gdrive-preview-wrapper iframe[src*="drive.google.com"],
    .premium-box-outer iframe,
    iframe[src*="preview-dokumen"],
    iframe[src*="drive.google.com"] {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        aspect-ratio: auto !important;
        height: 80vh !important;
        min-height: 650px !important;
        max-height: 1000px !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        display: block !important;
        margin: 20px auto !important;
        pointer-events: auto !important;
    }

    /* Inside admin-inserted tiny boxes, override to fill the outer box */
    .premium-box-outer iframe {
        height: 100% !important;
        min-height: 0 !important;
        max-height: none !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        margin: 0 !important;
    }

    .gdrive-preview-wrapper {
        width: 100% !important;
        max-width: 100% !important;
        overflow: hidden !important;
        position: relative;
    }
    /* Fix container yang memuat konten dinamis */
    .rich-content,
    .content-area,
    .konten-dinamis {
        max-width: 100% !important;
        overflow-x: hidden !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #004a99; border-bottom: 3px solid #ffc107; padding: 12px 0; position: relative; z-index: 1050;">
    <div class="container">
        <a class="navbar-brand fw-bold me-4 d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}" style="height: 50px; margin-right: 12px;">
            <span>{{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
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
                <a class="btn btn-warning fw-bold px-4 py-2 text-dark rounded-1 shadow-sm" href="{{ route('permohonan.form') }}" style="font-size: 12px; letter-spacing: 0.5px;">
                    PERMOHONAN INFORMASI
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- PREMIUM DOCUMENT VIEWER MODAL (GLOBAL) -->
<style>
    /* Override agar modal-body mengisi seluruh sisa ruang */
    #previewModal .modal-content {
        height: 100%;
        background: #e8ecf0;
        border-radius: 0;
        border: none;
    }
    #previewModal .modal-body {
        flex: 1;
        padding: 0;
        overflow: hidden;
        position: relative;
    }
    #previewModal .modal-body iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
        background: #e8ecf0;
    }
    #previewModal .btn-close-custom {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 9999;
        background: rgba(0,0,0,0.6);
        border: none;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        color: white;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        backdrop-filter: blur(4px);
        transition: background 0.2s;
    }
    #previewModal .btn-close-custom:hover { background: rgba(0,0,0,0.85); }
</style>
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <button class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                <iframe id="previewIframe" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewModal = document.getElementById('previewModal');
        const previewIframe = document.getElementById('previewIframe');

        if (previewModal && previewIframe) {
            // Handle when modal is shown via data-bs-toggle
            previewModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (button) {
                    let url = button.getAttribute('data-url');
                    if (url) {
                        const separator = url.includes('?') ? '&' : '?';
                        if (!url.includes('controls=')) {
                            url = url + separator + 'controls=1';
                        }
                        previewIframe.src = url;
                    }
                }
            });

            // Global listener for links inside content (TinyMCE or dynamic text)
            document.addEventListener('click', function(e) {
                const target = e.target.closest('a');
                if (target && target.href) {
                    const url = target.href;
                    // Check if link is to any document preview route OR a direct storage document
                    const isPreview = url.includes('/preview-dokumen') || 
                                      url.includes('/preview-peraturan') || 
                                      url.includes('/dokumen/view/');
                    const isDirectDoc = url.includes('/storage/') && url.match(/\.(pdf|png|jpg|jpeg|webp)$/i);

                    if ((isPreview || isDirectDoc || url.includes('drive.google.com')) && !target.hasAttribute('data-bs-toggle')) {
                        e.preventDefault();
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(previewModal);

                        let finalUrl = url;
                        if (!url.includes('/preview-dokumen')) {
                            const params = new URLSearchParams(new URL(url).search);
                            const isBlurred = params.get('is_blurred') || '0';
                            if (url.includes('/storage/')) {
                                const relativePath = url.split('/storage/').pop();
                                finalUrl = `/preview-dokumen?file=storage/${relativePath}&is_blurred=${isBlurred}&controls=1`;
                            } else if (url.includes('drive.google.com')) {
                                finalUrl = `/preview-dokumen?file=${encodeURIComponent(url)}&is_blurred=${isBlurred}&controls=1`;
                            }
                        } else {
                            if (!finalUrl.includes('controls=')) {
                                const separator = finalUrl.includes('?') ? '&' : '?';
                                finalUrl = finalUrl + separator + 'controls=1';
                            }
                        }

                        previewIframe.src = finalUrl;
                        modalInstance.show();
                    }
                }
            });

            // Global helper to open the preview modal programmatically
            window.openGlobalPreview = function(url, isBlurred) {
                let finalUrl = url;
                if (!url.includes('/preview-dokumen')) {
                    if (url.includes('/storage/')) {
                        const relativePath = url.split('/storage/').pop();
                        finalUrl = `/preview-dokumen?file=storage/${relativePath}&is_blurred=${isBlurred ? '1' : '0'}&controls=1`;
                    } else if (url.includes('drive.google.com')) {
                        finalUrl = `/preview-dokumen?file=${encodeURIComponent(url)}&is_blurred=${isBlurred ? '1' : '0'}&controls=1`;
                    }
                } else {
                    if (!finalUrl.includes('controls=')) {
                        const separator = finalUrl.includes('?') ? '&' : '?';
                        finalUrl = finalUrl + separator + 'controls=1';
                    }
                }
                previewIframe.src = finalUrl;
                const modalInstance = bootstrap.Modal.getOrCreateInstance(previewModal);
                modalInstance.show();
            };

            // Clear iframe when modal is hidden to stop any background processing
            previewModal.addEventListener('hidden.bs.modal', function () {
                previewIframe.src = '';
            });
        }
    });
</script>