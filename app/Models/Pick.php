<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pick extends Model
{
    use HasFactory;

    protected $table = 'picks';
    protected $fillable = [
        'user_id',
        'game_id',
        'winner',
        'hit_game',
        'visit_points',
        'local_points',
        'dif_points_winner',
        'dif_points_total',
        'dif_points_local',
        'dif_points_visit',
        'hit_last_game',
        'hit_local',
        'hit_visit',
        'dif_victory'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }


}
