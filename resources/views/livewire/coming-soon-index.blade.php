<div wire:init='load'
    class="grid grid-cols-1 gap-12 pb-16 text-sm border-b border-gray-800 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">

    @forelse ($comingSoon as $game)
        <x-game-card :game="$game" />
    @empty
        @foreach (range(1, 18) as $game)
            <x-game-card-skeleton />
        @endforeach
    @endforelse

    <div class="pagination-controls">
        <button wire:click="previousPage" @if ($currentPage === 1) disabled @endif
            class="px-3 py-2 transition duration-150 ease-in-out bg-gray-800 rounded disabled:opacity-25 hover:bg-gray-700">
            Previous
        </button>

        <span>Page {{ $currentPage }}</span>

        <button wire:click="nextPage"
            class="px-3 py-2 transition duration-150 ease-in-out bg-gray-800 rounded disabled:opacity-25 hover:bg-gray-700">
            Next
        </button>
    </div>
</div>
