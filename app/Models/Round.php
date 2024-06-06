<?php

namespace App\Models;

use App\Enums\RoundTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->hasMany(Position::class);
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
}
