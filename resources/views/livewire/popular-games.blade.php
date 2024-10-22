<div class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
    <!-- Popular Games -->
    @forelse ($popularGames as $game)
        <div class="mt-8">
            <div class="relative inline-block">
                <a href="#">
                    <img src="{{ str_replace('thumb', 'cover_big', $game['cover']['url']) }}"
                        class="transition duration-150 ease-in-out hover:opacity-75">
                </a>

                <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                    <div class="flex items-center justify-center h-full text-xs font-semibold">
                        {{ isset($game['rating']) ? number_format($game['rating']) : 'N/A' }}
                    </div>
                </div>
            </div>

            <a href="#"
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
        <div>
            <svg class="w-8 h-8 mt-8 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
    @endforelse
</div> <!-- End Popular Games -->
