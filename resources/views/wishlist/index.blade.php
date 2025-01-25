<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">La tua Wishlist</h1>

        @if ($wishlistGames->isEmpty())
            <p class="mt-4">Non hai ancora aggiunto giochi alla tua wishlist.</p>
        @else
            <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($wishlistGames as $game)
                    <a href="{{ route('games.show', $game->game_slug) }}" class="p-4 bg-gray-800 rounded-lg">
                        <p>{{ $game->game_slug }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
