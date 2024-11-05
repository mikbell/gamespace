<div wire:init="load" class="w-full mr-0 lg:mr-32 lg:w-3/4">
    <!-- Recently Reviewed -->
    <a href="{{ route('games.recently-reviewed') }}" class="flex items-center text-blue-400 hover:text-blue-500 group">
        <h2 class="font-semibold tracking-wide uppercase transition duration-200">Recently Reviewed</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="h-5 ml-2 transition duration-150 ease-in-out group-hover:translate-x-2">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </a>

    <div class="mt-8 space-y-12">
        @forelse ($recentlyReviewed as $game)
            <a href="{{ route('games.show', $game['slug']) }}"
                class="flex transition duration-150 bg-gray-800 rounded-md shadow-md group hover:bg-gray-700">
                <!-- Game -->
                <div class="relative flex-none">
                    <img src="{{ $game['coverImageUrl'] }}" class="rounded-md">

                    @if ($game['rating'])
                        <div
                            class="absolute bottom-0 right-0 flex items-center justify-center w-12 h-12 -mb-5 -mr-5 bg-gray-900 rounded-full">
                            <div class="text-xs font-semibold text-white">
                                {{ $game['rating'] }}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <div
                        class="block text-base font-semibold leading-tight transition duration-150 ease-in-out group-hover:text-gray-400">
                        {{ $game['name'] }}
                    </div>
                    <div class="mt-1 text-gray-400">
                        {{ $game['platforms'] }}
                    </div>
                    <p class="hidden mt-6 text-gray-400 lg:block">
                        {{ $game['summary'] }}
                    </p>
                </div>
            </a> <!-- End Game -->
        @empty
            @foreach (range(1, 3) as $game)
                <div class="flex bg-gray-800 rounded-lg shadow-md animate-pulse"> <!-- Placeholder Game -->
                    <div class="w-64 bg-gray-600 rounded-md h-96"></div>

                    <div class="p-6">
                        <div class="block w-48 h-6 bg-gray-600 rounded"></div>
                        <div class="inline-block w-32 h-4 mt-1 bg-gray-600 rounded"></div>
                        <div class="hidden mt-6 space-y-2 lg:block">
                            <div class="w-64 h-4 bg-gray-600 rounded"></div>
                            <div class="w-56 h-4 bg-gray-600 rounded"></div>
                            <div class="w-48 h-4 bg-gray-600 rounded"></div>
                        </div>
                    </div>
                </div> <!-- End Placeholder Game -->
            @endforeach
        @endforelse
    </div>
</div><!-- End Recently Reviewed -->
