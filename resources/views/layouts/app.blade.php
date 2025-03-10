<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    @include('components.navbar')

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    @include('components.footer')

    @livewireScripts
</body>
</html>
