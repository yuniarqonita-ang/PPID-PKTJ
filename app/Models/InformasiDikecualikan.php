<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiDikecualikan extends Model
{
    protected $table = 'informasi_dikecualikans';
    
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
