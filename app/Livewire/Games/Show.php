<?php

namespace App\Livewire\Games;

use Livewire\Component;

class Show extends Component
{
    public function mount($slug)
    {
        $this->loadGame($slug);
    }
    
    public function render()
    {
        return view('livewire.pages.games.show');
    }
}
