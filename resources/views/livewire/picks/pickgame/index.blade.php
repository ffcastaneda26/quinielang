<div>
    <td>{{ $game->id }}</td>
    <td>
        {{ $game_day . '-' . $game_month }}-{{ $game->game_date->format('y') }} {{ $game->game_time->format('H:i') }}
    </td>

    @include('livewire.picks.pickgame.visit_cols')

    @include('livewire.picks.pickgame.accept_pick_game')

    @include('livewire.picks.pickgame.local_cols')
</div>
