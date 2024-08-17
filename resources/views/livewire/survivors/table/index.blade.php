<div class="container mt-5">
        <table class="w-full">
                <thead>
                    <tr class="text-center text-xxs bg-white text-black sm:bg-black sm:text-white sm:text-sm">
                        <td colspan="{{ $rounds->count() + 2 }}" align="center">
                            <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="w-4 rounded-full grayscale">
                            <span class="text-xxs"> Indica que no se seleccionó equipo</span>
                        </td>
                    </tr>
                    <tr class="text-center font-bold bg-black text-white border-white text-xs sm:text-sm">
                        <th style="width: 96px;" class="text-xxs">{{ __('Name') }}</th>
                        @foreach ($rounds as $round)
                            <th class="text-center text-xxs md:text-sm ">{{ $round->id }}</th>
                        @endforeach
                        <th style="width: 3%;" style="font-size: 4px">
                            {{ $rounds->count() > 3 ? 'Tot' : 'T' }}
                        </th>
                    </tr>
                </thead>
        </table>
        @foreach ($users as $user)
            <table class="w-full">
                <tbody>
                    <tr class="text-center font-bold bg-black text-white border-white text-xs sm:text-sm">
                        <td style="width: 96px;" class="text-start border border-black bg-white text-black text-xxs sm:text-sm">{{ $user->alias }}</td>
                        @foreach ($rounds as $round)
                            <td class="text-center border border-black  bg-white text-black" align="center">
                                @php
                                    $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                                @endphp
                                @if ($user_survivor)
                                    @if ($round->has_games_to_block_survivors())
                                        <img src="{{ Storage::url($user_survivor->team->logo) }}" class="w-4 sm:w-8 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}" style="margin: 0 auto;">
                                    @else
                                        <img src="{{ asset('images/reloj.png') }}" class="w-4 sm:w-8 rounded-full" style="margin: 0 auto;">
                                    @endif
                                @else
                                    @if($round->id < $current_round->id)
                                        <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="w-4 sm:w-8 rounded-full grayscale" style="margin: 0 auto;">
                                    @else
                                        <img src="{{ asset('images/reloj.png') }}" class="w-4 sm:w-8 rounded-full" style="margin: 0 auto;">
                                    @endif
                                @endif
                            </td>
                        @endforeach
                        <td style="width: 3%;" class="text-center border border-black bg-white text-black text-xxs">{{ $user->total_survivors }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
</div>
