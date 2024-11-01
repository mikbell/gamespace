<x-app-layout>
    <div class="container px-4 mx-auto">
        <h2 class="mb-4 text-3xl font-semibold uppercase">
            Popular Games
        </h2>

        @if (session()->has('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <livewire:popular-games-index />
    </div>
</x-app-layout>
