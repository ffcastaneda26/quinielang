<div class="container">
    <div class="mx-auto mt-5">
        @foreach ($users as $user)
            <table class="w-full border">
                @if ($loop->index == 0)
                    <thead>
                        <tr class="text-center font-bold">
                            <td colspan="{{ $rounds->count() + 1 }}" align="center">
                                <img src="{{ asset('images/survivor_no_seleccionado.png') }}"
                                    class="w-4 rounded-full grayscale">
                                <span class="text-xxs"> Indica que no se seleccionó equipo</span>
                            </td>
                        </tr>
                        <tr class="text-center font-bold bg-black text-white">
                            <th style="width: 5%;">{{ __('Name') }}</th>
                            @foreach ($rounds as $round)
                                <th class="text-center text-sm">{{ $round->id }}</th>
                            @endforeach
                        </tr>
                    </thead>
                @endif
                <tbody>
                    <tr class="border-black">
                        <td style="width: 5%;" class="text-start truncate">{{ $user->alias }}</td>
                        @foreach ($rounds as $round)
                            <td class="text-center border border-black equal-width" align="center">
                                @php
                                    $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                                @endphp
                                @if ($user_survivor)
                                    @if ($round->has_games_to_block_survivors())
                                        <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                            class="w-6 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}"
                                            style="margin: 0 auto;">
                                    @else
                                        <img src="{{ asset('images/reloj.jpg') }}"
                                            class="w-6 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}"
                                            style="margin: 0 auto;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/survivor_no_seleccionado.png') }}"
                                        class="w-6 rounded-full grayscale" style="margin: 0 auto;">
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
</div>
