<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
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

        @if(request()->query('embed') === '1' && request()->query('controls') !== '1')
        :root {
            --toolbar-height: 0px !important;
        }
        #top-bar, #bottom-bar {
            display: none !important;
        }
        html, body, #page-wrapper, #scroll-area {
            height: 100% !important;
            overflow: hidden !important;
            background: transparent !important;
        }
        #scroll-area {
            height: 100% !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            display: block !important;
            background: transparent !important;
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
            width: 100% !important;
            max-width: 100% !important;
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
            overflow-x: auto;
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
            min-width: max-content;
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
            border-radius: 4px;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
        }

        /* Canvas di dalam setiap halaman */
        .pdf-page-container canvas {
            display: block;
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
            transition: transform 0.2s ease;
            transform-origin: top center;
        }

        /* Image Zoom Toolbar */
        .image-zoom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 52px;
            background: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            z-index: 200;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.3);
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
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
                <div id="gdrive-frame-wrapper" style="display: none;">
                    <iframe
                        src=""
                        allow="autoplay"
                        allowfullscreen
                        id="gdrive-iframe"
                        style="width:100%; height:100%; border:none; display:block;"></iframe>
                </div>

            @elseif($isImg)
                {{-- Viewer Gambar --}}
                <div class="image-preview-container" id="img-container">
                    <img src="{{ asset($file_path) }}" alt="{{ $title ?? 'Dokumen' }}" id="preview-img" style="transform-origin:top center;">
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
                {{-- Image Zoom Toolbar --}}
                <div class="image-zoom-bar" id="img-zoom-bar">
                    <button class="bar-btn" id="img-zoom-out" title="Perkecil"><i class="fas fa-search-minus"></i></button>
                    <span id="img-zoom-label" style="color:#94a3b8;font-size:12px;font-weight:600;min-width:52px;text-align:center;">100%</span>
                    <button class="bar-btn" id="img-zoom-in" title="Perbesar"><i class="fas fa-search-plus"></i></button>
                    <button class="bar-btn" id="img-zoom-fit" title="Sesuaikan Lebar" style="width:auto;padding:0 10px;font-size:11px;font-weight:700;">FIT</button>
                    <div class="bar-sep" style="width:1px;height:24px;background:rgba(255,255,255,0.12);margin:0 4px;"></div>
                    <button class="bar-btn" id="img-zoom-orig" title="Ukuran Asli" style="width:auto;padding:0 10px;font-size:11px;font-weight:700;">1:1</button>
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
            <select id="zoom-select" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); border-radius: 8px; color: #fff; font-size: 13px; font-weight: 500; height: 36px; padding: 0 10px; cursor: pointer; outline: none; width: 110px;">
                <option value="0.5" style="background:#1e293b;">50%</option>
                <option value="0.75" style="background:#1e293b;">75%</option>
                <option value="1.0" selected style="background:#1e293b;">100%</option>
                <option value="1.25" style="background:#1e293b;">125%</option>
                <option value="1.5" style="background:#1e293b;">150%</option>
                <option value="2.0" style="background:#1e293b;">200%</option>
                <option value="3.0" style="background:#1e293b;">300%</option>
                <option value="fit" style="background:#1e293b;">Lebar Pas</option>
            </select>
            <button class="bar-btn" id="btn-zoom-in" title="Perbesar"><i class="fas fa-search-plus"></i></button>
        </div>{{-- /#bottom-bar --}}
        @endif

    </div>{{-- /#page-wrapper --}}

    <script>
    // Force embed styling if loaded inside an iframe (even if embed=1 parameter is missing)
    const urlParams = new URLSearchParams(window.location.search);
    const isEmbedMode = (window.self !== window.top) && (urlParams.get('controls') !== '1');
    if (isEmbedMode) {
        document.documentElement.classList.add('embedded-frame');
        const style = document.createElement('style');
        style.innerHTML = `
            #top-bar, #bottom-bar { display: none !important; }
            :root { --toolbar-height: 0px !important; }
            html, body, #page-wrapper { height: 100% !important; overflow: hidden !important; }
            #scroll-area { height: 100% !important; overflow-y: auto !important; overflow-x: hidden !important; display: block !important; }
            .pdf-page-container { margin-bottom: 15px !important; box-shadow: 0 1px 6px rgba(0,0,0,0.15) !important; border-radius: 8px !important; width: 100% !important; max-width: 100% !important; }
            #viewer-content { padding: 10px 0 !important; width: 100% !important; max-width: 100% !important; }
        `;
        document.head.appendChild(style);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const loading = document.getElementById('loading');
        const bottomBar = document.getElementById('bottom-bar');
        const pageInfo  = document.getElementById('page-info');
        const zoomLabel = document.getElementById('zoom-label');

        // Helper for iframe auto-resizing when in embed mode
        function sendHeightToParent() {
            @if(request()->query('embed') === '1')
            // Exclude GDrive and Office previews from auto-resizing via postMessage
            @if($isGDrive || $isOffice)
            return;
            @endif
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
            const blurredPagesStr = '{{ $blurredPages ?? "" }}'; // Custom page blur list
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
                // Send height update after rendering
                setTimeout(sendHeightToParent, 300);
            }

            function rerenderPage(pdf, num, pageDiv) {
                pdf.getPage(num).then(function(page) {
                    const unscaledVp = page.getViewport({ scale: 1 });
                    const scale = (getContainerWidth() / unscaledVp.width) * currentZoom;
                    const viewport = page.getViewport({ scale: scale });

                    // Update pageDiv size
                    pageDiv.style.width = viewport.width + 'px';
                    pageDiv.style.height = viewport.height + 'px';

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

                    // Re-render premium overlay if blurred
                    const oldOverlay = pageDiv.querySelector('.premium-blur-overlay');
                    if (oldOverlay) oldOverlay.remove();

                    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(function() {
                        let shouldBlur = false;
                        if (premiumEnabled) {
                            if (blurredPagesStr) {
                                const blurredPagesArr = blurredPagesStr.split(',').map(p => p.trim());
                                shouldBlur = blurredPagesArr.includes(String(num));
                            } else {
                                shouldBlur = num > 1;
                            }
                        }

                        if (shouldBlur) {
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
                        sendHeightToParent();
                    });
                });
            }

            // ---------- Render awal ----------
            function renderPageInitial(pdf, num) {
                pdf.getPage(num).then(function (page) {
                    const unscaledVp = page.getViewport({ scale: 1 });
                    if (num === 1) fitWidth = unscaledVp.width; // simpan lebar referensi

                    const scale = (getContainerWidth() / unscaledVp.width) * currentZoom;
                    const viewport = page.getViewport({ scale: scale });

                    const pageDiv = document.createElement('div');
                    pageDiv.className = 'pdf-page-container';
                    pageDiv.id = 'pdf-page-' + num;
                    pageDiv.style.width = viewport.width + 'px';
                    pageDiv.style.height = viewport.height + 'px';
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
                        // Determine if this specific page should be blurred based on checked list
                        let shouldBlur = false;
                        if (premiumEnabled) {
                            if (blurredPagesStr) {
                                const blurredPagesArr = blurredPagesStr.split(',').map(p => p.trim());
                                shouldBlur = blurredPagesArr.includes(String(num));
                            } else {
                                // Default fallback: blur page 2+
                                shouldBlur = num > 1;
                            }
                        }

                        if (shouldBlur) {
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
                
                const gdriveWrapper = document.getElementById('gdrive-frame-wrapper');
                const viewerContent = document.getElementById('viewer-content');
                if (gdriveWrapper) {
                    loading.style.opacity = '0';
                    setTimeout(() => loading.style.display = 'none', 300);
                    
                    if (viewerContent) viewerContent.style.display = 'none';
                    gdriveWrapper.style.display = 'block';
                    
                    const iframe = gdriveWrapper.querySelector('iframe');
                    if (iframe) {
                        @if($isGDrive)
                            // Already has src set in Blade
                        @else
                            const publicUrl = '{{ url($file_path) }}';
                            iframe.src = "https://docs.google.com/gview?url=" + encodeURIComponent(publicUrl) + "&embedded=true";
                        @endif
                    }
                    
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
                        
                        if (iframe) {
                            iframe.style.filter = 'blur(12px)';
                            iframe.style.pointerEvents = 'none';
                        }
                    }
                    return;
                }

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

            const zoomSelect = document.getElementById('zoom-select');

            function updateZoomUI(zoomValue) {
                if (!zoomSelect) return;
                
                // Remove temporary option if exists
                const tempOpt = document.getElementById('temp-zoom-opt');
                if (tempOpt) tempOpt.remove();
                
                const valStr = String(zoomValue);
                const hasOption = Array.from(zoomSelect.options).some(opt => opt.value === valStr);
                
                if (hasOption) {
                    zoomSelect.value = valStr;
                } else {
                    const newOpt = document.createElement('option');
                    newOpt.id = 'temp-zoom-opt';
                    newOpt.value = valStr;
                    newOpt.textContent = Math.round(zoomValue * 100) + '%';
                    newOpt.selected = true;
                    newOpt.style.background = '#1e293b';
                    zoomSelect.insertBefore(newOpt, zoomSelect.firstChild);
                }
            }

            if (zoomSelect) {
                zoomSelect.addEventListener('change', function() {
                    const val = this.value;
                    if (val === 'fit') {
                        currentZoom = 1.0;
                    } else {
                        currentZoom = parseFloat(val);
                    }
                    updateZoomUI(currentZoom);
                    rerenderAll();
                });
            }

            const btnZoomIn = document.getElementById('btn-zoom-in');
            if (btnZoomIn) {
                btnZoomIn.addEventListener('click', function() {
                    if (currentZoom < ZOOM_MAX) {
                        currentZoom = Math.min(ZOOM_MAX, parseFloat((currentZoom + ZOOM_STEP).toFixed(2)));
                        updateZoomUI(currentZoom);
                        rerenderAll();
                    }
                });
            }
            const btnZoomOut = document.getElementById('btn-zoom-out');
            if (btnZoomOut) {
                btnZoomOut.addEventListener('click', function() {
                    if (currentZoom > ZOOM_MIN) {
                        currentZoom = Math.max(ZOOM_MIN, parseFloat((currentZoom - ZOOM_STEP).toFixed(2)));
                        updateZoomUI(currentZoom);
                        rerenderAll();
                    }
                });
            }

            // Sync initial zoom select
            updateZoomUI(currentZoom);
        })();

        @elseif($isImg)
            // Gambar: Sembunyikan loading + aktifkan zoom controls
            const previewImg = document.getElementById('preview-img');
            const imgZoomBar = document.getElementById('img-zoom-bar');
            const imgZoomLabel = document.getElementById('img-zoom-label');
            let imgZoom = 1.0;
            const IMG_ZOOM_STEP = 0.25;
            const IMG_ZOOM_MIN  = 0.25;
            const IMG_ZOOM_MAX  = 4.0;

            function applyImgZoom() {
                if (previewImg) {
                    previewImg.style.transform = `scale(${imgZoom})`;
                    previewImg.style.transformOrigin = 'top center';
                    // Adjust container height to fit scaled image
                    const container = document.getElementById('img-container');
                    if (container && previewImg) {
                        const naturalH = previewImg.naturalHeight || previewImg.offsetHeight;
                        container.style.minHeight = (naturalH * imgZoom) + 'px';
                        container.style.overflow = 'visible';
                    }
                }
                if (imgZoomLabel) {
                    imgZoomLabel.textContent = Math.round(imgZoom * 100) + '%';
                }
                sendHeightToParent();
            }

            const btnImgZoomIn = document.getElementById('img-zoom-in');
            if (btnImgZoomIn) {
                btnImgZoomIn.addEventListener('click', function() {
                    imgZoom = Math.min(IMG_ZOOM_MAX, parseFloat((imgZoom + IMG_ZOOM_STEP).toFixed(2)));
                    applyImgZoom();
                });
            }
            const btnImgZoomOut = document.getElementById('img-zoom-out');
            if (btnImgZoomOut) {
                btnImgZoomOut.addEventListener('click', function() {
                    imgZoom = Math.max(IMG_ZOOM_MIN, parseFloat((imgZoom - IMG_ZOOM_STEP).toFixed(2)));
                    applyImgZoom();
                });
            }
            const btnImgZoomFit = document.getElementById('img-zoom-fit');
            if (btnImgZoomFit) {
                btnImgZoomFit.addEventListener('click', function() {
                    imgZoom = 1.0;
                    applyImgZoom();
                });
            }
            const btnImgZoomOrig = document.getElementById('img-zoom-orig');
            if (btnImgZoomOrig) {
                btnImgZoomOrig.addEventListener('click', function() {
                    // Calculate scale that shows image at natural resolution
                    if (previewImg && previewImg.naturalWidth) {
                        const containerW = document.getElementById('scroll-area').clientWidth - 32;
                        imgZoom = previewImg.naturalWidth / containerW;
                        if (imgZoom > IMG_ZOOM_MAX) imgZoom = IMG_ZOOM_MAX;
                    } else {
                        imgZoom = 1.0;
                    }
                    applyImgZoom();
                });
            }

            // Wait for image to load before showing
            if (previewImg) {
                previewImg.addEventListener('load', function() {
                    loading.style.opacity = '0';
                    setTimeout(() => {
                        loading.style.display = 'none';
                        applyImgZoom();
                        sendHeightToParent();
                    }, 300);
                });
                // Fallback
                setTimeout(() => {
                    if (loading.style.display !== 'none') {
                        loading.style.opacity = '0';
                        setTimeout(() => {
                            loading.style.display = 'none';
                            sendHeightToParent();
                        }, 400);
                    }
                }, 3000);
            } else {
                setTimeout(() => {
                    loading.style.opacity = '0';
                    setTimeout(() => {
                        loading.style.display = 'none';
                        sendHeightToParent();
                    }, 400);
                }, 600);
            }

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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
