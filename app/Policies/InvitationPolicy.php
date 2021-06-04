<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isOwner();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User       $user
     * @param \App\Models\Invitation $invitation
     *
     * @return mixed
     */
    public function update(?User $user = null, Invitation $invitation)
    {
        return ! $invitation->accepted();
    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param \App\Models\User       $user
     * @param \App\Models\Invitation $invitation
     *
     * @return mixed
     */
    public function destroy(User $user, Invitation $invitation)
    {
        return $user->isOwner() && $user->team->is($invitation->team);
    }
}
