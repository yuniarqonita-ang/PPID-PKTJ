@php
    $d = $settings ?? [];
    $pKey = $pKey ?? 'sop_perm';

    $allDefaults = [
        'sop_perm' => [
            'judul'    => 'Prosedur Permohonan Informasi Publik',
            'subtitle' => 'Langkah-langkah mengajukan permohonan informasi kepada PPID PKTJ',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Permohonan Informasi','deskripsi'=>'Pemohon informasi mengajukan permohonan informasi melalui PPID PKTJ','waktu'=>'10 Menit','aktor'=>'Masyarakat','icon'=>'fas fa-user','warna'=>'#004a99'],
                2 => ['nomor'=>'02','judul'=>'Registrasi dengan Mengisi Formulir Identitas','deskripsi'=>'Pemohon informasi melakukan registrasi dengan mengisi formulir identitas','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-id-card','warna'=>'#0284c7'],
                3 => ['nomor'=>'03','judul'=>'Mengajukan Permohonan Informasi Publik','deskripsi'=>'Setelah memenuhi persyaratan identitas, pemohon informasi mengajukan permohonan informasi publik dengan mengisi rincian informasi dan tujuan penggunaannya','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-file-pen','warna'=>'#0284c7'],
                4 => ['nomor'=>'04','judul'=>'Bukti Permohonan Informasi','deskripsi'=>'Petugas PPID memberikan bukti permohonan informasi (nomor pendaftaran) kepada pemohon informasi','waktu'=>'10 Menit','aktor'=>'Petugas Informasi','icon'=>'fas fa-receipt','warna'=>'#0284c7'],
                5 => ['nomor'=>'05','judul'=>'Penyampaian Jawaban','deskripsi'=>'Jawaban atas permohonan informasi akan disampaikan melalui email yang telah didaftarkan paling lambat 10 hari kerja. Jika diperlukan, waktu ini dapat diperpanjang hingga tambahan 7 hari kerja','waktu'=>'10 (+7) Hari Kerja','aktor'=>'PPID PKTJ','icon'=>'fas fa-building-columns','warna'=>'#059669'],
                6 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
                7 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
            ],
            'legend' => [
                1 => ['icon' => 'fas fa-user', 'nama' => 'Masyarakat', 'warna' => '#004a99'],
                2 => ['icon' => 'fas fa-users', 'nama' => 'Petugas Informasi', 'warna' => '#0284c7'],
                3 => ['icon' => 'fas fa-building-columns', 'nama' => 'PPID PKTJ', 'warna' => '#059669'],
                4 => ['icon' => 'fas fa-clock', 'nama' => 'Waktu', 'warna' => '#dc2626'],
            ]
        ],
        'sop_keb' => [
            'judul'    => 'SOP Penanganan Keberatan Informasi',
            'subtitle' => 'Alur Penanganan Keberatan atas Penolakan atau Ketidakpuasan Layanan Informasi Publik',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Penerimaan Surat Keberatan','deskripsi'=>'Petugas menerima surat dan formulir pengajuan keberatan informasi dari masyarakat','waktu'=>'10 Menit','aktor'=>'Masyarakat / Pemohon','icon'=>'fas fa-file-circle-exclamation','warna'=>'#dc2626'],
                2 => ['nomor'=>'02','judul'=>'Verifikasi Syarat Pengajuan','deskripsi'=>'Petugas memeriksa syarat pengajuan (KTP / NPWP / Akta Pendirian Badan Hukum)','waktu'=>'15 Menit','aktor'=>'Petugas Informasi PPID','icon'=>'fas fa-clipboard-check','warna'=>'#d97706'],
                3 => ['nomor'=>'03','judul'=>'Registrasi & Meneruskan Keberatan','deskripsi'=>'Petugas mencatat nomor registrasi keberatan & meneruskan berkas untuk diproses','waktu'=>'15 Menit','aktor'=>'Petugas Informasi PPID','icon'=>'fas fa-paper-plane','warna'=>'#2563eb'],
                4 => ['nomor'=>'04','judul'=>'Pemrosesan Keberatan Informasi','deskripsi'=>'Tim PPID memproses dan menelaah materi keberatan informasi publik secara cermat','waktu'=>'10 Hari Kerja','aktor'=>'PPID UPT Pelaksana','icon'=>'fas fa-cogs','warna'=>'#7c3aed'],
                5 => ['nomor'=>'05','judul'=>'Tanggapan & Keputusan Atasan PPID','deskripsi'=>'Atasan PPID menerbitkan Surat Keputusan tertulis atas pengajuan keberatan','waktu'=>'5 Hari Kerja','aktor'=>'Atasan PPID','icon'=>'fas fa-gavel','warna'=>'#db2777'],
                6 => ['nomor'=>'06','judul'=>'Pelaksanaan Keputusan Tertulis','deskripsi'=>'PPID Pelaksana PKTJ melaksanakan keputusan tertulis dari Atasan PPID','waktu'=>'1 Hari Kerja','aktor'=>'PPID UPT Pelaksana','icon'=>'fas fa-file-signature','warna'=>'#0891b2'],
                7 => ['nomor'=>'07','judul'=>'Penyerahan Informasi & Tanda Terima','deskripsi'=>'PPID memberikan informasi publik dan tanda terima dokumen resmi kepada pemohon','waktu'=>'1 Hari Kerja','aktor'=>'Masyarakat / Pemohon','icon'=>'fas fa-circle-check','warna'=>'#059669'],
            ],
            'legend' => [
                1 => ['icon' => 'fas fa-user-shield', 'nama' => 'Masyarakat / Pemohon', 'warna' => '#dc2626'],
                2 => ['icon' => 'fas fa-user-gear', 'nama' => 'Petugas Informasi / Tim PPID', 'warna' => '#2563eb'],
                3 => ['icon' => 'fas fa-gavel', 'nama' => 'Atasan PPID / PPID Pelaksana', 'warna' => '#7c3aed'],
                4 => ['icon' => 'fas fa-stopwatch', 'nama' => 'Alokasi Waktu Layanan', 'warna' => '#dc2626'],
            ]
        ],
        'sop_seng' => [
            'judul'    => 'Prosedur Pengajuan Sengketa Informasi Publik',
            'subtitle' => 'Proses penyelesaian sengketa melalui Komisi Informasi',
            'steps' => [
                1 => ['nomor'=>'01','judul'=>'Pengajuan Sengketa Informasi Publik','deskripsi'=>'Pengajuan Sengketa Informasi Publik ke Komisi Informasi Pusat diajukan dalam waktu 14 hari kerja setelah diterimanya tanggapan tertulis dari Atasan PPID yang tidak memuaskan Permohonan Informasi Publik. Jika pada tahap mediasi dihasilkan kesepakatan, maka kesepakatan hasil mediasi tersebut ditetapkan oleh Putusan Komisi Informasi.','waktu'=>'14 Hari Kerja','aktor'=>'Pemohon Sengketa','icon'=>'fas fa-scale-balanced','warna'=>'#dc2626'],
                2 => ['nomor'=>'02','judul'=>'Proses Penyelesaian Sengketa melalui Mediasi / Adjudikasi','deskripsi'=>'Dalam waktu 14 hari kerja setelah diterimanya permohonan penyelesaian Sengketa Informasi Publik, Komisi Informasi harus mulai melakukan Proses Penyelesaian sengketa melalui mediasi, paling lambat 100 hari kerja. Apabila upaya mediasi dinyatakan tidak berhasil secara tertulis oleh satu pihak atau para pihak yang bersengketa menarik diri dari perundingan, maka Komisi Informasi melanjutkan proses penyelesaian sengketa melalui adjudikasi.','waktu'=>'Paling Lambat 100 Hari Kerja','aktor'=>'Komisi Informasi','icon'=>'fas fa-users','warna'=>'#2563eb'],
                3 => ['nomor'=>'03','judul'=>'Putusan Adjudikasi / Gugatan Pengadilan','deskripsi'=>'Apabila salah satu atau para pihak yang bersengketa secara tertulis menyatakan tidak menerima putusan adjudikasi dari Komisi Informasi paling lambat 14 hari kerja setelah diterimanya putusan tersebut, maka dapat mengajukan gugatan melalui pengadilan. Jika pemohon informasi puas atas keputusan Adjudikasi Komisi Informasi, sengketa selesai.','waktu'=>'14 Hari Kerja','aktor'=>'Para Pihak / Pengadilan','icon'=>'fas fa-gavel','warna'=>'#059669'],
                4 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
                5 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
                6 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
                7 => ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#64748b'],
            ],
            'legend' => [
                1 => ['icon' => 'fas fa-user', 'nama' => 'Pemohon Sengketa', 'warna' => '#dc2626'],
                2 => ['icon' => 'fas fa-scale-balanced', 'nama' => 'Komisi Informasi', 'warna' => '#2563eb'],
                3 => ['icon' => 'fas fa-gavel', 'nama' => 'Majelis / Pengadilan', 'warna' => '#059669'],
                4 => ['icon' => 'fas fa-clock', 'nama' => 'Waktu Layanan', 'warna' => '#dc2626'],
            ]
        ]
    ];

    $currentDefaults = $allDefaults[$pKey] ?? $allDefaults['sop_perm'];
    $diagJudul    = (array_key_exists("{$pKey}_diagram_judul", $d) && !empty(trim($d["{$pKey}_diagram_judul"])))       ? $d["{$pKey}_diagram_judul"]    : $currentDefaults['judul'];
    $diagSubtitle = (array_key_exists("{$pKey}_diagram_subtitle", $d) && !empty(trim($d["{$pKey}_diagram_subtitle"]))) ? $d["{$pKey}_diagram_subtitle"] : $currentDefaults['subtitle'];

    $steps = [];
    for ($i = 1; $i <= 7; $i++) {
        $defStep = $currentDefaults['steps'][$i] ?? ['nomor'=>'','judul'=>'','deskripsi'=>'','waktu'=>'','aktor'=>'','icon'=>'fas fa-circle-check','warna'=>'#004a99'];

        $nomor     = (array_key_exists("{$pKey}_step_{$i}_nomor", $d)     && $d["{$pKey}_step_{$i}_nomor"] !== null)     ? $d["{$pKey}_step_{$i}_nomor"]     : $defStep['nomor'];
        $judul     = (array_key_exists("{$pKey}_step_{$i}_judul", $d)     && $d["{$pKey}_step_{$i}_judul"] !== null)     ? $d["{$pKey}_step_{$i}_judul"]     : $defStep['judul'];
        $deskripsi = (array_key_exists("{$pKey}_step_{$i}_deskripsi", $d) && $d["{$pKey}_step_{$i}_deskripsi"] !== null) ? $d["{$pKey}_step_{$i}_deskripsi"] : $defStep['deskripsi'];
        $waktu     = (array_key_exists("{$pKey}_step_{$i}_waktu", $d)     && $d["{$pKey}_step_{$i}_waktu"] !== null)     ? $d["{$pKey}_step_{$i}_waktu"]     : $defStep['waktu'];
        $aktor     = (array_key_exists("{$pKey}_step_{$i}_aktor", $d)     && $d["{$pKey}_step_{$i}_aktor"] !== null)     ? $d["{$pKey}_step_{$i}_aktor"]     : $defStep['aktor'];
        $icon      = (array_key_exists("{$pKey}_step_{$i}_icon", $d)      && $d["{$pKey}_step_{$i}_icon"] !== null)      ? $d["{$pKey}_step_{$i}_icon"]      : $defStep['icon'];
        $warna     = (array_key_exists("{$pKey}_step_{$i}_warna", $d)     && $d["{$pKey}_step_{$i}_warna"] !== null)     ? $d["{$pKey}_step_{$i}_warna"]     : $defStep['warna'];

        $steps[$i] = [
            'nomor'     => $nomor,
            'judul'     => $judul,
            'deskripsi' => $deskripsi,
            'waktu'     => $waktu,
            'aktor'     => $aktor,
            'icon'      => !empty($icon) ? $icon : ($defStep['icon'] ?? 'fas fa-circle-check'),
            'warna'     => !empty($warna) ? $warna : ($defStep['warna'] ?? '#004a99'),
        ];
    }

    $legend = [];
    for ($j = 1; $j <= 4; $j++) {
        $defLeg = $currentDefaults['legend'][$j] ?? ['icon'=>'fas fa-user','nama'=>"Aktor {$j}",'warna'=>'#004a99'];
        $legNama = array_key_exists("{$pKey}_legend_{$j}_nama", $d) ? $d["{$pKey}_legend_{$j}_nama"] : $defLeg['nama'];
        $legend[$j] = ['icon' => $defLeg['icon'], 'nama' => $legNama, 'warna' => $defLeg['warna']];
    }

    $activeSteps = array_values(array_filter($steps, function($s) {
        return !empty(trim($s['judul'] ?? '')) || !empty(trim($s['deskripsi'] ?? ''));
    }));
    $totalActive = count($activeSteps);
