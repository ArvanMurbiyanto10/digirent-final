<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DigiRent') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Kita ganti @vite dengan link langsung ke file yang sudah di-rename --}}
        <link rel="stylesheet" href="https://mycell.web.id/build/assets/style.css">
        <script src="https://mycell.web.id/build/assets/script.js" defer></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Layout asli kamu tetap dipertahankan di sini --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
                {{ $slot }}
        </div>
    </body>
</html>