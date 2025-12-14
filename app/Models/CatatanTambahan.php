<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanTambahan extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'tanggal',
        'libur'
    ];

    // Relasi ke User (Opsional, tapi bagus untuk masa depan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}