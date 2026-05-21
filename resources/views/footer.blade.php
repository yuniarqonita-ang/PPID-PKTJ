@php
    if(!isset($settings)) {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    }
@endphp

<footer class="mt-5 pt-5 pb-4" style="background-color: #1a1c2e; color: #cbd5e1;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ" style="height: 50px; margin-right: 15px;">
                    <h5 class="fw-bold mb-0 text-white">PPID PKTJ</h5>
                </div>
                <p class="small opacity-75">
                    {{ $settings['deskripsi'] ?? 'Pejabat Pengelola Informasi dan Dokumentasi (PPID) Politeknik Keselamatan Transportasi Jalan (PKTJ) berkomitmen memberikan layanan informasi publik yang transparan dan akuntabel.' }}
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ $settings['facebook_link'] ?? '#' }}" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $settings['instagram_link'] ?? '#' }}" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $settings['twitter_link'] ?? '#' }}" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $settings['youtube_link'] ?? '#' }}" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h6 class="fw-bold text-white mb-4">Akses Cepat</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none text-reset opacity-75">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('profil.ppid') }}" class="text-decoration-none text-reset opacity-75">Profil PPID</a></li>
                    <li class="mb-2"><a href="{{ route('informasi.berkala') }}" class="text-decoration-none text-reset opacity-75">Informasi Publik</a></li>
                    <li class="mb-2"><a href="{{ route('prosedur.sop-permintaan') }}" class="text-decoration-none text-reset opacity-75">Prosedur SOP</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6 class="fw-bold text-white mb-4">Layanan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('layanan.maklumat-pelayanan') }}" class="text-decoration-none text-reset opacity-75">Maklumat Pelayanan</a></li>
                    <li class="mb-2"><a href="{{ route('layanan.laporan-layanan') }}" class="text-decoration-none text-reset opacity-75">Laporan Tahunan</a></li>
                    <li class="mb-2"><a href="{{ route('faq.public') }}" class="text-decoration-none text-reset opacity-75">FAQ</a></li>
                    <li class="mb-2"><a href="{{ route('permohonan.form') }}" class="text-decoration-none text-reset opacity-75">Permohonan Informasi</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="fw-bold text-white mb-4">Hubungi Kami</h6>
                <ul class="list-unstyled small opacity-75">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-warning"></i>
                        <span>{{ $settings['kontak_alamat'] ?? 'Jl. Semeru No.3, Tegal, Jawa Tengah 52131' }}</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-phone me-3 text-warning"></i>
                        <span>{{ $settings['kontak_telepon'] ?? '(0283) 351061' }}</span>
                    </li>
                    <li class="mb-0 d-flex align-items-center">
                        <i class="fas fa-envelope me-3 text-warning"></i>
                        <span>{{ $settings['kontak_email'] ?? 'ppid@pktj.ac.id' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0 opacity-50">&copy; {{ date('Y') }} PPID PKTJ. Hak cipta dilindungi undang-undang.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <!-- Branding Removed -->
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-opacity-100:hover { opacity: 1 !important; transform: translateY(-2px); }
    .transition { transition: all 0.3s ease; }
    footer a:hover { color: var(--secondary-gold) !important; opacity: 1 !important; }

    /* PREMIUM BLUR STYLES */
    @if($settings['premium_view_enabled'] ?? false)
    .premium-blur {
        position: relative !important;
        filter: blur(12px) !important;
        user-select: none !important;
        pointer-events: none !important;
        display: block !important;
        min-height: 150px !important;
        background: #f8fafc !important;
        border-radius: 12px !important;
        margin: 15px 0 !important;
        border: 1px solid #e2e8f0 !important;
    }
    .premium-blur-container {
        position: relative;
    }
    .premium-blur-overlay {
        position: absolute;
        inset: 0;
        z-index: 50;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(2px);
    }
    .premium-blur-text {
        color: #004a99;
        font-weight: 800;
        font-size: 1.1rem;
        margin-bottom: 20px;
        text-transform: uppercase;
        max-width: 500px;
        text-shadow: 0 0 10px rgba(255,255,255,0.8);
    }
    .premium-blur-btn {
        background: #ffc107;
        color: #004a99;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 900;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 13px;
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        border: none;
        transition: all 0.3s ease;
    }
    .premium-blur-btn:hover {
        transform: translateY(-5px);
        background: #004a99;
        color: white;
    }
    @endif
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- HELPERS ---
        function getOriginalDocUrl(src) {
            if (!src) return '';
            if (src.includes('drive.google.com')) {
                let match = src.match(/\/d\/([a-zA-Z0-9_-]+)/);
                if (match && match[1]) {
                    return `https://drive.google.com/file/d/${match[1]}/view`;
                }
                return src;
            }
            if (src.includes('/preview-dokumen')) {
                try {
                    let urlObj = new URL(src, window.location.origin);
                    let filePath = urlObj.searchParams.get('file');
                    if (filePath) {
                        if (filePath.includes('drive.google.com')) {
                            return getOriginalDocUrl(filePath);
                        }
                        return window.location.origin + '/' + filePath;
                    }
                } catch(e) {
                    console.error(e);
                }
            }
            return src;
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // 1. HANDLE PREMIUM BLUR (MANUAL & AUTOMATIC)
        @if($settings['premium_view_enabled'] ?? false)
        const processBlur = (el) => {
            if (el.dataset.blurProcessed) return;
            el.dataset.blurProcessed = "true";

            // Wrap in a relative container if not already
            const wrapper = document.createElement('div');
            wrapper.className = 'premium-blur-container';
            el.parentNode.insertBefore(wrapper, el);
            wrapper.appendChild(el);
            
            // Add overlay
            const overlay = document.createElement('div');
            overlay.className = 'premium-blur-overlay';
            
            const text = document.createElement('div');
            text.className = 'premium-blur-text';
            text.innerText = "{{ $settings['premium_view_blur_text'] ?? 'Dokumen ini dikunci untuk alasan keamanan. Silakan ajukan permohonan informasi untuk melihat konten lengkap.' }}";
            
            const btn = document.createElement('button');
            btn.className = 'premium-blur-btn';
            btn.innerText = 'Ajukan Permohonan';
            btn.onclick = function(e) {
                e.preventDefault();
                window.location.href = "{{ $settings['premium_view_cta_url'] ?? route('permohonan.form') }}";
            };
            
            overlay.appendChild(text);
            overlay.appendChild(btn);
            wrapper.appendChild(overlay);
        };

        document.querySelectorAll('.premium-blur').forEach(processBlur);
        @endif

        // 2. DYNAMICALLY ENHANCE ALL GOOGLE DRIVE EMBEDS & PREVIEW IFRAMES
        document.querySelectorAll('iframe').forEach(iframe => {
            // Skip modal iframes, in-page custom views, or admin panels
            if (iframe.closest('#previewModal') || iframe.closest('#gdrive-frame-wrapper') || window.location.pathname.includes('/admin')) {
                return;
            }

            let src = iframe.getAttribute('src');
            if (src) {
                // Determine if blurred from parent container
                let parentBox = iframe.closest('.premium-box-outer');
                let isBlurred = false;
                if (parentBox) {
                    isBlurred = parentBox.getAttribute('data-blurred') === '1' || parentBox.classList.contains('premium-blur');
                } else if (iframe.classList.contains('premium-blur')) {
                    isBlurred = true;
                }

                // Respect original size of the iframe itself
                let customWidth = '100%';
                let customHeight = '700px';

                let originalWidth = iframe.getAttribute('width') || iframe.style.width;
                let originalHeight = iframe.getAttribute('height') || iframe.style.height;

                if (originalWidth && originalWidth.trim() !== '') {
                    customWidth = isNaN(originalWidth) ? originalWidth : `${originalWidth}px`;
                }
                if (originalHeight && originalHeight.trim() !== '') {
                    customHeight = isNaN(originalHeight) ? originalHeight : `${originalHeight}px`;
                }

                // If parentBox specifies explicit size, that takes precedence (edited in CMS)
                if (parentBox) {
                    let dataWidth = parentBox.getAttribute('data-width');
                    if (dataWidth && dataWidth.trim() !== '') {
                        customWidth = isNaN(dataWidth) ? dataWidth : `${dataWidth}px`;
                    }
                    let dataHeight = parentBox.getAttribute('data-height');
                    if (dataHeight && dataHeight.trim() !== '') {
                        customHeight = isNaN(dataHeight) ? dataHeight : `${dataHeight}px`;
                    }
                }

                // Transform URL for clean premium display
                let isLocalPreview = src.includes('preview-dokumen');
                let isDirectDrive = src.includes('drive.google.com') && !isLocalPreview;

                if (isLocalPreview) {
                    try {
                        let separator = src.includes('?') ? '&' : '?';
                        if (!src.includes('embed=')) {
                            src += separator + 'embed=1';
                            separator = '&';
                        }
                        if (isBlurred && !src.includes('is_blurred=')) {
                            src += separator + 'is_blurred=1';
                        }
                        iframe.setAttribute('src', src);
                    } catch (e) {
                        console.error('Error enhancing preview src:', e);
                    }
                } else if (isDirectDrive) {
                    // Convert direct Google Drive link into our custom borderless previewer!
                    let driveId = '';
                    let match = src.match(/\/d\/([a-zA-Z0-9_-]+)/) || src.match(/[?&]id=([a-zA-Z0-9_-]+)/);
                    if (match && match[1]) {
                        driveId = match[1];
                    }
                    if (driveId) {
                        let previewUrl = `/preview-dokumen?file=https://drive.google.com/file/d/${driveId}/preview&embed=1`;
                        if (isBlurred) {
                            previewUrl += '&is_blurred=1';
                        }
                        src = previewUrl;
                        iframe.setAttribute('src', src);
                        isLocalPreview = true; // Mark as local preview now
                    }
                }

                // Style the iframe (completely borderless and premium)
                iframe.style.setProperty('width', '100%', 'important');
                iframe.style.setProperty('border', 'none', 'important');
                iframe.style.setProperty('border-radius', '0', 'important');
                iframe.style.setProperty('box-shadow', 'none', 'important');
                iframe.style.setProperty('display', 'block', 'important');
                iframe.style.setProperty('margin', '0', 'important');

                if (isBlurred) {
                    if (isLocalPreview) {
                        // The local preview page handles its own selective page-level blur internally!
                        // So we DO NOT apply a hard blur to the outer iframe, keeping page 1 readable!
                        iframe.style.setProperty('pointer-events', 'auto', 'important');
                        iframe.setAttribute('scrolling', 'yes');
                        
                        if (parentBox) {
                            parentBox.style.setProperty('display', 'block', 'important');
                            parentBox.style.setProperty('position', 'relative', 'important');
                            parentBox.style.setProperty('width', '100%', 'important');
                            parentBox.style.setProperty('max-width', customWidth, 'important');
                            parentBox.style.setProperty('height', customHeight, 'important');
                            parentBox.style.setProperty('margin', '20px auto', 'important');
                            parentBox.style.setProperty('border', 'none', 'important');
                            parentBox.style.setProperty('box-shadow', 'none', 'important');
                            parentBox.style.setProperty('background', 'transparent', 'important');
                        }
                    } else {
                        // Hard full blur for non-custom external iframes
                        iframe.style.setProperty('pointer-events', 'none', 'important');
                        iframe.style.setProperty('filter', 'blur(12px)', 'important');
                        iframe.setAttribute('scrolling', 'no');

                        if (parentBox) {
                            parentBox.style.setProperty('display', 'block', 'important');
                            parentBox.style.setProperty('position', 'relative', 'important');
                            parentBox.style.setProperty('width', '100%', 'important');
                            parentBox.style.setProperty('max-width', customWidth, 'important');
                            parentBox.style.setProperty('height', customHeight, 'important');
                            parentBox.style.setProperty('margin', '20px auto', 'important');
                            parentBox.style.setProperty('overflow', 'hidden', 'important');
                            parentBox.style.setProperty('border-radius', '16px', 'important');
                            parentBox.style.setProperty('border', '1px solid #e2e8f0', 'important');
                            parentBox.style.setProperty('box-shadow', '0 20px 40px rgba(0,74,153,0.08)', 'important');
                            parentBox.style.setProperty('background', '#fff', 'important');

                            // Render premium full-blur overlay
                            if (!parentBox.querySelector('.premium-blur-overlay')) {
                                const overlay = document.createElement('div');
                                overlay.className = 'premium-blur-overlay';
                                overlay.style.cssText = 'position: absolute; inset: 0; z-index: 50; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 40px; background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(2px);';
                                
                                const iconWrap = document.createElement('div');
                                iconWrap.style.cssText = 'width: 64px; height: 64px; background: rgba(0, 74, 153, 0.1); color: #004a99; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(0, 74, 153, 0.1);';
                                iconWrap.innerHTML = '<i class="fas fa-lock"></i>';
                                
                                const text = document.createElement('div');
                                text.className = 'premium-blur-text';
                                text.style.cssText = 'color: #004a99; font-weight: 800; font-size: 1.1rem; margin-bottom: 20px; text-transform: uppercase; max-width: 500px; text-shadow: 0 0 10px rgba(255,255,255,0.8); line-height: 1.4;';
                                text.innerText = "{{ $settings['premium_view_blur_text'] ?? 'Dokumen ini dikunci untuk alasan keamanan. Silakan ajukan permohonan informasi untuk melihat konten lengkap.' }}";
                                
                                const btn = document.createElement('a');
                                btn.className = 'premium-blur-btn';
                                btn.href = "{{ $settings['premium_view_cta_url'] ?? route('permohonan.form') }}";
                                btn.style.cssText = 'background: #ffc107; color: #004a99; padding: 12px 30px; border-radius: 50px; font-weight: 900; text-decoration: none; text-transform: uppercase; font-size: 13px; box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4); border: none; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;';
                                btn.innerHTML = '<i class="fas fa-file-signature"></i> Ajukan Permohonan';
                                
                                btn.onmouseover = () => {
                                    btn.style.transform = 'translateY(-3px)';
                                    btn.style.boxShadow = '0 15px 30px rgba(255, 193, 7, 0.6)';
                                };
                                btn.onmouseout = () => {
                                    btn.style.transform = 'translateY(0)';
                                    btn.style.boxShadow = '0 10px 25px rgba(255, 193, 7, 0.4)';
                                };
                                
                                overlay.appendChild(iconWrap);
                                overlay.appendChild(text);
                                overlay.appendChild(btn);
                                parentBox.appendChild(overlay);
                            }
                        }
                    }
                } else {
                    // Normal document display
                    iframe.style.setProperty('pointer-events', 'auto', 'important');
                    iframe.setAttribute('scrolling', 'yes');

                    if (parentBox) {
                        parentBox.style.setProperty('display', 'block', 'important');
                        parentBox.style.setProperty('position', 'relative', 'important');
                        parentBox.style.setProperty('width', '100%', 'important');
                        parentBox.style.setProperty('max-width', customWidth, 'important');
                        parentBox.style.setProperty('height', customHeight, 'important');
                        parentBox.style.setProperty('margin', '20px auto', 'important');
                        parentBox.style.setProperty('border', 'none', 'important');
                        parentBox.style.setProperty('box-shadow', 'none', 'important');
                        parentBox.style.setProperty('background', 'transparent', 'important');
                    } else {
                        iframe.style.setProperty('height', customHeight, 'important');
                        iframe.style.setProperty('margin', '20px 0', 'important');
                    }
                }
            }
        });

        // 3. LISTEN FOR RESIZE MESSAGES FROM EMBEDDED DOCS FOR NATURAL SCROLLING
        window.addEventListener('message', function(event) {
            if (event.data && event.data.type === 'resize-iframe') {
                const height = event.data.height;
                document.querySelectorAll('iframe').forEach(iframe => {
                    if (iframe.contentWindow === event.source) {
                        // Apply natural scrollable height to the iframe
                        iframe.style.setProperty('height', height + 'px', 'important');
                        
                        // Also expand parent wrapper box if exists
                        const parentBox = iframe.closest('.premium-box-outer');
                        if (parentBox) {
                            parentBox.style.setProperty('height', height + 'px', 'important');
                        }
                    }
                });
            }
        });

        // 3. AUTO-EMBED GOOGLE DRIVE LINKS THAT ARE NOT IFRAMES (Optional but helpful)
        document.querySelectorAll('a').forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.includes('drive.google.com/file/d/') && !link.closest('iframe')) {
                // If it's a direct link to a file, and user wants it embedded (based on class or context)
                if (link.innerText.toLowerCase().includes('lihat') || link.classList.contains('embed-drive')) {
                    const driveId = href.match(/\/d\/([^\/]+)/)?.[1];
                    if (driveId) {
                        const baseUrl = "{{ route('preview.dokumen') }}";
                        const embedUrl = `${baseUrl}?file=${encodeURIComponent(href)}&title=${encodeURIComponent(link.innerText)}`;
                        const iframe = document.createElement('iframe');
                        iframe.setAttribute('src', embedUrl);
                        iframe.style.width = '100%';
                        iframe.style.minHeight = '600px';
                        iframe.style.borderRadius = '16px';
                        iframe.style.border = '1px solid #e2e8f0';
                        iframe.style.margin = '25px 0';
                        iframe.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                        iframe.setAttribute('allowfullscreen', 'true');
                        link.parentNode.replaceChild(iframe, link);
                    }
                }
            }
        });
    });
</script>
