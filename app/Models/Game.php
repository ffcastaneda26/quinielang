<?php

namespace App\Models;

use App\Enums\GameWinnerEnum;
use App\Observers\GameObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_id',
        'local_team_id',
        'local_points',
        'visit_team_id',
        'visit_points',
        'game_date',
        'winner',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(GameObserver::class);
    }
    protected $casts = [
        'game_date' => 'datetime',
    ];



    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function local_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function visit_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'visit_team_id');
    }

    public function has_result()
    {
        return !is_null($this->visit_points) || !is_null($this->local_points) || !is_null($this->winner);
    }

    // ¿Gana local o visita?
    public function win()
    {
        return $this->local_points > $this->visit_points ? 1 : 2;
    }

    public function winner()
    {
        $this->winner = $this->local_points > $this->visit_points ? 1 : 2;
        $this->save();
    }
    // ¿Se acertó el partido?
    public function hit_game($winner)
    {
        return $this->has_result() && $this->winner === $winner;
    }

    // ¿Es el último partido de la jornada?
    public function id_game_tie_breaker()
    {
        return $this->round->get_last_game_round()->id == $this->id;
    }

    public function is_last_game()
    {

        return $this->round->get_last_game_round()->id == $this->id;
    }

    // ¿Permite pronosticar?
    public function allow_pick($minuts_before_picks = null)
    {
        if (!is_null($this->local_points) || !is_null($this->visit_points) || !is_null($this->winner)) {
            return false;
        }
        date_default_timezone_set("America/Chihuahua");

        if(!$minuts_before_picks){
            $minuts_before_picks = Configuration::first()->minuts_before_picks;
        }
        // $configuration = Configuration::first();
        return $this->game_date->subMinutes($minuts_before_picks) >= now();
    }

    // Pronóstico del juegoy del usuario
    public function pick_user(User $user=null)
    {
        if(!$user){
            $user=Auth::user();
        }
        return $this->picks->where('user_id', $user->id)->first();
    }

    public function was_played(){
        return !is_null($this->local_points) && !is_null($this->visit_points) && !is_null($this->winner);
    }

}
