<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survivor extends Model
{
    use HasFactory;
    protected $table='survivors';

    public $timestamps = false;
    protected $fillable =[
        'name',
        'active'
    ];

    public function survivors(): HasMany
    {
        return $this->hasMany(UserSurvivor::class);
    }
}
