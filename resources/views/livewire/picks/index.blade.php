<div class="mt-5">
    @livewire('select-round')
    <div class="flex justify-center mt-2">
        @if (isset($round_games))
            <div class="flex flex-row justify-center mt-2 mb-4">
                <table class="w-full">
                    @include('livewire.picks.header_table')
                    <tbody>
                        @foreach ($round_games as $game)
                            <tr class="text-center">
                                @livewire('picks.pick-game', ['game' => $game, 'id_game_tie_breaker' => $id_game_tie_breaker, 'configuration' => $configuration], key($game->id))
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
