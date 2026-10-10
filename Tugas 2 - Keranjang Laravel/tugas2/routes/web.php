<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

Route::get('/tugas2/index', [BarangController::class, 'index'])->name('barang.index');
Route::post('/tugas2/tambah/{id}', [BarangController::class, 'tambahKeKeranjang'])->name('cart.add');

Route::get('/tugas2/keranjang', [BarangController::class, 'keranjang'])->name('keranjang.index');
Route::post('/tugas2/keranjang/tambah/{id}', [BarangController::class, 'tambahJumlah'])->name('cart.plus');
Route::post('/tugas2/keranjang/kurang/{id}', [BarangController::class, 'kurangJumlah'])->name('cart.minus');
Route::post('/tugas2/keranjang/hapus/{id}', [BarangController::class, 'hapusItem'])->name('cart.delete');
Route::post('/tugas2/keranjang/kosongkan', [BarangController::class, 'kosongkan'])->name('cart.clear');