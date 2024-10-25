<div class="mt-8 space-y-10"><!-- Most Anticipated -->
    @foreach ($mostAnticipated as $game)
        <div class="flex"> <!-- Game -->
            <a href="{{ route('games.show', $game['slug']) }}">
                    <img src="{{ $game['coverImageUrl'] }}"
                        class="transition duration-150 ease-in-out hover:opacity-75">
            </a>

            <div class="ml-4">
                <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400">
                    {{ $game['name'] }}
                </a>
                <div class="mt-1 text-sm text-gray-400">
                    {{$game['releaseDate']}}</div>
            </div>
        </div> <!-- End Game -->
    @endforeach
</div><!-- End Most Anticipated -->
