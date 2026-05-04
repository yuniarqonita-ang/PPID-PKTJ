{{-- Shared CSS untuk semua halaman publik Layanan Informasi & Prosedur --}}
<style>
    :root {
        --primary-blue: {{ $settings['primary_color'] ?? '#004A99' }};
        --secondary-gold: {{ $settings['secondary_color'] ?? '#FFC107' }};
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
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid #f1f5f9;
    }

    .content-box:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
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

    /* ── Table for laporan ── */
    .laporan-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .laporan-table thead th {
        background: #f0f4f8;
        color: var(--primary-blue);
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 20px;
        border: none;
    }

    .laporan-table thead th:first-child { border-radius: 12px 0 0 12px; }
    .laporan-table thead th:last-child { border-radius: 0 12px 12px 0; }

    .laporan-table tbody tr td {
        background: #f8fafc;
        padding: 16px 20px;
        border: none;
        transition: all 0.2s;
        vertical-align: middle;
    }

    .laporan-table tbody tr:hover td {
        background: #eff6ff;
    }

    .laporan-table tbody tr td:first-child { border-radius: 12px 0 0 12px; }
    .laporan-table tbody tr td:last-child { border-radius: 0 12px 12px 0; }
</style>
