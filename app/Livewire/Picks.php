<?php

namespace App\Livewire;

use App\Models\Configuration;
use App\Models\Round;
use Livewire\Component;
use App\Traits\FuncionesGenerales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Picks extends Component
{
    // public function render()
    // {
    //     return view('livewire.picks');
    // }
    use AuthorizesRequests;
    use FuncionesGenerales;

    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $this->configuration = Configuration::first();

        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;

        if (Auth::user()->hasRole('Participante') && !Auth::user()->hasRole('Admin')) {
            if ($this->configuration->create_mssing_picks) {
                $this->create_missing_picks_to_user($this->current_round);
            }
        }
        $this->read_round_games($this->current_round);

    }
    /*+-----------------+
      | Regresa Vista   |
      +-----------------+
    */
    public function render()
    {
        return view('livewire.picks.index');
    }


}
