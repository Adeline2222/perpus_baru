<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

/*
| LOGIN
*/
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/proses', [LoginController::class, 'proses']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    Route::get('/beranda', [AnggotaController::class, 'beranda']);

    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::post('/anggota/store', [AnggotaController::class, 'store']);
    Route::delete('/anggota/hapus/{id}', [AnggotaController::class, 'destroy']);
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update']);
    Route::get('/laporan/anggota', [AnggotaController::class, 'laporan']);



    Route::get('/buku', [BukuController::class, 'index']);
    Route::post('/buku/store', [BukuController::class, 'store']);
    Route::delete('/buku/hapus/{id}', [BukuController::class, 'destroy']);
    Route::put('/buku/update/{id}', [BukuController::class, 'update']);
    Route::get('/laporan/buku', [BukuController::class, 'laporan']);



    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store']);
    Route::post('/peminjaman/keluar/{id}', [PeminjamanController::class, 'keluar']);
    Route::put('/peminjaman/update/{id}', [PeminjamanController::class,'update']);
    Route::get('/laporan-peminjaman', [PeminjamanController::class, 'laporan']);

    Route::delete('/peminjaman/hapus/{id}', [PeminjamanController::class, 'destroy']);
});
