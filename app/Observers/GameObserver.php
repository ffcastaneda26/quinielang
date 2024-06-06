<?php

namespace App\Observers;

use App\Classes\GameProcess;
use App\Models\Game;
use App\Models\Position;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    // public function created(Game $game): void
    // {
    //     if ($game->local_points && $game->visit_points) {
    //         $game->winner = $game->local_points > $game->visit_points ? 1 : 2;
    //     }else{
    //         $game->winner = null;
    //     }
    // }

    public function updating(Game $game): void
    {
        if ($game->isDirty('local_points') || $game->isDirty('visit_points')) {
            $game->winner = $game->local_points > $game->visit_points ? 1 : 2;
        }

    }

    /**
     * Handle the Game "updated" event.
     */
    public function updated(Game $game): void
    {
        /**
         * 1) Actualizar ganador en partido
         * 2) Calificar pronósticos
         * 3) Si es el último partido Actualizar criterios de desempate
         * 4) Calcular posiciones de la jornada
         * 5) Calcular tabla de posiciones general
         */


        if ($game->isDirty('local_points') || $game->isDirty('visit_points')) {
            $gameProcess = new GameProcess();
            $gameProcess->qualify_picks();
            if ($game->id_game_tie_breaker()) {
                $gameProcess->update_tie_breaker($game);
            }
            // Posiciones x Jornada
            // $position_instance = new Position();
            //$position_instance->create_missing_positions();
            // Asigna las posiciones: Por Jornada y Generales
            $gameProcess->update_positions_round($game->round_id);
        }

    }


}
