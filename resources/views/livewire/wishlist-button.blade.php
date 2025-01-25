<div>
    @if (auth()->check())
        <button wire:click="toggleWishlist" class="flex items-center gap-2 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
            @if (!$isInWishlist)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8" />
                    <path d="M12 8v8" />
                </svg>
                <span>Aggiungi alla Wishlist</span>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8" />
                </svg>
                <span>Rimuovi dalla Wishlist</span>
            @endif
        </button>
    @endif
</div>
