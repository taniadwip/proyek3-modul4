<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;

// Katalog Barang (Publik - Boleh Diakses Tanpa Login)
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Autentikasi Pengguna
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Keranjang Belanja (Shopping Cart - Wajib Login)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout & Riwayat Pesanan (Wajib Login)
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderHistoryController::class, 'show'])->name('orders.show');