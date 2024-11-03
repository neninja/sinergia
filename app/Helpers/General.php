<?php

function currentPlayer()
{
    return session()->get('auth:player', function () {
        throw new Exception('No player in session.');
    });
}

function currentPlayerOrNull()
{
    return session()->get('auth:player', null);
}
