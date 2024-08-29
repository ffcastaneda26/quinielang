<div class="container w-full mx-auto flex flex-col items-center mt-2 bg-black text-white">
    <div class="mt-2 p-2 w-full flex justify-center text-sml text-black dark:text-white">
        POSICIONES X JORNADA
    </div>
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    @if ($records->count())
        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-center font-bold  bg-black text-white">
                        <th class="px-4 w-10 uppercase text-xxs sm:text-sm border border-white">Pos</th>
                        <th class="px-4 w-70 uppercase text-xxs sm:text-sm border border-white">{{ __('Name') }}</th>
                        <th class="px-4 w-10 uppercase text-xxs sm:text-sm border border-white">PTS</th>
                        @if($show_mnf_column)
                            <th class="px-4 w-10 uppercase text-xxs sm:text-sm border border-white">MNF</th>
                            <th class="text-xxs sm:text-sm border border-white">
                                @if($last_game_round->visit_points || $last_game_round->local_points)
                                    {{ $last_game_round->visit_points  .'-' . $last_game_round->local_points  }}
                                @else
                                    <img src="{{ asset('images/reloj.png') }}"  class="h-[15px] w-[15px] rounded-full">
                                @endif
                            </th>
                            <th class="px-4 w-10 uppercase text-xxs sm:text-sm border border-white">DIF TOT</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="text-center font-bold"></tr>
                            <td class="bg-white text-black border border-black text-xxs sm:text-sm px-4 text-center">{{ $record->position }}</td>
                            <td class="bg-white text-black border border-black text-xxs sm:text-sm px-4 uppercase text-left {{ env('SHOW_NAME_POSITION_BY_ROUND',false) ? 'text-xxs' : '' }}">
                                {{ env('SHOW_NAME_POSITION_BY_ROUND',false)  ? $record->user->name : $record->user->alias}}
                            </td>
                            <td class="bg-white text-black border border-black text-xs sm:text-sm px-4 text-center">{{ $record->hits }}</td>

                            @if($show_mnf_column)
                                <td class="bg-white text-black border border-black text-xs sm:text-sm px-4 text-center">
                                    <div class="flex flex-row justify-center items-center">
                                        @if($last_game_round->pick_user($record->user))
                                            @if($last_game_round->pick_user($record->user)->winner == 1)
                                                <img src="{{ Storage::url($last_game_round->local_team->logo) }}"
                                                class="h-[25px] w-[25px] rounded-full shadow-md {{ $record->hit_last_game ? 'box-shadow: 120px 5px 50px 2px rgba(0, 128, 0, 0.5)' : 'grayscale' }}">
                                            @else
                                                <img src="{{ Storage::url($last_game_round->visit_team->logo) }}"
                                                class="h-[15px] w-[15px] rounded-full {{ $record->hit_last_game ? '' : 'grayscale' }}">
                                            @endif
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                </td>

                                <td class="bg-white text-black border border-black text-xxs  text-center" style="font-size: 0.5rem">
                                    @if($last_game_round->pick_user($record->user))
                                        {{ $last_game_round->pick_user($record->user)->visit_points }}-{{ $last_game_round->pick_user($record->user)->local_points }}
                                    @else
                                        &nbsp;
                                    @endif
                                </td>
                                <td class="bg-white text-black border border-black text-xxs sm:text-sm px-4 text-center">
                                    {{ $record->dif_total_points }}
                                </td>

                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="w-1/2 overflow-x-auto">
            <div class="text-center bg-red-500 font-bold">
                {{ __('Not Found Records') }}
            </div>
        </div>
    @endif

</div>
