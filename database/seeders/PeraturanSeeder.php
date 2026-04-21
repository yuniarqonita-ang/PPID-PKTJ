<?php

namespace Database\Seeders;

use App\Models\Peraturan;
use Illuminate\Database\Seeder;

class PeraturanSeeder extends Seeder
{
    public function run(): void
    {
        $peraturanData = [
            // Undang-Undang
            ['judul' => 'Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik', 'kategori' => 'Undang-Undang', 'is_active' => true],
            ['judul' => 'Undang-Undang Nomor 43 Tahun 2009 tentang Kearsipan', 'kategori' => 'Undang-Undang', 'is_active' => true],
            ['judul' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik', 'kategori' => 'Undang-Undang', 'is_active' => true],
            ['judul' => 'Undang-Undang Nomor 40 Tahun 1999 tentang Pers', 'kategori' => 'Undang-Undang', 'is_active' => true],
            
            // Komisi Informasi Pusat
            ['judul' => 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2021 Tentang Standar Layanan Informasi Publik', 'kategori' => 'Komisi Informasi Pusat', 'is_active' => true],
            ['judul' => 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2013 Tentang Prosedur Penyelesaian Sengketa Informasi Publik', 'kategori' => 'Komisi Informasi Pusat', 'is_active' => true],
            
            // Kementerian Perhubungan
            ['judul' => 'Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan', 'kategori' => 'Kementerian Perhubungan', 'is_active' => true],
            ['judul' => 'Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang SOP Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan', 'kategori' => 'Kementerian Perhubungan', 'is_active' => true],
            ['judul' => 'Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 25 Tahun 2024 tentang Daftar Informasi Publik Tahun 2024', 'kategori' => 'Kementerian Perhubungan', 'is_active' => true],
            ['judul' => 'Keputusan Sekretaris Jenderal Kementerian Perhubungan Nomor KP-SKJ 24 Tahun 2024 tentang Perubahan Atas Keputusan Sekretaris Jenderal Nomor KP 591 Tahun 2023 tentang Informasi yang Dikecualikan', 'kategori' => 'Kementerian Perhubungan', 'is_active' => true],
        ];

        foreach ($peraturanData as $data) {
            Peraturan::firstOrCreate(['judul' => $data['judul']], $data);
        }
    }
}
