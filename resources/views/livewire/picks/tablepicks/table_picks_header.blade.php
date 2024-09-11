<div class="w-full grid grid-cols-12 border bg-white text-black">

    <div class="{{ $show_mnf_column ? 'col-span-1' : 'col-span-2'}} flex items-center text-center border font-bold bg-white text-black" style="font-size: {{ $show_mnf_column ? '0.45rem' : '0.75rem' }}">{{ __('Name') }}</div>
    <div class="col-span-9 bg-white text-black">
        <div class="flex flex-row gap-1 justify-between items-center border bg-white text-black">
            @foreach ($round_games as $game)
                <div class="col-span-1 gap-1">
                        @if ($game->local_points || $game->visit_points)
                            <img src="{{ Storage::url($game->visit_team->logo) }}"
                                class="w-4 h-4 rounded-full border-solid  shadow-xl
                                {{ $game->visit_points > $game->local_points ? 'shadow-green-500 w-35 h-35' : '' }} ">
                            <div class="text-xxs {{ $game->winner == 2 ? 'text-green-500 font-bold' : 'text-red-500'  }}">
                                {{ $game->visit_points }}
                            </div>
                            <img src="{{ Storage::url($game->local_team->logo) }}"
                                class="w-4 h-4 rounded-full border-solid  shadow-xl
                                {{ $game->local_points > $game->visit_points ? 'shadow-green-500 w-35 h-35' : '' }} ">

                            <div class="text-xxs {{ $game->winner == 1 ? 'text-green-500 font-bold' : 'text-red-500'  }}">
                                {{ $game->local_points }}
                            </div>
                        @else
                            <img src="{{ Storage::url($game->visit_team->logo) }}" class="w-4 h-4 rounded-full">
                            @if($round_has_games_played)
                                <br>
                            @else
                                <hr>
                            @endif
                            <img src="{{ Storage::url($game->local_team->logo) }}" class="w-4 h-4 rounded-full">
                        @endif
                </div>
            @endforeach

        </div>
    </div>
    @if($show_mnf_column )
        <div class="col-span-1 flex items-center text-center font-bold justify-center ml-2  bg-white text-black text-xxs sm:text-sm md:text-lg lg:text-2xl">
           <div class="flex flex-col jutify-center items-center gap-1">
                <div>MNF</div>
                <div>
                    <p>
                        <label class="{{ $last_game_round->visit_points > $last_game_round->local_points ? 'text-green-500' : 'text-red-500'}}">{{ $last_game_round->visit_points }}</label>
                        -
                        <label class="{{ $last_game_round->local_points > $last_game_round->visit_points ? 'text-green-500' : 'text-red-500'}}">{{ $last_game_round->local_points }}</label>
                       </p>
                </div>
           </div>
        </div>
    @endif
    <div class="col-span-1 flex items-center text-center font-bold justify-center ml-2 text-xxs bg-white text-black" style="font-size: {{ $show_mnf_column ? '0.45rem' : '0.75rem' }}">AC</div>
</div>
