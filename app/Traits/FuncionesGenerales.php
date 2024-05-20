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
}
