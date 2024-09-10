<?php

namespace App\Livewire\Survivors;

use App\Models\Round;
use App\Models\Survivor;
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
            $game = $team->local_games()->where('round_id',$this->round->id)->first();
            if(!$game){
                $game = $team->visit_games()->where('round_id',$this->round->id)->first();
            }
            $this->game_played = $game->was_played();

        }


    }
    private function read_teams()
    {
        $this->reset('teams');
        $this->team_survivor();

        $minutesBefore = $this->minutesBefore;
        $locales = $this->round->local_teams()
            ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBefore))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
            ->whereDoesntHave('survivors',function($query){
                $query->where('user_id',Auth::user()->id);
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
                    $query->where('user_id',Auth::user()->id);
                })
            ->orWhereHas('survivors', function ($query) {
                $query->where('round_id', $this->round->id)
                    ->where('user_id',Auth::user()->id)
                    ->where('survivor_id',$this->survivor->id);
            })
            ->get();

        $this->teams = $locales->merge($visitas);
        $this->teams = $this->teams->sortBy('name');

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
}
