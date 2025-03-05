<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
});
