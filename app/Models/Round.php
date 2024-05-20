<?php

namespace App\Models;

use App\Enums\RoundTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}