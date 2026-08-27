<!-- ACCESSIBILITY TOOLKIT & DISABILITY-FRIENDLY WIDGET (AKIP KEMENHUB STANDAR SLIDE 41, 44, 72) -->
<div id="accessibilityWidgetWrapper">
    <!-- Floating Accessibility Button -->
    <button type="button" id="btnToggleAccessibility" class="accessibility-float-btn" onclick="toggleAccessibilityMenu()" title="Menu Aksesibilitas & Ramah Disabilitas (Alt+A)">
        <i class="fas fa-universal-access"></i>
        <span class="d-none d-md-inline ms-1 fw-bold" style="font-size: 11px;">Aksesibilitas</span>
    </button>

    <!-- Accessibility Panel Modal/Popup -->
    <div id="accessibilityPanel" class="accessibility-panel shadow-lg" style="display: none;">
        <div class="accessibility-panel-header">
            <div class="d-flex align-items-center gap-2">
                <div class="access-icon-badge">
                    <i class="fas fa-universal-access"></i>
                </div>
                <div>
                    <h6 class="m-0 fw-bold text-white" style="font-size: 13.5px;">Menu Aksesibilitas Disabilitas</h6>
                    <span class="text-white-50" style="font-size: 10.5px;">Standar Inklusivitas Kemenhub RI</span>
                </div>
            </div>
            <button type="button" class="btn-close-access" onclick="toggleAccessibilityMenu()" title="Tutup">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="accessibility-panel-body p-3">
            <div class="row g-2">
                <!-- 1. Text Size -->
                <div class="col-6">
                    <button type="button" class="access-tool-btn" onclick="adjustFontSize(1)">
                        <i class="fas fa-text-height text-primary mb-1"></i>
                        <span>Perbesar Teks (A+)</span>
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="access-tool-btn" onclick="adjustFontSize(-1)">
                        <i class="fas fa-compress-alt text-primary mb-1"></i>
                        <span>Perkecil Teks (A-)</span>
                    </button>
                </div>

                <!-- 2. High Contrast -->
                <div class="col-6">
                    <button type="button" class="access-tool-btn" id="btnContrast" onclick="toggleHighContrast()">
                        <i class="fas fa-adjust text-warning mb-1"></i>
                        <span>Kontras Tinggi</span>
                    </button>
                </div>

                <!-- 3. Monochrome / Invert -->
                <div class="col-6">
                    <button type="button" class="access-tool-btn" id="btnInvert" onclick="toggleInvertColors()">
                        <i class="fas fa-circle-half-stroke text-dark mb-1"></i>
                        <span>Mode Monokrom</span>
                    </button>
                </div>

                <!-- 4. Text Spacing -->
                <div class="col-6">
                    <button type="button" class="access-tool-btn" id="btnTextSpacing" onclick="toggleTextSpacing()">
                        <i class="fas fa-arrows-left-right text-info mb-1"></i>
                        <span>Spasi Teks Lebar</span>
                    </button>
                </div>

                <!-- 5. Highlight Links -->
                <div class="col-6">
                    <button type="button" class="access-tool-btn" id="btnHighlightLinks" onclick="toggleHighlightLinks()">
                        <i class="fas fa-link text-success mb-1"></i>
                        <span>Sorot Tautan Link</span>
                    </button>
                </div>

                <!-- 6. Text-to-Speech (Screen Reader Audio) -->
                <div class="col-12">
                    <button type="button" class="access-tool-btn w-100 flex-row justify-content-center gap-2" id="btnReadText" onclick="readSelectedOrPageText()">
                        <i class="fas fa-volume-high text-danger"></i>
                        <span>Baca Teks Halaman (Text-to-Speech)</span>
                    </button>
                </div>

                <!-- 7. Video Bahasa Isyarat Permohonan Informasi (Slide 44, 72) -->
                <div class="col-12">
                    <button type="button" class="access-tool-btn w-100 flex-row justify-content-center gap-2" style="background: #eef2ff; border-color: #c7d2fe;" onclick="openBisindoModal()">
                        <i class="fas fa-hands-asl-interpreting text-primary"></i>
                        <span class="text-primary fw-bold">Panduan Bahasa Isyarat (Bisindo)</span>
                    </button>
                </div>
            </div>

            <div class="pt-3 mt-2 border-top text-center">
                <button type="button" class="btn btn-sm btn-light w-100 rounded-pill text-muted fw-bold" onclick="resetAccessibilitySettings()" style="font-size: 11px;">
                    <i class="fas fa-rotate-left me-1"></i> Reset Pengaturan Aksesibilitas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIDEO PANDUAN BAHASA ISYARAT (AKIP SLIDE 44 & 72) -->
