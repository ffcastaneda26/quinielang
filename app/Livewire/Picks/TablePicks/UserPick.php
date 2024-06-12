<?php

namespace App\Livewire\Picks\TablePicks;

use Livewire\Component;

class UserPick extends Component
{
    public $pick;
    public $game;
    public $bg_color_cell;
    public $hit_game = false;
    public $is_last_game = false;
    public $allow_pick = true;
    public $has_result = false;
    public $local_points = null;
    public $visit_points = null;

    public function mount()
    {
        $this->prepare_data_to_view();
    }
    public function render()
    {
        return view('livewire.picks.table-picks.user-pick');
    }

    public function prepare_data_to_view()
    {
        $this->reset('game','allow_pick','has_result','is_last_game','hit_game','bg_color_cell','local_points','visit_points');
        $this->game         = $this->pick->game;
        $this->allow_pick   = $this->game->allow_pick();
        $this->has_result   = $this->game->has_result();
        $this->is_last_game = $this->game->is_last_game();

        if ($this->has_result) {
            $this->hit_game     = $this->pick && $this->game->winner == $this->pick->winner;
            $this->bg_color_cell= $this->hit_game ? 'bg-green-500' : 'bg-red-500';
        }

        if ($this->is_last_game) {
            $this->local_points = $this->game->local_points;
            $this->visit_points = $this->game->visit_points;
        }
    }
}
