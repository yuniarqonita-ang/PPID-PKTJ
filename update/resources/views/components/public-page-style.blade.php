{{-- Shared CSS untuk semua halaman Informasi & Prosedur --}}
<!-- Common Public Page Styles -->
<link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@300;400;600;700;800;900&family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&family=Montserrat:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
        --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        --bg-page: {{ !empty($settings['bg_color']) ? $settings['bg_color'] : '#f0f4f8' }};
        --base-font-size: {{ !empty($settings['font_size']) ? $settings['font_size'] : '16px' }};
        --heading-size: {{ !empty($settings['heading_size']) ? $settings['heading_size'] : '2.5rem' }};
    }

    body {
        font-family: {!! !empty($settings['font_family']) ? $settings['font_family'] : "'Inter', sans-serif" !!};
        font-size: var(--base-font-size);
        background-color: var(--bg-page);
        color: #1e293b;
        line-height: 1.7;
    }

    .outfit { font-family: {!! !empty($settings['font_family']) ? $settings['font_family'] : "'Inter', sans-serif" !!}; }

    /* ── Hero Section ── */
    .hero-section {
        background: linear-gradient(135deg, #002b5c 0%, #004a99 50%, #005bb5 100%);
        padding: 100px 0 130px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 350px;
        height: 350px;
        background: rgba(255,193,7,0.07);
        border-radius: 50%;
    }

    .hero-overlay { display: none; }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,193,7,0.2);
        border: 1px solid rgba(255,193,7,0.4);
        color: #ffc107;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        letter-spacing: -1px;
        text-transform: uppercase;
        line-height: 1.1;
        margin-bottom: 16px;
    }

    .hero-tagline {
        font-size: 1.1rem;
        opacity: 0.75;
        font-weight: 500;
        margin: 0;
        max-width: 600px;
        margin-inline: auto;
    }

    /* ── Page Container ── */
    .page-container {
        margin-top: -60px;
        margin-bottom: 80px;
        position: relative;
        z-index: 20;
    }

    /* ── Content Card ── */
    .content-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 25px 60px rgba(0, 74, 153, 0.1);
        padding: 48px;
        border-top: 4px solid var(--secondary-gold);
    }

    @media (max-width: 768px) {
        .content-card { padding: 28px 20px; }
        .hero-section { padding: 80px 0 110px; }
        .content-box { padding: 24px 20px 24px 28px !important; }
    }

    /* ── Section Title ── */
    .section-title {
        color: var(--primary-blue);
        font-weight: 900;
        margin-bottom: 28px;
        border-left: 6px solid var(--secondary-gold);
        padding-left: 20px;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
    }

    /* ── Content styling (dari konten-dinamis) ── */
    .content-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 40px 48px 40px 52px;
        margin-bottom: 32px;
        box-shadow: 0 10px 30px rgba(0, 74, 153, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .content-box::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(0, 74, 153, 0.015) 0%, transparent 70%);
        pointer-events: none;
    }

    .content-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0, 74, 153, 0.06);
        border-color: #cbd5e1;
    }

    .content-box .section-title {
        border-left: none !important;
        padding-left: 0 !important;
        margin-bottom: 20px;
        font-size: 1.6rem;
    }

    .profil-content {
        font-size: 1.05rem;
        color: #334155;
        line-height: 1.8;
    }

    .profil-content img,
    .rich-content img,
    .content-box img,
    .content-card img {
        width: 100% !important;
        max-width: 100% !important;
        height: auto !important;
        display: block !important;
        margin: 24px auto !important;
        border-radius: 16px !important;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08) !important;
        object-fit: contain !important;
    }

    /* ── Super-Premium Responsive Table Styling ── */
    .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin: 32px 0;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 43, 92, 0.08), 0 4px 12px rgba(0,0,0,0.03);
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        position: relative;
    }
    .table-responsive-wrapper::-webkit-scrollbar {
        height: 8px;
    }
    .table-responsive-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .table-responsive-wrapper::-webkit-scrollbar-thumb {
        background: #94a3b8;
        border-radius: 10px;
    }
    .table-responsive-wrapper::-webkit-scrollbar-thumb:hover {
        background: #004a99;
    }

    .profil-content table,
    .rich-content table,
    .content-box table,
    .content-card table,
    .info-item table,
    .page-container table,
    table.table-custom-ppid {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin: 0 !important;
        border: none !important;
        background: #ffffff !important;
        font-size: 0.98rem !important;
        table-layout: auto !important;
    }

    .profil-content table th,
    .rich-content table th,
    .content-box table th,
    .content-card table th,
    .info-item table th,
    .page-container table th,
    table.table-custom-ppid th {
        background: linear-gradient(135deg, #001e40 0%, #003366 50%, #004a99 100%) !important;
        color: #ffffff !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.85px !important;
        font-size: 0.92rem !important;
        padding: 18px 24px !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        vertical-align: top !important; /* STANDAR EXCEL & WORD: Lurus rata atas di baris header */
        white-space: normal !important;
        word-wrap: break-word !important;
        box-shadow: inset 0 -3px 0 #d97706, 0 4px 12px rgba(0, 74, 153, 0.15) !important;
    }

    .profil-content table td,
    .rich-content table td,
    .content-box table td,
    .content-card table td,
    .info-item table td,
    .page-container table td,
    table.table-custom-ppid td {
        padding: 18px 24px !important;
        border: 1px solid #e2e8f0 !important;
        color: #334155 !important;
        line-height: 1.75 !important;
        vertical-align: top !important; /* STANDAR EXCEL & WORD: Kompak rata atas sejajar di seluruh kolom */
        white-space: normal !important;
        word-break: normal !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        transition: background-color 0.2s ease !important;
        font-size: 0.96rem !important;
    }

    /* Hilangkan margin atas pada elemen pertama di dalam sel agar baseline huruf di semua kolom sejajar horizontal */
    .profil-content table th > *:first-child,
    .profil-content table td > *:first-child,
    .rich-content table th > *:first-child,
    .rich-content table td > *:first-child,
    .content-box table th > *:first-child,
    .content-box table td > *:first-child,
    .content-card table th > *:first-child,
    .content-card table td > *:first-child,
    .info-item table th > *:first-child,
    .info-item table td > *:first-child,
    .page-container table th > *:first-child,
    .page-container table td > *:first-child,
    table th > *:first-child,
    table td > *:first-child {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .profil-content table th > *:last-child,
    .profil-content table td > *:last-child,
    .rich-content table th > *:last-child,
    .rich-content table td > *:last-child,
    .content-box table th > *:last-child,
    .content-box table td > *:last-child,
    .content-card table th > *:last-child,
    .content-card table td > *:last-child,
    .info-item table th > *:last-child,
    .info-item table td > *:last-child,
    .page-container table th > *:last-child,
    .page-container table td > *:last-child,
    table th > *:last-child,
    table td > *:last-child {
        margin-bottom: 0 !important;
    }

    /* ── Spasi Jarak Paragraf & Enter yang Lega dan Bersih (Preserve Enters & Paragraphs) ── */
    .profil-content p,
    .rich-content p,
    .content-box p,
    .content-card p,
    .info-item p,
    .page-container p {
        margin: 0 0 18px 0 !important;
        line-height: 1.8 !important;
        color: #334155;
        font-size: 1.02rem;
    }

    .profil-content p:last-child,
    .rich-content p:last-child,
    .content-box p:last-child,
    .content-card p:last-child,
    .info-item p:last-child,
    .page-container p:last-child {
        margin-bottom: 0 !important;
    }

    /* Pertahankan tinggi spasi enter sengaja / enter kosong di seluruh halaman */
    .profil-content p:empty,
    .rich-content p:empty,
    .content-box p:empty,
    .content-card p:empty,
    .info-item p:empty,
    .page-container p:empty,
    .profil-content p > br:only-child,
    .rich-content p > br:only-child,
    .content-box p > br:only-child,
    .content-card p > br:only-child,
    .info-item p > br:only-child,
    .page-container p > br:only-child {
        min-height: 1.6em !important;
        display: block !important;
        margin-bottom: 18px !important;
    }

    /* ── Jarak Antar Poin List (Numbered & Bulleted Lists) yang Lega & Nyaman ── */
    .profil-content ol,
    .profil-content ul,
    .rich-content ol,
    .rich-content ul,
    .content-box ol,
    .content-box ul,
    .content-card ol,
    .content-card ul,
    .info-item ol,
    .info-item ul,
    .page-container ol,
    .page-container ul {
        margin: 0 0 22px 0 !important;
        padding-left: 28px !important;
    }

    .profil-content ol > li,
    .profil-content ul > li,
    .rich-content ol > li,
    .rich-content ul > li,
    .content-box ol > li,
    .content-box ul > li,
    .content-card ol > li,
    .content-card ul > li,
    .info-item ol > li,
    .info-item ul > li,
    .page-container ol > li,
    .page-container ul > li {
        margin-bottom: 16px !important;
        line-height: 1.8 !important;
        color: #334155 !important;
        font-size: 1.02rem !important;
    }

    .profil-content ol > li:last-child,
    .profil-content ul > li:last-child,
    .rich-content ol > li:last-child,
    .rich-content ul > li:last-child,
    .content-box ol > li:last-child,
    .content-box ul > li:last-child,
    .content-card ol > li:last-child,
    .content-card ul > li:last-child,
    .info-item ol > li:last-child,
    .info-item ul > li:last-child,
    .page-container ol > li:last-child,
    .page-container ul > li:last-child {
        margin-bottom: 0 !important;
    }

    .profil-content ol > li > p,
    .profil-content ul > li > p,
    .rich-content ol > li > p,
    .rich-content ul > li > p,
    .content-box ol > li > p,
    .content-box ul > li > p,
    .content-card ol > li > p,
    .content-card ul > li > p,
    .info-item ol > li > p,
    .info-item ul > li > p {
        margin-bottom: 12px !important;
    }

    .profil-content ol > li > p:last-child,
    .profil-content ul > li > p:last-child,
    .rich-content ol > li > p:last-child,
    .rich-content ul > li > p:last-child,
    .content-box ol > li > p:last-child,
    .content-box ul > li > p:last-child,
    .content-card ol > li > p:last-child,
    .content-card ul > li > p:last-child,
    .info-item ol > li > p:last-child,
    .info-item ul > li > p:last-child {
        margin-bottom: 0 !important;
    }

    /* Headings di dalam Rich Content */
    .profil-content h1, .profil-content h2, .profil-content h3, .profil-content h4, .profil-content h5, .profil-content h6,
    .rich-content h1, .rich-content h2, .rich-content h3, .rich-content h4, .rich-content h5, .rich-content h6,
    .content-box h1, .content-box h2, .content-box h3, .content-box h4, .content-box h5, .content-box h6,
    .content-card h1, .content-card h2, .content-card h3, .content-card h4, .content-card h5, .content-card h6,
    .info-item h1, .info-item h2, .info-item h3, .info-item h4, .info-item h5, .info-item h6 {
        font-family: 'Outfit', sans-serif !important;
        font-weight: 800 !important;
        color: #002b5c !important;
        margin-top: 28px !important;
        margin-bottom: 16px !important;
        line-height: 1.4 !important;
    }

    .profil-content > *:first-child,
    .rich-content > *:first-child,
    .content-box > *:first-child,
    .content-card > *:first-child,
    .info-item > *:first-child {
        margin-top: 0 !important;
    }

    /* ── Spasi di Dalam Sel Tabel ── */
    .profil-content table p,
    .rich-content table p,
    .content-box table p,
    .content-card table p,
    .info-item table p,
    .page-container table p,
    table td p,
    table th p {
        margin: 0 0 14px 0 !important;
        line-height: 1.75 !important;
    }

    .profil-content table p:empty,
    .rich-content table p:empty,
    .content-box table p:empty,
    .content-card table p:empty,
    .info-item table p:empty,
    .page-container table p:empty,
    table td p:empty,
    table th p:empty,
    .profil-content table p > br:only-child,
    .rich-content table p > br:only-child,
    .content-box table p > br:only-child,
    .content-card table p > br:only-child,
    .info-item table p > br:only-child,
    .page-container table p > br:only-child,
    table td p > br:only-child,
    table th p > br:only-child {
        min-height: 1.5em !important;
        display: block !important;
        margin-bottom: 14px !important;
    }

    /* List Numbering & Bullets di Dalam Tabel */
    .profil-content table ul, .profil-content table ol,
    .rich-content table ul, .rich-content table ol,
    .content-box table ul, .content-box table ol,
    .content-card table ul, .content-card table ol,
    .info-item table ul, .info-item table ol,
    .page-container table ul, .page-container table ol,
    table td ul, table td ol {
        padding-left: 24px !important;
        margin: 0 0 14px 0 !important;
    }

    .profil-content table li,
    .rich-content table li,
    .content-box table li,
    .content-card table li,
    .info-item table li,
    .page-container table li,
    table td li {
        margin-bottom: 12px !important;
        line-height: 1.75 !important;
        color: #334155 !important;
    }

    .profil-content table li:last-child,
    .rich-content table li:last-child,
    .content-box table li:last-child,
    .content-card table li:last-child,
    .info-item table li:last-child,
    .page-container table li:last-child,
    table td li:last-child {
        margin-bottom: 0 !important;
    }

    .profil-content table tr:nth-child(even) td,
    .rich-content table tr:nth-child(even) td,
    .content-box table tr:nth-child(even) td,
    .content-card table tr:nth-child(even) td,
    .info-item table tr:nth-child(even) td,
    .page-container table tr:nth-child(even) td {
        background-color: #f8fafc !important;
    }

    .profil-content table tr:hover td,
    .rich-content table tr:hover td,
    .content-box table tr:hover td,
    .content-card table tr:hover td,
    .info-item table tr:hover td,
    .page-container table tr:hover td {
        background-color: #eff6ff !important;
    }

    /* First and Last Table Corners Rounded */
    .profil-content table tr:first-child th:first-child,
    .rich-content table tr:first-child th:first-child,
    .content-box table tr:first-child th:first-child,
    .content-card table tr:first-child th:first-child,
    .info-item table tr:first-child th:first-child,
    .page-container table tr:first-child th:first-child,
    table.table-custom-ppid tr:first-child th:first-child {
        border-top-left-radius: 22px !important;
    }
    .profil-content table tr:first-child th:last-child,
    .rich-content table tr:first-child th:last-child,
    .content-box table tr:first-child th:last-child,
    .content-card table tr:first-child th:last-child,
    .info-item table tr:first-child th:last-child,
    .page-container table tr:first-child th:last-child,
    table.table-custom-ppid tr:first-child th:last-child {
        border-top-right-radius: 22px !important;
    }
    .profil-content table tr:last-child td:first-child,
    .rich-content table tr:last-child td:first-child,
    .content-box table tr:last-child td:first-child,
    .content-card table tr:last-child td:first-child,
    .info-item table tr:last-child td:first-child,
    .page-container table tr:last-child td:first-child,
    table.table-custom-ppid tr:last-child td:first-child {
        border-bottom-left-radius: 22px !important;
    }
    .profil-content table tr:last-child td:last-child,
    .rich-content table tr:last-child td:last-child,
    .content-box table tr:last-child td:last-child,
    .content-card table tr:last-child td:last-child,
    .info-item table tr:last-child td:last-child,
    .page-container table tr:last-child td:last-child,
    table.table-custom-ppid tr:last-child td:last-child {
        border-bottom-right-radius: 22px !important;
    }

    /* ── Tampilan Link Bersih & Natural di Seluruh Halaman (Tanpa Blok Kuning / Hover Aneh) ── */
    .profil-content a,
    .rich-content a,
    .content-box a,
    .content-card a,
    .info-item a,
    table a,
    .table a {
        color: #004a99 !important;
        font-weight: 600;
        text-decoration: underline !important;
        text-decoration-color: rgba(0, 74, 153, 0.4) !important;
        text-underline-offset: 3px !important;
        transition: color 0.2s ease, text-decoration-color 0.2s ease !important;
        background: transparent !important;
    }
    .profil-content a:hover,
    .rich-content a:hover,
    .content-box a:hover,
    .content-card a:hover,
    .info-item a:hover,
    table a:hover,
    .table a:hover {
        color: #002b5c !important;
        text-decoration-color: #002b5c !important;
        background: transparent !important;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 28px;
        font-size: 2.5rem;
        color: var(--primary-blue);
    }

    .empty-state h3 {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        color: #1e293b;
        font-size: 1.5rem;
        margin-bottom: 12px;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1rem;
        max-width: 500px;
        margin: 0 auto 32px;
        line-height: 1.7;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-blue);
        color: white;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 20px rgba(0, 74, 153, 0.25);
    }

    .btn-action:hover {
        background: #002b5c;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 74, 153, 0.35);
    }

    .btn-action-gold {
        background: var(--secondary-gold);
        color: var(--primary-blue);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .btn-action-gold:hover {
        background: #e0a800;
        color: var(--primary-blue);
        box-shadow: 0 12px 28px rgba(255, 193, 7, 0.4);
    }

    /* ── File download box ── */
    .download-box {
        background: linear-gradient(135deg, var(--primary-blue), #003366);
        border-radius: 20px;
        padding: 36px;
        color: white;
        text-align: center;
        margin-top: 36px;
    }

    .download-box h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .download-box p {
        opacity: 0.75;
        margin-bottom: 24px;
    }

    /* ── Premium Report Card Grid ── */
    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 28px;
        margin-top: 24px;
    }

    @media (max-width: 640px) {
        .report-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

    .report-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 30px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 74, 153, 0.015);
        cursor: pointer;
    }

    .report-card:hover {
        transform: translateY(-8px);
        border-color: var(--secondary-gold);
        box-shadow: 0 20px 45px rgba(0, 74, 153, 0.08);
    }

    .report-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-blue);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .report-card:hover::after {
        opacity: 1;
    }

    .report-icon-container {
        width: 54px;
        height: 54px;
        background: rgba(0, 74, 153, 0.05);
        color: var(--primary-blue);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .report-card:hover .report-icon-container {
        background: var(--primary-blue);
        color: white;
        transform: scale(1.05);
    }

    .report-title-text {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
        line-height: 1.45;
    }

    .report-meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 16px;
    }

    .report-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .report-desc-text {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 24px;
        flex-grow: 1;
    }

    .report-card-actions {
        display: flex;
        gap: 12px;
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-report-preview {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(0, 74, 153, 0.05);
        color: var(--primary-blue);
        padding: 12px 20px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        transition: all 0.3s;
    }

    .btn-report-preview:hover {
        background: var(--primary-blue);
        color: white;
    }

    .btn-report-download {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        width: 46px;
        height: 46px;
        border-radius: 14px;
        border: none;
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .btn-report-download:hover {
        background: #10b981;
        color: white;
    }

    /* ── Serta Merta Style info-item List ── */
    .info-item {
        background: #ffffff;
        border-radius: 24px;
        padding: 32px;
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(0, 74, 153, 0.015);
    }

    .info-item:hover {
        transform: translateY(-5px);
        border-color: var(--secondary-gold);
        box-shadow: 0 20px 45px rgba(0, 74, 153, 0.08);
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background: rgba(0, 74, 153, 0.05);
        color: var(--primary-blue);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 25px;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .info-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }
    }

    .btn-download-premium {
        background: var(--primary-blue);
        color: white;
        padding: 12px 25px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-download-premium:hover {
        background: var(--secondary-gold);
        color: var(--primary-blue);
        transform: scale(1.03);
    }

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Automatically wrap un-wrapped tables with .table-responsive-wrapper for silky smooth scrolling & clipping prevention
    document.querySelectorAll('.profil-content table, .rich-content table, .content-box table, .content-card table, .info-item table, .page-container table').forEach(function(tbl) {
        if (!tbl.parentElement.classList.contains('table-responsive-wrapper')) {
            var wrapper = document.createElement('div');
            wrapper.className = 'table-responsive-wrapper';
            tbl.parentNode.insertBefore(wrapper, tbl);
            wrapper.appendChild(tbl);
        }

        // Pastikan seluruh sel td dan th di tabel mengikuti standar Excel/Word (Rata Atas)
        tbl.querySelectorAll('td, th').forEach(function(cell) {
            cell.style.verticalAlign = 'top';
            var firstP = cell.querySelector('p:first-child');
            if (firstP) {
                firstP.style.marginTop = '0';
                firstP.style.paddingTop = '0';
            }
        });
    });
});
</script>
