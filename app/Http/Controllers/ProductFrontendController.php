<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductFrontendController extends Controller
{
    public function index()
    {
        $response = Http::timeout(60)->get(config('app.url') . '/api/products');

        if ($response->successful()) {
            $products = $response->json();
        } else {
            $products = [];
        }

        // Debugging: Log the API response and the products
        Log::info('API Response:', ['response' => $response->json()]);
        Log::info('Products:', ['products' => $products]);

        return view('pages.products', compact('products'));
    }
}
