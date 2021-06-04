<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emberfuse\Blaze\Models\Traits\Sluggable;
use Emberfuse\Scorch\Models\Traits\HasProfilePhoto;
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
        'address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'address' => 'object',
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
     * Get all the users that belong to this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all the invitations that belong to this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Get the owner of the team.
     *
     * @return \App\Models\User|null
     */
    public function owner(): ?User
    {
        return $this->members
            ->filter(fn ($user) => $user->isOwner())
            ->first();
    }

    /**
     * Determine if the given user is the owner of this team.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function ownerIs(User $user): bool
    {
        return $this->owner()->is($user);
    }

    /**
     * Determine if the given user belongs to this team.
     *
     * @param \App\Models\User|string $user
     *
     * @return bool
     */
    public function hasMember($user): bool
    {
        if (is_string($user)) {
            $user = User::whereEmail($user)->first();
        }

        return $this->members->contains(
            fn (User $member): bool => $member->is($user)
        );
    }
}
