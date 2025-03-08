<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

     // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

     // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
