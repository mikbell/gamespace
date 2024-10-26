<div wire:init="load" class="mt-8 space-y-10"><!-- Coming Soon -->
    @forelse ($comingSoon as $game)
        <div class="flex"> <!-- Game -->
            <a href="{{ route('games.show', $game['slug']) }}">
                @if (isset($game['cover']))
                    <img src="{{ str_replace('thumb', 'cover_small', $game['cover']['url']) }}"
                        class="transition duration-150 ease-in-out hover:opacity-75">
                @else
                    <div class="w-16 h-24 transition duration-150 bg-gray-600 hover:opacity-75 ease in out">
                    </div>
                @endif
            </a>

            <div class="ml-4">
                <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400">
                    {{ $game['name'] }}
                </a>
                <div class="mt-1 text-sm text-gray-400">
                    {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}</div>
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
</div><!-- End Coming Soon -->
