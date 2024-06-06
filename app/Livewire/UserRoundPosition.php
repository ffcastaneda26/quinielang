<?php

namespace App\Livewire;

use App\Models\Position;
use App\Models\Round;
use App\Traits\FuncionesGenerales;
use Livewire\Component;

class UserRoundPosition extends Component
{
    use FuncionesGenerales;
    public $user;
    public $round;
    public $round_hits;

    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $this->read_round_games($this->round);
        $this->prepare_data_to_view();
    }

    public function render()
    {
        return view('livewire.user-round-position');
    }

    public function prepare_data_to_view()
    {
        $record = Position::where('user_id', $this->user->id)
            ->where('round_id', $this->round->id)
            ->first();
        $this->round_hits = $record ? $record->hits : null;
    }


}
