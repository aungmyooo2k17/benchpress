<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Team $team
     *
     * @return mixed
     */
    public function manage(User $user, Team $team)
    {
        return $team->hasUser($user) && $team->owner()->is($user);
    }
}
