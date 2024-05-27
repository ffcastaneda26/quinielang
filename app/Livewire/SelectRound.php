<?php

namespace App\Livewire;

use App\Models\Round;
use Livewire\Component;
use App\Traits\FuncionesGenerales;

class SelectRound extends Component
{

    use FuncionesGenerales;

    public function mount(){
        $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
    }

    public function render()
    {

        if(!$this->selected_round){
            $this->selected_round = $this->current_round;
        }


        $this->dispatch('read_round_games',$this->selected_round->id);
        return view('livewire.rounds.select-round');

    }
}