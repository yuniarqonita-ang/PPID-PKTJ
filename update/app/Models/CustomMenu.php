<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'nama',
        'slug',
        'url',
        'konten',
        'is_editor',
        'is_table',
        'is_chart',
        'is_form',
        'aktif',
        'urutan',
        'penempatan',
    ];

    protected $casts = [
        'is_editor' => 'boolean',
        'is_table' => 'boolean',
        'is_chart' => 'boolean',
        'is_form' => 'boolean',
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Parent Menu relation
     */
    public function parent()
    {
        return $this->belongsTo(CustomMenu::class, 'parent_id');
    }

    /**
     * Sub Menus relation
     */
    public function children()
    {
        return $this->hasMany(CustomMenu::class, 'parent_id')->orderBy('urutan', 'asc');
    }

    /**
     * Boot function to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->nama);
            }
        });
    }
}
