<div class="w-auto col-span-7 border border-black text-center">
    <div class="flex flex-row">

        @foreach ($round_games as $game)
             @dd('Juego Id=' . $game->id . ' Dentro del componente anidado picks.tablepicks.picks-user')
            @livewire('picks.tablepicks.picks-user',['game' => $game,'user'=> $user],key('pg-'.$game->id))
        @endforeach
    </div>
</div>
