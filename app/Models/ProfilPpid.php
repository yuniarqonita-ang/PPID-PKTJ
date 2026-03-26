<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPpid extends Model
{
    protected $table = 'profil_ppids';

    protected $fillable = [
        'type',
        'judul',
        'tagline_hero',
        'image_hero',
        'konten_pembuka',
        'judul_sub',
        'konten_detail',
        'gambar',
        'link_dokumen',
        'additional_sections',
        'gambaran',
    ];

    protected $casts = [
        'additional_sections' => 'array',
    ];

    // Helper method to get combined content
    public function getCombinedContentAttribute()
    {
        $content = '';
        
        if ($this->konten_pembuka) {
            $content .= $this->konten_pembuka;
        }
        
        if ($this->judul_sub) {
            $content .= '<h2>' . $this->judul_sub . '</h2>';
        }
        
        if ($this->konten_detail) {
            $content .= $this->konten_detail;
        }
        
        return $content;
    }
}