<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFrontendController;

// Home Page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman Login & Register
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Login API
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Halaman Produk (Pakai Controller, supaya bisa ambil data dari API)
Route::get('/products', [ProductFrontendController::class, 'index'])->name('products');

// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/cart', function () {
        return view('pages.cart');
    })->name('cart');

    Route::get('/checkout', function () {
        return view('pages.checkout');
    })->name('checkout');

    Route::get('/orders', function () {
        return view('pages.orders');
    })->name('orders');
});
