<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPpid extends Model
{
    use HasFactory;

    protected $table = 'profil_ppids';

    protected $guarded = ['id'];

    /**
     * Helper untuk mengambil URL gambar
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/profil/' . $this->gambar);
        }
        // Gambar default jika kosong
        return asset('images/no-image.png');
    }
}