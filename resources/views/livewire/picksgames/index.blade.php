<div class="mt-5">
    @livewire('select-round')
    <div class="container-fluid mt-2">
        @if(isset($round_games ))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped table-hover text-xs">
                                    @include('livewire.picksgames.header_table')
                                </table>
                            </div>
                            @foreach ($round_games as $game)
                                @livewire('picks.pick-game',
                                            ['game' => $game,
                                             'id_game_tie_breaker' => $id_game_tie_breaker,
                                             'configuration' => $configuration],
                                            key($game->id))
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
