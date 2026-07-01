<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSetiapSaat extends Model
{
    protected $table = 'informasi_setiapsaats';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'file_path',
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
    ];
}
