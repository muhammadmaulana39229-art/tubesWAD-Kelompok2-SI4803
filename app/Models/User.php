<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Tugas;
use App\Models\Kegiatan;
use App\Models\Pengingat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function pengingats()
    {
        return $this->hasMany(Pengingat::class);
    }
}
