<?php

namespace App\Livewire;

use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|min:2|max:20', as: 'nome')]
    public string $playerName;

    public function render()
    {
        return view('livewire.login');
    }

    public function handleStart()
    {
        /*session()->put('auth:player', new Player(['name' => $this->playerName]));*/
        $user = User::create(['name' => $this->playerName]);
        Auth::login($user);
        /*redirect()->to('/room');*/
    }
}
