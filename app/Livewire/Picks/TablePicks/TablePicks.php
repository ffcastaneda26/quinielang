<?php

namespace App\Livewire\Picks\TablePicks;


use App\Models\User;
use App\Models\Round;
use Livewire\Component;
use App\Models\Configuration;
use App\Traits\FuncionesGenerales;
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
        return view('livewire.picks.tablepicks.index', ['users' => $this->read_data()]);
    }

    private function read_data()
    {

        $users = User::role(env('ROLE_PARTICIPANT', 'Participante'))
            ->Join('picks', 'picks.user_id', '=', 'users.id')
            ->Join('games', 'picks.game_id', '=', 'games.id')
            ->where('games.round_id', $this->current_round->id)
            ->where('users.active', '1')
            ->select('users.id as user_id,users.name')
            ->select(
                'users.id as user_id',
                'users.name'
            )
            ->orderby('games.game_date','ASC')
            ->get();
        return $users;

    }

    public function old_read_data()
    {

        return User::role('Participante')
            ->wherehas('picks')
            ->wherehas('positions', function ($query) {
                $query->where('round_id', $this->current_round->id);
            })
            ->get();
    }
    public function read_data_temporaly()
    {
        $users = User::role('participante')
            ->join('positions', 'users.id', '=', 'positions.user_id')
            ->join('rounds', 'positions.round_id', '=', 'rounds.id')
            ->join('general_positions', 'users.id', '=', 'general_positions.user_id')
            ->where('rounds.id', '=', $this->selected_round->id)
            ->where('users.active', '1')
            ->where('users.name', 'LIKE', "%$this->search%")
            ->orwhere('users.alias', 'LIKE', "%$this->search%")
            ->orwhere('users.email', 'LIKE', "%$this->search%")
            ->groupBy(
                'users.id',
                'positions.position',
                'positions.hits',
                'rounds.id',
                'general_positions.hits'
            )
            ->select(
                'users.name',
                'positions.position',
                'positions.hits',
                'rounds.id as round_id',
                'general_positions.hits as acummulated'
            )
            ->orderby('positions.hits', $this->direction);
        $users = $users->paginate($this->pagination);
        return $users;
    }
}
