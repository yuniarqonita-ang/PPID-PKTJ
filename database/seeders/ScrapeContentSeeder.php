<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProfilPpid;

class ScrapeContentSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            'profil' => 'profil-ppid.blade.php',
            'tugas' => 'profil-tugas-tanggung-jawab.blade.php',
            'visi' => 'profil-visi-misi.blade.php',
            'struktur' => 'profil-struktur-organisasi.blade.php',
            'regulasi' => 'profil-regulasi.blade.php',
            'kontak' => 'profil-kontak.blade.php',
            'maklumat-pelayanan' => 'maklumat-pelayanan.blade.php',
            'sop-permintaan' => 'sop-permintaan.blade.php',
            'sop-keberatan' => 'sop-penanganan-keberatan.blade.php',
            'sop-sengketa' => 'sop-sengketa.blade.php',
            'sop-penetapan' => 'sop-pemutakhiran-daftar.blade.php',
            'sop-pengujian' => 'sop-pengujian-konsekuensi.blade.php',
            'sop-pendokumentasian' => 'sop-pendokumentasian.blade.php',
            'laporan-layanan' => 'laporan-layanan-informasi.blade.php',
            'laporan-akses' => 'laporan-akses-informasi-publik.blade.php',
            'laporan-survey' => 'laporan-survey-kepuasan.blade.php',
        ];

        foreach ($pages as $type => $file) {
            $filePath = resource_path("views/$file");
            if (!file_exists($filePath)) {
                $this->command->warn("File $file not found. Skipping...");
                continue;
            }

            $content = file_get_contents($filePath);
            
            $payload = [
                'type' => $type,
                'judul' => ucfirst(str_replace('-', ' ', $type)),
                'konten_pembuka' => '',
                'konten_detail' => '',
            ];

            if ($type == 'profil') {
                $payload['judul'] = 'Profil PPID';
                $payload['tagline_hero'] = 'PROFIL PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI';
                if (preg_match('/<!-- SECTION: PROFILE PPID -->.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>/s', $content, $matches)) {
                    $payload['konten_pembuka'] = "<p>{$matches[1]}</p><p>{$matches[2]}</p>";
                }
                if (preg_match('/<!-- SECTION: GAMBARAN SINGKAT PPID -->.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>/s', $content, $matches)) {
                    $payload['konten_detail'] = "<p>{$matches[1]}</p><p>{$matches[2]}</p><p>{$matches[3]}</p>";
                }
                $payload['judul'] = 'GAMBARAN SINGKAT PEMBENTUKAN PPID KEMENHUB';
            }

            elseif ($type == 'tugas') {
                $payload['judul'] = 'Tugas dan Tanggung Jawab PPID';
                if (preg_match('/<ol class="task-list">(.*?)<\/ol>/s', $content, $matches)) {
                    $payload['konten_pembuka'] = "<ol class=\"task-list\">{$matches[1]}</ol>";
                }
                if (preg_match('/<table class="responsibility-table">(.*?)<\/table>/s', $content, $matches)) {
                    // Prettify and clean up for dynamic template
                    $table = $matches[1];
                    $payload['konten_detail'] = "<table class=\"table table-bordered shadow-sm\">$table</table>";
                }
            }

            elseif ($type == 'visi') {
                $payload['judul'] = 'Visi dan Misi PPID';
                if (preg_match('/<!-- VISI SECTION -->(.*?)<!-- MISI SECTION -->/s', $content, $matches)) {
                    $payload['konten_pembuka'] = $matches[1];
                }
                if (preg_match('/<!-- MISI SECTION -->(.*?)<\/div>/s', $content, $matches)) {
                    $payload['konten_detail'] = $matches[1];
                }
            }

            elseif ($type == 'struktur') {
                $payload['judul'] = 'Struktur Organisasi';
                if (preg_match('/<div class="org-chart">(.*?)<\/div>.*?<\/div>/s', $content, $matches)) {
                    $payload['konten_detail'] = "<div class=\"org-chart\">{$matches[1]}</div>";
                }
                if (preg_match('/<h2 class="section-title">Dasar Hukum Pembentukan<\/h2>(.*?)<\/div>/s', $content, $matches)) {
                    $payload['konten_pembuka'] = $matches[1];
                }
            }

            elseif ($type == 'regulasi') {
                $payload['judul'] = 'Regulasi PPID';
                if (preg_match('/<ul class="regulation-list">(.*?)<\/ul>/s', $content, $matches)) {
                    $payload['konten_detail'] = "<ul class=\"list-group list-group-flush\">{$matches[1]}</ul>";
                }
            }

            elseif ($type == 'maklumat-pelayanan') {
                $payload['judul'] = 'Maklumat Pelayanan';
                $payload['konten_pembuka'] = '<p>Maklumat Pelayanan merupakan janji penyelenggara pelayanan kepada masyarakat untuk memberikan pelayanan yang berkualitas, mudah, cepat, dan transparan.</p>';
            }

            ProfilPpid::updateOrCreate(['type' => $type], $payload);
            $this->command->info("Imported content for $type");
        }
    }
}
