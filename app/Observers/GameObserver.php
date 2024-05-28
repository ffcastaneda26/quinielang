<?php

namespace App\Observers;

use App\Models\Game;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    public function created(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "updated" event.
     */
    public function updated(Game $game): void
    {
        dd('Se actualizó el partido aqui es donde debe lanzar las actualizaciones');
        /**
         * 1) Calificar pronósticos
         * 2) Si es el último partido: Actualizar criterios de desempate
         * 3) Calcular posiciones de la jornada
         * 3) Calcular tabla de posiciones general
         */
    }

    /**
     * Handle the Game "deleted" event.
     */
    public function deleted(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "restored" event.
     */
    public function restored(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "force deleted" event.
     */
    public function forceDeleted(Game $game): void
    {
        //
    }
}
