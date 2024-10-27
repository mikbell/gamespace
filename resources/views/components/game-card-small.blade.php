<a href="{{ route('games.show', $game['slug']) }}" class="flex mt-8 group"> <!-- Game -->
    <div class="relative inline-block">
        <img src="{{ $game['coverImageUrl'] }}"
            alt="{{ $game['name'] }} cover image" 
            class="transition duration-150 ease-in-out rounded-md group-hover:opacity-75">
    </div>

    <div class="ml-4">
        <span class="block text-base font-semibold leading-tight transition duration-150 ease-in-out group-hover:text-gray-400">
            {{ $game['name'] }}
        </span>
        <div class="mt-1 text-sm text-gray-400">
            {{ $game['releaseDate'] }}
        </div>
    </div>
</a> <!-- End Game -->
