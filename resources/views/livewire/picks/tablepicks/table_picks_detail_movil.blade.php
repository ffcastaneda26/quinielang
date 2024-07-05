<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="w-full grid grid-cols-12 border">

        <div class="col-span-2 flex items-center text-center font-bold text-xxs ">{{ $user->alias }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($user->picks->sortBy('game.game_date') as $pick)
                    <div class="col-span-1 gap-2">
                        @if ($pick->game->allow_pick())
                            <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.jpg')) }}"
                                class="w-4 h-4 rounded-full">
                        @else
                            <div class="text-xxs">
                                <img src="{{ Storage::url($pick->winner == 1 ? $pick->game->local_team->logo
                                                                             : $pick->game->visit_team->logo) }}"
                                    class="w-4 h-4 rounded-full  {{ $pick->winner == $pick->game->winner ? 'shadow-xl shadow-green-500' : 'grayscale' }}">
                                @if ($pick->game->id_game_tie_breaker())
                                    {{ $visit_points . '-' . $local_points }}
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        @if($user->positions->first())
            <div class="col-span-1 flex items-center justify-center font-bold text-xxs ">{{ $user->positions->first()->hits }}</div>
        @endif

    </div>
</div>
