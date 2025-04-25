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



// Route::middleware([JwtMiddleware::class])->group(function () {
//     Route::get('/form-tambah-buku', function () {
//         return view('form-tambah-buku');
//     })->name('buku.create.file');
//     Route::get('/index', [BukuController::class, 'index'])->name('buku.index');
//     Route::get('/buku/baca/{id_buku}', [BukuController::class, 'bacaBuku'])->name('buku.baca');
//     Route::delete('/buku/{id_buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
//     Route::put('buku/update/{id_buku}', [BukuController::class, 'update'])->name('buku.rest.update');
// });

// Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
// Route::get('/index', [BukuController::class, 'index'])->name('buku.index');
