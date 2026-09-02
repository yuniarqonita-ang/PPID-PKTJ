<!-- ULTRA-MODERN NEON ACCESSIBILITY & DISABILITY INCLUSION HUB (AKIP KEMENHUB STANDAR SLIDE 41, 44, 72 & UU NO. 8/2016) -->
@php
    $accessSettings = \App\Models\Dashboard::pluck('value', 'key')->toArray();

    // 1. Formulir Permohonan Braille (Link GDrive atau File Upload)
    $braillePermohonanUrl = !empty($accessSettings['aksesibilitas_disabilitas_link_form_permohonan_braille'])
        ? $accessSettings['aksesibilitas_disabilitas_link_form_permohonan_braille']
        : (!empty($accessSettings['aksesibilitas_disabilitas_file_form_permohonan_braille'])
            ? asset('storage/halaman/' . $accessSettings['aksesibilitas_disabilitas_file_form_permohonan_braille'])
            : asset('storage/dokumen/FORMULIR_PERMOHONAN_BRAILE.pdf'));

    // 2. Formulir Pernyataan Keberatan Braille (Link GDrive atau File Upload)
    $brailleKeberatanUrl = !empty($accessSettings['aksesibilitas_disabilitas_link_form_keberatan_braille'])
        ? $accessSettings['aksesibilitas_disabilitas_link_form_keberatan_braille']
        : (!empty($accessSettings['aksesibilitas_disabilitas_file_form_keberatan_braille'])
            ? asset('storage/halaman/' . $accessSettings['aksesibilitas_disabilitas_file_form_keberatan_braille'])
            : asset('storage/dokumen/PERNYATAAN_KEBERATAN_BRAILE.pdf'));

    // 3. Dokumen Inovasi Disabilitas (Link GDrive atau File Upload)
    $inovasiDocUrl = !empty($accessSettings['aksesibilitas_disabilitas_link_inovasi_disabilitas'])
        ? $accessSettings['aksesibilitas_disabilitas_link_inovasi_disabilitas']
        : (!empty($accessSettings['aksesibilitas_disabilitas_file_inovasi_disabilitas'])
            ? asset('storage/halaman/' . $accessSettings['aksesibilitas_disabilitas_file_inovasi_disabilitas'])
            : asset('storage/dokumen/Inovasi_PPID.docx'));

    $bisindoVideoUrl = $accessSettings['aksesibilitas_disabilitas_video_bisindo_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ';
    $hotlinePendamping = $accessSettings['aksesibilitas_disabilitas_hotline_pendamping_wa'] ?? '081234567890';
@endphp

<div id="neonAccessibilityWrapper">

    <!-- FLOATING NEON PILL TRIGGER (DOCKABLE LEFT EDGE, NON-OVERLAPPING) -->
    <button type="button" id="btnNeonAccessTrigger" class="neon-access-pill-trigger" onclick="toggleNeonAccessDrawer()" title="Pusat Aksesibilitas & Ramah Disabilitas (Alt + A)" aria-label="Buka Menu Aksesibilitas Disabilitas">
        <div class="neon-pulse-ring"></div>
        <div class="neon-icon-glow">
            <i class="fas fa-universal-access"></i>
        </div>
        <span class="neon-pill-label">Akses Disabilitas</span>
    </button>

    <!-- BACKDROP BLUR OVERLAY -->
    <div id="neonAccessBackdrop" class="neon-access-backdrop" onclick="toggleNeonAccessDrawer()"></div>

    <!-- FROSTED NEON SLIDE DRAWER -->
    <div id="neonAccessDrawer" class="neon-access-drawer" aria-hidden="true">
        
        <!-- DRAWER HEADER -->
        <div class="neon-drawer-header">
            <div class="d-flex align-items-center gap-3">
                <div class="neon-badge-avatar">
                    <i class="fas fa-universal-access"></i>
                </div>
                <div>
                    <h5 class="outfit fw-bold text-white mb-0" style="font-size: 15px; letter-spacing: 0.3px;">
                        Layanan Inklusif & Difabel
                    </h5>
                    <span class="neon-tag-mini">Standar AKIP Kemenhub & UU 8/2016</span>
                </div>
            </div>
            <button type="button" class="neon-drawer-close-btn" onclick="toggleNeonAccessDrawer()" title="Tutup Menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- DRAWER SCROLLABLE BODY -->
        <div class="neon-drawer-body">

            <!-- 1. PANDUAN & DOKUMEN BRAILLE (TUNA NETRA) -->
            <div class="neon-section-card mb-3">
                <div class="neon-sec-title">
                    <i class="fas fa-braille text-warning me-2"></i> Layanan Khusus Tuna Netra (Braille & Suara)
                </div>
                <p class="neon-sec-desc">
                    Format khusus dokumen huruf Braille & pembaca suara bagi penyandang disabilitas sensorik netra.
                </p>

                <div class="row g-2">
                    <div class="col-12">
                        <a href="{{ $braillePermohonanUrl }}" target="_blank" class="neon-action-doc-btn">
                            <div class="neon-doc-icon bg-warning-subtle text-warning">
                                <i class="fas fa-file-lines"></i>
                            </div>
                            <div class="text-start flex-grow-1">
                                <div class="neon-doc-title">Formulir Permohonan Huruf Braille</div>
                                <div class="neon-doc-sub">Format cetak & unduh khusus Braille (PDF)</div>
                            </div>
                            <i class="fas fa-download neon-arrow-icon"></i>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="{{ $brailleKeberatanUrl }}" target="_blank" class="neon-action-doc-btn">
                            <div class="neon-doc-icon bg-danger-subtle text-danger">
                                <i class="fas fa-triangle-exclamation"></i>
                            </div>
                            <div class="text-start flex-grow-1">
                                <div class="neon-doc-title">Pernyataan Keberatan Huruf Braille</div>
                                <div class="neon-doc-sub">Formulir pengajuan keberatan Braille (PDF)</div>
                            </div>
                            <i class="fas fa-download neon-arrow-icon"></i>
                        </a>
                    </div>
                    <div class="col-12">
                        <button type="button" id="btnTtsInteractive" class="neon-tts-btn w-100" onclick="toggleTextToSpeech()">
                            <i class="fas fa-volume-high me-2 text-info fs-5"></i>
                            <div class="text-start flex-grow-1">
                                <span id="ttsBtnText" class="fw-bold">Mode Pembaca Suara (Klik Langsung Dibaca)</span>
                                <span class="d-block text-white-50" style="font-size: 11px;">Klik teks mana saja di layar untuk langsung didengar tanpa perlu diblok</span>
                            </div>
                            <span id="ttsStatusPill" class="badge bg-info text-dark">Aktifkan</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. PANDUAN BAHASA ISYARAT (TUNA RUNGU / WICARA) -->
            <div class="neon-section-card mb-3">
                <div class="neon-sec-title">
                    <i class="fas fa-hands-asl-interpreting text-cyan me-2" style="color: #00f2fe;"></i> Bahasa Isyarat (Tuna Rungu / Wicara)
                </div>
                <p class="neon-sec-desc">
                    Video panduan alur permohonan informasi publik dalam Bahasa Isyarat Indonesia (Bisindo).
                </p>

                <button type="button" class="neon-bisindo-video-btn w-100" onclick="openBisindoModal()">
                    <i class="fas fa-play-circle fs-4 me-2"></i>
                    <span>Tonton Video Panduan Bahasa Isyarat (Bisindo)</span>
                </button>
            </div>

            <!-- 3. PENGUBAH TAMPILAN VISUAL (FITUR RAMAH AKSES) -->
            <div class="neon-section-card mb-3">
                <div class="neon-sec-title">
                    <i class="fas fa-sliders text-success me-2"></i> Fitur Pengubah Tampilan & Visual
                </div>
                <p class="neon-sec-desc">Sesuaikan kenyamanan tampilan teks, warna, dan font sesuai kebutuhan Anda.</p>

                <div class="row g-2">
                    <!-- Text Size -->
                    <div class="col-6">
                        <button type="button" class="neon-tool-grid-btn" onclick="adjustGlobalFontSize(1)">
                            <i class="fas fa-text-height text-primary mb-1"></i>
                            <span>Perbesar Teks (A+)</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="neon-tool-grid-btn" onclick="adjustGlobalFontSize(-1)">
                            <i class="fas fa-compress-alt text-primary mb-1"></i>
                            <span>Perkecil Teks (A-)</span>
                        </button>
                    </div>

                    <!-- High Contrast -->
                    <div class="col-6">
                        <button type="button" id="btnNeonContrast" class="neon-tool-grid-btn" onclick="toggleNeonHighContrast()">
                            <i class="fas fa-adjust text-warning mb-1"></i>
                            <span>Kontras Tinggi</span>
                        </button>
                    </div>

                    <!-- Invert Monochrome -->
                    <div class="col-6">
                        <button type="button" id="btnNeonMono" class="neon-tool-grid-btn" onclick="toggleNeonMonochrome()">
                            <i class="fas fa-circle-half-stroke text-secondary mb-1"></i>
                            <span>Monokrom</span>
                        </button>
                    </div>

                    <!-- Dyslexia Font -->
                    <div class="col-6">
                        <button type="button" id="btnNeonDyslexia" class="neon-tool-grid-btn" onclick="toggleNeonDyslexiaFont()">
                            <i class="fas fa-font text-info mb-1"></i>
                            <span>Font Disleksia</span>
                        </button>
                    </div>

                    <!-- Large Spacing -->
                    <div class="col-6">
                        <button type="button" id="btnNeonSpacing" class="neon-tool-grid-btn" onclick="toggleNeonTextSpacing()">
                            <i class="fas fa-arrows-left-right text-cyan mb-1" style="color: #00f2fe;"></i>
                            <span>Spasi Teks Lebar</span>
                        </button>
                    </div>

                    <!-- Highlight Links -->
                    <div class="col-6">
                        <button type="button" id="btnNeonHighlight" class="neon-tool-grid-btn" onclick="toggleNeonHighlightLinks()">
                            <i class="fas fa-link text-success mb-1"></i>
                            <span>Sorot Tautan</span>
                        </button>
                    </div>

                    <!-- Reading Ruler -->
                    <div class="col-6">
                        <button type="button" id="btnNeonRuler" class="neon-tool-grid-btn" onclick="toggleNeonReadingGuide()">
                            <i class="fas fa-ruler-horizontal text-danger mb-1"></i>
                            <span>Garis Pandu Baca</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. HOTLINE PENDAMPING MEJA LAYANAN PKTJ -->
            <div class="neon-section-card mb-3 p-3 text-center" style="background: linear-gradient(135deg, rgba(0, 43, 92, 0.95), rgba(0, 102, 204, 0.9)); border-color: rgba(0, 242, 254, 0.4);">
                <i class="fab fa-whatsapp text-success fs-3 mb-1"></i>
                <h6 class="text-white fw-bold outfit mb-1" style="font-size: 13.5px;">Butuh Bantuan Pendamping Langsung?</h6>
                <p class="text-white-50 small mb-2" style="font-size: 11px;">Petugas meja layanan PPID PKTJ siap mendampingi pemohon difabel.</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $hotlinePendamping) }}?text=Halo%20PPID%20PKTJ,%20saya%20membutuhkan%20bantuan%20layanan%20informasi%20khusus%20disabilitas" target="_blank" class="btn btn-success btn-sm rounded-pill px-3 fw-bold w-100" style="font-size: 12px;">
                    <i class="fab fa-whatsapp me-1"></i> Hubungi WhatsApp Petugas
                </a>
            </div>

            <!-- RESET BUTTON -->
            <div class="text-center pt-2">
                <button type="button" class="btn btn-sm btn-outline-light w-100 rounded-pill py-2 text-white-50 fw-bold" onclick="resetNeonAccessSettings()" style="font-size: 11px; border-color: rgba(255,255,255,0.2);">
                    <i class="fas fa-rotate-left me-1"></i> Reset Semua Pengaturan Akses
                </button>
            </div>

        </div>

    </div>

