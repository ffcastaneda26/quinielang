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
    public $team_id_survivor_round;
    public $user_survivor_current;
    public $survivor;
    public $current_round;
    public $round_has_games_played;
    public $minutesBefore;

    public function mount()
    {
        $this->survivor = Survivor::where('active', 1)->first();
        $this->read_teams();
        $round_instance = new Round();
        $this->current_round = $round_instance->read_current_round();
        $this->round_has_games_played = $this->round->has_games_played();
    }


    public function render()
    {
        $this->team_survivor();
        return view('livewire.survivors.user-survivor');
    }

    public function team_survivor()
    {
        $this->reset('user_survivor_current');
        $this->user_survivor_current = SurvivorUser::where('round_id', $this->round->id)
            ->where('user_id', Auth::user()->id)
            ->first();
    }
    private function read_teams()
    {
        $minutesBefore = 5;

        $previus_survivors = Auth::user()->survivors()->select('team_id')->get()->toArray();

        $locales = $this->round->local_teams()->select('teams.id', 'name','logo')
            ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBefore))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
            ->whereDoesntHave('survivors')
            ->orWhereHas('survivors', function ($query) {
                $query->where('round_id', $this->round->id)
                    ->where('user_id',Auth::user()->id)
                    ->where('survivor_id',$this->survivor->id);
            })
            ->whereNotIn('teams.id', $previus_survivors)
            ->get();

        $visitas = $this->round->visit_teams()->select('teams.id', 'name')
            ->where('games.game_date', '>', Carbon::now()->subMinutes($minutesBefore))
            ->whereNull('games.local_points')
            ->whereNull('games.visit_points')
            ->whereDoesntHave('survivors')
            ->orWhereHas('survivors', function ($query) {
                $query->where('round_id', $this->round->id)
                    ->where('user_id',Auth::user()->id)
                    ->where('survivor_id',$this->survivor->id);
            })
            ->whereNotIn('teams.id', $previus_survivors)
            ->get();

        $this->teams = $locales->merge($visitas);
        $this->teams = $this->teams->sortBy('name');
    }

    public function update_team_survivor($round_id)
    {
        $user_survivor_record = SurvivorUser::where('user_id', Auth::user()->id)
            ->where('round_id', $round_id)
            ->where('survivor_id', $this->survivor->id)
            ->first();

        // No halló survivor y trae equipo
        if (!$user_survivor_record && $this->team_id) {
            $this->create_team_survivor($round_id);
            $this->reset('team_id');
            return;
        }

        // Halló Survivor
        if ($user_survivor_record) {
            if ($this->team_id) {
                if ($user_survivor_record->team_id != $this->team_id) {
                    $user_survivor_record->delete();
                    $this->create_team_survivor($round_id);
                    return;
                }
            } else {
                $user_survivor_record->delete();
                $this->read_teams();
                return;
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
        $this->reset('team_id');
        $this->read_teams();
    }

    public function delete_survivor(SurvivorUser $survivorUser)
    {
        $survivorUser->delete();
        $this->reset('user_survivor_current');
        $this->read_teams();
    }
}
