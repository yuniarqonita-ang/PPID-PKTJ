<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keberatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tanggal_keberatan' => 'date',
        'tanggal_tanggapan_keberatan' => 'date',
        'alasan_keberatan_list' => 'array',
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }
}
