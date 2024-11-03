<?php

use App\Http\Middleware\EnsurePlayerSession;
use App\Livewire\Room;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');
Route::get('/impersonate', function () {
    auth()->login(\App\Models\User::where('is_admin', true)->first());
    return redirect()->to('/room');
});

/*Route::middleware(EnsurePlayerSession::class)->group(function () {*/
Route::middleware('auth:web')->group(function () {
    Route::get('/room', Room::class);

    Route::prefix('/admin')->middleware(['admin'])->group(function () {
        Route::get('/', Dashboard::class);
        // /pulse to reverb
    });
});
