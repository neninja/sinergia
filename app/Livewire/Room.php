<?php

namespace App\Livewire;

use App\Events\PlayerVoted;
use App\Models\Player;
use Livewire\Attributes\On;
use Livewire\Component;

class Room extends Component
{
    public string $rangeValue;
    public string $playerName;
    public array $votes = [];

    public function render()
    {
        return view('livewire.room');
    }

    #[On('echo:room,PlayerVoted')]
    public function playerVoted(array $data)
    {
        if (blank($data['player']['name'])) {
            return;
        }

        if ($data['player']['name'] === currentPlayer()->name) {
            return;
        }

        $this->votes = array_filter($this->votes, fn($vote) => $vote['player'] !== $data['player']['name']);
        $this->votes[] = ['player' => $data['player']['name'], 'value' => $data['vote']];
    }

    public function voteClicked($percentage)
    {
        PlayerVoted::dispatch(currentPlayer(), $percentage);
    }

    public function handleStart()
    {
        session()->put('player', new Player(['name' => $this->playerName]));
    }
}
