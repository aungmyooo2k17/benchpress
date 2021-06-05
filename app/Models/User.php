<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Contracts\Teams\Team as TeamContract;
use Emberfuse\Scorch\Models\Traits\HasApiTokens;
use App\Contracts\Teams\Member as MemberContract;
use Emberfuse\Blaze\Models\Concerns\ManagesRoles;
use Emberfuse\Scorch\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emberfuse\Scorch\Models\Concerns\InteractsWithSessions;
use Emberfuse\Scorch\Models\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements MemberContract
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use HasProfilePhoto;
    use InteractsWithSessions;
    use TwoFactorAuthenticatable;
    use ManagesRoles;

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
        'owner',
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
        'settings' => 'object',
        'address' => 'object',
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
    ];

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
     * Determine if the user is a team owner.
     *
     * @return bool
     */
    public function isOwner(): bool
    {
        return (bool) $this->owner;
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param \App\Contracts\Teams\Team $team
     *
     * @return bool
     */
    public function belongsToTeam(TeamContract $team): bool
    {
        return $this->team->is($team);
    }
}
