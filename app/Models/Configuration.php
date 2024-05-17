<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configuration';
    public $timestamps = false;
    protected $fillable = [
        'website_name',
        'website_url',
        'email',
        'minuts_before_picks',
        'allow_ties',
        'create_mssing_picks',
        'assig_role_to_user',
        'require_points_in_picks',
        'language',
        'active',
        'image'
    ];

}
