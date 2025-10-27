<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Web Developer - Fatema Akther Prianka</title>
    <link rel="icon" href="{{asset('backend/img/logo.png')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg_overlay_main {
            background: url({{asset('backend/img/hero-bg.jpg')}});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .bg_overlay {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>

</head>

<body class="font-sans text-gray-900 antialiased bg_overlay_main">
    <div class="bg_overlay min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <img width="120" src="{{asset('backend/img/logo.png')}}" alt="Logo">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
