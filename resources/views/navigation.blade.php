@php
    if (!isset($settings)) {
        try {
            $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            $settings = [];
        }
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

                @php
                    try {
                        $headerMenus = \App\Models\CustomMenu::with(['children' => function($query) {
                            $query->where('aktif', true)->orderBy('urutan', 'asc');
                        }])
                        ->whereNull('parent_id')
                        ->where('aktif', true)
                        ->whereIn('penempatan', ['header', 'both'])
                        ->orderBy('urutan', 'asc')
                        ->get();
                    } catch (\Exception $e) {
                        $headerMenus = collect([]);
                    }
                @endphp

                @foreach($headerMenus as $menu)
                    @if($menu->children->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white px-3 fw-bold uppercase" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ $menu->nama }}</a>
                            <ul class="dropdown-menu" style="min-width: 250px;">
                                @foreach($menu->children as $child)
                                    @if(in_array($child->slug, ['sop-penetapan-sub', 'sop-pengujian-sub', 'sop-pendokumentasian-sub']) || str_contains($child->url, 'sop-penetapan') || str_contains($child->url, 'sop-pengujian') || str_contains($child->url, 'sop-pendokumentasian'))
                                        @continue
                                    @endif
                                    @php
                                        $childNama = $child->nama;
                                        $childUrl = $child->url;
                                        if ($child->slug === 'jdih-sub' || str_contains(strtolower($child->slug), 'jdih') || str_contains(strtolower($childUrl ?? ''), 'jdih') || str_contains(strtolower($childNama), 'jdih')) {
                                            $childNama = 'JDIH BPSDM Kemenhub';
                                            $childUrl = 'https://bpsdm.kemenhub.go.id/jdih/';
                                        }
                                    @endphp
                                    <li>
                                        @if(str_starts_with($childUrl, 'http://') || str_starts_with($childUrl, 'https://'))
                                            <a class="dropdown-item" href="{{ $childUrl }}" target="_blank">{{ $childNama }}</a>
                                        @else
                                            <a class="dropdown-item" href="{{ $childUrl ?: '/halaman/' . $child->slug }}">{{ $childNama }}</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            @php
                                $menuNama = $menu->nama;
                                $menuUrl = $menu->url;
                                if ($menu->slug === 'jdih-sub' || str_contains(strtolower($menu->slug), 'jdih') || str_contains(strtolower($menuUrl ?? ''), 'jdih') || str_contains(strtolower($menuNama), 'jdih')) {
                                    $menuNama = 'JDIH BPSDM Kemenhub';
                                    $menuUrl = 'https://bpsdm.kemenhub.go.id/jdih/';
                                }
                            @endphp
                            @if(str_starts_with($menuUrl, 'http://') || str_starts_with($menuUrl, 'https://'))
                                <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ $menuUrl }}" target="_blank">{{ $menuNama }}</a>
                            @else
                                <a class="nav-link text-white px-3 fw-bold uppercase" href="{{ $menuUrl ?: '/halaman/' . $menu->slug }}">{{ $menuNama }}</a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>

            <div class="d-flex align-items-center gap-2">
                <!-- GLOBAL SPOTLIGHT SEARCH TRIGGER -->
                <button type="button" class="btn btn-outline-light d-flex align-items-center gap-2 rounded-pill px-3 py-2 fw-semibold" onclick="openGlobalSearchModal()" title="Cari Dokumen & Informasi Publik (Ctrl + K)" style="border-color: rgba(255,255,255,0.3); background: rgba(0, 23, 56, 0.3);">
                    <i class="fas fa-search text-warning"></i>
                    <span class="d-none d-xl-inline text-white-50" style="font-size: 12.5px;">Cari Dokumen / Informasi...</span>
                    <kbd class="bg-black bg-opacity-25 text-white-50 px-1.5 py-0.5 rounded border border-white border-opacity-25 d-none d-xl-inline" style="font-size: 10px;">Ctrl+K</kbd>
                </button>

                <!-- PERMOHONAN INFORMASI (BPSDMP PKTJ) -->
                @php
                    $urlPermohonanBpsdm = \App\Models\Dashboard::getValue('link_permohonan_bpsdm') ?: 'https://bpsdm.kemenhub.go.id/ppid/pktj/login';
                @endphp
                <a class="btn btn-warning fw-bold px-3.5 py-2 text-dark rounded-pill shadow-sm d-flex align-items-center gap-1.5" href="{{ $urlPermohonanBpsdm }}" target="_blank" style="font-size: 12px; letter-spacing: 0.5px; white-space: nowrap;">
                    <i class="fas fa-file-signature"></i>
                    <span>PERMOHONAN INFORMASI</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- PREMIUM DOCUMENT VIEWER MODAL (GLOBAL) -->
