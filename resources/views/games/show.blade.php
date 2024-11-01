<x-app-layout>
    <div class="container px-4 mx-auto"> <!-- Container -->
        <div class="flex flex-col pb-12 border-b border-gray-800 lg:flex-row"> <!-- Game Details -->
            <img src="{{ $game['coverImageUrl'] }}" alt="{{ $game['name'] }} cover image" class="h-full rounded-lg">
            <div class="ml-0 lg:ml-12">
                <h2 class="text-4xl font-semibold leading-tight">{{ $game['name'] }}</h2>
                <p>Release Date: {{ $game['releaseDate'] }}</p>
                <p>Genres: {{ $game['genres'] }}</p>
                <p>Publishers: {{ $game['involvedCompanies'] }}</p>
                <p>Platforms: {{ $game['platforms'] }}</p>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div id="memberRating" class="relative w-16 h-16 text-sm bg-gray-800 rounded-full">
                            @include('_rating', [
                                'slug' => 'memberRating',
                                'rating' => $game['memberRating'],
                                'event' => null,
                            ])
                        </div>
                        <div class="ml-4 text-xs">Member <br> score</div>

                        <div id="criticRating" class="relative w-16 h-16 ml-12 text-sm bg-gray-800 rounded-full">
                            @include('_rating', [
                                'slug' => 'criticRating',
                                'rating' => $game['criticRating'],
                                'event' => null,
                            ])
                        </div>

                        <div class="ml-4 text-xs">Critic <br> score</div>
                    </div>

                    <div class="flex gap-4 mt-4 lg:mt-0 lg:ml-12">
                        @foreach ($game['social'] as $platform => $data)
                            @if (!empty($data) && isset($data['url']))
                                <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                    <a target="_blank" href="{{ $data['url'] }}" aria-label="{{ ucfirst($platform) }}"
                                        class="transition duration-150 ease-in-out hover:text-gray-400">
                                        @include("svg.{$platform}")
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

                <p class="max-w-4xl mt-6 overflow-auto text-gray-400 max-h-32">
                    {{ $game['summary'] }}
                </p>

                <div x-data="{ open: false }">
                    <div class="mt-12">
                        <button @click="open = true"
                            class="inline-flex p-4 font-semibold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-play">
                                <polygon points="6 3 20 12 6 21 6 3" />
                            </svg>
                            <span class="ml-2">Play Trailer</span>
                        </button>
                    </div>

                    <!-- Modal -->
                    <div x-cloak x-show="open"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div @click.away="open = false" class="relative w-11/12 max-w-6xl mx-auto h-1/2">
                            <iframe width="100%" height="100%" src="{{ $game['trailer'] }}" frameborder="0"
                                allow="autoplay; encrypted-media" allowfullscreen
                                class="absolute top-0 left-0 w-full h-full"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Game Details -->

        <div class="pb-12 mt-8 border-b border-gray-800" x-data="{ open: false, image: '' }"> <!-- Game Images -->
            <h3 class="font-semibold tracking-wide text-blue-500 uppercase">Images</h3>

            <div class="grid grid-cols-1 gap-12 mt-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($game['screenshots'] as $screenshot)
                    <a @click.prevent="open = true; image = '{{ $screenshot['big'] }}'" href="#">
                        <img src="{{ $screenshot['big'] }}" alt="Screenshot of {{ $game['name'] }}"
                            class="transition duration-150 ease-in-out hover:opacity-75">
                    </a>
                @empty
                    <p>No screenshots available</p>
                @endforelse
            </div>

            <div x-cloak x-show="open"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div @click.away="open = false" class="relative w-11/12 max-w-6xl mx-auto h-1/2">
                    <img :src="image" class="absolute top-0 left-0 w-full h-full" />
                </div>
            </div>
        </div> <!-- End Game Images -->

        <livewire:game-comments :gameSlug="$game['slug']" />

        <div class="pb-12 mt-8"> <!-- Similar Games -->
            <h3 class="font-semibold tracking-wide text-blue-500 uppercase">Similar Games</h3>

            <div class="grid grid-cols-1 gap-12 text-sm md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                @forelse ($game['similarGames'] as $similarGame)
                    <x-game-card :game="$similarGame" />
                @empty
                    <p>No similar games available</p>
                @endforelse
            </div>
        </div><!-- End Similar Games -->
    </div> <!-- End Container -->
</x-app-layout>
