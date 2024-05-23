<?php

use App\Models\User;
use App\Models\Round;
use App\Livewire\Picks;
use App\Livewire\SelectRound;
use App\Classes\Configuration;
use App\Livewire\Ejemplos\Dashboard;
use App\Models\Configuration as ModelsConfiguration;
use App\Models\Pick;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('crea_pronosticos', function () {
    echo 'Comanzamos a las: ' . now()->format('d M Y') . '<br>';
    $loser_points = 0;
    $winner_points = 2;
    $rounds = Round::orderby('id')->get();
    $users = User::role('Participante')->get();
    echo 'Inicializamos tabla de pronósticos' . '<br>';
    DB::table('picks')->truncate();
    foreach ($rounds as $round) {
        echo 'Creando Pronósticos para la jornada: ' . $round->id . '<br';
        foreach ($round->games as $game) {
            if ($game->allow_pick()) {
                foreach ($users as $user) {
                    echo 'Creando para usuario: ' . $user->name . '<br';
                    $winner = mt_rand(1, 2);
                    $new_pick = Pick::create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                        'winner'  => $winner
                    ]);

                    // Si es el último partido de la jornada pone puntos
                    if($game->is_last_game_round()){
                        $new_pick->local_points = $winner == 1 ? $winner_points : $loser_points;
                        $new_pick->visit_points = $winner == 2 ? $winner_points : $loser_points;
                        $new_pick->save();
                    }
                }
            }

        }

    }
    echo 'Terminamos a las: ' . now()->format('dd M Y');

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
        $configuration = app(Configuration::class);
        return view('dashboard', compact('configuration'));
    })->name('dashboard');
    Route::get('picks', Picks::class)->name('picks');

});

Route::get('current_round', SelectRound::class);
Route::get('ejemplos/dashboard',Dashboard::class)->name('ejemplos.dashboard');
