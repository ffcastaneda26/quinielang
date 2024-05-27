@if ($is_game_tie_breaker)
    @include('livewire.picksgames.pick_tie_braker_game_cols')
@else
    {{-- Pronostica que gana visita --}}
    <div class="col flex justify-center">
        <div class="flex flex-col justify-center">
            <input type="radio"
                    wire:model="pick_user_winner"
                    wire:click="update_winner_game"
                    name="winner-game{{ $game->id }}"
                    value="2"
                    {{ $allow_pick ? '' : 'disabled' }}
                    {{ $pick_user_winner === 2 ? 'checked' : '' }}
            />
        </div>
    </div>

    @include('livewire.picksgames.pick_icono_acerto_cols')

    {{-- Pronostica que gana Local --}}
    <div class="col flex justify-center">
        <div class="flex flex-col justify-center">
            <input type="radio"
                    wire:model="pick_user_winner"
                    wire:click="update_winner_game"
                    name="winner-game{{ $game->id }}"
                    value="1"
                    {{ $allow_pick ? '' : 'disabled' }}
                    {{ $pick_user_winner === 1 ? 'checked' : '' }}
            />
        </div>
    </div>
@endif
