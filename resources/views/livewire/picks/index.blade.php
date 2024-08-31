<div  class="container w-full mx-auto flex flex-col items-center ">
    <div class="flex flex-row justify-center dark:text-white mt-2">
       PRONÓSTICOS
    </div>
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    @if( $allowUpdateMasive)
        <div class="flex flex-row justify-between gap-4 mb-2">
            <x-button wire:click="update_picks('local')">LOCAL</x-button>
            <x-button wire:click="update_picks('visit')">VISITA</x-button>
            <x-button wire:click="update_picks('random')">RANDOM</x-button>
        </div>
        {{-- <div class="flex dark:text-white">
            Ronda: {{ $selected_round->id  . ' Son un total de: '. $selected_round->hasAllowableGames()->count() . 'Partidos' }}
            <br>
            <ul>
                @foreach ( $selected_round->hasAllowableGames() as $allowableGame)
                    <li>{{ $allowableGame->id . '=' . $allowableGame->game_date}}</li>
                @endforeach
            </ul>


        </div> --}}
    @endif



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
