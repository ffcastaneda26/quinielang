<div>
    @if ($game->allow_pick())
        <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.png')) }}"
            class="w-2 rounded-full">
    @else
        <div>
            <img src="{{ Storage::url($pick->winner == 1 ? $game->local_team->logo : $game->visit_team->logo) }}"
                class="w-8 h-8 rounded-full  {{ $hit_game ? 'shadow-xl shadow-green-500' : 'grayscale' }}">
            @if ($is_last_game)
                {{ $visit_points . '-' . $local_points }}
            @endif
        </div>
    @endif
</div>
