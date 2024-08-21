<div>
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    {{-- @include('livewire.picks.tablepicks.table_picks_header') --}}
    {{-- Encabezado: Tabla de Partidos --}}
    <div class="w-full grid grid-cols-12 border bg-white text-black">
        <div class="col-span-2 flex items-center text-center font-bold bg-white text-black">{{ __('Name') }}</div>
        <div class="col-span-9 bg-white text-black">
            <div class="flex flex-row gap-2 justify-between items-center border bg-white text-black">
                @foreach ($round_games as $game)
                    <div class="col-span-1 gap-2">
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
        <div class="col-span-1 flex items-center text-center font-bold justify-center ml-2 bg-white text-black">AC</div>
    </div>


    {{-- @include('livewire.picks.tablepicks.table_picks_detail') --}}
    {{-- Pronósticos por Usuario --}}

    {{-- Código antes de preguntar a Gemini --}}
    @foreach ($users as $user )
        <div class="w-full grid grid-cols-12 border bg-white">
            <div class="col-span-2 flex items-center text-center border font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">{{ $user->alias }}</div>
            <div class="col-span-9">
                <div class="flex flex-row gap-2 justify-between items-center border bg-white text-black">
                    @foreach ($user->picks->sortBy('game.game_date') as $pick)
                        {{-- <div class="col-span-1 gap-2 justify-center items-center"> --}}
                        <div class="col-span-1 flex items-center border justify-center font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">
                            @if ($pick->game->allow_pick())
                                <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.png')) }}"
                                    class="w-4 rounded-full">
                            @else
                                <div class="flex flex-col justify-center items-center border text-xxs sm:text-sm md:text-lg lg:text-2xl">
                                    <div class="flex justify-center items-center">
                                        {{-- <img src="{{ Storage::url($pick->winner == 1 ? $pick->game->local_team->logo
                                                                                    : $pick->game->visit_team->logo) }}"
                                            class="w-8 md:w-16 rounded-full shadow-xl
                                            {{ $pick->winner == $pick->game->winner ? 'shadow-green-500 w-35 h-35' : 'grayscale' }} "> --}}
                                            <img src="{{ Storage::url($pick->winner == 1 ? $pick->game->local_team->logo : $pick->game->visit_team->logo) }}"
                                                class="w-4 sm:w-16 rounded-full outline-double {{ $pick->winner == $pick->game->winner ? 'border-4 border-green-500 shadow-md' : 'border-4 border-red-500 shadow-md' }}"
                                            >
                                    </div>
                                     @if($pick->winner == $pick->game->winner)
                                        <div class="flex flex-col justify-center items-centertext-center">
                                            <img src="{{ asset('images/afirmativo.png') }}"
                                            class="w-1">
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-1 flex items-center border justify-center font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">
                {{ $user->positions->first() ? $user->positions->first()->hits : ''}}
            </div>

        </div>
    @endforeach
    <div class="flex justify-end">
        {{ $users->links() }}
    </div>

</div>
