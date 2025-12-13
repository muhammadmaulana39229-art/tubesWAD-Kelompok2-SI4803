<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\KategoriController; 
// ...

Route::middleware(['auth'])->group(function () {
    
    // Rute untuk Kegiatan (dari tugas sebelumnya)
    Route::resource('kegiatan', KegiatanController::class); 

    // Rute Resource untuk CRUD Kategori (Tugas Anda)
    Route::resource('kategori', KategoriController::class)->except(['show']); 

    // ... rute lainnya
});