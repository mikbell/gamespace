<div wire:init="load" class="mt-8 space-y-10"><!-- Most Anticipated -->
    <a href="{{ route('games.most-anticipated') }}" class="flex items-center text-blue-400 hover:text-blue-500 group">
        <h2 class="font-semibold tracking-wide uppercase transition duration-200">Most Anticipated</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="h-5 ml-2 transition duration-150 ease-in-out group-hover:translate-x-2">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </a>
    @forelse ($mostAnticipated as $game)
        <x-game-card-small :game="$game" />
    @empty
        @foreach (range(1, 4) as $game)
            <div class="flex animate-pulse"> <!-- Game -->
                <div class="w-20 bg-gray-600 rounded-md h-28"></div> <!-- Image Placeholder -->

                <div class="ml-4">
                    <div class="block w-32 h-6 bg-gray-600 rounded selection:hidden"></div> <!-- Title Placeholder -->
                    <div class="w-24 h-4 mt-1 bg-gray-600 rounded selection:hidden"></div>
                    <!-- Release Date Placeholder -->
                </div>
            </div> <!-- End Game -->
        @endforeach
    @endforelse
</div><!-- End Most Anticipated -->
