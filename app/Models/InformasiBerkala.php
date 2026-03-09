<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiBerkala extends Model
{
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
