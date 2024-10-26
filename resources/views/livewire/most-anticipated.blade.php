<div wire:init="load" class="mt-8 space-y-10"><!-- Most Anticipated -->
    @forelse ($mostAnticipated as $game)
        <div class="flex"> <!-- Game -->
            <a href="{{ route('games.show', $game['slug']) }}">
                <img src="{{ $game['coverImageUrl'] }}" class="transition duration-150 ease-in-out hover:opacity-75">
            </a>

            <div class="ml-4">
                <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400">
                    {{ $game['name'] }}
                </a>
                <div class="mt-1 text-sm text-gray-400">
                    {{ $game['releaseDate'] }}</div>
            </div>
        </div> <!-- End Game -->
    @empty
        @foreach (range(1, 4) as $game)
            <div class="flex"> <!-- Game -->
                <div class="w-20 bg-gray-600 h-28"></div>

                <div class="ml-4">
                    <div class="block text-base leading-tight text-transparent bg-gray-600 rounded selection:hidden">
                        Game Title
                    </div>
                    <div class="mt-1 text-sm text-transparent text-gray-400 bg-gray-600 rounded selection:hidden">
                        Release Date
                    </div>
                </div>
            </div> <!-- End Game -->
        @endforeach
    @endforelse
</div><!-- End Most Anticipated -->
