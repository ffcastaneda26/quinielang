<?php

namespace App\Livewire;

use App\Models\Configuration;
use App\Models\Game;
use App\Models\Round;
use Livewire\Component;

class Counter extends Component
{

    public $round_games;
    public $round;
    public $id_game_tie_breaker;
    public $configuration;
    public function mount()
    {
        $this->round = Round::findOr(1);
        $this->round_games = $this->round->games()->orderby('game_day')->orderby('game_time')->get();
        $this->id_game_tie_breaker =Game::where('round_id',$this->round->id)->orderByDesc('game_day')->orderByDesc('game_time')->first()->id;
        $this->configuration = Configuration::first();
    }

    public function render()
    {
        return view('livewire.counter');
    }

}
