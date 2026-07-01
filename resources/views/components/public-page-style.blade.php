{{-- Shared CSS untuk semua halaman Informasi & Prosedur --}}
<!-- Common Public Page Styles -->
<link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
<style>
    :root {
        --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
        --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        --bg-page: #f0f4f8;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-page);
        color: #1e293b;
        line-height: 1.7;
    }

    .outfit { font-family: 'Outfit', sans-serif; }

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

    .profil-content img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .profil-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 16px 0;
    }

    .profil-content table th,
    .profil-content table td {
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        text-align: left;
    }

    .profil-content table th {
        background: #f0f4f8;
        font-weight: 700;
        color: var(--primary-blue);
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

    .rich-content {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .rich-content img {
        max-width: 100%;
        border-radius: 12px;
        margin: 15px 0;
    }
</style>
