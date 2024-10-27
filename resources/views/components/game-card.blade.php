<a wire:navigate href="{{ route('games.show', $game['slug']) }}"
    class="mt-8 transition duration-150 transform group hover:shadow-lg hover:-translate-y-1">
    <div class="relative inline-block">
        <img src="{{ $game['coverImageUrl'] }}" alt="{{ $game['name'] }} cover image"
            class="transition duration-150 ease-in-out rounded-md group-hover:opacity-75">

        @if ($game['rating'])
            <div
                class="absolute bottom-0 right-0 flex items-center justify-center w-12 h-12 text-sm font-semibold text-white transform translate-x-1/2 translate-y-1/2 bg-gray-800 rounded-full">
                {{ $game['rating'] }}
            </div>
        @endif
    </div>

    <div
        class="block mt-4 text-base font-semibold leading-tight text-center transition duration-150 ease-in-out group-hover:text-gray-400">
        {{ $game['name'] }}
    </div>
    <div class="text-center text-gray-500">
        {{ $game['platforms'] }}
    </div>
</a>
