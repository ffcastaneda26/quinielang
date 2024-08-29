<div  wire:poll class="container w-full mx-auto flex flex-col items-center ">
    <div class="flex flex-row justify-center dark:text-white mt-2">
       PRONÓSTICOS
    </div>
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    <div class="w-auto flex flex-col items-center">
        @include('livewire.picksgames.header_table')

        @foreach ($round_games as $game)
             <div class="container mx-auto  bg-gray-100 rounded-md px-4">
                @livewire('picks.pick-game',
                    ['game' => $game,
                     'id_game_tie_breaker' => $id_game_tie_breaker,
                     'configuration' => $configuration],
                key($game->id))
            </div>
        @endforeach

    </div>

</div>
