<?php

namespace App\Livewire;

use App\Events\GameStarted;
use App\Events\StartGameIntended;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function handleStartGame()
    {
        GameStarted::dispatch(auth()->user());
    }
}
