<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    use HasFactory;
    protected $table = 'conferences';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'conference_id'
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }
}
