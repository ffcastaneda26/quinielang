<?php

namespace App\Livewire\Positions;

use Livewire\Component;
use App\Models\GeneralPosition;

class PositionGeneral extends Component
{
    public $records;

    public function render()
    {
        $this->records =  GeneralPosition::join('users', 'general_positions.user_id', '=', 'users.id')
                ->orderby('position')
                ->orderBy('users.alias')
                ->get();
        return view('livewire.positions.general.general-position');
    }
}
