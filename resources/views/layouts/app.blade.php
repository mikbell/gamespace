<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="text-white bg-gray-900">
    <header class="top-0 z-50 bg-gray-900 border-b border-gray-800 lg:sticky">
        <div x-data="{ open: false }" class="top-0 z-50 bg-gray-900 border-b border-gray-800 lg:sticky">
            <nav class="container flex flex-col items-center justify-between px-4 py-6 mx-auto lg:flex-row">
                <!-- Logo & Hamburger for Mobile -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-between w-full lg:w-auto">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center transition duration-150 ease-in-out hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-12">
                                <line x1="6" x2="10" y1="11" y2="11" />
                                <line x1="8" x2="8" y1="9" y2="13" />
                                <line x1="15" x2="15.01" y1="12" y2="12" />
                                <line x1="18" x2="18.01" y1="10" y2="10" />
                                <path
                                    d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z" />
                            </svg>
                            <span class="ml-2 text-2xl font-bold">{{ env('APP_NAME') }}</span>
                        </a>

                        <!-- Hamburger Icon -->
                        <button @click="open = !open" class="text-gray-400 lg:hidden focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="4" x2="20" y1="12" y2="12" />
                                <line x1="4" x2="20" y1="6" y2="6" />
                                <line x1="4" x2="20" y1="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links for Mobile -->
                    <div x-show="open" class="w-full mt-4 lg:hidden" @click.away="open = false">
                        <ul class="flex flex-col gap-4 mt-6">
                            <li>
                                <x-nav-link href="{{ route('games.popular-games') }}" :active="request()->routeIs('games.popular-games')">
                                    Popular Games
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('games.recently-reviewed') }}" :active="request()->routeIs('games.recently-reviewed')">
                                    Recently Reviewed
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('games.most-anticipated') }}" :active="request()->routeIs('games.most-anticipated')">
                                    Most Anticipated
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('games.coming-soon') }}" :active="request()->routeIs('games.coming-soon')">
                                    Coming Soon
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                                    About
                                </x-nav-link>
                            </li>
                        </ul>
                    </div>

                    <!-- Navigation Links for Desktop -->
                    <div class="hidden lg:flex lg:items-center lg:w-auto lg:mt-0">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <x-nav-link href="#">
                                    <span>Games</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-5">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </x-nav-link>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('games.popular-games') }}" :active="request()->routeIs('games.popular-games')">
                                    Popular Games
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('games.recently-reviewed') }}" :active="request()->routeIs('games.recently-reviewed')">
                                    Recently Reviewed
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('games.most-anticipated') }}" :active="request()->routeIs('games.most-anticipated')">
                                    Most Anticipated
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('games.coming-soon') }}" :active="request()->routeIs('games.coming-soon')">
                                    Coming Soon
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                            About
                        </x-nav-link>
                    </div>
                </div>

                <!-- Search and User Authentication -->
                <div class="flex items-center gap-4 mt-4 lg:mt-0">
                    <livewire:search-dropdown />
                    <div>
                        @guest
                            <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                            <x-nav-link href="{{ route('register') }}">Registrati</x-nav-link>
                        @else
                            <x-dropdown align="right" class="relative">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-transparent border border-transparent rounded-md hover:text-gray-400 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <svg class="w-4 h-4 ml-1 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('wishlist.index')">Wishlist</x-dropdown-link>

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                        Out</x-dropdown-link>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </x-slot>
                            </x-dropdown>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>

    </header>

    <main class="py-8">
        {{ $slot }}
    </main>

    <footer class="border-t border-gray-800">
        <div class="container px-4 py-6 mx-auto text-center text-gray-400">
            Powered by <a href="https://www.igdb.com/" class="underline hover:text-gray-300">IGDB API</a>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>

</html>
