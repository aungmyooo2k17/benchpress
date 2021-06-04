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
        'address' => 'array',
    ];

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
}
