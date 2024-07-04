<?php

namespace App\Livewire\Survivors;

use App\Models\Round;
use Livewire\Component;

class UserSurvivors extends Component
{
    public $rounds;

    public function render()
    {
        $this->rounds = Round::orderby('id')->get();

        return view('livewire..survivors.user-survivors');
    }


}