<style>
    #previewModal .modal-dialog {
        max-width: 96vw !important;
        width: 96vw !important;
        height: 94vh !important;
        margin: 3vh auto !important;
    }
    #previewModal .modal-content {
        height: 100% !important;
        background: #0f172a !important;
        border-radius: 20px !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        overflow: hidden !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        display: flex !important;
        flex-direction: column !important;
    }
    #previewModal .modal-header-custom {
        background: #1e293b;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #334155;
        color: white;
    }
    #previewModal .modal-body {
        flex: 1;
        padding: 0;
        overflow: hidden;
        position: relative;
        background: #0f172a;
    }
    #previewModal .modal-body iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
        background: #0f172a;
    }
</style>
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true" style="z-index: 10050;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-custom">
                <div class="d-flex align-items-center gap-3">
                    <i class="fas fa-file-pdf text-warning fs-5"></i>
                    <h5 class="m-0 font-weight-bold text-white text-truncate" id="previewModalTitle" style="max-width: 60vw; font-size: 15px;">Pratinjau Dokumen</h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-light rounded-pill px-3" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                </div>
            </div>
            <div class="modal-body">
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

<!-- ==========================================
     GLOBAL SPOTLIGHT SEARCH MODAL (HOTKEY: CTRL + K)
     ========================================== -->
