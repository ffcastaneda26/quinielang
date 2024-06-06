<div wire:poll>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-2 my-2">
        <div class="grid grid-cols-9">
            <div class="col-span-2">
                {{ $game->game_date->format('d') . '-' . $game_month }}-{{ $game->game_date->format('y') }}
                {{ $game->game_date->format('h:m A') }}
            </div>

            @include('livewire.picksgames.pick_visit')

            {{-- Pronóstico Visita --}}
            @include('livewire.picksgames.visit_pick')

            @include('livewire.picksgames.pick_icono_acerto')

            {{-- Pronóstico Loca --}}
            @include('livewire.picksgames.local_pick')

            @include('livewire.picksgames.pick_local')
        </div>
    </div>
</div>
