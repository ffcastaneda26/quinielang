<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
