<x-app-layout>
    <div class="container px-4 mx-auto">
        <h2 class="font-semibold tracking-wide text-blue-500 uppercase">
            Games
        </h2>

        @if (session()->has('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <livewire:games-index />
    </div>
</x-app-layout>
