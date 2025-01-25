<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistButton extends Component
{
    public $gameSlug;
    public $isInWishlist = false;

    public function mount($gameSlug)
    {
        $this->gameSlug = $gameSlug;

        // Verifica se l'utente è autenticato e se il gioco è nella wishlist
        if (auth()->check()) {
            $this->isInWishlist = auth()->user()
                ->wishlist()
                ->where('game_slug', $gameSlug)
                ->exists();
        }
    }

    public function toggleWishlist()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Devi essere autenticato per modificare la wishlist.');
            return;
        }

        $user = auth()->user();

        if ($this->isInWishlist) {
            $user->wishlist()->where('game_slug', $this->gameSlug)->delete();
            $this->isInWishlist = false;
        } else {
            $user->wishlist()->create(['game_slug' => $this->gameSlug]);
            $this->isInWishlist = true;
        }
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
