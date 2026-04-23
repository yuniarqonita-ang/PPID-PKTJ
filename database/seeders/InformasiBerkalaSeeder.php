<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InformasiBerkalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'judul' => 'Laporan Keuangan Tahun 2025',
                'deskripsi' => 'Laporan realisasi anggaran dan neraca keuangan PPID PKTJ Tahun 2025.',
                'file_path' => 'berkala/laporan_keuangan_2025.pdf',
                'file_name' => 'laporan_keuangan_2025.pdf',
                'file_size' => '2.5 MB',
                'file_type' => 'application/pdf',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Daftar Aset dan Inventaris 2025',
                'deskripsi' => 'Daftar aset dan inventaris barang milik negara di lingkungan PKTJ Tegal.',
                'file_path' => 'berkala/daftar_aset_2025.pdf',
                'file_name' => 'daftar_aset_2025.pdf',
                'file_size' => '1.8 MB',
                'file_type' => 'application/pdf',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'judul' => 'Rencana Strategis (Renstra) 2025-2029',
                'deskripsi' => 'Dokumen rencana strategis pengembangan kampus PKTJ periode 2025-2029.',
                'file_path' => 'berkala/renstra_2025_2029.pdf',
                'file_name' => 'renstra_2025_2029.pdf',
                'file_size' => '4.2 MB',
                'file_type' => 'application/pdf',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        \Illuminate\Support\Facades\DB::table('informasi_berkalas')->insert($data);
    }
}
