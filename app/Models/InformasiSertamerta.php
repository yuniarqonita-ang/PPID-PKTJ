<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSertaMerta extends Model
{
    protected $table = 'informasi_serta_mertas';
    
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
