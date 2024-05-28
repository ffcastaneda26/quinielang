<?php

namespace App\Classes;

use App\Models\Game;
use App\Models\Pick;
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
        // Inicializa campos de desempate;
        // $sql = "UPDATE positions ";
        // $sql .= "SET dif_winner_points=NULL,";
        // $sql .= "dif_total_points=NULL,";
        // $sql .= "dif_local_points=NULL,";
        // $sql .= "dif_visit_points=NULL,";
        // $sql .= "dif_victory=NULL,";
        // $sql .= "best_shot=NULL,";
        // $sql .= "hit_last_game=0,";
        // $sql .= "hit_visit=0,";
        // $sql .= "hit_local=0,";
        // $sql .= "hit_last_game=NULL";
        // DB::update($sql);

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
        $sql .= "dif_points_winner= CASE WHEN (" . $game->local_points . ">" . $game->visit_points  . ") THEN abs(pic.local_points - " . $game->local_points . ") ELSE abs(pic.visit_points - " . $game->visit_points  . ")  END,";
        $sql .= "pic.dif_points_total= abs(abs(" . $game->visit_points . "-pic.visit_points)+abs(" . $game->local_points . "-pic.local_points)),";
        $sql .= "pic.dif_points_local=abs(" . $game->local_points . "-pic.local_points),";
        $sql .= "pic.dif_points_visit= abs(" . $game->visit_points . "-pic.visit_points),";
        $sql .= "hit_local= CASE WHEN pic.local_points=" . $game->local_points . " THEN 1 ELSE 0  END,";
        $sql .= "hit_visit= CASE WHEN pic.visit_points=" . $game->visit_points  . " THEN 1 ELSE 0  END,";
        $sql .= "hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
        $sql .= "pic.dif_victory=abs(" . $dif_victoria . "-(pic.local_points + pic.visit_points)) ";
        $sql .= "WHERE ga.id = pic.game_id ";
        $sql .= "  AND ga.id=" . $game->id;
        return DB::update($sql);
    }
}
