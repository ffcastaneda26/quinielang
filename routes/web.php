<?php

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Round;
use App\Livewire\Picks;
use App\Models\UserSurvivor;
use App\Livewire\SelectRound;
use App\Livewire\Positions\ByRound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Survivors\UserSurvivors;
use App\Livewire\Picks\TablePicks\TablePicks;
use App\Livewire\Positions\PositionGeneral;
use App\Livewire\Survivors\Table\TableSurvivors;
use App\Models\Configuration as ModelsConfiguration;

Route::get('optimize-clear',function(){
    if(Auth::user()){
        Artisan::call('optimize:clear');
    }else{
        return 'Sorry You Not Authorized To This Command';
    }
})->middleware('auth');

Route::get('jornada-survivor/{round}',function(Round $round){
    $minutesBefore = 5;
    $records = UserSurvivor::where('round_id',$round->id)
                            ->whereHas('team',function($query) use($round,$minutesBefore) {
                                $query->whereHas('local_games',function($query) use($minutesBefore) {
                                                $query->where('game_date', '<', Carbon::now()->subMinutes($minutesBefore));
                                            })
                                    ->orWhereHas('visit_games',function($query) use($minutesBefore){
                                        $query->where('game_date', '<', Carbon::now()->subMinutes($minutesBefore));
                                    });
                                })
                            ->get();
    echo  $records->count() ? ' Ya no se puede seleccionar ' : 'Aún se puede seleccionar';

});

Route::get('equipos-survivor-jornada/{round}', function (Round $round) {
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
    Route::get('table-survivors',TableSurvivors::class)->name('table-survivors');
    Route::get('position-general',PositionGeneral::class)->name('position-general');
});

Route::get('current_round', SelectRound::class);
