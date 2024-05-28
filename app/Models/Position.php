<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'round_id',
        'user_id',
        'hits',
        'extra_points',
        'dif_winner_points',
        'dif_total_points',
        'dif_local_points',
        'dif_visit_points',
        'dif_victory',
        'hit_last_game',
        'hit_visit',
        'hit_local',
        'position',
    ];

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
