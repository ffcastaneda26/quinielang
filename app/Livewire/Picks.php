<?php

namespace App\Livewire;

use App\Models\Configuration;
use App\Models\Round;
use Livewire\Component;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Picks extends Component
{
    use AuthorizesRequests;
    use FuncionesGenerales;

    protected $listeners = ['read_round_games'];
    public function mount()
    {
        $this->configuration = Configuration::first();
        $this->rounds = Round::where('id','<=',env('MAX_ROUND_TO_PICKS',19))->get();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;

        if (Auth::user()->hasRole('Participante') && !Auth::user()->hasRole('Admin')) {
            if ($this->configuration->create_mssing_picks) {
                $this->create_missing_picks_to_user($this->current_round);
            }
        }
        $this->read_round_games($this->selected_round);

    }
    /*+-----------------+
      | Regresa Vista   |
      +-----------------+
    */
    public function render()
    {
        return view('livewire.picks.index');
    }

    public function update_picks($type='local'){
        foreach($this->round_games as $game){
            $pick_user = $game->pick_user();
            if($game->allow_pick() && $pick_user){

                if($type =='local'){
                    $winner=1;
                }
                if($type=='visit'){
                    $winner=2;
                }
                if($type=='random'){
                    $winner = rand(1, 2);
                }

                if($game->is_last_game()){
                    $local_points = $winner == 1 ? 2 : 0;
                    $visit_points = $winner == 2 ? 2 : 0;
                }else{
                    $local_points = null;
                    $visit_points = null;
                }

                $pick_user->winner = $winner;
                $pick_user->local_points = $local_points;
                $pick_user->visit_points = $visit_points;
                $pick_user->save();
            }
        }
    }
}
