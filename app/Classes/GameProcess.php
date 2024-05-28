<?php

namespace App\Classes;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Position;
use App\Models\Round;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GameProcess
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /** Califica Pronósticos */
    public function qualify_picks()
    {
        Pick::join('games', 'games.id', '=', 'picks.game_id')
            ->update([
                'picks.hit_game' => DB::raw('CASE WHEN picks.winner = games.winner THEN 1 ELSE 0 END')
            ]);
    }

    /** Actualiza en pronósticos campo: hit_last_game */
    public function update_hit_last_game(Game $game)
    {
        $sql = "UPDATE picks pic,games ga ";
        $sql .= "SET hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
        $sql .= "WHERE ga.id = pic.game_id ";
        $sql .= "  AND ga.visit_points IS NOT NULL ";
        $sql .= "  AND ga.local_points IS NOT NULL ";
        $sql .= "  AND ga.id=" . $game->id;
        return DB::update($sql);
    }

    // Actualia criterios de desempate
    public function update_tie_breaker(Game $game)
    {
        // Actualiza en todos los pronósticos del PARTIDO a NULL los criterios de desempate;
        $sql = "UPDATE picks ";
        $sql .= "SET dif_points_winner=NULL,";
        $sql .= "dif_points_total=NULL,";
        $sql .= "dif_points_local=NULL,";
        $sql .= "dif_points_visit=NULL,";
        $sql .= "hit_local=0,";
        $sql .= "hit_visit=0,";
        $sql .= "hit_last_game=0,";
        $sql .= "dif_victory=NULL ";
        DB::update($sql);

        // TODO: Calcula criterios de desempate en pronósticos solo para el partido de desempate
        $dif_victoria = $game->local_points + $game->visit_points;
        $sql = "UPDATE picks pic,games ga ";
        $sql .= "SET ";
        $sql .= "dif_points_winner= CASE WHEN (" . $game->local_points . ">" . $game->visit_points . ") THEN abs(pic.local_points - " . $game->local_points . ") ELSE abs(pic.visit_points - " . $game->visit_points . ")  END,";
        $sql .= "pic.dif_points_total= abs(abs(" . $game->visit_points . "-pic.visit_points)+abs(" . $game->local_points . "-pic.local_points)),";
        $sql .= "pic.dif_points_local=abs(" . $game->local_points . "-pic.local_points),";
        $sql .= "pic.dif_points_visit= abs(" . $game->visit_points . "-pic.visit_points),";
        $sql .= "hit_local= CASE WHEN pic.local_points=" . $game->local_points . " THEN 1 ELSE 0  END,";
        $sql .= "hit_visit= CASE WHEN pic.visit_points=" . $game->visit_points . " THEN 1 ELSE 0  END,";
        $sql .= "hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
        $sql .= "pic.dif_victory=abs(" . $dif_victoria . "-(pic.local_points + pic.visit_points)) ";
        $sql .= "WHERE ga.id = pic.game_id ";
        $sql .= "  AND ga.id=" . $game->id;
        return DB::update($sql);
    }

    public function update_positions_round($round_id)
    {
        $this->clear_position_attributes($round_id);
        $this->update_total_hits_positions($round_id);
        $this->update_position_in_round($round_id);
    }

    // Limpia campos de la tabla de POSITIONS de la jornada
    private function clear_position_attributes($round_id)
    {
        $sql = "UPDATE positions ";
        $sql .= "SET hits,";
        $sql .= "extra_points=NULL,";
        $sql .= "dif_winner_points=NULL,";
        $sql .= "dif_total_points=NULL,";
        $sql .= "dif_local_points=NULL,";
        $sql .= "dif_visit_points=NULL,";
        $sql .= "dif_victory=NULL,";
        $sql .= "hit_last_game=0,";
        $sql .= "hit_visit=0,";
        $sql .= "hit_local=0,";
        $sql .= "position=null";
        $sql .= " WHERE round_id=" . $round_id;
        DB::update($sql);
    }

    // Actualiza la tabla de POSICIONES de la jornada
    /**
     * 1) Lee de manera sumarizada los pronósticos de la jornada por usuario
     * 2) Recorre los pronósticos sumarizados y por cada uno:
     *      a) Si no tiene el registro en tabla POSITIONS con jornada y usuario lo crea
     *      b) Actualiza la tabla de posiciones de la jornada y usuario
     *
     */
    public function update_total_hits_positions($round_id)
    {
        $picks_to_positions = $this->read_totals_picks($round_id);
        if (!empty($picks_to_positions)) {
            foreach ($picks_to_positions as $pick_to_position) {
                $user = User::findOrFail($pick_to_position->user_id);

                if (!$user->has_position_record_round($round_id)) {
                    $this->create_position_round_user($round_id, $user->id);
                }
                $this->update_position_round_user($round_id, $user->id,$pick_to_position);
            }
        }
    }

    private function read_totals_picks($round_id)
    {
        Return User::role(env('ROLE_PARTICIPANT','Participante'))
            ->select(
                'users.id as user_id',
                DB::raw('SUM(picks.hit) as hits'),
                DB::raw('SUM(picks.dif_points_total) as dif_total_points'),
                DB::raw('SUM(picks.dif_points_local) as dif_local_points'),
                DB::raw('SUM(picks.dif_points_visit) as dif_visit_points'),
                DB::raw('SUM(picks.dif_points_winner) as dif_winner_points'),
                DB::raw('SUM(picks.dif_victory) as dif_victory'),
                DB::raw('SUM(picks.hit_last_game) as hit_last_game'),
                DB::raw('SUM(picks.hit_local) as hit_local'),
                DB::raw('SUM(picks.hit_visit) as hit_visit'),
                DB::raw('SUM(picks.points_by_local) as points_by_local'),
                DB::raw('SUM(picks.points_by_visit) as points_by_visit'),
                DB::raw('SUM(picks.points_by_hit_tie_breaker_game) as points_by_hit_tie_breaker_game'),
                DB::raw('SUM(picks.points_by_hit_game) as points_by_hit_game'),
                DB::raw('SUM(picks.total_points) as total_points'),
            )
            ->Join('picks', 'picks.user_id', '=', 'users.id')
            ->Join('games', 'picks.game_id', '=', 'games.id')
            ->where('games.round_id', $round_id)
            ->where('users.active', '1')
            ->groupBy('users.id')
            ->get();
    }

    public function create_position_round_user($round_id,$user_id)
    {
        Position::create([
            'round_id' => $round_id,
            'user_id' => $user_id
        ]);
    }

    // Actualiza la tabla de POSICIONES
    private function update_position_round_user($user_id,$round_id,$pick_to_position)
    {
        $position_record = Position::where('user_id', $user_id)->where('round_id', $round_id)->first();
        if(!$position_record){
            return;
        }
        $position_record->hits = $pick_to_position->hits;
        $position_record->extra_points = $pick_to_position->extra_points;
        $position_record->dif_winner_points = $pick_to_position->dif_winner_points;
        $position_record->dif_total_points = $pick_to_position->dif_total_points;
        $position_record->dif_local_points = $pick_to_position->dif_local_points;
        $position_record->dif_visit_points = $pick_to_position->dif_visit_points;
        $position_record->dif_victory = $pick_to_position->dif_victory;
        $position_record->hit_last_game = $pick_to_position->hit_last_game;
        $position_record->hit_visit = $pick_to_position->hit_visit;
        $position_record->hit_local = $pick_to_position->hit_local;
        $position_record->save();

        // $position_record->best_shot = $pick_to_position->dif_local_points > $pick_to_position->dif_visit_points
        // ? $pick_to_position->dif_visit_points
        // : $pick_to_position->dif_local_points;
    }

    private function update_position_in_round($round_id)
    {
        $this->update_positions_to_null($round_id);
        $positions = Position::orderbyDesc('hits')
                                ->orderby('dif_total_points')
                                ->orderby('dif_local_points')
                                ->orderby('dif_visit_points')
                                ->orderbyDesc('hit_last_game')
                                ->orderby('dif_winner_points')
                                ->orderby('dif_victory')
                                ->orderby('created_at')
                                ->get();

        $i = 1;
        foreach ($positions as $position) {
            $position->position = $i++;
            $position->save();
        }
    }

    // Actualiza posiciones a NULL
    private function update_positions_to_null($round_id)
    {
        $sql = "UPDATE positions ";
        $sql .= "SET position=NULL ";
        $sql .= " WHERE round_id=" . $round_id;
        DB::update($sql);
    }
}
