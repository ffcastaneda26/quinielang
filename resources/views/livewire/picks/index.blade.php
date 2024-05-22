<div class="mt-5">
    @livewire('select-round')
    <div class="flex justify-center mt-2">

        <div class="d-flex justify-content-center text-center mt-2 mb-4">

            <table role="table">
                @include('livewire.picks.header_table')

                <tbody>
                    @foreach ($round_games as $game)
                        {{-- @livewire('picks.pick-game',
                    ['game' => $game,
                    'id_game_tie_breaker' => $id_game_tie_breaker,
                    'configuration' => $configuration],
                    key($game->id)) --}}

                        <tr role="row">
                            <td class="py-3 text-sm" role="cell">
                                {{ $game->game_date->format('d M y h:i') }}
                            </td>
                            <td class="py-3 text-sm" role="cell">
                                <img src="{{ Storage::url('teams/' . $game->visit_team->logo) }}"
                                    class="h-[30px] w-[30px] rounded-full" alt="" />
                                <span>{{ $game->visit_team->name }}</span>
                            </td>
                            <td class="py-3 text-sm" role="cell">
                                P Visit
                            </td>
                            <td class="py-3 text-sm" role="cell">
                                ¿Acertó?
                            </td>
                            <td class="py-3 text-sm" role="cell">
                                P Local
                            </td>
                            <td class="py-3 text-sm" role="cell">
                                <img src="{{ asset($game->local_team->logo) }}" alt="">
                                {{ $game->local_team->name }}
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
