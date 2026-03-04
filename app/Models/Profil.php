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
        'status',
        'aktif'
    ];
    
    protected $casts = [
        'status' => 'boolean',
        'aktif' => 'boolean',
    ];
    
    // Get content by type
    public static function getByType($type)
    {
        try {
            return static::where('tipe', $type)->where('status', true)->where('aktif', true)->first();
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika column status tidak ada, gunakan hanya aktif
            if (str_contains($e->getMessage(), 'Unknown column \'status\'')) {
                return static::where('tipe', $type)->where('aktif', true)->first();
            }
            throw $e;
        }
    }
}
