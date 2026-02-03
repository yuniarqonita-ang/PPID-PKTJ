<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'dokumens';

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     * Disesuaikan dengan form upload kamu
     */
    protected $fillable = [
        'judul',
        'file_path',
        'kategori',
        'user_id'
    ];

    /**
     * Relasi Estetik: Menghubungkan Dokumen dengan User (Admin)
     * Jadi kita tahu siapa yang upload dokumennya
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper Estetik: Biar kategori gak kosong kalau lupa diisi
     */
    public function getKategoriAttribute($value)
    {
        return $value ?? 'Umum';
    }
}