@endphp

<style>
    /* ============================================================ */
    /* ZIG-ZAG SNAKE ORGANIGRAM FLOWCHART (KIRI ➔ KANAN ➔ TURUN ➔ KIRI) */
    /* Dynamic Winding Organigram Map with Directional Arrow Paths  */
    /* ============================================================ */
    .zigzag-sop-wrapper {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 60%, #f1f5f9 100%);
        border: 2.5px solid #e2e8f0;
        border-radius: 40px;
        padding: 55px 38px 68px;
        margin: 40px 0 65px;
        position: relative;
        box-shadow: 0 30px 80px rgba(0, 74, 153, 0.09);
        overflow: hidden;
    }

    /* TOP HEADER BANNER & LEGEND */
    .zigzag-header-row {
        display: flex; flex-direction: column; gap: 24px;
        margin-bottom: 50px; position: relative; z-index: 5;
    }
    @media (min-width: 992px) {
        .zigzag-header-row { flex-direction: row; align-items: flex-start; justify-content: space-between; }
    }

    .zigzag-title-box { max-width: 600px; }
    .zigzag-badge-pill {
        display: inline-flex; align-items: center; gap: 8px;
        background: #e0f2fe; color: #0284c7; border: 1.5px solid #bae6fd;
        font-weight: 900; font-size: 11px; letter-spacing: 2px; text-transform: uppercase;
        padding: 6px 20px; border-radius: 50px; margin-bottom: 14px;
    }
    .zigzag-title-text {
        font-size: clamp(28px, 3.8vw, 46px); font-weight: 900;
        font-family: 'Outfit', sans-serif; line-height: 1.1;
        color: #0f172a; margin: 0 0 10px; text-transform: uppercase;
    }
    .zigzag-title-text span { color: #004a99; }
    .zigzag-subtitle-text {
        font-size: 15px; color: #475569; font-weight: 500; line-height: 1.55; margin: 0;
    }

    /* FLOATING LEGEND CARD */
    .zigzag-legend-card {
        background: #ffffff; border: 2px solid #e2e8f0;
        border-radius: 26px; padding: 22px 28px; min-width: 270px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.04);
    }
    .zigzag-legend-head {
        font-size: 11.5px; font-weight: 900; text-transform: uppercase;
        letter-spacing: 2px; color: #004a99; margin-bottom: 14px;
        display: flex; align-items: center; gap: 8px;
    }
    .zigzag-legend-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px;
    }
    .zigzag-legend-chip {
        display: flex; align-items: center; gap: 10px;
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        padding: 8px 14px; border-radius: 14px; font-size: 12px;
        font-weight: 800; color: #1e293b;
    }

    /* ============================================================ */
    /* ZIG-ZAG SNAKE ORGANIGRAM GRID (DESKTOP ZIG-ZAG PATH)        */
    /* ============================================================ */
    .zigzag-grid-container {
        position: relative; z-index: 5; max-width: 980px; margin: 0 auto;
        display: flex; flex-direction: column; gap: 28px;
    }

    /* DESKTOP 2-COLUMN ROW */
    .zigzag-row-pair {
        display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
        align-items: center; position: relative;
    }

    /* CARD DESIGN WITH PROMINENT STEP NUMBER PIN */
    .zigzag-card {
        background: #ffffff;
        border: 2.5px solid #e2e8f0;
        border-left: 8px solid var(--step-color, #004a99);
        border-radius: 28px;
        padding: 24px 28px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
        transition: all 0.38s cubic-bezier(.4,0,.2,1);
        position: relative; display: flex; flex-direction: column; gap: 12px;
    }
    .zigzag-card:hover {
        transform: translateY(-6px) scale(1.015);
        border-color: var(--step-color, #004a99);
        box-shadow: 0 22px 48px rgba(0, 74, 153, 0.15);
    }

    .zigzag-card-header {
        display: flex; align-items: center; justify-content: space-between; gap: 14px;
    }

    /* PROMINENT STEP NUMBER PIN (01, 02, 03, 04, 05, 06, 07) */
    .zigzag-step-pin {
        width: 48px; height: 48px; border-radius: 16px;
        background: var(--step-color, #004a99); color: #ffffff;
        font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 20px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 8px 20px -4px var(--step-color, #004a99);
        flex-shrink: 0;
    }

    .zigzag-step-title {
        font-size: 16.5px; font-weight: 800; color: #0f172a;
        font-family: 'Outfit', sans-serif; margin: 0; line-height: 1.3; flex: 1;
    }

    .zigzag-icon-avatar {
        width: 44px; height: 44px; border-radius: 14px;
        background: #f1f5f9; color: var(--step-color, #004a99);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .zigzag-card-desc {
        font-size: 13.5px; color: #475569; line-height: 1.6; font-weight: 400; margin: 0;
    }

    .zigzag-card-footer {
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px; flex-wrap: wrap; margin-top: 4px; padding-top: 8px; border-top: 1px solid #f1f5f9;
    }

    /* PULSING DASHED RED TIME BADGE */
    .zigzag-red-dashed-pill {
        display: inline-flex; align-items: center; gap: 6px;
        border: 2.5px dashed #dc2626; color: #dc2626; background: #fff1f2;
        padding: 5px 18px; border-radius: 50px; font-size: 12px; font-weight: 900;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.1);
        animation: zigzagPulseTime 2.5s infinite;
    }

    .zigzag-actor-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f1f5f9; color: #334155; font-weight: 700; font-size: 11.5px;
        padding: 5px 14px; border-radius: 50px; border: 1px solid #cbd5e1;
    }

    /* ARROW CONNECTOR PATHS FOR ZIG-ZAG (HORIZONTAL & VERTICAL ARROWS) */
    .zigzag-arrow-horiz-right {
        position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);
        z-index: 10; display: none;
    }
    .zigzag-arrow-horiz-left {
        position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(180deg);
        z-index: 10; display: none;
    }
    .zigzag-arrow-down-right {
        display: flex; justify-content: flex-end; padding-right: 20%; margin: -10px 0; z-index: 4;
    }
    .zigzag-arrow-down-left {
        display: flex; justify-content: flex-start; padding-left: 20%; margin: -10px 0; z-index: 4;
    }

    @media (min-width: 992px) {
        .zigzag-arrow-horiz-right, .zigzag-arrow-horiz-left { display: flex; }
    }

    .zigzag-arrow-svg path {
        stroke-dasharray: 8 6;
        animation: zigzagDashOffset 1.4s linear infinite;
    }

    /* RESPONSIVE DESIGN FOR MOBILE */
    @media (max-width: 991px) {
        .zigzag-row-pair { display: flex; flex-direction: column; gap: 24px; }
        .zigzag-arrow-down-right, .zigzag-arrow-down-left { justify-content: center; padding: 0; margin: 0; }
        .zigzag-sop-wrapper { padding: 35px 18px 40px; border-radius: 26px; }
        .zigzag-card { padding: 20px 20px; border-radius: 22px; }
    }

    @keyframes zigzagPulseTime {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.2); }
        50% { transform: scale(1.04); box-shadow: 0 0 0 6px rgba(220, 38, 38, 0); }
    }
    @keyframes zigzagDashOffset {
        to { stroke-dashoffset: -28; }
    }
