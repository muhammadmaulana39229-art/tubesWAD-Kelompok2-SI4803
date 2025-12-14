<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;

Route::resource('tugas', TugasController::class);

Route::get('/', function () {
    return view('welcome');
});
