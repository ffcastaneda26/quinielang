<?php

namespace App\Livewire;

use App\Traits\FuncionesGenerales;
use Livewire\Component;

class PickGame extends Component
{
    use FuncionesGenerales;
    public $game;
    public $visit_points;
    public $local_points;
    public $winner;
    public $pick_user;
    public $game_month;
    public $game_day;
    public function render()
    {
        $this->read_pick_user();
        return view('livewire.pick-game');
    }

    private function read_pick_user(){
        $this->pick_user = $this->game->pick_user();
        if($this->game->is_last_game_round()){
            $this->visit_points = $this->pick_user->visit_points;
            $this->local_points = $this->pick_user->local_points;
        }

        $this->game_month = $this->read_short_month_name($this->game->game_day);
        $this->game_day = substr(date($this->game->game_day),8,2);
    }

    public function update_points(){
        $this->pick_user = $this->game->pick_user();
        $this->pick_user->visit_points = $this->visit_points;
        $this->pick_user->local_points = $this->local_points;
        $this->pick_user->save();
     }
}
