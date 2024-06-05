<?php

namespace App\Livewire\Picks\Tablepicks;

use Livewire\Component;

class PicksUser extends Component
{
    public $game,$user;
    public $pick_user_game;
    public $allow_pick = false;
    public $has_result = false;
    public $hit_game =false;
    public $is_last_game =false;
    public $hit_last_game = false;
    public $local_points = null;
    public $visit_points = null;
    public $bg_color_cell = '';

    public function mount(){
        $this->prepare_data_to_view();
    }

    public function render()
    {
        return view('livewire.picks.tablepicks.picks_user');
    }


    public function prepare_data_to_view(){
        $this->reset('bg_color_cell','pick_user_game');

        $this->pick_user_game   = $this->game->pick_user($this->user);
        $this->allow_pick = $this->game->allow_pick();
        $this->has_result = $this->game->has_result();
        if($this->has_result){
            $this->hit_game   = $this->pick_user_game && $this->game->winner == $this->pick_user_game->winner;
            $this->bg_color_cell = $this->hit_game ? 'bg-green-500' : 'bg-red-500';
        }

        $this->is_last_game = $this->game->is_last_game_round();
        if($this->is_last_game){
            $this->local_points = $this->game->local_points;
            $this->visit_points = $this->game->visit_points;
            $this->hit_last_game = $this->hit_game;
        }


    }
}
