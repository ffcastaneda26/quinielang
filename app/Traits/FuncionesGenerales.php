<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Pick;
use App\Models\User;
use App\Models\Round;

use App\Excellsus\Traits\UserTrait;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

trait FuncionesGenerales
{
    use UserTrait;
    public $configuration;
    public $rounds = null;
    public $selected_round = null;
    public $round_games = null;
    public $current_round = null;

    public $id_game_tie_breaker;
    public $months_short_spanish = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
    public $months_short_english = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dec");

    /*+----------------------------------+
      | Partidos de Jornada Seleccionada |
      +----------------------------------+
    */
    public function read_round_games(Round $round)
    {
        if ($round) {
            $this->selected_round = $round;
            $this->round_games = $round->games()->orderby('game_date')->get();
            $this->id_game_tie_breaker = Game::where('round_id',$round->id)->orderByDesc('game_date')->first()->id;
        }
    }

    // Lee Configuración

    // Lee jornadas
    public function read_rounds()
    {
        return $this->rounds = Round::orderby('id')->get();
    }

    // Selecciona los juegos de la jornada
    public function select_round(Round $round)
    {
        $this->reset('selected_round');
        if ($round) {
            $this->selected_round = $round;
        } else {
            $this->selected_round = $this->current_round;
        }
        $this->round_games = $this->selected_round->games;
    }

    // Crea pronósticos faltantes del usuario
    /**
     * Crea pronósticos faltantes
     * Lee solo los partidos que:
     *  a) No tengan pronósticos del usuario recibido
     *      - Si no se recibe usuario se asume el conectado
     *  b) Aún se puedan pronosticar
     *  c) De la jornada que se recibe
     *  d) No tenga marcador
     *
     */
    public function create_missing_picks_to_user(Round $round,User $user=null)
    {
        if(!$user){
            $user = Auth::user();
        }
        if(!$this->configuration){
            $this->configuration = Configuration::first();
        }
        date_default_timezone_set("America/Chihuahua");
        $newDateTime = Carbon::now()->subMinutes($this->configuration->minuts_before_picks);
        $games = Game::whereDoesntHave('picks', function (Builder $query) use ($user) {
                                        $query->where('user_id', $user->id);
                                    })
        ->where('game_date', '>', $newDateTime)
            ->where('round_id', '>=', $round->id)
            ->whereNull('local_points')
            ->whereNull('visit_points')
            ->get();

        foreach ($games as $game) {
            if ($game->allow_pick($this->configuration->minuts_before_picks)) {
                $this->create_pick_user_game($game);
            }
        }


        // TODO: Revisar si el usuario no tiene registro en tabla de posiciones CREARLO
        // Si el usuario no tiene registro en tabla POSITIONS lo crea
        // if (!Auth::user()->has_position_record_round($round_id)) {
        //     $this->create_position_record_round_user($round_id);
        // }
    }

    // Crea pronósticos para un paritido y un Usuario
    public function create_pick_user_game(Game $game, User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }
        $winner = mt_rand(1, 2);

        $new_pick = Pick::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'winner' => $winner
        ]);


        $loser_points = 0;
        $winner_points = 2;


        // Si el juego exige PUNTOS en marcador los asigna
        if ($this->configuration->require_points_in_picks) {
            $new_pick->local_points = $winner == 1 ? $winner_points : $loser_points;
            $new_pick->visit_points = $winner == 2 ? $winner_points : $loser_points;
            $new_pick->save();
            return;
        }

        if ($game->is_last_game_round()) {
            $new_pick->local_points = $winner == 1 ? $winner_points : $loser_points;
            $new_pick->visit_points = $winner == 2 ? $winner_points : $loser_points;
            $new_pick->save();
        }
    }

    // Lee el nombre del mes corto
    public function read_short_month_name($date){
        return App::isLocale('es') ? $this->months_short_spanish[substr(date($date),5,2)-1]
                                   : $this->months_short_english[substr(date($date),5,2)-1];
    }

}
