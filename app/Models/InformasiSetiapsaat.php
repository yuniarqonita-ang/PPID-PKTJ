<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSetiapSaat extends Model
{
    protected $table = 'informasi_setiap_saat';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'konten',
        'dokumen',
        'tanggal',
        'status'
    ];
    
    protected $casts = [
        'status' => 'boolean',
        'tanggal' => 'date',
    ];
}
