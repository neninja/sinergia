<?php

namespace App\Listeners;

use App\Events\PlayerVoted;
use Illuminate\Events\Dispatcher;

class GameEventSubscriber
{
    public function subscribe(Dispatcher $events): array
    {
        return [
            GameStarted::class => 'handleGameStarted',
            PlayerVoted::class => 'handlePlayerVoted',
        ];
    }

    public function handleStartGameIntended(StartGameIntended $event)
    {
        $event->user->startGame();
    }
}
