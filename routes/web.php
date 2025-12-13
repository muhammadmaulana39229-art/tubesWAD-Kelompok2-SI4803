<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController; 

Route::get('/', function () {
    return view('welcome');
});

// Auth routes sederhana
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Dummy login - login user pertama
    $user = \App\Models\User::first();
    if ($user) {
        auth()->login($user);
        return redirect('/kategori');
    }
    return back()->withErrors(['msg' => 'No user found']);
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    $data = request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    auth()->login($user);
    return redirect('/kategori');
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// ...

Route::middleware(['auth'])->group(function () {
    
    // Rute untuk Kegiatan (dari tugas sebelumnya)
    Route::resource('kegiatan', KegiatanController::class); 

    // Rute Resource untuk CRUD Kategori (Tugas Anda)
    Route::resource('kategori', KategoriController::class)->except(['show']); 

    // Tambahkan route show untuk melihat detail kategori dan kegiatannya
    Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
});