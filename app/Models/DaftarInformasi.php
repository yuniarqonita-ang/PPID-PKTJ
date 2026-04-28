<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarInformasi extends Model
{
    use HasFactory;

    protected $table = 'daftar_informasis';

    protected $fillable = [
        'judul_informasi',
        'kategori',
        'tipe_informasi',
        'isi_informasi',
        'pejabat_penguasa',
        'penanggung_jawab',
        'waktu_pembuatan',
        'bentuk_informasi',
        'jangka_waktu',
        'file_informasi',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
