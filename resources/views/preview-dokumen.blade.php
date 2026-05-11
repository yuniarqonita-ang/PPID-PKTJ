<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pratinjau Dokumen' }} - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --blur-intensity: 12px;
        }
        
        body { 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #1a1a1a; 
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        body::-webkit-scrollbar { display: none; }
        /* Hide scrollbar for IE, Edge and Firefox */
        body { -ms-overflow-style: none; scrollbar-width: none; }
        
        .viewer-toolbar {
            background: rgba(0, 74, 153, 0.95);
            backdrop-filter: blur(10px);
            color: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .viewer-title {
            font-weight: 800;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 50%;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .viewer-title i { color: var(--secondary-gold); }
        
        .viewer-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        
        .btn-viewer {
            padding: 8px 18px;
            text-decoration: none;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back { background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); }
        .btn-back:hover { background: white; color: var(--primary-blue); }

        .btn-download { background: var(--secondary-gold); color: var(--primary-blue); }
        .btn-download:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3); background: white; }
        
        #viewer-content {
            flex: 1;
            overflow-y: auto;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            scroll-behavior: smooth;
        }

        /* Detect if in iframe */
        body.in-iframe .btn-back { display: none; }
        body.in-iframe .viewer-toolbar { padding: 10px 20px; }
        body.in-iframe #viewer-content { padding: 20px 10px; }
        body.in-iframe .viewer-title { max-width: 60%; font-size: 0.75rem; }

        /* PDF Page Styling */
        .pdf-page-container {
            position: relative;
            background: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            margin-bottom: 20px;
            border-radius: 4px;
            overflow: hidden;
        }

        .canvas-wrapper { position: relative; }

        /* Blur Overlay */
        .premium-blur-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(var(--blur-intensity));
            background: rgba(255, 255, 255, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
            padding: 40px;
            text-align: center;
        }

        .blur-content {
            max-width: 500px;
            animation: fadeInUp 0.8s ease-out;
        }

        .blur-icon {
            font-size: 4rem;
            color: var(--primary-blue);
            margin-bottom: 25px;
            text-shadow: 0 10px 20px rgba(0, 74, 153, 0.2);
        }

        .blur-message {
            font-size: 1.5rem;
            font-weight: 900;
            color: #000;
            margin-bottom: 25px;
            line-height: 1.3;
            text-transform: uppercase;
        }

        .btn-premium-action {
            background: var(--primary-blue);
            color: white;
            padding: 18px 35px;
            border-radius: 50px;
            font-weight: 900;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 15px 30px rgba(0, 74, 153, 0.3);
            transition: all 0.3s;
        }

        .btn-premium-action:hover {
            background: #000;
            transform: scale(1.05);
            color: white;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .loading-overlay {
            position: fixed;
            inset: 0;
            background: #1a1a1a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            color: white;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255,255,255,0.1);
            border-top: 5px solid var(--secondary-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* Image Preview Style */
        .image-preview-container {
            max-width: 90%;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }

        .image-preview-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        @media (max-width: 768px) {
            .viewer-title { max-width: 40%; font-size: 11px; }
            .btn-viewer span { display: none; }
            .blur-message { font-size: 1.1rem; }
        }
    </style>
</head>
<body>

    <div id="loading" class="loading-overlay">
        <div class="loader"></div>
        <p class="fw-bold tracking-widest uppercase text-xs opacity-50">Menyiapkan Dokumen...</p>
    </div>

    <div class="viewer-toolbar">
        <div class="viewer-title">
            <i class="fas fa-shield-halved"></i> {{ $title ?? 'Pratinjau Terbatas' }}
        </div>
        <div class="viewer-actions">
            <a href="{{ url()->previous() == url()->current() ? url('/') : url()->previous() }}" class="btn-viewer btn-back">
                <i class="fas fa-arrow-left"></i> <span>Kembali</span>
            </a>
            <a href="{{ asset($file_path) }}" download class="btn-viewer btn-download">
                <i class="fas fa-download"></i> <span>Unduh</span>
            </a>
        </div>
    </div>

    <div id="viewer-content">
        @php
            $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
            $isPdf = $extension === 'pdf';
            $isOffice = in_array($extension, ['doc', 'docx', 'xls', 'xlsx']);
            
            $premiumEnabled = ($settings['premium_view_enabled'] ?? '0') === '1' && ($isBlurred ?? false);
            $blurText = $settings['premium_view_blur_text'] ?? 'Lanjutkan Membaca? Silakan Ajukan Permohonan Informasi';
            $btnText = $settings['premium_view_button_text'] ?? 'AJUKAN SEKARANG';
            $btnLink = $settings['premium_view_button_link'] ?? '/permohonan-informasi';
        @endphp

        @if($isPdf)
            <!-- PDF Viewer with pdf.js -->
            <div id="pdf-viewer"></div>
        @elseif($isImage)
            <!-- Image Viewer -->
            <div class="image-preview-container">
                <img src="{{ asset($file_path) }}" alt="{{ $title }}">
                @if($premiumEnabled)
                <div class="premium-blur-overlay">
                    <div class="blur-content">
                        <div class="blur-icon"><i class="fas fa-lock"></i></div>
                        <h2 class="blur-message">{{ $blurText }}</h2>
                        <a href="{{ $btnLink }}" class="btn-premium-action">
                            <i class="fas fa-paper-plane"></i> {{ $btnText }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        @elseif($isOffice)
            <!-- Office Viewer Iframe -->
            <div style="width: 100%; height: 100%; min-height: 80vh; background: white;">
                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset($file_path)) }}" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        @else
            <div class="text-center text-white py-5">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-4"></i>
                <h3 class="fw-black uppercase">Format Tidak Didukung</h3>
                <p class="opacity-50">Silakan unduh dokumen untuk melihat isi lengkapnya.</p>
                <a href="{{ asset($file_path) }}" download class="btn btn-warning fw-black mt-3 px-5 py-3 rounded-pill">UNDUH SEKARANG</a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Detect if in iframe
            if (window.self !== window.top) {
                document.body.classList.add('in-iframe');
            }

            const loading = document.getElementById('loading');
            
            @if($isPdf)
                const url = '{{ asset($file_path) }}';
                const pdfjsLib = window['pdfjs-dist/build/pdf'];
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

                const premiumEnabled = {{ $premiumEnabled ? 'true' : 'false' }};
                const isBlurred = {{ ($isBlurred ?? false) ? 'true' : 'false' }};
                const blurText = '{{ addslashes($blurText) }}';
                const btnText = '{{ addslashes($btnText) }}';
                const btnLink = '{{ $btnLink }}';

                let pdfDoc = null;
                const container = document.getElementById('pdf-viewer');

                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    pdfDoc = pdf;
                    loading.style.display = 'none';
                    
                    // Render all pages
                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        renderPage(pageNum);
                    }
                }).catch(function(error) {
                    console.error('Error loading PDF:', error);
                    loading.innerHTML = '<div class="p-5 text-center text-white"><i class="fas fa-times-circle fa-3x text-danger mb-3"></i><p>Gagal memuat dokumen PDF. Pastikan file tersedia di server.</p></div>';
                });

                function renderPage(num) {
                    pdfDoc.getPage(num).then(function(page) {
                        const scale = 1.5;
                        const viewport = page.getViewport({ scale: scale });

                        const pageContainer = document.createElement('div');
                        pageContainer.className = 'pdf-page-container';
                        
                        const canvasWrapper = document.createElement('div');
                        canvasWrapper.className = 'canvas-wrapper';
                        
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        canvasWrapper.appendChild(canvas);
                        pageContainer.appendChild(canvasWrapper);
                        container.appendChild(pageContainer);

                        const renderContext = {
                            canvasContext: ctx,
                            viewport: viewport
                        };

                        page.render(renderContext).promise.then(function() {
                            // Apply Blur if premium and page > 1
                            if (premiumEnabled && num > 1) {
                                const overlay = document.createElement('div');
                                overlay.className = 'premium-blur-overlay';
                                overlay.innerHTML = `
                                    <div class="blur-content">
                                        <div class="blur-icon"><i class="fas fa-lock"></i></div>
                                        <h2 class="blur-message">${blurText}</h2>
                                        <a href="${btnLink}" class="btn-premium-action">
                                            <i class="fas fa-paper-plane"></i> ${btnText}
                                        </a>
                                    </div>
                                `;
                                pageContainer.appendChild(overlay);
                            }
                        });
                    });
                }
            @else
                // For non-pdf (images, etc)
                setTimeout(() => {
                    loading.style.opacity = '0';
                    setTimeout(() => loading.style.display = 'none', 500);
                }, 800);
            @endif
        });
    </script>
</body>
</html>
