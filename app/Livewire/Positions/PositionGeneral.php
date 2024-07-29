<?php

namespace App\Livewire\Positions;

use Livewire\Component;
use App\Models\GeneralPosition;

class PositionGeneral extends Component
{
    public $records;

    public function render()
    {
        $this->records = GeneralPosition::with('user')
            ->orderBy('position')
            ->get();
        return view('livewire.positions.general.general-position');
    }
}
