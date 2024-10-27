<x-app-layout>
    <div class="container px-4 mx-auto"> <!-- Container -->
        <div class="flex flex-col pb-12 border-b border-gray-800 lg:flex-row"> <!-- Game Details -->
            <img src="{{ $game['coverImageUrl'] }}" alt="{{ $game['name'] }} cover image" class="h-full rounded-lg">
            <div class="ml-0 lg:ml-12">
                <h2 class="text-4xl font-semibold leading-tight">{{ $game['name'] }}</h2>
                <div>
                    <div>{{ $game['releaseDate'] }}</div>
                    <div>{{ $game['genres'] }}</div>
                    <div>{{ $game['involvedCompanies'] }}</div>
                    <div>{{ $game['platforms'] }}</div>
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div id="memberRating" class="relative w-16 h-16 text-sm bg-gray-800 rounded-full">
                            @push('scripts')
                                @include('_rating', [
                                    'slug' => 'memberRating',
                                    'rating' => $game['memberRating'],
                                    'event' => null,
                                ])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">Member <br> score</div>

                        <div id="criticRating" class="relative w-16 h-16 ml-12 text-sm bg-gray-800 rounded-full">
                            @push('scripts')
                                @include('_rating', [
                                    'slug' => 'criticRating',
                                    'rating' => $game['criticRating'],
                                    'event' => null,
                                ])
                            @endpush
                        </div>

                        <div class="ml-4 text-xs">Critic <br> score</div>
                    </div>

                    <div class="flex gap-4 mt-4 lg:mt-0 lg:ml-12">
                        @foreach ($game['social'] as $platform => $data)
                            @if (!empty($data) && isset($data['url'])) 
                                <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                    <a href="{{ $data['url'] }}" aria-label="{{ ucfirst($platform) }}" class="hover:text-gray-400">
                                        @include("svg.{$platform}")
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                                     
                </div>

                <p class="h-32 max-w-4xl mt-6 overflow-auto text-gray-400">
                    {{ $game['summary'] }}
                </p>

                <div class="mt-12">
                    <a href="{{ $game['trailer'] }}"
                        class="inline-flex p-4 font-semibold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-play">
                            <polygon points="6 3 20 12 6 21 6 3" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </a>
                </div>
            </div>
        </div><!-- End Game Details -->

        <div class="pb-12 mt-8 border-b border-gray-800"> <!-- Game Images -->
            <h3 class="font-semibold tracking-wide text-blue-500 uppercase">Images</h3>

            <div class="grid grid-cols-1 gap-12 mt-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($game['screenshots'] as $screenshot)
                    <a href="{{ $screenshot['huge'] }}">
                        <img src="{{ $screenshot['big'] }}" alt="Screenshot of {{ $game['name'] }}"
                            class="transition duration-150 ease-in-out hover:opacity-75">
                    </a>
                @endforeach
            </div>
        </div> <!-- End Game Images -->

        <div class="pb-12 mt-8"> <!-- Similar Games -->
            <h3 class="font-semibold tracking-wide text-blue-500 uppercase">Similar Games</h3>

            <div class="grid grid-cols-1 gap-12 text-sm md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                @foreach ($game['similarGames'] as $similarGame)
                    <x-game-card :game="$similarGame" />
                @endforeach
            </div>
        </div><!-- End Similar Games -->
    </div> <!-- End Container -->
</x-app-layout>
