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
                    <a href="/">Logo</a>
    
                    <ul class="flex items-center gap-8 ml-16">
                        <li><a href="#" class="hover:text-gray-400">Games</a></li>
                        <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                        <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
                    </ul>
                </div>
    
                <div class="flex items-center mt-4 lg:mt-0">
                    <div class="relative">
                        <input type="text" class="w-64 px-3 py-1 pl-8 text-sm bg-gray-800 rounded-full"
                            placeholder="Search...">
    
                        <div class="absolute top-0 flex items-center h-full ml-2">
                            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                    </div>
    
                    <div>
                        <div class="w-8 h-8 ml-4 bg-white rounded-full"></div>
                    </div>
                </div>
            </nav>
        </header>
    
        <main class="py-8">
            {{ $slot }}
        </main>
    
        <footer class="border-t border-gray-800">
            <div class="container px-4 py-6 mx-auto">
                Powered by <a href="#" class="underline hover:text-gray-300">IGDB API</a>
            </div>
        </footer>
        @livewireScripts
    </body>
</html>
