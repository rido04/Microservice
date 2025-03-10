@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products ?? [] as $product)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">{{ $product['name'] }}</h2>
                <p class="text-gray-600">Kategori: {{ $product['category']['name'] ?? 'Tanpa Kategori' }}</p>
                <p class="text-gray-800 font-bold">Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>

    @if(empty($products))
        <p class="text-gray-500 mt-4">Belum ada produk.</p>
    @endif
@endsection
