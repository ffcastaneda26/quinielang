<div>
    <div class="flex justify-center mt-2">
        <div class="max-w-sm rounded">
            <img class="h-[30px] w-[30px] rounded-full" src="{{ asset('images/nfl.png') }}" alt="NFL 2024">
            <div class="px-6 py-4 font-bold text-xl mb-2">
                <p class="">OPERACIONES x</p>
            </div>


            @for ($i = 1; $i <= 2; $i++)
                @livewire('calculator', ['cantidad1' => rand(25, 1000), 'cantidad2' => rand(3, 25), 'operacion' => $i], key('calculator-' . $i))
            @endfor
            @if (isset($round_games))
                <div class="flex flex-row justify-center mt-2 mb-4">
                    <table class="w-full">
                        @include('livewire.picks.header_table')
                        <tbody>
                            @foreach ($round_games as $game)
                                <tr class="text-center">

                                    @livewire('picks.pick-game',
                                            ['game' => $game,
                                             'id_game_tie_breaker' => $id_game_tie_breaker,
                                             'configuration' => $configuration],
                                            key($game->id))
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
