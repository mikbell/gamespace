<div class="relative">
    <input wire:model.debounce.300ms="search" wire:keyup="loadSearchResults" type="text" name="query"
        aria-label="Search games" class="w-64 px-3 py-1 pl-8 text-sm bg-gray-800 rounded-full" placeholder="Search...">
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </div>

    <div wire:loading class="absolute top-0 right-0 mt-1 mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="h-6 lucide lucide-loader-circle animate-spin">
            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
        </svg>
    </div>

    @if (strlen($search) > 2)

        @if (count($searchResults) > 0)
            <div class="absolute z-50 w-64 mt-2 text-xs bg-gray-800 rounded" aria-live="polite">
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('games.show', ['slug' => $result['slug']]) }}"
                                class="flex items-center px-4 py-2 transition duration-150 ease-in-out hover:bg-gray-700">
                                <img src="{{ $result['coverImageUrl'] }}" class="w-10" alt="cover">
                                <span class="ml-4">{{ $result['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="absolute z-50 w-64 mt-2 bg-gray-800 rounded">No results for "{{ $search }}"</div>
        @endif

    @endif
</div>
