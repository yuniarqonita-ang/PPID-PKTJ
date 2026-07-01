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
        // 1. Migrate Berkala
        if (Schema::hasTable('informasi_berkalas')) {
            $items = DB::table('informasi_berkalas')->get();
            foreach ($items as $item) {
                // Check if already migrated to avoid duplicates
                $exists = DB::table('daftar_informasis')
                    ->where('judul_informasi', $item->judul)
                    ->where('kategori', 'informasi-berkala')
                    ->exists();
                if (!$exists) {
                    DB::table('daftar_informasis')->insert([
                        'judul_informasi' => $item->judul,
                        'kategori'        => 'informasi-berkala',
                        'tipe_informasi'  => 'berkala',
                        'isi_informasi'   => $item->deskripsi,
                        'file_informasi'  => $item->file_path,
                        'aktif'           => $item->aktif,
                        'is_blurred'      => $item->is_blurred ?? false,
                        'bisa_download'   => $item->bisa_download ?? false,
                        'waktu_pembuatan' => $item->tanggal ? date('Y', strtotime($item->tanggal)) : date('Y'),
                        'created_at'      => $item->tanggal ?: now(),
                        'updated_at'      => $item->updated_at ?: now(),
                    ]);
                }
            }
        }

        // 2. Migrate Serta Merta
        if (Schema::hasTable('informasi_sertamertas')) {
            $items = DB::table('informasi_sertamertas')->get();
            foreach ($items as $item) {
                $exists = DB::table('daftar_informasis')
                    ->where('judul_informasi', $item->judul)
                    ->where('kategori', 'informasi-serta-merta')
                    ->exists();
                if (!$exists) {
                    DB::table('daftar_informasis')->insert([
                        'judul_informasi' => $item->judul,
                        'kategori'        => 'informasi-serta-merta',
                        'tipe_informasi'  => 'sertamerta',
                        'isi_informasi'   => $item->deskripsi,
                        'file_informasi'  => $item->file_path,
                        'aktif'           => $item->aktif,
                        'is_blurred'      => $item->is_blurred ?? false,
                        'bisa_download'   => $item->bisa_download ?? false,
                        'waktu_pembuatan' => $item->tanggal ? date('Y', strtotime($item->tanggal)) : date('Y'),
                        'created_at'      => $item->tanggal ?: now(),
                        'updated_at'      => $item->updated_at ?: now(),
                    ]);
                }
            }
        }

        // 3. Migrate Setiap Saat
        if (Schema::hasTable('informasi_setiapsaats')) {
            $items = DB::table('informasi_setiapsaats')->get();
            foreach ($items as $item) {
                $exists = DB::table('daftar_informasis')
                    ->where('judul_informasi', $item->judul)
                    ->where('kategori', 'informasi-setiap-saat')
                    ->exists();
                if (!$exists) {
                    DB::table('daftar_informasis')->insert([
                        'judul_informasi' => $item->judul,
                        'kategori'        => 'informasi-setiap-saat',
                        'tipe_informasi'  => 'setiapsaat',
                        'isi_informasi'   => $item->deskripsi,
                        'file_informasi'  => $item->file_path,
                        'aktif'           => $item->aktif,
                        'is_blurred'      => $item->is_blurred ?? false,
                        'bisa_download'   => $item->bisa_download ?? false,
                        'waktu_pembuatan' => $item->tanggal ? date('Y', strtotime($item->tanggal)) : date('Y'),
                        'created_at'      => $item->tanggal ?: now(),
                        'updated_at'      => $item->updated_at ?: now(),
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
        // Keep empty to prevent accidental loss
    }
};
