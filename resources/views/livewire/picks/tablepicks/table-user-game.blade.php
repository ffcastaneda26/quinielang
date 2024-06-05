<div class="w-auto col-span-7 border border-black text-center">
    <div class="flex flex-row">
        @foreach ($round_games as $game)

            {{-- @livewire('table-pick-user-game', ['game' => $game, 'user' => $user], key($game->id)) --}}
        @endforeach
    </div>
</div>
