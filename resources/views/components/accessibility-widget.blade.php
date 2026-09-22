<!-- ==========================================================================
     MENU AKSESIBILITAS & FITUR DISABILITAS PPID PKTJ
     Sesuai Standar AccessiYes (CookieYes) & UU No. 8/2016 tentang Penyandang Disabilitas
     Fitur: Profil Aksesibilitas, Penyesuaian Konten, Warna, Navigasi, Screen Reader (TTS)
     ========================================================================== -->

<div id="accessWidgetContainer">

    <!-- FLOATING ACCESSIBILITY TRIGGER BUTTON (DOKED DI TEPI KANAN) -->
    <div class="access-floating-trigger-wrap" id="accessFloatingTrigger">
        <button type="button" id="btnAccessDrawerTrigger" class="access-trigger-btn" onclick="toggleAccessDrawer()" title="Menu Aksesibilitas & Pembaca Suara (Alt + A)" aria-label="Buka Menu Aksesibilitas">
            <i class="fas fa-universal-access"></i>
        </button>
    </div>

    <!-- BACKDROP BLUR OVERLAY -->
    <div id="accessBackdrop" class="access-backdrop-overlay" onclick="toggleAccessDrawer()"></div>

    <!-- ACCESSIBILITY SLIDE DRAWER (CANVAS PUTIH-BIRU SESUAI GAMBAR) -->
    <aside id="accessDrawer" class="access-drawer" aria-hidden="true" role="dialog" aria-label="Menu Aksesibilitas">
        
        <!-- DRAWER HEADER (BIRU CERAH SESUAI GAMBAR) -->
        <div class="access-drawer-header">
            <div class="d-flex align-items-center gap-2.5">
                <i class="fas fa-universal-access text-white fs-4"></i>
                <h5 class="access-header-title mb-0">Menu Aksesibilitas</h5>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="access-hdr-icon-btn" onclick="resetAllAccessibilitySettings()" title="Atur Ulang Pengaturan" aria-label="Atur Ulang">
                    <i class="fas fa-rotate-left"></i>
                </button>
                <button type="button" class="access-hdr-icon-btn" onclick="toggleAccessDrawer()" title="Tutup Menu" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- DRAWER SCROLLABLE BODY -->
        <div class="access-drawer-body">

            <!-- 1. DROPDOWN BAHASA (LANGUAGE SELECTOR) -->
            <div class="access-accordion-box mb-2.5">
                <button type="button" class="access-accordion-btn" onclick="toggleAccessAccordion('accLanguage')" aria-expanded="false" id="btnAccLanguage">
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="access-lang-badge" id="currentLangBadge">ID</span>
                        <span class="access-accordion-label" id="currentLangLabel">Bahasa Indonesia (Indonesian)</span>
                    </div>
                    <i class="fas fa-chevron-right access-chevron" id="iconAccLanguage"></i>
                </button>
                <div class="access-accordion-collapse d-none" id="accLanguage">
                    <div class="p-3 border-top bg-white">
                        <div class="access-search-wrap mb-2.5">
                            <i class="fas fa-search access-search-icon"></i>
                            <input type="text" id="langSearchInput" class="access-search-input" placeholder="Search languages..." onkeyup="filterAccessLanguages()">
                        </div>
                        <div class="access-lang-list" id="accessLangList">
                            <button type="button" class="access-lang-opt active" onclick="selectAccessLanguage('id', 'ID', 'Bahasa Indonesia (Indonesian)')">
                                <span class="badge-mini">ID</span> Bahasa Indonesia (Indonesian)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('en', 'EN', 'English')">
                                <span class="badge-mini">EN</span> English
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('ar', 'AR', 'العربية (Arabic)')">
                                <span class="badge-mini">AR</span> العربية (Arabic)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('zh-CN', 'ZH', '中文 (Chinese)')">
                                <span class="badge-mini">ZH</span> 中文 (Chinese Simplified)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('ja', 'JA', '日本語 (Japanese)')">
                                <span class="badge-mini">JA</span> 日本語 (Japanese)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('fr', 'FR', 'Français (French)')">
                                <span class="badge-mini">FR</span> Français (French)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('de', 'DE', 'Deutsch (German)')">
                                <span class="badge-mini">DE</span> Deutsch (German)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('es', 'ES', 'Español (Spanish)')">
                                <span class="badge-mini">ES</span> Español (Spanish)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('nl', 'NL', 'Nederlands (Dutch)')">
                                <span class="badge-mini">NL</span> Nederlands (Dutch)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('jw', 'JV', 'Basa Jawa (Javanese)')">
                                <span class="badge-mini">JV</span> Basa Jawa (Javanese)
                            </button>
                            <button type="button" class="access-lang-opt" onclick="selectAccessLanguage('su', 'SU', 'Basa Sunda (Sundanese)')">
                                <span class="badge-mini">SU</span> Basa Sunda (Sundanese)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. PROFIL AKSESIBILITAS ACCORDION -->
            <div class="access-accordion-box mb-3">
                <button type="button" class="access-accordion-btn" onclick="toggleAccessAccordion('accProfiles')" aria-expanded="false" id="btnAccProfiles">
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="access-lang-badge bg-blue-light text-primary">
                            <i class="fas fa-universal-access" style="font-size: 13px;"></i>
                        </span>
                        <span class="access-accordion-label">Profil Aksesibilitas</span>
                    </div>
                    <i class="fas fa-chevron-right access-chevron" id="iconAccProfiles"></i>
                </button>
                <div class="access-accordion-collapse d-none" id="accProfiles">
                    <div class="p-3 border-top bg-white">
                        <div class="row g-2">
                            <div class="col-6">
                                <button type="button" id="profEpilepsy" class="access-profile-card" onclick="toggleProfile('epilepsy')">
                                    <i class="fas fa-shield-halved access-prof-icon"></i>
                                    <span class="access-prof-title">Mode Aman Epilepsi</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" id="profMotor" class="access-profile-card" onclick="toggleProfile('motor')">
                                    <i class="fas fa-head-side-virus access-prof-icon"></i>
                                    <span class="access-prof-title">Aman untuk Epilepsi</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" id="profAdhd" class="access-profile-card" onclick="toggleProfile('adhd')">
                                    <i class="fas fa-bullseye access-prof-icon"></i>
                                    <span class="access-prof-title">ADHD</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" id="profLowVision" class="access-profile-card" onclick="toggleProfile('lowVision')">
                                    <i class="fas fa-eye-low-vision access-prof-icon"></i>
                                    <span class="access-prof-title">Penglihatan Rendah</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. PENYESUAIAN KONTEN -->
            <div class="access-section mb-3.5">
                <h6 class="access-sec-heading">Penyesuaian Konten</h6>
                
                <div class="access-grid-3">
                    <!-- SESUAIKAN UKURAN FONT (SPAN 2 KOLOM) -->
                    <div class="access-font-card" id="cardFontSize">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-black fs-5" style="font-family: serif;">TT</span>
                            <span class="access-card-label text-start">Sesuaikan Ukuran Font</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-2 mt-auto">
                            <button type="button" class="access-font-btn" onclick="adjustAccessFontSize(-1)" title="Perkecil Font" aria-label="Perkecil Font">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="access-font-pill" id="fontSizeDisplay">100%</span>
                            <button type="button" class="access-font-btn" onclick="adjustAccessFontSize(1)" title="Perbesar Font" aria-label="Perbesar Font">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SOROT JUDUL -->
                    <button type="button" id="btnHighlightHeadings" class="access-tool-card" onclick="toggleAccessFeature('highlightHeadings')">
                        <div class="access-card-icon">
                            <span class="access-box-icon">T</span>
                        </div>
                        <span class="access-card-label">Sorot Judul</span>
                    </button>

                    <!-- SOROT TAUTAN -->
                    <button type="button" id="btnHighlightLinks" class="access-tool-card" onclick="toggleAccessFeature('highlightLinks')">
                        <div class="access-card-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <span class="access-card-label">Sorot Tautan</span>
                    </button>

                    <!-- FONT DISLEKSIA -->
                    <button type="button" id="btnDyslexiaFont" class="access-tool-card" onclick="toggleAccessFeature('dyslexiaFont')">
                        <div class="access-card-icon">
                            <span class="fw-black fs-4" style="font-family: 'Comic Sans MS', sans-serif;">Df</span>
                        </div>
                        <span class="access-card-label">Font Disleksia</span>
                    </button>

                    <!-- JARAK HURUF -->
                    <button type="button" id="btnLetterSpacing" class="access-tool-card" onclick="toggleAccessFeature('letterSpacing')">
                        <div class="access-card-icon">
                            <div class="d-flex flex-column align-items-center" style="line-height: 1;">
                                <span style="font-size: 11px; font-weight: 800;">AV</span>
                                <i class="fas fa-arrows-left-right" style="font-size: 10px;"></i>
                            </div>
                        </div>
                        <span class="access-card-label">Jarak Huruf</span>
                    </button>

                    <!-- TINGGI BARIS -->
                    <button type="button" id="btnLineHeight" class="access-tool-card" onclick="toggleAccessFeature('lineHeight')">
                        <div class="access-card-icon">
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-arrows-up-down" style="font-size: 13px;"></i>
                                <i class="fas fa-bars" style="font-size: 13px;"></i>
                            </div>
                        </div>
                        <span class="access-card-label">Tinggi Baris</span>
                    </button>

                    <!-- KETEBALAN FONT -->
                    <button type="button" id="btnFontWeight" class="access-tool-card" onclick="toggleAccessFeature('fontWeight')">
                        <div class="access-card-icon">
                            <div class="d-flex flex-column align-items-center" style="line-height: 1;">
                                <i class="fas fa-arrows-up-down" style="font-size: 9px;"></i>
                                <span style="font-size: 14px; font-weight: 900;">T</span>
                            </div>
                        </div>
                        <span class="access-card-label">Ketebalan Font</span>
                    </button>

                    <!-- PERATAAN TEKS -->
                    <button type="button" id="btnTextAlign" class="access-tool-card" onclick="cycleTextAlign()">
                        <div class="access-card-icon">
                            <i class="fas fa-align-left" id="iconTextAlign"></i>
                        </div>
                        <span class="access-card-label" id="labelTextAlign">Perataan Teks</span>
                    </button>
                </div>
            </div>

            <!-- 4. PENYESUAIAN WARNA -->
            <div class="access-section mb-3.5">
                <h6 class="access-sec-heading">Penyesuaian Warna</h6>
                
                <div class="access-grid-3">
                    <!-- KONTRAS GELAP -->
                    <button type="button" id="btnDarkContrast" class="access-tool-card" onclick="setAccessContrast('dark')">
                        <div class="access-card-icon">
                            <i class="fas fa-moon"></i>
                        </div>
                        <span class="access-card-label">Kontras Gelap</span>
                    </button>

                    <!-- KONTRAS TERANG -->
                    <button type="button" id="btnLightContrast" class="access-tool-card" onclick="setAccessContrast('light')">
                        <div class="access-card-icon">
                            <i class="fas fa-sun"></i>
                        </div>
                        <span class="access-card-label">Kontras Terang</span>
                    </button>

                    <!-- KONTRAS TINGGI -->
                    <button type="button" id="btnHighContrast" class="access-tool-card" onclick="setAccessContrast('high')">
                        <div class="access-card-icon">
                            <i class="fas fa-circle-half-stroke"></i>
                        </div>
                        <span class="access-card-label">Kontras Tinggi</span>
                    </button>

                    <!-- SATURASI TINGGI -->
                    <button type="button" id="btnSatHigh" class="access-tool-card" onclick="setAccessSaturation('high')">
                        <div class="access-card-icon">
                            <i class="fas fa-droplet" style="color: #0284c7;"></i>
                        </div>
                        <span class="access-card-label">Saturasi Tinggi</span>
                    </button>

                    <!-- SATURASI RENDAH -->
                    <button type="button" id="btnSatLow" class="access-tool-card" onclick="setAccessSaturation('low')">
                        <div class="access-card-icon">
                            <i class="far fa-droplet"></i>
                        </div>
                        <span class="access-card-label">Saturasi Rendah</span>
                    </button>

                    <!-- MONOKROM -->
                    <button type="button" id="btnMonochrome" class="access-tool-card" onclick="setAccessSaturation('mono')">
                        <div class="access-card-icon">
                            <i class="fas fa-tint-slash"></i>
                        </div>
                        <span class="access-card-label">Monokrom</span>
                    </button>
                </div>
            </div>

            <!-- 5. PENYESUAIAN NAVIGASI -->
            <div class="access-section mb-3.5">
                <h6 class="access-sec-heading">Penyesuaian Navigasi</h6>
                
                <div class="access-grid-3">
                    <!-- BISUKAN SUARA -->
                    <button type="button" id="btnMuteAudio" class="access-tool-card" onclick="toggleAccessFeature('muteAudio')">
                        <div class="access-card-icon">
                            <i class="fas fa-volume-xmark" id="iconMute"></i>
                        </div>
                        <span class="access-card-label">Bisukan suara</span>
                    </button>

                    <!-- BACA HALAMAN (TTS SCREEN READER) -->
                    <button type="button" id="btnReadPage" class="access-tool-card" onclick="toggleScreenReader()">
                        <div class="access-card-icon">
                            <i class="fas fa-file-audio text-primary"></i>
                        </div>
                        <span class="access-card-label">Baca halaman</span>
                    </button>

                    <!-- PANDUAN MEMBACA -->
                    <button type="button" id="btnReadingGuide" class="access-tool-card" onclick="toggleAccessFeature('readingGuide')">
                        <div class="access-card-icon">
                            <i class="fas fa-ruler-horizontal"></i>
                        </div>
                        <span class="access-card-label">Panduan Membaca</span>
                    </button>

                    <!-- HENTIKAN ANIMASI -->
                    <button type="button" id="btnStopAnimation" class="access-tool-card" onclick="toggleAccessFeature('stopAnimation')">
                        <div class="access-card-icon">
                            <i class="fas fa-circle-pause"></i>
                        </div>
                        <span class="access-card-label">Hentikan Animasi</span>
                    </button>

                    <!-- KURSOR BESAR -->
                    <button type="button" id="btnLargeCursor" class="access-tool-card" onclick="toggleAccessFeature('largeCursor')">
                        <div class="access-card-icon">
                            <i class="fas fa-arrow-pointer"></i>
                        </div>
                        <span class="access-card-label">Kursor Besar</span>
                    </button>
                </div>
            </div>

            <!-- TOMBOL ATUR ULANG PENGATURAN (BIRU SOLID SESUAI GAMBAR) -->
            <div class="pt-2 pb-2">
                <button type="button" class="btn-reset-access" onclick="resetAllAccessibilitySettings()">
                    <i class="fas fa-rotate-left"></i>
                    <span>Atur Ulang Pengaturan</span>
                </button>
            </div>

            <!-- LINK PERNYATAAN AKSESIBILITAS -->
            <div class="text-center pb-3">
                <a href="javascript:void(0)" onclick="openAccessStatementModal()" class="access-statement-link">
                    Pernyataan Aksesibilitas
                </a>
            </div>

            <!-- BRANDING FOOTER RAMAH DISABILITAS -->
            <div class="access-footer-badge">
                <i class="fas fa-universal-access text-primary me-1.5"></i> 
                <span>Portal Inklusif & Ramah Disabilitas PPID PKTJ</span>
            </div>

        </div>

    </aside>

