<div class="mt-8 space-y-10"><!-- Coming Soon -->
    @foreach ($comingSoon as $game)
        <div class="flex"> <!-- Game -->
            <a href="{{ route('games.show', $game['slug']) }}">
                @if (isset($game['cover']))
                    <img src="{{ str_replace('thumb', 'cover_small', $game['cover']['url']) }}"
                        class="transition duration-150 ease-in-out hover:opacity-75">
                @else
                    <div class="w-16 h-24 transition duration-150 bg-gray-600 hover:opacity-75 ease in out">
                    </div>
                @endif
            </a>

            <div class="ml-4">
                <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400">
                    {{ $game['name'] }}
                </a>
                <div class="mt-1 text-sm text-gray-400">
                    {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}</div>
            </div>
        </div> <!-- End Game -->
    @endforeach
</div><!-- End Coming Soon -->
