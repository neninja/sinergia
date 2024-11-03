<div class="flex flex-col justify-center items-center h-screen p-4">
    <div class="flex flex-col space-y-4">
        <input type="text" wire:model.blur="playerName" wire:keydown.enter="handleStart" class="p-2 border border-gray-300 rounded" placeholder="Nome do jogador">
        @error('playerName') <span class="text-red-500">{{ $message }}</span> @enderror
        <button wire:click="handleStart" class="p-2 bg-blue-500 text-white rounded">Iniciar jogo</button>
    </div>
</div>
