<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pratinjau Dokumen' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --blur-intensity: 14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* Body: scroll atas-bawah SAJA, tidak ada scroll kanan-kiri */
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden !important;
            overflow-y: auto;
            background: #525659; /* Warna abu-abu khas Google Drive viewer */
            font-family: 'Segoe UI', sans-serif;
        }

        /* Loading */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: #525659;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
        }
        .loader {
            width: 44px;
            height: 44px;
            border: 4px solid rgba(255,255,255,0.15);
            border-top: 4px solid var(--secondary-gold);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-bottom: 16px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Wrapper utama — tidak ada padding berlebih */
        #viewer-content {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        /* Container setiap halaman PDF */
        .pdf-page-container {
            position: relative;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
            /* Lebar mengikuti container, TIDAK overflow ke kanan */
            width: calc(100% - 32px);
            max-width: 900px;
            overflow: hidden;
        }

        /* Canvas di dalam setiap halaman — scaling otomatis */
        .pdf-page-container canvas {
            display: block;
            width: 100% !important;  /* Paksa lebar 100% dari container */
            height: auto !important; /* Tinggi proporsional otomatis */
        }

        /* Blur Overlay untuk Premium Content */
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
        }
        .btn-premium-action:hover { background: #002b5c; color: white; transform: scale(1.04); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Tampilan Gambar */
        .image-preview-container {
            position: relative;
            width: calc(100% - 32px);
            max-width: 900px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }
        .image-preview-container img { width: 100%; height: auto; display: block; }

        /* Office & GDrive iframe fullscreen */
        .office-viewer {
            width: 100%;
            max-width: 100%;
            height: calc(100vh - 0px);
            overflow: hidden;
        }
        .office-viewer iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        @media (max-width: 600px) {
            .blur-message { font-size: 0.9rem; }
            .btn-premium-action { padding: 12px 20px; font-size: 0.8rem; }
        }
    </style>
</head>
<body>

    {{-- Loading Spinner --}}
    <div id="loading" class="loading-overlay">
        <div class="loader"></div>
        <p style="font-size:13px; opacity:0.6; letter-spacing:1px;">Memuat Dokumen...</p>
    </div>

    <div id="viewer-content">
        @php
            $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $isImage   = in_array($extension, ['jpg','jpeg','png','webp','gif']);
            $isPdf     = $extension === 'pdf';
            $isOffice  = in_array($extension, ['doc','docx','xls','xlsx','ppt','pptx']);

            // Google Drive / Docs Detection
            $isGDrive  = str_contains($file_path, 'drive.google.com')
                      || str_contains($file_path, 'docs.google.com');
            $gdriveId  = '';
            $embedUrl  = '';

            if ($isGDrive) {
                // Ekstrak ID dari berbagai format URL GDrive
                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $file_path, $m)) {
                    $gdriveId = $m[1];
                } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $file_path, $m)) {
                    $gdriveId = $m[1];
                }
                // Gunakan GDrive embed langsung (lebih stabil daripada proxy)
                if ($gdriveId) {
                    $embedUrl = "https://drive.google.com/file/d/{$gdriveId}/preview";
                }
            }

            $premiumEnabled = ($settings['premium_view_enabled'] ?? '0') === '1' && ($isBlurred ?? false);
            $blurText = $settings['premium_view_blur_text'] ?? 'Dokumen ini Terlindungi. Ajukan Permohonan untuk Akses Penuh.';
            $btnText  = $settings['premium_view_button_text'] ?? 'AJUKAN PERMOHONAN';
            $btnLink  = $settings['premium_view_button_link'] ?? '/permohonan-informasi';
        @endphp

        @if($isGDrive && $gdriveId)
            {{-- Google Drive: embed langsung via iframe, full-height, no scroll horizontal --}}
            <div class="office-viewer" style="height: 100vh; min-height: 600px;">
                <iframe
                    src="{{ $embedUrl }}"
                    allow="autoplay"
                    loading="lazy">
                </iframe>
            </div>

        @elseif($isPdf)
            {{-- PDF lokal via pdf.js dengan canvas responsive --}}
            <div id="pdf-viewer"></div>

        @elseif($isImage)
            {{-- Viewer Gambar --}}
            <div class="image-preview-container">
                <img src="{{ asset($file_path) }}" alt="{{ $title ?? 'Dokumen' }}">
                @if($premiumEnabled)
                <div class="premium-blur-overlay">
                    <div class="blur-icon"><i class="fas fa-lock"></i></div>
                    <p class="blur-message">{{ $blurText }}</p>
                    <a href="{{ $btnLink }}" class="btn-premium-action">
                        <i class="fas fa-paper-plane"></i> {{ $btnText }}
                    </a>
                </div>
                @endif
            </div>

        @elseif($isOffice)
            {{-- Office Viewer via Google Docs (lebih reliable) --}}
            @php
                $publicUrl = url($file_path);
                $googleViewUrl = "https://docs.google.com/gview?url=" . urlencode($publicUrl) . "&embedded=true";
            @endphp
            <div class="office-viewer">
                <iframe
                    src="{{ $googleViewUrl }}"
                    loading="lazy">
                </iframe>
            </div>

        @else
            {{-- Format tidak dikenal --}}
            <div style="text-align:center; color:white; padding:80px 20px;">
                <i class="fas fa-file-alt" style="font-size:4rem; opacity:0.4; margin-bottom:20px; display:block;"></i>
                <p style="opacity:0.6; font-size:14px;">Format dokumen tidak dapat ditampilkan di browser.</p>
            </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const loading = document.getElementById('loading');

        @if($isGDrive && $gdriveId)
            // GDrive iframe — sembunyikan loading setelah iframe siap
            const iframe = document.querySelector('.office-viewer iframe');
            if (iframe) {
                iframe.addEventListener('load', function () {
                    loading.style.opacity = '0';
                    setTimeout(() => loading.style.display = 'none', 400);
                });
            } else {
                setTimeout(() => { loading.style.opacity = '0'; setTimeout(() => loading.style.display = 'none', 400); }, 1500);
            }

        @elseif($isPdf)
            // PDF.js: render responsif sesuai lebar container
            const url        = '{{ asset($file_path) }}';
            const pdfjsLib   = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            const premiumEnabled = {{ $premiumEnabled ? 'true' : 'false' }};
            const blurText = '{{ addslashes($blurText) }}';
            const btnText  = '{{ addslashes($btnText) }}';
            const btnLink  = '{{ $btnLink }}';
            const container = document.getElementById('pdf-viewer');

            // Hitung lebar container untuk scale responsif
            const maxWidth = Math.min(window.innerWidth - 32, 900);

            pdfjsLib.getDocument(url).promise.then(function (pdf) {
                loading.style.opacity = '0';
                setTimeout(() => loading.style.display = 'none', 300);

                for (let num = 1; num <= pdf.numPages; num++) {
                    renderPage(pdf, num);
                }
            }).catch(function (err) {
                loading.innerHTML = '<p style="color:#ffc107; padding:40px; text-align:center;">Gagal memuat PDF.</p>';
            });

            function renderPage(pdf, num) {
                pdf.getPage(num).then(function (page) {
                    // Scale agar pas dengan lebar layar
                    const unscaledVp = page.getViewport({ scale: 1 });
                    const scale      = maxWidth / unscaledVp.width;
                    const viewport   = page.getViewport({ scale: scale });

                    const pageDiv = document.createElement('div');
                    pageDiv.className = 'pdf-page-container';

                    const canvas  = document.createElement('canvas');
                    const ctx     = canvas.getContext('2d');
                    // Render pada resolusi tinggi, tampil dengan CSS 100% width
                    const devicePR = window.devicePixelRatio || 1;
                    canvas.width  = viewport.width  * devicePR;
                    canvas.height = viewport.height * devicePR;
                    canvas.style.width  = viewport.width  + 'px';
                    canvas.style.height = viewport.height + 'px';
                    ctx.scale(devicePR, devicePR);

                    pageDiv.appendChild(canvas);
                    container.appendChild(pageDiv);

                    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(function () {
                        // Blur mulai dari halaman ke-2
                        if (premiumEnabled && num > 1) {
                            const overlay = document.createElement('div');
                            overlay.className = 'premium-blur-overlay';
                            overlay.innerHTML = `
                                <div class="blur-icon"><i class="fas fa-lock"></i></div>
                                <p class="blur-message">${blurText}</p>
                                <a href="${btnLink}" class="btn-premium-action">
                                    <i class="fas fa-paper-plane"></i> ${btnText}
                                </a>`;
                            pageDiv.appendChild(overlay);
                        }
                    });
                });
            }

        @else
            // Gambar / lainnya
            setTimeout(() => {
                loading.style.opacity = '0';
                setTimeout(() => loading.style.display = 'none', 400);
            }, 600);
        @endif
    });
    </script>
</body>
</html>
