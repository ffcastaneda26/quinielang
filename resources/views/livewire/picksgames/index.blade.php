<div wire:poll>
    <style>
        .text-xxs {
            font-size: 0.65rem;
        }
    </style>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-2 my-2">
        <div class="grid grid-cols-9">
            <div class="col-span-2 text-xs">
                {{ $game->game_date->format('d') . '-' . $game_month }}-{{ $game->game_date->format('y') }}
                {{ $game->game_date->format('h:i A') }}
            </div>

            @if ($is_game_tie_breaker)
                <div class="flex flex-col w-1/6">
                    <img src="{{ Storage::url($game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
                </div>

                <div class="flex flex-col w-1/6">
                    <input type='number' wire:model="visit_points" wire:change="update_points" wire:blur="update_points"
                        min=0 max=99
                        class="text-xxs {{ $errors->has('visit_points') ? 'border border-red-500 border-double' : '' }}
                        {{ $allow_pick ? '' : 'bg-slate-200' }}"
                        {{ $allow_pick ? '' : 'disabled' }} />
                </div>

                <div class="flex flex-col w-1/6">
                    @if ($game_has_result)
                        <img src="{{ $hit_game ? asset('images/afirmativo.png') : asset('images/negativo.png') }}"
                            width="25" height="25">
                    @else
                        <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.jpg')) }}" width="25"
                            height="25">
                    @endif
                </div>

                <div class="flex flex-col w-1/6">
                    <input type='number' wire:model="local_points" wire:change="update_points"
                        wire:blur="update_points" min=0 max=99
                        class="text-xxs {{ $errors->has('local_points') ? 'border border-red-500 border-double' : '' }}
                        {{ $allow_pick ? '' : 'bg-slate-200' }}"
                        {{ $allow_pick ? '' : 'disabled' }} />
                </div>
                <div class="flex flex-col w-1/6">
                    <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">

                </div>
            @else
                @include('livewire.picksgames.pick_visit')
                
                @include('livewire.picksgames.visit_pick')

                @include('livewire.picksgames.pick_icono_acerto')

                @include('livewire.picksgames.local_pick')

                @include('livewire.picksgames.pick_local')
            @endif

        </div>
    </div>
</div>
