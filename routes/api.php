<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route publik tanpa auth
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// route logout dan get profile
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    // Crud products
    Route::apiResource('/products', ProductController::class);
    // crud categories
    Route::apiResource('/categories', CategoryController::class);
    // routes konfirmasi payments admin
    Route::put('/admin/payments/{order_id}',[OrderController::class, 'verifyPayment']);
    // Routes Order status
    Route::get('/orders', [OrderController::class, 'listOrders']);
    Route::put('/orders/{orderid}/status', [OrderController::class, 'updateOrderStatus']);
});


Route::middleware(['auth:sanctum', 'role:customer'])->group(function(){
        // routes payment customer
        Route::post('/payments/{order_id}',[OrderController::class, 'pay']);
        // crud cart
        Route::post('/cart/add', [CartController::class, 'addToCart']);
        Route::get('/cart', [CartController::class, 'viewCart']);
        Route::put('/cart/{id}' , [CartController::class, 'updateCart']);
        Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);
        //Routes Checkout
        Route::post('/checkout', [OrderController::class, 'checkout']);
        // rutes order
        Route::get('/my-orders', [OrderController::class, 'myOrders']);
        Route::get('/products', [ProductController::class, 'index']);
});
