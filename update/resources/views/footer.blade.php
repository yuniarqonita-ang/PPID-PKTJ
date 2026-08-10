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
                @php
                    $fbLink = !empty($settings['facebook_link']) && $settings['facebook_link'] !== '#' ? $settings['facebook_link'] : 'https://www.facebook.com/PKTJTegal/';
                    $igLink = !empty($settings['instagram_link']) && $settings['instagram_link'] !== '#' ? $settings['instagram_link'] : 'https://www.instagram.com/pktj_tegal/';
                    $twLink = !empty($settings['twitter_link']) && $settings['twitter_link'] !== '#' ? $settings['twitter_link'] : 'https://x.com/pktjtegal';
                    $ytLink = !empty($settings['youtube_link']) && $settings['youtube_link'] !== '#' ? $settings['youtube_link'] : 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA';
                @endphp
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ $fbLink }}" target="_blank" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $igLink }}" target="_blank" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $twLink }}" target="_blank" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-x-twitter"></i></a>
                    <a href="{{ $ytLink }}" target="_blank" class="text-white opacity-50 hover-opacity-100 transition"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h6 class="fw-bold text-white mb-4">Akses Cepat</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none text-reset opacity-75">Beranda</a></li>
                    @php
                        try {
                            $footerMenus = \App\Models\CustomMenu::whereNull('parent_id')
                                ->where('aktif', true)
                                ->whereIn('penempatan', ['footer', 'both'])
                                ->orderBy('urutan', 'asc')
                                ->get();
                        } catch (\Exception $e) {
                            $footerMenus = collect([]);
                        }
                    @endphp
                    @foreach($footerMenus as $fMenu)
                        <li class="mb-2">
                            @if(str_starts_with($fMenu->url, 'http://') || str_starts_with($fMenu->url, 'https://'))
                                <a href="{{ $fMenu->url }}" target="_blank" class="text-decoration-none text-reset opacity-75">{{ $fMenu->nama }}</a>
                            @else
                                <a href="{{ $fMenu->url ?: '/halaman/' . $fMenu->slug }}" class="text-decoration-none text-reset opacity-75">{{ $fMenu->nama }}</a>
                            @endif
                        </li>
                    @endforeach
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
                    <li class="mb-3">
                        <span class="fw-bold text-white">Politeknik Keselamatan Transportasi Jalan</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-building mt-1 me-3 text-warning"></i>
                        <span>Jl. Abdul Syukur No. 17, Kota Tegal</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-warning"></i>
                        <span>{{ $settings['kontak_alamat'] ?? 'Jl. Perintis Kemerdekaan No. 17, Kota Tegal' }}</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <a href="mailto:{{ $settings['kontak_email'] ?? 'pktj@pktj.ac.id' }}" class="text-decoration-none text-reset d-flex align-items-center">
                            <i class="fas fa-envelope me-3 text-warning"></i>
                            <span>{{ $settings['kontak_email'] ?? 'pktj@pktj.ac.id' }}</span>
                        </a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <a href="tel:{{ $settings['kontak_telepon'] ?? '(0283) 351061' }}" class="text-decoration-none text-reset d-flex align-items-center">
                            <i class="fas fa-phone me-3 text-warning"></i>
                            <span>Phone: {{ $settings['kontak_telepon'] ?? '(0283) 351061' }}</span>
                        </a>
                    </li>
                    <li class="mb-0 d-flex align-items-center">
                        <a href="tel:(0283)358965" class="text-decoration-none text-reset d-flex align-items-center">
                            <i class="fas fa-print me-3 text-warning"></i>
                            <span>Fax: (0283) 358965</span>
                        </a>
                    </li>
                </ul>
        </div>

        <!-- Peta Kampus I & II -->
        <div class="row mt-4 g-4">
            <div class="col-md-6">
                <h6 class="fw-bold text-white mb-2" style="font-size: 14px;"><i class="fas fa-map-marked-alt me-2 text-warning"></i>Peta Lokasi Kampus I (Slerok)</h6>
                <div class="rounded-3 overflow-hidden map-container-footer" style="height: 180px; border: 1px solid rgba(255,255,255,0.1);">
                    @if(isset($settings['kontak_kampus_1_map']) && !empty($settings['kontak_kampus_1_map']))
                        {!! $settings['kontak_kampus_1_map'] !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.23846665793!2d109.1396263!3d-6.8687256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb797c0000001%3A0xbd8ffc1a1154737d!2sPoliteknik%20Keselamatan%20Transportasi%20Jalan!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" style="width:100%; height:100%; border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-white mb-2" style="font-size: 14px;"><i class="fas fa-map-marked-alt me-2 text-warning"></i>Peta Lokasi Kampus II (Margadana)</h6>
                <div class="rounded-3 overflow-hidden map-container-footer" style="height: 180px; border: 1px solid rgba(255,255,255,0.1);">
                    @if(isset($settings['kontak_kampus_2_map']) && !empty($settings['kontak_kampus_2_map']))
                        {!! $settings['kontak_kampus_2_map'] !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.077224213794!2d109.09886317578768!3d-6.882898767355088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb86a87799d19%3A0x644265697669d255!2sPKTJ%20Kampus%20I!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" style="width:100%; height:100%; border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>
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
    .map-container-footer iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
    }
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
        // First, check for naked premium-box-outer iframes and wrap them dynamically on front-end
        document.querySelectorAll('iframe.premium-box-outer').forEach(iframe => {
            let parentBox = iframe.parentElement.closest('.premium-box-outer');
            if (!parentBox) {
                // It's a naked iframe in the content, let's wrap it dynamically!
                parentBox = document.createElement('span');
                parentBox.className = 'premium-box-outer';
                
                // Copy data attributes
                ['data-url', 'data-title', 'data-width', 'data-height', 'data-blurred'].forEach(attr => {
                    if (iframe.hasAttribute(attr)) {
                        parentBox.setAttribute(attr, iframe.getAttribute(attr));
                    }
                });

                // Set styles for premium wrapping (display block, alignment)
                let customWidth = iframe.getAttribute('data-width') || iframe.style.width || '500';
                let customHeight = iframe.getAttribute('data-height') || iframe.style.height || '400';
                if (!isNaN(customWidth)) customWidth = customWidth + 'px';
                if (!isNaN(customHeight)) customHeight = customHeight + 'px';

                parentBox.style.cssText = `display:inline-block; vertical-align:bottom; margin:0 10px 5px 0; border:none; box-shadow:none; background:transparent;`;
                
                // Respect alignment/float in the wrapped span
                if (iframe.style.float === 'left' || iframe.getAttribute('align') === 'left') {
                    parentBox.style.setProperty('float', 'left', 'important');
                    parentBox.style.setProperty('margin', '0 15px 15px 0', 'important');
                } else if (iframe.style.float === 'right' || iframe.getAttribute('align') === 'right') {
                    parentBox.style.setProperty('float', 'right', 'important');
                    parentBox.style.setProperty('margin', '0 0 15px 15px', 'important');
                }

                // Wrap it
                iframe.parentNode.insertBefore(parentBox, iframe);
                parentBox.appendChild(iframe);
                
                // Clean up the inner iframe styling so it fills the parent perfectly
                iframe.classList.remove('premium-box-outer');
                iframe.style.setProperty('width', '100%', 'important');
                iframe.style.setProperty('height', '100%', 'important');
                iframe.style.setProperty('float', 'none', 'important');
                iframe.style.setProperty('margin', '0', 'important');
            }
        });

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
                if (parentBox) {
                    iframe.style.setProperty('height', '100%', 'important');
                }
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

<!-- ==========================================
     WEB ACCESSIBILITY & PPID COMPLIANCE WIDGET
     ========================================== -->
<style>
    /* Floating Button */
    .accessibility-float-btn {
        position: fixed;
        bottom: 30px;
        left: 30px;
        z-index: 9990;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #004a99, #002b5c);
        color: #ffc107;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(0, 74, 153, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid #ffc107;
    }
    .accessibility-float-btn:hover {
        transform: scale(1.1) rotate(15deg);
        box-shadow: 0 15px 30px rgba(0, 74, 153, 0.6);
        background: #ffc107;
        color: #004a99;
        border-color: #004a99;
    }
    
    /* Accessibility Panel */
    .accessibility-panel {
        position: fixed;
        bottom: 105px;
        left: 30px;
        z-index: 9991;
        width: 350px;
        max-width: calc(100vw - 60px);
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        border: 2px solid rgba(0, 74, 153, 0.1);
        overflow: hidden;
        display: none;
        flex-direction: column;
        animation: slideUpAcc 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Inter', sans-serif;
    }
    
    @keyframes slideUpAcc {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .accessibility-header {
        background: linear-gradient(135deg, #004a99, #002b5c);
        color: #ffffff;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .accessibility-header h5 {
        margin: 0;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
        color: #ffc107;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .accessibility-close-btn {
        background: transparent;
        border: none;
        color: #ffffff;
        font-size: 20px;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .accessibility-close-btn:hover {
        opacity: 1;
    }
    
    .accessibility-body {
        padding: 20px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .acc-section-title {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        color: #004a99;
        margin-bottom: 12px;
        letter-spacing: 1px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .acc-btn-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .acc-action-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .acc-action-btn:hover {
        background: #004a99;
        color: #ffffff;
        border-color: #004a99;
    }
    .acc-action-btn.active {
        background: #ffc107;
        color: #004a99;
        border-color: #ffc107;
    }
    
    /* Document List */
    .acc-doc-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }
    .acc-doc-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        background: #f0f4f8;
        border-radius: 12px;
        text-decoration: none;
        color: #002b5c;
        font-weight: 700;
        font-size: 12px;
        transition: all 0.2s;
        border: 1px solid rgba(0, 74, 153, 0.05);
    }
    .acc-doc-item:hover {
        background: #e2e8f0;
        color: #004a99;
        transform: translateX(4px);
    }
    
    /* Custom CSS adjustments on body */
    body.accessibility-high-contrast {
        background-color: #0d0e12 !important;
        color: #f8fafc !important;
    }
    body.accessibility-high-contrast *:not(.accessibility-panel):not(.accessibility-panel *) {
        background-color: #0d0e12 !important;
        color: #ffffff !important;
        border-color: #ffc107 !important;
    }
    body.accessibility-high-contrast a:not(.accessibility-panel *) {
        color: #ffc107 !important;
        text-decoration: underline !important;
    }
    body.accessibility-high-contrast button:not(.accessibility-panel *), 
    body.accessibility-high-contrast .btn:not(.accessibility-panel *) {
        background: #ffc107 !important;
        color: #0d0e12 !important;
    }
    
    body.accessibility-text-lg { font-size: 19px !important; }
    body.accessibility-text-lg .rich-content { font-size: 1.2rem !important; }
    body.accessibility-text-xl { font-size: 22px !important; }
    body.accessibility-text-xl .rich-content { font-size: 1.4rem !important; }
    
    body.accessibility-grayscale {
        filter: grayscale(100%) !important;
    }
</style>

<!-- Floating Toggle Button -->
<div class="accessibility-float-btn no-print" id="accFloatBtn" title="Fitur Aksesibilitas & Dokumen Kepatuhan PPID">
    <i class="fas fa-universal-access"></i>
</div>

<!-- Settings Panel -->
<div class="accessibility-panel no-print" id="accPanel">
    <div class="accessibility-header">
        <h5><i class="fas fa-universal-access me-2"></i>Aksesibilitas & Kepatuhan</h5>
        <button class="accessibility-close-btn" id="accCloseBtn">&times;</button>
    </div>
    
    <div class="accessibility-body">
        <!-- Text Scale Section -->
        <div class="acc-section-title">
            <i class="fas fa-text-height"></i> Ukuran Teks Halaman
        </div>
        <div class="acc-btn-grid">
            <button class="acc-action-btn active" id="btnTextNormal">Normal</button>
            <button class="acc-action-btn" id="btnTextLarge">Besar (A+)</button>
            <button class="acc-action-btn" id="btnTextExLarge" style="grid-column: span 2;">Sangat Besar (A++)</button>
        </div>
        
        <!-- Contrast & Grayscale -->
        <div class="acc-section-title">
            <i class="fas fa-eye-dropper"></i> Tampilan & Kontras
        </div>
        <div class="acc-btn-grid">
            <button class="acc-action-btn" id="btnContrast">Kontras Tinggi</button>
            <button class="acc-action-btn" id="btnGrayscale">Grayscale</button>
        </div>
        
        <!-- Voice Reader -->
        <div class="acc-section-title">
            <i class="fas fa-volume-up"></i> Pembaca Suara (Text-to-Speech)
        </div>
        <div class="acc-btn-grid">
            <button class="acc-action-btn" id="btnStartVoice" style="background:#eefaf2; color:#10b981; border-color:#d1fae5;">
                <i class="fas fa-play"></i> Mulai Baca
            </button>
            <button class="acc-action-btn" id="btnStopVoice" style="background:#fef2f2; color:#ef4444; border-color:#fee2e2;">
                <i class="fas fa-stop"></i> Berhenti
            </button>
        </div>
        
        <!-- Printable Forms Downloads -->
        <div class="acc-section-title">
            <i class="fas fa-file-pdf"></i> Formulir Layanan (Cetak)
        </div>
        <div class="acc-doc-list">
            <a href="{{ route('dokumen.formulir-permohonan-cetak') }}" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-file-signature me-2 text-primary"></i>Form Permohonan Informasi</span>
                <i class="fas fa-print"></i>
            </a>
            <a href="{{ route('dokumen.formulir-keberatan-cetak') }}" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Form Pernyataan Keberatan</span>
                <i class="fas fa-print"></i>
            </a>
            <a href="{{ route('dokumen.formulir-braille-cetak') }}" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-braille me-2 text-info"></i>Form Permohonan Huruf Braille</span>
                <i class="fas fa-print"></i>
            </a>
        </div>
        
        <!-- Layanan Inklusif (Braille) -->
        <div class="acc-section-title">
            <i class="fas fa-universal-access"></i> Layanan Inklusif & Braille
        </div>
        <div class="acc-doc-list">
            <a href="{{ route('dokumen.laporan-braille') }}" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-file-contract me-2 text-success"></i>Laporan Layanan Huruf Braille</span>
                <i class="fas fa-print"></i>
            </a>
        </div>
        
        <!-- Regulatory & Legality Documents -->
        <div class="acc-section-title">
            <i class="fas fa-gavel"></i> Dasar Hukum & Legalitas PPID
        </div>
        <div class="acc-doc-list">
            <a href="https://jdih.dephub.go.id/hukum/PM.46%20TAHUN%202018.pdf" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-book me-2 text-success"></i>PM 46 Tahun 2018 (Pedoman Umum)</span>
                <i class="fas fa-download"></i>
            </a>
            <a href="https://jdih.dephub.go.id/hukum/KM.117%20TAHUN%202022.pdf" target="_blank" class="acc-doc-item">
                <span><i class="fas fa-scroll me-2 text-danger"></i>KM 117 Tahun 2022 (SOP Kemenhub)</span>
                <i class="fas fa-download"></i>
            </a>
            <a href="{{ route('profil.ppid.html') }}" class="acc-doc-item">
                <span><i class="fas fa-id-card me-2 text-info"></i>SK PPID Pelaksana PKTJ (Legalitas)</span>
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const floatBtn = document.getElementById('accFloatBtn');
        const panel = document.getElementById('accPanel');
        const closeBtn = document.getElementById('accCloseBtn');
        
        // Panel toggle
        floatBtn.addEventListener('click', () => {
            panel.style.display = panel.style.display === 'flex' ? 'none' : 'flex';
        });
        closeBtn.addEventListener('click', () => {
            panel.style.display = 'none';
        });
        
        // Font scaling
        const btnNormal = document.getElementById('btnTextNormal');
        const btnLarge = document.getElementById('btnTextLarge');
        const btnExLarge = document.getElementById('btnTextExLarge');
        const body = document.body;
        
        function resetFontButtons() {
            [btnNormal, btnLarge, btnExLarge].forEach(btn => btn.classList.remove('active'));
        }
        
        btnNormal.addEventListener('click', () => {
            resetFontButtons();
            btnNormal.classList.add('active');
            body.classList.remove('accessibility-text-lg', 'accessibility-text-xl');
        });
        
        btnLarge.addEventListener('click', () => {
            resetFontButtons();
            btnLarge.classList.add('active');
            body.classList.add('accessibility-text-lg');
            body.classList.remove('accessibility-text-xl');
        });
        
        btnExLarge.addEventListener('click', () => {
            resetFontButtons();
            btnExLarge.classList.add('active');
            body.classList.remove('accessibility-text-lg');
            body.classList.add('accessibility-text-xl');
        });
        
        // Contrast toggle
        const btnContrast = document.getElementById('btnContrast');
        btnContrast.addEventListener('click', () => {
            btnContrast.classList.toggle('active');
            body.classList.toggle('accessibility-high-contrast');
        });
        
        // Grayscale toggle
        const btnGrayscale = document.getElementById('btnGrayscale');
        btnGrayscale.addEventListener('click', () => {
            btnGrayscale.classList.toggle('active');
            body.classList.toggle('accessibility-grayscale');
        });
        
        // Voice Reader (Text to Speech) using Web Speech API
        const btnStartVoice = document.getElementById('btnStartVoice');
        const btnStopVoice = document.getElementById('btnStopVoice');
        let voiceUtterance = null;
        
        btnStartVoice.addEventListener('click', () => {
            // Cancel active reading first
            window.speechSynthesis.cancel();
            
            // Gather printable text content
            let textToRead = "Anda sedang berada di halaman " + document.title + ". ";
            
            // Extract paragraphs and main titles
            const elements = document.querySelectorAll('h1, h2, h3, p');
            let contentText = "";
            let limit = 0;
            for (let el of elements) {
                if (el.closest('.accessibility-panel')) continue; // skip panel
                if (el.innerText.trim().length > 10) {
                    contentText += el.innerText.trim() + ". ";
                    limit++;
                }
                if (limit > 10) break; // read first 10 paragraphs/headings only to be clean
            }
            
            textToRead += contentText;
            
            if (textToRead.trim() !== "") {
                voiceUtterance = new SpeechSynthesisUtterance(textToRead);
                voiceUtterance.lang = 'id-ID'; // Indonesian accent
                voiceUtterance.rate = 1.0;
                
                btnStartVoice.classList.add('active');
                
                voiceUtterance.onend = () => {
                    btnStartVoice.classList.remove('active');
                };
                voiceUtterance.onerror = () => {
                    btnStartVoice.classList.remove('active');
                };
                
                window.speechSynthesis.speak(voiceUtterance);
            }
        });
        
        btnStopVoice.addEventListener('click', () => {
            window.speechSynthesis.cancel();
            btnStartVoice.classList.remove('active');
        });
    });
</script>

