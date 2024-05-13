<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;
    protected $table = 'seasons';
    public $timestamps = false;
    protected $fillable =[
        'name',
        'start_regular',
        'finish_regular',
        'start_play_offs',
        'finish_play_offs',
        'start_conference',
        'finisht_conference',
        'super_bowl',
        'field_id',
        'champion_ship_id',
        'champion_ship_points',
        'sub_champion_ship_id',
        'sub_champion_ship_points',
        'league_id',
        'active',
    ];

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }

    public  function field_super_bowl(): BelongsTo
    {
        return $this->belongsTo(Team::class,'field_id');
    }

    public  function champio_ship(): BelongsTo
    {
        return $this->belongsTo(Team::class,'champion_ship_id');
    }

    public  function sub_champio_ship(): BelongsTo
    {
        return $this->belongsTo(Team::class,'sub_champion_ship_id');
    }

    public  function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

}
