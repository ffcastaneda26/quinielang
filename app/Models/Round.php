<?php

namespace App\Models;

use App\Enums\RoundTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Round extends Model
{
    use HasFactory;
    protected $table = 'rounds';

    public $timestamps = false;
    protected $fillable = [
        'start',
        'finish',
        'active',
        'type',
        'season_id',
    ];
    protected $casts = [
        'type'        => RoundTypeEnum::class,
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class)
                ->orderBy('hits','desc')
                ->orderby('position','asc');
    }
    public function local_teams(): HasManyThrough
    {
        return $this->hasManyThrough(
            Team::class,
            Game::class,
            'round_id', // FK  que une tabla mas grande a intermedia (Rounds --< Games)
            'id', // Llave tabla final (teams)
            'id', // Llave tabla mas grande (Rounds)
            'local_team_id' // Llave de tabla intermedia (Games)
        );
    }

    public function visit_teams(): HasManyThrough
    {
        return $this->hasManyThrough(
            Team::class,
            Game::class,
            'round_id', // FK  que une tabla mas grande a intermedia (Rounds --< Games)
            'id', // Llave tabla final (teams)
            'id', // Llave tabla mas grande (Rounds)
            'visit_team_id' // Llave de tabla intermedia (Games)
        );
    }

    public function survivors(): HasMany
    {
        return $this->hasMany(UserSurvivor::class);
    }

    public function survivors_team($team_id){
        return $this->survivors->where('team_id',$team_id);
    }

    public function survivors_failed(){
        return $this->survivors->where('survive',0);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }


    public function  read_current_round()
    {
        $sql = "UPDATE rounds SET active=0";
        DB::update($sql);

        $today = now()->toDateString();
        $minDate = Round::min('start');
        $current_round = null;
        if ($minDate >= $today) {
            $current_round = Round::where('start', $minDate)->first();
        }

        if (!$current_round) {
            $current_round = $this::where('start', '<=', $today)
                ->where('finish', '>=', $today)
                ->first();
            if (!$current_round) {
                $current_round = $this::where('id', $this->max('id'))->first();
            }
        }



        if ($current_round) {

            $current_round->active = 1;
            $current_round->save();
            return $current_round;
        }
        return null;
    }

    // Regresa el último partido de la jornada
    public function get_last_game_round()
    {
        return $this->games()->orderby('game_date','desc')->first();
    }

    // Filtra los juegos en la jornada que NO tengan NULO en 'local_points' o en 'visit_points'
    public function has_games_played()
    {
        return $this->games()->where(function ($query) {
            $query->whereNotNull('local_points');
            $query->whereNotNull('visit_points');
        })->count();
    }

    /**
     * Summary of has_games_to_block_survivors
     * @param mixed $minutesBefore
     * @return int Survivos que el partido aun no comienza
     */
    public function has_games_to_block_survivors($minutesBefore=5)
    {
        $records = UserSurvivor::where('round_id',$this->id)
                                ->whereHas('team',function($query) use($minutesBefore) {
                                    $query->whereHas('local_games',function($query) use($minutesBefore) {
                                                    $query->where('game_date', '<', Carbon::now()->subMinutes($minutesBefore))
                                                            ->where('round_id',$this->id);
                                                })
                                          ->orWhereHas('visit_games',function($query) use($minutesBefore){
                                                    $query->where('game_date', '<', Carbon::now()->subMinutes($minutesBefore))
                                                          ->where('round_id',$this->id);
                                                });
                                    })
                                ->get();
        return $records->count();

    }

    /**
     * ¿Hay Juegos Pronosticables?
     */

     public function hasAllowableGames($minuts_before_picks = null)
        {
            date_default_timezone_set("America/Chihuahua");

            if(!$minuts_before_picks){
                $minuts_before_picks = Configuration::first()->minuts_before_picks;
            }

            $allowableGames = $this->games()
                ->where('game_date', '>', now()->subMinutes($minuts_before_picks))
                ->count();


            return $allowableGames;

            // if($allowableGames){
            //     dd($allowableGames);
            // }
            // return false;
        }
}
