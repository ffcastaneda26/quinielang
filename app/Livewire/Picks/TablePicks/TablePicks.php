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
    public $show_mnf_column= false;
    public $last_game_round;

    protected $listeners = ['read_round_games'];

    public function mount()
    {
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->select_round( $this->current_round);
        $this->pagination = 30;
        $this->rounds = Round::orderBy('id')->get();

    }
    public function render()
    {
        return view('livewire.picks.tablepicks.index',['users' => $this->read_users()]);
    }

    public function select_roundx(Round $round)
    {
        $this->reset('selected_round','round_games');
        $this->selected_round = $round;
        $this->round_games = $this->selected_round->games;
        $this->round_has_games_played = $this->selected_round->has_games_played();
        $this->last_game_round = $this->selected_round->get_last_game_round();
        $this->show_mnf_column = !$this->last_game_round->allow_pick();
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
            ->get();

        return $users;
    }

}
