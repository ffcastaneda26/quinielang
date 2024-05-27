<div wire:poll>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-2 my-2">
        <div class="grid grid-cols-9">
            <div class="col-span-2">
                {{ $game_day . '-' . $game_month }}-{{ $game->game_date->format('y') }} {{ $game->game_time->format('H:i') }}
            </div>

            @include('livewire.picksgames.pick_visit')


            @include('livewire.picksgames.pick_icono_acerto')


            @include('livewire.picksgames.pick_local')
        </div>
    </div>
</div>

