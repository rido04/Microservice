@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg">Login</button>
            </form>

            <p class="mt-4 text-center text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500">Daftar</a></p>
        </div>
    </div>
@endsection
