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

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg shadow-lg bg-white">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Database Seeding Instruction</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Run command in terminal/CMS/PowerShell:</p>
                        <code class="block mt-1 p-2 bg-blue-100 rounded text-xs font-mono">php artisan db:seed</code>
                        <p class="mt-2">Test Credentials:</p>
                        <ul class="list-disc list-inside mt-1">
                            <li>Email: prianka@gmail.com</li>
                            <li>Password: 12345678</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
