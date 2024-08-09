<?php

namespace App\Livewire\Picks\TablePicks;


use App\Models\User;
use App\Models\Round;
use Livewire\Component;
use App\Traits\FuncionesGenerales;
use Livewire\WithPagination;

class TablePicks extends Component
{
    use WithPagination;
    use FuncionesGenerales;
    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round = $this->current_round;
        $this->read_round_games($this->selected_round);
        $this->round_has_games_played = $this->selected_round->has_games_played();
    }
    public function render()
    {
        return view('livewire.picks.tablepicks.index',['users' => $this->read_users()]);

    }

    private function read_users()
    {
        $users = User::role(env('ROLE_PARTICIPANT', 'Participante'))
            ->wherehas('picks', function ($query) {
                $query->wherehas('game', function ($query) {
                    $query->where('round_id', $this->selected_round->id)
                    ->orderBy('game_id');
                });
            })
            ->with([
                'picks' => function ($query) {
                    $query->wherehas('game', function ($query) {
                        $query->where('round_id', $this->selected_round->id)
                            ->orderBy('game_date');
                    });
                },
                'positions' => function ($query) {
                    $query->where('round_id', $this->selected_round->id);
                },
                'generalPosition',
            ])
            ->orderBy('alias')
            ->paginate($this->pagination);

        return $users;
    }

}
