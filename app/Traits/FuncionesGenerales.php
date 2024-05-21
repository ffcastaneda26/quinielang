<?php

namespace App\Traits;

use App\Models\Round;

trait FuncionesGenerales
{
    public $rounds = null;
    public $selected_round  = null;
    public $round_games     = null;
    public $current_round   = null;
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
}
