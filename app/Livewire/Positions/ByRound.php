<?php

namespace App\Livewire\Positions;

use App\Models\Round;
use App\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ByRound extends Component
{
    use AuthorizesRequests;
    use FuncionesGenerales;

    public $show_mnf_column= false;

    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;
        $this->read_round_games($this->selected_round);

    }
    public function render()
    {
        $this->show_mnf_column =$this->current_round->get_last_game_round()->has_result();
        return view('livewire.positions.round.index',[
            'records' => $this->read_data()
        ]);
    }

    private function read_data()
    {
       return $this->selected_round->positions;
    }
}
