<div wire:init='load'>
    <div class="grid grid-cols-1 gap-12 pb-16 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">

        @forelse ($recentlyReviewed as $game)
            <x-game-card :game="$game" />
        @empty
            @foreach (range(1, 18) as $game)
                <x-game-card-skeleton />
            @endforeach
        @endforelse


    </div>

    <div>
        <div class="flex items-center justify-center">Page: {{ $currentPage }}</div>
        <div class="flex items-center justify-center gap-2">
            <button wire:click="previousPage" @if ($currentPage === 1) disabled @endif
                class="px-3 py-2 transition duration-150 ease-in-out bg-gray-800 rounded disabled:opacity-25 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>

            <button wire:click="nextPage"
                class="px-3 py-2 transition duration-150 ease-in-out bg-gray-800 rounded disabled:opacity-25 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>
    </div>

</div>