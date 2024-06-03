<?php

namespace App\Livewire;

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
        switch ($this->order_by) {
            case 'name_asc':
                $this->sort = 'name';
                $this->direction = 'asc';
                break;
            case 'name_desc':
                $this->sort = 'name';
                $this->direction = 'desc';
                break;
            case 'hits_asc':
                $this->sort = 'hits';
                $this->direction = 'asc';
                break;
            case 'hits_desc':
                $this->sort = 'hits';
                $this->direction = 'desc';
                break;
            default:
                $this->sort = 'name';
                $this->direction = 'desc';
                break;
        }

        $users = User::wherehas('picks');
        $users->paginate($this->pagination);
        return $users;
        dd($users->count());

        $users = User::join('positions', 'users.id', '=', 'positions.user_id')
            ->join('rounds', 'positions.round_id', '=', 'rounds.id')
            ->select('users.id','users.name')
            ->where('rounds.id', '=', $this->selected_round->id)
            ->where('users.active', '1')
            ->where('name', 'LIKE', "%$this->search%")
            ->orwhere('alias', 'LIKE', "%$this->search%")
            ->orwhere('email', 'LIKE', "%$this->search%");

            if($this->sort === 'name'){
                $users->groupBy('users.id');
                $users->orderby('name',$this->direction);
            }else{
                $users->groupby('users.id','positions.hits');
                $users->orderby('positions.hits',$this->direction);
            }

        return $users;
    }
}
