<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'alias',
        'short',
        'logo',
        'logo_gris',
        'division_id',
    ];

    public function local_games():HasMany
    {
        return $this->hasMany(Game::class,'local_team_id');
    }

    public function visit_games():HasMany
    {
        return $this->hasMany(Game::class,'visit_team_id');
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function survivors(): HasMany
    {
        return $this->hasMany(UserSurvivor::class);
    }

    public function has_user_survivor_round($round_id,$user_id = null){
        if(!$user_id || isNull($user_id)){
            $user_id = Auth::user()->id;
        }

        $user_survivor_round = $this->survivors()->where('round_id',$round_id)
                                                ->where('user_id',$user_id)
                                                ->get();
        return $user_survivor_round->count() ? true : false;
    }

    public function game_round(Round $round=null){
        $game_round = null;
        if(!$round){
            $round_search = New Round();
            $current_round = $round_search->read_current_round()->id;
            $round = $round_search->$current_round;
        }

        $game_round =  $this->local_games()->where('round_id',$round->id)->first();
        if($game_round){
            return $game_round;
        }
        $game_round = $this->visit_games()->where('round_id',$round->id)->first();

        return $game_round;

    }

}
