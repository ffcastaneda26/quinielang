<?php

namespace App\Observers;

use App\Classes\GameProcess;
use App\Models\Game;
use App\Models\Position;

class GameObserver
{

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
            $game->win();
            $gameProcess = new GameProcess();
            $gameProcess->qualify_picks();
            if ($game->is_last_game_round()) {
                $gameProcess->update_tie_breaker($game);
            }
            // Posiciones x Jornada
            $position_instance = new Position();
            //$position_instance->create_missing_positions();
            // Asigna las posiciones: Por Jornada y Generales
            $gameProcess->update_positions_round($game->round_id);
        }

    }


}
