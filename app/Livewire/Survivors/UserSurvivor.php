<?php

namespace App\Livewire\Survivors;

use App\Models\Round;
use App\Models\Survivor;
use App\Models\Team;
use App\Models\UserSurvivor as SurvivorUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserSurvivor extends Component
{
    public $round;
    public $teams;
    public $team_id;
    public $user_survivor_current;
    public $survivor;
    public $current_round;
    public $round_has_games_to_block_survivors=false;
    public $minutesBefore;
    public $game_played = false;
    public $team_survivor_is_local=false;
    public $label_teams;
    public $game;

    public function mount()
    {
        $this->survivor = Survivor::where('active', 1)->first();
        $this->round_has_games_to_block_survivors = $this->round->has_games_to_block_survivors($this->minutesBefore);
    }


    public function render()
    {
        $this->read_teams();
        return view('livewire.survivors.user-survivor');
    }

    public function team_survivor()
    {
        $this->reset('user_survivor_current','game_played');
        $this->user_survivor_current = SurvivorUser::where('round_id', $this->round->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if($this->user_survivor_current){

            $team =$this->user_survivor_current->team;
            $this->game = $this->read_team_game($team,$this->round->id);
            $this->game_played = $this->game->was_played();

            $this->game->game_played = $this->game->was_played();
        }


    }
    private function read_teams()
    {
        $this->reset('teams');
        $this->team_survivor();

        $minutesBefore = $this->minutesBefore;


        if($this->round->has_games_to_block_survivors()){
            return;
        }

        $locales = $this->round->local_teams()
            ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBefore))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
            ->whereDoesntHave('survivors',function($query){
                $query->where('user_id',Auth::user()->id)
                ->wherehas('round',function($query){
                    $query->where('survivor_id',$this->survivor->id);
                });
            })
            ->orWhereHas('survivors', function ($query) {
                $query->where('round_id', $this->round->id)
                    ->where('user_id',Auth::user()->id)
                    ->where('survivor_id',$this->survivor->id);
            })
            ->orderby('game_date')
            ->get();


        $visitas = $this->round->visit_teams()
            ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBefore))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
            ->whereDoesntHave('survivors',function($query){
                    $query->where('user_id',Auth::user()->id)
                    ->wherehas('round',function($query){
                        $query->where('survivor_id',$this->survivor->id);
                    });
                })
            ->orWhereHas('survivors', function ($query) {
                $query->where('round_id', $this->round->id)
                    ->where('user_id',Auth::user()->id)
                    ->where('survivor_id',$this->survivor->id);
            })
            ->get();

        $teams_to_show = $locales->merge($visitas);
        $teams_to_show = $teams_to_show->sortBy('name');
        $teams = collect([]);
        foreach($teams_to_show as $team){
            $game = $this->read_team_game($team,$this->round->id);
            $label_to_select_team = $team->name;
            $label_to_select_team.= $team->id == $game->local_team_id ? ' VS ' . $game->visit_team->short
                                                                       : '@ ' . $game->local_team->short;
        $teams->push([
                'id'  => $team->id,
                'label' => $label_to_select_team
            ]);
        }
        $this->teams = $teams;
    }

    public function update_team_survivor($round_id)
    {
        if(!$this->team_id){
            return;
        }
        $user_survivor_record = SurvivorUser::where('user_id', Auth::user()->id)
            ->where('round_id', $round_id)
            ->where('survivor_id', $this->survivor->id)
            ->first();

        if (!$user_survivor_record) {
            $this->create_team_survivor($round_id);
        }else{
            if ($user_survivor_record->team_id != $this->team_id) {
                $user_survivor_record->team_id = $this->team_id;
                $user_survivor_record->save();
            }
        }

    }

    private function create_team_survivor($round_id)
    {
        SurvivorUser::create([
            'user_id' => Auth::user()->id,
            'round_id' => $round_id,
            'team_id' => $this->team_id,
            'survivor_id' => $this->survivor->id
        ]);
    }

    public function delete_survivor(SurvivorUser $survivorUser)
    {
        $survivorUser->delete();
    }

    public function read_team_game(Team $team,$round_id){
        $game=null;
        $game = $team->local_games()->where('round_id',$round_id)->first();
        if(!$game){
            $game = $team->visit_games()->where('round_id',$round_id)->first();
        }
        return $game;
    }
}
