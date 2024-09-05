<div class="flex flex-col justify-center items-center h-screen p-4" x-data="{
    votes: @entangle('votes').live,
    rangeValue: 50,
    sortedVotes() {
        const votes = Object.entries(this.votes).map(([i, data]) => ({ player: data.player, value: data.value }));
        return votes.slice().sort((a, b) => b.value - a.value);
    },
    handleRangeChange(event) {
        this.rangeValue = event.target.value;
        this.$wire.voteClicked(this.rangeValue);
    }
}">
    @if(blank(currentPlayer()))
        <div class="flex flex-col space-y-4">
            <input type="text" wire:model.blur="playerName" wire:keydown.enter="handleStart" class="p-2 border border-gray-300 rounded" placeholder="Nome do jogador">
            <button wire:click="handleStart" class="p-2 bg-blue-500 text-white rounded">Iniciar jogo</button>
        </div>
    @else
        <div class="flex flex-row justify-between w-full max-w-5xl h-full">
            <ul class="flex flex-col space-y-2">
                <template x-for="vote in sortedVotes()" :key="vote.player">
                    <li x-text="vote.player + ' votou'"></li>
                </template>
            </ul>
            <div class="flex">
            <div class="relative w-5 h-full" x-ref="bar" style="background: linear-gradient(to bottom, red, blue);">
                <template x-for="(vote, index) in votes" :key="index">
                    <div class="absolute left-0 w-full" :style="{ top: (100 - vote.value) + '%' }">
                        <div class="bg-green-500 w-2 h-2 rounded-full"></div>
                    </div>
                </template>
                <div class="absolute left-0 w-full border-t-2 border-black" :style="{ top: (100 - rangeValue) + '%' }"></div>
            </div>
            <input type="range" min="0" max="100" x-model="rangeValue" @input.change.throttle.750ms="handleRangeChange" orient="vertical">
            </div>
        </div>
    @endif
</div>
