<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-gray-100 via-white to-gray-100 min-h-screen flex flex-col justify-center items-center">

    <!-- Logo Section -->
    <div class="flex flex-col items-center space-y-3">
        <a href="/" class="flex flex-col items-center">
            <x-application-logo class="w-20 h-20 fill-current text-indigo-500 drop-shadow-md" />
            <span class="mt-2 text-lg font-semibold text-gray-700">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>

    <!-- Card Section -->
    <div class="w-full sm:max-w-md mt-8 px-6 py-6 bg-white shadow-lg rounded-xl border border-gray-100">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <footer class="mt-6 text-sm text-gray-500">
        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
    </footer>

</body>
</html>
