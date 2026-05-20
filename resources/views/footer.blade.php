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

@if($settings['premium_view_enabled'] ?? false)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. HANDLE PREMIUM BLUR (MANUAL & AUTOMATIC)
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

        // 2. HANDLE GOOGLE DRIVE EMBEDS (CONVERT VIEW TO PREVIEW)
        document.querySelectorAll('iframe').forEach(iframe => {
            let src = iframe.getAttribute('src');
            if (src && src.includes('drive.google.com')) {
                // Convert /view?usp=sharing to /preview
                if (src.includes('/view')) {
                    src = src.replace(/\/view.*/, '/preview');
                    iframe.setAttribute('src', src);
                }
                
                // Add professional styling to the iframe
                iframe.style.width = '100%';
                iframe.style.minHeight = '500px';
                iframe.style.borderRadius = '12px';
                iframe.style.border = '1px solid #e2e8f0';
                iframe.style.boxShadow = '0 10px 25px rgba(0,0,0,0.05)';
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
                        const embedUrl = `${baseUrl}?file=${encodeURIComponent(href)}&title=${encodeURIComponent(link.innerText)}&is_blurred=1`;
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
@endif
