<div wire:poll>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-2 my-2">
        <div class="grid grid-cols-9">
            <div class="col-span-2 text-xs">
                {{ $game->game_date->format('d') . '-' . $game_month }}-{{ $game->game_date->format('y') }}
                {{ $game->game_date->format('h:i A') }}
            </div>

            <div class="col-span-2 flex flex-row">
                <img src="{{ Storage::url($game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
                <span>{{ $game->visit_team->short }}</span>
            </div>
            {{-- @include('livewire.picksgames.pick_visit') --}}

            {{-- Pronóstico Visita --}}

            @include('livewire.picksgames.visit_pick')

            @include('livewire.picksgames.pick_icono_acerto')

            {{-- Pronóstico Loca --}}
            @include('livewire.picksgames.local_pick')

            <div class="col-span-2">
                <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
                <span class="{{ $is_game_tie_breaker ? 'hidden' : '' }}">{{ $game->local_team->short }}</span>
            </div>

            {{-- @include('livewire.picksgames.pick_local') --}}
        </div>
    </div>
</div>