</div>

<!-- MODAL VIDEO PANDUAN BAHASA ISYARAT -->
<div class="modal fade" id="modalBisindo" tabindex="-1" aria-hidden="true" style="z-index: 100005;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 24px; overflow: hidden; background: #001738; border: 2px solid #00f2fe; box-shadow: 0 0 40px rgba(0, 242, 254, 0.3);">
            <div class="modal-header text-white border-0 px-4 py-3" style="background: rgba(0, 43, 92, 0.8);">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning text-dark fw-bold px-2.5 py-1 rounded-pill">BISINDO</span>
                    <h6 class="modal-title outfit fw-bold text-white mb-0">Panduan Permohonan Informasi - Bahasa Isyarat</h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="iframeBisindo" src="{{ $bisindoVideoUrl }}" title="Panduan Bahasa Isyarat PPID PKTJ" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer border-0 py-2 px-4 d-flex justify-content-between" style="background: rgba(0, 43, 92, 0.95);">
                <span class="text-white-50 small">Standar Aksesibilitas Inklusif PPID PKTJ Tegal</span>
                <button type="button" class="btn btn-warning btn-sm rounded-pill px-4 fw-bold text-dark" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- READING RULER GUIDE -->
<div id="neonReadingGuideRuler" class="neon-reading-guide-ruler d-none"></div>

