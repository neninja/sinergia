<?php

namespace App\Broadcasting;

use App\Models\User;

class RoomChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        // validate if user stay in the room
        return true;
    }
}
