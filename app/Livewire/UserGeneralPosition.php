<?php

namespace App\Livewire;

use App\Traits\FuncionesGenerales;
use Livewire\Component;

class UserGeneralPosition extends Component
{
    use FuncionesGenerales;
    public $user;
    public $general_hits;

    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $this->prepare_data_to_view();
    }
    public function render()
    {
        return view('livewire.user-general-position');
    }

    public function prepare_data_to_view()
    {
        $record = $this->user->generalPosition()->first();
        $this->general_hits = $record ? $record->hits : null;
    }
}
