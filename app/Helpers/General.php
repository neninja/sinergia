<?php

function currentPlayer()
{
    return session()->get('player');
}
