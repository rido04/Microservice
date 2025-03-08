<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// route logout dan get profile
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    // Crud products
    Route::apiResource('/products', ProductController::class);
    // crud categories
    Route::apiResource('/categories', CategoryController::class);
    // crud cart
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::put('/cart/{id}' , [CartController::class, 'updateCart']);
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);
    //Routes Checkout
    Route::post('/checkout', [OrderController::class, 'checkout']);
    //Routes Payment
    Route::post('/payments/{order_id}',[OrderController::class, 'pay']);
    Route::put('/admin/payments/{order_id}',[OrderController::class, 'verifyPayment']);
    // Routes Order details
    Route::get('/orders', [OrderController::class, 'listOrders']);
    Route::put('/orders/{orderid}/status', [OrderController::class, 'updateOrderStatus']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);
});