</style>

<div class="container">
    <div class="zigzag-sop-wrapper" data-aos="fade-up" data-aos-delay="100">
        
        <!-- HEADER ROW: TITLE BANNER (LEFT) + LEGEND CARD (RIGHT) -->
        <div class="zigzag-header-row">
            <div class="zigzag-title-box">
                <div class="zigzag-badge-pill">
                    <i class="fas fa-sitemap"></i> Bagan Struktur Alur Organisasi
                </div>
                <h1 class="zigzag-title-text">
                    {{ Str::beforeLast($diagJudul, ' ') }} <span>{{ Str::afterLast($diagJudul, ' ') }}</span>
                </h1>
                <p class="zigzag-subtitle-text">{{ $diagSubtitle }}</p>
            </div>

            <!-- Legend Box -->
            <div class="zigzag-legend-card">
                <div class="zigzag-legend-head">
                    <i class="fas fa-tags"></i> Keterangan Simbol &amp; Legenda
                </div>
                <div class="zigzag-legend-grid">
                    @foreach($legend as $leg)
                    @if(!empty(trim($leg['nama'])))
                    <div class="zigzag-legend-chip">
                        <i class="{{ $leg['icon'] }}" style="color: {{ $leg['warna'] }};"></i>
                        <span>{{ $leg['nama'] }}</span>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ZIG-ZAG SNAKE ORGANIGRAM TRACK (01 -> 02 -> 03 -> 04 -> 05 -> 06 -> 07) -->
        <div class="zigzag-grid-container">
            @php
                $chunks = array_chunk($activeSteps, 2);
                $stepCount = 0;
            @endphp

            @foreach($chunks as $rowIndex => $pair)
                @php $isEvenRow = ($rowIndex % 2 == 0); @endphp

                <div class="zigzag-row-pair">
                    @if($isEvenRow)
                        <!-- EVEN ROW: Left -> Right (01 -> 02, or 05 -> 06) -->
                        @foreach($pair as $pIndex => $step)
                            @php 
                                $stepCount++; 
                                $stepColor = $step['warna'] ?: '#004a99';
                            @endphp

                            <div class="zigzag-card" style="--step-color: {{ $stepColor }};" data-aos="fade-right" data-aos-delay="{{ 80 + ($stepCount * 50) }}">
                                <div class="zigzag-card-header">
                                    <div class="zigzag-step-pin" style="background: {{ $stepColor }};">
                                        {{ $step['nomor'] ?: sprintf('%02d', $stepCount) }}
                                    </div>
                                    <h3 class="zigzag-step-title">{{ $step['judul'] }}</h3>
                                    <div class="zigzag-icon-avatar">
                                        <i class="{{ $step['icon'] ?: 'fas fa-circle-check' }}"></i>
                                    </div>
                                </div>
                                @if(!empty(trim($step['deskripsi'])))
                                <p class="zigzag-card-desc">• {{ $step['deskripsi'] }}</p>
                                @endif
                                <div class="zigzag-card-footer">
                                    @if(!empty(trim($step['waktu'])))
                                    <div class="zigzag-red-dashed-pill"><i class="fas fa-clock"></i> {{ $step['waktu'] }}</div>
                                    @endif
                                    @if(!empty(trim($step['aktor'])))
                                    <div class="zigzag-actor-pill"><i class="fas fa-user-tag text-slate-500"></i> {{ $step['aktor'] }}</div>
                                    @endif
                                </div>
                            </div>

                            @if($pIndex == 0 && count($pair) > 1)
                            <!-- Horizontal Arrow Right (01 -> 02) -->
                            <div class="zigzag-arrow-horiz-right">
                                <svg class="zigzag-arrow-svg" viewBox="0 0 42 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 42px; height: 24px;">
                                    <path d="M2 12 H34 M27 5 L35 12 L27 19" stroke="{{ $stepColor }}" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <!-- ODD ROW: Right -> Left (04 <- 03) -->
                        @php
                            $stepCountLeft = $stepCount + (count($pair) == 2 ? 2 : 1);
                            $stepCountRight = $stepCount + 1;
                        @endphp

                        @if(count($pair) == 2)
                            <!-- Step on Left (Step 04) -->
                            @php $stepL = $pair[1]; $colorL = $stepL['warna'] ?: '#7c3aed'; @endphp
                            <div class="zigzag-card" style="--step-color: {{ $colorL }};" data-aos="fade-left" data-aos-delay="{{ 80 + ($stepCountLeft * 50) }}">
                                <div class="zigzag-card-header">
                                    <div class="zigzag-step-pin" style="background: {{ $colorL }};">
                                        {{ $stepL['nomor'] ?: sprintf('%02d', $stepCountLeft) }}
                                    </div>
                                    <h3 class="zigzag-step-title">{{ $stepL['judul'] }}</h3>
                                    <div class="zigzag-icon-avatar">
                                        <i class="{{ $stepL['icon'] ?: 'fas fa-circle-check' }}"></i>
                                    </div>
                                </div>
                                @if(!empty(trim($stepL['deskripsi'])))
                                <p class="zigzag-card-desc">• {{ $stepL['deskripsi'] }}</p>
                                @endif
                                <div class="zigzag-card-footer">
                                    @if(!empty(trim($stepL['waktu'])))
                                    <div class="zigzag-red-dashed-pill"><i class="fas fa-clock"></i> {{ $stepL['waktu'] }}</div>
                                    @endif
                                    @if(!empty(trim($stepL['aktor'])))
                                    <div class="zigzag-actor-pill"><i class="fas fa-user-tag text-slate-500"></i> {{ $stepL['aktor'] }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Horizontal Arrow Left (03 -> 04) -->
                            <div class="zigzag-arrow-horiz-left">
                                <svg class="zigzag-arrow-svg" viewBox="0 0 42 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 42px; height: 24px;">
                                    <path d="M2 12 H34 M27 5 L35 12 L27 19" stroke="{{ $colorL }}" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <!-- Step on Right (Step 03) -->
                            @php $stepR = $pair[0]; $colorR = $stepR['warna'] ?: '#0284c7'; @endphp
                            <div class="zigzag-card" style="--step-color: {{ $colorR }};" data-aos="fade-right" data-aos-delay="{{ 80 + ($stepCountRight * 50) }}">
                                <div class="zigzag-card-header">
                                    <div class="zigzag-step-pin" style="background: {{ $colorR }};">
                                        {{ $stepR['nomor'] ?: sprintf('%02d', $stepCountRight) }}
                                    </div>
                                    <h3 class="zigzag-step-title">{{ $stepR['judul'] }}</h3>
                                    <div class="zigzag-icon-avatar">
                                        <i class="{{ $stepR['icon'] ?: 'fas fa-circle-check' }}"></i>
                                    </div>
                                </div>
                                @if(!empty(trim($stepR['deskripsi'])))
                                <p class="zigzag-card-desc">• {{ $stepR['deskripsi'] }}</p>
                                @endif
                                <div class="zigzag-card-footer">
                                    @if(!empty(trim($stepR['waktu'])))
                                    <div class="zigzag-red-dashed-pill"><i class="fas fa-clock"></i> {{ $stepR['waktu'] }}</div>
                                    @endif
                                    @if(!empty(trim($stepR['aktor'])))
                                    <div class="zigzag-actor-pill"><i class="fas fa-user-tag text-slate-500"></i> {{ $stepR['aktor'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            @php $stepSingle = $pair[0]; $stepCount++; $colorSingle = $stepSingle['warna'] ?: '#004a99'; @endphp
                            <div></div>
                            <div class="zigzag-card" style="--step-color: {{ $colorSingle }};" data-aos="fade-up">
                                <div class="zigzag-card-header">
                                    <div class="zigzag-step-pin" style="background: {{ $colorSingle }};">
                                        {{ $stepSingle['nomor'] ?: sprintf('%02d', $stepCount) }}
                                    </div>
                                    <h3 class="zigzag-step-title">{{ $stepSingle['judul'] }}</h3>
                                    <div class="zigzag-icon-avatar">
                                        <i class="{{ $stepSingle['icon'] ?: 'fas fa-circle-check' }}"></i>
                                    </div>
                                </div>
                                @if(!empty(trim($stepSingle['deskripsi'])))
                                <p class="zigzag-card-desc">• {{ $stepSingle['deskripsi'] }}</p>
                                @endif
                                <div class="zigzag-card-footer">
                                    @if(!empty(trim($stepSingle['waktu'])))
                                    <div class="zigzag-red-dashed-pill"><i class="fas fa-clock"></i> {{ $stepSingle['waktu'] }}</div>
                                    @endif
                                    @if(!empty(trim($stepSingle['aktor'])))
                                    <div class="zigzag-actor-pill"><i class="fas fa-user-tag text-slate-500"></i> {{ $stepSingle['aktor'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @php $stepCount += count($pair); @endphp
                    @endif
                </div>

                @if($rowIndex < count($chunks) - 1)
                <!-- Vertical Snake Turn Arrow Downward between Rows -->
                <div class="{{ $isEvenRow ? 'zigzag-arrow-down-right' : 'zigzag-arrow-down-left' }}">
                    <svg class="zigzag-arrow-svg" viewBox="0 0 24 38" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 38px;">
                        <path d="M12 2 V26 M5 19 L12 27 L19 19" stroke="#004a99" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                @endif
            @endforeach
        </div>

    </div>
</div>
