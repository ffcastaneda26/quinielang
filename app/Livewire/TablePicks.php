<?php

namespace App\Livewire;

use App\Models\GeneralPosition;
use App\Models\User;
use App\Models\Round;
use Livewire\Component;
use App\Models\Configuration;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class TablePicks extends Component
{
    use WithPagination;
    use FuncionesGenerales;
    protected $listeners = ['read_round_games'];
    public function mount()
    {
        $this->configuration = Configuration::first();
        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;
        $this->read_round_games($this->selected_round);
    }
    public function render()
    {
        return view('livewire.table-picks', ['records' => $this->read_data()]);

    }

    private function read_data()
    {
        return User::role('Participante')
            ->wherehas('picks')
            ->wherehas('positions', function ($query) {
                $query->where('round_id', $this->current_round->id);
            })
            ->get();
    }
}
