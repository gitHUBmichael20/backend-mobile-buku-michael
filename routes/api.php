<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/buku')->group(function () {
    Route::get('/index', [BukuController::class, 'index'])->name('buku.index');
    Route::put('/update/{id_buku}', [BukuController::class, 'update'])->name('buku.rest.update');
    Route::post('/simpan', [BukuController::class, 'store'])->name('buku.store');
    Route::patch('/patch/{id_buku}', [BukuController::class, 'show'])->name('buku.patch');
    Route::delete('/delete/{id_buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
});


Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/login-page', [AuthController::class, 'showLogin'])->name('auth.login.page');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Route::post('/auth/login', [AuthController::class, 'login']);
