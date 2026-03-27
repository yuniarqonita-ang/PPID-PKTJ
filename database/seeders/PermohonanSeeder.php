<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PermohonanSeeder extends Seeder
{
    public function run()
    {
        $permohonans = [
            [
                'username' => 'johndoe',
                'nama_pemohon' => 'John Doe',
                'jenis_identitas' => 'ktp',
                'nomor_identitas' => '3328000011112222',
                'alamat' => 'Jl. Pahlawan No. 1, Tegal',
                'nomor_telepon' => '081234567890',
                'pekerjaan' => 'Mahasiswa',
                'perusahaan_instansi' => 'Universitas Tegal',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'jenis_informasi' => 'Data Statistik Kecelakaan',
                'deskripsi_permohonan' => 'Memohon data statistik kecelakaan lalu lintas di jalan pantura Tegal tahun 2025 untuk keperluan penelitian skripsi.',
                'format_informasi' => 'digital',
                'status' => 'pending',
                'tanggal_permohonan' => Carbon::now()->subDays(2),
            ],
            [
                'username' => 'janedoe',
                'nama_pemohon' => 'Jane Doe',
                'jenis_identitas' => 'ktp',
                'nomor_identitas' => '3328000033334444',
                'alamat' => 'Jl. Merdeka No. 45, Brebes',
                'nomor_telepon' => '089876543210',
                'pekerjaan' => 'Wartawan',
                'perusahaan_instansi' => 'Media Pantura News',
                'email' => 'janedoe@example.com',
                'password' => Hash::make('password123'),
                'jenis_informasi' => 'Laporan Keuangan',
                'deskripsi_permohonan' => 'Meminta salinan laporan keuangan PKTJ tahun anggaran 2024.',
                'format_informasi' => 'keduanya',
                'status' => 'diproses',
                'tanggal_permohonan' => Carbon::now()->subDays(5),
            ],
            [
                'username' => 'budisantoso',
                'nama_pemohon' => 'Budi Santoso',
                'jenis_identitas' => 'sim',
                'nomor_identitas' => '12345678901234',
                'alamat' => 'Jl. Sudirman No. 12, Pemalang',
                'nomor_telepon' => '081122334455',
                'pekerjaan' => 'Wiraswasta',
                'perusahaan_instansi' => 'PT Trans Logistics',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'jenis_informasi' => 'Aturan Trayek Kendaraan',
                'deskripsi_permohonan' => 'Informasi mengenai aturan terbaru perizinan trayek angkutan barang.',
                'format_informasi' => 'cetak',
                'status' => 'selesai',
                'tanggal_permohonan' => Carbon::now()->subDays(10),
            ]
        ];

        foreach ($permohonans as $data) {
            Permohonan::updateOrCreate(
                ['username' => $data['username']],
                $data
            );
        }
    }
}
