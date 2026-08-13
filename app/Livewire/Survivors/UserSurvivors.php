<?php

namespace App\Livewire\Survivors;

use App\Models\Configuration;
use App\Models\Round;
use App\Models\Survivor;
use Livewire\Component;

class UserSurvivors extends Component
{
    public $rounds;
    public $active_survivor;

    public $minutesBefore = 5;
    public function mount()
    {
        $this->minutesBefore = Configuration::first()->minuts_before_survivors;
        $this->active_survivor = Survivor::active()->first();
    }
    public function render()
    {
        $this->rounds = Round::wherehas('games')->orderby('id')->get();
        return view('livewire.survivors.user-survivors');
    }
}
