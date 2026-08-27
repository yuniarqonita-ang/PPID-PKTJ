<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProfilSeeder extends Seeder
{
    public function run()
    {
        $profilTextPembuka = '<p style="text-align: justify; line-height: 1.8; margin-bottom: 16px;">Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai wujud komitmen nyata institusi dalam mengimplementasikan keterbukaan informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Peraturan Komisi Informasi (PerKI) Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik, serta Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
<p style="text-align: justify; line-height: 1.8; margin-bottom: 16px;">Sebagai Unit Pelaksana Teknis (UPT) Pendidikan Tinggi Vokasi di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ menetapkan struktur PPID Pelaksana UPT melalui Surat Keputusan Direktur PKTJ. Pembentukan ini bertujuan memberikan kepastian hak bagi masyarakat, pemohon informasi, dan seluruh pemangku kepentingan untuk memperoleh informasi publik yang cepat, akurat, transparan, dan bebas biaya (Rp 0).</p>';

        $profilTextDetail = '<p style="text-align: justify; line-height: 1.8; margin-bottom: 16px;">Dalam menjalankan perannya, PPID Pelaksana PKTJ berfungsi sebagai koordinator utama pengelolaan dan pelayanan dokumentasi informasi publik yang mendukung penyelenggaraan tridharma perguruan tinggi vokasi keselamatan transportasi jalan, pelaksanaan uji kompetensi teknis, penelitian keselamatan transportasi, serta pengelolaan tata kelola keuangan Badan Layanan Umum (BLU) yang bersih, transparan, dan akuntabel.</p>
<p style="text-align: justify; line-height: 1.8; margin-bottom: 16px;">Pelayanan informasi publik di lingkungan PKTJ diselenggarakan secara terpadu melalui dua saluran: <strong>Layanan Daring (Online)</strong> melalui portal resmi mandiri yang ramah disabilitas (dilengkapi fitur audio Text-to-Speech, mode kontras, dan video bahasa isyarat), serta <strong>Layanan Luring (Offline)</strong> melalui Meja Layanan Terpadu PPID di Kampus I PKTJ Tegal, Jl. Perintis Kemerdekaan No. 17, Kota Tegal, Jawa Tengah.</p>';

        DB::table('profil_ppids')->updateOrInsert(
            ['type' => 'profil'],
            [
                'judul'          => 'Profil PPID PKTJ Tegal',
                'tagline_hero'   => 'Keterbukaan Informasi Publik Menuju Tata Kelola Pendidikan Vokasi yang Transparan dan Akuntabel',
                'konten_pembuka' => $profilTextPembuka,
                'judul_sub'      => 'Peran & Komitmen Pelayanan PPID PKTJ',
                'konten_detail'  => $profilTextDetail,
                'gambaran'       => '<div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-3.5 mb-0" style="background: #eef2ff; color: #002b5c;"><i class="fas fa-shield-halved fa-2x me-3 text-primary"></i><div><strong>Standar Pelayanan PPID PKTJ:</strong> Berkomitmen memberikan pelayanan informasi publik yang cepat, tepat waktu, biaya ringan (Rp 0), serta mudah dijangkau oleh seluruh lapisan masyarakat termasuk penyandang disabilitas.</div></div>',
            ]
        );

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

        if (!DB::table('profil_ppids')->where('type', 'visi')->exists()) {
            DB::table('profil_ppids')->insert([
                'type'           => 'visi',
                'judul'          => 'Visi & Misi',
                'tagline_hero'   => '',
                'konten_pembuka' => '',
                'gambaran'       => '',
                'konten_detail'  => '',
                'judul_sub'      => '',
                'gambar'         => null,
                'link_dokumen'   => null,
            ]);
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
