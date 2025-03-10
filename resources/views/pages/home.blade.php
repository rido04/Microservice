@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h1 class="text-3xl font-bold">Selamat Datang di Toko Online</h1>
    <p class="mt-2">Temukan berbagai produk menarik dengan harga terbaik.</p>

    <div class="mt-6">
        <a href="{{ route('products') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Lihat Produk
        </a>
    </div>
@endsection
