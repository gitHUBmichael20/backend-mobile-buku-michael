<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Jika pengguna sudah login, arahkan ke index
    if (session('token')) {
        return redirect()->route('buku.index');
    }

    // Jika belum login, arahkan ke login
    return redirect()->route('auth.login.page');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.page');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::middleware([JwtMiddleware::class])->group(function () {
    // Halaman index (menggunakan BukuController)
    Route::get('/index', [BukuController::class, 'index'])->name('buku.index');
    
    // Tambahkan rute lain yang memerlukan otentikasi di sini
    Route::post('/buku/simpan', [BukuController::class, 'store'])->name('buku.store');
    Route::put('/buku/update/{id_buku}', [BukuController::class, 'update'])->name('buku.rest.update');
    Route::patch('/buku/patch/{id_buku}', [BukuController::class, 'show'])->name('buku.patch');
    Route::delete('/buku/delete/{id_buku}', [BukuController::class, 'destroy'])->name('buku.delete');
});