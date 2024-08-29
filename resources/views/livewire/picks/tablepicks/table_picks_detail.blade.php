{{-- Pronósticos por Usuario --}}
@foreach ($users as $user )
    <div class="w-full grid grid-cols-12 border bg-white">
        <div class="col-span-2 flex items-center text-center border font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">{{ $user->alias }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-1 justify-between items-center border bg-white text-black">
                @foreach ($user->picks->sortBy('game.game_date') as $pick)
                    <div class="col-span-1 flex items-center border justify-center font-bold ">
                        @if ($pick->game->allow_pick())
                            <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.png')) }}"
                                class="w-4 h-4 rounded-full">
                        @else
                            <div class="flex flex-col justify-center items-center border text-xxs sm:text-sm md:text-lg lg:text-2xl">
                                <div class="flex justify-center items-center">
                                        <img src="{{ Storage::url($pick->winner == 1 ? $pick->game->local_team->logo : $pick->game->visit_team->logo) }}"
                                            class="w-4 h-4 rounded-full shadow-md  {{ $pick->winner == $pick->game->winner ? 'shadow-green-500' : 'grayscale' }}"
                                        >
                                </div>

                                @if($pick->winner == $pick->game->winner)
                                    <div class="flex flex-col justify-center items-center text-center">
                                        <img src="{{ asset('images/afirmativo.png') }}"
                                        class="w-1">
                                    </div>
                                @endif
                                @if($pick->game->visit_points && $pick->game->local_points && $pick->game->is_last_game())
                                    <div class="flex flex-col justify-center items-center text-center">
                                        <p style="font-size: 0.5rem">
                                            {{ $pick->game->visit_points . '-' . $pick->game->local_points }}</p>
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