<div class="modal fade" id="globalSearchModal" tabindex="-1" aria-hidden="true" style="z-index: 100010;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 24px; overflow: hidden; border: 2px solid rgba(0, 242, 254, 0.3); background: #001738; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7), 0 0 35px rgba(0, 242, 254, 0.25);">
            
            <!-- SEARCH INPUT BAR -->
            <div class="p-3 border-bottom d-flex align-items-center gap-3" style="background: rgba(0, 43, 92, 0.9); border-color: rgba(0, 242, 254, 0.2) !important;">
                <i class="fas fa-search fs-5 text-warning"></i>
                <input type="text" id="globalSpotlightInput" class="form-control border-0 shadow-none text-white fs-5" placeholder="Ketik kata kunci dokumen (contoh: DIPA, LHKPN, SOP, Braille, Pengadaan)..." style="background: transparent; font-family: 'Outfit', sans-serif;" autocomplete="off">
                <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-1 text-white-50" data-bs-dismiss="modal" style="border-color: rgba(255,255,255,0.2); font-size: 11px;">ESC</button>
            </div>

            <!-- SEARCH RESULTS / SUGGESTIONS BODY -->
            <div id="globalSearchBody" class="p-3" style="max-height: 480px; overflow-y: auto;">
                
                <!-- DEFAULT QUICK HINTS -->
                <div id="searchQuickHints">
                    <div class="text-white-50 small mb-2 text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">
                        Pencarian Populer & Cepat:
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('DIPA')">📄 DIPA / RKA</button>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('LHKPN')">💼 LHKPN / LHKASN</button>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('SOP')">📜 SOP Permohonan Informasi</button>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('Braille')">🦯 Layanan Braille Disabilitas</button>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('Pengadaan')">🛒 Pengadaan Barang & Jasa</button>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-xs" style="border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.05);" onclick="fillSpotlightQuery('Regulasi')">⚖️ Regulasi PM 46 / KM 117</button>
                    </div>
                    <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.15);">
                        <p class="text-white-50 small mb-0">
                            💡 <strong>Tips:</strong> Ketik minimal 2 huruf untuk melihat dokumen secara instan, atau tekan <kbd class="bg-dark text-white px-1 py-0.5 rounded">Enter</kbd> untuk membuka halaman hasil lengkap.
                        </p>
                    </div>
                </div>

                <!-- LIVE RESULTS CONTAINER -->
                <div id="searchLiveResults" class="d-none"></div>

                <!-- LOADING SPINNER -->
                <div id="searchLoading" class="text-center py-4 d-none">
                    <i class="fas fa-spinner fa-spin text-warning fs-3 mb-2"></i>
                    <p class="text-white-50 small mb-0">Mencari dokumen di pangkalan data PPID...</p>
                </div>

            </div>

            <!-- MODAL FOOTER -->
            <div class="px-4 py-2.5 border-top d-flex align-items-center justify-content-between text-white-50 small" style="background: rgba(0, 23, 56, 0.95); border-color: rgba(0, 242, 254, 0.15) !important; font-size: 11.5px;">
                <div>
                    Tekan <span class="badge bg-secondary">↵ Enter</span> untuk halaman lengkap
                </div>
                <a href="javascript:void(0)" onclick="submitSpotlightSearch()" class="text-decoration-none text-warning fw-bold">
                    Lihat Semua Hasil ➔
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    let spotlightSearchTimeout = null;

    function openGlobalSearchModal() {
        const modalEl = document.getElementById('globalSearchModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
        setTimeout(() => {
            document.getElementById('globalSpotlightInput').focus();
        }, 300);
    }

    function fillSpotlightQuery(term) {
        const input = document.getElementById('globalSpotlightInput');
        input.value = term;
        performSpotlightSearch(term);
    }

    function submitSpotlightSearch() {
        const query = document.getElementById('globalSpotlightInput').value.trim();
        if (query) {
            window.location.href = `/pencarian?q=${encodeURIComponent(query)}`;
        }
    }

    function performSpotlightSearch(q) {
        const quickHints = document.getElementById('searchQuickHints');
        const liveResults = document.getElementById('searchLiveResults');
        const loading = document.getElementById('searchLoading');

        if (!q || q.length < 2) {
            quickHints.classList.remove('d-none');
            liveResults.classList.add('d-none');
            loading.classList.add('d-none');
            return;
        }

        quickHints.classList.add('d-none');
        loading.classList.remove('d-none');
        liveResults.classList.add('d-none');

        fetch(`/api/global-search?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                loading.classList.add('d-none');
                liveResults.classList.remove('d-none');

                if (data.results && data.results.length > 0) {
                    let html = `<div class="text-white-50 small mb-2 fw-bold text-uppercase" style="font-size: 11px;">Ditemukan ${data.total} Dokumen / Informasi:</div><div class="list-group list-group-flush gap-2">`;

                    data.results.forEach(item => {
                        html += `
                            <a href="${item.url}" class="list-group-item list-group-item-action text-white p-3 rounded-3 border" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12) !important; transition: all 0.2s ease;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-${item.badge_color} text-xs font-monospace">
                                        <i class="${item.icon} me-1"></i> ${item.category}
                                    </span>
                                    <span class="text-white-50 text-xs">Tahun ${item.year}</span>
                                </div>
                                <h6 class="outfit fw-bold text-warning mb-1" style="font-size: 14.5px;">${item.title}</h6>
                                <p class="text-white-50 small mb-0" style="font-size: 11.5px; line-height: 1.4;">${item.desc}</p>
                            </a>
                        `;
                    });

                    html += `</div>`;
                    liveResults.innerHTML = html;
                } else {
                    liveResults.innerHTML = `
                        <div class="text-center py-4">
                            <i class="fas fa-folder-open text-white-50 fs-3 mb-2"></i>
                            <h6 class="text-white fw-bold mb-1">Tidak Ada Dokumen Ditemukan</h6>
                            <p class="text-white-50 small mb-3">Tidak ada data yang cocok dengan "${q}".</p>
                            <a href="/pencarian?q=${encodeURIComponent(q)}" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark">
                                Buka Pencarian Luas
                            </a>
                        </div>
                    `;
                }
            })
            .catch(err => {
                loading.classList.add('d-none');
                liveResults.classList.remove('d-none');
                liveResults.innerHTML = `<div class="text-danger small text-center py-3">Gagal memuat hasil pencarian.</div>`;
            });
    }

    // Event listener on input
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('globalSpotlightInput');
        if (input) {
            input.addEventListener('input', function(e) {
                clearTimeout(spotlightSearchTimeout);
                const val = e.target.value.trim();
                spotlightSearchTimeout = setTimeout(() => {
                    performSpotlightSearch(val);
                }, 250);
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitSpotlightSearch();
                }
            });
        }

        // Global hotkey Ctrl + K or / to open search modal
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                openGlobalSearchModal();
            }
        });
    });
</script>

@include('components.accessibility-widget')