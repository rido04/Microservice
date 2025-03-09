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
                'product_id' => $cart->product_id,
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

    public function pay(Request $request, $orderId){
        $user = Auth::user();
        $order = Order::where('id', $orderId)->where('user_id',$user->id)->first();

        // validasi order
        if(!$order){
            return response()->json(['message' => "Order Tidak ditemukan!"], 404);
        }

        // validasi status
        if($order->status !== 'pending'){
            return response()->json(['message' => "Pesanan sedang di proses admin!"], 400);
        }
        // update status pesanan
        $order->update(['status' => 'waiting_confirmation']);
        return response()->json(['message' => 'Bukti Pembayaran sudah dikirim, menunggu verifikasi admin']);
    }

    public function verifyPayment(Request $request, $orderId){

        // temukan order ID
        $order = Order::find($orderId);

        // kalau tidak ada order
        if(!$order){
            return response()->json(['message' => 'Order Tidak Ditemukan!'], 404);
        }
        // kalau ada order
        if($order->status !== 'waiting_confirmation'){
            return response()->json(['message' => 'Order tidak bisa diverifikasi'],400);
        }

        // validasi status payment
        $request->validate([
            'status' => 'required|in:paid,rejected'
        ]);

        // update status order
        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'Status Pesanan diupdate menjadi'.''. $request->status]);
    }

    public function listOrders()
    {
        // Admin Melihat Semua Order
        $orders = Order::with('user', 'orderDetails.product')->get();
        return response()->json($orders);
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        // validasi status
        $request->validate([
            'order_status' => 'required|in:pending,diproses,dikirim,selesai'
        ]);

        // query order
        $order = Order::find($orderId);

        // jika order tidak ditemukan
        if(!$order) {
            return response()->json(['message' => 'Order Tidak Ditemukan'], 404);
        }

        // Jika order ditemukan
        if($order->status !=='paid'){
            return response()->json(['message' => 'Pesanan anda belum di bayar!'],400);
        }

        // update order jika ditemukan
        $order->update([
            'order_status' =>$request->order_status
        ]);

        return response()->json(['message' => 'Status Diperbarui', 'order' =>$order]);
    }

    public function myOrders()
    {
        // validasi user
        $user = Auth::user();

        // query dan relasi ke user id
        $orders = Order::where('user_id', $user->id)->with('orderDetails.product')->get();

        return response()->json($orders);
    }
}
