<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'alias',
        'short',
        'logo',
        'logo_gris',
        'division_id',
    ];

    public function local_games():HasMany
    {
        return $this->hasMany(Game::class,'local_team_id');
    }

    public function visit_games():HasMany
    {
        return $this->hasMany(Game::class,'visit_team_id');
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }


    public function survivors(): HasMany
    {
        return $this->hasMany(Survivor::class);
    }
}
