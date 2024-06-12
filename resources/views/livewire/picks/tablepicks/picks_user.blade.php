<div>
    <div class="flex flex-col  gap-4 ml-2 items-center justify-center py-2 bg-white">
        <div class="flex flex-row {{ $bg_color_cell }}">
            @if ($game->allow_pick())
                <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.jpg')) }}"
                    class="h-[30px] w-[30px] rounded-full mx-4">
            @else
                <div>
                    <img src="{{ Storage::url($pick_user_game->winner == 1 ? $game->local_team->logo : $game->visit_team->logo) }}"
                        class="h-[30px] w-[30px] rounded-full mx-4">
                    @if ($is_last_game)
                        {{ $visit_points . '-' . $local_points }}
                    @endif
                </div>

            @endif

        </div>

        @if ($has_result)
            <img src="{{ $hit_game ? asset('images/afirmativo.png') : asset('images/negativo.png') }}"
                class="h-[15px] w-[15px] rounded-full mx-4">
        @endif

    </div>

</div>