</div>

<!-- READING RULER BAR -->
<div id="accessReadingRuler" class="access-reading-ruler-bar d-none"></div>

<!-- ADHD FOCUS MASK OVERLAY -->
<div id="accessAdhdMaskTop" class="access-adhd-mask d-none"></div>
<div id="accessAdhdMaskBottom" class="access-adhd-mask d-none"></div>

<!-- FLOATING SCREEN READER AUDIO BAR -->
<div id="accessTtsPlayerBar" class="access-tts-bar d-none" role="region" aria-label="Kontrol Pembaca Suara">
    <div class="access-tts-inner">
        <div class="access-tts-wave" id="accessTtsWave">
            <span class="b-1"></span><span class="b-2"></span><span class="b-3"></span><span class="b-4"></span>
        </div>
        <div class="access-tts-info">
            <div class="access-tts-status">
                <i class="fas fa-headphones text-warning me-1"></i>
                <span id="accessTtsModeTitle">Membacakan Halaman Otomatis</span>
                <span class="badge bg-warning text-dark ms-2" id="accessTtsProgressBadge">0 / 0</span>
            </div>
            <div id="accessTtsSnippet" class="access-tts-snippet">Memulai pembacaan suara...</div>
        </div>
        <div class="access-tts-ctrls">
            <button type="button" class="btn-tts-ctrl" onclick="prevTtsItem()" title="Paragraf Sebelumnya"><i class="fas fa-step-backward"></i></button>
            <button type="button" class="btn-tts-ctrl btn-tts-playpause" id="btnTtsPlayPause" onclick="toggleTtsPause()"><i class="fas fa-pause" id="iconTtsPlayPause"></i></button>
            <button type="button" class="btn-tts-ctrl" onclick="nextTtsItem()" title="Paragraf Selanjutnya"><i class="fas fa-step-forward"></i></button>
            <button type="button" class="btn-tts-ctrl btn-tts-stop" onclick="stopScreenReader()" title="Hentikan Suara"><i class="fas fa-stop"></i></button>
        </div>
    </div>
