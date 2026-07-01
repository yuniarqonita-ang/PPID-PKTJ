<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Seed the three SOP documents into the dokumens table
        if (Schema::hasTable('dokumens')) {
            $sops = [
                [
                    'judul' => 'SOP Pelaporan Kegiatan (SPI)',
                    'deskripsi' => '<p>Prosedur pelaporan kegiatan internal oleh Satuan Pemeriksaan Intern</p>',
                    'file_path' => 'https://drive.google.com/file/d/1rjOLvAAZi4Df5JbYUI7ehqkIA0SxJmp7/view',
                    'file_name' => 'Link Google Drive',
                    'file_size' => '-',
                    'file_type' => 'gdrive',
                    'kategori' => 'SOP Pendokumentasian Informasi Publik',
                    'aktif' => true,
                    'bisa_download' => false,
                    'is_blurred' => false,
                    'tanggal' => '2026-06-11',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'judul' => 'SOP Audit Kinerja (SPI)',
                    'deskripsi' => '<p>Prosedur audit kinerja operasional di lingkungan PKTJ</p>',
                    'file_path' => 'https://drive.google.com/file/d/1MrFh943kq-nfi5KogndwEfsBw6ePkP74/view',
                    'file_name' => 'Link Google Drive',
                    'file_size' => '-',
                    'file_type' => 'gdrive',
                    'kategori' => 'SOP Pendokumentasian Informasi Publik',
                    'aktif' => true,
                    'bisa_download' => false,
                    'is_blurred' => false,
                    'tanggal' => '2026-06-11',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'judul' => 'SOP Pengusulan Diklat (SPI)',
                    'deskripsi' => '<p>Prosedur pengusulan program pendidikan dan pelatihan</p>',
                    'file_path' => 'https://drive.google.com/file/d/18MVB1TaWjESUO-ngOYIFUB6hqks5A6Ub/view',
                    'file_name' => 'Link Google Drive',
                    'file_size' => '-',
                    'file_type' => 'gdrive',
                    'kategori' => 'SOP Pendokumentasian Informasi Publik',
                    'aktif' => true,
                    'bisa_download' => false,
                    'is_blurred' => false,
                    'tanggal' => '2026-06-11',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            foreach ($sops as $sop) {
                // Check if already exists to avoid duplicates
                $exists = DB::table('dokumens')->where('judul', $sop['judul'])->where('kategori', $sop['kategori'])->exists();
                if (!$exists) {
                    DB::table('dokumens')->insert($sop);
                }
            }
        }

        // 2. Clean the hardcoded HTML lists from setting dashboards
        if (Schema::hasTable('dashboards')) {
            $key = 'sop_pendokumentasian_isi_konten';
            $existing = DB::table('dashboards')->where('key', $key)->first();
            if ($existing) {
                $val = $existing->value;
                if (strpos($val, 'list-group') !== false) {
                    // Let's replace the entire value with a clean introduction
                    DB::table('dashboards')->where('key', $key)->update([
                        'value' => '<p>Berikut adalah beberapa dokumen Standar Operasional Prosedur (SOP) internal yang terdokumentasi di lingkungan PKTJ:</p>',
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No loss
    }
};
