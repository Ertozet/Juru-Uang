<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/Hari', [App\Http\Controllers\JuangController::class, 'index'])->name('Hari');
Route::get('/minggu', [App\Http\Controllers\JuangController::class, 'minggu'])->name('minggu');
Route::get('/bulan', [App\Http\Controllers\JuangController::class, 'bulan'])->name('bulan');
Route::get('/pengeluaran', [App\Http\Controllers\JuangController::class, 'pengeluaran'])->name('pengeluaran');
Route::get('/pemasukan', [App\Http\Controllers\JuangController::class, 'pemasukan'])->name('pemasukan');

// create
Route::post('/input', [App\Http\Controllers\PostController::class, 'input'])->name('input');

// Edit
Route::get('/editm/{id}', [App\Http\Controllers\PostController::class, 'editm'])->name('editm');
Route::get('/editk/{id}', [App\Http\Controllers\PostController::class, 'editk'])->name('editk');
Route::post('/updtm/{id}', [App\Http\Controllers\PostController::class, 'updtm'])->name('updtm');
Route::post('/updtk/{id}', [App\Http\Controllers\PostController::class, 'updtk'])->name('updtk');

// Hapus
Route::delete('/juang/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('juang.destroy');

// tanggal minggu
Route::get('/taming', [App\Http\Controllers\JuangController::class, 'taming'])->name('taming');