<div wire:init='load'
    class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
    <!-- Popular Games -->

    @forelse ($popularGames as $game)
        <x-game-card :game="$game" />
    @empty
        @foreach (range(1, 12) as $game)
            <div class="mt-8 animate-pulse">
                <div class="bg-gray-600 rounded-md w-52 h-72"></div> <!-- Image placeholder -->

                <div class="block w-48 h-6 mt-4 bg-gray-600 rounded selection:hidden"></div> <!-- Title placeholder -->
                <div class="inline-block w-32 h-4 mt-1 bg-gray-600 rounded selection:hidden"></div> <!-- Platforms placeholder -->
            </div>
        @endforeach
    @endforelse
</div> <!-- End Popular Games -->
