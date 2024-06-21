@if($is_game_tie_breaker)
        <input type='number'
                wire:model="visit_points"
                wire:change="update_points"
                wire:blur="update_points"
                min=0
                max=99
                class="text-xs w-full" {{ $errors->has('visit_points') ? 'border border-red-500 border-double' : '' }}
                                        {{ $allow_pick ? '' : 'bg-slate-200' }}"
                {{ $allow_pick ? '' : 'disabled' }}
            />
        @error('visit_points')
            <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
        @enderror
@else

    <input type="radio"
        wire:model.live="pick_user_winner"
        wire:click="update_winner_game"
        name="winner-game{{ $game->id }}"
        id="winner-game{{ $game->id }}"
        value="2"
        {{ $allow_pick ? '' : 'disabled' }}
        {{ $pick_user_winner == 2 ? 'checked' : '' }}
    />
@endif
