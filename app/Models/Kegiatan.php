<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'lokasi'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
    ];
    
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

   public function index()
    {
        $kegiatan = Kegiatan::where('user_id', auth()->id())->get();
        return view('kegiatan.index', compact('kegiatan'));
    }
}
