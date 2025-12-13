<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'warna',
    ];

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi ke Kegiatan */
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    // Tambahkan relasi ke Tugas (akan dibuat oleh Muhammad Aditya Wildan)
    // public function tugas()
    // {
    //     return $this->hasMany(Tugas::class);
    // }
}