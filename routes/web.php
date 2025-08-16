<?php

use Carbon\Carbon;
use App\Models\Pick;
use App\Models\Team;
use App\Models\User;
use App\Models\Round;
use App\Livewire\Picks;
use App\Models\UserSurvivor;
use App\Livewire\SelectRound;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\DB;
use App\Livewire\Positions\ByRound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Survivors\UserSurvivors;
use App\Livewire\Positions\PositionGeneral;
use App\Livewire\Picks\TablePicks\TablePicks;
use App\Livewire\Survivors\Table\TableSurvivors;
use App\Models\Configuration as ModelsConfiguration;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

use function Laravel\Prompts\table;

route::get('actualiza_todas_las_claves', function () {
    User::query()->update(['password' => \Illuminate\Support\Facades\Hash::make('password')]);
});
Route::get('checa-hora/{round}', function (Round $round) {
    dd($round);
    $fecha_juego = '2024-09-10 12:00:00';

});
Route::get('show-zombies', function () {
    $users = User::role(env('ROLE_PARTICIPANT', 'Participante'))
        ->orderby('alias')
        ->get();
    echo '<table border="1">';
    echo '<thead><th>No</th><th>Alias</th><th>Zombie</th></thead>';
    $i = 0;
    foreach ($users as $user) {
        $i++;
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . $user->alias . '</td>';
        echo '<td>';
        if ($user->is_zombie()) {
            echo 'SI';
        } else {
            echo 'NO';
        }
        echo '</td>';
        echo '</tr>';

    }
    echo '</table>';
});


Route::get('optimize-clear', function () {
    if (Auth::user()) {
        Artisan::call('optimize:clear');
    } else {
        return 'Sorry You Not Authorized To This Command';
    }
})->middleware('auth');

Route::get('revisa-survivors', function () {
    $users = User::role(env('ROLE_PARTICIPANT', 'Participante'))
        ->withCount([
            'survivors as total_survivors' => function ($query) {
                $query->where('survive', 1);
            }
        ])
        ->orderBy('total_survivors', 'desc')
        ->orderBy('alias', 'asc')
        ->get();

    echo '<table border=1><thead><th>Pos</th><th>Nombre</th><th>Survivors</th></thead>';

    $pos = 1;
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $pos++ . '</td>';
        echo '<td>' . $user->name . '</td>';
        echo '<td>' . $user->total_survivors . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    // dd($users);
});

Route::get('equipos-survivor-jornada/{round}', function (Round $round) {
    $minutesBeforePicks = 5;
    $locales = $round->local_teams()->select('teams.id', 'name')
        ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBeforePicks))
        ->whereNull('games.local_points')
        ->whereNull('games.visit_points')
        ->whereDoesntHave('survivors')
        ->get();

    $visitas = $round->visit_teams()->select('teams.id', 'name')
        ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBeforePicks))
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
    foreach ($allTeams as $team) {

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
    Route::get('positions-by-round', ByRound::class)->name('positions-by-round');
    Route::get('user-survivors', UserSurvivors::class)->name('user-survivors');
    Route::get('table-survivors', TableSurvivors::class)->name('table-survivors');
    Route::get('position-general', PositionGeneral::class)->name('position-general');
});

Route::get('current_round', SelectRound::class);
