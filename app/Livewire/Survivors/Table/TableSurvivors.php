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
    public $has_games_to_block_survivors = false;
    public function mount()
    {
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->rounds = Round::wherehas('games')->orderby('id')->get();
        $this->survivor = Survivor::where('active', 1)->first();
        $this->has_games_to_block_survivors = $this->current_round->has_games_to_block_survivors();
    }
    public function render()
    {
        return view('livewire.survivors.table.index', ['users' => $this->read_users()]);
    }

    private function read_users()
    {
          return  User::role(env('ROLE_PARTICIPANT', 'Participante'))
                        ->with('survivors')
                        ->withCount([
                            'survivors as total_survivors' => function ($query) {
                                $query->where('survive', 1);
                            }
                        ])
                        ->withCount([
                            'survivors as failed_survivors' => function ($query) {
                                $query->where('survive', 0);
                            }
                        ])
                        ->selectRaw('users.*,
                                    (SELECT CASE WHEN EXISTS (
                                        SELECT * FROM user_survivors
                                        WHERE user_survivors.user_id = users.id
                                        AND user_survivors.survive = 0
                                        -- Agregar condiciones adicionales si es necesario
                                    ) THEN 1 ELSE 0 END) AS is_zombie')
                        ->orderBy('total_survivors', 'desc')
                        ->orderby('failed_survivors','asc')
                        ->orderBy('users.alias', 'asc')
                        ->get();
    }

}
