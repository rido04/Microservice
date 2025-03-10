<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-lg font-bold">Toko Online</a>
        <div class="space-x-4">
            <a href="{{ route('products') }}" class="text-gray-600 hover:text-blue-500">Produk</a>
            <a href="{{ route('cart') }}" class="text-gray-600 hover:text-blue-500">Keranjang</a>
            @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-500">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-500">Register</a>
            @else
                <a href="{{ route('orders') }}" class="text-gray-600 hover:text-blue-500">Pesanan</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
