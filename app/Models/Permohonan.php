<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'username',
        'nama_pemohon',
        'jenis_identitas',
        'nomor_identitas',
        'alamat',
        'nomor_telepon',
        'pekerjaan',
        'perusahaan_instansi',
        'email',
        'password',
        'jenis_informasi',
        'deskripsi_permohonan',
        'format_informasi',
        'foto_ktp',
        'berkas_pendukung',
        'status',
        'tanggal_permohonan',
        'custom_fields_data',
    ];

    protected $casts = [
        'tanggal_permohonan' => 'datetime',
        'custom_fields_data' => 'array',
    ];
}
