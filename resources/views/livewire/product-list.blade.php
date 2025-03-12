@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $product['name'] }}</h2>
                    <p class="text-gray-600">{{ $product['description'] }}</p>
                    <p class="text-gray-800 font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
