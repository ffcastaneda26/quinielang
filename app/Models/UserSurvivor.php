<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSurvivor extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'round_id',
      'team_id',
      'survivor_id',
      'survive'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function round():BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function team():BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function survivor():BelongsTo
    {
        return $this->belongsTo(Survivor::class);
    }

}
