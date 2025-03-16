@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        @if(!empty($products) && is_array($products))
            <div class="grid grid-cols-3 gap-4">
                @foreach($products as $product)
                    <div class="border p-4 rounded shadow">
                        <h2 class="font-semibold">{{ $product['name'] }}</h2>
                        <p class="text-gray-600">{{ $product['description'] }}</p>
                        <p class="text-green-600 font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada produk yang tersedia.</p>
        @endif
    </div>
@endsection
