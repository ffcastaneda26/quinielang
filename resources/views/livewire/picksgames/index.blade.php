<div wire:poll>
    <style>
        input[type="radio"] {
            background-color: white; /* Cambiar el color de fondo a rojo */
        }
        input[type="radio"]:checked {
            background-color: blue; /* Cambiar el color de fondo a rojo */
        }
        input[type="radio"]:disabled {
            background-color: gray; /* Cambiar el color de fondo a rojo */
        }
    </style>


    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-1 my-1">
        <div class="grid grid-cols-9">
            <div class="col-span-2 text-xs">
                {{ $game->game_date->format('d') . '-' . $game_month }}-{{ $game->game_date->format('y') }}
                {{ $game->game_date->format('h:i A') }}
            </div>

            @include('livewire.picksgames.pick_visit')

            @include('livewire.picksgames.visit_pick')

            @include('livewire.picksgames.pick_icono_acerto')

            @include('livewire.picksgames.local_pick')

            @include('livewire.picksgames.pick_local')
            @if($is_game_tie_breaker)
                @include('livewire.picksgames.picks_last_game')
            @endif

        </div>
    </div>
</div>
