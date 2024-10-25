<x-app-layout>
    <div class="container px-4 mx-auto"> <!--Container -->
        <div class="flex flex-col pb-12 border-b border-gray-800 lg:flex-row"> <!-- Game Details -->
            <img src="{{ $game['coverImageUrl'] ?? asset('images/default-cover.png') }}" alt="cover image">
            <div class="ml-0 lg:ml-12">
                <h2 class="text-4xl font-semibold leading-tight">{{ $game['name'] }}</h2>
                <div>
                    <span>
                        {{ $game['genres'] }}
                    </span>
                    &middot;
                    <span>{{ $game['involvedCompanies'] }}</span>
                    &middot;
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">
                                {{ $game['memberRating'] }}
                            </div>
                        </div>
                        <div class="ml-4 text-xs">
                            Member <br> score
                        </div>

                        <div class="w-16 h-16 ml-12 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">
                                {{ $game['criticRating'] }}
                            </div>
                        </div>

                        <div class="ml-4 text-xs">
                            Critic <br> score
                        </div>
                    </div>

                    <div class="flex gap-4 mt-4 lg:mt-0 lg:ml-12">
                        @if ($game['social']['website'])
                            <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                <a href="{{ $game['social']['website']['url'] }}" class="hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                                        <path d="M2 12h20" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                        @if ($game['social']['instagram'])
                            <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                <a href="{{ $game['social']['instagram']['url'] }}" class="hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                        @if ($game['social']['facebook'])
                            <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                <a href="{{ $game['social']['facebook']['url'] }}" class="hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter">
                                        <path
                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                        @if ($game['social']['twitter'])
                            <div class="flex items-center justify-center bg-gray-800 rounded-full">
                                <a href="{{ $game['social']['twitter']['url'] }}" class="hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>

                <p class="max-w-3xl mt-6 text-gray-400">
                    {{ $game['summary'] }}
                </p>

                <div class="mt-12">
                    {{-- <button
                        class="flex p-4 font-semibold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-play">
                            <polygon points="6 3 20 12 6 21 6 3" />
                        </svg>
                        <span class="ml-2">
                            Play Trailer
                        </span>
                    </button> --}}

                    <a href="{{ $game['trailer'] }}"
                        class="inline-flex p-4 font-semibold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-play">
                            <polygon points="6 3 20 12 6 21 6 3" />
                        </svg>
                        <span class="ml-2">
                            Play Trailer
                        </span>
                    </a>
                </div>
            </div>
        </div><!-- End Game Details -->

        <div class="pb-12 mt-8 border-b border-gray-800"> <!-- Game Images -->
            <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
                Images
            </h2>

            <div class="grid grid-cols-1 gap-12 mt-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($game['screenshots'] as $screenshot)
                    <a href="{{ $screenshot['huge'] }}">
                        <img src="{{ $screenshot['big'] }}" alt="screenshot"
                            class="transition duration-150 ease-in-out hover:opacity-75">
                    </a>
                @endforeach
            </div>
        </div> <!-- End Game Images -->


        <div class="pb-12 mt-8"> <!-- Similar Games -->
            <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
                Similar Games
            </h2>

            <div class="grid grid-cols-1 gap-12 text-sm md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                @foreach ($game['similarGames'] as $game)
                    <div class="mt-8">
                        <div class="relative inline-block">
                            <a href="{{ route('games.show', $game['slug']) }}">
                                <img src="{{ $game['coverImageUrl'] }}" alt="cover image"
                                    class="transition duration-150 ease-in-out hover:opacity-75">
                            </a>
                        </div>

                        <a href="{{ route('games.show', $game['slug']) }}"
                            class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">{{ $game['name'] }}</a>
                        {{ $game['platforms'] }}
                    </div>
                @endforeach
            </div>
        </div><!-- End Similar Games -->
    </div> <!-- End Container -->
</x-app-layout>
