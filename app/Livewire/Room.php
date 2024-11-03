<?php

namespace App\Livewire;

use App\Events\GameStarted;
use App\Events\PlayerStarted;
use App\Events\PlayerJoined;
use App\Events\StartGameIntended;
use App\Events\PlayerVoted;
use App\Models\Player;
use Livewire\Attributes\On;
use Livewire\Component;

class Room extends Component
{
    public string $rangeValue;
    public string $playerName;
    public array $votes = [];
    public array $allPlayers;

    public function mount()
    {
        PlayerJoined::dispatch(auth()->user());
        $this->allPlayers = cache()->get('all-players', []);
    }

    public function render()
    {
        return view('livewire.room');
    }

    #[On('echo-presence:room,joining')]
    public function joining(array $data)
    {
        $this->allPlayers[] = $data['name'];
    }

    #[On('echo-presence:room,leaving')]
    public function leaving(array $data)
    {
        $this->allPlayers = array_filter($this->allPlayers, fn($player) => $player !== $data['name']);
    }

    #[On('echo-presence:room,here')]
    public function here($data)
    {
        $this->allPlayers = array_map(fn($player) => $player['name'], $data);
    }

    #[On('echo-presence:room,PlayerJoined')]
    public function resetPlayers($data)
    {
        dd('opa');
        $playerName = $data['player']['name'];

        $this->allPlayers = cache()->get('all-players', []);

        if (!in_array($playerName, $this->allPlayers)) {
            $this->allPlayers[] = $playerName;
        }

        cache()->put('all-players', $this->allPlayers);
    }

    #[On('echo:room,PlayerVoted')]
    public function playerVoted(array $data)
    {
        $this->votes = array_filter($this->votes, fn($vote) => $vote['player'] !== $data['player']['name']);
        $this->votes[] = ['player' => $data['player']['name'], 'value' => $data['vote']];
    }

    public function voteClicked($percentage)
    {
        PlayerVoted::dispatch(auth()->user(), $percentage);
    }

    public function handleStartGame()
    {
        if (count($this->allPlayers) < 2) {
            return;
        }

        if (!auth()->user()->is_admin) {
            return;
        }

        $order = collect($this->allPlayers)->shuffle()->toArray();
        cache()->put('room:order', $order);
        cache()->put('room:current_player', 0);
        GameStarted::dispatch();
        PlayerStarted::dispatch($order[0]);
    }
}
