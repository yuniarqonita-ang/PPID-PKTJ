<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prosedur extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'kategori',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean',
    ];
}
