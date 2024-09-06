<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Excellsus\Traits\UserTrait;
use App\Observers\UserObserver;
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
        'username',
        'alias',
        'password',
        'active',
        'alias',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('Admin');
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

    protected static function boot()
    {
        parent::boot();
        static::observe(UserObserver::class);
    }

    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function survivors(): HasMany
    {
        return $this->hasMany(UserSurvivor::class);
    }

    public function picks_game($game_id): HasMany
    {
        return $this->hasMany(Pick::class)->where('game_id', $game_id);
    }

    public function pick_game($game_id): HasMany
    {
        return $this->hasMany(Pick::class)->where('game_id', $game_id)->first();
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function positions_round($round_id)
    {
        return $this->positions()->where('round_id', $round_id)->first();
    }

    public function generalPosition(): HasOne
    {
        return $this->hasOne(GeneralPosition::class);
    }

    public function game_pick($game_id)
    {
        return $this->picks()->where('game_id', $game_id)->first();
    }
    // Tiene registro de posición en la jornada
    public function has_position_record_round($round_id)
    {
        return $this->positions->where('round_id', $round_id)->count();
    }

    public function has_picks_round(Round $round): bool
    {
       return $this->picks()->wherehas('game', function ($query) use($round){
                $query->where('round_id', $round->id);
            })->exists();
    }

    // Filtros con Scope
    public function scopeActive($query, $active = true)
    {
        $query->where('active', $active);
    }

    /**
     * Determina si el usuario es Zoombie en los survivors
     * 1) Si ya tiene "survivors" perdidos en jornadas pasadas a la actual
     * 2) Si el partido del equipo que seleccionó en la jornada activa ya se jugó y perdió
     * Params:
     * $round: Jornada:
     *      (a) Si no recibe jornada o es mayor a la actual asume la actual
     */
    public function is_zombie(Round $round): bool{
        // Revisa si tiene survivors fallidos en jornada anterior a la indicada
        $is_zombie = $this->survivors()->where('round_id','<',$round->id)
                                        ->where('survive',0)
                                        ->exists();
        if($is_zombie){
            return true;
        }
        // Si tiene survivor Y ya se jugó el partido en la jornada y no sobrevivió
        $user_round_survivor = $this->survivors()->where('round_id',$round->id)->first();

        if($user_round_survivor){
            if($user_round_survivor->team->game_round($round)){
                if($user_round_survivor->team->game_round($round)->was_played()){
                    if($user_round_survivor->survive == 0){
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
