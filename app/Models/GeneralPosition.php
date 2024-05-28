<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralPosition extends Model
{
    use HasFactory;
    protected $table = 'general_positions';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'hits',
        'hits_breaker',
        'total_error',
        'total_points',
        'position'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
