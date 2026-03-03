<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'tipe',
        'judul',
        'konten',
        'gambar',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean',
    ];
    
    // Get content by type
    public static function getByType($type)
    {
        return static::where('tipe', $type)->where('aktif', true)->first();
    }
}
