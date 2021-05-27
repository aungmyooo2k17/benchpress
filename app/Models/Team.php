<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cratespace\Preflight\Models\Traits\Sluggable;
use Cratespace\Sentinel\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    use Sluggable;
    use HasProfilePhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'slug',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get all the users that belong to.
     *
     * @return \App\Models\User|null
     */
    public function getOwnerAttribute(): ?User
    {
        return $this->members
            ->filter(fn ($user) => $user->hasRole('Administrator'))
            ->first();
    }

    /**
     * Get all the users that belong to this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    /**
     * Get all the invitations that belong to this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'team_id', 'id');
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function belongsToUser(User $user): bool
    {
        return $this->members->contains(fn ($member) => $member->is($user));
    }
}
