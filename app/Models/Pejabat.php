<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 'pejabats';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'tempat_tanggal_lahir',
        'foto',
        'biografi',
        'pendidikan',
        'riwayat_jabatan',
        'penghargaan',
        'lhkpn_link',
        'lhkpn_file',
        'lhkpn_tahun',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'pendidikan' => 'array',
        'riwayat_jabatan' => 'array',
        'penghargaan' => 'array',
        'aktif' => 'boolean',
        'urutan' => 'integer'
    ];
}
