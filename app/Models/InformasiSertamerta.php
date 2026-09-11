<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSertaMerta extends Model
{
    protected $table = 'informasi_sertamertas';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'file_path',
        'tautan_links',
        'pejabat_penguasa',
        'penanggung_jawab',
        'penerbit_informasi',
        'bentuk_informasi',
        'tempat_pembuatan',
        'waktu_pembuatan',
        'jangka_waktu',
        'file_name',
        'file_size',
        'file_type',
        'aktif',
        'is_blurred',
        'bisa_download'
    ];
    
    protected $casts = [
        'aktif'   => 'boolean',
        'is_blurred' => 'boolean',
        'bisa_download' => 'boolean',
        'tanggal' => 'date',
        'tautan_links' => 'array',
    ];
}
