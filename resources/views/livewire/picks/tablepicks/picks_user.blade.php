<div>
    <div class="flex flex-col  gap-4 ml-2 items-center justify-center py-2">
        <div class="flex flex-row {{ $bg_color_cell }}">
            @if ($game->allow_pick())
                <img src="{{ asset('images/balon.png') }}" class="h-[30px] w-[30px] rounded-full mx-4">
            @else
                @if ($pick_user_game->winner == 1)
                    <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full mx-4">
                @else
                    <img src="{{ Storage::url($game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mx-4">
                @endif
            @endif

        </div>
        @if ($hit_game)
            <img src="{{ asset('images/afirmativo.png') }}" class="h-[15px] w-[15px] rounded-full mx-4">
        @else
            <img src="{{ asset('images/negativo.png') }}" class="h-[15px] w-[15px] rounded-full mx-4">
        @endif
    </div>

</div>
