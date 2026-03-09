<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiDikecualikan extends Model
{
    protected $table = 'informasi_dikecualikans';
    
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
