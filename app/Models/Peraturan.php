<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peraturan extends Model
{
    use HasFactory;

    protected $table = 'peraturans';

    protected $fillable = [
        'judul',
        'nomor',
        'tahun',
        'deskripsi',
        'file_path',
        'link_download',
        'file_name',
        'kategori',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'tahun' => 'integer',
        'urutan' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}