<div class="modal fade" id="bisindoModal" tabindex="-1" aria-hidden="true" style="z-index: 10060;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 overflow-hidden shadow-2xl">
            <div class="modal-header text-white p-3.5" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);">
                <div class="d-flex align-items-center gap-2.5">
                    <i class="fas fa-hands-asl-interpreting text-warning fs-5"></i>
                    <h5 class="modal-title fw-bold text-white fs-6 m-0">Panduan Pelayanan Informasi Publik (Bahasa Isyarat & Subtitle)</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-dark text-center">
                <div class="ratio ratio-16x9">
                    <iframe id="bisindoIframe" src="https://www.youtube-nocookie.com/embed/videoseries?list=PLBPSDM_PPID" title="Video Panduan Layanan Informasi Bahasa Isyarat" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer bg-light p-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span class="text-muted small" style="font-size: 11.5px;">
                    <i class="fas fa-check-circle text-success me-1"></i> Ramah Disabilitas Rungu & Wicara • PPID PKTJ Tegal
                </span>
                <button type="button" class="btn btn-sm btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup Video</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* FLOATING ACCESS BUTTON */
    .accessibility-float-btn {
        position: fixed;
        bottom: 85px;
        left: 20px;
        z-index: 99990;
        background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
        color: #ffffff;
        border: 2px solid #ffd166;
        border-radius: 9999px;
        padding: 10px 18px;
        font-size: 13px;
        display: flex;
        align-items: center;
        box-shadow: 0 8px 25px rgba(0, 43, 92, 0.35);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .accessibility-float-btn:hover {
        transform: scale(1.08) translateY(-2px);
        box-shadow: 0 12px 30px rgba(0, 43, 92, 0.45);
        background: linear-gradient(135deg, #001f42 0%, #003875 100%);
    }

    /* ACCESS PANEL */
    .accessibility-panel {
        position: fixed;
        bottom: 140px;
        left: 20px;
        width: 320px;
        max-width: 90vw;
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #cbd5e1;
        z-index: 99995;
        overflow: hidden;
        animation: panelFadeUp 0.3s ease;
    }

    @keyframes panelFadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .accessibility-panel-header {
        background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .access-icon-badge {
        width: 32px;
        height: 32px;
        background: #ffd166;
        color: #002b5c;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .btn-close-access {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-close-access:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .access-tool-btn {
        width: 100%;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 8px;
        font-size: 11px;
        font-weight: 700;
        color: #334155;
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .access-tool-btn:hover {
        background: #f0f7ff;
        border-color: #004a99;
        color: #004a99;
        transform: translateY(-2px);
    }

    .access-tool-btn.active {
        background: #002b5c;
        color: #ffffff;
        border-color: #002b5c;
    }

    .access-tool-btn.active i {
        color: #ffd166 !important;
    }

    /* HIGH CONTRAST & ACCESSIBILITY STYLES APPLIED TO BODY */
    body.access-high-contrast {
        background-color: #000000 !important;
        color: #ffffff !important;
    }
    body.access-high-contrast .content-card,
    body.access-high-contrast .card,
    body.access-high-contrast .info-item,
    body.access-high-contrast .regulasi-item-card {
        background-color: #121212 !important;
        color: #ffffff !important;
        border-color: #ffffff !important;
    }
    body.access-high-contrast a,
    body.access-high-contrast h1,
    body.access-high-contrast h2,
    body.access-high-contrast h3,
    body.access-high-contrast h4,
    body.access-high-contrast h5,
    body.access-high-contrast h6 {
        color: #ffd166 !important;
    }

    body.access-invert-colors {
        filter: invert(1) hue-rotate(180deg) !important;
    }
    body.access-invert-colors img,
    body.access-invert-colors iframe,
    body.access-invert-colors video {
        filter: invert(1) hue-rotate(180deg) !important;
    }

    body.access-wide-spacing {
        letter-spacing: 0.12em !important;
        word-spacing: 0.16em !important;
        line-height: 2 !important;
    }

    body.access-highlight-links a {
        background-color: #fef08a !important;
        color: #854d0e !important;
        text-decoration: underline !important;
        font-weight: 800 !important;
        padding: 1px 4px !important;
        border-radius: 4px !important;
    }
</style>

<script>
    let currentFontScale = 0;
    let isSpeaking = false;

    function toggleAccessibilityMenu() {
        const panel = document.getElementById('accessibilityPanel');
        if (panel) {
            panel.style.display = (panel.style.display === 'none' || panel.style.display === '') ? 'block' : 'none';
        }
    }

    function adjustFontSize(delta) {
        currentFontScale = Math.max(-2, Math.min(4, currentFontScale + delta));
        const root = document.documentElement;
        if (currentFontScale === 0) {
            root.style.fontSize = '';
        } else {
            root.style.fontSize = (100 + currentFontScale * 12) + '%';
        }
    }

    function toggleHighContrast() {
        document.body.classList.toggle('access-high-contrast');
        document.getElementById('btnContrast')?.classList.toggle('active');
    }

    function toggleInvertColors() {
        document.body.classList.toggle('access-invert-colors');
        document.getElementById('btnInvert')?.classList.toggle('active');
    }

    function toggleTextSpacing() {
        document.body.classList.toggle('access-wide-spacing');
        document.getElementById('btnTextSpacing')?.classList.toggle('active');
    }

    function toggleHighlightLinks() {
        document.body.classList.toggle('access-highlight-links');
        document.getElementById('btnHighlightLinks')?.classList.toggle('active');
    }

    function readSelectedOrPageText() {
        if (!('speechSynthesis' in window)) {
            alert('Fitur Text-to-Speech tidak didukung di browser ini.');
            return;
        }

        if (isSpeaking) {
            window.speechSynthesis.cancel();
            isSpeaking = false;
            document.getElementById('btnReadText')?.classList.remove('active');
            return;
        }

        let textToRead = window.getSelection().toString().trim();
        if (!textToRead) {
            // Read main content text
            const mainContent = document.querySelector('.content-card') || document.querySelector('.page-container') || document.body;
            textToRead = mainContent.innerText.substring(0, 800); // Read up to 800 chars
        }

        if (!textToRead) {
            alert('Tidak ada teks untuk dibaca.');
            return;
        }

        const utterance = new SpeechSynthesisUtterance(textToRead);
        utterance.lang = 'id-ID';
        utterance.rate = 0.95;
        
        utterance.onend = function() {
            isSpeaking = false;
            document.getElementById('btnReadText')?.classList.remove('active');
        };

        window.speechSynthesis.speak(utterance);
        isSpeaking = true;
        document.getElementById('btnReadText')?.classList.add('active');
    }

    function openBisindoModal() {
        const modalElem = document.getElementById('bisindoModal');
        if (modalElem && typeof bootstrap !== 'undefined') {
            const modal = bootstrap.Modal.getOrCreateInstance(modalElem);
            modal.show();
        }
    }

    function resetAccessibilitySettings() {
        document.documentElement.style.fontSize = '';
        currentFontScale = 0;
        document.body.classList.remove('access-high-contrast', 'access-invert-colors', 'access-wide-spacing', 'access-highlight-links');
        document.querySelectorAll('.access-tool-btn').forEach(btn => btn.classList.remove('active'));
        if (window.speechSynthesis) window.speechSynthesis.cancel();
        isSpeaking = false;
    }

    // Keyboard shortcut: Alt + A to toggle
    document.addEventListener('keydown', function(e) {
        if (e.altKey && (e.key === 'a' || e.key === 'A')) {
            toggleAccessibilityMenu();
        }
    });
</script>
