<x-app-layout>
    <div class="container px-4 mx-auto">
        <h1 class="mb-4 text-3xl font-semibold uppercase">
            About
        </h1>
        <p>
            {{env('APP_NAME')}} is a web application that uses the <a target="_blank" href="https://www.igdb.com/"
                class="underline hover:text-purple-600">IGDB API</a> to display information about video games.
        </p>

        <p>
            It uses the TALL stack ( <a target="_blank" href="https://tailwindcss.com/"
                class="underline hover:text-sky-500">TailwindCSS</a>,
            <a target="_blank" href="https://alpinejs.dev/" class="underline hover:text-gray-300">AlpineJS</a>,
            <a target="_blank" href="https://laravel.com/" class="underline hover:text-red-600">Laravel</a>,
            <a target="_blank" href="https://livewire.laravel.com/" class="underline hover:text-pink-400">Livewire</a>
            )
        </p>

        <p class="mt-4 italic">Made by Michele Campanello</p>
        <img src="{{asset('images/photo.jpeg')}}" class="h-64 mt-4 rounded-lg" alt="">
    </div>
</x-app-layout>
