    <div>
        <input type="radio"
            wire:model.live="pick_user_winner"
            wire:click="update_winner_game"
            name="winner-game{{ $game->id }}"
            id="winner-game{{ $game->id }}"
            style="{{  $allow_pick  ? '' :  'background-color: gray'}}"
            value="1"
            {{ $allow_pick ? '' : 'disabled' }}
            {{ $pick_user_winner === 1 ? 'checked' : '' }}
            {{ $is_game_tie_breaker ? 'disabled' : '' }}
        />
    </div>
