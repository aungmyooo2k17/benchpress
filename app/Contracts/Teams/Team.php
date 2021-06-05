<?php

namespace App\Contracts\Teams;

interface Team
{
    /**
     * Determine if the given user is the owner of this team.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function ownerIs($user): bool;

    /**
     * Determine if the given user belongs to this team.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function hasMember($user): bool;

    /**
     * Get the owner of the team.
     *
     * @return \App\Contracts\Teams\Member|null
     */
    public function owner(): ?Member;
}
