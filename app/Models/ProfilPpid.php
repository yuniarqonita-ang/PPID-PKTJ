<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPpid extends Model
{
    protected $table = 'profil_ppids';

    protected $fillable = [
        'judul',
        'konten_pembuka',
        'judul_sub',
        'konten_detail',
    ];
}