<?php

namespace App\Contracts\Teams;

interface Member
{
    /**
     * Determine if the user is a team owner.
     *
     * @return bool
     */
    public function isOwner(): bool;

    /**
     * Determine if the user belongs to the given team.
     *
     * @param \App\Contracts\Teams\Team $team
     *
     * @return bool
     */
    public function belongsToTeam(Team $team): bool;
}
