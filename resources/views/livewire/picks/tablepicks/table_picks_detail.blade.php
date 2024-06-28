<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-center font-bold text-xxs ">{{ $user->alias }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($user->picks as $pick)
                    <div class="col-span-1 gap-2">
                        {{-- Necestiamos calcular:
                            $game->allow_pick())
                            $pick->winner
                            $hit_game
                            $is_last_game

                        --}}

                        @if ($pick->game->allow_pick())
                            <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.jpg')) }}"
                                class="w-4 h-4 rounded-full">
                        @else
                            <div>
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

    </div>
</div>

<div class="justify-center  hidden sm:block">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-start ">{{ $user->alias }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($user->picks as $pick)
                    <div class="col-span-1 gap-2">
                        @livewire('picks.table-picks.user-pick', ['pick' => $pick], key('pick-' . $pick->id))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
