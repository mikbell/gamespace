<x-app-layout>
    <div class="container px-4 mx-auto text-center">
        <h1 class="mb-4 text-3xl font-semibold uppercase">
            About
        </h1>

        <p class="mb-4">
            {{env('APP_NAME')}} is a web application that uses the <a target="_blank" href="https://www.igdb.com/"
                class="underline hover:text-purple-600">IGDB API</a> to display information about video games.
        </p>

        <p class="mb-4">
            It uses the TALL stack:
        </p>

        <ul class="pl-6">
            <li><a target="_blank" href="https://tailwindcss.com/" class="underline hover:text-sky-500">TailwindCSS</a></li>
            <li><a target="_blank" href="https://alpinejs.dev/" class="underline hover:text-gray-300">AlpineJS</a></li>
            <li><a target="_blank" href="https://laravel.com/" class="underline hover:text-red-600">Laravel</a></li>
            <li><a target="_blank" href="https://livewire.laravel.com/" class="underline hover:text-pink-400">Livewire</a></li>
        </ul>

        <p class="mt-4 italic">Made by Michele Campanello</p>
        <img src="{{asset('images/photo.jpeg')}}" class="h-64 mx-auto mt-4 rounded-lg" alt="Photo of Michele Campanello">
    </div>
</x-app-layout>
