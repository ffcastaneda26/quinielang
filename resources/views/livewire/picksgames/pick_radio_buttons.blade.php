{{-- Pronostica que gana Local --}}
<td align="center">
    <input type="radio"
            wire:model="pick_user_winner"
            wire:click="update_winner_game"
            value="2"
            {{ $allow_pick  ? '' : 'disabled' }}
            {{ $pick_user_winner === 2 ? 'checked' : '' }}
    />
</td>

{{-- Icono si acertó/falló o aún no se sabe --}}
@if($game_has_result)
    @include('livewire.picksgames.pick_icono_acerto')
@endif

{{-- Pronostica que gana Local --}}
<td align="center">
    <input type="radio"
                wire:model="pick_user_winner"
                wire:click="update_winner_game"
                name="winner-game{{ $game->id }}"
                value="1"
                {{ $allow_pick  ? '' : 'disabled' }}
                {{ $pick_user_winner === 1 ? 'checked' : '' }}
        />

</td>
