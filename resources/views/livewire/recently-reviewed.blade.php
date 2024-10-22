<div class="w-full mr-0 lg:mr-32 lg:w-3/4"><!-- Recently Reviewed -->
    <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
        Recently Reviewed
    </h2>

    <div class="mt-8 space-y-12">
        @foreach ($recentlyReviewed as $game)
            <div class="flex p-6 bg-gray-800 rounded-lg shadow-md"> <!-- Game -->
                <div class="relative flex-none">
                    <a href="#">
                        <img src="{{ str_replace('thumb', 'cover_big', $game['cover']['url']) }}"
                            class="transition duration-150 ease-in-out hover:opacity-75">
                    </a>

                    <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-900 rounded-full">
                        <div class="flex items-center justify-center h-full text-xs font-semibold">
                            {{ isset($game['rating']) ? number_format($game['rating']) : 'N/A' }}
                        </div>
                    </div>
                </div>

                <div class="ml-8">
                    <a href="#"
                        class="block text-base font-semibold leading-tight hover:text-gray-400">{{ $game['name'] }}</a>
                    <div class="mt-1 text-gray-400">
                        @foreach ($game['platforms'] as $platform)
                            {{ $platform['abbreviation'] ?? 'N/A' }},
                        @endforeach
                    </div>
                    <p class="hidden mt-6 text-gray-400 lg:block">
                        {{ $game['summary'] }}
                    </p>
                </div>
            </div> <!-- End Game -->
        @endforeach
    </div>
</div><!-- End Recently Reviewed -->
