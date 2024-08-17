<?php

namespace App\Livewire\Survivors\Table;

use App\Models\Round;
use App\Models\Survivor;
use App\Models\User;
use App\Models\UserSurvivor;
use App\Traits\FuncionesGenerales;
use Livewire\Component;

class TableSurvivors extends Component
{
    use FuncionesGenerales;
    public $rounds, $survivor;

    public function mount()
    {
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->rounds = Round::wherehas('games')->orderby('id')->get();
        $this->survivor = Survivor::where('active', 1)->first();
    }
    public function render()
    {
        return view('livewire.survivors.table.index', ['users' => $this->read_users()]);
    }

    private function read_users()
    {

        return $users = User::role(env('ROLE_PARTICIPANT', 'Participante'))
            ->withCount([
                'survivors as total_survivors' => function ($query) {
                    $query->where('survive', 1);
                }
            ])
            ->orderBy('total_survivors', 'desc')
            ->orderBy('alias', 'asc')
            ->get();
    }
}
