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
        'link_sumber',
        'guid',
        'is_external',
        'konten',
        'gambar',
        'kategori',
        'kategori_id',
        'user_id',
        'status',
        'published_at',
        'tanggal',
        'is_published',
        'aktif',
        'is_blurred',
        'views',
        'tags'
    ];

    /**
     * Otomatis membuat slug dari judul saat menyimpan berita.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul) . '-' . time();
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
            if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
                return $this->gambar;
            }
            if (str_starts_with($this->gambar, 'berita/')) {
                return asset('storage/' . $this->gambar);
            }
            return asset('storage/berita/' . $this->gambar);
        }
        return 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=800';
    }

    /**
     * Helper untuk mengambil link berita tujuan
     */
    public function getUrlBeritaAttribute()
    {
        if ($this->link_sumber && ($this->is_external || filter_var($this->link_sumber, FILTER_VALIDATE_URL))) {
            return $this->link_sumber;
        }
        return url('/berita/' . $this->slug);
    }
}