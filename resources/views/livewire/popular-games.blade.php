<div class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
    <!-- Popular Games -->

    @forelse ($popularGames as $game)
        <div class="mt-8">
            <div class="relative inline-block">
                <a href="{{ route('games.show', $game['slug']) }}">
                    <img src="{{ str_replace('thumb', 'cover_big', $game['cover']['url']) }}"
                        class="transition duration-150 ease-in-out hover:opacity-75">
                </a>

                <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                    <div class="flex items-center justify-center h-full text-xs font-semibold">
                        {{ isset($game['rating']) ? number_format($game['rating']) : 'N/A' }}
                    </div>
                </div>
            </div>

            <a href="{{ route('games.show', $game['slug']) }}"
                class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">{{ $game['name'] }}</a>
            @if (!empty($game['platforms']))
                <p class="mt-1 text-gray-400">
                    @foreach ($game['platforms'] as $platform)
                        {{ $platform['abbreviation'] ?? 'N/A' }},
                    @endforeach
                </p>
            @endif
        </div>
    @empty
        @foreach (range(1, 12) as $game)
            <div class="mt-8">
                <div class="relative inline-block">
                    <a href="#">
                        <div class="w-48 bg-gray-600 h-72"></div>
                    </a>
                </div>

                <div href="#" class="block mt-4 text-lg text-transparent bg-gray-600 rounded">Game Title</div>
                <div class="inline-block mt-1 text-transparent bg-gray-600 rounded">PC, PS5, Switch</div>
            </div>
        @endforeach
    @endforelse
</div> <!-- End Popular Games -->
