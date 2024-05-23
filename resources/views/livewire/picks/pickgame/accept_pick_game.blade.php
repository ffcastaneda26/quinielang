@if ($is_game_tie_breaker)
    @include('livewire.picks.pickgame.tie_breaker_game')
@else
    <td>
        <input type="radio" wire:model.live="pick_user_winner" wire:click="update_winner_game"
            name="winner-game{{ $game->id }}" value="2" {{ $allow_pick ? '' : 'disabled' }}
            {{ $pick_user_winner === 2 ? 'checked' : '' }} />
    </td>
    @include('livewire.picks.pickgame.icono_acerto')


    <td>
        <input type="radio" wire:model.live="pick_user_winner" wire:click="update_winner_game"
            name="winner-game{{ $game->id }}" value="1" {{ $allow_pick ? '' : 'disabled' }}
            {{ $pick_user_winner === 1 ? 'checked' : '' }} />
    </td>
@endif
