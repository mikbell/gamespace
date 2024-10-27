<div wire:init="load" class="mt-8 space-y-10"><!-- Most Anticipated -->
    @forelse ($mostAnticipated as $game)
        <x-game-card-small :game="$game" />
    @empty
        @foreach (range(1, 4) as $game)
            <div class="flex animate-pulse"> <!-- Game -->
                <div class="w-20 bg-gray-600 rounded-md h-28"></div> <!-- Image Placeholder -->

                <div class="ml-4">
                    <div class="block w-32 h-6 bg-gray-600 rounded selection:hidden"></div> <!-- Title Placeholder -->
                    <div class="w-24 h-4 mt-1 bg-gray-600 rounded selection:hidden"></div> <!-- Release Date Placeholder -->
                </div>
            </div> <!-- End Game -->
        @endforeach
    @endforelse
</div><!-- End Most Anticipated -->
