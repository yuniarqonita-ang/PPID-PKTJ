<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'aktif'
    ];
    
    protected $casts = [
        'aktif' => 'boolean',
    ];
    
    // Get value by key
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->where('aktif', true)->first();
        return $setting ? $setting->value : $default;
    }
}
