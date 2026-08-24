<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'jenis_identitas',
        'nomor_identitas',
        'file_identitas',
        'alamat',
        'no_telp',
        'pekerjaan',
        'instansi',
        'status_verifikasi',
        'catatan_verifikasi',
        'role',
    ];

    public function permohonans()
    {
        return $this->hasMany(Permohonan::class, 'user_id');
    }

    public function isVerified(): bool
    {
        return $this->status_verifikasi === 'verified' || $this->role === 'admin';
    }

    public function isPending(): bool
    {
        return $this->status_verifikasi === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status_verifikasi === 'rejected';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
