<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\KategoriController; 
=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TugasController; 
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengingatController;
use App\Http\Controllers\CatatanTambahanController; 
>>>>>>> d5a87523935a17113be7e35bf27390ecbe94dc1f

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<<<<<<< HEAD
// ...

Route::middleware(['auth'])->group(function () {
    
    // Rute Resource untuk CRUD Kategori (Tugas Anda)
    Route::resource('kategori', KategoriController::class)->except(['show']); 

    // Tambahkan route show untuk melihat detail kategori dan kegiatannya
    Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
});
=======
Route::resource('kegiatan', KegiatanController::class);
>>>>>>> d5a87523935a17113be7e35bf27390ecbe94dc1f
