<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pratinjau Dokumen' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --blur-intensity: 14px;
            --toolbar-height: 56px;
        }

        @if(request()->query('embed') === '1')
        :root {
            --toolbar-height: 0px !important;
        }
        #top-bar, #bottom-bar {
            display: none !important;
        }
        html, body, #page-wrapper, #scroll-area, #viewer-content {
            height: auto !important;
            overflow: visible !important;
        }
        #scroll-area {
            flex: none !important;
        }
        .pdf-page-container {
            margin-bottom: 15px !important;
            box-shadow: 0 1px 6px rgba(0,0,0,0.15) !important;
            border-radius: 8px !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        #viewer-content {
            padding: 10px 0 !important;
        }
        @endif

        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* ===========================
           LAYOUT UTAMA
           =========================== */
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden; /* Body sendiri tidak scroll — scroll terjadi di #scroll-area */
            background: #e8ecf0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        /* Wrapper full-height flex column */
        #page-wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* ===========================
           TOP TOOLBAR
           =========================== */
        #top-bar {
            flex-shrink: 0;
            height: var(--toolbar-height);
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            gap: 12px;
            z-index: 200;
            box-shadow: 0 2px 10px rgba(0,0,0,0.25);
        }
        #top-bar .doc-title {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 50%;
            opacity: 0.9;
        }
        #top-bar .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            white-space: nowrap;
        }
        #top-bar .btn-back:hover { background: rgba(255,255,255,0.22); color: #fff; }
        #top-bar .logo-chip {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        #top-bar .logo-chip i { color: var(--secondary-gold); font-size: 18px; }

        /* ===========================
           AREA TENGAH (SCROLLABLE)
           =========================== */
        #scroll-area {
            flex: 1;
            overflow-y: auto;  /* SCROLL ATAS-BAWAH DI SINI */
            overflow-x: hidden;
            background: #e8ecf0;
            position: relative;
        }
        #scroll-area::-webkit-scrollbar { width: 8px; }
        #scroll-area::-webkit-scrollbar-track { background: #d0d7de; }
        #scroll-area::-webkit-scrollbar-thumb { background: #a0aec0; border-radius: 4px; }
        #scroll-area::-webkit-scrollbar-thumb:hover { background: #718096; }

        /* ===========================
           BOTTOM TOOLBAR (PDF controls)
           =========================== */
        #bottom-bar {
            flex-shrink: 0;
            display: none; /* tampil hanya untuk PDF.js */
            height: 52px;
            background: #1e293b;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            z-index: 200;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.3);
        }
        #bottom-bar.visible { display: flex; }
        .bar-btn {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            user-select: none;
        }
        .bar-btn:hover { background: rgba(255,255,255,0.18); }
        .bar-btn:disabled { opacity: 0.35; cursor: not-allowed; }
        #page-info {
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 500;
            min-width: 100px;
            text-align: center;
        }
        #zoom-label {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            min-width: 52px;
            text-align: center;
        }
        .bar-sep {
            width: 1px;
            height: 24px;
            background: rgba(255,255,255,0.12);
            margin: 0 4px;
        }

        /* ===========================
           GDRIVE / OFFICE IFRAME LAYOUT
           =========================== */
        /* Saat GDrive, buat scroll-area juga fixed height agar iframe bisa fill */
        #scroll-area.gdrive-mode {
            overflow: auto !important; 
            -webkit-overflow-scrolling: touch;
        }
        #gdrive-frame-wrapper {
            width: 100%;
            height: calc(100vh - var(--toolbar-height));
            min-height: 400px;
            position: relative;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            display: flex;
            flex-direction: column;
        }
        #gdrive-frame-wrapper iframe {
            flex: 1;
            width: 100%;
            height: 100%;
            border: none;
            display: block;
            min-height: 0;
        }

        /* Gold Action button styling */
        #top-bar .btn-gold-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--secondary-gold);
            border: 1px solid var(--secondary-gold);
            color: #002b5c !important;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.2);
        }
        #top-bar .btn-gold-action:hover {
            background: #fff;
            border-color: #fff;
            color: var(--primary-blue) !important;
            transform: scale(1.03);
        }

        /* ===========================
           PDF.js VIEWER
           =========================== */
        #viewer-content {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            padding: 24px 0 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        /* Container setiap halaman PDF */
        .pdf-page-container {
            position: relative;
            background: white;
            box-shadow: 0 2px 12px rgba(0,0,0,0.25);
            width: calc(100% - 32px);
            max-width: 900px;
            overflow: hidden;
            border-radius: 4px;
        }

        /* Canvas di dalam setiap halaman — scaling otomatis */
        .pdf-page-container canvas {
            display: block;
            width: 100% !important;
            height: auto !important;
        }

        /* ===========================
           LOADING OVERLAY
           =========================== */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: #e8ecf0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .loader {
            width: 44px;
            height: 44px;
            border: 4px solid rgba(0,74,153,0.15);
            border-top: 4px solid var(--secondary-gold);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-bottom: 16px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===========================
           BLUR OVERLAYS
           =========================== */
        .premium-blur-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            backdrop-filter: blur(var(--blur-intensity));
            -webkit-backdrop-filter: blur(var(--blur-intensity));
            background: rgba(255, 255, 255, 0.35);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
            padding: 30px 20px;
            text-align: center;
        }
        .blur-icon { font-size: 3rem; color: var(--primary-blue); margin-bottom: 18px; }
        .blur-message {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 20px;
            line-height: 1.4;
            text-transform: uppercase;
            max-width: 360px;
        }
        .btn-premium-action {
            background: var(--primary-blue);
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 20px rgba(0,74,153,0.3);
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-premium-action:hover { background: #002b5c; color: white; transform: scale(1.04); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Tampilan Gambar */
        .image-preview-container {
            position: relative;
            width: auto;
            max-width: calc(100% - 32px);
            margin: 24px auto;
            overflow: hidden;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .image-preview-container img { 
            max-width: 100%; 
            display: block; 
            margin: auto;
            border-radius: 12px;
        }

        /* GDrive Premium Blur Overlay */
        .gdrive-premium-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
            padding: 40px 20px;
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }
        .gdrive-premium-overlay .blur-icon {
            font-size: 4rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }
        .gdrive-premium-overlay .blur-message {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 28px;
            line-height: 1.5;
            text-transform: uppercase;
            max-width: 420px;
        }

        @media (max-width: 600px) {
            .blur-message { font-size: 0.9rem; }
            .btn-premium-action { padding: 12px 20px; font-size: 0.8rem; }
            #top-bar .doc-title { font-size: 12px; max-width: 40%; }
        }
    </style>
</head>
<body>

    {{-- Loading Spinner --}}
    <div id="loading" class="loading-overlay">
        <div class="loader"></div>
        <p style="font-size:13px; color:#475569; letter-spacing:1px; margin-top:8px;">Memuat Dokumen...</p>
    </div>

    @php
        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $isImg     = in_array($extension, ['jpg','jpeg','png','webp','gif']);
        $isPdf     = $extension === 'pdf';
        $isOffice  = in_array($extension, ['doc','docx','xls','xlsx','ppt','pptx']);

        // Google Drive / Docs Detection
        $isGDrive  = str_contains($file_path, 'drive.google.com')
                  || str_contains($file_path, 'docs.google.com');
        $gdriveId  = '';
        $embedUrl  = '';

        if ($isGDrive) {
            if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $file_path, $m)) {
                $gdriveId = $m[1];
            } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $file_path, $m)) {
                $gdriveId = $m[1];
            }
            if ($gdriveId) {
                $embedUrl = "https://drive.google.com/file/d/{$gdriveId}/preview";
            }
        }

        $premiumEnabled = ($settings['premium_view_enabled'] ?? '0') === '1' && ($isBlurred ?? false);
        $blurText = $settings['premium_view_blur_text'] ?? 'Dokumen ini Terlindungi. Ajukan Permohonan untuk Akses Penuh.';
        $btnText  = $settings['premium_view_button_text'] ?? 'AJUKAN PERMOHONAN';
        $btnLink  = route('permohonan.form');
    @endphp

    {{-- PAGE WRAPPER --}}
    <div id="page-wrapper">

        @if(request()->query('embed') !== '1')
        {{-- TOP BAR --}}
        <div id="top-bar">
            <div class="logo-chip">
                <i class="fas fa-file-alt"></i>
                <span class="doc-title">{{ $title ?? 'Pratinjau Dokumen' }}</span>
            </div>
            <div style="display:flex; align-items:center; gap:10px;">
                @if($isPdf || ($isGDrive && !$premiumEnabled))
                    @if($isGDrive && $gdriveId)
                        <a href="https://drive.google.com/file/d/{{ $gdriveId }}/view" target="_blank" class="btn-gold-action">
                            <i class="fas fa-external-link-alt"></i> Buka di Drive
                        </a>
                    @endif
                @endif
                <button onclick="window.parent.postMessage('closePreview','*'); if(window.history.length>1){window.history.back();}" class="btn-back">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
        @endif

        {{-- SCROLLABLE AREA --}}
        <div id="scroll-area" @if($isGDrive && $gdriveId && !$premiumEnabled) class="gdrive-mode" @endif>

            @if($isGDrive && $gdriveId)
                {{-- Google Drive: Try PDF.js first for clean borderless look. Fallback to GDrive iframe if load fails --}}
                <div id="viewer-content">
                    <div id="pdf-viewer"></div>
                </div>
                <div id="gdrive-frame-wrapper" style="display: none;">
                    <iframe
                        src="{{ $embedUrl }}"
                        allow="autoplay"
                        allowfullscreen
                        id="gdrive-iframe"
                        style="width:100%; height:100%; border:none; display:block;"></iframe>
                </div>

            @elseif($isPdf)
                {{-- PDF lokal via pdf.js --}}
                <div id="viewer-content">
                    <div id="pdf-viewer"></div>
                </div>

            @elseif($isImg)
                {{-- Viewer Gambar --}}
                <div class="image-preview-container">
                    <img src="{{ asset($file_path) }}" alt="{{ $title ?? 'Dokumen' }}">
                    @if($premiumEnabled)
                    <div class="premium-blur-overlay">
                        <div class="blur-icon"><i class="fas fa-lock"></i></div>
                        <p class="blur-message">{{ $blurText }}</p>
                        <button onclick="window.top.location.href='{{ $btnLink }}'" class="btn-premium-action">
                            <i class="fas fa-paper-plane"></i> {{ $btnText }}
                        </button>
                    </div>
                    @endif
                </div>

            @elseif($isOffice)
                {{-- Office Viewer via Google Docs --}}
                @php
                    $publicUrl = url($file_path);
                    $googleViewUrl = "https://docs.google.com/gview?url=" . urlencode($publicUrl) . "&embedded=true";
                @endphp
                <div id="gdrive-frame-wrapper">
                    <iframe src="{{ $googleViewUrl }}" loading="lazy"></iframe>
                </div>

            @else
                {{-- Format tidak dikenal --}}
                <div style="text-align:center; padding:80px 20px; color:#64748b;">
                    <i class="fas fa-file-alt" style="font-size:4rem; opacity:0.3; margin-bottom:20px; display:block;"></i>
                    <p style="font-size:14px;">Format dokumen tidak dapat ditampilkan di browser.</p>
                </div>
            @endif

        </div>{{-- /#scroll-area --}}

        @if(request()->query('embed') !== '1')
        {{-- BOTTOM BAR: PDF controls (hanya tampil untuk PDF.js) --}}
        <div id="bottom-bar">
            {{-- Navigasi halaman --}}
            <button class="bar-btn" id="btn-first" title="Halaman Pertama"><i class="fas fa-step-backward"></i></button>
            <button class="bar-btn" id="btn-prev" title="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
            <span id="page-info">— / —</span>
            <button class="bar-btn" id="btn-next" title="Berikutnya"><i class="fas fa-chevron-right"></i></button>
            <button class="bar-btn" id="btn-last" title="Halaman Terakhir"><i class="fas fa-step-forward"></i></button>

            <div class="bar-sep"></div>

            {{-- Zoom --}}
            <button class="bar-btn" id="btn-zoom-out" title="Perkecil"><i class="fas fa-search-minus"></i></button>
            <span id="zoom-label">100%</span>
            <button class="bar-btn" id="btn-zoom-in" title="Perbesar"><i class="fas fa-search-plus"></i></button>
            <button class="bar-btn" id="btn-zoom-fit" title="Sesuaikan Lebar" style="width:auto; padding:0 10px; font-size:11px; font-weight:700;">FIT</button>
        </div>{{-- /#bottom-bar --}}
        @endif

    </div>{{-- /#page-wrapper --}}

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const loading = document.getElementById('loading');
        const bottomBar = document.getElementById('bottom-bar');
        const pageInfo  = document.getElementById('page-info');
        const zoomLabel = document.getElementById('zoom-label');

        // Helper for iframe auto-resizing when in embed mode
        function sendHeightToParent() {
            @if(request()->query('embed') === '1')
            if (window.parent && window.parent !== window) {
                // Measure the actual scroll height of the page content
                const height = document.documentElement.scrollHeight || document.body.scrollHeight;
                window.parent.postMessage({
                    type: 'resize-iframe',
                    height: height
                }, '*');
            }
            @endif
        }

        @if($isPdf || $isGDrive)
        (function() {
            // ===== PDF.js VIEWER dengan Kontrol Halaman & Zoom =====
            @if($isGDrive)
                const url = '{{ route("proxy.gdrive", $gdriveId) }}';
            @else
                const url = '{{ asset($file_path) }}';
            @endif

            const pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            const premiumEnabled = {{ $premiumEnabled ? 'true' : 'false' }};
            const blurText = '{{ addslashes($blurText) }}';
            const btnText  = '{{ addslashes($btnText) }}';
            const btnLink  = '{{ $btnLink }}';
            const container = document.getElementById('pdf-viewer');
            const scrollArea = document.getElementById('scroll-area');

            let pdfDoc    = null;
            let totalPages = 0;
            let currentZoom = 1.0;       // scale multiplier
            let fitWidth   = 1.0;        // calculated fit-width scale
            const PAGE_DIVS = [];        // referensi setiap pageDiv

            // Hitung fit-width scale berdasarkan lebar container
            function getContainerWidth() {
                return Math.min(scrollArea.clientWidth - 32, 900);
            }

            // Tampilkan bottom bar jika ada
            if (bottomBar) {
                bottomBar.classList.add('visible');
            }

            // ---------- Render ulang semua halaman ----------
            function rerenderAll() {
                if (!pdfDoc) return;
                PAGE_DIVS.forEach((pageDiv, idx) => {
                    const num = idx + 1;
                    rerenderPage(pdfDoc, num, pageDiv);
                });
                if (zoomLabel) {
                    zoomLabel.textContent = Math.round(currentZoom * 100) + '%';
                }
                // Send height update after rendering
                setTimeout(sendHeightToParent, 300);
            }

            function rerenderPage(pdf, num, pageDiv) {
                pdf.getPage(num).then(function(page) {
                    const unscaledVp = page.getViewport({ scale: 1 });
                    const scale = fitWidth / unscaledVp.width * getContainerWidth() * currentZoom;
                    const viewport = page.getViewport({ scale: scale });

                    // Buat canvas baru
                    const oldCanvas = pageDiv.querySelector('canvas');
                    const canvas  = document.createElement('canvas');
                    const ctx     = canvas.getContext('2d');
                    const dpr     = window.devicePixelRatio || 1;
                    canvas.width  = viewport.width  * dpr;
                    canvas.height = viewport.height * dpr;
                    canvas.style.width  = viewport.width  + 'px';
                    canvas.style.height = viewport.height + 'px';
                    ctx.scale(dpr, dpr);

                    if (oldCanvas) pageDiv.replaceChild(canvas, oldCanvas);
                    else pageDiv.insertBefore(canvas, pageDiv.firstChild);

                    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(function() {
                        sendHeightToParent();
                    });
                });
            }

            // ---------- Render awal ----------
            function renderPageInitial(pdf, num) {
                pdf.getPage(num).then(function (page) {
                    const unscaledVp = page.getViewport({ scale: 1 });
                    // fitWidth = lebar container / lebar halaman native
                    if (num === 1) fitWidth = unscaledVp.width; // simpan lebar referensi

                    const containerW = getContainerWidth();
                    const scale = (containerW / unscaledVp.width) * currentZoom;
                    const viewport = page.getViewport({ scale: scale });

                    const pageDiv = document.createElement('div');
                    pageDiv.className = 'pdf-page-container';
                    pageDiv.id = 'pdf-page-' + num;
                    PAGE_DIVS.push(pageDiv);

                    const canvas = document.createElement('canvas');
                    const ctx    = canvas.getContext('2d');
                    const dpr    = window.devicePixelRatio || 1;
                    canvas.width  = viewport.width  * dpr;
                    canvas.height = viewport.height * dpr;
                    canvas.style.width  = viewport.width  + 'px';
                    canvas.style.height = viewport.height + 'px';
                    ctx.scale(dpr, dpr);

                    pageDiv.appendChild(canvas);
                    container.appendChild(pageDiv);

                    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(function () {
                        if (premiumEnabled && num > 1) {
                            canvas.style.filter = 'blur(8px)';
                            const overlay = document.createElement('div');
                            overlay.className = 'premium-blur-overlay';
                            overlay.innerHTML = `
                                <div class="blur-icon"><i class="fas fa-lock"></i></div>
                                <p class="blur-message">${blurText}</p>
                                <button onclick="window.top.location.href='${btnLink}'" class="btn-premium-action">
                                    <i class="fas fa-paper-plane"></i> ${btnText}
                                </button>`;
                            pageDiv.appendChild(overlay);
                        }
                        // Send height update to parent as pages load
                        sendHeightToParent();
                    });
                });
            }

            // ---------- Load PDF ----------
            pdfjsLib.getDocument(url).promise.then(function (pdf) {
                pdfDoc = pdf;
                totalPages = pdf.numPages;
                loading.style.opacity = '0';
                setTimeout(() => loading.style.display = 'none', 300);

                if (pageInfo) {
                    pageInfo.textContent = '1 / ' + totalPages;
                }
                for (let num = 1; num <= totalPages; num++) {
                    renderPageInitial(pdf, num);
                }
                updateNavButtons();
                // Send height update after document is initialized
                setTimeout(sendHeightToParent, 500);
            }).catch(function (err) {
                console.error('PDF.js Error:', err);
                
                @if($isGDrive)
                // Fallback to Google Drive native iframe inside #gdrive-frame-wrapper
                const gdriveWrapper = document.getElementById('gdrive-frame-wrapper');
                const viewerContent = document.getElementById('viewer-content');
                if (gdriveWrapper) {
                    loading.style.opacity = '0';
                    setTimeout(() => loading.style.display = 'none', 300);
                    
                    if (viewerContent) viewerContent.style.display = 'none';
                    gdriveWrapper.style.display = 'block';
                    
                    if (premiumEnabled) {
                        const overlay = document.createElement('div');
                        overlay.className = 'gdrive-premium-overlay';
                        overlay.innerHTML = `
                            <div class="blur-icon"><i class="fas fa-lock"></i></div>
                            <p class="blur-message">${blurText}</p>
                            <button onclick="window.top.location.href='${btnLink}'" class="btn-premium-action">
                                <i class="fas fa-paper-plane"></i> ${btnText}
                            </button>`;
                        gdriveWrapper.appendChild(overlay);
                        
                        const iframe = gdriveWrapper.querySelector('iframe');
                        if (iframe) {
                            iframe.style.filter = 'blur(12px)';
                            iframe.style.pointerEvents = 'none';
                        }
                    }
                    sendHeightToParent();
                    return;
                }
                @endif

                loading.style.opacity = '0';
                setTimeout(() => {
                    loading.style.display = 'none';
                    if (container) {
                        container.innerHTML = `
                            <div style="text-align:center; padding:50px 20px; color:#334155;">
                                <i class="fas fa-exclamation-triangle" style="font-size:3rem; color:#dc3545; margin-bottom:20px;"></i>
                                <p style="font-weight:bold; font-size:16px;">Gagal Memuat Dokumen</p>
                                <p style="font-size:14px; opacity:0.7; margin-top:10px;">Pastikan link sudah dapat diakses publik.</p>
                            </div>`;
                    }
                }, 300);
            });

            // ---------- Deteksi halaman aktif saat scroll ----------
            if (scrollArea) {
                scrollArea.addEventListener('scroll', function() {
                    const scrollTop = scrollArea.scrollTop;
                    for (let i = 0; i < PAGE_DIVS.length; i++) {
                        const el = PAGE_DIVS[i];
                        const top = el.offsetTop - scrollArea.offsetTop;
                        const bot = top + el.offsetHeight;
                        if (scrollTop >= top - 40 && scrollTop < bot) {
                            if (pageInfo) {
                                pageInfo.textContent = (i + 1) + ' / ' + totalPages;
                            }
                            updateNavButtons(i + 1);
                            break;
                        }
                    }
                });
            }

            // ---------- Navigasi ----------
            function getCurrentPage() {
                if (!pageInfo) return 1;
                const txt = pageInfo.textContent;
                const m = txt.match(/^(\d+)/);
                return m ? parseInt(m[1]) : 1;
            }
            function scrollToPage(num) {
                const idx = num - 1;
                if (idx < 0 || idx >= PAGE_DIVS.length) return;
                const el = PAGE_DIVS[idx];
                if (scrollArea) {
                    scrollArea.scrollTo({ top: el.offsetTop - scrollArea.offsetTop - 10, behavior: 'smooth' });
                }
                if (pageInfo) {
                    pageInfo.textContent = num + ' / ' + totalPages;
                }
                updateNavButtons(num);
            }
            function updateNavButtons(cur) {
                if (!bottomBar) return;
                cur = cur || getCurrentPage();
                const btnFirst = document.getElementById('btn-first');
                const btnPrev = document.getElementById('btn-prev');
                const btnNext = document.getElementById('btn-next');
                const btnLast = document.getElementById('btn-last');
                if (btnFirst) btnFirst.disabled = cur <= 1;
                if (btnPrev) btnPrev.disabled  = cur <= 1;
                if (btnNext) btnNext.disabled  = cur >= totalPages;
                if (btnLast) btnLast.disabled  = cur >= totalPages;
            }

            const btnFirst = document.getElementById('btn-first');
            if (btnFirst) btnFirst.addEventListener('click', () => scrollToPage(1));
            
            const btnPrev = document.getElementById('btn-prev');
            if (btnPrev) btnPrev.addEventListener('click',  () => scrollToPage(getCurrentPage() - 1));
            
            const btnNext = document.getElementById('btn-next');
            if (btnNext) btnNext.addEventListener('click',  () => scrollToPage(getCurrentPage() + 1));
            
            const btnLast = document.getElementById('btn-last');
            if (btnLast) btnLast.addEventListener('click',  () => scrollToPage(totalPages));

            // ---------- Zoom ----------
            const ZOOM_STEP = 0.25;
            const ZOOM_MIN  = 0.5;
            const ZOOM_MAX  = 3.0;

            const btnZoomIn = document.getElementById('btn-zoom-in');
            if (btnZoomIn) {
                btnZoomIn.addEventListener('click', function() {
                    if (currentZoom < ZOOM_MAX) {
                        currentZoom = Math.min(ZOOM_MAX, parseFloat((currentZoom + ZOOM_STEP).toFixed(2)));
                        rerenderAll();
                    }
                });
            }
            const btnZoomOut = document.getElementById('btn-zoom-out');
            if (btnZoomOut) {
                btnZoomOut.addEventListener('click', function() {
                    if (currentZoom > ZOOM_MIN) {
                        currentZoom = Math.max(ZOOM_MIN, parseFloat((currentZoom - ZOOM_STEP).toFixed(2)));
                        rerenderAll();
                    }
                });
            }
            const btnZoomFit = document.getElementById('btn-zoom-fit');
            if (btnZoomFit) {
                btnZoomFit.addEventListener('click', function() {
                    currentZoom = 1.0;
                    rerenderAll();
                });
            }

            if (zoomLabel) {
                zoomLabel.textContent = '100%';
            }
        })();

        @elseif($isImg)
            // Gambar: Sembunyikan loading cepat
            setTimeout(() => {
                loading.style.opacity = '0';
                setTimeout(() => {
                    loading.style.display = 'none';
                    sendHeightToParent();
                }, 400);
            }, 600);

        @elseif($isOffice)
            // Iframe (Office) — tidak perlu bottom bar
            const iframe = document.querySelector('#gdrive-frame-wrapper iframe');
            if (iframe) {
                iframe.addEventListener('load', function () {
                    loading.style.opacity = '0';
                    setTimeout(() => {
                        loading.style.display = 'none';
                        sendHeightToParent();
                    }, 400);
                });
            }
            // Fallback timeout jika load event tidak fire
            setTimeout(() => {
                if (loading.style.display !== 'none') {
                    loading.style.opacity = '0';
                    setTimeout(() => {
                        loading.style.display = 'none';
                        sendHeightToParent();
                    }, 400);
                }
            }, 6000);

        @else
            loading.style.opacity = '0';
            setTimeout(() => {
                loading.style.display = 'none';
                sendHeightToParent();
            }, 400);
        @endif

        // Trigger heights updates on load and window resizing
        window.addEventListener('load', sendHeightToParent);
        window.addEventListener('resize', sendHeightToParent);
        // Periodic check to ensure correct sizing after rendering settles
        let resizeChecks = 0;
        const resizeInterval = setInterval(() => {
            sendHeightToParent();
            resizeChecks++;
            if (resizeChecks > 10) clearInterval(resizeInterval);
        }, 1000);
    });
    </script>
</body>
</html>
