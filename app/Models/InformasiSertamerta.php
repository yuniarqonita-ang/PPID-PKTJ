<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSertaMerta extends Model
{
    protected $table = 'informasi_sertamertas';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean',
    ];
}
