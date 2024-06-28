<div class="justify-center  hidden sm:block">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-center font-bold ">{{ __('Name') }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($round_games as $game)
                    <div class="col-span-1 gap-2">
                            @if ($game->local_points || $game->visit_points)
                                <img src="{{ Storage::url($game->visit_team->logo) }}"
                                    class="w-8 h-8 rounded-full border-solid  shadow-xl
                                    {{ $game->visit_points > $game->local_points ? 'shadow-green-500 w-35 h-35' : '' }} ">


                                <div class="text-sm md:text-xl lg:text-2xl text-center {{ $game->winner == 2 ? 'text-green-500 font-bold' : 'text-red-500'  }}">
                                    {{ $game->visit_points }}
                                </div>

                                <img src="{{ Storage::url($game->local_team->logo) }}"
                                    class="w-8 h-8 rounded-full border-solid  shadow-xl
                                    {{ $game->local_points > $game->visit_points ? 'shadow-green-500 w-35 h-35' : '' }} ">

                                <div class="text-sm md:text-xl lg:text-2xl text-center  {{ $game->winner == 1 ? 'text-green-500 font-bold' : 'text-red-500'  }}">
                                    {{ $game->local_points }}
                                </div>
                            @else
                                <img src="{{ Storage::url($game->visit_team->logo) }}" class="w-8 h-8 rounded-full">
                                @if($round_has_games_played)
                                    <br>
                                @endif
                                <img src="{{ Storage::url($game->local_team->logo) }}" class="w-8 h-8 rounded-full">
                            @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-span-1 flex items-center text-center font-bold justify-center ml-2">AC</div>
    </div>
</div>
