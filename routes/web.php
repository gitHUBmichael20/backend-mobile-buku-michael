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
    // Halaman index (hanya bisa diakses setelah login)
    Route::get('/index', function () {
        return view('pages.index'); // Tampilkan halaman index
    })->name('pages.index');
});