<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
