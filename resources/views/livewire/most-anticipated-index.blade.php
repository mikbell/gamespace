<div wire:init='load'>
    <div class="grid grid-cols-1 gap-12 pb-16 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">

        @forelse ($mostAnticipated as $game)
            <x-game-card :game="$game" />
        @empty
            @foreach (range(1, 18) as $game)
                <x-game-card-skeleton />
            @endforeach
        @endforelse


    </div>

    <div class="flex justify-center">
        <button wire:click="nextPage" @if (!$hasMorePages) disabled @endif
            class="px-3 py-2 transition duration-150 ease-in-out bg-gray-800 rounded disabled:opacity-25 disabled:hover:bg-gray-800 hover:bg-gray-700">
            Load More
        </button>
    </div>

</div>