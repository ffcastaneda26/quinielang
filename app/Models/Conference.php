<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends Model
{
    use HasFactory;
    protected $table = 'conferences';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'short',
        'logo',
        'league_id'
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }
}
