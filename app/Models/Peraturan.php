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
        'deskripsi',
        'file_path',
        'kategori',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}

