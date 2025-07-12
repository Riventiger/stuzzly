<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Module')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow p-4">
            <h1 class="text-2xl font-bold">
                @yield('header', 'Blog Section')
            </h1>
        </header>

        <main class="flex-grow container mx-auto p-4">
            @yield('content')
        </main>

        <footer class="bg-white text-center py-4 border-t mt-8">
            &copy; {{ date('Y') }} Stuzzly Blog Module
        </footer>
    </div>
</body>
</html>