<!-- FLOATING TTS ACTIVE PLAYER BANNER -->
<div id="neonTtsFloatingBar" class="neon-tts-floating-bar d-none">
    <div class="neon-tts-floating-inner">
        <div class="neon-tts-live-wave">
            <span class="bar bar-1"></span>
            <span class="bar bar-2"></span>
            <span class="bar bar-3"></span>
            <span class="bar bar-4"></span>
        </div>
        <div class="neon-tts-floating-info">
            <div class="neon-tts-floating-label">
                <i class="fas fa-volume-high text-warning me-1"></i> <span id="neonTtsModeTitle">Mode Pembaca Suara Aktif</span>
            </div>
            <div id="neonTtsReadingSnippet" class="neon-tts-floating-snippet">
                Klik bagian teks/paragraf mana saja untuk langsung didengar suaranya...
            </div>
        </div>
        <div class="neon-tts-floating-actions">
            <button type="button" class="btn-tts-action btn-tts-stop" onclick="stopTextToSpeech()" title="Hentikan Suara">
                <i class="fas fa-stop me-1"></i> Berhenti
            </button>
            <button type="button" class="btn-tts-action btn-tts-close" onclick="disableTextToSpeechMode()" title="Tutup Mode Suara">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<style>
    /* ==============================================
       NEON FLOATING ACCESS PILL (ULTRA-MODERN DOCK)
       ============================================== */
    .neon-access-pill-trigger {
        position: fixed;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 99990;
        background: linear-gradient(135deg, #001738 0%, #002b5c 50%, #004a99 100%);
        color: #ffffff;
        border: 2px solid #00f2fe;
        border-left: none;
        border-radius: 0 9999px 9999px 0;
        padding: 12px 18px 12px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 0 20px rgba(0, 242, 254, 0.35), 0 10px 30px rgba(0, 23, 56, 0.6);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .neon-access-pill-trigger:hover {
        padding-left: 20px;
        padding-right: 24px;
        box-shadow: 0 0 30px rgba(0, 242, 254, 0.6), 0 0 50px rgba(255, 193, 7, 0.4);
        border-color: #ffd166;
        transform: translateY(-50%) scale(1.05);
    }

    .neon-icon-glow {
        font-size: 20px;
        color: #00f2fe;
        filter: drop-shadow(0 0 6px rgba(0, 242, 254, 0.8));
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .neon-pill-label {
        font-family: 'Outfit', sans-serif;
        font-size: 12.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #ffffff;
        text-shadow: 0 0 10px rgba(0, 242, 254, 0.6);
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .neon-access-pill-trigger {
            top: auto;
            bottom: 80px;
            transform: none;
            border-radius: 9999px;
            left: 15px;
            padding: 10px 14px;
        }
        .neon-pill-label { display: none; }
    }

    /* NEON BACKDROP */
    .neon-access-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 15, 38, 0.6);
        backdrop-filter: blur(6px);
        z-index: 99995;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .neon-access-backdrop.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* NEON SLIDE DRAWER */
    .neon-access-drawer {
        position: fixed;
        top: 0;
        left: -420px;
        width: 390px;
        max-width: 92vw;
        height: 100vh;
        background: rgba(0, 23, 56, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-right: 2px solid rgba(0, 242, 254, 0.3);
        box-shadow: 15px 0 50px rgba(0, 0, 0, 0.6), 0 0 30px rgba(0, 242, 254, 0.2);
        z-index: 100000;
        display: flex;
        flex-direction: column;
        transition: left 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .neon-access-drawer.active {
        left: 0;
    }

    .neon-drawer-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, rgba(0, 43, 92, 0.95), rgba(0, 74, 153, 0.8));
        border-bottom: 1px solid rgba(0, 242, 254, 0.25);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .neon-badge-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #00f2fe, #004a99);
        color: #001738;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.5);
    }

    .neon-tag-mini {
        font-size: 10px;
        font-weight: 700;
        color: #ffd166;
        letter-spacing: 0.4px;
        display: block;
    }

    .neon-drawer-close-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .neon-drawer-close-btn:hover {
        background: #ef4444;
        color: white;
        transform: rotate(90deg);
    }

    .neon-drawer-body {
        padding: 20px 22px;
        overflow-y: auto;
        flex: 1;
    }

    .neon-drawer-body::-webkit-scrollbar {
        width: 6px;
    }
    .neon-drawer-body::-webkit-scrollbar-thumb {
        background: rgba(0, 242, 254, 0.3);
        border-radius: 9999px;
    }

    /* NEON SECTION CARDS */
    .neon-section-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        padding: 16px;
        transition: all 0.3s ease;
    }

    .neon-section-card:hover {
        border-color: rgba(0, 242, 254, 0.4);
        background: rgba(255, 255, 255, 0.07);
    }

    .neon-sec-title {
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
    }

    .neon-sec-desc {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.65);
        margin-bottom: 12px;
        line-height: 1.5;
    }

    /* NEON DOC BUTTON */
    .neon-action-doc-btn {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 14px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none !important;
        color: white !important;
        transition: all 0.25s ease;
    }

    .neon-action-doc-btn:hover {
        background: rgba(0, 242, 254, 0.15);
        border-color: #00f2fe;
        transform: translateY(-2px);
    }

    .neon-doc-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .neon-doc-title {
        font-size: 12px;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.3;
    }

    .neon-doc-sub {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.55);
    }

    .neon-arrow-icon {
        color: #00f2fe;
        font-size: 13px;
    }

    /* NEON TTS BUTTON */
    .neon-tts-btn {
        background: linear-gradient(135deg, rgba(0, 74, 153, 0.6), rgba(0, 102, 204, 0.4));
        border: 1px solid rgba(0, 242, 254, 0.3);
        border-radius: 14px;
        padding: 12px 14px;
        color: white;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .neon-tts-btn:hover {
        border-color: #00f2fe;
        background: linear-gradient(135deg, rgba(0, 74, 153, 0.9), rgba(0, 242, 254, 0.3));
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.3);
    }

    .neon-bisindo-video-btn {
        background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
        border: 1px solid #00f2fe;
        border-radius: 14px;
        padding: 12px 14px;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.2);
    }

    .neon-bisindo-video-btn:hover {
        background: linear-gradient(135deg, #001f42 0%, #0066cc 100%);
        box-shadow: 0 0 25px rgba(0, 242, 254, 0.4);
        transform: translateY(-2px);
    }

    /* NEON TOOL GRID */
    .neon-tool-grid-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 12px 10px;
        color: white;
        font-size: 11.5px;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        width: 100%;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .neon-tool-grid-btn:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: #00f2fe;
        color: #00f2fe;
    }

    .neon-tool-grid-btn.active {
        background: rgba(0, 242, 254, 0.2);
        border-color: #00f2fe;
        color: #ffd166;
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
    }

    /* READING RULER */
    .neon-reading-guide-ruler {
        position: fixed;
        left: 0;
        width: 100%;
        height: 38px;
        background: rgba(255, 209, 102, 0.25);
        border-top: 2px solid #ffd166;
        border-bottom: 2px solid #ffd166;
        box-shadow: 0 0 20px rgba(255, 209, 102, 0.4);
        pointer-events: none;
        z-index: 999999;
    }

    /* GLOBAL ACCESSIBILITY STYLES */
    body.neon-high-contrast {
        background-color: #000000 !important;
        color: #ffff00 !important;
    }
    body.neon-high-contrast * {
        background-color: #000000 !important;
        color: #ffff00 !important;
        border-color: #ffff00 !important;
        box-shadow: none !important;
    }
    body.neon-high-contrast a {
        color: #00ffff !important;
        text-decoration: underline !important;
    }
    body.neon-monochrome {
        filter: grayscale(100%) !important;
    }
    body.neon-dyslexia-font,
    body.neon-dyslexia-font * {
        font-family: 'Comic Sans MS', 'Verdana', sans-serif !important;
        letter-spacing: 0.5px !important;
    }
    body.neon-text-spacing,
    body.neon-text-spacing * {
        letter-spacing: 2px !important;
        word-spacing: 4px !important;
        line-height: 2 !important;
    }
    body.neon-highlight-links a {
        background-color: #ffd166 !important;
        color: #000000 !important;
        outline: 2px solid #ff9900 !important;
        text-decoration: underline !important;
    }

    /* ==============================================
       TTS READING HIGHLIGHT & CLICK-TO-SPEAK
       ============================================== */
    .tts-reading-highlight {
        background-color: rgba(255, 209, 102, 0.45) !important;
        outline: 3px solid #ff9900 !important;
        outline-offset: 4px !important;
        border-radius: 8px !important;
        box-shadow: 0 0 25px rgba(255, 153, 0, 0.5) !important;
        transition: all 0.25s ease-in-out !important;
    }

    body.tts-click-mode-active {
        cursor: pointer !important;
    }

    body.tts-click-mode-active p,
    body.tts-click-mode-active h1,
    body.tts-click-mode-active h2,
    body.tts-click-mode-active h3,
    body.tts-click-mode-active h4,
    body.tts-click-mode-active h5,
    body.tts-click-mode-active h6,
    body.tts-click-mode-active li,
    body.tts-click-mode-active td,
    body.tts-click-mode-active th,
    body.tts-click-mode-active dt,
    body.tts-click-mode-active dd,
    body.tts-click-mode-active .card,
    body.tts-click-mode-active .pillar-card,
    body.tts-click-mode-active .rich-content > * {
        transition: outline 0.15s ease, background-color 0.15s ease;
    }

    body.tts-click-mode-active p:hover,
    body.tts-click-mode-active h1:hover,
    body.tts-click-mode-active h2:hover,
    body.tts-click-mode-active h3:hover,
    body.tts-click-mode-active h4:hover,
    body.tts-click-mode-active h5:hover,
    body.tts-click-mode-active h6:hover,
    body.tts-click-mode-active li:hover,
    body.tts-click-mode-active td:hover,
    body.tts-click-mode-active th:hover {
        outline: 2px dashed #00f2fe !important;
        outline-offset: 3px !important;
        border-radius: 6px !important;
        background-color: rgba(0, 242, 254, 0.08) !important;
    }

    /* FLOATING TTS PLAYER BAR */
    .neon-tts-floating-bar {
        position: fixed;
        bottom: 25px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999999;
        max-width: 92vw;
        width: 620px;
        animation: slideUpTts 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUpTts {
        from { opacity: 0; transform: translate(-50%, 30px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }

    .neon-tts-floating-inner {
        background: rgba(0, 23, 56, 0.95);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 2px solid #00f2fe;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4), 0 0 25px rgba(0, 242, 254, 0.25);
        border-radius: 50px;
        padding: 10px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: white;
    }

    .neon-tts-live-wave {
        display: flex;
        align-items: center;
        gap: 3px;
        height: 22px;
    }

    .neon-tts-live-wave .bar {
        width: 3.5px;
        height: 8px;
        background: #00f2fe;
        border-radius: 4px;
        animation: waveAnim 1s ease-in-out infinite alternate;
    }

    .neon-tts-live-wave .bar-1 { animation-delay: 0.1s; height: 16px; }
    .neon-tts-live-wave .bar-2 { animation-delay: 0.3s; height: 22px; }
    .neon-tts-live-wave .bar-3 { animation-delay: 0.2s; height: 12px; }
    .neon-tts-live-wave .bar-4 { animation-delay: 0.4s; height: 18px; }

    @keyframes waveAnim {
        0% { height: 6px; }
        100% { height: 22px; }
    }

    .neon-tts-floating-info {
        flex-grow: 1;
        min-width: 0;
    }

    .neon-tts-floating-label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #ffc107;
    }

    .neon-tts-floating-snippet {
        font-size: 12.5px;
        color: #e2e8f0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .neon-tts-floating-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-tts-action {
        border: none;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-tts-stop {
        background: #ef4444;
        color: white;
    }
    .btn-tts-stop:hover {
        background: #dc2626;
        transform: scale(1.05);
    }

    .btn-tts-close {
        background: rgba(255, 255, 255, 0.15);
        color: #cbd5e1;
        padding: 6px 10px;
    }
    .btn-tts-close:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }
</style>

<script>
    let isNeonDrawerOpen = false;
    let isSpeaking = false;
    let isTtsModeActive = false;
    let speechSynth = window.speechSynthesis;
    let currentHighlightedEl = null;
    let globalFontStep = 0;

    function toggleNeonAccessDrawer() {
        isNeonDrawerOpen = !isNeonDrawerOpen;
        const drawer = document.getElementById('neonAccessDrawer');
        const backdrop = document.getElementById('neonAccessBackdrop');

        if (isNeonDrawerOpen) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            drawer.setAttribute('aria-hidden', 'false');
        } else {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            drawer.setAttribute('aria-hidden', 'true');
        }
    }

    // Keyboard shortcut Alt + A
    document.addEventListener('keydown', function(e) {
        if (e.altKey && (e.key === 'a' || e.key === 'A')) {
            e.preventDefault();
            toggleNeonAccessDrawer();
        }
    });

    // 1. Text to Speech (Langsung Dibacakan Saat Di-Klik Tanpa Perlu Blok Teks)
    function toggleTextToSpeech() {
        if (!('speechSynthesis' in window)) {
            alert('Browser Anda tidak mendukung Text-to-Speech.');
            return;
        }

        if (isTtsModeActive) {
            disableTextToSpeechMode();
        } else {
            enableTextToSpeechMode();
        }
    }

    function enableTextToSpeechMode() {
        isTtsModeActive = true;
        document.body.classList.add('tts-click-mode-active');

        const ttsBtnText = document.getElementById('ttsBtnText');
        const ttsStatusPill = document.getElementById('ttsStatusPill');
        if (ttsBtnText) ttsBtnText.textContent = 'Mode Suara Aktif (Klik Teks Mana Saja)';
        if (ttsStatusPill) {
            ttsStatusPill.textContent = 'Aktif';
            ttsStatusPill.className = 'badge bg-success text-white';
        }

        const floatingBar = document.getElementById('neonTtsFloatingBar');
        if (floatingBar) floatingBar.classList.remove('d-none');

        // Tutup drawer agar pengguna langsung bisa mengklik halaman
        if (isNeonDrawerOpen) toggleNeonAccessDrawer();

        // Panduan suara awal otomatis
        speakCustomText('Mode pembaca suara aktif. Silakan klik bagian teks atau paragraf mana saja di layar untuk langsung mendengarkan bacaan.');
    }

    function disableTextToSpeechMode() {
        isTtsModeActive = false;
        document.body.classList.remove('tts-click-mode-active');
        stopTextToSpeech();

        const ttsBtnText = document.getElementById('ttsBtnText');
        const ttsStatusPill = document.getElementById('ttsStatusPill');
        if (ttsBtnText) ttsBtnText.textContent = 'Mode Pembaca Suara (Klik Langsung Dibaca)';
        if (ttsStatusPill) {
            ttsStatusPill.textContent = 'Aktifkan';
            ttsStatusPill.className = 'badge bg-info text-dark';
        }

        const floatingBar = document.getElementById('neonTtsFloatingBar');
        if (floatingBar) floatingBar.classList.add('d-none');
    }

    function speakElementText(el) {
        if (!el) return;
        let text = el.innerText || el.textContent;
        text = text ? text.trim() : '';
        if (!text || text.length < 2) return;

        speakCustomText(text, el);
    }

    function speakCustomText(text, highlightEl = null) {
        if (!('speechSynthesis' in window)) return;

        // Bersihkan pembacaan sebelumnya
        speechSynth.cancel();
        clearTtsHighlight();

        if (highlightEl) {
            currentHighlightedEl = highlightEl;
            currentHighlightedEl.classList.add('tts-reading-highlight');
        }

        const utter = new SpeechSynthesisUtterance(text);
        utter.lang = 'id-ID';
        utter.rate = 0.95;
        utter.pitch = 1.0;

        // Pilih suara Bahasa Indonesia jika ada
        const voices = speechSynth.getVoices();
        const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID') || v.name.toLowerCase().includes('indonesia'));
        if (idVoice) utter.voice = idVoice;

        const snippetEl = document.getElementById('neonTtsReadingSnippet');
        if (snippetEl) {
            const preview = text.length > 70 ? text.substring(0, 70) + '...' : text;
            snippetEl.textContent = `"${preview}"`;
        }

        const floatingBar = document.getElementById('neonTtsFloatingBar');
        if (floatingBar) floatingBar.classList.remove('d-none');

        utter.onend = function() {
            isSpeaking = false;
            clearTtsHighlight();
            if (snippetEl) snippetEl.textContent = 'Selesai membaca. Klik teks lain untuk mendengarkan kembali.';
        };

        utter.onerror = function() {
            isSpeaking = false;
            clearTtsHighlight();
        };

        speechSynth.speak(utter);
        isSpeaking = true;
    }

    function stopTextToSpeech() {
        if (speechSynth) speechSynth.cancel();
        isSpeaking = false;
        clearTtsHighlight();
        const snippetEl = document.getElementById('neonTtsReadingSnippet');
        if (snippetEl) snippetEl.textContent = 'Suara dihentikan. Klik teks mana saja untuk membaca.';
    }

    function clearTtsHighlight() {
        if (currentHighlightedEl) {
            currentHighlightedEl.classList.remove('tts-reading-highlight');
            currentHighlightedEl = null;
        }
        document.querySelectorAll('.tts-reading-highlight').forEach(el => el.classList.remove('tts-reading-highlight'));
    }

    // Global Click-to-Speak Listener (Cukup di-klik langsung dibaca tanpa perlu di-blok)
    document.addEventListener('click', function(e) {
        if (!isTtsModeActive) return;

        // Jangan proses klik jika berada di dalam kontrol tombol aksesibilitas
        if (e.target.closest('#neonAccessDrawer') || e.target.closest('#neonTtsFloatingBar') || e.target.closest('#btnNeonAccessTrigger') || e.target.closest('.modal')) {
            return;
        }

        // Cari elemen teks terdekat yang diklik
        const target = e.target.closest('p, h1, h2, h3, h4, h5, h6, li, td, th, dt, dd, blockquote, label, .card, .pillar-card, .btn, a, span');
        if (target) {
            const text = (target.innerText || target.textContent || '').trim();
            if (text && text.length > 1) {
                speakElementText(target);
            }
        }
    }, true);

    // 2. Video Bisindo Modal
    function openBisindoModal() {
        const modalEl = document.getElementById('modalBisindo');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    // 3. Visual Controls
    function adjustGlobalFontSize(step) {
        globalFontStep += step;
        if (globalFontStep > 3) globalFontStep = 3;
        if (globalFontStep < -2) globalFontStep = -2;

        const baseSize = 100 + (globalFontStep * 10);
        document.documentElement.style.fontSize = baseSize + '%';
        localStorage.setItem('neon_font_step', globalFontStep);
    }

    function toggleNeonHighContrast() {
        document.body.classList.toggle('neon-high-contrast');
        const btn = document.getElementById('btnNeonContrast');
        btn.classList.toggle('active');
        localStorage.setItem('neon_high_contrast', document.body.classList.contains('neon-high-contrast'));
    }

    function toggleNeonMonochrome() {
        document.body.classList.toggle('neon-monochrome');
        const btn = document.getElementById('btnNeonMono');
        btn.classList.toggle('active');
        localStorage.setItem('neon_monochrome', document.body.classList.contains('neon-monochrome'));
    }

    function toggleNeonDyslexiaFont() {
        document.body.classList.toggle('neon-dyslexia-font');
        const btn = document.getElementById('btnNeonDyslexia');
        btn.classList.toggle('active');
        localStorage.setItem('neon_dyslexia', document.body.classList.contains('neon-dyslexia-font'));
    }

    function toggleNeonTextSpacing() {
        document.body.classList.toggle('neon-text-spacing');
        const btn = document.getElementById('btnNeonSpacing');
        btn.classList.toggle('active');
        localStorage.setItem('neon_spacing', document.body.classList.contains('neon-text-spacing'));
    }

    function toggleNeonHighlightLinks() {
        document.body.classList.toggle('neon-highlight-links');
        const btn = document.getElementById('btnNeonHighlight');
        btn.classList.toggle('active');
        localStorage.setItem('neon_highlight', document.body.classList.contains('neon-highlight-links'));
    }

    // Reading Guide Ruler
    let isRulerActive = false;
    function toggleNeonReadingGuide() {
        isRulerActive = !isRulerActive;
        const ruler = document.getElementById('neonReadingGuideRuler');
        const btn = document.getElementById('btnNeonRuler');

        if (isRulerActive) {
            ruler.classList.remove('d-none');
            btn.classList.add('active');
            document.addEventListener('mousemove', moveReadingRuler);
        } else {
            ruler.classList.add('d-none');
            btn.classList.remove('active');
            document.removeEventListener('mousemove', moveReadingRuler);
        }
    }

    function moveReadingRuler(e) {
        const ruler = document.getElementById('neonReadingGuideRuler');
        if (ruler) {
            ruler.style.top = (e.clientY - 19) + 'px';
        }
    }

    function resetNeonAccessSettings() {
        if (isSpeaking) {
            speechSynth.cancel();
            isSpeaking = false;
        }
        document.documentElement.style.fontSize = '100%';
        globalFontStep = 0;

        document.body.classList.remove('neon-high-contrast', 'neon-monochrome', 'neon-dyslexia-font', 'neon-text-spacing', 'neon-highlight-links');
        document.querySelectorAll('.neon-tool-grid-btn').forEach(el => el.classList.remove('active'));

        if (isRulerActive) toggleNeonReadingGuide();

        localStorage.removeItem('neon_font_step');
        localStorage.removeItem('neon_high_contrast');
        localStorage.removeItem('neon_monochrome');
        localStorage.removeItem('neon_dyslexia');
        localStorage.removeItem('neon_spacing');
        localStorage.removeItem('neon_highlight');
    }

    // Load saved settings on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('neon_high_contrast') === 'true') toggleNeonHighContrast();
        if (localStorage.getItem('neon_monochrome') === 'true') toggleNeonMonochrome();
        if (localStorage.getItem('neon_dyslexia') === 'true') toggleNeonDyslexiaFont();
        if (localStorage.getItem('neon_spacing') === 'true') toggleNeonTextSpacing();
        if (localStorage.getItem('neon_highlight') === 'true') toggleNeonHighlightLinks();

        const savedStep = parseInt(localStorage.getItem('neon_font_step') || '0');
        if (savedStep !== 0) {
            globalFontStep = savedStep;
            document.documentElement.style.fontSize = (100 + (savedStep * 10)) + '%';
        }
    });
</script>
