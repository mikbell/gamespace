<div wire:init='load'>
    <a href="{{ route('games.popular-games') }}" class="flex items-center text-blue-400 hover:text-blue-500 group">
        <h2 class="font-semibold tracking-wide uppercase transition duration-200">Popular Games</h2>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="h-5 ml-2 transition duration-150 ease-in-out group-hover:translate-x-2">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </a>
    <div
        class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
        <!-- Popular Games -->

        @forelse ($popularGames as $game)
            <x-game-card :game="$game" />
        @empty
            @foreach (range(1, 12) as $game)
                <x-game-card-skeleton />
            @endforeach
        @endforelse
    </div> <!-- End Popular Games -->
</div>
