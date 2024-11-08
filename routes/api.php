<?php

    use App\Http\Controllers\BukuController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


    Route::prefix('/buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku.index');

        Route::post('/simpan', [BukuController::class, 'store'])->name('buku.simpan');

        Route::put('/simpan/{id_buku}', [BukuController::class, 'update'])->name('buku.rest.update');
        
        Route::patch('/simpan/{id_buku}', [BukuController::class, 'show'])->name('buku.ubah');
        
        Route::delete('/hapus/{id_buku}', [BukuController::class, 'destroy'])->name('buku.hapus');
    });
?>