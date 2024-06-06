<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Excellsus\Traits\UserTrait;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser

{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'alias',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        return false;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function picks_game($game_id): HasMany
    {
        return $this->hasMany(Pick::class)->where('game_id',$game_id);
    }

    public function pick_game($game_id): HasMany
    {
        return $this->hasMany(Pick::class)->where('game_id',$game_id)->first();
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function positions_round($round_id)
    {
        if($round_id == 1){
            dd($this->positions()->where('round_id',$round_id)->first());
        }

        return $this->positions()->where('round_id',$round_id)->first();
    }

    public function generalPosition(): HasOne
    {
       return $this->hasOne(GeneralPosition::class);
    }

    public function game_pick($game_id){
        return $this->picks()->where('game_id',$game_id)->first();
    }
    // Tiene registro de posición en la jornada
    public function has_position_record_round($round_id){
        return $this->positions->where('round_id',$round_id)->count();
     }

     // Filtros con Scope
     public function scopeActive($query,$active=true){
        $query->where('active',$active);
     }


}
