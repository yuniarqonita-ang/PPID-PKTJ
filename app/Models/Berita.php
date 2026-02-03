<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'beritas';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori_id',
        'is_published',
        'views'
    ];

    /**
     * Otomatis membuat slug dari judul saat menyimpan berita.
     * Contoh: "Berita Hari Ini" jadi "berita-hari-ini"
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    /**
     * Relasi ke Kategori (Jika nanti ada tabel kategoris)
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Helper untuk mengambil URL gambar berita
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/berita/' . $this->gambar);
        }
        return asset('images/no-image.png');
    }
}