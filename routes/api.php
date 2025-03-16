<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API Showcase",
 *         version="1.0.0",
 *         description="Dokumentasi API untuk proyek personal branding."
 *     )
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route publik tanpa auth
Route::get('/products/{id}', [ProductController::class, 'show']);

// route logout dan get profile
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/products', [ProductController::class, 'index']);
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
    // routes order status by id
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
    // routes get produk customer
    Route::get('/products', [ProductController::class, 'index']);
    // route get produk by id
    Route::get('/products/{id}', [ProductController::class, 'show']);
});
