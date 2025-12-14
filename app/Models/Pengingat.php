<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengingat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'waktu_pengingat',
        'status_muncul',
    ];

    protected $casts = [
        'waktu_pengingat' => 'datetime', 
        'status_muncul' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
