<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survivor extends Model
{
    use HasFactory;
    protected $table='survivors';

    public $timestamps = false;
    protected $fillable =[
        'name',
        'active'
    ];
}
