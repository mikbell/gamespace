<div wire:init='load'
    class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">

    @foreach ($allGames as $game)
        <x-game-card :game="$game" />
    @endforeach
</div>
