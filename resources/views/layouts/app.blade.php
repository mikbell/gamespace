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
    @livewireStyles
</head>

<body class="text-white bg-gray-900">
    <header class="border-b border-gray-800">
        <nav class="container flex flex-col items-center justify-between px-4 py-6 mx-auto lg:flex-row">
            <div class="flex items-center">
                <a href="/" wire:navigate>
                    <img src="{{ asset('path/to/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="h-10">
                </a>

                <ul class="flex items-center gap-8 ml-16">
                    <li><a href="#" class="hover:text-gray-400">Games</a></li>
                    <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>

            <div class="flex items-center mt-4 lg:mt-0">
                <livewire:search-dropdown />

                <div>
                    <a href="#" class="block w-8 h-8 ml-4 bg-white rounded-full" title="User Profile"></a>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-8">
        {{ $slot }}
    </main>

    <footer class="border-t border-gray-800">
        <div class="container px-4 py-6 mx-auto">
            Powered by <a href="https://www.igdb.com/" class="underline hover:text-gray-300">IGDB API</a>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>

</html>
