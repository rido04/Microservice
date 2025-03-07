<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Json;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {   
        // autentikasi User
        $user = Auth::user();
        // masukan ke dalam variabel
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Kalau keranjang kosong
        if($cartItems->isEmpty()) {
            return response()->Json(['message' => 'keranjang kosong!'], 400);
        }

        // hitung total harga
        $totalPrice = 0;
        foreach ($cartItems as $cart) 
        {
            $totalPrice += $cart->product->price * $cart->quantity;
        }

        // simpan order baru
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // simpan order detail dan kurangi stok produk
        foreach ($cartItems as $cart){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price
            ]);

            // kurangi stok produk
            $cart->product->decrement('stock', $cart->quantity);
        }
        // kosongkan cart setelah cekout sukses
        Cart::where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Checkout Berhasil1', 'order'=>$order], 201);
    }
}
