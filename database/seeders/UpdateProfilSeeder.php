<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProfilSeeder extends Seeder
{
    public function run()
    {
        // ±300 kata - sesuai permintaan, mengacu pada profil ppid.dephub.go.id
        $profil = "Sejak diberlakukannya Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik (UU KIP) secara efektif pada tanggal 30 April 2010, seluruh badan publik di Indonesia didorong untuk mengambil satu langkah maju ke depan — menjadi lebih transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP merupakan instrumen hukum yang mengikat dan menjadi tonggak bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh badan publik.

Keterbukaan informasi adalah salah satu pilar penting yang mendorong terciptanya tata kelola pemerintahan yang baik (good governance). Melalui keterbukaan ini, masyarakat dapat berperan aktif dalam proses pengambilan kebijakan serta mengawasi penyelenggaraan layanan publik yang dijalankan oleh Politeknik Keselamatan Transportasi Jalan (PKTJ) selaku Unit Pelaksana Teknis (UPT) di bawah Direktorat Jenderal Perhubungan Darat, Kementerian Perhubungan Republik Indonesia.

Dalam rangka memenuhi amanat UU KIP, PKTJ membentuk Pejabat Pengelola Informasi dan Dokumentasi (PPID). PPID PKTJ bertugas merencanakan, mengorganisasikan, melaksanakan, dan mengawasi pengelolaan informasi dan dokumentasi di lingkungan PKTJ. PPID bertanggung jawab dalam menyimpan, mendokumentasikan, menyediakan, dan memberikan pelayanan informasi kepada publik dengan cepat, tepat waktu, dan dengan biaya yang terjangkau.

Visi PPID PKTJ adalah terwujudnya pelayanan informasi publik yang terbuka, mudah diakses, tepat waktu, dan dapat dipertanggungjawabkan. Hal ini sejalan dengan komitmen PKTJ sebagai institusi pendidikan vokasi di bidang keselamatan transportasi jalan yang terus mengutamakan nilai integritas dan profesionalisme dalam setiap aspek layanan kepada masyarakat.

Kami berkomitmen untuk terus meningkatkan kualitas pelayanan informasi publik. Dengan mengedepankan prinsip transparansi dan akuntabilitas, PPID PKTJ berupaya menyediakan informasi yang akurat, mutakhir, dan mudah diakses oleh seluruh elemen masyarakat, sehingga kepercayaan publik terhadap institusi dapat terus terjaga dan ditingkatkan.";

        DB::table('profil_ppids')->updateOrInsert(
            ['type' => 'profil'],
            [
                'judul'          => 'Profil PPID',
                'konten_pembuka' => $profil,
                'gambaran'       => 'Berkomitmen menyelenggarakan pelayanan informasi publik yang transparan, akuntabel, dan profesional di lingkungan Politeknik Keselamatan Transportasi Jalan (PKTJ).',
                'konten_detail'  => '',
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
                            <li class="mb-2">Menyediakan informasi secara baik dan efisien sehingga dapat diakses dengan mudah;</li>
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

        DB::table('profil_ppids')->updateOrInsert(
            ['type' => 'struktur'],
            [
                'judul'          => 'Struktur Organisasi PPID',
                'tagline_hero'   => 'Pejabat Pengelola Informasi dan Dokumentasi',
                'konten_pembuka' => '<p>Struktur organisasi PPID PKTJ dibentuk berdasarkan Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>',
                'gambaran'       => 'Struktur organisasi dan susunan tim kerja Pejabat Pengelola Informasi dan Dokumentasi (PPID) di lingkungan Politeknik Keselamatan Transportasi Jalan (PKTJ).',
                'konten_detail'  => $defaultStrukturTugas,
            ]
        );
    }
}
