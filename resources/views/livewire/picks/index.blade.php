<div class="container w-full mx-auto flex flex-col items-center">
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>
    <div class="w-full flex flex-col items-center">
        <div class="w-full bg-gray-800 text-white text-center font-bold ">
            <div class="grid grid-cols-8">
                <div class="col-span-1">{{ __('Date') }}</div>
                <div class="col-span-2">{{ __('Visit') }}</div>
                <div class="col-span-3">{{ __('Pick') }}</div>
                <div class="col-span-2">{{ __('Local') }}</div>
            </div>
        </div>

        @foreach ($round_games as $game)
            <div class="container mx-auto  bg-gray-100 rounded-md px-4">
                @livewire('picks.pick-game', ['game' => $game, 'id_game_tie_breaker' => $id_game_tie_breaker, 'configuration' => $configuration], key($game->id))
            </div>
        @endforeach
    </div>
</div>
