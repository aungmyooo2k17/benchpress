<?php

namespace App\Models;

use App\Contracts\Teams\Member;
use Illuminate\Database\Eloquent\Model;
use Emberfuse\Blaze\Models\Traits\Sluggable;
use App\Contracts\Teams\Team as TeamContract;
use Emberfuse\Scorch\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model implements TeamContract
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
     * Get all the products that belong to this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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
     * @return \App\Contracts\Teams\Member|null
     */
    public function owner(): ?Member
    {
        return $this->members
            ->filter(fn ($user) => $user->isOwner())
            ->first();
    }

    /**
     * Determine if the given user is the owner of this team.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function ownerIs($user): bool
    {
        return $this->owner()->is($user);
    }

    /**
     * Determine if the given user belongs to this team.
     *
     * @param mixed $user
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
