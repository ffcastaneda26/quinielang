<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'game_day'  => 'datetime:Y-m-d',
        'game_time' => 'datetime:H:i',
        'game_date' => 'datetime'
    ];

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
        public function hit_game($winner){
            return  $this->winner === $winner;
        }


}
