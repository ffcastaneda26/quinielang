<?php

use App\Models\Pick;
use App\Models\User;
use App\Models\Round;
use App\Livewire\Picks;
use App\Models\Position;
use App\Livewire\SelectRound;
use App\Classes\Configuration;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Picks\TablePicks\TablePicks;
use App\Livewire\Positions\ByRound;
use App\Livewire\RoundTeams;
use App\Livewire\Survivors\UserSurvivors;
use App\Models\Configuration as ModelsConfiguration;
use App\Models\Team;
use Carbon\Carbon;

Route::get('equipo-survivors/{team}',function(Team $team){
    dd($team->survivors()->get());

});


Route::get('juegos_jornada',function(){
    $roundId = 1; // Replace with the actual round ID
    $minutesBeforePicks = 5;

    $rounds = Round::with([
        'games' => function ($query) use ($roundId, $minutesBeforePicks) {
            $query->whereNull('local_points')
                  ->whereNull('visit_points')
                  ->where('game_date', '>', Carbon::now()->subMinutes($minutesBeforePicks))
                  ->select('id', 'local_team_id', 'visit_team_id'); // Select relevant columns
        },
    ])->first();


});



Route::get('juegos/{team}', function (Team $team, ) {
    echo "El Equipo:" . $team->name . ' Tiene los juegos' . '<hr>';

    echo 'COMO LOCAL <br>';

    $locales = $team->local_games()->get();

    if ($locales->count()) {
        foreach ($locales as $local) {
            echo 'Jornada: ' . $local->round_id . ' vs ' . $local->visit_team->name . '<br>';
        }
    } else {
        echo ' NO TIENE JUEGOS COMO LOCAL';
    }

    echo '<hr> COMO VISITANTE <br>';
    $visitas = $team->visit_games()->get();
    if ($visitas->count()) {
        foreach ($visitas as $visit) {
            echo 'Jornada: ' . $visit->round_id . ' vs ' . $visit->visit_team->name . '<br>';
        }
    } else {
        echo 'EL EQUIPO' . $team->name . ' NO TIENE JUEGOS COMO VISITA';
    }

});

Route::get('equipos/{round}', function (Round $round) {
    $minutesBeforePicks = 5;
    $locales = $round->local_teams()->select('teams.id','name')
            ->where('games.game_date','>',Carbon::now()->subMinutes($minutesBeforePicks))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
                  ->whereDoesntHave('survivors')
    ->get();

    $visitas = $round->visit_teams()->select('teams.id','name')
            ->where('games.game_date','>',Carbon::now()->subMinutes($minutesBeforePicks))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
    ->get();


    echo 'Equipos Visitantes' . '<br>';

    foreach ($visitas as $visita) {
        echo $visita->id . '.' . $visita->name . '<br>';
    }
    echo '<hr>';

    echo 'Equipos Locales' . '<br>';
    foreach ($locales as $local) {
        echo $local->id . '.' . $local->name . '<br>';
    }


    $allTeams = $locales->merge($visitas);
    $allTeams = $allTeams->sortBy('name');

    // dd('Total de equipos = ' . $allTeams->count() . ' ' . $visitas->count() . ' De visita y ' . $locales->count() . ' Locales') . ' Total=' . $allTeams->count();
    echo '<hr> TODOS LOS EQUIPOS DE LA JORNADA . <br>';
    foreach($allTeams as $team){

        echo $team->id . '.' . $team->name . '<br>';
    }
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $configuration = ModelsConfiguration::first();
        return view('dashboard', compact('configuration'));
    })->name('dashboard');
    Route::get('picks', Picks::class)->name('picks');
    Route::get('table-picks', TablePicks::class)->name('table-picks');
    Route::get('positions-by-round',ByRound::class)->name('positions-by-round');
    Route::get('user-survivors',UserSurvivors::class)->name('user-survivors');

});

Route::get('current_round', SelectRound::class);
