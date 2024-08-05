<div class="container mx-auto mt-5">
        @foreach ($users as $user)
            <table class="w-full border">
                @if ($loop->index == 0)
                    <thead>
                        <tr class="text-center text-xxs bg-white text-black">
                            <td colspan="{{ $rounds->count() + 2 }}" align="center">
                                <img src="{{ asset('images/survivor_no_seleccionado.png') }}"
                                    class="w-4 rounded-full grayscale">
                                <span class="text-xxs"> Indica que no se seleccionó equipo</span>
                            </td>
                        </tr>
                        <tr class="text-center font-bold bg-white text-black">
                            <th style="width: 5%;" class="text-xxs">{{ __('Name') }}</th>
                            @foreach ($rounds as $round)
                                <th class="text-center text-xxs md:text-sm ">{{ $round->id }}</th>
                            @endforeach
                            <th style="width: 3%;" class="text-xxs">Total</th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    <tr class="border-black">
                        <td style="width: 5%;" class="text-start border border-black truncate bg-white text-black text-xxs">{{ $user->alias }}</td>
                        @foreach ($rounds as $round)
                            <td class="text-center border border-black equal-width bg-white text-black" align="center">
                                @php
                                    $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                                @endphp
                                @if ($user_survivor)
                                    @if ($round->has_games_to_block_survivors())
                                        <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                            class="w-4 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}"
                                            style="margin: 0 auto;">
                                    @else
                                        <img src="{{ asset('images/reloj.jpg') }}"
                                            class="w-4 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}"
                                            style="margin: 0 auto;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/survivor_no_seleccionado.png') }}"
                                        class="w-4 rounded-full grayscale" style="margin: 0 auto;">
                                @endif
                            </td>
                        @endforeach
                        <td style="width: 3%;" class="text-center border border-black truncate bg-white text-black text-xxs">{{ $user->total_survivors }}</td>

                    </tr>
                </tbody>
            </table>
        @endforeach
</div>
