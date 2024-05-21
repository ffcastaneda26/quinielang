<?php

namespace App\Models;

use Carbon\Carbon;
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
        'game_day',
        'game_time',
        'game_date',
        'winner',
    ];

    protected $casts = [
        'game_day' => 'datetime:Y-m-d',
        'game_time' => 'datetime:H:i',
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
        return !is_null($this->visit_points) || !is_null($this->local_points);
    }

    // ¿Gana local o visita?
    public function win()
    {
        return $this->local_points > $this->visit_points ? 1 : 2;
    }

    // ¿Se acertó el partido?
    public function hit_game($winner)
    {
        return $this->winner === $winner;
    }

    // ¿Es el último partido de la jornada?
    public function is_last_game_round()
    {
        return $this->round->get_last_game_round()->id == $this->id;
    }

    // ¿Permite pronosticar?
    public function allow_pick()
    {
        if (!is_null($this->local_points) || !is_null($this->visit_points)) {
            return false;
        }
        return true;

        // date_default_timezone_set("America/Chihuahua");
        // $configuracion = Configuration::first();
        // $newDateTime = Carbon::now()->subMinutes($configuracion->minuts);
        // $newDateTime = Carbon::now()->subMinute($configuracion->minuts_before_picks);
        // $string_to_date = substr($this->game_day, 0, 10) . ' ' . substr($this->game_time, 11, 8);
        // $fecha_juego = new Carbon($string_to_date);
        // $fecha_juego->subMinute($configuracion->minuts_before_picks);

        // return $fecha_juego > $newDateTime;
    }

}
