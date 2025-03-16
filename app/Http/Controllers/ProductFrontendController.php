<?php
// filepath: /c:/laragon/www/user-service/app/Http/Controllers/ProductFrontendController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductFrontendController extends Controller
{
    public function index()
    {
        // Ambil data produk dari API
        $response = Http::get(config('app.url') . '/api/products');

        // Cek apakah request berhasil
        if ($response->successful()) {
            $products = $response->json();
        } else {
            $products = [];
        }

        return view('pages.products', compact('products'));
    }
}