<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Cratespace\Sentinel\Models\Traits\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cratespace\Preflight\Models\Concerns\ManagesRoles;
use Cratespace\Sentinel\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cratespace\Sentinel\Models\Concerns\InteractsWithSessions;
use Cratespace\Sentinel\Models\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use ManagesRoles;
    use HasApiTokens;
    use HasProfilePhoto;
    use InteractsWithSessions;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'username',
        'settings',
        'address',
        'locked',
        'profile_photo_path',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'settings' => 'array',
        'address' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'sessions',
        'two_factor_enabled',
        'role',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['team'];

    /**
     * Get the team the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param \App\Models\Team $team
     *
     * @return bool
     */
    public function belongsToTeam(Team $team): bool
    {
        return $this->team->is($team);
    }

    /**
     * Get the name of the user's role.
     *
     * @return string|null
     */
    public function getRoleAttribute(): ?string
    {
        return optional($this->roles->first())->name;
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('Administrator');
    }
}