</div>

<!-- MODAL PERNYATAAN AKSESIBILITAS -->
<div class="modal fade" id="accessStatementModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white text-primary rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="fas fa-universal-access fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-black mb-0">Pernyataan Komitmen Aksesibilitas</h5>
                        <p class="text-white-50 mb-0 small">PPID Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5" style="max-height: 70vh; overflow-y: auto;">
                <h6 class="fw-bold text-primary text-uppercase tracking-wider mb-2">1. Landasan Regulasi & Keadilan Akses</h6>
                <p class="text-muted leading-relaxed mb-4">
                    Sesuai dengan <strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik, <strong>Undang-Undang Nomor 8 Tahun 2016</strong> tentang Penyandang Disabilitas, serta <strong>Peraturan Komisi Informasi (Perki) Nomor 1 Tahun 2021</strong>, PPID PKTJ berkomitmen memastikan portal informasi ini dapat diakses secara merata dan tanpa diskriminasi oleh seluruh masyarakat, termasuk penyandang disabilitas sensorik (netra/rungu), disabilitas fisik, disabilitas intelektual, maupun disabilitas kognitif/ADHD.
                </p>

                <h6 class="fw-bold text-primary text-uppercase tracking-wider mb-2">2. Standar Kepatuhan Web Content Accessibility Guidelines (WCAG)</h6>
                <p class="text-muted leading-relaxed mb-4">
                    Website PPID PKTJ dikembangkan dengan mengacu pada standar <strong>WCAG 2.1 Tingkat AA</strong> yang mencakup:
                </p>
                <ul class="text-muted mb-4 space-y-2">
                    <li><strong>Perceivable (Dapat Dipersepsi):</strong> Penyediaan pembaca suara (Text-to-Speech), kontras warna tinggi, pembesaran teks fleksibel, serta dokumen alternatif format Braille dan Large Print.</li>
                    <li><strong>Operable (Dapat Dioperasikan):</strong> Navigasi keyboard menyeluruh (<kbd>Alt + A</kbd> untuk menu aksesibilitas, <kbd>Spasi</kbd> untuk jeda suara), kursor ukuran besar, serta penonaktifan animasi pemicu epilepsi.</li>
                    <li><strong>Understandable (Dapat Dipahami):</strong> Font khusus disleksia (OpenDyslexic / Comic Sans), jarak huruf & baris proporsional, serta pemandu baca fokus.</li>
                    <li><strong>Robust (Kuat):</strong> Kompatibel dengan ragam peramban modern (Chrome, Edge, Safari, Firefox) dan perangkat bantu pihak ketiga.</li>
                </ul>

                <h6 class="fw-bold text-primary text-uppercase tracking-wider mb-2">3. Pendampingan Khusus & Layanan Langsung</h6>
                <p class="text-muted leading-relaxed mb-3">
                    Bagi pemohon informasi dengan kebutuhan khusus yang memerlukan pendampingan lisan, formulir huruf Braille fisik, atau penerjemah bahasa isyarat (Bisindo), silakan menghubungi Petugas PPID PKTJ melalui:
                </p>
                <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <div class="fw-bold text-dark">Meja Layanan Khusus Disabilitas PPID PKTJ</div>
                        <small class="text-muted">Jl. Perintis Kemerdekaan No. 17, Kota Tegal, Jawa Tengah</small>
                    </div>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 py-1.5 fw-bold">
                        <i class="fab fa-whatsapp me-1"></i> Kontak Pendamping
                    </a>
                </div>
            </div>
            <div class="modal-footer bg-light p-3">
                <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- HIDDEN GOOGLE TRANSLATE ELEMENT -->
