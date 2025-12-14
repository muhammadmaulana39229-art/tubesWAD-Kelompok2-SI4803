<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Pastikan AuthController di-import
use App\Http\Controllers\CatatanTambahanController; // Pastikan controller ini di-import

// Route Register & Login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route yang butuh Login (Token)
Route::middleware('auth:sanctum')->group(function () {
    // Ini akan otomatis membuat route: index, store, show, update, destroy
    Route::apiResource('catatan', CatatanTambahanController::class);
});