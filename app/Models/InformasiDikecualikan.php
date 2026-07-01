<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiDikecualikan extends Model
{
    protected $table = 'informasi_dikecualikans';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'dasar_hukum',
        'konsekuensi_dibuka',
        'konsekuensi_ditutup',
        'jangka_waktu',
        'penanggung_jawab',
        'aktif',
        'is_blurred',
        'bisa_download'
    ];
    
    protected $casts = [
        'aktif'   => 'boolean',
        'is_blurred' => 'boolean',
        'bisa_download' => 'boolean',
        'tanggal' => 'date',
    ];
}
