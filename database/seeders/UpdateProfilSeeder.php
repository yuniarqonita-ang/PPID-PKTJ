<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProfilSeeder extends Seeder
{
    public function run()
    {
        $profilTextPembuka = '<div class="mb-4">
    <p class="lead fw-semibold text-dark" style="font-size: 1.15rem; line-height: 1.8;">
        Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Unit Pelaksana Teknis (UPT) Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai garda terdepan keterbukaan informasi publik di lingkungan pendidikan tinggi vokasi Kementerian Perhubungan.
    </p>
    <p>
        Keberadaan PPID Pelaksana PKTJ berakar kuat dari sejarah panjang pengabdian institusi yang didirikan pada tanggal <strong>14 Mei 1971</strong> dengan nama awal <em>Balai Pendidikan dan Latihan Transportasi Jalan Raya (Balai Diklat Trans Jaya) Tegal</em>. Melalui perjalanan transformasi berkelanjutan, institusi ini berkembang menjadi Pusat Pendidikan dan Latihan Perhubungan Darat (Pusdiklat Perhubdat), kemudian bertransformasi menjadi Balai Pendidikan dan Pelatihan Transportasi Darat (BPPTD) Tegal berdasarkan Keputusan Menteri Perhubungan Nomor KM 73 Tahun 2002.
    </p>
    <p>
        Puncaknya, pada tahun 2012 melalui Peraturan Menteri Perhubungan Republik Indonesia Nomor <strong>PM 15 Tahun 2012</strong>, institusi ini resmi ditingkatkan status kelembagaannya menjadi <strong>Politeknik Keselamatan Transportasi Jalan (PKTJ)</strong>, sebuah perguruan tinggi kedinasan vokasi pertama dan terdepan di Indonesia yang berfokus penuh pada keselamatan transportasi jalan.
    </p>
    <p>
        Saat ini, PKTJ beroperasi dengan 2 (dua) kampus utama di Kota Tegal, yaitu:
    </p>
    <ul>
        <li><strong>Kampus 1 (Kampus Perintis)</strong>: Berlokasi di Jl. Perintis Kemerdekaan No. 17, Kelurahan Slerok, Kecamatan Tegal Timur, Kota Tegal.</li>
        <li><strong>Kampus 2 (Kampus Margadana)</strong>: Berlokasi di Jl. KH. Abdul Syukur No. 17, Margadana, Kota Tegal — yang juga menjadi lokasi utama <em>Desk Meja Layanan Terpadu PPID PKTJ</em>.</li>
    </ul>
</div>';

        $profilTextDetail = '<div class="mb-4">
    <p>
        Sebagai Unit Pelaksana Teknis (UPT) di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ memiliki mandat mulia mencetak perwira transportasi jalan yang profesional, berkarakter, dan berdaya saing global melalui 3 (tiga) program studi unggulan:
    </p>
    <ol>
        <li><strong>Sarjana Terapan (D-IV) Rekayasa Sistem Transportasi Jalan (RSTJ)</strong></li>
        <li><strong>Sarjana Terapan (D-IV) Teknologi Rekayasa Otomotif (TRO)</strong></li>
        <li><strong>Diploma III (D-III) Teknologi Otomotif (TO)</strong></li>
    </ol>
    <p>
        Dalam mendukung terwujudnya tata kelola pendidikan kedinasan yang bersih, transparan, dan bebas dari korupsi (Good Governance & Clean Government), PPID Pelaksana UPT PKTJ Tegal berkomitmen penuh memberikan pelayanan informasi yang cepat, akurat, tidak memungut biaya apapun (Rp 0), serta menjamin hak setiap pemohon informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 dan Peraturan Menhub Nomor PM 46 Tahun 2018.
    </p>
</div>';

        foreach (['profil', 'profil-ppid'] as $pType) {
            DB::table('profil_ppids')->updateOrInsert(
                ['type' => $pType],
                [
                    'judul'          => 'Profil PPID PKTJ Tegal',
                    'tagline_hero'   => 'Mewujudkan Keterbukaan Informasi Menuju Tata Kelola Pendidikan Vokasi yang Transparan dan Berkelanjutan',
                    'konten_pembuka' => $profilTextPembuka,
                    'judul_sub'      => 'Mandat Kelembagaan & Transformasi Pendidikan Vokasi Keselamatan Jalan',
                    'konten_detail'  => $profilTextDetail,
                    'gambaran'       => '<div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-3.5 mb-0" style="background: #eef2ff; color: #002b5c;"><i class="fas fa-shield-halved fa-2x me-3 text-primary"></i><div><strong>Standar Pelayanan PPID PKTJ:</strong> Berkomitmen memberikan pelayanan informasi publik yang cepat, tepat waktu, biaya ringan (Rp 0), serta mudah dijangkau oleh seluruh lapisan masyarakat termasuk penyandang disabilitas.</div></div>',
                ]
            );
        }

        $defaultStrukturTugas = '<h2 class="section-title">Tugas & Wewenang Struktur PPID</h2>
<p class="text-muted mb-4">Uraian tugas, wewenang, dan tanggung jawab masing-masing bagian dalam struktur PPID Politeknik Keselamatan Transportasi Jalan sesuai Keputusan Direktur PKTJ.</p>
<div class="accordion" id="accordionTugas">
    <!-- Item 1: PPID Pelaksana UPT -->
    <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
        <h2 class="accordion-header">
            <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-user-tie"></i></span>
                1. PPID Pelaksana UPT (Direktur PKTJ)
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
            <div class="accordion-body bg-light/50 p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                        <ol class="ps-3 mb-0 small text-justify">
                            <li class="mb-2">Menyediakan informasi secara baik and efisien sehingga dapat diakses dengan mudah;</li>
                            <li class="mb-2">Melakukan pengawasan terhadap pelaksanaan layanan informasi sehingga dapat diakses dengan mudah;</li>
                            <li class="mb-2">Meningkatkan sumber daya manusia dalam pelayanan informasi; dan</li>
                            <li class="mb-2">Mengkoordinasikan setiap unit/satuan kerja di lingkup kerja Eselon I dalam melaksanakan pelayanan informasi.</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-shield-alt me-2 text-warning"></i> Wewenang:</h5>
                        <ol class="ps-3 mb-0 small text-justify">
                            <li class="mb-2">Mengajukan usulan daftar informasi publik dan informasi yang dikecualikan kepada PPID Pelaksana;</li>
                            <li class="mb-2">Menjamin tersimpan dan terdokumentasi seluruh informasi secara fisik yang meliputi:
                                <ul class="ps-3 list-disc mt-1">
                                    <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                    <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                    <li>Informasi terbuka lainnya yang diminta pemohon informasi.</li>
                                </ul>
                            </li>
                            <li class="mb-2">Menolak permohonan informasi apabila informasi yang dimohon termasuk informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                            <li class="mb-2">Membuat dan mengumumkan laporan tentang pelaksanaan layanan informasi serta menyampaikan salinan laporan kepada Komisi Informasi dan atasan PPID;</li>
                            <li class="mb-2">Menyediakan sarana dan prasarana layanan informasi;</li>
                            <li class="mb-2">Menugaskan pejabat fungsional dan/atau petugas informasi di bawah wewenang dan koordinasinya untuk membuat, memelihara, dan/atau memutakhirkan informasi;</li>
                            <li class="mb-2">Menetapkan program meningkatkan sumber daya manusia dalam pelayanan informasi; dan</li>
                            <li class="mb-2">Melakukan evaluasi terhadap pelaksanaan layanan informasi pada instansinya.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Item 2: Manager Informasi dan Dokumentasi -->
    <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
        <h2 class="accordion-header">
            <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-project-diagram"></i></span>
                2. Manager Informasi dan Dokumentasi
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
            <div class="accordion-body bg-light/50 p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-clipboard-list me-2 text-warning"></i> Tanggung Jawab:</h5>
                        <ol class="ps-3 mb-0 small text-justify">
                            <li class="mb-2">Menyediakan Informasi secara baik dan efisien;</li>
                            <li class="mb-2">Melakukan pengawasan terhadap pelaksanaan layanan Informasi secara baik dan efisien;</li>
                            <li class="mb-2">Meningkatkan sumber daya manusia dalam pelayanan Informasi;</li>
                            <li class="mb-2">Mengkoordinasikan setiap unit/satuan kerja di Badan Publik dalam melaksanakan pelayanan Informasi; dan</li>
                            <li class="mb-2">Menyimpan dan mendokumentasikan serta memutakhirkan seluruh Informasi secara fisik.</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                        <ol class="ps-3 mb-0 small text-justify">
                            <li class="mb-2">Memberikan Informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
                            <li class="mb-2">Menyediakan seluruh Informasi secara fisik yang meliputi:
                                <ul class="ps-3 list-disc mt-1">
                                    <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                    <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                    <li>Informasi terbuka lainnya yang diminta pemohon Informasi.</li>
                                </ul>
                            </li>
                            <li class="mb-2">Menolak permohonan Informasi apabila Informasi yang dimohon termasuk Informasi yang dikecualikan/rahasia dengan disertai alasan;</li>
                            <li class="mb-2">Mengumumkan laporan tentang layanan Informasi serta menyampaikan salinan laporan kepada Komisi Informasi dan Atasan PPID;</li>
                            <li class="mb-2">Menyiapkan pejabat fungsional dan/atau petugas Informasi dibawah wewenang dan koordinasinya untuk membuat, memelihara, dan/atau memutakhirkan Informasi;</li>
                            <li class="mb-2">Menyusun program peningkatan sumber daya manusia dalam pelayanan Informasi;</li>
                            <li class="mb-2">Melakukan evaluasi terhadap pelaksanaan layanan Informasi pada instansinya;</li>
                            <li class="mb-2">Menyediakan dokumentasi dan Informasi secara fisik; dan</li>
                            <li class="mb-2">Menunjuk pejabat fungsional dibawah wewenang dan koordinasinya untuk menyimpan, mendokumentasikan dan memutakhirkan seluruh Informasi secara fisik.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Item 3: Pengelola Dokumentasi -->
    <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
        <h2 class="accordion-header">
            <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-folder-open"></i></span>
                3. Pengelola Dokumentasi
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
            <div class="accordion-body bg-light/50 p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-clipboard-list me-2 text-warning"></i> Tanggung Jawab:</h5>
                        <p class="small ps-3 text-justify">Mengelola dan mendokumentasikan informasi yang berada di bawah kewenangannya.</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas:</h5>
                        <ol class="ps-3 mb-0 small text-justify">
                            <li class="mb-2">Menyediakan dokumentasi dan Informasi secara fisik yang meliputi:
                                <ul class="ps-3 list-disc mt-1">
                                    <li>Informasi yang wajib disediakan dan diumumkan secara berkala;</li>
                                    <li>Informasi yang wajib tersedia setiap saat; dan</li>
                                    <li>Informasi terbuka lainnya yang diminta pemohon Informasi.</li>
                                </ul>
                            </li>
                            <li class="mb-2">Melakukan koordinasi dengan manager dokumentasi untuk menyimpan, mendokumentasikan dan memutakhirkan seluruh Informasi secara fisik.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Item 4: Petugas Informasi -->
    <div class="accordion-item rounded-4 overflow-hidden border mb-3 shadow-sm bg-white">
        <h2 class="accordion-header">
            <button class="accordion-button fw-bold outfit text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                <span class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center me-3 d-inline-flex align-items-center justify-content-center"><i class="fas fa-user-clock"></i></span>
                4. Petugas Informasi
            </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionTugas">
            <div class="accordion-body bg-light/50 p-4">
                <h5 class="fw-bold text-[#004a99]"><i class="fas fa-tasks me-2 text-warning"></i> Tugas Petugas Informasi:</h5>
                <ol class="ps-3 mb-0 small text-justify">
                    <li class="mb-2">Menyiapkan formulir aplikasi permohonan Informasi;</li>
                    <li class="mb-2">Menerima aplikasi permohonan Informasi;</li>
                    <li class="mb-2">Melakukan verifikasi data pemohon;</li>
                    <li class="mb-2">Melakukan verifikasi Informasi yang diminta (Informasi yang terbuka atau dikecualikan);</li>
                    <li class="mb-2">Registrasi pencatatan permintaan Informasi dalam buku besar setelah selesai verifikasi;</li>
                    <li class="mb-2">Memproses lanjut Informasi ke Pejabat Pengelola dan Informasi dan Dokumentasi;</li>
                    <li class="mb-2">Melakukan pencatatan penomoran surat Informasi yang disampaikan kepada pemohon;</li>
                    <li class="mb-2">Mendokumentasikan dan menyiapkan evaluasi pelaporan layanan Informasi setiap bulan dan setiap akhir tahun; dan</li>
                    <li class="mb-2">Apabila menerima permohonan Informasi yang dikecualikan, wajib meneruskan kepada PPID.</li>
                </ol>
            </div>
        </div>
    </div>
</div>';

        $additional_sections = [
            [
                'title' => 'Diagram Struktur Organisasi',
                'layout' => 'diagram',
                'content' => '<!-- Bagian ini akan dirender dengan template diagram -->'
            ]
        ];

        if (!DB::table('profil_ppids')->where('type', 'struktur')->exists()) {
            DB::table('profil_ppids')->insert([
                'type'           => 'struktur',
                'judul'          => 'Struktur Organisasi PPID',
                'tagline_hero'   => 'Pejabat Pengelola Informasi dan Dokumentasi',
                'konten_pembuka' => '<p>Struktur organisasi PPID PKTJ dibentuk berdasarkan Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>',
                'gambaran'       => 'Struktur organisasi dan susunan tim kerja Pejabat Pengelola Informasi dan Dokumentasi (PPID) di lingkungan Politeknik Keselamatan Transportasi Jalan (PKTJ).',
                'konten_detail'  => $defaultStrukturTugas,
                'additional_sections' => json_encode($additional_sections),
            ]);
        }

        $visiMisiHtmlPembuka = '<div class="vision-banner p-4 p-md-5 rounded-4 text-center mb-5" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); color: white; border: 2px solid rgba(255, 193, 7, 0.3);">
    <div class="badge bg-warning text-dark px-3.5 py-2 rounded-pill fw-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
        <i class="fas fa-compass me-1.5"></i> Visi PPID PKTJ Tegal
    </div>
    <h3 class="outfit fw-black text-white mb-3" style="font-size: 1.85rem; line-height: 1.4;">
        "Terwujudnya Pelayanan Informasi Publik Politeknik Keselamatan Transportasi Jalan yang Transparan, Objektif, dan Prima Guna Mendukung Tata Kelola Pendidikan Tinggi Vokasi yang Berintegritas dan Berkelanjutan"
    </h3>
    <p class="text-white text-opacity-85 mb-0 mx-auto" style="max-width: 850px; font-size: 14.5px;">
        Berlandaskan semangat keterbukaan informasi dan pelayanan prima di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan Republik Indonesia.
    </p>
</div>

<div class="misi-section mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #e0e7ff; color: #002b5c; font-size: 20px;">
            <i class="fas fa-bullseye"></i>
        </div>
        <div>
            <h4 class="outfit fw-bold text-dark mb-0" style="font-size: 1.45rem;">Misi Pelayanan Informasi Publik</h4>
            <span class="text-muted small">Empat pilar pelaksanaan mandat keterbukaan informasi di lingkungan PKTJ Tegal</span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">1</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Pelayanan Cepat, Tepat Waktu & Bebas Biaya (Rp 0)</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Menyelenggarakan pelayanan informasi publik yang profesional, cepat, proporsional, dan tanpa pungutan biaya sesuai standar perundang-undangan KIP.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">2</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Modernisasi Sistem Digital & Aksesibilitas Disabilitas</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Membangun dan mengembangkan infrastruktur portal informasi publik mandiri yang mudah diakses 24/7 serta dilengkapi fasilitas inklusif bagi penyandang disabilitas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">3</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Peningkatan Kompetensi & Integritas Pengelola</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Meningkatkan kualitas sumber daya manusia pengelola PPID PKTJ melalui bimbingan teknis, pelatihan kearsipan, dan penguatan integritas anti-korupsi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">4</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Sinergi Tata Kelola Kemenhub Terintegrasi</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Memperkuat koordinasi dan harmonisasi pengelolaan data satu pintu antara PPID UPT PKTJ Tegal, PPID BPSDM Perhubungan, dan PPID Utama Kementerian Perhubungan.</p>
                </div>
            </div>
        </div>
    </div>
</div>';

        $visiMisiHtmlDetail = '<div class="principles-section mt-5 pt-4 border-top">
    <div class="text-center mb-4">
        <span class="badge bg-light text-primary border px-3 py-1.5 rounded-pill fw-bold text-uppercase" style="font-size: 11.5px; letter-spacing: 1px;">
            <i class="fas fa-gem text-warning me-1"></i> Nilai-Nilai Dasar Pelayanan
        </span>
        <h3 class="outfit fw-black text-dark mt-2 mb-1" style="font-size: 1.75rem;">Prinsip Utama: Transparan, Objektif, dan Prima</h3>
        <p class="text-muted small mx-auto mb-0" style="max-width: 700px;">Komitmen penyelenggaraan keterbukaan informasi publik di Politeknik Keselamatan Transportasi Jalan Tegal</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #0284c7 !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(2, 132, 199, 0.12); color: #0284c7; font-size: 26px;">
                    <i class="fas fa-door-open"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">TRANSPARAN</h4>
                <div class="badge bg-info bg-opacity-25 text-info px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Keterbukaan Berintegritas</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Memberikan akses terbuka, mudah, dan seluas-luasnya kepada masyarakat dan pemohon informasi publik mengenai penyelenggaraan pendidikan vokasi, realisasi anggaran DIPA, pengadaan barang dan jasa, serta akuntabilitas kinerja PKTJ Tegal tanpa birokrasi yang berbelit.
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #16a34a !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(22, 163, 74, 0.12); color: #16a34a; font-size: 26px;">
                    <i class="fas fa-scale-balanced"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">OBJEKTIF</h4>
                <div class="badge bg-success bg-opacity-25 text-success px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Akurat & Bebas Bias</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Menyajikan informasi dan dokumentasi publik berbasis data faktual yang valid, teruji kebenarannya, bebas dari manipulasi, serta tidak memihak demi menjaga netralitas aparatur dan mengutamakan kepentingan keselamatan transportasi jalan nasional.
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #d97706 !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(217, 119, 6, 0.12); color: #d97706; font-size: 26px;">
                    <i class="fas fa-award"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">PRIMA</h4>
                <div class="badge bg-warning bg-opacity-25 text-amber-700 px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Responsif & Inklusif</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Mengedepankan keramahan layanan (Hospitality), pemenuhan respon cepat maksimal 10 hari kerja (+7 hari perpanjangan), pemanfaatan portal teknologi digital mandiri, serta penyediaan fasilitas fisik yang ramah disabilitas (Text-to-Speech, Bisindo, Braille).
                </p>
            </div>
        </div>
    </div>
</div>';

        foreach (['visi', 'visi-misi'] as $vType) {
            DB::table('profil_ppids')->updateOrInsert(
                ['type' => $vType],
                [
                    'judul'          => 'Visi & Misi PPID PKTJ Tegal',
                    'tagline_hero'   => 'Landasan Komitmen Keterbukaan Informasi Publik yang Transparan, Objektif, dan Prima',
                    'konten_pembuka' => $visiMisiHtmlPembuka,
                    'judul_sub'      => 'Prinsip Penyelenggaraan Layanan Informasi Publik',
                    'konten_detail'  => $visiMisiHtmlDetail,
                ]
            );
        }

        if (!DB::table('profil_ppids')->where('type', 'tugas')->exists()) {
            DB::table('profil_ppids')->insert([
                'type'           => 'tugas',
                'judul'          => 'Tugas & Tanggung Jawab',
                'tagline_hero'   => '',
                'konten_pembuka' => '',
                'gambaran'       => '',
                'konten_detail'  => '',
                'judul_sub'      => '',
                'gambar'         => null,
                'link_dokumen'   => null,
            ]);
        }

        if (!DB::table('profil_ppids')->where('type', 'regulasi')->exists()) {
            DB::table('profil_ppids')->insert([
                'type'           => 'regulasi',
                'judul'          => 'Regulasi PPID',
                'tagline_hero'   => 'Landasan Hukum dan Peraturan Keterbukaan Informasi Publik',
                'konten_pembuka' => '<p style="text-align: justify;">Pelayanan informasi publik di lingkungan Politeknik Keselamatan Transportasi Jalan (PKTJ) berlandaskan pada peraturan perundang-undangan berikut:</p>',
                'gambaran'       => 'Landasan hukum utama penyelenggaraan keterbukaan informasi di PKTJ.',
                'konten_detail'  => '<ul><li style="text-align: justify; margin-bottom: 8px;"><strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik (UU KIP).</li><li style="text-align: justify; margin-bottom: 8px;"><strong>Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018</strong> tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</li><li style="text-align: justify; margin-bottom: 8px;"><strong>Keputusan Direktur PKTJ Nomor KP-PKTJ 32 Tahun 2024</strong> tentang Pejabat Pengelola Informasi dan Dokumentasi (PPID) Politeknik Keselamatan Transportasi Jalan.</li></ul>',
            ]);
        }

        if (!DB::table('profil_ppids')->where('type', 'kontak')->exists()) {
            DB::table('profil_ppids')->insert([
                'type'           => 'kontak',
                'judul'          => 'Hubungi Kami',
                'tagline_hero'   => 'Kontak Resmi PPID PKTJ',
                'konten_pembuka' => '<p style="text-align: justify;">Jika Anda memiliki pertanyaan, permohonan informasi, saran, atau pengaduan mengenai layanan kami, silakan hubungi kami melalui saluran resmi berikut:</p>',
                'gambaran'       => 'Saluran resmi komunikasi PPID Politeknik Keselamatan Transportasi Jalan.',
                'konten_detail'  => '<ul><li style="margin-bottom: 8px;"><strong>Email:</strong> pktj@pktj.ac.id</li><li style="margin-bottom: 8px;"><strong>Telepon (Hotline):</strong> (0283) 351061</li><li style="margin-bottom: 8px;"><strong>Fax:</strong> (0283) 358965</li><li style="margin-bottom: 8px;"><strong>Alamat Kampus I:</strong> Jl. Perintis Kemerdekaan No. 17, Kota Tegal, Jawa Tengah</li></ul>',
            ]);
        }

        // Restore default video background configuration
        // NOTE: File video di cPanel bernama hero_vid_1780650873.mp4
        DB::table('dashboards')->updateOrInsert(
            ['key' => 'hero_video_file'],
            [
                'value' => 'dashboard/hero_vid_1780650873.mp4',
                'type'  => 'text',
                'aktif' => true
            ]
        );
        DB::table('dashboards')->updateOrInsert(
            ['key' => 'hero_video_link'],
            [
                'value' => '',
                'type'  => 'text',
                'aktif' => true
            ]
        );
    }
}
