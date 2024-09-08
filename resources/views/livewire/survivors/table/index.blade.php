<div class="container mt-5">
        <div class="mt-4 p-5 w-full flex justify-center text-xl border bg-white text-black">
            {{ __('Survivors Table') }}
        </div>
        {{-- Encabezado --}}
        <table class="w-full">
                <thead>
                    {{-- <tr class="text-center text-xxs bg-white text-black sm:bg-black sm:text-white sm:text-sm">
                        <td colspan="{{ $rounds->count() + 2 }}" align="center">
                            <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="w-4 rounded-full grayscale">
                            <span class="text-xxs"> Indica que no se seleccionó equipo</span>
                        </td>
                    </tr> --}}
                    <tr class="text-center font-bold bg-black text-white border-white text-xs sm:text-sm">
                        <th style="width: 4rem" class="text-xxs">{{ __('Name') }}</th>
                        @foreach ($rounds as $round)
                            <th style="width: 1rem;" class="text-center text-xxs md:text-sm ">{{ $round->id }}</th>
                        @endforeach
                        <th style="width: 1rem;">
                            {{ $rounds->count() > 3 ? 'Tot' : 'T' }}
                        </th>
                    </tr>
                </thead>
        </table>
        {{-- Detalle: Survivor x Usuario --}}
        @foreach ($users as $user)
            @php
                $is_zombie = $user->is_zombie($current_round)
            @endphp
            <table class="w-full">
                <tbody>
                    <tr class="text-center font-bold bg-black text-white border-white text-xs sm:text-sm">
                        <td style="width: 4rem" class="text-start border {{ $is_zombie ? 'border-red-500' : 'border-black' }} bg-white text-black text-xxs sm:text-sm">
                            <div class="flex">
                                {{ $user->alias }}
                                <span class="{{ $is_zombie ? 'block' : 'hidden' }}">
                                    <img src="{{ asset('images/zombies.png') }}" alt="X" class="w-4">
                                </span>
                            </div>

                        </td>
                        @foreach ($rounds as $round)
                            <td style="width: 1rem;"  class="text-center border border-black  bg-white text-black" align="center">
                                @php
                                    unset($user_survivor);
                                    $user_survivor = $user->survivors->where('round_id',$round->id)->first();
                                @endphp
                                @if ($user_survivor)
                                    @if ($has_games_to_block_survivors &&  $round->id <= $current_round->id  )
                                        <div class="flex flex-col gap-1 justify-center items-center">
                                            @if($user_survivor->team->game_round($round)->was_played())
                                                @if($user_survivor->survive)
                                                    <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                                        class="w-4 h-4 sm:w-8 sm:h-9 rounded-full shadow-lg shadow-green-500"
                                                    >
                                                    <img src="{{ asset('images/afirmativo.png') }}" class="w-2 sm:w-4 rounded-full">
                                                @else
                                                    <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                                        class="w-4 h-4 sm:w-8 sm:h-9 rounded-full shadow-lg grayscale"
                                                    >
                                                    <img src="{{ asset('images/negativo.png') }}" class="w-2 sm:w-4 rounded-full">
                                                @endif
                                            @else
                                                <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                                    class="w-4 h-4 sm:w-8 sm:h-9 rounded-sm"
                                                >
                                            @endif

                                        </div>
                                    @else
                                        <img src="{{ asset('images/reloj.png') }}"
                                            class="w-4 sm:w-6 rounded-full" style="margin: 0 auto;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/survivor_no_seleccionado.png') }}"
                                    class="w-4 sm:w-6 rounded-full grayscale" style="margin: 0 auto;">
                                @endif
                            </td>
                        @endforeach
                        <td style="width: 1rem;"  class="text-center border border-black bg-white text-black text-xxs">{{ $user->total_survivors }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
</div>
