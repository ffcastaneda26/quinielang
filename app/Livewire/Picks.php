<?php

namespace App\Livewire;

use App\Models\Round;
use Livewire\Component;
use App\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Picks extends Component
{
    // public function render()
    // {
    //     return view('livewire.picks');
    // }
    use AuthorizesRequests;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    public function mount()
    {

        $this->read_configuration();

        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;

        if (Auth::user()->hasRole('participante') && Auth::user()->id != 1) {
            if ($this->configuration->create_mssing_picks) {
                $this->create_missing_picks_to_user($this->current_round->id);
            }
        }
        $this->receive_round($this->current_round);

    }
    /*+-----------------+
      | Regresa Vista   |
      +-----------------+
    */
    public function render()
    {
        return view('livewire.picksgames.index');
    }
    /*+-----------------+
      | Recibe Jornada  |
      +-----------------+
    */
    public function receive_round(Round $round)
    {
        if ($round) {
            $this->id_game_tie_breaker = $this->get_id_game_to_get_points($round);
            $this->selected_round = $round;
            $this->round_games = $round->games()->orderby('game_day')->orderby('game_time')->get();
         }
    }
}
