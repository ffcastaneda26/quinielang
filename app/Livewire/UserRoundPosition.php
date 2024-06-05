<?php

namespace App\Livewire;

use App\Traits\FuncionesGenerales;
use Livewire\Component;

class UserRoundPosition extends Component
{
    use FuncionesGenerales;
    public $user;
    public $round_id;
    public $round_position;
    public $round_hits;


    public function mount()
    {
        $this->prepare_data_to_view();
    }
    public function render()
    {
        return view('livewire.user-round-position');
    }

    public function prepare_data_to_view()
    {
        dd($this->round_id);
        $record = $this->user->positions_round($this->round_id);
        $this->round_position = $record ? $record->position : null;
        $this->round_hits = $record ? $record->hits : null;
    }
}
