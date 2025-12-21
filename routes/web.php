<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TugasController; 
use App\Http\Controllers\PengingatController;
use App\Http\Controllers\CatatanTambahanController; 

Route::get('/', function () {
    // Jika pengguna sudah login, langsung arahkan ke Dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Jika belum login, arahkan ke halaman login
    return view('auth.login'); 
});

// Otomatis membuat rute untuk Login dan Register
Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tugas', TugasController::class);

    Route::resource('kategori', KategoriController::class);

    Route::resource('pengingat', PengingatController::class);

    Route::resource('kegiatan', KegiatanController::class);

    Route::resource('catatan', CatatanTambahanController::class)->names([
        'index' => 'catatan.index',
        'create' => 'catatan.create',
        'store' => 'catatan.store',
        'show' => 'catatan.show',
        'edit' => 'catatan.edit',
        'update' => 'catatan.update',
        'destroy' => 'catatan.destroy',
    ]);
});
Auth::routes();
