<div>
    <h2 class="text-2xl font-bold">Daftar Produk</h2>
    <div class="grid grid-cols-3 gap-4 mt-4">
        @foreach ($products as $product)
            <div class="border p-4 rounded shadow">
                <h3 class="text-lg font-semibold">{{ $product['name'] }}</h3>
                <p class="text-gray-600">{{ $product['description'] }}</p>
                <p class="font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>
</div>