<div id="google_translate_element" style="display:none;"></div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- STYLESHEET ELEGAN SESUAI GAMBAR ACCESSIYES COOKIEYES -->
<style>
    /* -------------------------------------------------------------
       1. TRIGGER BUTTON (FLOATING BULAT BIRU ELEGAN)
       ------------------------------------------------------------- */
    .access-floating-trigger-wrap {
        position: fixed;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 99990;
    }
    .access-trigger-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #1a62d6;
        color: #ffffff;
        border: 2.5px solid #ffffff;
        box-shadow: 0 4px 18px rgba(26, 98, 214, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 22px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        outline: none;
        padding: 0;
    }
    .access-trigger-btn:hover {
        transform: scale(1.12);
        background: #0f4db0;
        box-shadow: 0 8px 25px rgba(26, 98, 214, 0.6);
    }
    @media (max-width: 768px) {
        .access-floating-trigger-wrap {
            right: 14px;
            top: auto;
            bottom: 24px;
            transform: none;
        }
        .access-trigger-btn {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }
    }

    /* -------------------------------------------------------------
       2. BACKDROP OVERLAY
       ------------------------------------------------------------- */
    .access-backdrop-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(4px);
        z-index: 99995;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .access-backdrop-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* -------------------------------------------------------------
       3. SLIDE DRAWER (CANVAS PUTIH-ABU PERSIS GAMBAR)
       ------------------------------------------------------------- */
    .access-drawer {
        position: fixed;
        top: 0;
        right: -450px;
        width: 410px;
        max-width: 95vw;
        height: 100vh;
        background: #f4f6f8;
        box-shadow: -10px 0 40px rgba(0, 0, 0, 0.2);
        z-index: 100000;
        display: flex;
        flex-direction: column;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .access-drawer.active {
        right: 0;
    }

    /* HEADER */
    .access-drawer-header {
        background: #1a62d6;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #ffffff;
    }
    .access-header-title {
        font-size: 17px;
        font-weight: 700;
        letter-spacing: 0.2px;
        color: #ffffff;
    }
    .access-hdr-icon-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(0, 35, 90, 0.35);
        border: none;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s ease;
    }
    .access-hdr-icon-btn:hover {
        background: rgba(0, 35, 90, 0.6);
        transform: scale(1.08);
    }

    /* BODY */
    .access-drawer-body {
        padding: 18px 16px;
        overflow-y: auto;
        flex: 1;
    }
    .access-drawer-body::-webkit-scrollbar {
        width: 6px;
    }
    .access-drawer-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* ACCORDION BOXES */
    .access-accordion-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .access-accordion-btn {
        width: 100%;
        padding: 13px 16px;
        background: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .access-accordion-btn:hover {
        background: #f8fafc;
    }
    .access-lang-badge {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #334155;
        font-weight: 700;
        font-size: 12.5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .access-accordion-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
    }
    .access-chevron {
        font-size: 13px;
        color: #64748b;
        transition: transform 0.25s ease;
    }
    .access-chevron.rotate-down {
        transform: rotate(90deg);
    }

    /* SEARCH & LANGUAGE LIST */
    .access-search-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .access-search-icon {
        position: absolute;
        left: 12px;
        color: #94a3b8;
        font-size: 13px;
    }
    .access-search-input {
        width: 100%;
        padding: 9px 12px 9px 34px;
        border: 1.5px solid #1a62d6;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
    }
    .access-lang-list {
        max-height: 180px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .access-lang-opt {
        padding: 8px 10px;
        border: none;
        background: transparent;
        text-align: left;
        border-radius: 8px;
        font-size: 13px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .access-lang-opt:hover, .access-lang-opt.active {
        background: #eff6ff;
        color: #1a62d6;
        font-weight: 600;
    }
    .access-lang-opt .badge-mini {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* PROFILE CARDS */
    .access-profile-card {
        width: 100%;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: left;
    }
    .access-profile-card:hover {
        border-color: #1a62d6;
        background: #f8fafc;
    }
    .access-profile-card.active {
        border-color: #1a62d6;
        background: #eff6ff;
        box-shadow: 0 0 0 2px rgba(26, 98, 214, 0.2);
    }
    .access-prof-icon {
        font-size: 20px;
        color: #1e293b;
    }
    .access-profile-card.active .access-prof-icon,
    .access-profile-card.active .access-prof-title {
        color: #1a62d6;
    }
    .access-prof-title {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.3;
    }

    /* SECTION HEADING */
    .access-sec-heading {
        font-size: 13px;
        font-weight: 800;
        color: #334155;
        margin-bottom: 10px;
        letter-spacing: -0.2px;
    }

    /* 3-COLUMNS GRID */
    .access-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
    }

    /* FONT CARD (SPAN 2 COLUMNS) */
    .access-font-card {
        grid-column: span 2;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 12px 14px 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 84px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .access-font-card.active {
        border-color: #1a62d6;
        box-shadow: 0 0 0 2px rgba(26, 98, 214, 0.2);
    }
    .access-font-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #1a62d6;
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .access-font-btn:hover {
        background: #0f4db0;
        transform: scale(1.06);
    }
    .access-font-pill {
        background: #e2e8f0;
        color: #1a62d6;
        font-weight: 800;
        font-size: 12.5px;
        padding: 5px 16px;
        border-radius: 20px;
        display: inline-block;
    }

    /* SQUARE TOOL CARDS (PERSIS GAMBAR) */
    .access-tool-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 12px 6px 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        min-height: 84px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .access-tool-card:hover {
        border-color: #1a62d6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 98, 214, 0.08);
    }
    .access-tool-card.active {
        border: 2px solid #1a62d6 !important;
        background: #eff6ff !important;
        box-shadow: 0 0 0 2px rgba(26, 98, 214, 0.2) !important;
    }
    .access-tool-card.active .access-card-icon,
    .access-tool-card.active .access-card-label,
    .access-tool-card.active .access-box-icon {
        color: #1a62d6 !important;
        border-color: #1a62d6 !important;
    }
    .access-card-icon {
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e293b;
        font-size: 20px;
        margin-bottom: 6px;
    }
    .access-card-label {
        font-size: 11px;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.25;
    }
    .access-box-icon {
        border: 2px solid #1e293b;
        border-radius: 6px;
        padding: 0 6px;
        font-size: 12px;
        font-weight: 800;
        display: inline-block;
        line-height: 1.4;
    }

    /* RESET BUTTON (BIRU SOLID) */
    .btn-reset-access {
        width: 100%;
        background: #1a62d6;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 13px 20px;
        font-size: 13.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 14px rgba(26, 98, 214, 0.3);
    }
    .btn-reset-access:hover {
        background: #0f4db0;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(26, 98, 214, 0.4);
    }

    /* FOOTER LINK */
    .access-statement-link {
        font-size: 12px;
        color: #64748b;
        text-decoration: underline;
        font-weight: 600;
        transition: color 0.2s;
    }
    .access-statement-link:hover {
        color: #1a62d6;
    }
    .access-footer-badge {
        text-align: center;
        font-size: 10.5px;
        font-weight: 700;
        color: #94a3b8;
        padding-top: 4px;
    }

    /* -------------------------------------------------------------
       4. READING RULER & ADHD FOCUS MASK
       ------------------------------------------------------------- */
    .access-reading-ruler-bar {
        position: fixed;
        left: 0;
        width: 100%;
        height: 36px;
        background: rgba(254, 240, 138, 0.35);
        border-top: 2px solid #eab308;
        border-bottom: 2px solid #eab308;
        box-shadow: 0 0 15px rgba(234, 179, 8, 0.4);
        pointer-events: none;
        z-index: 999999;
    }
    .access-adhd-mask {
        position: fixed;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.65);
        pointer-events: none;
        z-index: 999998;
    }

    /* -------------------------------------------------------------
       5. LARGE CURSOR
       ------------------------------------------------------------- */
    body.access-cursor-large,
    body.access-cursor-large * {
        cursor: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' stroke='%23fff' stroke-width='1.5' d='M4.5 2.5l14 14.5-5.5.5 3.5 7-3.5 1.5-3.5-7-4 4.5z'/%3E%3C/svg%3E"), auto !important;
    }

    /* -------------------------------------------------------------
       6. GLOBAL CONTENT MODIFIERS
       ------------------------------------------------------------- */
    /* Highlight Headings */
    body.access-highlight-headings h1,
    body.access-highlight-headings h2,
    body.access-highlight-headings h3,
    body.access-highlight-headings h4,
    body.access-highlight-headings h5,
    body.access-highlight-headings h6 {
        outline: 2.5px solid #1a62d6 !important;
        outline-offset: 3px !important;
        background-color: rgba(26, 98, 214, 0.08) !important;
        border-radius: 6px !important;
    }
    /* Highlight Links */
    body.access-highlight-links a {
        background-color: #fef08a !important;
        color: #000000 !important;
        outline: 2px solid #eab308 !important;
        text-decoration: underline !important;
        font-weight: 700 !important;
    }
    /* Dyslexia Font */
    body.access-font-dyslexia,
    body.access-font-dyslexia * {
        font-family: 'Comic Sans MS', 'Verdana', sans-serif !important;
        letter-spacing: 0.8px !important;
    }
    /* Letter Spacing */
    body.access-spacing-wide,
    body.access-spacing-wide * {
        letter-spacing: 2px !important;
        word-spacing: 4px !important;
    }
    /* Line Height */
    body.access-line-height-tall,
    body.access-line-height-tall * {
        line-height: 2.2 !important;
    }
    /* Bold Font */
    body.access-font-bold,
    body.access-font-bold * {
        font-weight: 700 !important;
    }
    /* Text Alignments */
    body.access-align-left, body.access-align-left * { text-align: left !important; }
    body.access-align-center, body.access-align-center * { text-align: center !important; }
    body.access-align-right, body.access-align-right * { text-align: right !important; }
    body.access-align-justify, body.access-align-justify * { text-align: justify !important; }

    /* Stop Animations */
    body.access-stop-animations *,
    body.access-stop-animations *::before,
    body.access-stop-animations *::after {
        animation: none !important;
        animation-play-state: paused !important;
        transition: none !important;
        scroll-behavior: auto !important;
    }

    /* -------------------------------------------------------------
       7. COLOR CONTRAST MODIFIERS
       ------------------------------------------------------------- */
    /* Dark Contrast */
    body.access-contrast-dark {
        background-color: #121212 !important;
        color: #f8fafc !important;
    }
    body.access-contrast-dark .navbar,
    body.access-contrast-dark .card,
    body.access-contrast-dark .table,
    body.access-contrast-dark footer,
    body.access-contrast-dark header,
    body.access-contrast-dark div:not(#accessDrawer):not(#accessDrawer *) {
        background-color: #1e1e1e !important;
        color: #f8fafc !important;
        border-color: #334155 !important;
    }
    body.access-contrast-dark a {
        color: #93c5fd !important;
    }

    /* Light Contrast */
    body.access-contrast-light {
        background-color: #ffffff !important;
        color: #000000 !important;
    }
    body.access-contrast-light div:not(#accessDrawer):not(#accessDrawer *),
    body.access-contrast-light .card,
    body.access-contrast-light .navbar {
        background-color: #ffffff !important;
        color: #000000 !important;
        border-color: #cbd5e1 !important;
    }

    /* High Contrast (Yellow on Black) */
    body.access-contrast-high {
        background-color: #000000 !important;
        color: #ffff00 !important;
    }
    body.access-contrast-high div:not(#accessDrawer):not(#accessDrawer *),
    body.access-contrast-high .navbar,
    body.access-contrast-high .card,
    body.access-contrast-high footer {
        background-color: #000000 !important;
        color: #ffff00 !important;
        border-color: #ffff00 !important;
        box-shadow: none !important;
    }
    body.access-contrast-high a {
        color: #00ffff !important;
        text-decoration: underline !important;
    }

    /* Saturation & Monochrome */
    body.access-sat-high { filter: saturate(200%) !important; }
    body.access-sat-low { filter: saturate(40%) !important; }
    body.access-monochrome { filter: grayscale(100%) !important; }

    /* -------------------------------------------------------------
       8. SCREEN READER (TTS) FLOATING BAR
       ------------------------------------------------------------- */
    .access-tts-bar {
        position: fixed;
        bottom: 25px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999999;
        max-width: 92vw;
        width: 600px;
        animation: slideUpTts 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes slideUpTts {
        from { opacity: 0; transform: translate(-50%, 30px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }
    .access-tts-inner {
        background: #002b5c;
        border: 2px solid #1a62d6;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
        border-radius: 50px;
        padding: 10px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: white;
    }
    .access-tts-wave {
        display: flex;
        align-items: center;
        gap: 3px;
        height: 20px;
    }
    .access-tts-wave span {
        width: 3.5px;
        height: 8px;
        background: #38bdf8;
        border-radius: 4px;
        animation: waveAnim 0.9s ease-in-out infinite alternate;
    }
    .access-tts-wave .b-1 { height: 16px; animation-delay: 0.1s; }
    .access-tts-wave .b-2 { height: 22px; animation-delay: 0.3s; }
    .access-tts-wave .b-3 { height: 12px; animation-delay: 0.2s; }
    .access-tts-wave .b-4 { height: 18px; animation-delay: 0.4s; }
    @keyframes waveAnim {
        0% { height: 6px; }
        100% { height: 20px; }
    }
    .access-tts-info {
        flex-grow: 1;
        min-width: 0;
    }
    .access-tts-status {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #facc15;
    }
    .access-tts-snippet {
        font-size: 12px;
        color: #e2e8f0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .access-tts-ctrls {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-tts-ctrl {
        border: none;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-tts-ctrl:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.08);
    }
    .btn-tts-playpause {
        background: #facc15;
        color: #002b5c;
        padding: 6px 14px;
    }
    .btn-tts-stop {
        background: #ef4444;
        color: white;
    }

    /* TTS Highlight in Page */
    .access-tts-active-highlight {
        background-color: rgba(250, 204, 21, 0.35) !important;
        outline: 3px solid #eab308 !important;
        outline-offset: 4px !important;
        border-radius: 6px !important;
    }
</style>

<!-- SCRIPTS LOGIKA AKSESIBILITAS -->
<script>
    let isAccessDrawerOpen = false;
    let accessFontScale = 100;
    let accessTextAlignIndex = 0;
    const textAlignStates = ['default', 'left', 'center', 'right', 'justify'];
    const textAlignLabels = ['Perataan Teks', 'Rata Kiri', 'Rata Tengah', 'Rata Kanan', 'Rata Kanan Kiri'];
    const textAlignIcons = ['fa-align-left', 'fa-align-left', 'fa-align-center', 'fa-align-right', 'fa-align-justify'];

    // State object for persistence
    let accessState = {
        fontScale: 100,
        highlightHeadings: false,
        highlightLinks: false,
        dyslexiaFont: false,
        letterSpacing: false,
        lineHeight: false,
        fontWeight: false,
        textAlign: 'default',
        contrast: 'default', // default, dark, light, high
        saturation: 'default', // default, high, low, mono
        muteAudio: false,
        readingGuide: false,
        stopAnimation: false,
        largeCursor: false,
        adhdMask: false,
        activeProfile: null,
        language: 'id'
    };

    function toggleAccessDrawer() {
        isAccessDrawerOpen = !isAccessDrawerOpen;
        const drawer = document.getElementById('accessDrawer');
        const backdrop = document.getElementById('accessBackdrop');

        if (isAccessDrawerOpen) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            drawer.setAttribute('aria-hidden', 'false');
        } else {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            drawer.setAttribute('aria-hidden', 'true');
        }
    }

    // Alias for backward compatibility
    window.toggleNeonAccessDrawer = toggleAccessDrawer;
    window.toggleTextToSpeech = toggleScreenReader;
    window.resetNeonAccessSettings = resetAllAccessibilitySettings;

    // Keyboard Shortcut: Alt + A (Toggle Menu), Alt + S (Bicara Langsung)
    document.addEventListener('keydown', function(e) {
        if (e.altKey && (e.key === 'a' || e.key === 'A')) {
            e.preventDefault();
            toggleAccessDrawer();
        } else if (e.altKey && (e.key === 's' || e.key === 'S')) {
            e.preventDefault();
            toggleScreenReader();
        }
    });

    // Accordion Toggle
    function toggleAccessAccordion(id) {
        const collapse = document.getElementById(id);
        const icon = document.getElementById('icon' + id.charAt(0).toUpperCase() + id.slice(1));
        if (!collapse) return;

        const isHidden = collapse.classList.contains('d-none');
        if (isHidden) {
            collapse.classList.remove('d-none');
            if (icon) icon.classList.add('rotate-down');
        } else {
            collapse.classList.add('d-none');
            if (icon) icon.classList.remove('rotate-down');
        }
    }

    // -------------------------------------------------------------
    // FONT RESIZING (- / 100% / +)
    // -------------------------------------------------------------
    function adjustAccessFontSize(delta) {
        accessFontScale += (delta * 10);
        if (accessFontScale < 80) accessFontScale = 80;
        if (accessFontScale > 160) accessFontScale = 160;

        document.documentElement.style.fontSize = accessFontScale + '%';
        const display = document.getElementById('fontSizeDisplay');
        if (display) display.textContent = accessFontScale + '%';

        const card = document.getElementById('cardFontSize');
        if (card) {
            if (accessFontScale !== 100) card.classList.add('active');
            else card.classList.remove('active');
        }

        accessState.fontScale = accessFontScale;
        saveAccessState();
    }

    // -------------------------------------------------------------
    // TOGGLE FEATURES (KONTEN & NAVIGASI)
    // -------------------------------------------------------------
    function toggleAccessFeature(featureName) {
        accessState[featureName] = !accessState[featureName];
        applyFeatureState(featureName, accessState[featureName]);
        saveAccessState();
    }

    function applyFeatureState(featureName, isActive) {
        switch (featureName) {
            case 'highlightHeadings':
                document.body.classList.toggle('access-highlight-headings', isActive);
                setBtnActive('btnHighlightHeadings', isActive);
                break;
            case 'highlightLinks':
                document.body.classList.toggle('access-highlight-links', isActive);
                setBtnActive('btnHighlightLinks', isActive);
                break;
            case 'dyslexiaFont':
                document.body.classList.toggle('access-font-dyslexia', isActive);
                setBtnActive('btnDyslexiaFont', isActive);
                break;
            case 'letterSpacing':
                document.body.classList.toggle('access-spacing-wide', isActive);
                setBtnActive('btnLetterSpacing', isActive);
                break;
            case 'lineHeight':
                document.body.classList.toggle('access-line-height-tall', isActive);
                setBtnActive('btnLineHeight', isActive);
                break;
            case 'fontWeight':
                document.body.classList.toggle('access-font-bold', isActive);
                setBtnActive('btnFontWeight', isActive);
                break;
            case 'muteAudio':
                document.querySelectorAll('audio, video').forEach(el => el.muted = isActive);
                if (isActive && window.speechSynthesis) window.speechSynthesis.cancel();
                setBtnActive('btnMuteAudio', isActive);
                break;
            case 'readingGuide':
                const ruler = document.getElementById('accessReadingRuler');
                if (ruler) {
                    if (isActive) {
                        ruler.classList.remove('d-none');
                        document.addEventListener('mousemove', moveReadingRuler);
                    } else {
                        ruler.classList.add('d-none');
                        document.removeEventListener('mousemove', moveReadingRuler);
                    }
                }
                setBtnActive('btnReadingGuide', isActive);
                break;
            case 'stopAnimation':
                document.body.classList.toggle('access-stop-animations', isActive);
                setBtnActive('btnStopAnimation', isActive);
                break;
            case 'largeCursor':
                document.body.classList.toggle('access-cursor-large', isActive);
                setBtnActive('btnLargeCursor', isActive);
                break;
            case 'adhdMask':
                const maskTop = document.getElementById('accessAdhdMaskTop');
                const maskBottom = document.getElementById('accessAdhdMaskBottom');
                if (maskTop && maskBottom) {
                    if (isActive) {
                        maskTop.classList.remove('d-none');
                        maskBottom.classList.remove('d-none');
                        document.addEventListener('mousemove', moveAdhdMask);
                    } else {
                        maskTop.classList.add('d-none');
                        maskBottom.classList.add('d-none');
                        document.removeEventListener('mousemove', moveAdhdMask);
                    }
                }
                break;
        }
    }

    function setBtnActive(btnId, isActive) {
        const btn = document.getElementById(btnId);
        if (btn) {
            if (isActive) btn.classList.add('active');
            else btn.classList.remove('active');
        }
    }

    function moveReadingRuler(e) {
        const ruler = document.getElementById('accessReadingRuler');
        if (ruler) ruler.style.top = (e.clientY - 18) + 'px';
    }

    function moveAdhdMask(e) {
        const maskTop = document.getElementById('accessAdhdMaskTop');
        const maskBottom = document.getElementById('accessAdhdMaskBottom');
        const slotHeight = 60;
        const currentY = e.clientY;

        if (maskTop) {
            maskTop.style.top = '0';
            maskTop.style.height = Math.max(0, currentY - (slotHeight / 2)) + 'px';
        }
        if (maskBottom) {
            const bottomTop = currentY + (slotHeight / 2);
            maskBottom.style.top = bottomTop + 'px';
            maskBottom.style.height = Math.max(0, window.innerHeight - bottomTop) + 'px';
        }
    }

    // -------------------------------------------------------------
    // TEXT ALIGNMENT CYCLER
    // -------------------------------------------------------------
    function cycleTextAlign() {
        accessTextAlignIndex = (accessTextAlignIndex + 1) % textAlignStates.length;
        const state = textAlignStates[accessTextAlignIndex];
        accessState.textAlign = state;

        applyTextAlign(state);
        saveAccessState();
    }

    function applyTextAlign(state) {
        document.body.classList.remove('access-align-left', 'access-align-center', 'access-align-right', 'access-align-justify');
        const btn = document.getElementById('btnTextAlign');
        const icon = document.getElementById('iconTextAlign');
        const label = document.getElementById('labelTextAlign');

        if (state !== 'default') {
            document.body.classList.add('access-align-' + state);
            if (btn) btn.classList.add('active');
        } else {
            if (btn) btn.classList.remove('active');
        }

        const idx = textAlignStates.indexOf(state);
        if (idx !== -1) {
            accessTextAlignIndex = idx;
            if (label) label.textContent = textAlignLabels[idx];
            if (icon) icon.className = 'fas ' + textAlignIcons[idx];
        }
    }

    // -------------------------------------------------------------
    // COLOR CONTRAST (GELAP, TERANG, TINGGI)
    // -------------------------------------------------------------
    function setAccessContrast(type) {
        if (accessState.contrast === type) {
            accessState.contrast = 'default';
        } else {
            accessState.contrast = type;
        }
        applyContrast(accessState.contrast);
        saveAccessState();
    }

    function applyContrast(type) {
        document.body.classList.remove('access-contrast-dark', 'access-contrast-light', 'access-contrast-high');
        setBtnActive('btnDarkContrast', false);
        setBtnActive('btnLightContrast', false);
        setBtnActive('btnHighContrast', false);

        if (type === 'dark') {
            document.body.classList.add('access-contrast-dark');
            setBtnActive('btnDarkContrast', true);
        } else if (type === 'light') {
            document.body.classList.add('access-contrast-light');
            setBtnActive('btnLightContrast', true);
        } else if (type === 'high') {
            document.body.classList.add('access-contrast-high');
            setBtnActive('btnHighContrast', true);
        }
    }

    // -------------------------------------------------------------
    // SATURATION & MONOCHROME
    // -------------------------------------------------------------
    function setAccessSaturation(type) {
        if (accessState.saturation === type) {
            accessState.saturation = 'default';
        } else {
            accessState.saturation = type;
        }
        applySaturation(accessState.saturation);
        saveAccessState();
    }

    function applySaturation(type) {
        document.body.classList.remove('access-sat-high', 'access-sat-low', 'access-monochrome');
        setBtnActive('btnSatHigh', false);
        setBtnActive('btnSatLow', false);
        setBtnActive('btnMonochrome', false);

        if (type === 'high') {
            document.body.classList.add('access-sat-high');
            setBtnActive('btnSatHigh', true);
        } else if (type === 'low') {
            document.body.classList.add('access-sat-low');
            setBtnActive('btnSatLow', true);
        } else if (type === 'mono') {
            document.body.classList.add('access-monochrome');
            setBtnActive('btnMonochrome', true);
        }
    }

    // -------------------------------------------------------------
    // ACCESSIBILITY PROFILES (EPILEPSI, ADHD, PENGLIHATAN RENDAH)
    // -------------------------------------------------------------
    function toggleProfile(profileKey) {
        if (accessState.activeProfile === profileKey) {
            accessState.activeProfile = null;
            resetProfileFeatures(profileKey);
        } else {
            if (accessState.activeProfile) resetProfileFeatures(accessState.activeProfile);
            accessState.activeProfile = profileKey;
            applyProfileFeatures(profileKey);
        }
        updateProfileCards();
        saveAccessState();
    }

    function applyProfileFeatures(profileKey) {
        if (profileKey === 'epilepsy' || profileKey === 'motor') {
            accessState.stopAnimation = true;
            applyFeatureState('stopAnimation', true);
            setAccessSaturation('low');
        } else if (profileKey === 'adhd') {
            accessState.adhdMask = true;
            applyFeatureState('adhdMask', true);
            accessState.readingGuide = true;
            applyFeatureState('readingGuide', true);
        } else if (profileKey === 'lowVision') {
            adjustAccessFontSize(2); // 120%
            accessState.fontWeight = true;
            applyFeatureState('fontWeight', true);
            accessState.largeCursor = true;
            applyFeatureState('largeCursor', true);
            setAccessContrast('high');
        }
    }

    function resetProfileFeatures(profileKey) {
        if (profileKey === 'epilepsy' || profileKey === 'motor') {
            accessState.stopAnimation = false;
            applyFeatureState('stopAnimation', false);
            setAccessSaturation('default');
        } else if (profileKey === 'adhd') {
            accessState.adhdMask = false;
            applyFeatureState('adhdMask', false);
            accessState.readingGuide = false;
            applyFeatureState('readingGuide', false);
        } else if (profileKey === 'lowVision') {
            adjustAccessFontSize(-2);
            accessState.fontWeight = false;
            applyFeatureState('fontWeight', false);
            accessState.largeCursor = false;
            applyFeatureState('largeCursor', false);
            setAccessContrast('default');
        }
    }

    function updateProfileCards() {
        ['epilepsy', 'motor', 'adhd', 'lowVision'].forEach(k => {
            const cardId = 'prof' + k.charAt(0).toUpperCase() + k.slice(1);
            const card = document.getElementById(cardId);
            if (card) {
                if (accessState.activeProfile === k) card.classList.add('active');
                else card.classList.remove('active');
            }
        });
    }

    // -------------------------------------------------------------
    // LANGUAGE SELECTOR (GOOGLE TRANSLATE INTEGRATION)
    // -------------------------------------------------------------
    function filterAccessLanguages() {
        const query = (document.getElementById('langSearchInput')?.value || '').toLowerCase();
        document.querySelectorAll('.access-lang-opt').forEach(btn => {
            const text = btn.innerText.toLowerCase();
            btn.style.display = text.includes(query) ? 'flex' : 'none';
        });
    }

    function selectAccessLanguage(code, badge, name) {
        accessState.language = code;
        const badgeEl = document.getElementById('currentLangBadge');
        const labelEl = document.getElementById('currentLangLabel');
        if (badgeEl) badgeEl.textContent = badge;
        if (labelEl) labelEl.textContent = name;

        document.querySelectorAll('.access-lang-opt').forEach(el => el.classList.remove('active'));
        event.currentTarget.classList.add('active');

        // Trigger Google Translate
        const select = document.querySelector('.goog-te-combo');
        if (select) {
            select.value = code;
            select.dispatchEvent(new Event('change'));
        }

        toggleAccessAccordion('accLanguage');
        saveAccessState();
    }

    // -------------------------------------------------------------
    // SCREEN READER TEXT-TO-SPEECH (TTS)
    // -------------------------------------------------------------
    let isTtsActive = false;
    let isTtsPaused = false;
    let ttsElements = [];
    let ttsCurrentIdx = -1;
    let ttsCurrentEl = null;
    const synth = window.speechSynthesis;

    function toggleScreenReader() {
        if (!('speechSynthesis' in window)) {
            alert('Browser Anda tidak mendukung fitur suara pembaca halaman (Speech Synthesis).');
            return;
        }

        if (isTtsActive) {
            stopScreenReader();
        } else {
            startScreenReader();
        }
    }

    function startScreenReader() {
        isTtsActive = true;
        isTtsPaused = false;
        setBtnActive('btnReadPage', true);

        // Tutup drawer agar layar leluasa dibaca
        if (isAccessDrawerOpen) toggleAccessDrawer();

        const bar = document.getElementById('accessTtsPlayerBar');
        if (bar) bar.classList.remove('d-none');

        // Kumpulkan elemen artikel
        ttsElements = [];
        const candidates = document.querySelectorAll('h1, h2, h3, h4, p, li, dt, dd, .accordion-button');
        candidates.forEach(el => {
            if (el.closest('#accessWidgetContainer') || el.closest('#accessTtsPlayerBar') || el.closest('.modal') || el.closest('.navbar')) return;
            const text = (el.innerText || el.textContent || '').trim();
            if (text.length >= 3 && !ttsElements.includes(el)) ttsElements.push(el);
        });

        ttsCurrentIdx = -1;
        updateTtsBadge();

        const pageTitle = document.title ? document.title.split('|')[0].trim() : 'PPID PKTJ';
        speakSentence(`Mode pembaca halaman aktif. Membacakan: ${pageTitle}.`, function() {
            if (isTtsActive && ttsElements.length > 0) readTtsIndex(0);
        });
    }

    function stopScreenReader() {
        isTtsActive = false;
        isTtsPaused = false;
        if (synth) synth.cancel();
        clearTtsHighlight();

        setBtnActive('btnReadPage', false);
        const bar = document.getElementById('accessTtsPlayerBar');
        if (bar) bar.classList.add('d-none');
    }

    function readTtsIndex(index) {
        if (!isTtsActive) return;
        if (index < 0) index = 0;
        if (index >= ttsElements.length) {
            clearTtsHighlight();
            const snippet = document.getElementById('accessTtsSnippet');
            if (snippet) snippet.textContent = 'Pembacaan seluruh halaman telah selesai.';
            speakSentence('Pembacaan seluruh halaman telah selesai.');
            return;
        }

        ttsCurrentIdx = index;
        const el = ttsElements[index];

        clearTtsHighlight();
        ttsCurrentEl = el;
        el.classList.add('access-tts-active-highlight');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });

        updateTtsBadge();

        let text = (el.innerText || el.textContent || '').trim();
        speakSentence(text, function() {
            if (isTtsActive && !isTtsPaused) readTtsIndex(ttsCurrentIdx + 1);
        });
    }

    function speakSentence(text, onEnd) {
        if (!synth) return;
        synth.cancel();

        const utter = new SpeechSynthesisUtterance(text);
        utter.lang = 'id-ID';
        utter.rate = 0.95;

        const voices = synth.getVoices();
        const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID'));
        if (idVoice) utter.voice = idVoice;

        const snippet = document.getElementById('accessTtsSnippet');
        if (snippet) snippet.textContent = text.length > 75 ? text.substring(0, 75) + '...' : text;

        utter.onend = function() { if (onEnd) onEnd(); };
        utter.onerror = function() { if (onEnd) onEnd(); };

        synth.speak(utter);
    }

    function toggleTtsPause() {
        if (!isTtsActive) return;
        const icon = document.getElementById('iconTtsPlayPause');
        if (synth.speaking && !synth.paused) {
            synth.pause();
            isTtsPaused = true;
            if (icon) icon.className = 'fas fa-play';
        } else if (synth.paused) {
            synth.resume();
            isTtsPaused = false;
            if (icon) icon.className = 'fas fa-pause';
        }
    }

    function nextTtsItem() {
        if (!isTtsActive) return;
        synth.cancel();
        isTtsPaused = false;
        readTtsIndex(ttsCurrentIdx + 1);
    }

    function prevTtsItem() {
        if (!isTtsActive) return;
        synth.cancel();
        isTtsPaused = false;
        readTtsIndex(ttsCurrentIdx - 1);
    }

    function updateTtsBadge() {
        const badge = document.getElementById('accessTtsProgressBadge');
        if (badge) {
            const cur = ttsCurrentIdx >= 0 ? ttsCurrentIdx + 1 : 0;
            badge.textContent = `${cur} / ${ttsElements.length}`;
        }
    }

    function clearTtsHighlight() {
        if (ttsCurrentEl) {
            ttsCurrentEl.classList.remove('access-tts-active-highlight');
            ttsCurrentEl = null;
        }
        document.querySelectorAll('.access-tts-active-highlight').forEach(el => el.classList.remove('access-tts-active-highlight'));
    }

    // Modal Komitmen Aksesibilitas
    function openAccessStatementModal() {
        const modalEl = document.getElementById('accessStatementModal');
        if (modalEl && typeof bootstrap !== 'undefined') {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    // -------------------------------------------------------------
    // RESET ALL SETTINGS (KEMBALI KE BAWAAN)
    // -------------------------------------------------------------
    function resetAllAccessibilitySettings() {
        if (synth) synth.cancel();
        stopScreenReader();

        // Reset Font Scale
        accessFontScale = 100;
        document.documentElement.style.fontSize = '100%';
        const display = document.getElementById('fontSizeDisplay');
        if (display) display.textContent = '100%';

        // Reset All Classes
        document.body.classList.remove(
            'access-highlight-headings',
            'access-highlight-links',
            'access-font-dyslexia',
            'access-spacing-wide',
            'access-line-height-tall',
            'access-font-bold',
            'access-align-left', 'access-align-center', 'access-align-right', 'access-align-justify',
            'access-stop-animations',
            'access-cursor-large',
            'access-contrast-dark', 'access-contrast-light', 'access-contrast-high',
            'access-sat-high', 'access-sat-low', 'access-monochrome'
        );

        // Reset Audio
        document.querySelectorAll('audio, video').forEach(el => el.muted = false);

        // Reset Rulers & Masks
        const ruler = document.getElementById('accessReadingRuler');
        if (ruler) ruler.classList.add('d-none');
        document.removeEventListener('mousemove', moveReadingRuler);

        const maskTop = document.getElementById('accessAdhdMaskTop');
        const maskBottom = document.getElementById('accessAdhdMaskBottom');
        if (maskTop && maskBottom) {
            maskTop.classList.add('d-none');
            maskBottom.classList.add('d-none');
            document.removeEventListener('mousemove', moveAdhdMask);
        }

        // Reset Active States on Cards
        document.querySelectorAll('.access-tool-card, .access-profile-card, .access-font-card').forEach(el => el.classList.remove('active'));

        // Reset Alignment
        accessTextAlignIndex = 0;
        applyTextAlign('default');

        // Reset State Object
        accessState = {
            fontScale: 100,
            highlightHeadings: false,
            highlightLinks: false,
            dyslexiaFont: false,
            letterSpacing: false,
            lineHeight: false,
            fontWeight: false,
            textAlign: 'default',
            contrast: 'default',
            saturation: 'default',
            muteAudio: false,
            readingGuide: false,
            stopAnimation: false,
            largeCursor: false,
            adhdMask: false,
            activeProfile: null,
            language: 'id'
        };

        localStorage.removeItem('pktj_access_state');
    }

    function saveAccessState() {
        try {
            localStorage.setItem('pktj_access_state', JSON.stringify(accessState));
        } catch (e) {}
    }

    function loadSavedAccessState() {
        try {
            const raw = localStorage.getItem('pktj_access_state');
            if (!raw) return;
            const saved = JSON.parse(raw);
            accessState = Object.assign(accessState, saved);

            if (accessState.fontScale && accessState.fontScale !== 100) {
                accessFontScale = accessState.fontScale;
                document.documentElement.style.fontSize = accessFontScale + '%';
                const display = document.getElementById('fontSizeDisplay');
                if (display) display.textContent = accessFontScale + '%';
                const card = document.getElementById('cardFontSize');
                if (card) card.classList.add('active');
            }

            ['highlightHeadings', 'highlightLinks', 'dyslexiaFont', 'letterSpacing', 'lineHeight', 'fontWeight', 'muteAudio', 'readingGuide', 'stopAnimation', 'largeCursor', 'adhdMask'].forEach(k => {
                if (accessState[k]) applyFeatureState(k, true);
            });

            if (accessState.textAlign && accessState.textAlign !== 'default') applyTextAlign(accessState.textAlign);
            if (accessState.contrast && accessState.contrast !== 'default') applyContrast(accessState.contrast);
            if (accessState.saturation && accessState.saturation !== 'default') applySaturation(accessState.saturation);
            if (accessState.activeProfile) {
                updateProfileCards();
            }
        } catch (e) {}
    }

    document.addEventListener('DOMContentLoaded', loadSavedAccessState);
</script>
