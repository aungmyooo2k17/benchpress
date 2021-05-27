<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User            $user
     * @param \App\Models\Invitation|null $invitation
     *
     * @return mixed
     */
    public function manage(User $user, Invitation $invitation)
    {
        return $user->isAdmin() && $invitation->team->is($user->team);
    }
}
