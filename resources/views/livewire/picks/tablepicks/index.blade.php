<div>
    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-full flex flex-col items-center">
            @livewire('select-round')
        </div>
        {{-- Encabezado  --}}
        @include('livewire.picks.tablepicks.table_picks_header')
        <div class="w-full grid grid-cols-12 border">
            Jornada: {{ $selected_round->id }}
        </div>
        @php
            $round_to_round_position = $selected_round
        @endphp
        {{-- Detalle --}}
        <div class="w-full flex items-center mt-2">
            @foreach ($users as $user)
                <div class="w-full grid grid-cols-12 border">
                    <div class="w-auto col-span-2 border border-black text-left">{{ $user->name }}</div>

                    <div class="w-auto col-span-7 border border-black text-center">
                        <div class="flex flex-row">
                            @foreach ($round_games as $game)
                                @livewire('picks.tablepicks.picks-user',
                                    ['game' => $game,'user'=> $user],
                                    key('pg-'.$game->id))
                            @endforeach
                        </div>
                    </div>

                    @livewire('user-round-position',
                        ['user' => $user, 'round' => $round_to_round_position],
                        key('rpu-' . $user->id .'rpr'.$round_to_round_position->id))

                    @livewire('user-general-position', ['user' => $user], key('gp-' . $user->id))

                </div>
            @endforeach
        </div>


    </div>
</div>
