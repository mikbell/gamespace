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
    <header class="sticky top-0 z-50 bg-gray-900 border-b border-gray-800">
        <nav class="container flex flex-col items-center justify-between px-4 py-6 mx-auto lg:flex-row">
            <div class="flex items-center">
                <a href="/" wire:navigate>
                    <img src="{{ asset('path/to/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="h-10">
                </a>

                <ul class="flex items-center gap-8 ml-16">
                    <li><x-nav-link href="{{ route('games.index') }}">Games</x-nav-link></li>
                    <li><x-nav-link href="#">Reviews</x-nav-link></li>
                    <li><x-nav-link href="#">Coming Soon</x-nav-link></li>
                </ul>
            </div>

            <div class="flex items-center mt-4 lg:mt-0">
                <livewire:search-dropdown />

            </div>
            <div>
                @guest
                    <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                    <x-nav-link href="{{ route('register') }}">Registrati</x-nav-link>
                @else
                    <x-dropdown align="right">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-transparent border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                Out</x-dropdown-link>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
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
