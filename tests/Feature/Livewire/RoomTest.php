<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RoomTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Room::class)
            ->assertStatus(200);
    }
}
