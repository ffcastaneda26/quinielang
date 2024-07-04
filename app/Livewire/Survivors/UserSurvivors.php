<?php

namespace App\Livewire\Survivors;

use App\Models\Configuration;
use App\Models\Round;
use Livewire\Component;

class UserSurvivors extends Component
{
    public $rounds;

    public $minutesBefore = 5;

    public function mount()
    {
        $this->minutesBefore = Configuration::first()->minuts_before_survivors;
    }
    public function render()
    {
        $this->rounds = Round::orderby('id')->get();

        return view('livewire..survivors.user-survivors');
    }


}
